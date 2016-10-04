<div id="sidebar" class="widget-area">			
	<div class="sidebar-roll"></div>
		<?php wp_reset_query();if (is_single() || is_page() ) { ?>
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
				<div class="sidebar-roll">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
				</div>
			<?php }else { ?>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
					<div class="sidebar-roll">
						<?php dynamic_sidebar( 'sidebar-5' ); ?>
					</div>
			<?php } ?>
</div>
</div>