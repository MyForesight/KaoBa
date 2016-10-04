<div class="social-main">
	<?php if (!get_option('ygj_post_like') ) { ?>
		<div class="like clr">
			<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" title="好文！一定要点赞！" class="favorite<?php if(isset($_COOKIE['ality_like_'.$post->ID])) echo ' done';?>"><i class="fa fa-thumbs-up"></i><i class="count">
	            <?php if( get_post_meta($post->ID,'ality_like',true) ){
					echo get_post_meta($post->ID,'ality_like',true);
				} else {
					echo '0';
				}?></i>人喜欢
	        </a>
		</div>
		<?php } ?>
		<?php if (!get_option('ygj_post_baidu') ) { ?>
		<span class="plxiaoshi">
		<div class="bdsharebuttonbox">
		<span class="s-txt">分享：</span>
		<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
		<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
		<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
		<a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
		<a href="#" class="bds_ty" data-cmd="ty" title="分享到天涯社区"></a>
		<a href="#" class="bds_more" data-cmd="more"></a>
		</div>
		</span>
		<?php } ?>
		<div class="clear"></div>
</div>