
<?php
/**
 * Plugin Name: Snippets SE
 * Plugin URI: http://www.mattvona.com/work
 * Description: Adds a custom variable like experience. Create a new snippet and then add it to your page by typing the snippet word in curly brackets: {{snippet}}
 * Version: 0.0.1
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

	$count = count($words);
	if ($count > 0) {
		for($i = 0; $i <= $count; $i++) {
			$content = str_replace('{{'.$words[$i]['word'].'}}', $words[$i]['result'], $content);
		}
	}
	return $content;
}

add_filter('the_content', 'scanVar');
add_filter('widget_title', 'scanVar');
add_filter('widget_text', 'scanVar');
add_filter('the_content', 'scanVar');
add_filter('the_excerpt', 'scanVar');
add_filter('the_title', 'scanVar');
add_filter('get_the_excerpt', 'scanVar');
