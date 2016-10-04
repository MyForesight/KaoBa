<?php
//按时间获得浏览器最高的文章
function get_timespan_most_viewed($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*26400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		foreach ($most_viewed as $post) {
			$post_views = intval($post->views);
			$post_views = number_format($post_views);			$outputimgh = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);		$first_imgh = $matches [1] [0];		if(empty($first_imgh)){ 		$random = mt_rand(1, 10);			$first_imgh="" . get_bloginfo('template_directory') . "/images/random/".$random.".jpg";  }
			$temp .= "<a class=\"top_post_item men_post\" href=\"".get_permalink()."\" title=\"".get_the_title()."($post_views 人阅读)\" style=\"display: block;\"  target=\"_blank\"><img src=\"".$first_imgh."\"><p>".get_the_title()."</p><div class=\"clear\"></div></a>";
		}		
	} else {
		$temp = '<a>'.__('N/A', 'wp-postviews').'</a>'."\n";
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}?>