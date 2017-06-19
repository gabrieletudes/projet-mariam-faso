<?php
/*
Template name: Donation Page
*/
get_header();
?>
<div class="section-wrapper section-wrapper--almost-white">
    <section class="section section--mb-16 donation-section">
        <div class="section__header section__header--to-start">
            <h2 class="section__title section__title--to-left"><?php nop_the_field('currentpage_title'); ?></h2>
            <p class="section__intro">
                <?php nop_the_field('currentpage_content'); ?>
            </p>
        </div>
        <?php
        // check if the repeater field has rows of data
        if( have_rows('donation_what') ):?>

        <?php    // loop through the rows of data
        while ( have_rows('donation_what') ) : the_row();?>

        <?php // display a sub field value
        $image = get_sub_field('element_background');?>

        <article class="donation-section__article">
            <img src="<?= $image['sizes']['article-small']?>" alt="<?= $image['alt'];?>">
            <h3 class="donation-section__article-title"><?php the_sub_field('element_title');?></h3>
            <p class="donation-section__article-content"><?php the_sub_field('element_content',false,false);?></p>
        </article>
    <?php endwhile;?>
<?php endif;?>
</section>
</div>
<!--quoi soutien-->
<div class="section-wrapper section-wrapper--very-light-gray">
    <section class="section section--mb-16 donation-section">
        <div class="section__header section__header--to-start">
            <h2 class="section__title section__title--to-left"><?= __('Comment pouvez-vous nous soutenir ?','mf');?></h2>
        </div>
        <article class="donation-section__article">
            <a class="donation-section__article-link" href="#">
                <h3 class="hidden"><?= __('Faites un don via le site de la FRB','mf');?></h3>
                <i aria-hidden="true" class="donation-section__article--icon donation-section__article--icon-donnation"></i>
            </a>
            <p class="donation-section__article-content"><?php the_field('donation_compte')?></p>
            <a href="#" class="view-more-link view-more-link--push-bottom"><?= __('Faites un don via le site de la FRB','mf');?></a>
        </article>
        <article class="donation-section__article">
            <a class="donation-section__article-link" href="#">
                <h3 class="hidden"><?= __('Consulte nos événements','mf');?></h3>
                <i aria-hidden="true" class="donation-section__article--icon donation-section__article--icon-agenda"></i>
            </a>
            <p class="donation-section__article-content"><?php the_field('donation_event')?></p>
            <a href="<?= mf_get_page_url('archive-event.php');?>" class="view-more-link view-more-link--push-bottom"><?= __('Aller a la page événements','mf');?></a>
        </article>
        <article class="donation-section__article">
            <a class="donation-section__article-link" href="">
                <h3 class="hidden"><?= __('Allez à la page Voyages','mf');?></h3>
                <i aria-hidden="true" class="donation-section__article--icon donation-section__article--icon-travel"></i>
            </a>
            <p class="donation-section__article-content"><?php the_field('donation_trip')?></p>
            <a href="<?= mf_get_page_url('archive-trip.php');?>" class="view-more-link view-more-link--push-bottom"><?= __('Aller a la page voyages','mf');?></a>
        </article>
    </section>
</div>
<!--comment soutien-->
<div class="section-wrapper partners-wrapper" style="background:linear-gradient(90deg,rgba(0,0,0,.73) 33%,rgba(0,0,0,.30) 100%),url(<?php the_field('partners_background');?>) no-repeat center center;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;max-width: 100%;">
    <section class="section section--mb-16 donation-section">
        <div class="section__header section__header--to-start">
            <h2 class="section__title section__title--to-left"><?= __('Qui sont nos partenaires','mf');?></h2>
            <p class="section__intro">
                <?php the_field('partners_content',false,false)?>
            </p>
        </div>
        <article class="donation-section__partners-list partners-list">
            <h3 class="hidden"><?= __('Liste de nos partenaires','mf');?></h3>
            <?php

            // check if the repeater field has rows of data
            if( have_rows('partners_list') ):?>

            <?php    // loop through the rows of data
            while ( have_rows('partners_list') ) : the_row();?>

            <?php // display a sub field value
            $image = get_sub_field('partner_logo');?>
                <?php if (get_sub_field('partner_url')): ?>
                <a class="partners-list__element" href="<?php the_sub_field('partner_url');?>">
                    <span class="hidden"><?= __('Aller au site de');?><?php the_sub_field('partner_name');?></span>
                    <img src="<?= $image['url'];?>" alt="<?= $image['alt'];?>">
                </a>
                <?php else:?>
                    <span class="partners-list__element">
                        <img src="<?= $image['url']?>" alt="<?= $image['alt'];?>">
                    </span>
            <?php endif;?>
        <?php endwhile;?>
    <?php endif;?>
</article>
</section>
</div>
<!--nos partenaires-->
<?php get_footer();?>
