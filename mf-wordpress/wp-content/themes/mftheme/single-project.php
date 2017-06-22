<?php

/*
Template Name: Single Project
*/
get_header();

?>
<!--debut projet-->
<div class="section-wrapper">
    <div class="section article-section">
        <article class="article-section__article">
            <h2 class="article-section__title"><?php the_field('page_title');?></h2>
            <div class="article-section__labels-wrapper">
                <span class="article-section__label"><?= __('Debut du projet','mf');?></span>
                <time class="article-section__time" datetime="2017-11-03"><?php the_field('project_start');?></time>
            </div>
            <div class="article-section__labels-wrapper">
                <span class="article-section__label"><?= __('Fin du projet','mf');?></span>
                <time class="article-section__time" datetime="2017-11-03"><?php the_field('project_ended');?></time>
            </div>
            <div class="article-section__labels-wrapper">
                <span class="article-section__label"><?= __('Lieu','mf')?></span>
                <p class="article-section__place"><?= mf_single_taxplace('project_place');?></p>
            </div>
            <div class="article-section__content">
                <?php the_field('project_description');?>
            </div>
            <div class="button-wrapper">
                <a href="<?= mf_get_page_url('donation.php');?>" class="cta-button cta-button--mr"><?= __('Soutenez nos projets','mf');?></a>
            </div>
        </article>
    </div>
</div>
<!--Here starts the Gallery of this project-->
<?php
//Setup pagination variables
$gallery = get_field('project_photos'); // Get our gallery
$images = []; // Set images array for current page

$items_per_page  = 8; // How many items we should display on each page
$total_items = count($gallery); // How many items we have in total
$total_pages = ceil($total_items / $items_per_page); // How many pages we have in total
//Get current page
if ( get_query_var( 'paged' ) ) {
    $current_page = get_query_var( 'paged' );
}elseif ( get_query_var( 'page' ) ) {
    //this is just in case some odd rewrite, but paged should work instead of page here
    $current_page = get_query_var( 'page' );
}else{
    $current_page = 1;
}
$starting_point = (($current_page-1)*$items_per_page); // Get starting point for current page

// Get elements for current page
if($gallery){
    $images = array_slice($gallery,$starting_point,$items_per_page);
}?>
<?php if(!empty($images)):?>
    <div class="section-wrapper">
        <section class="section photos-section">
            <header class="section__header">
                <h2 class="section__title"><?= __('Des photos de ce projet','mf')?></h2>
            </header>
            <?php foreach( $images as $image ):?>
                <?php if($i < $items_per_page): $i++?>
                    <a class="photos-section__img" data-lightbox="project" href="<?php echo $image['url']; ?>">
                        <img src="<?php echo $image['sizes']['gallery-small']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>
                <?php endif;?>
            <?php endforeach;?>
        </section>
        <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
            <a href="#" class="cta-button cta-button--on-inversed">Soutenez nos projets</a>
            <?php if($total_pages > 0 && $current_page <= $total_pages-1 && $current_page!=1):?>
                <a class="view-link view-link--previous view-link--to-right" href="<?= get_permalink().(($current_page-1)!=0 ? '&paged='.($current_page-1) : '');?>"><?=__('Previous','textdomain');?></a>
                <a class="view-link view-link--next" href="<?= get_permalink().'&paged='.($current_page+1);?>"><?=__('Next','textdomain');?></a>
            <?php elseif($total_pages >1 && $current_page<$total_pages && $current_page!=$total_pages):?>
                <a class="view-link view-link--next view-link--to-right" href="<?= get_permalink().'&paged='.($current_page+1);?>"><?=__('Next','textdomain');?></a>
            <?php else:?>
                <a class="view-link view-link--previous view-link--to-right" href="<?= get_permalink().(($current_page-1)!=0 ? '&paged='.($current_page-1) : '');?>"><?=__('Previous','textdomain');?></a>
            <?php endif;?>
        </div>
    </div>
<?php endif;?>
<!--A few events from the events page-->
<?php get_template_part('partials/content','fewevents')?>
<!--Here starts the other projects section-->
<?php
$args = [
    'posts_per_page'	=> 3,
    'post_type'			=> 'project'
];
// query
$the_query = new WP_Query($args);
?>
<?php if( $the_query->have_posts() ): ?>
    <div class="section-wrapper">
        <section class="section projets-section">
            <header class="section__header">
                <h2 class="section__title"><?=__('Des autres projets','mf')?></h2>
            </header>
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <article class="projets-section__article">
                    <a href="<?php the_permalink();?>">
                        <?= get_the_post_thumbnail( $post_id, 'article-small' );?>
                        <h3 class="events-section__article-title"><?php the_field('project_title'); ?></h3>
                    </a>
                    <p class="projets-section__article-content"><?php mf_the_excerpt(144,'project_description'); ?></p>
                    <a href="<?php the_permalink() ?>" class="view-more-link"><?=__('Lire plus sur le projet','mf')?><span class="hidden"><?=the_field('project_title');?></span></a>
                </article>
            <?php endwhile; ?>
        </section>
        <div class="button-wrapper">
            <a href="<?= mf_get_page_url('archive-project.php');?>" class="cta-button "><?=__('Voir les autres projets','mf')?></a>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
<?php get_footer();?>
