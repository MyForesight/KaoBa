<?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail', array('alt' => get_the_title()));
} else { ?>
<img src="<?php echo catch_image() ?>" alt="<?php the_title(); ?>" />
<?php } ?>