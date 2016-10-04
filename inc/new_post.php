 <div id="post_list_box" class="border_gray">
 <?php
	$scrollcount = get_option('ygj_new_post');
 ?>
<?php query_posts('&showposts='.$scrollcount.'&ignore_sticky_posts=10.&cat='.get_option('ygj_new_exclude')); while ( have_posts() ) : the_post();$do_not_duplicate[] = $post->ID; ?>

<article id="post-<?php the_ID(); ?>" class="archive-list">
		<figure class="thumbnail">		
			<?php get_template_part( 'inc/thumbnail' ); ?>					
		</figure>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h2>		
		</header><!-- .entry-header -->
		
		<div class="entry-content">
			
			<span class="entry-meta">
				<span class="post_cat">
				<?php 
					$category = get_the_category(); 
					if($category[0]){
					echo '<a href='.get_category_link($category[0]->term_id ).'>'.$category[0]->cat_name.'</a>';
					}
				?>
			</span>
				<span class="post_spliter">•</span>
				<span class="date" title="<?php the_time( 'Y/m/d H:i');?>"><?php
        echo timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))) ?></span>			
			</span>		
			
			<div class="archive-content">			 				
				<?php if (has_excerpt()){ echo wp_trim_words( get_the_excerpt(), 80, '...' );} else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 160,"..."); } ?>
			</div>
			<div class="archive-tag"><span class="views"><?php if( function_exists( 'the_views' ) ) { print '  阅读 '; the_views(); print ' 次  ';  } ;?></span><?php the_tags('', '', '');?></div>
			<div class="clear"></div>
		</div><!-- .entry-content -->
	</article><!-- #post -->

 	<!-- ad -->
	<?php if ($wp_query->current_post == 0) : ?>
	<?php if (get_option('ygj_adh') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/inc/ad/ad_h.php'); } ?>
	<?php endif; ?>	
	<!-- end: ad -->
<?php endwhile; ?>
</div>