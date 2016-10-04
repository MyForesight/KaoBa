<?php get_header();?>
<div id="content" class="site-content">	
	<div class="clear"></div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="single_info">
							<span class="xiaoshi">
								<?php if(get_post_meta($post->ID, 'wzurl', true)){$wzurl = get_post_meta($post->ID, 'wzurl', true);}else{$wzurl=get_the_permalink();}?>
								<?php if(get_post_meta($post->ID, 'wzzz', true)){$wzzz = get_post_meta($post->ID, 'wzzz', true);}else{$wzzz=get_the_author();}?>
								<?php if (!get_option('ygj_post_wzlx') ) { ?>
									<span class="leixing">
										<?php if ( get_post_meta($post->ID, 'tgwz', true) ) { ?>
											<span class="tglx">投稿</span>
										<?php } elseif ( get_post_meta($post->ID, 'zzwz', true) ) { ?>
											<span class="zzlx">转载</span>
										<?php } else { ?>
											<span class="yclx">原创</span>
										<?php } ?>
									</span>
								<?php } ?>
								<?php if (!get_option('ygj_post_author') ) { ?>
									<a href="<?php echo $wzurl; ?>" rel="nofollow" target="_blank"><?php echo $wzzz; ?></a>&nbsp;
								<?php } ?>
							</span>
							<span class="date"><?php the_time( 'Y-m-d H:i' ) ?>&nbsp;</span>
							<span class="views"><?php if( function_exists( 'the_views' ) ) { print '  阅读 '; the_views(); print ' 次  ';  } ;?></span>
							
								
					
					<?php if (get_option('ygj_post_comment') ) { ?>
					<span class="comment"><?php comments_popup_link( ' 评论 0 条', ' 评论 1 条', ' 评论 % 条' ); ?></span>
					<?php } ?>
					
							<span class="edit"><?php edit_post_link('编辑', '  ', '  '); ?></span>
						</div>		
					</header><!-- .entry-header -->

					<?php if (get_option('ygj_g_single') == '关闭') { ?>
					<?php { echo ''; } ?>
					<?php } else { include(TEMPLATEPATH . '/inc/ad/ad_single.php'); } ?>
					<?php if ( has_excerpt() ) { ?>
						<span class="abstract"><strong>摘要：</strong><?php the_excerpt() ?></span>
					<?php } ?>
					<div class="entry-content">
						<div class="single-content">			
							<?php the_content(); ?>
<div class="bd-reward-stl"><button id="bdRewardBtn"><span></span></button></div>
<script type="text/javascript" src="https://zz.bdstatic.com/zzdashang/js/bd-zz-reward.js"></script>
							<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
							<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
							<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span>下一页</span>")); ?>			
						</div>
						<div class="clear"></div>
						<div class="xiaoshi">
							<div class="single_banquan">	
								<strong>本文地址：</strong><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"  target="_blank"><?php the_permalink() ?></a><br/>
								<?php if ( get_post_meta($post->ID, 'tgwz', true) ) : ?>
									<strong>温馨提示：</strong>文章内容系作者个人观点，不代表<?php bloginfo('name'); ?>对观点赞同或支持。<br/>
									<strong>版权声明：</strong>本文为投稿文章，感谢&nbsp;<a href="<?php echo $wzurl; ?>" target="_blank" rel="nofollow"><?php echo $wzzz; ?></a>&nbsp;的投稿，版权归原作者所有，欢迎分享本文，转载请保留出处！
								<?php elseif ( get_post_meta($post->ID, 'zzwz', true) ) : ?>
									<strong>温馨提示：</strong>文章内容系作者个人观点，不代表<?php bloginfo('name'); ?>对观点赞同或支持。<br/>
									<strong>版权声明：</strong>本文为转载文章，来源于&nbsp;<a href="<?php echo $wzurl; ?>" target="_blank" rel="nofollow"><?php echo $wzzz; ?></a>&nbsp;，版权归原作者所有，欢迎分享本文，转载请保留出处！
								<?php else:  ?>
									<strong>版权声明：</strong>本文为原创文章，版权归&nbsp;<a href="<?php echo $wzurl; ?>" target="_blank"><?php echo $wzzz; ?></a>&nbsp;所有，欢迎分享本文，转载请保留出处！
								<?php endif; ?>
							</div>
						</div>
						<?php get_template_part( 'inc/social' ); ?>
						<?php include('inc/file.php'); ?>
						<div class="clear"></div>
					</div><!-- .entry-content -->
				</article><!-- #post -->
														
				<?php if (get_option('ygj_adt') == '关闭') { ?>
				<?php { echo ''; } ?>
				<?php } else { include(TEMPLATEPATH . '/inc/ad/ad_single_d.php'); } ?>
				<?php include('inc/realted_post.php');?>
				<nav class="nav-single">
					<?php  
						$categories = get_the_category();  
						$categoryIDS = array();  
						foreach ($categories as $category) {  
							array_push($categoryIDS, $category->term_id);  
						}  
						$categoryIDS = implode(",", $categoryIDS);  
					?>  
					<?php if (get_previous_post($categoryIDS)) { previous_post_link('%link','<span class="meta-nav"><span class="post-nav"><i class="fa fa-angle-left"></i> 上一篇</span><br>%title</span>',true,'');} else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br></span>已经是最后一篇了</span>";} ?> 
					<?php if (get_next_post($categoryIDS)) { next_post_link('%link','<span class="meta-nav"><span class="post-nav">下一篇 <i class="fa fa-angle-right"></i></span><br>%title</span>',true,'');} else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br></span>已经是最新一篇了</span>";} ?> 	
					<div class="clear"></div>				
				</nav>
				<nav class="nav-single-c"> 	<nav class="navigation post-navigation" role="navigation">		<h2 class="screen-reader-text">文章导航</h2>		<div class="nav-links">			<div class="nav-previous">				<?php previous_post_link('%link','<span class="meta-nav-r" aria-hidden="true"><i class="fa fa-angle-left"></i></span>',true,'') ?>			</div>			<div class="nav-next">				<?php next_post_link('%link','<span class="meta-nav-l" aria-hidden="true"><i class="fa fa-angle-right"></i></span> ',true,'') ?>				</div>		</div>	</nav></nav>
					<?php if (get_option('ygj_g_comment') == '关闭') { ?>
	<?php } else { ?>
		<?php get_template_part( 'inc/ad/ad_comment' ); ?>
	<?php } ?>
				<?php comments_template( '', true ); ?>			
			<?php endwhile; ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<?php get_sidebar();?>
	<div class="clear"></div>
</div><!-- .site-content -->
<?php get_footer();?>