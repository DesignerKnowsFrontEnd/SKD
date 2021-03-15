<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class MediaLibraryExtension{
    public function __construct (){
        add_action('init', array($this, 'add_categories_for_attachments'));
        add_action('restrict_manage_posts', array($this, 'add_attachment_category_filter'));
        add_action('after_setup_theme', array($this, 'images_theme_setup'));
        add_filter('image_size_names_choose', array($this, 'images_tutorial_image'));
    }

    /**
     * Add categories for attachments
     */
    public function add_categories_for_attachments(){

        register_taxonomy(
            'media-category',
            array(
                'attachment',
            ),
            array(
                'labels' => array(
                    'name' => _x('Media Categories', 'media-category', 'theme-backoffice'),
                    'singular_name' => _x('Category', 'media-category', 'theme-backoffice'),
                    'menu_name' => __('Media Categories', 'theme-backoffice'),
                    'all_items' => __('All Media Categories', 'theme-backoffice'),
                    'edit_item' => __('Edit Category', 'theme-backoffice'),
                    'view_item' => __('View Category', 'theme-backoffice'),
                    'update_item' => __('Update Category', 'theme-backoffice'),
                    'add_new_item' => __('Add New Category', 'theme-backoffice'),
                    'new_item_name' => __('New Category Name', 'theme-backoffice'),
                    'parent_item' => __('Parent Category', 'theme-backoffice'),
                    'parent_item_colon' => __('Parent Category:', 'theme-backoffice'),
                    'search_items' => __('Search Categories', 'theme-backoffice'),
                ),
                'show_admin_column' => true,
                'hierarchical' => false
            )
        );

        register_taxonomy_for_object_type('media-category', 'attachment');
    }

    /**
     * Add a category filter to images
     */
    public function add_attachment_category_filter(){
        $screen = get_current_screen();
        if ('upload' == $screen->id) {
            $dropdown_options = array('show_option_all' => __('View all categories', 'theme'), 'hide_empty' => false, 'hierarchical' => true, 'orderby' => 'name', 'taxonomy' => 'media-category');
            wp_dropdown_categories($dropdown_options);
        }
    }

    /**
     * Add custom image sizes
     */
    public function images_theme_setup(){
        add_image_size('page-image', 540, 350, true); // 1110 pixels wide by 460 pixels tall, hard crop mode
    }

    public function images_tutorial_image($sizes){
        return array_merge($sizes, array(
            'page-image' => __('page image (1110x460)'),
        ));
    }
}

$MediaLibraryExtension = new MediaLibraryExtension;