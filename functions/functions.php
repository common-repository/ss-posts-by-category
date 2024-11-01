<?php
function sspbc_debug( $data )
{
	echo '<textarea style="width:100%; height: 400px">';
	echo print_r( $data, true );
	echo '</textarea>';
}

function sspbc_get_user_display_name( $user_id )
{
	$user = get_userdata($user_id);
	if ( $user === FALSE ){
		throw new Exception( 'invalid user id:' . $user_id );
	}
	return $user->display_name;
}

function sspbc_show_posts_in_category( $category, $level )
{
	$cat_id = $category->cat_ID;

	echo '<div class="sspbc-cat level-' . $level . ' cat-id-' . $cat_id . '">' . $category->name . PHP_EOL;
	
	$posts = query_posts( 'category__in=' . $cat_id . '&nopaging=1&orderby=post_title&order=DESC' );
	wp_reset_query();

	if ( is_array($posts) ){
		echo '  <ul class="sspbc-ul">' . PHP_EOL;
		foreach( $posts as $post ){

			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_modified = date( 'Y-m-d H:i', strtotime($post->post_modified) );
			$post_user = sspbc_get_user_display_name( $post->post_author );

			echo '    <li class="sspbc-li">' . PHP_EOL;
			echo '      <a href="' . get_permalink($post_id) . '">' . $post_title . '</a>' . PHP_EOL;
			echo '      <span class="sspbc-postinfo">(' . $post_user . '/' . $post_modified . ')</span>' . PHP_EOL;
			echo '    </li>' . PHP_EOL;

		}
		echo '  </ul>' . PHP_EOL;
	}

	$categories = sspbc_get_child_categories( $cat_id );

	foreach($categories as $cat)
	{
		sspbc_show_posts_in_category( $cat, $level + 1 );
	}
	
	echo '</div>' . PHP_EOL;
}
function sspbc_get_child_categories( $cat_id )
{
	$categories = get_categories('parent=' . $cat_id . '&hide_empty=0');

	return is_array($categories) ? $categories : array();
}
function sspbc_posts_tree( $atts ) {

	extract(shortcode_atts(array(
			'cat_id' => 0,
		), $atts));

	$cat = get_category( $cat_id );
	sspbc_show_posts_in_category( $cat, 0 );

	wp_enqueue_style( 'sspbc-css', SSPBC_PLUGIN_URL . '/css/sspbc.css' );
}
add_shortcode('sspbc_posts_tree', 'sspbc_posts_tree');
