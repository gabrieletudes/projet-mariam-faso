<?php
/*
Template Name: About
*/
get_header();
?>
<div class="section-wrapper section-wrapper--almost-white">
    <div class="section about-section">
        <article class="about-section__article">
            <h2 class="about-section__article-title"><?php the_field('page_title');?></h2>
            <div class="about-section__article-content"><?php the_field('about_content', false, true);?>
            </div>
        </article>
        <aside role="complementary" class="handy-aside">
            <h2 class="handy-aside__title"><?= __('Quelques infos intéressantes','mf');?></h2>
            <div id="organization" itemref="compte" class="handy-aside-info" itemscope itemtype="http://schema.org/Organization">
                <span class="handy-aside__label"><?= __('Nom','mf');?></span>
                <p class="handy-aside__name" itemprop="name"><?= __('ASBL Mariam Faso','mf');?></p>
                <span class="handy-aside__label"><?= __('President','mf');?></span>
                <p class="handy-aside__founder" itemprop="founder"><?php the_field('president_name',mf_get_page_id('contact.php'));?></p>
                <a class="handy-aside__tel" href="tel:+32479215744" itemprop="telephone"><?php the_field('contact_tel',mf_get_page_id('contact.php'));?></a>
                <a href="mailto:<?php the_field('contact_email',mf_get_page_id('contact.php'));?>" class="handy-aside__email" itemprop="email"><?php the_field('contact_email',mf_get_page_id('contact.php'));?></a>
                <span class="handy-aside__label"><?= __('N° d’entreprise','mf');?></span>
                <p class="handy-aside__name" itemprop="taxID"><?php the_field('contact_companynumber',mf_get_page_id('contact.php'));?></p>
                <span class="handy-aside__label"><?= __('Notre adressé','mf');?></span>
                <div class="handy-aside__address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span class="handy-aside__street" itemprop="streetAddress"><?php the_field('contact_street',mf_get_page_id('contact.php'));?></span>
                    <span class="handy-aside__postal" itemprop="postalCode"><?php the_field('contact_postal',mf_get_page_id('contact.php'));?></span>
                    <span class="handy-aside__locality" itemprop="addressLocality"><?php the_field('contact_city',mf_get_page_id('contact.php'));?></span>
                </div>
                <div itemscope id="compte" itemprop="bankAccount">
                    <span class="handy-aside__label"><?= __('Compte bancaire','mf');?></span>
                    <p class="handy-aside__name" itemprop="bankAccount"><?php the_field('contact_banca',mf_get_page_id('contact.php'));?></p>
                </div>
                <span class="handy-aside__label"><?= __('Membres actives');?></span>
                <p class="handy-aside__name" itemprop="numberOfEmployees"><?= __('30+','mf');?></p>
            </div>
        </aside>
    </div>
</div>

<!--A few projects-->
<?php get_template_part('partials/content','objectives')?>
<!--A few News articles-->
<?php get_template_part('partials/content','fewnews')?>
<!--A few projects-->
<?php get_template_part('partials/content','fewprojects')?>
<?php get_footer();?>
