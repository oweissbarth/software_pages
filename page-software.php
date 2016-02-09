
<?php get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			<?php query_posts('post_type=sp_software_page'); ?>
			<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="software-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="software-title">
							<h3><?php the_title(); ?></h3>
						</div>
					<div class="software-content">
						<div class="software-featured-image">
							<?php echo "<img src=".get_post_meta(get_the_ID(), "sp_icon", true).">" ?>
						</div><div class="software-description">
							<p ><?php echo get_post_meta(get_the_ID(), "sp_description", true)?></p>
						</div><div class='software-info'>
							<div class='item'>
								<p class='label'>Version</p>
								<p class='value'><?php echo get_post_meta(get_the_ID(), "sp_version", true)?></p>
							</div>
							<div class='item'>
								<p class='label'>Licence</p>
								<p class='value'><?php echo get_post_meta(get_the_ID(), "sp_license", true)?></p>
							</div>
							<div class='divider'>
							<div class='item'>
								<p class='label'>Author</p>
								<p class='value'><?php echo get_post_meta(get_the_ID(), "sp_author", true)?></p>
							</div>
							<div class='divider'>
							<div class='item'>
								<p class='label'>Platform</p>
								<p class='value'><?php echo get_post_meta(get_the_ID(), "sp_platform", true)?></p>
							</div>
							<div class='divider'>
							<div class='item'>
								<p class='label'>Language</p>
								<p class='value'><?php echo get_post_meta(get_the_ID(), "sp_language", true)?></p>
							</div>
							<div class='divider'>
							<div class='item'>
								<p class='label'>Downloads</p>
								<p class='value'><?php echo do_shortcode('[download_data id="'.get_post_meta(get_the_ID(), "sp_download", true).'" data="download_count"]')?></p>
							</div>
							<div class='divider'>
						</div>
						<a class="software-readmore" href="<?php the_permalink() ?>" title="<?php the_permalink() ?>"><button class="software-readmore" >Read more</button></a>
					</div><!-- .software-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; ?>

				<style>
				#content{
					max-width: 1280px;
					margin-top: 3em;
				}

				article.sp_software_page,  div.software-content{
					width: 100%;
				}

				div.software-content{
					font-size: 0;
					position: relative;
				}

				article.sp_software_page{
					margin-top: 1.5em;
					margin-bottom: 1.5em;
					border: 3px solid #65717F;
					/*background-color:#CAE1FF;*/
					border-radius: 4px;
					margin-left: -6px;
					margin-right: -6px;
				}

				div.software-title{
					width: 100%;
					text-align: center;
					background-color: #65717F;
				}

				div.software-title > h3{
					padding: 0;
					font-size: 24pt;
				}

				div.software-featured-image{
					width: 20%;
					display: inline-block;
					margin: 0;
					border-right : 3px solid #3F5B7F;
					-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
					-moz-box-sizing: border-box;    /* Firefox, other Gecko */
					box-sizing: border-box;         /* Opera/IE 8+ */
				}

				div.software-featured-image>img{
					margin-left: auto;
					margin-right: auto;
					display: block;
				}


				div.software-info{
					width: 20%;
					display: inline-block;
					margin: 0;
					vertical-align: top;
					border-left: 1px solid grey;
					-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
					-moz-box-sizing: border-box;    /* Firefox, other Gecko */
					box-sizing: border-box;         /* Opera/IE 8+ */
					background-color: #65717F;
					font-size: 12pt;
				}



				div.software-description{
					position: relative;
					width: 60%;
					height: 100%;
					display: inline-block;
					margin: 0;
					vertical-align: top;
					padding: 0.5em;
					font-size: 14pt;
					-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
					-moz-box-sizing: border-box;    /* Firefox, other Gecko */
					box-sizing: border-box;         /* Opera/IE 8+ */
				}

				a.software-readmore{
					position: absolute;
					bottom: 0.5em;
					right: 32%;
				}

				button.software-readmore{
					height: 45px;
					background-color: #222326;
					color: white;
					padding: 0.5em;
					vertical-align: middle;
					line-height: 100%;
					appearance: none;
					margin: 0;
				}

				p.label{
					display: inline-block;
					padding-left: 5px;
					width: 30%;
				}

				p.value{
					display: inline-block;
					padding-left: 5px;

				}

				</style>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>
