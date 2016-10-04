<?php
// 小工具
if (function_exists('register_sidebar')){
	register_sidebar( array(
		'name'          => '首页侧边栏',
		'id'            => 'sidebar-1',
		'description'   => '显示在首页及分类归档页侧边栏',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="cat">',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => '正文侧边栏',
		'id'            => 'sidebar-2',
		'description'   => '显示在正文和页面侧边栏',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="cat">',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => '正文、页面跟随滚动',
		'id'            => 'sidebar-4',
		'description'   => '正文、页面跟随滚动小工具',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="cat">',
		'after_title'   => '</span></h3>',	
	) );
	register_sidebar( array(
		'name'          => '首页、分类、归档跟随滚动',
		'id'            => 'sidebar-5',
		'description'   => '首页、分类、归档跟随滚动小工具',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><span class="cat">',
		'after_title'   => '</span></h3>',	
	) );
	
}

// 自定义菜单
register_nav_menus(
   array(
      'top-menu' => __( '右上角菜单' ),
      'header-menu' => __( '导航主菜单' ),
      'mini-menu' => __( '移动版菜单' )
   )
);

// 去掉描述P标签
function deletehtml($description) {
	$description = trim($description);
	$description = strip_tags($description,"");
	return ($description);
}
add_filter('category_description', 'deletehtml');
//标题文字截断
function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}

//禁用工具条
show_admin_bar(false);
//禁止代码标点转换
remove_filter('the_content', 'wptexturize');

// 移除头部冗余代码
remove_action( 'wp_head', 'wp_generator' );// WP版本信息
remove_action( 'wp_head', 'rsd_link' );// 离线编辑器接口
remove_action( 'wp_head', 'wlwmanifest_link' );// 同上
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );// 上下文章的url
remove_action( 'wp_head', 'feed_links', 2 );// 文章和评论feed
remove_action( 'wp_head', 'feed_links_extra', 3 );// 去除评论feed
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );// 短链接

// 下载按钮
function button_a($atts, $content = null) {
return '<div id="down"><a id="load" title="下载链接" href="#button_file" rel="nofollow"><i class="fa fa-download"></i>&nbsp;下载地址</a><div class="clear"></div></div>';
}
add_shortcode("file", "button_a");

// 编辑器增强
 function enable_more_buttons($buttons) {
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'wp_page';
	$buttons[] = 'anchor';
	$buttons[] = 'backcolor';
	return $buttons;
}
add_filter( "mce_buttons_3", "enable_more_buttons" );

// 添加按钮
add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');
function bolo_after_wp_tiny_mce($mce_settings) {
?>
<script type="text/javascript">
QTags.addButton( 'file', '下载按钮', "[file]" );
QTags.addButton( 'gotohome', '官网直达', "<div id='goto'><a title='' href='' target='_blank' rel='nofollow'>官网直达</a></div>" );
QTags.addButton( 'vidoeshare', '视频分享', "<div class='video-content'><a class='videos'  href='插入视频分享通用代码中的视频src源地址' title='播放视频'>插入视频图片<i class='play'></i></a></div>" );
function bolo_QTnextpage_arg1() {
}
</script>
<?php }


// 所有图片
function all_img($soContent){
	$soImages = '~<img [^\>]*\ />~';
	preg_match_all( $soImages, $soContent, $thePics );
	$allPics = count($thePics);
	if( $allPics > 0 ){ 
		$count=0;
			foreach($thePics[0] as $v){
				 if( $count == 4 ){break;}
				 else {echo $v;}
				$count++;
			}
	}
}

//留言信息
function WelcomeCommentAuthorBack($email = ''){
	if(empty($email)){
		return;
	}
	global $wpdb;

	$past_30days = gmdate('Y-m-d H:i:s',((time()-(24*60*60*30))+(get_option('gmt_offset')*3600)));
	$sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments
					WHERE comment_approved = '1'
					AND comment_author_email = '$email'
					AND comment_date >= '$past_30days'";
	$times = $wpdb->get_results($sql);
	$times = ($times[0]->times) ? $times[0]->times : 0;
	$message = $times ? sprintf(__('过去30天内您有<strong>%1$s</strong>条留言，感谢关注!' ), $times) : '您已很久都没有留言了，这次说点什么吧？';
	return $message;
}

// 评论链接新窗口
function commentauthor($comment_ID = 0) {
    $url    = get_comment_author_url( $comment_ID );
    $author = get_comment_author( $comment_ID );
    if ( empty( $url ) || 'http://' == $url )
		echo $author;
    else
		echo "<a href='$url' rel='external nofollow' target='_blank' class='url'>$author</a>";
}


// 禁止无中文留言
if ( is_user_logged_in() ) {
} else {
function refused_spam_comments( $comment_data ) {
	$pattern = '/[一-龥]/u';  
	if(!preg_match($pattern,$comment_data['comment_content'])) {
		err('评论必须含中文！');
	}
	return( $comment_data );
}
add_filter('preprocess_comment','refused_spam_comments');
}

// 禁止后台加载谷歌字体
function wp_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'wp_remove_open_sans_from_wp_core' );

//屏蔽默认小工具
function my_unregister_widgets() {
//近期评论
	unregister_widget( 'WP_Widget_Recent_Comments' );
//近期文章
	unregister_widget( 'WP_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'my_unregister_widgets' );

// 主题设置
require get_template_directory() . '/inc/theme-options.php';
// 主题小工具
require get_template_directory() . '/inc/functions/widgets.php';
// 热门文章
require get_template_directory() . '/inc/functions/hot-post.php';
// 热评文章
require get_template_directory() . '/inc/functions/hot_comment.php';
// 分页
require get_template_directory() . '/inc/functions/pagenavi.php';
// 图片属性
require get_template_directory() . '/inc/functions/addclass.php';
// 面包屑导航
require get_template_directory() . '/inc/functions/breadcrumb.php';
// 评论模板
require get_template_directory() . '/inc/functions/comment-template.php';
// 评论通知
require get_template_directory() . '/inc/functions/notify.php';
// 文字展开
require get_template_directory() . '/inc/functions/section.php';
// 友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
// 加载前端脚本及样式
function nana_scripts() {
		wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), '1.0', false );
	if ( is_singular() ) {
		wp_localize_script( 'script', 'wpl_ajax_url', admin_url() . "admin-ajax.php");
		wp_enqueue_style( 'highlight', get_template_directory_uri() . '/images/highlight.css', array(), '1.0');
		wp_enqueue_script( 'jquery.fancybox', get_template_directory_uri() . '/js/fancybox.js', array(), '2.0', false);
        wp_enqueue_script( 'comments-ajax', get_template_directory_uri() . '/js/comments-ajax.js', array(), '1.5', false);
	}
}
add_action( 'wp_enqueue_scripts', 'nana_scripts' );

// 自动缩略图
function catch_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
		$random = mt_rand(1, 10);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/'.$random.'.jpg';
  }
  return $first_img;
}

//avatar头像缓存
function my_avatar( $email = 'unite@boke123.net', $size = '40', $default = '', $alt = '') {
  $f = md5( strtolower( $email ) );
  $a = get_bloginfo('template_url') . '/avatar/'. $f . $size . '.png';
  $e = get_template_directory() . '/avatar/' . $f . $size . '.png';
  $d = get_template_directory() . '/avatar/' . $f . '-d.png';
  $txdf = get_bloginfo('template_url'). '/avatar/default.jpg';
  if($default=='')
    $default = $txdf;
  $t = 2592000; // 缓存有效期30天, 这里单位:秒
  if ( !is_file($e) || (time() - filemtime($e)) > $t ) {
    if ( !is_file($d) || (time() - filemtime($d)) > $t ) {
      // 验证是否有头像
      $uri = 'http://gravatar.duoshuo.com/avatar/' . $f . '?d=404';
      $headers = @get_headers($uri);
      if (!preg_match("|200|", $headers[0])) {
        // 没有头像，则新建一个空白文件作为标记
        $handle = fopen($d, 'w');
        fclose($handle);
        $a = $default;
      }
      else {
        // 有头像且不存在则更新
        $r = get_option('avatar_rating');
        $g = 'http://gravatar.duoshuo.com/avatar/'. $f. '?s='. $size. '&r=' . $r;
        copy($g, $e);
      }
    }
    else {
      $a = $default;
    }
  } 
  $avatar = "<img alt='{$alt}' src='{$a}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
  return apply_filters('my_avatar', $avatar, $email, $size, $default, $alt);
}

//隐藏作者页
function my_author_link() {
    return home_url( '/' );
}
add_filter( 'author_link', 'my_author_link' );

//自定义表情路径和名称
function custom_smilies_src($src, $img){return get_bloginfo('template_directory').'/images/smilies/' . $img;}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);

	if ( !isset( $wpsmiliestrans ) ) {
		$wpsmiliestrans = array(
		'[呲牙]' => 'cy.gif',
		'[憨笑]' => 'hanx.gif',
		'[坏笑]' => 'huaix.gif',
		'[偷笑]' => 'tx.gif',
		  '[色]' => 'se.gif',
		  '[微笑]' => 'wx.gif',
		  '[抓狂]' => 'zk.gif',
		   '[睡觉]' => 'shui.gif',
		   '[酷]' => 'kuk.gif',
		   '[流汗]' => 'lh.gif',
		   '[鼓掌]' => 'gz.gif',
		   '[大哭]' => 'ku.gif',
		   '[可怜]' => 'kel.gif',
		   '[疑问]' => 'yiw.gif',
		   '[晕]' => 'yun.gif',
		   '[惊讶]' => 'jy.gif',
		   '[得意]' => 'dy.gif',
		   '[尴尬]' => 'gg.gif',
		   '[发怒]' => 'fn.gif',
		   '[奋斗]' => 'fendou.gif',
		   '[衰]' => 'shuai.gif',
		   '[骷髅]' => 'kl.gif',		   
		   '[啤酒]' => 'pj.gif',
		    '[吃饭]' => 'fan.gif',
		    '[礼物]' => 'lw.gif',
		    '[强]' => 'qiang.gif',
		    '[弱]' => 'ruo.gif',
		    '[握手]' => 'ws.gif',
		     '[OK]' => 'ok.gif',
		     '[NO]' => 'bu.gif',
		      '[勾引]' => 'gy.gif',
		      '[拳头]' => 'qt.gif',
		      '[差劲]' => 'cj.gif',
		      '[爱你]' => 'aini.gif',
		);
	}

//获取评论者等级称号
function get_author_class($comment_author_email,$user_id){
global $wpdb;
$author_count = count($wpdb->get_results(
"SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
$adminEmail = get_option('admin_email');if($comment_author_email ==$adminEmail) return;
if($author_count>=1 && $author_count< get_option('ygj_pldjs_1')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_1')); echo '】</span>';}
else if($author_count>=get_option('ygj_pldjs_1') && $author_count< get_option('ygj_pldjs_2')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_2')); echo '】</span>';}
else if($author_count>=get_option('ygj_pldjs_2') && $author_count< get_option('ygj_pldjs_3')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_3')); echo '】</span>';}
else if($author_count>=get_option('ygj_pldjs_3') && $author_count< get_option('ygj_pldjs_4')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_4')); echo '】</span>';}
else if($author_count>=get_option('ygj_pldjs_4') && $author_count< get_option('ygj_pldjs_5')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_5')); echo '】</span>';}
else if($author_count>=get_option('ygj_pldjs_5') &&$author_count< get_option('ygj_pldjs_6')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_6')); echo '】</span>';}
else if($author_count>=get_option('ygj_pldjs_6') && $author_count< get_option('ygj_pldjs_7')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_7')); echo '】</span>';}
else if($author_count>=get_option('ygj_pldjs_7') && $author_count< get_option('ygj_pldjs_8')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_8')); echo '】</span>';}
else if($author_count>= get_option('ygj_pldjs_8')){
echo ' <span class="dengji">【';echo stripslashes(get_option('ygj_pldjch_9')); echo '】</span>';}
}	

if(get_option('ygj_autonl')):
/* 自动为文章内的标签添加内链开始 */
$match_num_from = get_option('ygj_autonl_1');;        //一篇文章中同一个标签少于几次不自动链接
$match_num_to = get_option('ygj_autonl_2');;      //一篇文章中同一个标签最多自动链接几次
function tag_sort($a, $b){
    if ( $a->name == $b->name ) return 0;
    return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}
function tag_link($content){
    global $match_num_from,$match_num_to;
        $posttags = get_the_tags();
        if ($posttags) {
            usort($posttags, "tag_sort");
            foreach($posttags as $tag) {
                $link = get_tag_link($tag->term_id);
                $keyword = $tag->name;
                $cleankeyword = stripslashes($keyword);
                $url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('【查看含有[%s]标签的文章】'))."\"";
                $url .= ' target="_blank"';
                $url .= ">".addcslashes($cleankeyword, '$')."</a>";
                $limit = rand($match_num_from,$match_num_to);
                $content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
                $content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
                $cleankeyword = preg_quote($cleankeyword,'\'');
                $regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
                $content = preg_replace($regEx,$url,$content,$limit);
                $content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
            }
        }
    return $content;
}
add_filter('the_content','tag_link',1);
endif;

remove_action( 'wp_head','print_emoji_detection_script',7);     //解决4.2版本部分主题大量404请求问题
remove_action('admin_print_scripts', 'print_emoji_detection_script'); //解决后台404请求
remove_action( 'wp_print_styles',   'print_emoji_styles'    );  //移除4.2版本前台表情样式钩子
remove_action( 'admin_print_styles',    'print_emoji_styles');  //移除4.2版本后台表情样式钩子
remove_action( 'the_content_feed',      'wp_staticize_emoji');  //移除4.2 emoji相关钩子
remove_action( 'comment_text_rss',      'wp_staticize_emoji');  //移除4.2 emoji相关钩子

/**
    *WordPress 后台回复评论插入表情
    *http://www.endskin.com/admin-smiley.html
*/
function Bing_ajax_smiley_scripts(){
    echo '<script type="text/javascript">function grin(e){var t;e=" "+e+" ";if(!document.getElementById("replycontent")||document.getElementById("replycontent").type!="textarea")return!1;t=document.getElementById("replycontent");if(document.selection)t.focus(),sel=document.selection.createRange(),sel.text=e,t.focus();else if(t.selectionStart||t.selectionStart=="0"){var n=t.selectionStart,r=t.selectionEnd,i=r;t.value=t.value.substring(0,n)+e+t.value.substring(r,t.value.length),i+=e.length,t.focus(),t.selectionStart=i,t.selectionEnd=i}else t.value+=e,t.focus()}jQuery(document).ready(function(e){var t="";e("#comments-form").length&&e.get(ajaxurl,{action:"ajax_data_smiley"},function(n){t=n,e("#qt_replycontent_toolbar input:last").after("<br>"+t)})})</script>';
}
add_action( 'admin_head', 'Bing_ajax_smiley_scripts' );
//Ajax 获取表情
function Bing_ajax_data_smiley(){
    $site_url = site_url();
    foreach( array_unique( (array) $GLOBALS['wpsmiliestrans'] ) as $key => $value ){
        $src_url = apply_filters( 'smilies_src', includes_url( 'images/smilies/' . $value ), $value, $site_url );
        echo ' <a href="javascript:grin(\'' . $key . '\')"><img src="' . $src_url . '" alt="' . $key . '" /></a> ';
    }
    die;
}
add_action( 'wp_ajax_nopriv_ajax_data_smiley', 'Bing_ajax_data_smiley' );
add_action( 'wp_ajax_ajax_data_smiley', 'Bing_ajax_data_smiley' );

//网站整体变灰及一键换色
function hui_head_css() { 
	$styles = ""; 		
	if (get_option('ygj_site_gray')) { 
		$styles .= "html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}"; 
	} 
$skin_option = get_option('ygj_theme_skin'); 
		$skc = "#" . $skin_option; 
	
	if ($skin_option && ($skin_option !== "C01E22")) { 
		$styles .= ".nav-search,#navigation-toggle:hover,#searchform button,.entry-content .cat a,.post-format a,.aside-cat,.page-links span,.page-links a:hover span,.tglx,.widget_categories a:hover,.widget_links a:hover,#sidebar .widget_nav_menu a:hover,#respond #submit,.comment-tool a:hover,.pagination a:hover,.pagination span.current,.pagination .prev,.pagination .next,#down a,.buttons a,.expand_collapse,#tag_letter li:hover,.foot .p2 li .isquare,.link-all a:hover,.meta-nav:hover,.new_cat li.hov .time,.rslides_tabs .rslides_here a,.fancybox-close{background: $skc;}.widget_categories li:hover,.widget_links li:hover,#sidebar .widget_nav_menu li:hover{background-color:$skc;}a:hover,.top-menu a:hover,.default-menu li a,#user-profile a:hover,#site-nav .down-menu > li > a:hover,#site-nav .down-menu > li.sfHover > a,#site-nav .down-menu > .current-menu-item > a,#site-nav .down-menu > .current-menu-item > a:hover,.scrolltext-title a,.cat-list,.archive-tag a:hover,.entry-meta a,.single-content a,.single-content a:visited,.single-content a:hover,.showmore span,.post_cat a,.single_info .comment a,.single_banquan a,.single_info_w a,.floor,.at,.at a,#dzq .readers-list a:hover em,#dzq .readers-list a:hover strong,#all_tags li a:hover,.showmore span,.new_cat li.hov .title,a.top_post_item:hover p{color: $skc;}.nav-search,#navigation-toggle:hover,.page-links span,.page-links a:hover span,#respond #submit,.comment-tool a:hover,.pagination a:hover,.pagination span.current,#down a,.buttons a,.expand_collapse,.link-all a:hover,.meta-nav:hover,.rslides_tabs .rslides_here a{border: 1px solid $skc;}#dzq .readers-list a:hover{border-color: $skc;}.sf-arrows>li>.sf-with-ul:focus:after,.sf-arrows>li:hover>.sf-with-ul:after,.sf-arrows>.sfHover>.sf-with-ul:after,.sf-arrows>li>.sf-with-ul:focus:after,.sf-arrows>li:hover>.sf-with-ul:after,.sf-arrows>.sfHover>.sf-with-ul:after{border-top-color: $skc;}.sf-arrows ul li>.sf-with-ul:focus:after,.sf-arrows ul li:hover>.sf-with-ul:after,.sf-arrows ul .sfHover>.sf-with-ul:after{border-left-color: $skc;}.cat-box .cat-title a,.cat-box .cat-title .syfl,.widget-title .cat,#top_post_filter li:hover,#top_post_filter .top_post_filter_active{border-bottom: 3px solid $skc;}.entry-content .cat a{border-left: 3px solid $skc;}.single-content h2,.archives-yearmonth{border-left: 5px solid $skc;}.aside-cat{background: none repeat scroll 0 0 $skc;}.new_cat li.hov{border-bottom: dotted 1px $skc;}"; 
	}  
	if ($styles) { 
		echo "<style>" . $styles . "</style>"; 
	} 
}
add_action("wp_head", "hui_head_css"); 

// 彩色标签云
function colorCloud($text) {
	$text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
	return $text;
}
function colorCloudCallback($matches) {
	$text = $matches[1];
	$color = dechex(rand(0,16777215));
	$pattern = '/style=(\'|\")(.*)(\'|\")/i';
	$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
	return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);

//文章编辑器中添加表情
function fa_get_wpsmiliestrans(){
global $wpsmiliestrans;
$wpsmilies = array_unique($wpsmiliestrans);
foreach($wpsmilies as $alt => $src_path){
$output .= '<a class="add-smily" data-smilies="'.$alt.'"><img class="wp-smiley" src="'.get_bloginfo('template_directory').'/images/smilies/'.rtrim($src_path, "gif").'gif" /></a>';
}
return $output;
}
add_action('media_buttons_context', 'fa_smilies_custom_button');
function fa_smilies_custom_button($context) {
$context .= '<style>.smilies-wrap{background:#fff;border: 1px solid #ccc;box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.24);padding: 10px;position: absolute;top: 60px;width: 380px;display:none}.smilies-wrap img{height:24px;width:24px;cursor:pointer;margin-bottom:5px} .is-active.smilies-wrap{display:block}</style><a id="insert-media-button" style="position:relative" class="button insert-smilies add_smilies" title="添加表情" data-editor="content" href="javascript:;">
添加表情
</a><div class="smilies-wrap">'. fa_get_wpsmiliestrans() .'</div><script>jQuery(document).ready(function(){jQuery(document).on("click", ".insert-smilies",function() { if(jQuery(".smilies-wrap").hasClass("is-active")){jQuery(".smilies-wrap").removeClass("is-active");}else{jQuery(".smilies-wrap").addClass("is-active");}});jQuery(document).on("click", ".add-smily",function() { send_to_editor(" " + jQuery(this).data("smilies") + " ");jQuery(".smilies-wrap").removeClass("is-active");return false;});});</script>';
return $context;
}
//时间格式多久以前
function timeago($ptime) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return '刚刚';
    $interval = array(
        12 * 30 * 24 * 60 * 60 => '年前 (' . date('Y-m-d', $ptime) . ')',
        30 * 24 * 60 * 60 => '个月前 (' . date('m-d', $ptime) . ')',
        7 * 24 * 60 * 60 => '周前 (' . date('m-d', $ptime) . ')',
        24 * 60 * 60 => '天前',
        60 * 60 => '小时前',
        60 => '分钟前',
        1 => '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

// 点赞
add_action('wp_ajax_nopriv_ality_ding', 'ality_ding');
add_action('wp_ajax_ality_ding', 'ality_ding');
function ality_ding(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
	    $bigfa_raters = get_post_meta($id,'ality_like',true);
	    $expire = time() + 99999999;
	    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	    setcookie('ality_like_'.$id,$id,$expire,'/',$domain,false);
	    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
			update_post_meta($id, 'ality_like', 1);
		}
	    else {
			update_post_meta($id, 'ality_like', ($bigfa_raters + 1));
		}
		echo get_post_meta($id,'ality_like',true);
    }
    die;
}
if(get_option('ygj_wlgonof')):
//给外部链接加上跳转(需新建页面，模板选择Go跳转页面，别名为go)
add_filter('the_content','the_content_nofollow',999);
function the_content_nofollow($content)
{
	preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$content,$matches);
	if($matches && !is_page('about')){
		foreach($matches[2] as $val){
			if(strpos($val,'://')!==false && strpos($val,home_url())===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$val)){
			    $content=str_replace("href=\"$val\"", "href=\"".home_url()."/go/?url=$val\"  rel=\"nofollow\" ",$content);
			}
		}
	}
	return $content;
}
endif;
if(get_option('ygj_lssdjt')):
//历史上的今天，代码来自于柳城博主的WP-Today插件
function wp_today(){
	global $wpdb;
	$post_year = get_the_time('Y');
	$post_month = get_the_time('m');
	$post_day = get_the_time('j');
	
	$sql = "select ID, year(post_date) as h_year, post_title, comment_count FROM 
			$wpdb->posts WHERE post_password = '' AND post_type = 'post' AND post_status = 'publish'
			AND year(post_date)!='$post_year' AND month(post_date)='$post_month' AND day(post_date)='$post_day'
			order by post_date_gmt DESC limit 5";
	$histtory_post = $wpdb->get_results($sql);
	if( $histtory_post ){
		foreach( $histtory_post as $post ){
			$h_year = $post->h_year;
			$h_post_title = $post->post_title;
			$h_permalink = get_permalink( $post->ID );
			$h_comments = $post->comment_count;
			$h_post .= "<li><strong>$h_year:</strong>&nbsp;&nbsp;<a href='".$h_permalink."' title='".$h_post_title."' target='_blank'>$h_post_title(".$h_comments."条评论)</a></li>";
		}
	}

	if ( $h_post ){
		$result = "<span class=\"plxiaoshi\"><h2>历史上的今天:</h2><ul>".$h_post."</ul></span>";
	}

	return $result;
}
function wp_today_auto($content){
	if( is_single() ){
		$content = $content.wp_today();
	}
	return $content;
}
add_filter('the_content', 'wp_today_auto',9999);
endif;
if(get_option('ygj_zntjtpat')):
//智能添加图片alt和title属性
function image_title( $imgalt ){
        global $post;
		$category = get_the_category();
		$flname=$category[0]->cat_name;
        $imgtitle = $post->post_title;
        $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
        if(preg_match_all("/$imgUrl/siU",$imgalt,$matches,PREG_SET_ORDER)){
                if( !empty($matches) ){
                        for ($i=0; $i < count($matches); $i++){
                                $tag = $url = $matches[$i][0];
								$j=$i+1;
                                $judge = '/title=/';
                                preg_match($judge,$tag,$match,PREG_OFFSET_CAPTURE);
                                if( count($match) < 1 )
                                $altURL = ' alt="'.$imgtitle.' '.$flname.' 第'.$j.'张" title="'.$imgtitle.' '.$flname.' 第'.$j.'张-高考巴士" ';
                                $url = rtrim($url,'>');
                                $url .= $altURL.'>';
                                $imgalt = str_replace($tag,$url,$imgalt);
                        }
                }
        }
        return $imgalt;
}
add_filter( 'the_content','image_title');
endif;
if(get_option('ygj_baiduts')):
/**
* WordPress发布文章主动推送到百度，加快收录保护原创【WordPress通用方式】
*/
if(!function_exists('Baidu_Submit')){
    function Baidu_Submit($post_ID) {
        $WEB_TOKEN  = get_option('ygj_token_id');  //这里请换成你的网站的百度主动推送的token值
        $WEB_DOMAIN = get_option('home');
        //已成功推送的文章不再推送
        if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
        $url = get_permalink($post_ID);
        $api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.$WEB_TOKEN;
        $request = new WP_Http;
        $result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
        $result = json_decode($result['body'],true);
        //如果推送成功则在文章新增自定义栏目Baidusubmit，值为1
        if (array_key_exists('success',$result)) {
            add_post_meta($post_ID, 'Baidusubmit', 1, true);
        }
    }
    add_action('publish_post', 'Baidu_Submit', 0);
}
endif;

if(get_option('ygj_xiegang')):
/* 分类目录和页面链接地址以斜杠/结尾*/
function nice_trailingslashit($string, $type_of_url) {
    if ( $type_of_url != 'single' )
      $string = trailingslashit($string);
    return $string;
}
add_filter('user_trailingslashit', 'nice_trailingslashit', 10, 2);
endif;

if(get_option('ygj_admin_link')):
/* 加密后台登录地址*/
function ygj_login_protection() {
    if ($_GET[''.get_option('ygj_admin_q').''] !== ''.get_option('ygj_admin_a').'') {
     header('Location: '.get_option('ygj_admin_url').'');
    }
}
add_action('login_enqueue_scripts', 'ygj_login_protection');
endif;

if(get_option('ygj_sinasync')):
/**
* WordPress发布文章同步到新浪微博（带图片&自定义栏目版）
*/
function post_to_sina_weibo($post_ID) { 
   /* 此处修改为通过文章自定义栏目来判断是否同步 */
   if(get_post_meta($post_ID,'weibo_sync',true) == 1) return;
   $get_post_info = get_post($post_ID);
   $get_post_centent = get_post($post_ID)->post_content;
   $get_post_title = get_post($post_ID)->post_title;
   if ($get_post_info->post_status == 'publish' && $_POST['original_post_status'] != 'publish') {
	   $appkey = '' . get_option('ygj_sinasync_key') . ''; 
       $username = '' . get_option('ygj_sinasync_user') . '';
       $userpassword = '' . get_option('ygj_sinasync_pwd') . '';
       $request = new WP_Http;
       $keywords = ""; 
       /* 获取文章标签关键词 */
       $tags = wp_get_post_tags($post_ID);
       foreach ($tags as $tag ) {
          $keywords = $keywords.'#'.$tag->name."#";
       }
      /* 修改了下风格，并添加文章关键词作为微博话题，提高与其他相关微博的关联率 */
     $string1 = '【'. strip_tags( $get_post_title ).'】';
     $string2 = $keywords.' 查看全文：'.get_permalink($post_ID);
     /* 微博字数控制，避免超标同步失败 */
     $wb_num = (138 - WeiboLength($string1.$string2))*2;
     $status = $string1.mb_strimwidth(strip_tags( apply_filters('the_content', $get_post_centent)),0, $wb_num,'...').$string2;
       /* 获取特色图片，如果没设置就抓取文章第一张图片 */ 
       if (has_post_thumbnail()) {
          $timthumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($post_ID), 'full' ); 
          $url = $timthumb_src[0];
       /* 抓取第一张图片作为特色图片，需要主题函数支持 */
       } else if(function_exists('catch_image')) {
          $url = catch_image(); 
       }
       /* 判断是否存在图片，定义不同的接口 */
       if(!empty($url)){
           $api_url = 'https://api.weibo.com/2/statuses/upload_url_text.json'; /* 新的API接口地址 */
           $body = array('status' => $status,'source' => $appkey,'url' => $url);
       } else {
           $api_url = 'https://api.weibo.com/2/statuses/update.json';
           $body = array('status' => $status,'source' => $appkey);
       }
       $headers = array('Authorization' => 'Basic ' . base64_encode("$username:$userpassword"));
       $result = $request->post($api_url, array('body' => $body,'headers' => $headers));
       /* 若同步成功，则给新增自定义栏目weibo_sync，避免以后更新文章重复同步 */
       add_post_meta($post_ID, 'weibo_sync', 1, true);
    }
}
add_action('publish_post', 'post_to_sina_weibo', 0);

/*
//获取微博字符长度函数 
*/
function WeiboLength($str)
{
    $arr = arr_split_zh($str);   //先将字符串分割到数组中
    foreach ($arr as $v){
        $temp = ord($v);        //转换为ASCII码
        if ($temp > 0 && $temp < 127) {
            $len = $len+0.5;
        }else{
            $len ++;
        }
    }
    return ceil($len);        //加一取整
}

/*
//拆分字符串函数,只支持 gb2312编码  
//参考：http://u-czh.iteye.com/blog/1565858
*/
function arr_split_zh($tempaddtext){
    $tempaddtext = iconv("UTF-8", "GBK//IGNORE", $tempaddtext);
    $cind = 0;
    $arr_cont=array();
    for($i=0;$i<strlen($tempaddtext);$i++)
    {
        if(strlen(substr($tempaddtext,$cind,1)) > 0){
            if(ord(substr($tempaddtext,$cind,1)) < 0xA1 ){ //如果为英文则取1个字节
                array_push($arr_cont,substr($tempaddtext,$cind,1));
                $cind++;
            }else{
                array_push($arr_cont,substr($tempaddtext,$cind,2));
                $cind+=2;
            }
        }
    }
    foreach ($arr_cont as &$row)
    {
        $row=iconv("gb2312","UTF-8",$row);
    }
    return $arr_cont;
}
endif;
if (get_option('ygj_mailsmtp_b')):
//SMTP邮箱设置
function googlo_mail_smtp($phpmailer) {
    $phpmailer->From = '' . get_option('ygj_maildizhi_b') . ''; //发件人地址
    $phpmailer->FromName = '' . get_option('ygj_mailnichen_b') . ''; //发件人昵称
    $phpmailer->Host = '' . get_option('ygj_mailsmtp_b') . ''; //SMTP服务器地址
    $phpmailer->Port = '' . get_option('ygj_mailport_b') . ''; //SMTP邮件发送端口
    if (get_option('ygj_smtpssl_b')) {
    $phpmailer->SMTPSecure = 'ssl';
    }else{
    $phpmailer->SMTPSecure = '';
    }//SMTP加密方式(SSL/TLS)没有为空即可
    $phpmailer->Username = '' . get_option('ygj_mailuser_b') . ''; //邮箱帐号
    $phpmailer->Password = '' . get_option('ygj_mailpass_b') . ''; //邮箱密码
    $phpmailer->IsSMTP();
    $phpmailer->SMTPAuth = true; //启用SMTPAuth服务

}
    add_action('phpmailer_init', 'googlo_mail_smtp');
endif;

//实现侧边栏文本工具运行PHP代码
add_filter('widget_text', 'php_text', 99);
function php_text($text) {
if (strpos($text, '<' . '?') !== false) {
ob_start();
eval('?' . '>' . $text);
$text = ob_get_contents();
ob_end_clean();
}
return $text;
}

//导航菜单添加手气不错按钮
function random_postlite() {
	$loop = new WP_Query( array( 'post_type' => array(post),'orderby' => 'rand','posts_per_page' => 1 ) );
while ( $loop->have_posts() ) : $loop->the_post();
wp_redirect( get_permalink() );
endwhile;
}
if ( isset( $_GET['random'] ) )
add_action( 'template_redirect', 'random_postlite' );

// 滚动加载
if (get_option('ygj_gdjz')) {
	require get_template_directory() . '/inc/functions/infinite-scroll.php';

	function footerscroll() {
		wp_register_script('infinite_scroll', get_template_directory_uri() . '/js/infinite-scroll.js', false, '2.0.2', true );
		if ( is_home() || is_category()) {
		wp_enqueue_script( 'infinite_scroll' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'footerscroll' );
}

// 分页
function ality_page_nav( ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below">
			<div class="nav-next"><?php previous_posts_link( 上一页 ); ?></div>
			<div class="nav-previous"><?php next_posts_link( 下一页 ); ?></div>
		</nav>
	<?php endif;
}

// 浏览总数
function all_view(){
global $wpdb;
$count=0;
$views= $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='views'");
foreach($views as $key=>$value)
	{
		$meta_value=$value->meta_value;
		if($meta_value!=' '){
			$count+=(int)$meta_value;
		}
	}
return $count;
}
function tinymce_font_china($initArray){    $initArray['font_formats'] = "微软雅黑=微软雅黑;宋体=宋体;黑体=黑体;仿宋=仿宋;楷体=楷体;隶书=隶书;幼圆=幼圆;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats";    return $initArray; } add_filter('tiny_mce_before_init', 'tinymce_font_china'); 
// Remove emoji script
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );
function remove_dns_prefetch( $hints, $relation_type ) {
if ( 'dns-prefetch' === $relation_type ) {
return array_diff( wp_dependencies_unique_hosts(), $hints );
}
return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
?>