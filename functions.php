<?php
require_once('inc/customizer.php');
require_once('inc/types/projects.php');

define('GITHUB_USER', 'berkaygeldec');
define('GITHUB_REPO', 'atlas');
class Custom_Mobil_Menu_Walker extends Walker_Nav_Menu {
    
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"mt-8 flex flex-col\">\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        $class_names = 'mb-3 block px-2 font-body text-lg font-medium text-white';
        $output .= $indent . '<li class="">';
        
        $attributes = ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="' . esc_attr($class_names) . '"';
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="group relative mr-6 mb-1"';

        $output .= sprintf(
            '<li%s>
            <div class="absolute left-0 bottom-0 z-20 h-0 w-full opacity-75 transition-all group-hover:h-2 group-hover:bg-yellow"></div>
            <a href="%s" class="relative z-30 block px-2 font-body text-lg font-medium text-primary transition-colors group-hover:text-green dark:text-white dark:group-hover:text-secondary">%s</a>',
            $class_names,
            esc_url($item->url),
            apply_filters('the_title', $item->title, $item->ID)
        );
    }

    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= '</li>';
    }
}
class ThemeSetup {
    public function __construct() {
        add_action('init', [$this, 'register_my_menus']);
        add_action('wp_ajax_nopriv_loadmore', [$this, 'loadmore_ajax_handler']);
        add_action('wp_ajax_loadmore', [$this, 'loadmore_ajax_handler']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_loadmore_script']);
        add_action('admin_notices', [$this, 'github_update_notice']);
        add_filter('admin_footer_text', [$this, 'remove_footer_admin']);
        add_action('init', [$this, 'disable_embeds_code_init'], 9999);
        add_action('wp_default_scripts', [$this, 'remove_jquery_migrate']);
        add_filter('pre_comment_approved', [$this, 'disable_pingback_trackback'], 10, 2);
        
        // Gereksiz meta etiketlerini kaldır
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);

        // XML-RPC kapat
        add_filter('xmlrpc_enabled', '__return_false');

        // Emoji scriptini kapat
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        
        // Veritabanı sürüm numarasını gizle
        remove_action('wp_head', 'wp_generator');
    }

    public function register_my_menus() {
        register_nav_menus(['primary' => __('Birincil menü')]);
    }

    public function get_category_label($index) {
        $labels = [
            'bg-green-light text-green',
            'bg-grey-light text-blue-dark',
            'bg-blue-light text-blue',
            'bg-yellow-light text-yellow-dark'
        ];
        return $labels[$index % count($labels)];
    }

    public function get_post_reading_time($content) {
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);
        return $reading_time . ' dakika';
    }

    public function loadmore_ajax_handler() {
        $paged = $_POST['page'] + 1;

        $args = array(
            'posts_per_page' => get_theme_mod('custom_post_count', 3),
            'paged' => $paged
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) :
            $counter = 0;
            while ($the_query->have_posts()) : $the_query->the_post();
                $category = get_the_category();
                $category_name = !empty($category) ? esc_html($category[0]->name) : 'Uncategorized';
                $category_class = $this->get_category_label($counter);
                $reading_time = $this->get_post_reading_time(get_the_content());
                ?>
                <div class="border-b border-grey-lighter pb-8 pt-10">
                    <span class="mb-4 inline-block rounded-full px-2 py-1 font-body text-sm <?php echo $category_class; ?>">
                        <?php echo $category_name; ?>
                    </span>
                    <a href="<?php the_permalink(); ?>"
                       class="block font-body text-lg font-semibold text-primary transition-colors hover:text-green dark:text-white dark:hover:text-secondary">
                        <?php the_title(); ?>
                    </a>
                    <div class="flex items-center pt-4">
                        <p class="pr-2 font-body font-light text-primary dark:text-white">
                            <?php echo get_the_date(); ?>
                        </p>
                        <span class="font-body text-grey dark:text-white">//</span>
                        <p class="pl-2 font-body font-light text-primary dark:text-white">
                            <?php echo $reading_time; ?>
                        </p>
                    </div>
                </div>
                <?php
                $counter++;
            endwhile;
        endif;

        wp_reset_postdata();
        die;
    }

    public function enqueue_loadmore_script() {
        global $wp_query;
        wp_enqueue_script('jquery');
        wp_register_script('loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery'));
        wp_enqueue_script('loadmore');

        wp_localize_script('loadmore', 'loadmore_params', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages
        ));
    }

    public function check_github_update() {
        $current_version = wp_get_theme()->get('Version');
        $style_css_url = 'https://raw.githubusercontent.com/' . GITHUB_USER . '/' . GITHUB_REPO . '/main/style.css';

        $response = wp_remote_get($style_css_url);
        
        if (is_wp_error($response)) {
            error_log('style.css dosyası indirilemedi: ' . $response->get_error_message());
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        
        if (preg_match('/Version:\s*([\d.]+)/i', $body, $matches)) {
            $latest_version = $matches[1];
            
            if (version_compare($current_version, $latest_version, '<')) {
                return $latest_version;
            }
        } else {
            error_log('style.css dosyasında sürüm bilgisi bulunamadı.');
        }

        return false;
    }

    public function github_update_notice() {
        $new_version = $this->check_github_update();
        if ($new_version) {
            echo '<div class="notice notice-warning is-dismissible">
                <p>Yeni bir tema güncellemesi mevcut <a href="' . esc_url('https://github.com/' . GITHUB_USER . '/' . GITHUB_REPO . '/releases/latest') . '" target="_blank">buradan indir</a>.</p>
            </div>';
        }
    }

    public function remove_footer_admin() {
        echo '<a href="https://www.berkaygeldec.com.tr" target="_blank" title="Berkay GELDEÇ">Berkay GELDEÇ</a>  tarafından <span style="color:#b70000;">&#10084;</span> ile geliştirildi.';
    }

    public function disable_embeds_code_init() {
        if (!is_admin()) {
            remove_action('wp_head', 'wp_oembed_add_host_js');
        }
    }

    public function remove_jquery_migrate($scripts) {
        if (!is_admin() && isset($scripts->registered['jquery'])) {
            $script = $scripts->registered['jquery'];
            
            if ($script->deps) {
                $script->deps = array_diff($script->deps, array('jquery-migrate'));
            }
        }
    }

    public function disable_pingback_trackback($data, $post_id) {
        if ('pingback' === $data['ping_status'] || 'open' === $data['comment_status']) {
              $data['ping_status'] = 'closed';
              $data['comment_status'] = 'closed';
          }
          return $data;
    }
}

new ThemeSetup();
?>