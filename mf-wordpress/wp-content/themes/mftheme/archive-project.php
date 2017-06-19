<?php
/*
Template Name: Projects
*/
get_header();

$mycurrentpage = (get_query_var('paged', 1));
$args = [
    'posts_per_page'	=> 6,
    'post_type'			=> 'project',
    'paged' => $mycurrentpage
];
// query
$the_query = new WP_Query($args);
$total_pages = $the_query->max_num_pages;
?>
<div class="section-wrapper section-wrapper--almost-white">
    <?php if( $the_query->have_posts() ):?>
        <section class="section projets-section">
            <div class="section__header section__header--to-start">
                <h2 class="section__title section__title--to-left"><?php nop_the_field('currentpage_title') ;?></h2>
                <p class="section__intro">
                    <?php nop_the_field('currentpage_content');?>
                </p>
            </div>
            <?php while( $the_query->have_posts() ) : $the_query->the_post();?>
                <article class="projets-section__article projets-section__article--mab-64">
                    <?= get_the_post_thumbnail( $post_id, 'article-small' );?>
                    <h3 class="events-section__article-title"><?php the_field('page_title');?></h3>
                    <p class="projets-section__article-content"><?php mf_the_excerpt(100,'project_description');?></p>
                    <a href="<?php the_permalink();?>" class="view-more-link"><?= __('Lire plus sur le projet ','mf');?><span class="hidden"><?= the_field('project_title');?></span></a>
                </article>
            <?php endwhile; ?>
        </section>
        <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
            <a href="<?= mf_get_page_url('donation.php');?>" class="cta-button cta-button--on-inversed"><?= __('Soutenez nos projets','');?></a>
            <?php if ($total_pages != 1 ):?>
                <div class="view-link--to-right">
                    <?php previous_posts_link('Projets précédents');?>
                    <?php next_posts_link('Projets suivants', $the_query->max_num_pages); ?>
                </div>
            <?php endif;?>
        </div>
    <?php else:?>
        <p><?= __('vous essayez d’acceder a une page inexistante','mf');?></p>
        <a href="<?php the_permalink();?>" class="cta-button cta-button--on-inversed"><?= __('Retournez au debut des projets','');?></a>
<?php endif; ?>
</div>
<!--A few images from a trip-->
<?php get_template_part('partials/content','fewgallery')?>
<!--A few events from the events page-->
<?php get_template_part('partials/content','fewevents')?>

<?php get_footer();?>
