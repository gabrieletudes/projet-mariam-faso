<?php
/*
Template name: Contact Page

*/
get_header();
?>
<div class="section-wrapper section-wrapper--almost-white">
    <section class="section contact-section">
        <div class="section__header section__header--to-start">
            <h2 class="section__title section__title--to-left"><?php nop_the_field('currentpage_title'); ?></h2>
            <p class="section__intro">
            </p>
        </div>
        <?php the_field('contact_form');?>
        <div id="organization" itemref="compte" class="contact-info" itemscope itemtype="http://schema.org/Organization">
            <dl class="contact-info__content hidden">
                <dt class="contact-info__label"><?= __('Nom','mf');?></dt>
                <dd class="contact-info__data" itemprop="name"><?=__('ASBL Mariam Faso','mf');?></dd>
            </dl>
            <dl class="contact-info__content">
                <dt class="contact-info__label"><?= __('President','mf');?></dt>
                <dd class="contact-info__data" itemprop="founder"><?php the_field('president_name');?></dd>
            </dl>
            <dl class="contact-info__content">
                <dt class="contact-info__label"><?= __('Notre adressé','mf');?></dt>
                <dd class="contact-info__data" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span class="contact-info__street" itemprop="streetAddress"><?php the_field('contact_street');?></span>
                    <span class="contact-info__postal" itemprop="postalCode"><?php the_field('contact_postal');?></span>
                    <span class="contact-info__locality" itemprop="addressLocality"><?php the_field('contact_city');?></span>
                </dd>
            </dl>
            <dl class="contact-info__content">
                <dt class="contact-info__label"><?= __('Telephone','mf');?></dt>
                <dd class="contact-info__data"><a href="tel:+32479215744" itemprop="telephone"><?php the_field('contact_tel');?></a></dd>
            </dl>
            <dl class="contact-info__content">
                <dt class="contact-info__label"><?= __('Email','mf');?></dt>
                <dd class="contact-info__data">
                    <a href="mailto:<?php the_field('contact_email');?>" class="contact-info__email" itemprop="email"><?php the_field('contact_email');?></a>
                </dd>
            </dl>
            <dl class="contact-info__content" id="compte" itemscope itemtype="http://schema.org/Thing">
                <dt class="contact-info__label" itemprop="name"><?= __('Compte bancaire','mf');?></dt>
                <dd class="contact-info__data" itemprop="description"><?php the_field('contact_banca');?></dd>
            </dl>
            <dl class="contact-info__content">
                <dt class="contact-info__label"><?= __('N° d’entreprise','mf');?></dt>
                <dd class="contact-info__data" itemprop="taxID"><?php the_field('contact_companynumber');?></dd>
            </dl>
            <p class="contact-info__title-in-between">
                <?= __('Autres membres','mf');?>
            </p>
            <div class="contact-info">
                <dl class="contact-info__content" itemprop="employees" itemscope itemtype="http://schema.org/Person">
                    <dt class="contact-info__label" itemprop="jobTitle"><?= __('Administrateur et secrétaire','mf');?></dt>
                    <dd class="contact-info__data" itemprop="name"><?php the_field('contact_secretary');?></dd>
                </dl>
                <dl class="contact-info__content" itemprop="employees" itemscope itemtype="http://schema.org/Person">
                    <dt class="contact-info__label" itemprop="jobTitle"><?= __('Trésorière','mf');?></dt>
                    <dd class="contact-info__data" itemprop="name"><?php the_field('contact_treasurer');?></dd>
                </dl>
                <dl class="contact-info__content" itemprop="employees" itemscope itemtype="http://schema.org/Person">
                    <dt class="contact-info__label" itemprop="jobTitle"><?= __('Administrateurs','mf');?></dt>
                    <?php

                    // check if the repeater field has rows of data
                    if( have_rows('contact_administrators') ):?>

                    <?php    // loop through the rows of data
                    while ( have_rows('contact_administrators') ) : the_row();?>
                    <dd class="contact-info__data" itemprop="name"><?php the_sub_field('administrator_name');?></dd>
                <?php endwhile;?>
            <?php endif;?>
        </dl>
    </div>
</div>
</section>
</div>
<!--Contact information-->
<div class="section-wrapper section-wrapper--almost-white">
    <section class="section contact-section">
        <div class="section__header section__header--to-start">
            <h2 class="section__title section__title--to-left"><?= __('Avez vous une question ou une sougestion ?','mf');?></h2>
            <p class="section__intro">
                <?= __('Les champs avec un','mf');?><span class="required-elt">*</span><?= __('sont obligatoire. Nous ne partagerons pas votre e-mail avec des tiers','mf')?>
            </p>
        </div>
        <div class="contact-info">
            <form action="#" method="get" class="contact-form">
                <label class="contact-form__label" for="nom"><?= __('Bonjour je m’appelle','mf');?> <span class="required-elt">*</span></label>
                <div class="contact-form__status contact-form__status--invalid">
                    <input type="text" name="nom" placeholder="ex. Marco Polo" value="" id="nom" class="contact-form__input" aria-describedby="nom-error" required="required" aria-required="true"/>
                    <span id="nom-error"><?= __('Le champ nom ne peut pas etre vide','mf');?></span>
                </div>
                <label  class="contact-form__label" for="sujet"><?= __('j’voudrais demander/proposer','mf');?></label>
                <div class="contact-form__status">
                    <input type="text" id="sujet" name="sujet" placeholder="Ecrivez ici le sujet" value="" class="contact-form__input" />
                </div>
                <label class="contact-form__label contact-form__label--line-1-4" for="message"><?= __('à ce sujet je tiens à dire','mf')?></label>
                <textarea class="contact-form__textarea" id="message" name="message" placeholder="Ecrivez ici votre message" rows="8" cols="80"></textarea>
                <label class="contact-form__label" for="email"><?= __('Vous pouvez me contacter sur mon email','mf');?><span class="required-elt">*</span></label>
                <div class="contact-form__status contact-form__status--invalid">
                    <input class="contact-form__input" id="email" type="text" name="email" placeholder="ex. john@appleseed.com" value="" aria-describedby="email-error" required="required" aria-required="true">
                    <span id="email-error"><?= __('Le champ email ne peut pas être vide','mf');?></span>
                </div>
                <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
                    <button class="send-button send-button--next send-button--to-left" type="button" name="sent"><?= __('Envoyer mon message','mf');?></button>
                </div>
            </form>
        </div>
    </section>
</div>
<!--Contact Form-->
<div class="section-wrapper section-wrapper--very-light-grey">
    <section class="section contact-section">
        <div class="section__header section__header--to-start">
            <h2 class="section__title section__title--to-left"><?= __('FAQ','');?></h2>
            <p class="section__intro">
                <?= __('Ceux-ci sont les questions, les plus suivantes poses par nos visiteurs.','mf');?>
            </p>
        </div>
        <dl class="contact-section__faq">
            <?php

            // check if the repeater field has rows of data
            if( have_rows('contact_faq') ):?>

            <?php    // loop through the rows of data
            while ( have_rows('contact_faq') ) : the_row();?>
            <dt class="contact-section__question"><?php the_sub_field('contact_question',false,false);?></dt>
            <dd class="contact-section__answer"><?php the_sub_field('contact_answer',false,false);?></dd>
        <?php endwhile;?>
    <?php endif;?>
</dl>
</section>
</div>
<!--Contact FAQ-->
<?php get_footer();?>
