<?php

/*
Template Name: Single Article
*/
get_header();

?>
<?php $media = get_field('article_media')[0];?>
<!--debut article-->
<div class="section-wrapper">
    <div class="section article-section">
        <article class="article-section__article">
            <h2 class="article-section__title"><?php nop_the_field('article_title'); ?></h2>
            <div class="article-section__labels-wrapper">
                <span class="article-section__label"><?= __('Article publie le','mf');?></span>
                <time class="article-section__time" datetime="2017-11-03"></span><?php the_field('article_date');?></time>
            </div>
            <?php $term = get_field('article_type');?>
            <?php if($term->term_id == 9):?>
                <span class="tag tag--orange"><?= $term->name;?></span>
            <?php else:?>
                <span class="tag tag--green"><?= $term->name;?></span>
            <?php endif;?>
            <div class="article-section__content">
                <?php the_field('article_content')?>
            </div>
            <div class="button-wrapper">
                <?php if ($media['url']):?>
                    <a href="<?= $media['url'];?>" class="cta-button cta-button--mr"><?= __('Ouvrir le fichier PDF','mf');?></a>
                <?php elseif(get_field('article_link')):?>
                    <a href="<?php the_field('article_link');?>" class="cta-button cta-button--mr"><?= __('Lire l’article sur le site web de la source','mf');?></a>
                <?php endif;?>
            </div>
        </article>
    </div>
</div>
<!--CTA Trip-->
<?php get_template_part('partials/content','ctatrip')?>
<!--A few events from the events page-->
<?php get_template_part('partials/content','fewevents')?>
<!--A few projects-->
<?php get_template_part('partials/content','fewprojects')?>

<?php get_footer();?>
