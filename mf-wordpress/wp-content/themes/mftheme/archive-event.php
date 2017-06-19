<?php
/*
Template name: Events Page
*/
get_header();

$mycurrentpage = (get_query_var('paged', 1));
$args = [
    'posts_per_page'	=> 6,
    'post_type'			=> 'event',
    'paged' => $mycurrentpage
];
// query
$the_query = new WP_Query($args);
$total_pages = $the_query->max_num_pages;
?>
<div class="section-wrapper section-wrapper--almost-white">
<?php if( $the_query->have_posts() ):?>
        <section class="section events-section">
            <div class="section__header section__header--to-start">
                <h2 class="section__title section__title--to-left"><?php nop_the_field('currentpage_title'); ?></h2>
                <p class="section__intro">
                    <?php nop_the_field('currentpage_content'); ?>
                </p>
            </div>
            <?php while( $the_query->have_posts() ) : $the_query->the_post();?>
                <article class="events-section__article ">
                    <time datetime="2017-11-03" class="events-section__article-time"><?php the_field('event_start'); ?></time>
                    <a class="events-section__article-link" href="<?php the_permalink();?>">
                        <?= get_the_post_thumbnail( $post_id, 'events-small' );?>
                    <h3 class="events-section__article-title"><?php the_field('page_title'); ?></h3>
                    </a>
                    <p class="events-section__article-content"><?= mf_get_the_excerpt(100,'event_description'); ?></p>
                    <a href="<?php the_permalink() ?>" class="view-more-link"><?=__('Lire plus sur l’événement ','mf');?><span class="hidden"><?=the_field('event_title');?></span></a>
                </article>
            <?php endwhile; ?>
        </section>
        <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
            <a href="<?= mf_get_page_url('donation.php');?>" class="cta-button cta-button--on-inversed"><?= __('Voir les autres moyens de soutien','');?></a>
            <?php if ($total_pages != 1 ):?>
                <div class="view-link--to-right">
                    <?php previous_posts_link('Événements précédents');?>
                    <?php next_posts_link('Événements suivants', $the_query->max_num_pages); ?>
                </div>
            <?php endif;?>
        </div>
    <?php else:?>
        <p><?= __('vous essayez d’acceder a une page inexistante','mf');?></p>
        <a href="<?php the_permalink();?>" class="cta-button cta-button--on-inversed"><?= __('Revenir au début de la page des événements.','');?></a>
    <?php endif; ?>
</div>

<!--A few images from a trip-->
<?php get_template_part('partials/content','fewgallery')?>
<!--CTA Trip-->
<?php get_template_part('partials/content','ctatrip')?>
<!--A few News articles-->
<?php get_template_part('partials/content','fewnews')?>
<?php get_footer();?>
