<?php

add_post_type_support('page', 'excerpt');
add_action('wp_enqueue_scripts', 'brunch_scripts', 100);
add_filter('the_title', 'number_styling', 10, 2);
add_filter('body_class', 'number_body_class');

function brunch_scripts()
{
    $uri = get_stylesheet_directory_uri() . '/public';
    wp_enqueue_style('optimus_primer', $uri . '/css/app.css', array('petal-style', 'petal_options_style'), null);
    wp_enqueue_script('brunch_js_vendor', $uri . '/js/vendor.js', array('jquery'), null, true);
    wp_enqueue_script('brunch_js_app', $uri . '/js/app.js', array('jquery'), null, true);
}

function number_styling($title, $id = null)
{
    if (!is_admin()) {
        if (preg_match('/^([0-9\.]+)\s(.*)$/', $title, $matches)) {
            $title = '<span class="number">' . $matches[1] . '</span> ' . $matches[2];
        }
    }
    return $title;
}

function number_body_class($classes)
{
    $add = array();
    $title = the_title_attribute(array('echo' => false));
    if (preg_match('/^([0-9\.]+)\s(.*)$/', $title, $matches)) {
        $number = $matches[1];
        if ($number) {
            array_push($add, "page-number");
            $stack = array();
            foreach (explode('.', $number) as $comp) {
                array_push($stack, $comp);
                array_push($add, "page-number-" . implode(".", $stack));
            }
        }
    }
    return array_merge($classes, $add);
}