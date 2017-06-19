<?php
$args = [
    'posts_per_page'	=> 3,
    'post_type'			=> 'event'
];

// query
$the_query = new WP_Query($args);

?>
<?php if( $the_query->have_posts() ): ?>
    <div class="section-wrapper section-wrapper--very-light-gray">
        <section class="section events-section">
            <header class="section__header">
                <h2 class="section__title"><?= __('Nos plus recent événements','mf');?></h2>
            </header>
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <article class="events-section__article">
                    <time datetime="2017-11-03" class="events-section__article-time"><?php the_field('event_start'); ?></time>
                    <a class="events-section__article-link" href="<?php the_permalink();?>">
                        <?= get_the_post_thumbnail( $post_id, 'events-small' );?>
                    <h3 class="events-section__article-title"><?php the_field('event_title'); ?></h3>
                    </a>
                    <p class="events-section__article-content"><?php mf_the_excerpt(100,'event_description'); ?></p>
                    <a href="<?php the_permalink() ?>" class="view-more-link"><?=__('Lire plus sur l’événement ','mf');?><span class="hidden"><?=the_field('event_title');?></span></a>
                </article>
            <?php endwhile; ?>
        </section>
        <div class="button-wrapper">
            <a href="<?= mf_get_page_url('archive-event.php');?>" class="cta-button "><?= __('Voir les autres événements');?></a>
        </div>
    </div>
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
