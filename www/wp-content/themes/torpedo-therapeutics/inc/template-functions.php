<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Torpedo_Therapeutics
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function torpedo_therapeutics_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}else {
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'torpedo_therapeutics_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function torpedo_therapeutics_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'torpedo_therapeutics_pingback_header' );

/**
 *  Adding picture tag in wp_get_attachment_image.
 */

function wrap_wp_get_attachment_image_with_picture_tag($html, $attachment_id, $size, $icon, $attr)
{
    if (is_admin())
        return $html;
    $html = preg_replace('/class=".*?"/', '', $html);
    $html = preg_replace('/data-aos=".*?"/', '', $html);
    $html = preg_replace('/animation=".*?"/', '', $html);
    $html = '<picture class="' . $attr['class'] . '" data-aos="' . $attr['animation'] . '" >' . $html . '</picture>';
    return $html;
}

add_filter('wp_get_attachment_image', 'wrap_wp_get_attachment_image_with_picture_tag', 20, 5);

////////////////////////////////////////////////////////////////////////////////////////////////////


function fed_field($meta_type = "post", $object_id, $meta_key = '', $single = false)
{
    return  get_metadata($meta_type, $object_id, $meta_key, $single);
}
function acf_field($meta_key = null, $post_id = null, $meta_type = null)
{
    global $wp_query;
    $meta_type = $meta_type ? $meta_type : "post";
    $single = "true";

    if ($meta_type == 'post') {
        $object_id = $post_id ? $post_id : get_the_ID();
    } elseif ($meta_type == 'term') {
        $object_id = $post_id ? $post_id : $wp_query->get_queried_object()->term_id;
    }

    return fed_field($meta_type, $object_id, $meta_key, $single);
}

function acf_repeater($repeater_key, $post_id = null,  $sub_repeatkey = null, $meta_type = null)
{
    global $wp_query;
    $meta_type = $meta_type ? $meta_type : "post";
    $single = "true";
    if ($sub_repeatkey != null) {
        $sub_repeater = $repeater_key . '_' . $sub_repeatkey;
    } else {
        $sub_repeater = $repeater_key;
    }

    if ($meta_type == 'post') {
        $object_id = $post_id ? $post_id : get_the_ID();
    } elseif ($meta_type == 'term') {
        $object_id = $post_id ? $post_id : $wp_query->get_queried_object()->term_id;
    }

    $repeats = fed_field($meta_type, $object_id, $sub_repeater, $single);
    $repeat_fields = array();
    if (!empty($repeats)) {
        $i = 0;
        while ($i < $repeats) {
            array_push($repeat_fields, $sub_repeater . '_' . $i);
            $i++;
        }
    }
    return $repeat_fields;
}


function acf_subfield($repeater_key,  $subfield_key, $post_id = null)
{

    $object_id = $post_id ? $post_id : get_the_ID();
    $key = $repeater_key . '_' . $subfield_key;

    return acf_field($key, $object_id);
}


function acf_option($field_key,  $sub_field = null,  $acf = true)
{
    if ($sub_field != null) {
        $field = $field_key . '_' . $sub_field;
        // $acf=false;
    } else {
        if ($acf == true) {
            $field = 'options_' . $field_key;
            // var_dump($field);
        } else {
            $field = $field_key;
        }
    }
    return get_option($field);
}
function acf_option_repeater($repeater_key = null,  $repeater_field, $acf = true)
{
    if ($repeater_key != null) {
        $sub_repeater = $repeater_key . '_' . $repeater_field;
        $acfu = false;
    } else {
        $sub_repeater = 'options_' . $repeater_field;
        $acfu = false;
    }

    $repeats = acf_option($sub_repeater, null, $acfu);

    $repeat_fields = array();
    if (!empty($repeats)) {
        $i = 0;
        while ($i < $repeats) {
            array_push($repeat_fields, $sub_repeater . '_' . $i);
            $i++;
        }
    }
    return $repeat_fields;
}
function acf_flexible($repeater_key, $post_id = null, $sub_repeatkey = null, $meta_type = null)
{
    global $wp_query;
    $meta_type = $meta_type ? $meta_type : "post";
    $single = "true";
    if ($sub_repeatkey != null) {
        $sub_repeater = $sub_repeatkey . '_' . $repeater_key;
    } else {
        $sub_repeater = $repeater_key;
    }

    if ($meta_type == 'post') {
        $object_id = $post_id ? $post_id : get_the_ID();
    } elseif ($meta_type == 'term') {
        $object_id = $post_id ? $post_id : $wp_query->get_queried_object()->term_id;
    }
    $repeats = fed_field($meta_type, $object_id, $sub_repeater, $single);
    $repeat_fields = array();

    if (!empty($repeats)) {
        foreach ($repeats as $cnt => $repeat) {
            $repeat_fields[$repeat] = $sub_repeater . '_' . $cnt;
        }
    }
    return $repeat_fields;
}

function acf_flexible_option($repeater_key, $post_id = null,  $sub_repeatkey = null, $meta_type = null, $acf = true)
{

    if ($sub_repeatkey != null) {
        $sub_repeater = $sub_repeatkey . '_' . $repeater_key;
        $acfu = false;
    } else {
        $sub_repeater = 'options_' . $repeater_key;
        $acfu = false;
    }

    $repeats = acf_option($sub_repeater, null, $acfu);
    $repeat_fields = array();
    if (!empty($repeats)) {
        foreach ($repeats as $cnt => $repeat) {
            $repeat_fields[$repeat] = $sub_repeater . '_' . $cnt;
        }
    }
    return $repeat_fields;
}


/*******************************************************
 * Function to return the ACF Link field array object **
 *******************************************************/
function ss_get_btn_link_title_and_target($button)
{
    if (!is_array($button)) return;
    if (class_exists('ACF')) {
        $btn_title = $button['title'];
        $btn_link = $button['url'];
        $btn_target = $button['target'] ? $button['target'] : '_self';
        $btn_details = array(
            'title' => esc_html($btn_title),
            'url' => esc_url( $btn_link),
            'target' => esc_attr( $btn_target)
        );
        return $btn_details;
    }
}