<?php get_header(); ?>

<section id="content" class="site-main">
<?php if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="sp_single_header">
		<?php echo "<img class='sp_single_icon' src=".get_post_meta(get_the_ID(), "sp_icon", true).">" ?>
		<h1><?php the_title(); ?></h1>
		<h3 class="sp_single_catchphrase"><?php echo get_post_meta(get_the_ID(), "sp_catchphrase", true)?></h3>
		<a class="sp_single_download" href=<?php echo do_shortcode("[download_data id=".get_post_meta(get_the_ID(), 'sp_download', true)." data=download_link]")?>><button class="sp_single_download">Download</button></a>
	</div>
	<br class="sp_single_clear"/>
	<hr>
	<?php the_content(); ?>
<?php endwhile; ?>
<?php
$defaults = array(
		'before'           => '<p>' . __( 'Pages:', 'monolith' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page', 'monolith' ),
		'previouspagelink' => __( 'Previous page', 'monolith' ),
		'pagelink'         => '%',
		'echo'             => 1
	);

wp_link_pages($defaults); ?>

<?php endif; ?>
</section>
<?php comments_template(); ?>

<style>
	.sp_single_header{
	}


	.sp_single_icon{
		float: left;
		width: 200px;
		margin-right: 1em;
	}

	.sp_single_catchphrase{
		text-align: center;
	}

	.sp_single_download{
		float:right;
	}

	.sp_single_clear{
		clear: both;

	}



</style>

<?php get_footer(); ?>
