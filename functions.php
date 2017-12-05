<?php

add_post_type_support('page', 'excerpt');
add_action('wp_enqueue_scripts', 'optimus_primer_scripts', 100);
add_action('wp_enqueue_scripts', 'qtip_disable', 100001);
add_filter('the_title', 'number_styling', 10, 2);
add_filter('body_class', 'number_body_class');

// enqueue child theme CSS, JSs
function optimus_primer_scripts() {
    $uri = get_stylesheet_directory_uri() . '/public';
    wp_enqueue_style('optimus_primer', $uri . '/css/app.css', array('petal-style', 'petal_options_style'), null);
    wp_enqueue_script('optimus_primer_js_vendor', $uri . '/js/vendor.js', array('jquery'), null, true);
    wp_enqueue_script('optimus_primer_js_app', $uri . '/js/app.js', array('jquery', 'optimus_primer_js_vendor'), null, true);
}

// debug function - show enqueued/registered scripts
function dump_scripts(){
    global $wp_scripts;
    print '<!--wp_scripts=';
    print_r($wp_scripts);
    print '-->';
}

// dequeue qtip, ithoughts_tooltip_glossary-qtip
function qtip_disable() {
    wp_dequeue_script('ithoughts_tooltip_glossary-qtip');
    wp_deregister_script('ithoughts_tooltip_glossary-qtip');
    wp_dequeue_script('qtip');
    wp_deregister_script('qtip');
}

function number_styling($title, $id = null) {
    if (!is_admin()) {
        if (preg_match('/^([0-9\.]+)\s(\w+)(.*)$/', $title, $matches)) {
            $title = '<span class="number">'
                . $matches[1]
                . '</span> <span class="firstWord">'
                . $matches[2]
                . '</span> <span class="nextWords">'
                . $matches[3]
                . '</span>';
        }
    }
    return $title;
}

function number_body_class($classes) {
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

/* ============================================================================================================================================= */


function pixelwars_create_post_type_book() {
    $labels = array('name' => __('Books', 'read'),
        'singular_name' => __('Book', 'read'),
        'add_new' => __('Add New', 'read'),
        'add_new_item' => __('Add New', 'read'),
        'edit_item' => __('Edit', 'read'),
        'new_item' => __('New', 'read'),
        'all_items' => __('All', 'read'),
        'view_item' => __('View', 'read'),
        'search_items' => __('Search', 'read'),
        'not_found' => __('No Items found', 'read'),
        'not_found_in_trash' => __('No Items found in Trash', 'read'),
        'parent_item_colon' => '',
        'menu_name' => 'Books');


    $args = array('labels' => $labels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'show_in_nav_menus' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'revisions'),
        'rewrite' => array('slug' => 'book', 'with_front' => false));


    register_post_type('book', $args);
}

add_action('init', 'pixelwars_create_post_type_book');


function pixelwars_updated_messages_book($messages) {
    global $post, $post_ID;

    $messages['book'] = array(0 => "", // Unused. Messages start at index 1.

        1 => sprintf(__('<strong>Updated.</strong> <a target="_blank" href="%s">View</a>', 'read'), esc_url(get_permalink($post_ID))),

        2 => __('Custom field updated.', 'read'),

        3 => __('Custom field deleted.', 'read'),

        4 => __('Updated.', 'read'),

        // translators: %s: date and time of the revision
        5 => isset($_GET['revision']) ? sprintf(__('Restored to revision from %s', 'read'), wp_post_revision_title(( int )$_GET['revision'], false)) : false,

        6 => sprintf(__('<strong>Published.</strong> <a target="_blank" href="%s">View</a>', 'read'), esc_url(get_permalink($post_ID))),

        7 => __('Saved.', 'read'),

        8 => sprintf(__('Submitted. <a target="_blank" href="%s">Preview</a>', 'read'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),

        9 => sprintf(__('Scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview</a>', 'read'),

            // translators: Publish box date format, see http://php.net/date
            date_i18n(__('M j, Y @ G:i', 'read'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),

        10 => sprintf(__('<strong>Item draft updated.</strong> <a target="_blank" href="%s">Preview</a>', 'read'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))));


    return $messages;
}

add_filter('post_updated_messages', 'pixelwars_updated_messages_book');


function pixelwars_book_columns($book_columns) {
    $book_columns = array('cb' => '<input type="checkbox">',
        'title' => __('Title', 'read'),
        'book_image' => __('Book Image', 'read'),
        'book_author' => __('Book Author', 'read'),
        'author' => __('Author', 'read'),
        'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
        'date' => __('Date', 'read'));


    return $book_columns;
}

add_filter('manage_edit-book_columns', 'pixelwars_book_columns');


function pixelwars_custom_columns_book($book_column) {
    global $post, $post_ID;

    switch ($book_column) {
        case 'book_image':

            $book_cover_image = stripcslashes(get_option($post->ID . 'book_cover_image', ""));

            if ($book_cover_image != "") {
                ?>
                <img style="max-height: 150px;" alt="<?php the_title_attribute(); ?>"
                     src="<?php echo $book_cover_image; ?>">
                <?php
            }

            break;

        case 'book_author':

            $taxonomy = 'book_author';

            $terms_list = get_the_terms($post_ID, $taxonomy);

            if (!empty($terms_list)) {
                $out = array();

                foreach ($terms_list as $term_list) {
                    $out[] = '<a href="edit.php?post_type=book&book_author=' . $term_list->slug . '">' . $term_list->name . ' </a>';
                }

                echo join(', ', $out);
            }

            break;
    }
}

add_action('manage_posts_custom_column', 'pixelwars_custom_columns_book');


function pixelwars_taxonomy_book() {
    $labels_cat = array('name' => __('Book Authors', 'read'),
        'singular_name' => __('Book Author', 'read'),
        'search_items' => __('Search', 'read'),
        'all_items' => __('All', 'read'),
        'parent_item' => __('Parent', 'read'),
        'parent_item_colon' => __('Parent:', 'read'),
        'edit_item' => __('Edit', 'read'),
        'update_item' => __('Update', 'read'),
        'add_new_item' => __('Add New', 'read'),
        'new_item_name' => __('New Name', 'read'),
        'menu_name' => __('Book Authors', 'read'));


    register_taxonomy('book_author',
        array('book'),
        array('hierarchical' => true,
            'labels' => $labels_cat,
            'show_ui' => true,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'book_author')));


    $labels_tag = array('name' => __('Book Tags', 'read'),
        'singular_name' => __('Book Tag', 'read'),
        'search_items' => __('Search', 'read'),
        'all_items' => __('All', 'read'),
        'parent_item' => __('Parent Tag', 'read'),
        'parent_item_colon' => __('Parent Tag:', 'read'),
        'edit_item' => __('Edit', 'read'),
        'update_item' => __('Update', 'read'),
        'add_new_item' => __('Add New', 'read'),
        'new_item_name' => __('New Tag Name', 'read'),
        'menu_name' => __('Book Tags', 'read'));


    register_taxonomy('book_tag',
        array('book'),
        array('hierarchical' => false,
            'labels' => $labels_tag,
            'show_ui' => true,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'book_tag')));
}

add_action('init', 'pixelwars_taxonomy_book');


function pixelwars_taxonomy_filter_book() {
    global $typenow;

    if ($typenow == 'book') {
        $filters = array('book_author');

        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);

            $tax_name = $tax_obj->labels->name;

            $terms = get_terms($tax_slug);

            echo '<select id="' . $tax_slug . '" name="' . $tax_slug . '" class="postform">';

            echo '<option value="">' . __('Show All', 'read') . ' ' . $tax_name . '</option>';

            foreach ($terms as $term) {
                echo '<option value=' . $term->slug, @$_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '', '>' . $term->name . ' (' . $term->count . ')</option>';
            }

            echo '</select>';
        }
    }
}

add_action('restrict_manage_posts', 'pixelwars_taxonomy_filter_book');


function pixelwars_theme_custom_box_show_book($post) {
    ?>
    <?php
    wp_nonce_field('pixelwars_theme_custom_box_show_book', 'pixelwars_theme_custom_box_nonce_book');
    ?>


    <p>
        <label for="book_buy_url"><?php echo __('Buy URL:', 'read'); ?></label>
        <?php
        $book_buy_url = stripcslashes(get_option($post->ID . 'book_buy_url', ""));

        $book_buy_url_new_tab = get_option($post->ID . 'book_buy_url_new_tab', true);
        ?>
        <input type="text" id="book_buy_url" name="book_buy_url" class="widefat code2"
               value="<?php echo $book_buy_url; ?>">

        <label><input type="checkbox" id="book_buy_url_new_tab"
                      name="book_buy_url_new_tab" <?php if ($book_buy_url_new_tab) {
                echo 'checked="checked"';
            } ?>> <?php echo __('Open link in new tab', 'read'); ?></label>
    </p>


    <hr>


    <p>
        <label for="book_cover_image"><?php echo __('Cover Image:', 'read'); ?></label>
        <?php
        $book_cover_image = stripcslashes(get_option($post->ID . 'book_cover_image', ""));
        ?>
        <input type="text" id="book_cover_image" name="book_cover_image" class="widefat code2 upload"
               value="<?php echo $book_cover_image; ?>">

        <input type="button" class="button upload-button" style="margin-top: 10px;"
               value="<?php echo __('Browse', 'read'); ?>">

        <br>

        <img style="margin-top: 10px; max-height: 150px;" alt="" src="<?php echo $book_cover_image; ?>">
    </p>


    <hr>


    <p>
        <label for="book_side_image"><?php echo __('Side Image:', 'read'); ?></label>
        <?php
        $book_side_image = stripcslashes(get_option($post->ID . 'book_side_image', ""));
        ?>
        <input type="text" id="book_side_image" name="book_side_image" class="widefat code2 upload"
               value="<?php echo $book_side_image; ?>">

        <input type="button" class="button upload-button" style="margin-top: 10px;"
               value="<?php echo __('Browse', 'read'); ?>">

        <br>

        <img style="margin-top: 10px; max-height: 150px;" alt="" src="<?php echo $book_side_image; ?>">
    </p>


    <script>
        jQuery(document).ready(function ($) {
            // Image Upload
            var uploadID = "";

            $('.upload-button').live('click', function () {
                window.send_to_editor = function (html) {
                    imgurl = $('img', html).attr('src');

                    uploadID.val(imgurl);

                    uploadID.trigger('change');

                    tb_remove();
                }

                uploadID = $(this).prev('input');

                formfield = $('.upload').attr('name');

                tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');

                return false;
            });
            // end Image Upload
        });
    </script>
    <?php
}

function pixelwars_theme_custom_box_add_book() {
    add_meta_box('pixelwars_theme_custom_box_book', __('Details', 'read'), 'pixelwars_theme_custom_box_show_book', 'book', 'side', 'low');
}

add_action('add_meta_boxes', 'pixelwars_theme_custom_box_add_book');


function pixelwars_theme_custom_box_save_book($post_id) {
    if (!isset($_POST['pixelwars_theme_custom_box_nonce_book'])) {
        return $post_id;
    }


    $nonce = $_POST['pixelwars_theme_custom_box_nonce_book'];

    if (!wp_verify_nonce($nonce, 'pixelwars_theme_custom_box_show_book')) {
        return $post_id;
    }


    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }


    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }


    update_option($post_id . 'book_buy_url', $_POST['book_buy_url']);
    update_option($post_id . 'book_buy_url_new_tab', $_POST['book_buy_url_new_tab']);
    update_option($post_id . 'book_cover_image', $_POST['book_cover_image']);
    update_option($post_id . 'book_side_image', $_POST['book_side_image']);
}

add_action('save_post', 'pixelwars_theme_custom_box_save_book');
