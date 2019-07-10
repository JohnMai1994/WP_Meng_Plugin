<?php 
/*
Plugin Name: Meng
Plugin URI: https://google.com
Description: Add Meng in the wordpress
version: 1.0
Author: John Mai
Author URI: https://www.jiadong.work
License


*/

date_default_timezone_set('Asia/Shanghai');

class meng_font_style{
	
	var $icon_url = "/imges/icon.png";
	var $option_group = "meng_group";

	// construction method
	function meng_font_style () {

		// create menu
		add_action('admin_menu', array($this, 'create_menu'));
		add_action('admin_menu', array($this, 'create_intro_menu'));
		add_action('admin_init', array($this, 'register_meng_setting'));
		add_action('wp_head', array($this, 'meng_head_fun'));
	}

	//use register_setting() to store string
	
	function register_meng_setting() {
		
		register_setting($this->option_group, 'meng_option');

		
		$setting_section = 'meng_setting_section';
		add_settings_section(
			$setting_section,
			'',
			array($this, 'meng_setting_section_function'), 
			$this->option_group
		);

		// setting color
		add_settings_field(
			'hc_test_color',
			'Font-Color',
			array($this, 'hc_test_color_function'),
			$this->option_group,
			$setting_section
		);

		// setting font size
		add_settings_field(
			'hc_test_size',
			'Font-Size',
			array($this, 'hc_test_size_function'),
			$this->option_group,
			$setting_section
		);

		// setting font weight
		add_settings_field(
			'hc_test_bold',
			'Font-Weight',
			array($this, 'hc_test_bold_function'),
			$this->option_group,
			$setting_section
		);
}

	
	function meng_setting_section_function() {
		?> <p>Setting Font Style</p> <?php
	}

	// Setting font weight
	function hc_test_bold_function() {
		$hc_test_option = get_option("meng_option");
		$bold = $hc_test_option['bold'];
		?>
			<input type="checkbox" name="meng_option[bold]" value="1" <?php checked(1, $bold);?> /> Bold
		<?php
	}


	// Setting font color
	function hc_test_color_function() {
		$hc_test_option = get_option("meng_option");
		$color = $hc_test_option['color'];

		?>
			<input type="text" name="meng_option[color]" value="<?php echo $color;?>">
		<?php
	}


	// setting font size
	function hc_test_size_function() {
		$hc_test_option = get_option("meng_option");
		$size = $hc_test_option['size'];
		?>
		<select name="meng_option[size]">
			<option value="12" <?php selected('12', $size); ?>> 12 </option>
			<option value="14" <?php selected('14', $size); ?>> 14 </option>
			<option value="16" <?php selected('16', $size); ?>> 16 </option>
			<option value="18" <?php selected('18', $size); ?>> 18 </option>
			<option value="20" <?php selected('20', $size); ?>> 20 </option>

		</select>
		<?php

	}


	function create_menu() {

		// Create Top Menu
		add_menu_page(
			'Meng Plugin First Page',
			'Meng Plugin',
			'manage_options',
			'Meng_Plugin',
			array($this, 'settings_page'),
			plugins_url($this->icon_url , __FILE__)
			);
	}

	function create_intro_menu() {
		// Create Intro Menu
		add_submenu_page(
			'Meng_Plugin',
			'Meng Plugin Intro Page',
			'Getting Start',
			'manage_options',
			'Meng_Plugin_Intro',
			array($this, 'introduce_page')
		);
	}


	function settings_page() {
		?>
			<div class="wrap">
				<h2>Top Menu</h2>
				<form action="options.php" method="post">
					<?php
						
						// Output necessary string
						settings_fields($this->option_group);

						
						do_settings_sections($this->option_group);

						// Output button
						submit_button();


					?>

				</form>

			</div>
		<?php
	}

	function introduce_page() {

		?>
			<br>
			<br>
			<br>
			<center>
				<iframe width="1047" height="589" src="https://www.youtube.com/embed/SJxGvjdUXn4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				
				<?php
					
					echo "<p>More Information, Please contract <a href=mailto:mjd64929@icloud.com >jiadong@icloud.com</a> </p>";
					echo "<p>Copyright © 2018-" . date("Y") . " <a href='www.jiadong.work'>John Mai</a></p>";
				?>
			</center>
			
		<?php
	}


	function meng_head_fun() {
		$hc_test_option = get_option("meng_option");
		$color = $hc_test_option['color'];
		$size = $hc_test_option['size'];
		$bold = $hc_test_option["bold"] == 1? "bold" : "normal";
	
		?> 
		<style type="text/css">
			body {
				color: <?php echo $color ?>; 
				font-size: <?php echo $size ?>px; 
				font-weight: <?php echo $bold ?>;
			}	

		</style>

		<?php
}

}

new meng_font_style();




