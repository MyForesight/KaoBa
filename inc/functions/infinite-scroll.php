<?php
function custom_infinite_scroll_js() {
    if ( !is_singular() ) {
        ?>
        <script type="text/javascript">
        $(document).ready(function(){
            var infinite_scroll = {
                loading: {
                    img: "<?php echo get_template_directory_uri(); ?>/images/infinite.gif",
                    msgText: "",
                    finishedMsg: "木有了！"
                },
                nextSelector:"#nav-below .nav-previous a",
                navSelector:"#nav-below",
                itemSelector:"article",
				maxPage:"7",
                contentSelector:"#post_list_box"
            };
            $( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
        });
        </script>
        <?php
    }
}

add_action('wp_footer', 'custom_infinite_scroll_js', 100);
    
/**
 * force WordPress to return a 404.
 */
function custom_paged_404_fix() {
    global $wp_query;
    if (is_404() || !is_paged() || 0 != count($wp_query->posts))
        return;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
}

add_action('wp', 'custom_paged_404_fix');
?>