<?php
/*
Template Name: Archives
*/
get_header();
$mycurrentpage = (get_query_var('paged', 1));
$args = [
    'posts_per_page'	=> 4,
    'post_type'			=> 'post',
    'paged' => $mycurrentpage
];
// query
$the_query = new WP_Query($args);
$total_pages = $the_query->max_num_pages;
//var_dump($the_query);
?>
<div class="section-wrapper section-wrapper--almost-white">
    <?php if( $the_query->have_posts() ): ?>
        <section class="section news-all">
            <div class="section__header section__header--to-start">
                <h2 class="section__title section__title--to-left"><?php nop_the_field('currentpage_title'); ?></h2>
                <p class="section__intro">
                    <?php nop_the_field('currentpage_content'); ?>
                </p>
            </div>
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php $term = get_field('article_type');?>
                <article class="news-all__article">
                    <a href="<?php the_permalink();?>">
                        <?= get_the_post_thumbnail( $post_id, 'article-medium' );?>
                    </a>
                    <div class="news-section__content-wrap">
                        <h3 class="news-section__article-title news-section__article-title--fs-28"><?php the_field('article_title'); ?></h3>
                        <time class="news-section__article-time" datetime="2017-11-03"><span class="hidden"><?= __('Article publie le ','mf');?></span><?php the_time('j M Y'); ?></time>
                        <?php if($term->term_id == 9):?>
                            <span class="tag tag--orange"><?= $term->name;?></span>
                        <?php else:?>
                            <span class="tag tag--green"><?= $term->name;?></span>
                        <?php endif;?>
                        <p class="news-section__article-content"><?php mf_the_excerpt(150,'article_content');?></p>
                        <a href="<?php the_permalink() ?>" class="view-more-link"><?= __('Lire l’article ','mf');?><span class="hidden"><?=the_field('article_title');?></span></a>
                    </div>
                </article>
            <?php endwhile; ?>
        </section>
        <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
            <a href="<?= mf_get_page_url('donation.php');?>" class="cta-button cta-button--on-inversed"><?= __('Soutenez nos projets','');?></a>
            <?php if ($total_pages != 1 ): ?>
                <div class="view-link--to-right">
                    <?php previous_posts_link('Articles précédents');?>
                    <?php next_posts_link('Articles suivants', $the_query->max_num_pages);?>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p><?= __('vous essayez d’acceder a une page inexistante','mf'); ?></p>
        <a href="<?php the_permalink();?>" class="cta-button cta-button--on-inversed"><?= __('Retournez au debut des articles','');?></a>
<?php endif; ?>
</div>
<!--A few projects-->
<?php get_template_part('partials/content','fewprojects')?>
<!--A few images from a trip-->
<?php get_template_part('partials/content','fewgallery')?>
<!--A few events from the events page-->
<?php get_template_part('partials/content','fewevents')?>

<?php get_footer();?>
