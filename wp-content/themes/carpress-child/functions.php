<?php
/**
 * Functions of the child theme for Hairpress WP
 */

add_action( "wp_enqueue_scripts", "add_additional_css", 20 );
/**
 * Add the style.css (from this folder) after the main.css file
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style Codex for wp_enqueue_style()
 */
function add_additional_css() {
    wp_enqueue_style( 'child-css', get_stylesheet_uri() , array( 'main-css' ) );
}


// Unregister default CPT
if ( ! function_exists( 'unregister_post_type' ) ) :
    function unregister_post_type( $post_type ) {
        global $wp_post_types;
        if ( isset( $wp_post_types[ $post_type ] ) ) {
            unset( $wp_post_types[ $post_type ] );
            return true;
        }
        return false;
    }
endif;



add_filter( 'the_content', 'my_the_content_filter', 20 );
/**
 * Add a icon to the beginning of every post page.
 *
 * @uses is_single()
 */
function my_the_content_filter( $content ) {

    if ( is_page() ){
        global $post;
        //turn on output buffering to capture script output
        ob_start();
        $childpages = '';
        $children = get_pages('child_of='.$post->ID);        
        if( count( $children ) != 0 ){ // Se tem páginas filhas
            if( count( $children ) <= 3 ){
                $childpages = do_shortcode('[child_pages cols="'.count( $children ).'" more="Ler mais" words="30" skin="simple" thumbs="true" class="child-pages"]' );
            }else{
                $childpages = do_shortcode('[child_pages cols="3" more="Ler mais" words="30" skin="simple" thumbs="true" class="child-pages"]' );
            }
        }
       
        $content = $content."<br/>".$childpages;
    }
    // Returns the content.
    return $content;
}


// Register Custom Taxonomy
function custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Categorias', 'Taxonomy General Name', 'carpress_wp' ),
        'singular_name'              => _x( 'Categoria', 'Taxonomy Singular Name', 'carpress_wp' ),
        'menu_name'                  => __( 'Categorias', 'carpress_wp' ),
        'all_items'                  => __( 'Todas', 'carpress_wp' ),
        'parent_item'                => __( 'Mãe', 'carpress_wp' ),
        'parent_item_colon'          => __( 'Categoria mãe:', 'carpress_wp' ),
        'new_item_name'              => __( 'Nova categoria', 'carpress_wp' ),
        'add_new_item'               => __( 'Adicionar nova categoria', 'carpress_wp' ),
        'edit_item'                  => __( 'Editar categoria', 'carpress_wp' ),
        'update_item'                => __( 'Atualizar categoria', 'carpress_wp' ),
        'view_item'                  => __( 'Ver categoria', 'carpress_wp' ),
        'separate_items_with_commas' => __( 'Separe por vírgulas', 'carpress_wp' ),
        'add_or_remove_items'        => __( 'Adicionar ou remover', 'carpress_wp' ),
        'choose_from_most_used'      => __( 'Mais usadas', 'carpress_wp' ),
        'popular_items'              => __( 'Mais populares', 'carpress_wp' ),
        'search_items'               => __( 'Buscar categoria', 'carpress_wp' ),
        'not_found'                  => __( 'Nada encontrado', 'carpress_wp' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'categoria', array( ' gallery' ), $args );

}
// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );



if ( ! function_exists( 'before_pages_sidebar' ) ) {

    // Register Sidebars
    function before_pages_sidebar() {

        $args = array(
            'id'            => 'afterpages',
            'name'          => __( 'After Pages', 'carpress' ),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
        );
        register_sidebar( $args );

    }

    // Hook into the 'widgets_init' action
    add_action( 'widgets_init', 'before_pages_sidebar' );

}


// ADD CHILD PAGE
Add_Child_Page::on_load();

class Add_Child_Page {

    static function on_load() {

        add_action( 'init', array( __CLASS__, 'init' ) );
        add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
    }

    static function init() {

        add_action( 'admin_bar_menu', array( __CLASS__, 'admin_bar_menu' ), 90 );
    }

    static function admin_bar_menu( $wp_admin_bar ) {

        if( is_page() ) {

            $wp_admin_bar->add_node( array(
                'id'    => 'add_child_page',
                'title' => '<span class="ab-icon"></span> Adicionar conteúdo',
                'href'  => add_query_arg( array( 'post_type'   => 'page', 'page_parent' => get_the_ID() ), admin_url( 'post-new.php' ) ),
            ) );
        }
    }

    static function admin_init() {

        add_filter( 'page_attributes_dropdown_pages_args', array( __CLASS__, 'page_attributes_dropdown_pages_args' ) );
    }

    static function page_attributes_dropdown_pages_args( $dropdown_args ) {

        if ( ! empty($_REQUEST['page_parent']) )
            $dropdown_args['selected'] = (int) $_REQUEST['page_parent'];

        return $dropdown_args;
    }
}