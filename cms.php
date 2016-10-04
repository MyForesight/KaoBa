<?php get_header();?>
	<div id="content" class="site-content">
	<div class="clear"></div>
	<?php if (get_option('ygj_ddad') == '关闭') { ?>
				<?php { echo ''; } ?>
				<?php } else { include(TEMPLATEPATH . '/inc/ad/ad_dhl.php');  } ?>
		<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if (get_option('ygj_hdpkg') == '关闭') { ?>
		<?php { echo ''; } ?>
		<?php } else { include (TEMPLATEPATH . '/inc/slider.php');} ?>
	<?php if (get_option('ygj_new_p') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/inc/new_post.php'); } ?>
	
<div class="clear"></div>	

	
	<?php if (get_option('ygj_adhx') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/inc/ad/ad_hx.php'); } ?>
<?php if (get_option('ygj_syytsl') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else {	?>	
	<div class="line-big">
		<?php 
		$display_categories = explode(',', get_option('ygj_catldt') ); 
		foreach ($display_categories as $category) { 
			query_posts( array(
				'showposts' => 1,
				'cat' => $category,
				'post__not_in' => $do_not_duplicate
				)
			);
		?>
		<div class="xl3 xm3">
			<div class="cat-box">
				<?php while (have_posts()) : the_post(); ?>
				<h3 class="cat-title"><a href="<?php echo get_category_link($category);?>" title="<?php single_cat_title(); ?>更多文章"><?php single_cat_title(); ?></a></h3>
				<div class="clear"></div>
				<div class="cat-site">
					<div class="item"> 
					<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
			<?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail', array('alt' => get_the_title()));
			} else { ?>
				<img class="home-thumb" src="<?php echo catch_image() ?>" alt="<?php the_title(); ?>" />
			<?php } ?>	
			<span class="txt"><?php the_title(); ?></span>
			<span class="txt-bg"></span>
		</a> 
	</div>
					
			
					<?php endwhile; ?>
					<div class="clear"></div>
					<ul class="cat-list">
					<?php
					query_posts( array(
						'showposts' => get_option('ygj_cat_nddt'),
						'cat' => $category,
						'offset' => 1,
						'post__not_in' => $do_not_duplicate
						)
		 			);
					?>
					<?php while (have_posts()) : the_post(); ?>
						<span class="list-date"><?php the_time('m/d') ?></span>					
						<li class="list-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,50); ?></a></li>	
					<?php endwhile; ?>						
					</ul>

				</div>
			</div>
		</div>
		<?php } ?>
		<div class="clear"></div>	
	</div>
<?php } ?>
<?php if (get_option('ygj_sywtsl') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else {	?>	
	
	
<div class="line-one">
	<?php 
		$display_categoriesdl = explode(',', get_option('ygj_catld') ); 
		foreach ($display_categoriesdl as $categorydl) { ?>
		<?php
			query_posts( array(
				'showposts' => 1,
				'cat' => $categorydl,
				'post__not_in' => $do_not_duplicate
				)
			);
		?>
		<?php while (have_posts()) : the_post(); ?>
		<div class="cat-box">
			<h3 class="cat-title"><span class="syfl"><?php single_cat_title(); ?></span><span class="catmore"><a href="<?php echo get_category_link($categorydl);?>" title="更多<?php single_cat_title(); ?>文章">More></a></span></h3>
			<div class="clear"></div>
			<div class="cat-site">
				<div class="cat-dt">
						<figure class="line-one-thumbnail">		
							<?php get_template_part( 'inc/thumbnail' ); ?>					
						</figure>
						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h2>		
						</header><!-- .entry-header -->
						<div class="entry-content">	
							<div class="archive-content">			 				
								<?php if (has_excerpt()){ echo wp_trim_words( get_the_excerpt(), 80, '...' );} else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 160,"..."); } ?>
							</div>
							<div class="archive-tag">
								<span class="date"><?php  the_time( 'Y-m-d');?></span>
								<span class="views"><?php if( function_exists( 'the_views' ) ) { print '  阅读 '; the_views(); print ' 次  ';  } ;?></span><?php the_tags('', '', '');?></div>
							<div class="clear"></div>
						</div><!-- .entry-content -->
					</div>
				<?php endwhile; ?>
				<ul class="cat-one-list">
				<?php
					query_posts( array(
						'showposts' => get_option('ygj_cat_ndt'),
						'cat' => $categorydl,
						'offset' => 1,
						'post__not_in' => $do_not_duplicate
						)
		 			);
				?>
				<?php while (have_posts()) : the_post(); ?>
				<div class="cat-lists">						
						<div class="item-st"> 
						<div class="thimg">
						<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
							<?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail', array('alt' => get_the_title()));
							} else { ?>
							<img class="home-thumb" src="<?php echo catch_image() ?>" alt="<?php the_title(); ?>" />
							<?php } ?>	
						
						</div>
						<h3><?php the_title(); ?></h3>						
						<p><?php if (has_excerpt()){ echo wp_trim_words( get_the_excerpt(), 34, '...' );} else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 68,"..."); } ?></p>
						<div class="pricebtn"><span class="archive-tag">
								<span class="date"><?php  the_time( 'Y-m-d');?></span>
								<span class="views"><?php if( function_exists( 'the_views' ) ) { print '  阅读 '; the_views(); print ' 次  ';  } ;?></span></span></div>
						</div>
						</a> 
											
					</div>							
				<?php endwhile; ?>						
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>	
	<?php } ?>		
	</div>	
	<?php } ?>
		<div class="clear"></div>			
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<div class="clear"></div>
	</div><!-- .site-content -->				
<?php get_footer();?>