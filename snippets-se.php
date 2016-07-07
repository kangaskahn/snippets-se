
<?php
/**
 * Plugin Name: Snippets SE
 * Plugin URI: http://www.mattvona.com/work
 * Description: Adds a custom variable like experience. Create a new snippet and then add it to your page by typing the snippet word in curly brackets: {{snippet}}
 * Version: 1.0.0
 * Author: Matt Vona
 * Author URI: http://mattvona.com
 * License: GPL2
 */

//* Add Snippets Page
include('lib/snippets_cpt.php');

//file_get_contents
function scanVar($content) {
	$word;
	$words = array();
	$args = array( 'post_type' => array( 'snippet' ));
	$myposts = get_posts( $args );
	foreach( $myposts as $post ) : setup_postdata($post); 
		$word = array(
				'word' => $post->post_title,
				'result' => $post->post_content
			);
		 array_push($words, $word); 
	endforeach;

	wp_reset_postdata();
	//$count = count($words);
	$i = 0;
	foreach($words as $word) {
		//print_r($word);
		$content = str_replace('{{'.$word['word'].'}}', $word['result'], $content);
		$i++;
	}
	return $content;
}

/* Add necessary filters for Site */
add_filter('the_content', 		'scanVar');
add_filter('widget_title', 		'scanVar');
add_filter('widget_text', 		'scanVar');
add_filter('the_excerpt', 		'scanVar');
add_filter('the_title', 		'scanVar');
add_filter('get_the_excerpt', 	'scanVar');
