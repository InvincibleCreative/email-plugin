<?php
/**
 * @package Exygy Email
 * @version 0.1
 */
/*
Plugin Name: Exygy Email
Plugin URI: http://invinciblecreative.com/demos/exygy/
Description: 
Author: Vince DePalma
Version: 0.1
Author URI: http://invinciblecreative.com/
*/

add_action('publish_post', 'send_admin_email');

function send_admin_email($post_id){
	$to = 'exygy@invinciblecreative.com';
	$subject = 'New Post at Exygy';
	$hi = 'Extra! Extra! Read all about it: ';
	$title = get_the_title( $post_id );
	
	$this_postid = $post_id;
	$content_post = get_post($this_postid);
	
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$email_content = strip_tags($content);

	$authorID = $content_post->post_author;
	$author = get_the_author_meta('nickname', $authorID);
	
	$date_publish = $content_post->post_date_gmt;
	$date_revise = $content_post->post_modified_gmt;
	
	$compare_publish = strtotime($date_publish);
	$compare_revise = strtotime($date_revise);

	
	$message = $hi . "\r\n" . $title . " - Written by " . $author . "\r\n\r\n" . $email_content;
	
	
	if ( $date_publish === $date_revise ) {
			wp_mail($to,$subject,$message);
		}
		
}

?>
