<?php

$side_width = "full";
	switch ( $side_width ) {
	  case "full":
		?>
			<style>
			@media screen and (max-width:991px) {
			#side-primary-menu-wrap {
				position: fixed;
				top: 60px;
				left: 0;
				z-index: 1;
				width: 100%; /*example + never use min-width with this solution */
				height: calc(100% - 90px);
				background: rgba(255, 255, 255, 0.919);
				padding-left: 0;
				padding-right: 0;
				padding-top: 20px;
				border-right: 1px solid rgba(0,0,0,.125);
				overflow: auto;
			}
			#primary-menu {
				text-align: center!important;
			}
			#side-primary-menu-wrap .nav-link {
				width: 100%!important;
			}
		.side-menu-open{overflow:hidden;}	
	
			}
			</style>
	<?php
	break;
	default:
	?>
			<style>
			@media screen and (max-width:992px) {
			#side-primary-menu-wrap {
				position: fixed;
				top: 0;
				left: 0;
				z-index: 1;
				width: 280px; /*example + never use min-width with this solution */
				height: 100%;
				background: rgba(255, 255, 255, 0.919);
				padding-left: 20px;
				padding-right: 20px;
				padding-top: 40px;
				border-right: 1px solid rgba(0,0,0,.125);
				overflow: auto;
			}
				
			#side-primary-menu-wrap .nav-link {
				width: 300px;
			}
				.side-menu-open{overflow:hidden;}	
			}
				
			</style>
	<?php
	break;
	}
	?>
<script>
	jQuery(function($){
	  // mobile menu slide from the left
	  $('[data-bs-toggle="side-collapse"]').on('click', function() {
		$navMenuCont = $($(this).data('bs-target'));
		$('body').toggleClass('side-menu-open');
		
		$navMenuCont.animate({'width':'toggle', 'padding-left':'toggle', 'padding-right':'toggle'}, 600);
	  });
	})
	</script>
