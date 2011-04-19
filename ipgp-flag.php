<?php
/*
Plugin Name: Ipgp User Country Flag
Plugin URI: http://www.ipgp.net
Description: Show user's country flag.
Author: Lucian Apostol
Version: 0.1
Author URI: http://www.ipgp.net
*/


function ipgp_flag() 
{

$ip =  getenv('REMOTE_ADDR'); 


$xml = simplexml_load_file("http://www.ipgp.net/api/xml/". $ip);

// print_r($xml);

if($xml->Flag) { 
  ?>
  <a href="http://www.ipgp.net"><img src="<?=$xml->Flag?>" /></a>

  <?
	}
 }

function ipgpCountryWidget($args) {

//	 extract($args);
//	 echo $before_widget;
	 ipgp_flag();
//	 echo $after_widget;
}

function ip_country_shortcode( $atts ) {
	
	return ipgp_flag();

}





function ipgpInit()
{
  register_sidebar_widget(__('Ipgp Country Flag'), 'ipgpCountryWidget');  
  add_shortcode( 'ipflag', 'ip_country_shortcode' );
}


add_action("plugins_loaded", "ipgpInit");
?>