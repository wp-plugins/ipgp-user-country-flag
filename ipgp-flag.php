<?php
/*
Plugin Name: Ipgp User Country Flag
Plugin URI: http://www.ipgp.net
Description: Show user's country flag.
Author: Lucian Apostol
Version: 0.4
Author URI: http://www.ipgp.net
*/


function ipgp_flag() 
{

$ip =  getenv('REMOTE_ADDR'); 


       	$api_key=get_option('acces_key');
       	$api_key = 'wordpressplugin';
        	$file = "http://www.ipgp.net/api/json/".$ip."/".$api_key."";
        	//echo $file;
        	$json = file_get_contents($file);
        	$json = substr($json, 9);
        	$json = substr($json, 0, -2);
        	$api = json_decode($json);
        	$api = $api->Details;
        	$xml = $api;

// print_r($xml);

if($xml->flag && $xml->code) { 
  ?>
  <a href="http://www.ipgp.net" rel="nofollow"><img src="<?=$xml->flag?>" /></a>

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