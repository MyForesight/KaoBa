<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<?php get_template_part( 'inc/functions/seo' ); ?>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico">
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/favicon.png">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('home'); ?>/xmlrpc.php">
<!--[if lt IE 9]><script src="<?php bloginfo('template_directory'); ?>/js/html5-css3.js"></script><![endif]-->
<link rel="stylesheet" id="nfgc-main-style-css" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="all">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/scrollmonitor.js"></script>
<?php if (is_home() ) { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/wow.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slides.js"></script>
<?php } ?>
<?php if (get_option('ygj_bdtjdm')) { ?>
<?php echo stripslashes(get_option('ygj_bdtjdm')); ?>
<?php } ?>
<!--[if IE]>
<div class="tixing"><strong>温馨提示：感谢您访问本站，经检测您使用的浏览器为IE浏览器，为了获得更好的浏览体验，请使用Chrome、Firefox或其他浏览器。</strong>
</div>
<![endif]-->
<link rel="stylesheet" id="font-awesome-four-css" href="<?php bloginfo('template_directory'); ?>/fonts/font-awesome.min.css" type='text/css' media='all'/>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header">
	<nav id="top-header">
		<div class="top-nav">
			<div id="user-profile">
				您好，欢迎访问<?php bloginfo('name'); ?>&nbsp;&nbsp;|&nbsp;<a href="<?php bloginfo('home'); ?>/wp-admin" target="_blank">登录</a>
			</div>	
		<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'menu_class' => 'top-menu', 'fallback_cb' => 'default_menu' ) ); ?>
		</div>
	</nav><!-- #top-header -->
<div id="middle-header">

</div>
	<div id="menu-box">
		<div id="top-menu">
			<span class="nav-search">搜索</span>
			<?php get_template_part( 'inc/logo' ); ?>
			<div id="site-nav-wrap">
				<div id="sidr-close"><a href="<?php bloginfo('home'); ?>/#sidr-close" class="toggle-sidr-close">关闭</a>
			</div>
			
			<nav id="site-nav" class="main-nav">
				<a href="#sidr-main" id="navigation-toggle" class="bars">导航</a>	
				<?php if ( wp_is_mobile() ) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'mini-menu','menu_class' => 'down-menu nav-menu', 'fallback_cb' => 'default_menu' ) ); ?>	
				<?php }else { ?>				
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_class' => 'down-menu nav-menu', 'fallback_cb' => 'default_menu' ) ); ?>	
				<?php } ?>				
			</nav>	
			</div><!-- #site-nav-wrap -->
		</div><!-- #top-menu -->
	</div><!-- #menu-box -->
</header><!-- #masthead -->

<div id="main-search">
	<?php get_search_form(); ?>
	<span class="plxiaoshi">
	<?php include('inc/search-tag.php'); ?>	
</span>
	<div class="clear"></div>
</div>
<?php the_crumbs(); ?>