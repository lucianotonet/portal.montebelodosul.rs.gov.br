<?php
class youtube_embed_featured_plugins{
	
	function __construct($params){
		// set plugin url
		if(isset($params['plugin_url']))
			$this->plugin_url=$params['plugin_url'];
		else
			$this->plugin_url=trailingslashit(dirname(plugins_url('',__FILE__)));
		// set plugin path
		if(isset($params['plugin_path']))
			$this->plugin_path=$params['plugin_path'];
		else
			$this->plugin_path=trailingslashit(dirname(plugin_dir_path('',__FILE__)));
		/*ajax parametrs*/
		
	
	}
	
	

	


	public function controller_page(){
		$plugins_array=array(
			'coming_soon'=>array(
						'image_url'		=>	$this->plugin_url.'admin/images/featured_plugins/coming_soon.jpg',
						'site_url'		=>	'http://wpdevart.com/wordpress-coming-soon-plugin/',
						'title'			=>	'Coming soon and Maintenance mode',
						'description'	=>	'Coming soon and Maintenance mode plugin is an awesome tool to show your visitors that you are working on your website to make it better.'
						),
			'lightbox'=>array(
						'image_url'		=>	$this->plugin_url.'admin/images/featured_plugins/lightbox.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-lightbox-plugin/',
						'title'			=>	'WP Lightbox 2',
						'description'	=>	'WP Lightbox 2 is awesome tool for adding responsive lightbox effect for images and also create lightbox for photo album/gallery on your WordPress blog.'
						),
			
			'countdown'=>array(
						'image_url'		=>	$this->plugin_url.'admin/images/featured_plugins/countdown.jpg',
						'site_url'		=>	'http://wpdevart.com/wordpress-countdown-plugin/',
						'title'			=>	'WordPress Countdown plugin',
						'description'	=>	'WordPress Countdown plugin is an nice tool to create and insert countdown timers into your posts/pages and widgets.'
						),
			'facebook'=>array(
						'image_url'		=>	$this->plugin_url.'admin/images/featured_plugins/facebook.jpg',
						'site_url'		=>	'http://wpdevart.com/wordpress-facebook-like-box-plugin',
						'title'			=>	'Facebook Like Box',
						'description'	=>	'Our Facebook like box plugin will help you to display Facebook like box on your wesite, just add Facebook Like box widget to your sidebar and use it..'
						),
			'poll'=>array(
						'image_url'		=>	$this->plugin_url.'admin/images/featured_plugins/poll.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-polls-plugin',
						'title'			=>	'Poll',
						'description'	=>	'WordPress Polls plugin is an wonderful tool for creating polls and survey forms for your visitors. You can use our polls on widgets, posts and pages.'
						),
			'twitter'=>array(
						'image_url'		=>	$this->plugin_url.'admin/images/featured_plugins/twitter.png',
						'site_url'		=>	'http://wpdevart.com/wordpress-twitter-plugin',
						'title'			=>	'Twitter button plus',
						'description'	=>	'Twitter button plus is nice and useful tool to show Twitter tweet button on your website.'
						),															
			
		);
		?>
        <style>
         .featured_plugin_main{
			 background-color: #ffffff;
			 border: 1px solid #dedede;
			 box-sizing: border-box;
			 float:left;
			 margin-right:20px;
			 margin-bottom:20px;
			 
			 width:450px;
		 }
		.featured_plugin_image{
			padding: 15px;
			display: inline-block;
			float:left;
		}
		.featured_plugin_image a{
		  display: inline-block;
		}
		.featured_plugin_information{			
			float: left;
			width: auto;
			max-width: 282px;

		}
		.featured_plugin_title{
			color: #0073aa;
			font-size: 18px;
			display: inline-block;
		}
		.featured_plugin_title a{
			text-decoration:none;
					
		}
		.featured_plugin_title h4{
			margin:0px;
			margin-top: 20px;
			margin-bottom:8px;			  
		}
		.featured_plugin_description{
			display: inline-block;
		}
        
        </style>
        <script>
		
        jQuery(window).resize(like_box_feature_resize);
		jQuery(document).ready(function(e) {
            like_box_feature_resize();
        });
		
		function like_box_feature_resize(){
			var like_box_width=jQuery('.featured_plugin_main').eq(0).parent().width();
			var count_of_elements=Math.max(parseInt(like_box_width/450),1);
			var width_of_plugin=((like_box_width-count_of_elements*24-2)/count_of_elements);
			jQuery('.featured_plugin_main').width(width_of_plugin);
			jQuery('.featured_plugin_information').css('max-width',(width_of_plugin-160)+'px');
		}
       	</script>
        	<h2>Featured Plugins</h2>
            <br>
            <br>
            <?php foreach($plugins_array as $key=>$plugin) { ?>
            <div class="featured_plugin_main">
            	<span class="featured_plugin_image"><a target="_blank" href="<?php echo $plugin['site_url'] ?>"><img src="<?php echo $plugin['image_url'] ?>"></a></span>
                <span class="featured_plugin_information">
                	<span class="featured_plugin_title"><h4><a target="_blank" href="<?php echo $plugin['site_url'] ?>"><?php echo $plugin['title'] ?></a></h4></span>
                    <span class="featured_plugin_description"><?php echo $plugin['description'] ?></span>
                </span>
                <div style="clear:both"></div>                
            </div>
            <?php } 
	}	
	
}


 ?>