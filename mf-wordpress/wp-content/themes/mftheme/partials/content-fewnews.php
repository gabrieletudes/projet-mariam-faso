<?php
$args = [
    'posts_per_page'	=> 3,
    'post_type'			=> 'post',
    'order'				=> 'DESC'
];

// query
$the_query = new WP_Query($args);

?>
<?php if( $the_query->have_posts() ): ?>
    <div class="section-wrapper section-wrapper--almost-white">
        <section class="section news-section">
            <header class="section__header">
                <h2 class="section__title"><?= __('La presse parle de nous','mf');?></h2>
            </header>
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php $term = get_field('article_type');?>
                <article class="news-section__article">
                    <a href="<?php the_permalink();?>"><span class="hidden"><?= __('Lire l’article ','mf');?><?=the_field('article_title');?></span>
                        <?= get_the_post_thumbnail( $post_id, 'article-small' );?>
                    </a>
                    <h3 class="news-section__article-title"><?php the_field('article_title'); ?></h3>
                    <time class="news-section__article-time" datetime="2017-11-03"><span class="hidden"><?= __('Article publie le ','mf');?></span><?php the_time('j M Y'); ?></time>
                    <?php if($term->term_id == 9):?>
                        <a href="<?= mf_get_page_url('archive.php');?>" class="tag tag--orange"><?= $term->name;?></a>
                    <?php else:?>
                        <a href="<?= mf_get_page_url('archive.php');?>" class="tag tag--green"><?= $term->name;?></a>
                    <?php endif;?>
                    <p class="news-section__article-content"><?php mf_the_excerpt(100,'article_content'); ?></p>
                    <a href="<?php the_permalink() ?>" class="view-more-link"><?= __('Lire l’article ','mf');?><span class="hidden"><?=the_field('article_title');?></span></a>
                </article>
            <?php endwhile; ?>
        </section>
        <div class="button-wrapper">
            <a href="<?= mf_get_page_url('archive.php');?>" class="cta-button "><?=__('Voir les autres articles','mf')?></a>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
