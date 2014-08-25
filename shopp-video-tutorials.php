<?php
/*
Plugin Name: Shopp + Video Tutorials
Description: Learn how to use the Shopp ecommerce plugin from your WordPress admin.
Version: 1.3
Plugin URI: http://shopp101.com
Author: Lorenzo Orlando Caum, Enzo12 LLC
Author URI: http://www.enzo12.com
License: GPLv2
*/
/* 
(CC BY 3.0) 2014 Lorenzo Orlando Caum (email: hello@enzo12.com)
 
	This plugin is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This plugin is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this plugin.  If not, see <http://www.gnu.org/licenses/>. 
*/
    
Shopp_Video_Tutorials::smartLoad();

class Shopp_Video_Tutorials {
	public static $name;
    
	public static function smartLoad() {
		$instantiate = apply_filters('shoppVideoTutorialsLoadBasic', true);
		if ($instantiate) { new Shopp_Video_Tutorials; }
	}
	
	public function __construct() {
        add_action('admin_init', array($this, 'admin_css'));
		add_action('admin_menu', array($this, 'admin_menu'));

		$this->name = get_option('shopp_video_tutorials_name');
	}
	
	public function admin_css() {
		wp_register_style( 'shopp-video-tutorials-stylesheet', plugins_url( 'css/shopp-video-tutorials.css', __FILE__ ), array(), '20140823' );
		wp_enqueue_style( 'shopp-video-tutorials-stylesheet' );
	}
	
    public function admin_menu() {
		if(!$this->extensions_menu_exist()){
			add_menu_page('Shopp 101', 'Shopp 101', 'shopp_menu', 'shopp-101-extensions', array($this, 'display_shopp_101_extensions_welcome'), null, 57.5);
			$page = add_submenu_page('shopp-101-extensions', 'Shopp 101 extensions', 'Start Here', 'shopp_menu', 'shopp-101-extensions', array($this, 'display_shopp_101_extensions_welcome'));
	        add_action( 'admin_print_styles-' . $page, 'admin_styles' );
		}
        
		$page = add_submenu_page('shopp-101-extensions', 'Video Tutorials', 'Video Tutorials', 'shopp_menu', 'shopp-video-tutorials', array($this, 'render_display_settings'));
        add_action( 'admin_print_styles-' . $page, 'admin_styles' );
        
	}
	
	public function extensions_menu_exist(){
        global $menu;
        $return = false;
        foreach($menu as $menus => $item){
            if($item[0] == 'Shopp 101'){
                $return = true;
            }
        }
        return $return;
    }
	
	public function admin_styles() {
       	wp_enqueue_style( 'shopp-video-tutorials-stylesheet' );
  	}

    public function display_shopp_101_extensions_welcome(){
		?>
	<div class="wrap">
	<h2>Shopp 101 extensions</h2>
	<div class="postbox-container" style="width:65%;">
		<div class="metabox-holder">	

			<div id="shopp-extensions-hello" class="postbox">
				<h3 class="hndle"><span>Welcome</span></h3>
				<div class="inside">
				<p>Thank you for installing and activating a Shopp 101 extension for Shopp.</p>
				<p>To setup and begin using your new extension, locate <strong>Shopp</strong> in the <strong>WordPress Administration Menus</strong> &rarr; <strong>Shopp 101</strong> &rarr; and <strong>click on your extension</strong>.</p>
				</div>
			</div>

			<div id="shopp-extensions-products-services" class="postbox">
				<h3 class="hndle"><span>Products & Services</span></h3>
				<div class="inside">
					<table border="0" width="100%">
   					 	<tr>
                            <td width="45%"><p style="text-align:center"><a href="http://shopp101.com" title="Check out our latest post on Shopp">Shopp 101</a></p><p>Tutorials, how-tos, and recommendations for the Shopp ecommerce plugin.</p><p>Need a Shopp developer to help you with your online store? <br /><a href="http://shopp101.com/consulting/" title="Hire a Shopp developer today">Get in touch today</a></p></td>
						    <td width="10%"></td>
                            <td width="45%"></td>
   						</tr>
					</table>
				</div>
			</div>
			
			<div id="shopp-extensions-support-feedback" class="postbox">
				<h3 class="hndle"><span>Support & Feedback</span></h3>
				<div class="inside">
				<p>Shopp 101 extensions are 3rd-party products.</p> 
				<p>Our plugins are <strong>actively supported</strong>. Support is provided as a courtesy by Lorenzo Orlando Caum, Enzo12 LLC. If you have any questions or concerns, please open a <a href="http://shopp101.com/help/" title="Open a new support ticket with Shopp 101">new support ticket</a> via our help desk.</p>
                <p>You can share feedback via this a <a href="http://shopp101.com/go/shopp-extensions-survey/" title="Take a super short survey">short survey</a>. Takes just a few minutes &mdash; we promise!</p>
                <p>Feeling generous? You can support the continued development of the Shopp 101 extensions by <a href="http://shopp101.com/go/donate-shopp-extensions/" title="Say thank you by purchasing Lorenzo a Redbull">buying me a Redbull</a>, <a href="http://shopp101.com/go/amazonwishlist/" title="Say thank you by gifting Lorenzo a book">ordering me a book</a> from my Amazon wishlist, or <a href="http://shopp101.com/go/tip-shopp-help-desk/" title="Say thank you by tipping Lorenzo via the Shopp Help Desk">tipping me</a> through the Shopp help desk.</p>
                </div>
			</div>
			
			<div id="shopp-extensions-about-the-author" class="postbox">
				<h3 class="hndle"><span>About the Author</span></h3>
				<div class="inside">
					<table border="0" width="100%">
   					 	<tr>
                            <td width="70%"><div><img style="padding: 0px 15px 0px 0px; float:left" src="<?php echo plugins_url( 'shopp-video-tutorials/images/lorenzo-orlando-caum-shopp-wordpress-150x150.jpg' , dirname(__FILE__) ); ?>" border="0" alt="Founder of Enzo12 LLC" width="150" height="150">
                                <p>Lorenzo Orlando Caum is the founder of Enzo12 LLC, a consultancy in Tampa, FL.</p>
                                <p>Lorenzo contributes to the <a href="http://shopp101.com/go/shopp/" title="Visit shopplugin.net">Shopp</a> project as a member of the support team. He has written several  <a href="http://shopp101.com/resources/shopp-extensions/" title="View free WordPress plugins for Shopp">WordPress extensions for Shopp</a>. His latest project is <a href="http://shopp101.com" title="Shopp 101 &mdash; video tutorials for Shopp">video tutorials for Shopp</a>.</p>
                                <p>If you would like to know more about Lorenzo, you can <a href="http://twitter.com/lorenzocaum" title="Follow @lorenzocaum on Twitter">follow @lorenzocaum on Twitter</a> or <a href="http://lorenzocaum.com" title="Check out Lorenzo's blog">check out his blog</a>.</p></div></td>
                            <td width="30%"></td>
   						</tr>
					</table>
				</div>
			</div>

		</div>
	</div>

	<div class="postbox-container" style="width:25%;">
		<div class="metabox-holder">
				
			<div id="shopp-extensions-subscribe" class="postbox">
				<h3 class="hndle"><span>Free Email Updates</span></h3>
				<div class="inside">
					<p>Get infrequent email updates delivered right to your inbox about getting the most from Shopp.</p>
					<div id="optin">
					<p>
						<form class="mailchimp_form" style="text-align: center;" action="http://enzo12.us2.list-manage.com/subscribe/post?u=5991854e8288cad7823e23d2e&amp;id=b6587bef5a" method="post" name="mc-embedded-subscribe-form" target="_blank">
						<input id="mce-EMAIL" class="required email" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" type="email" name="EMAIL" value="Enter your email" size="25">
						<input type="hidden" name="SIGNUP" id="SIGNUP" value="wp_dashboard_plugin_start_page"> <input class="button-primary" type="submit" name="subscribe" value="Yes, I'm interested!">
						</form>
					</p>
					</div>
				</div>
			</div>

			<div id="shopp-extensions-news-from-oms-s101" class="postbox">
				<h3 class="hndle"><span>News from Shopp 101</span></h3>
				<div class="inside">
				<p>Free Report<br /> <a href="http://shopp101.com/newsletter/" title="Receive your free report delivered instantly to your inbox">10 Steps to a More Secure WordPress</a></p>
				<p>Documents & Presentations<br /> <a href="http://shopp101.com/resources/white-papers/" title="Get your free white paper on creating a fast Shopp website">Speeding up your Shopp Ecommerce Website</a><br /><a href="http://shopp101.com/resources/white-papers/" title="Get your free white paper on using Shopp with caching plugins">Shopp + Caching Plugins</a></p>
				<?php _e('Recent posts from the blog'); ?>
				<?php
				include_once(ABSPATH . WPINC . '/feed.php');
				$rss = fetch_feed('http://feeds.feedburner.com/shopp101');
				if (!is_wp_error( $rss ) ) : 
    			$maxitems = $rss->get_item_quantity(7); 
    			$rss_items = $rss->get_items(0, $maxitems); 
				endif;
				?>
				<ul>
    			<?php if ($maxitems == 0) echo '<li>No items.</li>';
    			else
    			foreach ( $rss_items as $item ) : ?>
    			<li>
        		<a href='<?php echo esc_url( $item->get_permalink() ); ?>'
        		title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
        		<?php echo esc_html( $item->get_title() ); ?></a>
    			</li>
    			<?php endforeach; ?>
				</ul>
				</div>
			</div>		

		</div>
		<br /><br /><br />
	</div>
</div>
<?php	 	 
	}
	
	public function render_display_settings() {
		wp_nonce_field('shopp-video-tutorials');
		
		if(!empty($_POST['submit'])){
			$this->name = stripslashes($_POST['name']);

			update_option("shopp_video_tutorials_name", $this->name);

		}	
?>

<div class="wrap">
	<h2>Shopp + Video Tutorials</h2>
	<div class="postbox-container" style="width:65%;">
		<div class="metabox-holder">	

			<div id="shopp-video-tutorials-introduction" class="postbox">
				<h3 class="hndle"><span>Introduction</span></h3>
				<div class="inside">
					<p>This plugin provides online lessons and tutorials for the <a href="http://shopp101.com/go/shopp/" title="Visit shopplugin.net">Shopp</a> ecommerce plugin and is part of the Shopp 101 extensions.</p>
					<p>Now you can learn how to use Shopp from your WordPress admin. For the best experience, please ensure that your web browser is up-to-date.</p>
                    <strong>Acknowledgements</strong>
                    <br />
                    <p>Thanks to the members of the Shopp support team for feedback on this plugin.</p>
				</div>
			</div>

			<div id="shopp-video-tutorials-general-settings" class="postbox">
				<h3 class="hndle"><span>Library</span></h3>
				<div class="inside">
                <p><div id="videolibrary"><img src="<?php echo plugins_url( 'shopp-video-tutorials/images/click-a-lesson-below.gif' , dirname(__FILE__) ); ?>" width="600" height="338" /></div></p>
				<p><?php if ( '' === get_option( 'shopp_video_tutorials_name', '' ) ) {
                    echo "";
                    } else {
                    echo "Hello ". get_option("shopp_video_tutorials_name", $this->name). "! Click on a lesson below to get started."; } ?></p>
                <p><script language="javascript">
                    function changeToVideoSE1()
                        {
                        document.getElementById("videolibrary").innerHTML = '<strong>Install the Shopp eCommerce Plugin</strong><br /><iframe src="http://player.vimeo.com/video/60959688?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><br /><br /><strong>Installing Shopp via FTP / SFTP</strong><br /><iframe src="http://player.vimeo.com/video/60959689?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        }
                    function changeToVideoSE2()
                        {
                        document.getElementById("videolibrary").innerHTML = '<strong>An Overview of the Shopp Interface within WP-admin</strong><br /><iframe src="http://player.vimeo.com/video/60959690?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        }
                    function changeToVideoSE3()
                        {
                        document.getElementById("videolibrary").innerHTML = '<strong>Shopp Setup</strong><br /><iframe src="http://player.vimeo.com/video/60959692?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        }
                    function changeToVideoSE4()
                        {
                        document.getElementById("videolibrary").innerHTML = '<strong>Shopp Payment Settings</strong><br /><iframe src="http://player.vimeo.com/video/60959693?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><br /><br /><strong>Install Shopp Gateway Addons via FTP / SFTP</strong><br /><iframe src="http://player.vimeo.com/video/60960005?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        }
                    function changeToVideoSE5()
                        {
                        document.getElementById("videolibrary").innerHTML = '<strong>Shopp Shipping Settings and Shipping Rates</strong><br /><iframe src="http://player.vimeo.com/video/60960006?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><br /><br /><strong>Install Shopp Gateway Addons via FTP / SFTP</strong><br /><iframe src="http://player.vimeo.com/video/60960007?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        }
                    function changeToVideoOLT1()
                        {
                        document.getElementById("videolibrary").innerHTML = '<strong>How to Setup Shopp Content Templates</strong><br /><iframe src="http://player.vimeo.com/video/62588713?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        }
                    function changeToVideoOLT2()
                        {
                        document.getElementById("videolibrary").innerHTML = '<strong>How to Reinstall the Shopp Core</strong><br /><iframe src="http://player.vimeo.com/video/62661725?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="600" height="337" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                        }
                    </script></p>
                <p>Pro-tip: After starting a video, click on the fullscreen button which appears to the right of the HD toggle.</p>
                <p>
                    <strong>Watch the first 5 videos of Shopp Essentials</strong>
                    <ul>
                        <li><a href="javascript:changeToVideoSE1();">Lesson 1: Install the Shopp eCommerce Plugin</a></li>
                        <li><a href="javascript:changeToVideoSE2();">Lesson 2: An Overview of the Shopp Interface within WP-admin</a></li>
                        <li><a href="javascript:changeToVideoSE3();">Lesson 3: Shopp Setup</a></li>
                        <li><a href="javascript:changeToVideoSE4();">Lesson 4: Shopp Payment Settings</a></li>
                        <li><a href="javascript:changeToVideoSE5();">Lesson 5: Shopp Shipping Settings and Shipping Rates</a></li>
                    </ul>
                    <strong>Other Lessons and Tutorials</strong>
                    <ul>
                        <li><a href="javascript:changeToVideoOLT1();">How to Setup Shopp Content Templates</a></li>
                        <li><a href="javascript:changeToVideoOLT2();">How to Reinstall the Shopp Core</a></li>
                    </ul>
                 </p>
                </div>
			</div>

			<div id="shopp-video-tutorials-support-feedback" class="postbox">
				<h3 class="hndle"><span>Support & Feedback</span></h3>
				<div class="inside">
				<p>This is a 3rd-party plugin.</p>
				<p>This plugin is <strong>actively supported</strong>. Support is provided as a courtesy by Lorenzo Orlando Caum, Enzo12 LLC. If you have any questions or concerns, please open a <a href="http://shopp101.com/help/" title="Open a new support ticket with Shopp 101">new support ticket</a> via our help desk.</p>
                <p>You can share feedback via this a <a href="http://shopp101.com/go/shopp-extensions-survey/" title="Take a super short survey">short survey</a>. Takes just a few minutes &mdash; we promise!</p>
                <p>Feeling generous? You can support the continued development of the Shopp + Video Tutorials by <a href="http://shopp101.com/go/donate-shopp-video-tutorials/" title="Say thank you by purchasing Lorenzo a Redbull">buying me a Redbull</a>, <a href="http://shopp101.com/go/amazonwishlist/" title="Say thank you by gifting Lorenzo a book">ordering me a book</a> from my Amazon wishlist, or <a href="http://shopp101.com/go/tip-shopp-help-desk/" title="Say thank you by tipping Lorenzo via the Shopp Help Desk">tipping me</a> through the Shopp help desk.</p>
				</div>
			</div>
			
			<div id="shopp-video-tutorials-settings" class="postbox">
				<h3 class="hndle"><span>Video Tutorials Settings</span></h3>
				<div class="inside">
                    <p>Enter your name and click Save Settings.</p>
					<p>
                    <form action="" method="post">
					<table>
					<tr>
						<th>Name:</th>
						<td><input type="text" name="name" size="35" value="<?php echo $this->name; ?>" /></td>
					</tr>
                    </table>
					<input type="submit" class="button-primary" value="Save Settings" name="submit" />
					</form>
                    </p>
				</div>
			</div>
			
			<div id="shopp-video-tutorials-about-the-author" class="postbox">
				<h3 class="hndle"><span>About the Author</span></h3>
				<div class="inside">
					<table border="0" width="100%">
   					 	<tr>
                            <td width="70%"><div><img style="padding: 0px 15px 0px 0px; float:left" src="<?php echo plugins_url( 'shopp-video-tutorials/images/lorenzo-orlando-caum-shopp-wordpress-150x150.jpg' , dirname(__FILE__) ); ?>" border="0" alt="Founder of Enzo12 LLC" width="150" height="150">
                                <p>Lorenzo Orlando Caum is the founder of Enzo12 LLC, a consultancy in Tampa, FL.</p>
                                <p>Lorenzo contributes to the <a href="http://shopp101.com/go/shopp/" title="Visit shopplugin.net">Shopp</a> project as a member of the support team. He has written several  <a href="http://shopp101.com/resources/shopp-extensions/" title="View free WordPress plugins for Shopp">WordPress extensions for Shopp</a>. His latest project is <a href="http://shopp101.com" title="Shopp 101 &mdash; video tutorials for Shopp">video tutorials for Shopp</a>.</p>
                                <p>If you would like to know more about Lorenzo, you can <a href="http://twitter.com/lorenzocaum" title="Follow @lorenzocaum on Twitter">follow @lorenzocaum on Twitter</a> or <a href="http://lorenzocaum.com" title="Check out Lorenzo's blog">check out his blog</a>.</p></div></td>
                            <td width="30%"></td>
   						</tr>
					</table>
				</div>
			</div>

		</div>
	</div>

	<div class="postbox-container" style="width:25%;">
		<div class="metabox-holder">
				
			<div id="shopp-video-tutorials-donate" class="postbox">
				<h3 class="hndle"><span><strong>Join Shopp 101!</strong></span></h3>
				<div class="inside">
                    <p><?php if ( '' === get_option( 'shopp_video_tutorials_name', '' ) ) {
                        echo "Hi friend!";
                        } else {
                        echo "Hi ". get_option("shopp_video_tutorials_name", $this->name). "!"; } ?> If this plugin is helpful to you, then please <a href="http://shopp101.com/" title="Say thank you by joining Shopp 101 today">join Shopp 101 as a member</a>.</p>
					<p></p>
				</div>
			</div>
			
			<div id="shopp-video-tutorials-subscribe" class="postbox">
				<h3 class="hndle"><span>Free Email Updates about Shopp</span></h3>
				<div class="inside">
					<p>Get infrequent email updates delivered right to your inbox about getting the most from Shopp.</p>
					<div id="optin">
					<p>
						<form class="mailchimp_form" style="text-align: center;" action="http://enzo12.us2.list-manage.com/subscribe/post?u=5991854e8288cad7823e23d2e&amp;id=b6587bef5a" method="post" name="mc-embedded-subscribe-form" target="_blank">
						<input id="mce-EMAIL" class="required email" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" type="email" name="EMAIL" value="Enter your email" size="25">
						<input type="hidden" name="SIGNUP" id="SIGNUP" value="wp_dashboard_plugin_settings_page"> <input class="button-primary" type="submit" name="subscribe" value="Yes, I'm interested!">
						</form>
					</p>
					</div>
				</div>
			</div>
					
			<div id="shopp-video-tutorials-have-a-question" class="postbox">
				<h3 class="hndle"><span>Have a Question?</span></h3>
				<div class="inside">
                    <p>Open a <a href="http://shopp101.com/help/" title="Open a new support ticket with Shopp 101">new support ticket</a> for Shopp + Video Tutorials</p>
                    <p>Learn about <a href="http://shopp101.com/resources/" title="Learn about extra Shopp resources">additional Shopp resources</a></p>
                    <p>Want awesome support from the Shopp Help Desk? <a title="How to Get Awesome Support on the Shopp Help Desk" href="http://shopp101.com/blog/how-to-get-awesome-support-from-the-shopp-help-desk/">Click here to read the post</a></p>
				</div>
			</div>

			<div id="shopp-video-tutorials-news-from-oms" class="postbox">
				<h3 class="hndle"><span>News from Shopp 101</span></h3>
				<div class="inside">
				<p>Free Report<br /> <a href="http://shopp101.com/newsletter/" title="Receive your free report delivered instantly to your inbox">10 Steps to a More Secure WordPress</a></p>
				<p>Documents & Presentations<br /> <a href="http://shopp101.com/resources/white-papers/" title="Get your free white paper on creating a fast Shopp website">Speeding up your Shopp Ecommerce Website</a><br /><a href="http://shopp101.com/resources/white-papers/" title="Get your free white paper on using Shopp with caching plugins">Shopp + Caching Plugins</a></p>
				<?php _e('Recent posts from the blog'); ?>
				<?php
				include_once(ABSPATH . WPINC . '/feed.php');
				$rss = fetch_feed('http://feeds.feedburner.com/shopp101');
				if (!is_wp_error( $rss ) ) : 
    			$maxitems = $rss->get_item_quantity(7); 
    			$rss_items = $rss->get_items(0, $maxitems); 
				endif;
				?>
				<ul>
    			<?php if ($maxitems == 0) echo '<li>No items.</li>';
    			else
    			foreach ( $rss_items as $item ) : ?>
    			<li>
        		<a href='<?php echo esc_url( $item->get_permalink() ); ?>'
        		title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
        		<?php echo esc_html( $item->get_title() ); ?></a>
    			</li>
    			<?php endforeach; ?>
				</ul>
				</div>
			</div>			
			
			<div id="shopp-video-tutorials-recommendations" class="postbox">
				<h3 class="hndle"><span>Recommended</span></h3>
				<div class="inside">
                    <p>Need a Shopp developer to help you with your online store? <br /><a href="http://shopp101.com/consulting/" title="Hire a Shopp developer today">Get in touch today</a></p>
                    <p>What do you think about video tutorials for Shopp? <br /><a href="http://shopp101.com" title="Learn more about Shopp video tutorials">Learn Shopp one video at a time</a></p>
				</div>
			</div>

		</div>
		<br /><br /><br />
	</div>
</div>
<?php	
	}
}