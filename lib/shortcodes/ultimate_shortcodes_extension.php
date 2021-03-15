<?php
class Post
{
    public static function get_post_field($atts){
        $atts = shortcode_atts( array(
            'id' => null,
            'field' => 'post_title',
            'do_shortcode' => 1,
        ), $atts );
        if (!$atts['id'])
            $atts['id'] = get_the_ID();

        $result = get_post_field($atts['field'], $atts['id']);
        if (!empty($atts['do_shortcode']))
            return do_shortcode($result);

        return $result;
    }

    public static function get_post_thumbnail($atts){
        $atts = shortcode_atts( array(
            'id' => null,
            'size' => 'post-thumbnail',
            'src' => null,
            'class' => null,
            'alt' => null,
            'title' => null,
        ), $atts );
        if (!$atts['id'])
            $atts['id'] = get_the_ID();

        $thumb_attr = array();
        if ($atts['src'])
            $thumb_attr['src'] = $atts['src'];
        if ($atts['class'])
            $thumb_attr['class'] = $atts['class'];
        if ($atts['alt'])
            $thumb_attr['alt'] = $atts['alt'];
        if ($atts['title'])
            $thumb_attr['title'] = $atts['title'];

        return get_the_post_thumbnail($atts['id'], $atts['size'], $thumb_attr);
    }

    public static function get_post_anchor($atts, $content=null){
        $atts = shortcode_atts( array(
            'id' => null,
        ), $atts );
        if (!$atts['id'])
            $atts['id'] = get_the_ID();

        if ($content) {
            $content = do_shortcode($content);

            $post_href = get_permalink($atts['id']);
            $post_title = get_post_field('post_title', $atts['id']);
            $content = "<a href=\"$post_href\" title=\"$post_title\">$content</a>";
        }

        return $content;
    }

}

class Text
{
    public static function trim($atts, $content=null){
        $atts = shortcode_atts( array(
            'chars' => 0,
            'words' => 0,
            'suffix' => '',
            'strip_html' => 0,
            'strip_urls' => 0,
            'strip_shortcodes' => 0,
        ), $atts );

        if ($content) {
            $content = do_shortcode($content);
            $is_trimmed = 0;

            if (!empty($atts['chars']) && strlen($content)>$atts['chars']) {
                $content = substr($content, 0, $atts['chars']);
                $is_trimmed = 1;
            }
            if (!empty($atts['words'])) {
                $content_bywords = explode(' ', $content);
                if (sizeof($content_bywords)>$atts['words']) {
                    $content = implode(' ', array_slice($content_bywords, 0, $atts['words']));
                    $is_trimmed = 1;
                }
            }
            if (!empty($atts['strip_html']))
                $content = wp_strip_all_tags($content);
            if ($is_trimmed)
                $content = rtrim($content).$atts['suffix'];
            if (!empty($atts['strip_urls'])){
                $pattern = "/(http|https|ftp)*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i";
                $content = preg_replace($pattern, ' ', $content);
            }
            if (!empty($atts['strip_shortcodes']))
                $content = strip_shortcodes($content);
        }

        return $content;
    }

}

class Shortcodes
{
    const SHCDS_SUFFIX = 'su_';

    public static function add_shortcodes()
    {
        add_shortcode(self::SHCDS_SUFFIX.'theme_get_post_field', 'Post::get_post_field');
        add_shortcode(self::SHCDS_SUFFIX.'theme_get_post_thumbnail', 'Post::get_post_thumbnail');
        add_shortcode(self::SHCDS_SUFFIX.'theme_get_post_anchor', 'Post::get_post_anchor');
        add_shortcode(self::SHCDS_SUFFIX.'theme_trim', 'Text::trim');
        add_shortcode(self::SHCDS_SUFFIX.'blue_button_call', 'blue_button_call');
        add_shortcode(self::SHCDS_SUFFIX.'trans_button_call', 'trans_button_call');
    }
}

class ShortcodesUltimateExtension
{
    const CUSTOM_GROUP_KEY = 'custom';
    const CUSTOM_GROUP = 'Custom';

    /**
     * Filter to modify original shortcodes data and add custom shortcodes
     *
     * @param array $shortcodes Original plugin shortcodes
     * @return array Modified array
     */
    public static function register_shortcodes($shortcodes)
    {
        $shortcodes['theme_get_post_field'] = array(
            'name' => __('Post Field', 'theme-backoffice'),
            'type' => 'single',
            'group' => self::CUSTOM_GROUP_KEY,
            'atts' => array(
                'id' => array(
                    'default' => '',
                    'name' => __('Post ID', 'theme-backoffice'),
                    'desc' => __('You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', 'theme-backoffice'),
                ),
                'field' => array(
                    'type' => 'select',
                    'values' => array(
                        'ID' => __('Post ID', 'theme-backoffice'),
                        'post_author' => __('Post author', 'theme-backoffice'),
                        'post_date' => __('Post date', 'theme-backoffice'),
                        'post_date_gmt' => __('Post date', 'theme-backoffice') . ' GMT',
                        'post_content' => __('Post content', 'theme-backoffice'),
                        'post_title' => __('Post title', 'theme-backoffice'),
                        'post_excerpt' => __('Post excerpt', 'theme-backoffice'),
                        'post_status' => __('Post status', 'theme-backoffice'),
                        'comment_status' => __('Comment status', 'theme-backoffice'),
                        'ping_status' => __('Ping status', 'theme-backoffice'),
                        'post_name' => __('Post name', 'theme-backoffice'),
                        'post_modified' => __('Post modified', 'theme-backoffice'),
                        'post_modified_gmt' => __('Post modified', 'theme-backoffice') . ' GMT',
                        'post_content_filtered' => __('Filtered post content', 'theme-backoffice'),
                        'post_parent' => __('Post parent', 'theme-backoffice'),
                        'guid' => __('GUID', 'theme-backoffice'),
                        'menu_order' => __('Menu order', 'theme-backoffice'),
                        'post_type' => __('Post type', 'theme-backoffice'),
                        'post_mime_type' => __('Post mime type', 'theme-backoffice'),
                        'comment_count' => __('Comment count', 'theme-backoffice'),
                        'other' => __('Other', 'theme-backoffice'),
                    ),
                    'default' => 'post_title',
                    'name' => __('Field', 'theme-backoffice'),
                    'desc' => __('Post data field name', 'theme-backoffice')
                ),
                'field_other' => array(
                    'default' => '',
                    'name' => __('Field Other', 'theme-backoffice'),
                    'desc' => __('Post data field name if selected Field is Other', 'theme-backoffice'),
                ),
            ),
            'desc' => __('Retrieve data from a post field based on post ID.', 'theme-backoffice'),
            'icon' => 'align-justify',
            'function' => 'get_post_field_pre',
        );

        $shortcodes['theme_trim'] = array(
            'name' => __('Trim', 'theme-backoffice'),
            'type' => 'content',
            'group' => self::CUSTOM_GROUP_KEY,
            'atts' => array(
                'chars' => array(
                    'type' => 'number',
                    'min' => 0,
                    'max' => 100000,
                    'step' => 1,
                    'default' => 0,
                    'name' => __('Characters', 'theme-backoffice'),
                    'desc' => __('Maximum nubmer of characters', 'theme-backoffice'),
                ),
                'words' => array(
                    'type' => 'number',
                    'min' => 0,
                    'max' => 100000,
                    'step' => 1,
                    'default' => 0,
                    'name' => __('Words', 'theme-backoffice'),
                    'desc' => __('Maximum nubmer of words', 'theme-backoffice'),
                ),
                'suffix' => array(
                    'default' => '',
                    'name' => __('Suffix', 'theme-backoffice'),
                    'desc' => __('Use the following suffix if text was trimmed (for e.g. \'...\')', 'theme-backoffice'),
                ),
                'strip_html' => array(
                    'type' => 'bool',
                    'default' => 'yes',
                    'name' => __('Strip HTML', 'theme-backoffice'),
                    'desc' => __('Whether to strip all HTML tags including script and style', 'theme-backoffice'),
                ),
            ),
            'content' => __('', 'theme-backoffice'),
            'desc' => __('Trim content using various factors.', 'theme-backoffice'),
            'icon' => 'scissors',
            'function' => 'Text::trim',
        );

        $shortcodes['theme_get_post_thumbnail'] = array(
            'name' => __( 'Post Thumbnail', 'theme-backoffice' ),
            'type' => 'single',
            'group' => self::CUSTOM_GROUP_KEY,
            'atts' => array(
                'id' => array(
                    'default' => '',
                    'name' => __( 'Post ID', 'theme-backoffice' ),
                    'desc' => __( 'You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', 'theme-backoffice' ),
                ),
                'size' => array(
                    'type' => 'select',
                    'values' => array(
                        'thumbnail' => __( 'Thumbnail', 'theme-backoffice' ),
                        'medium' => __( 'Medium', 'theme-backoffice' ),
                        'large' => __( 'Large', 'theme-backoffice' ),
                        'full' => __( 'Full', 'theme-backoffice' ) . ' GMT',
                        'post-thumbnail' => __( 'Post Thumbnail', 'theme-backoffice' ),
                    ),
                    'default' => 'thumbnail',
                    'name' => __( 'Size', 'theme-backoffice' ),
                    'desc' => __( 'Thumbnail size', 'theme-backoffice' )
                ),
                'src' => array(
                    'default' => '',
                    'name' => __( 'Attribute Source', 'theme-backoffice' ),
                    'desc' => __( 'Thumbnail attribute source (src)', 'theme-backoffice' ),
                ),
                'class' => array(
                    'default' => '',
                    'name' => __( 'Attribute Class', 'theme-backoffice' ),
                    'desc' => __( 'Thumbnail attribute class', 'theme-backoffice' ),
                ),
                'alt' => array(
                    'default' => '',
                    'name' => __( 'Attribute Alternative', 'theme-backoffice' ),
                    'desc' => __( 'Thumbnail attribute alternative (alt)', 'theme-backoffice' ),
                ),
                'title' => array(
                    'default' => '',
                    'name' => __( 'Attribute Title', 'theme-backoffice' ),
                    'desc' => __( 'Thumbnail attribute title', 'theme-backoffice' ),
                ),
            ),
            'desc' => __( 'Gets the Featured Image (formerly called Post Thumbnail) as set in post\'s or page\'s edit screen and returns an HTML image element representing a Featured Image, if there is any, otherwise an empty string.', 'theme-backoffice' ),
            'icon' => 'file-image-o',
            'function' => 'Post::get_post_thumbnail',
        );

        $shortcodes['theme_get_post_anchor'] = array(
            'name' => __( 'Post Anchor', 'theme-backoffice' ),
            'type' => 'single',
            'group' => self::CUSTOM_GROUP_KEY,
            'atts' => array(
                'id' => array(
                    'default' => '',
                    'name' => __( 'Post ID', 'theme-backoffice' ),
                    'desc' => __( 'You can specify custom post ID. Leave this field empty to use an ID of the current post. Current post ID may not work in Live Preview mode', 'theme-backoffice' ),
                ),
            ),
            'desc' => __( 'Retrieve an anchor element linking to the paremeterised post ID.', 'theme-backoffice' ),
            'icon' => 'link',
            'function' => 'Post::get_post_anchor',
        );

        // Add blue_button shortcode
        $shortcodes['blue_button'] = array(
            'name' => __('Blue Button', 'theme'),
            'type' => 'wrap',
            'group' => self::CUSTOM_GROUP_KEY,
            'atts' => array(
                'link' => array(
                    'default' => '',
                    'name' => __('Link', 'ads-backoffice'),
                    'desc' => __('You can specify custom link', 'theme'),
                ),
                'target' => array(
                    'type' => 'select',
                    'values' => array(
                        '_self' => __( 'Default (_self)', 'theme' ),
                        '_blank' => __( 'New Page (_blank)', 'theme' ),
                    ),
                    'default' => '_self',
                    'name' => __('Target', 'theme'),
                    'desc' => __('You can if the button opens a new window', 'theme'),
                ),
            ),
            'content' => __( '', 'theme' ),
            'icon' => 'mouse-pointer ',
            'function' => 'blue_button_call'
        );

        // Add trans_button shortcode
        $shortcodes['trans_button'] = array(
            'name' => __('White Button', 'theme'),
            'type' => 'wrap',
            'group' => self::CUSTOM_GROUP_KEY,
            'atts' => array(
                'link' => array(
                    'default' => '',
                    'name' => __('Link', 'ads-backoffice'),
                    'desc' => __('You can specify custom link', 'theme'),
                ),
                'target' => array(
                    'type' => 'select',
                    'values' => array(
                        '' => __( 'Default (_self)', 'theme' ),
                        'btn-lg' => __( 'New Page (_blank)', 'theme' ),
                    ),
                    'default' => '',
                    'name' => __('Target', 'theme'),
                    'desc' => __('You can if the button opens a new window', 'theme'),
                ),
            ),
            'content' => __( '', 'theme' ),
            'icon' => 'mouse-pointer ',
            'function' => 'trans_button_call'
        );

        return $shortcodes;
    }

    public static function get_post_field_pre($atts)
    {
        if ($atts['field'] === 'other')
            $atts['field'] = $atts['field_other'];

        return Post::get_post_field($atts);
    }


    /**
     * Function to add 'Custom' group
     */
    public static function add_groups($groups)
    {
        $groups[self::CUSTOM_GROUP_KEY] = __(self::CUSTOM_GROUP, 'theme-backoffice');

        return $groups;
    }

    /**
     * Function to show admin notice if Shortcodes Ultimate is not installed
     */
    public static function theme_admin_notice()
    {
        // Check that plugin is installed
        if (function_exists('shortcodes_ultimate')) return;
        // If plugin isn't installed, show notice
        echo '<div class="error">For full functionality of this theme you need to install and activate plugin <strong>Shortcodes Ultimate</strong>. <a href="' . admin_url('plugin-install.php?tab=search&s=shortcodes+ultimate') . '">Install now</a></div>';
    }


    public static function sort_shortcodes($shortcodes)
    {
        uasort($shortcodes,
            function ($a, $b) {
                return strnatcmp($a['name'], $b['name']);
            });

        return $shortcodes;
    }

}

Shortcodes::add_shortcodes();
add_filter('su/data/groups', 'ShortcodesUltimateExtension::add_groups', 1000);
add_filter('su/data/shortcodes', 'ShortcodesUltimateExtension::register_shortcodes', 1000);
add_filter('su/data/shortcodes', 'ShortcodesUltimateExtension::sort_shortcodes', 1000);
add_action('admin_notices', 'ShortcodesUltimateExtension::theme_admin_notice', 1000);