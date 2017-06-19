<?php
$args = [
	'posts_per_page'	=> 3,
	'post_type'			=> 'project',
	'order'				=> 'DESC'
];

// query
$the_query = new WP_Query($args);

?>
<?php if( $the_query->have_posts() ): ?>
	<div class="section-wrapper section-wrapper--very-light-gray">
		<section class="section projets-section">
			<header class="section__header">
				<h2 class="section__title"><?= __('Nos plus recent projets','mf');?></h2>
			</header>
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<article class="projets-section__article">
				<a class="events-section__article-link" href="<?php the_permalink();?>">
					<?= get_the_post_thumbnail( $post_id, 'article-small' );?>
					<h3 class="events-section__article-title"><?php the_field('page_title');?></h3>
				</a>
					<p class="projets-section__article-content"><?php mf_the_excerpt(100,'project_description'); ?></p>
					<a href="<?php the_permalink() ?>" class="view-more-link"><?= __('Lire plus sur le projet ','mf');?><span class="hidden"><?=the_field('project_title');?></span></a>
				</article>
			<?php endwhile; ?>
		</section>
		<div class="button-wrapper">
			<a href="<?= mf_get_page_url('archive-project.php');?>" class="cta-button "><?=__('Voir les autres pojets','mf')?></a>
		</div>
	</div>
<?php endif; ?>
<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
