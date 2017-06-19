<?php
/*
 Template Name: Agenda Page
*/
get_header();
?>
<div class="section-wrapper">
    <section class="section section--mb-16">
        <div class="section__header section__header--to-start section__header--no-marg">
            <h2 class="section__title section__title--to-left"><?php nop_the_field('currentpage_title'); ?></h2>
            <p class="section__intro">
                <?php nop_the_field('currentpage_content'); ?>
            </p>
        </div>
    </section>
    <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
        <a href="<?= mf_get_page_url('archive-event.php');?>" class="cta-button  cta-button--mr-32 cta-button--no-mt">Voir nos derniers événements</a>
        <a href="<?= mf_get_page_url('archive-trip.php');?>" class="cta-button">Voir nos derniers voyages</a>
    </div>
</div>
<!--A few images from a trip-->
<?php get_template_part('partials/content','fewgallery')?>
<!--CTA Trip-->
<?php get_template_part('partials/content','ctatrip')?>
<!--A few News articles-->
<?php get_template_part('partials/content','fewnews')?>

<?php get_footer();?>
