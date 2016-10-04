<?php
/*
Template Name: 留言板(含年月日排行榜)
*/
?>
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
					<span class="date"><?php the_time( 'Y-m-d H:i' ) ?></span>
					<span class="views"><?php if( function_exists( 'the_views' ) ) { the_views(); print '人阅读 '; } ?></span>
					<span class="comment"><?php comments_popup_link( '暂无评论', ' 1 条评论', ' % 条评论' ); ?></span>				
					<span class="edit"><?php edit_post_link('编辑', '  ', '  '); ?></span>
				</div>			
	</header><!-- .entry-header -->

	<div class="entry-content">
					<div class="single-content">									
	<?php the_content(); ?>
	<?php if ( wp_is_mobile() ) { ?>
			<?php }else { ?>
			<div id="dzq">
				<h3><?php _e('本年评论排行 TOP6','MFBegin'); ?></h3>
					<?php
						$author_email = get_option('admin_email');
						$queryy="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE date_format(comment_date,'%Y')=date_format(now(),'%Y') AND user_id='0' AND comment_author_email != '" . $author_email . "' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 6";
						$wally = $wpdb->get_results($queryy);
						$maxNum = $wally[0]->cnt;
						foreach ($wally as $commenty)
							{
								$width = round(40/($maxNum / $commenty->cnt),2);
								if( $commenty->comment_author_url )
									$urly = $commenty->comment_author_url;
								else $urly="#";
									$avatar = my_avatar( $commenty->comment_author_email,36,$default='',$commenty->comment_author);
									$tmpy = "<li><a target=\"_blank\" href=\"".$commenty->comment_author_url."\">".$avatar."<em>".$commenty->comment_author."</em> <strong>+".$commenty->cnt."</strong></br>".$commenty->comment_author_url."</a></li>";
									$outputy .= $tmpy;
							}
						$outputy = "<ul class=\"readers-list\">".$outputy."</ul>";
						echo $outputy ;
					?>
				<h3><?php _e('本月评论排行 TOP6','MFBegin'); ?></h3>
					<?php
						$author_email = get_option('admin_email');
						$querym="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE date_format(comment_date,'%Y-%m')=date_format(now(),'%Y-%m') AND user_id='0' AND comment_author_email != '" . $author_email . "' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 6";
						$wallm = $wpdb->get_results($querym);
						$maxNum = $wallm[0]->cnt;
						foreach ($wallm as $commentm)
							{
								$width = round(40/($maxNum / $commentm->cnt),2);
								if( $commentm->comment_author_url )
									$urlm = $commentm->comment_author_url;
								else $urlm="#";
									$avatar = my_avatar( $commentm->comment_author_email,36,$default='',$commentm->comment_author);
									$tmpm = "<li><a target=\"_blank\" href=\"".$commentm->comment_author_url."\">".$avatar."<em>".$commentm->comment_author."</em> <strong>+".$commentm->cnt."</strong></br>".$commentm->comment_author_url."</a></li>";
									$outputm .= $tmpm;
							}
						$outputm = "<ul class=\"readers-list\">".$outputm."</ul>";
						echo $outputm ;
					?>
				<h3><?php _e('本周评论排行 TOP6','MFBegin'); ?></h3>
					<?php
						$author_email = get_option('admin_email');
						$queryw="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE yearweek(date_format(comment_date,'%Y-%m-%d')) = yearweek(now()) AND user_id='0' AND comment_author_email != '" . $author_email . "' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 6";
						$wallw = $wpdb->get_results($queryw);
						$maxNum = $wallw[0]->cnt;
						foreach ($wallw as $commentw)
							{
								$width = round(40/($maxNum / $commentw->cnt),2);
								if( $commentw->comment_author_url )
									$urlw = $commentw->comment_author_url;
								else $urlw="#";
									$avatar = my_avatar( $commentw->comment_author_email,36,$default='',$commentw->comment_author);
									$tmpw = "<li><a target=\"_blank\" href=\"".$commentw->comment_author_url."\">".$avatar."<em>".$commentw->comment_author."</em> <strong>+".$commentw->cnt."</strong></br>".$commentw->comment_author_url."</a></li>";
									$outputw .= $tmpw;
							}
							$outputw = "<ul class=\"readers-list\">".$outputw."</ul>";
						echo $outputw ;
					?>
				</div>
				<?php } ?>
			</div>
<div class="clear"></div>
<?php get_template_part( 'inc/social' ); ?>
				<div class="clear"></div>
	</div><!-- .entry-content -->

	</article><!-- #post -->	
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