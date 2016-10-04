<?php
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	// 楼层	
	/* 主评论计数器 by zwwooooo */
global $commentcount,$wpdb, $post;
if(!$commentcount) { //初始化楼层计数器
    $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
    $cnt = count($comments);//获取主评论总数量
    $page = get_query_var('cpage');//获取当前评论列表页码
    $cpp=get_option('comments_per_page');//获取每页评论显示数量
    if (ceil($cnt/$cpp) == 1 || ($page>1 && $page == ceil($cnt/$cpp))) {
        $commentcount = $cnt + 1;//如果评论只有1页或者是最后一页，初始值为主评论总数
    } else {
          $commentcount = $cpp * $page + 1;
    }
}
/* 主评论计数器 end */
?>
	<div id="anchor"><div id="comment-<?php comment_ID() ?>"></div></div>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<?php echo my_avatar( $comment->comment_author_email,40,$default='',$comment->comment_author); ?>
	<div class="comment-author">
		<strong><span class="duzhe"><?php commentauthor(); ?></span><?php if (!get_option('ygj_pldj') ) { ?><?php get_author_class($comment->comment_author_email,$comment->user_id); ?><?php if(user_can($comment->user_id, 1)){echo '<span class="dengji">【';echo stripslashes(get_option('ygj_adminch')); echo '】</span>';}?><?php } ?></strong><span class="reply_t"><?php comment_reply_link(array_merge( $args, array('reply_text' => '&nbsp;@回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span><br/>
		<span class="comment-meta commentmetadata">
			<span class="comment-aux">
				<?php echo '发表于';printf( __('%1$s at %2$s'), get_comment_date( 'Y-m-d' ),  get_comment_time('H:i') ); ?>
				<?php
					if ( is_user_logged_in() ) {
						$url = get_bloginfo('url');
						echo '<a id="delete-'. $comment->comment_ID .'" href="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '" >&nbsp;删除</a>';
					}
				?>
				<?php edit_comment_link( '编辑' , '&nbsp;', '' ); ?>
				<span class="floor">
					<?php
						if(!$parent_id = $comment->comment_parent){
							 switch ($commentcount){
								case 2 :echo "&nbsp;沙发";--$commentcount;break;
								case 3 :echo "&nbsp;板凳";--$commentcount;break;
								case 4 :echo "&nbsp;地板";--$commentcount;break;
								default:printf('&nbsp;%1$s楼', --$commentcount);
							}
							
						}
					?>
					<?php if( $depth > 1){printf('<span class="xiaoshi">&nbsp;地下%1$s层</span>', $depth-1);} ?>
				</span>
			</span>
		</span>
		<?php comment_text(); ?>
	</div>

	<?php if ( $comment->comment_approved == '0' ) : ?>
		<div class="comment-awaiting-moderation">您的评论正在等待审核！</div>
	<?php endif; ?>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}