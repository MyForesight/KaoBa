<div class="tab-site">
	<div id="layout-tab">
		<div class="tit">
        <span class="name">相关文章</span>
            <span class="plxiaoshi"><span class="keyword">
            	关键词：<?php the_tags('', '', ''); ?>
            </span></span>
        </div>
		<ul class="tab-bd">
		<?php
		$post_num = get_option('ygj_related_count');
global $post;
$post_tags = wp_get_post_tags($post->ID); 
$i = 0;
if ($post_tags) {
  foreach ($post_tags as $tag) {
    $tag_list[] .= $tag->term_id;
  }
  $args = array(
        'tag__in' => $tag_list,
        'post__not_in' => array($post->ID),
        'showposts' => $post_num, 
        'caller_get_posts' => 1
    );
  query_posts($args);
  if (have_posts()) {
    while (have_posts()) {
      the_post(); update_post_caches($posts); ?>
    <li><span class="post_spliter">•</span><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></li>
<?php
    $i += 1;}
  }
 wp_reset_query();
}
if ( $i < $post_num ) {
    $cats = '';$post_num -= $i;
    foreach (get_the_category() as $cat) $cats.= $cat->cat_ID . ',';
    $args = array(
        'category__in' => explode(',', $cats) ,
        'post__not_in' => explode(',', $exclude_id) ,
        'showposts' => $post_num, 
    );
    query_posts($args);
    while (have_posts()) {
        the_post(); ?>
    <li><span class="post_spliter">•</span><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></li>
<?php
    };
    wp_reset_query();
}
wp_reset_query();
?>
		</ul>
	</div>
</div>
