<?php
/*
Plugin Name: Remove Color Widget
Plugin URI: http://www.blogseye.com
Description: Removes text styling from blogs displaying black text on white background.
Author: Keith P. Graham
Version: 1.0
Requires at least: 2.8
Author URI: http://www.blogseye.com
Tested up to: 3.1

*/

class Widget_kpg_remcolor extends WP_Widget {

   /** constructor */
    function Widget_kpg_remcolor() {
        parent::WP_Widget(false, $name = 'Remove Color Widget');	
    }


    /** @see WP_Widget::form */
    function form($instance) {				
		// outputs the options form on admin
		$title = esc_attr($instance['title']);
		$linktext = esc_attr($instance['linktext']);
		if (empty($linktext)) $linktext='Set black and white mode';
       ?>
	   
	   
<fieldset style="border:thin black solid;padding:2px;"><legend>Title:</legend>	
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</fieldset>
	   
<fieldset style="border:thin black solid;padding:2px;"><legend>Link Text:</legend>	
		<input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" />
</fieldset>


<?PHP
		// end of the functional section
	}

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
		// processes widget options to be saved
		// have to update the new instance
		return $new_instance;
	}

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		// start of the display section
		echo "\r\n<!-- Start of Remove Color Widget -->\r\n";
		// outputs the content of the widget
		extract( $args );
		$title = esc_attr($instance['title']);
		$linktext = esc_attr($instance['linktext']);
		

		if (empty($title)) $title='';
		if (empty($linktext)) $linktext='Set black and white mode';
		echo $before_widget;
		if ( $title) {
			echo $before_title . $title . $after_title;
		}
		
		
		// link and javascript goes here
		?>
<script>
	function remcolor() {
		try {
			var bg=document.getElementsByTagName("*");
			for (var i = 0; i < bg.length; i++) {
				bg[i].style.color="rgb(0,0,0)";
				bg[i].style.backgroundColor="rgb(255,255,255)";
				bg[i].style.backgroundImage="";
			}
		} catch (e) {}
	}
</script>
<a href="javascript:remcolor()"><?php echo $linktext; ?></a>
		<?php
		echo $after_widget;		
		echo "\r\n<!-- end of Remove Color Widget -->\r\n";

	}
}

function kpg_remcolor_control()  {
	// no options - just display begging message
	?>
<div class="wrap">
  <h2>Remove Color Widget</h2>
  <h4>The Remove Color Widget is installed and working correctly.</h4>
  <p>To use this, drag the widget to your sidebar</p>	
  <hr/>
  <p>This plugin is free and I expect nothing in return. If you would like to support my programming, you can buy my book of short stories.<br/>
<a targe="_blank" href="http://www.amazon.com/gp/product/1456336584?ie=UTF8&tag=thenewjt30page&linkCode=as2&camp=1789&creative=390957&creativeASIN=1456336584">Error Message Eyes: A Programmer's Guide to the Digital Soul</a></p>
<p>A link on your blog to one of my personal sites would be appreciated.</p>
  <p><a target="_blank" href="http://www.WestNyackHoney.com">West Nyack Honey</a> (I keep bees and sell the honey)<br />
   <a target="_blank" href="http://www.cthreepo.com/blog">Wandering Blog </a> (My personal Blog) <br />
    <a target="_blank"  href="http://www.cthreepo.com">Resources for Science Fiction</a> (Writing Science Fiction) <br />
    <a target="_blank"  href="http://www.jt30.com">The JT30 Page</a> (Amplified Blues Harmonica) <br />
    <a target="_blank"  href="http://www.harpamps.com">Harp Amps</a> (Vacuum Tube Amplifiers for Blues) <br />
    <a target="_blank"  href="http://www.blogseye.com">Blog&apos;s Eye</a> (PHP coding) <br />
    <a target="_blank"  href="http://www.cthreepo.com/bees">Bee Progress Beekeeping Blog</a> (My adventures as a new beekeeper) </p>
</div>
	
	
	<?php

}

add_action('widgets_init', create_function('', 'return register_widget("Widget_kpg_remcolor");'));
function kpg_remcolor_init() {
   add_options_page('Remove Color', 'Remove Color', 'manage_options',__FILE__,'kpg_remcolor_control');
}
add_action('admin_menu', 'kpg_remcolor_init');


