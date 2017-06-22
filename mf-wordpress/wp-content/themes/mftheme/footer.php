</main>
<footer class="footer-section">
    <?php if(is_page(mf_get_page_id('contact.php')) || is_front_page()):?>
    <a href="https://maps.google.com?daddr=15+avenue+de+la+gare+6000+Bastogne" class="card-wrapper">
        <section class="card-section">
            <h2 class="card__title hidden"><?= __('Contact information','mf');?></h2>
            <div class="card-info" itemref="sociallinks" itemscope itemtype="http://schema.org/Organization">
                <span class="card__name" itemprop="name"><?= __('ASBL Mariam Faso','mf');?></span>
                <div class="card__address card--icon card--icon-location" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span class="card__street" itemprop="streetAddress"><?php the_field('contact_street',mf_get_page_id('contact.php'));?></span>
                    <span class="card__postal" itemprop="postalCode"><?php the_field('contact_postal',mf_get_page_id('contact.php'));?></span>
                    <span class="card__locality" itemprop="addressLocality"><?php the_field('contact_city',mf_get_page_id('contact.php'));?></span>
                </div>
                <span class="card__tel card--icon card--icon-tel" itemprop="telephone"><?php the_field('contact_tel',mf_get_page_id('contact.php'));?></span>
                <span class="card__email card--icon card--icon-email" itemprop="email"><?php the_field('contact_email',mf_get_page_id('contact.php'));?></span>
            </div>
        </section>
    </a>
<?php endif;?>
    <div class="footer-social">
        <h2 class="footer-social__title"><?= __('Suivez nous sur','mf');?></h2>
        <div class="footer-social__links" id="sociallinks">
            <link itemprop="url" href="<?php the_permalink();?>">
            <a itemprop="sameAs" href="https://www.facebook.com/MariamFaso" class="footer-social__link footer-social__link-fb">Facebook</a>
            <a itemprop="sameAs" href="<?php the_permalink();?>" class="footer-social__link footer-social__link-tw">Twitter</a>
            <a itemprop="sameAs" href="<?php the_permalink();?>" class="footer-social__link footer-social__link-in">Instagram</a>
        </div>
    </div>

    <div class="footer-credits" role="contentinfo">
        <nav class="footer-nav">
            <h2 class="footer-nav__title hidden" ><?= __('Footer navigation','mf');?></h2>
            <?php foreach (mf_get_nav_items('header') as $item): ?>
                <a href="<?= $item->url;?>" class="footer-nav__element"><?= $item->label;?></a>
            <?php endforeach; ?>
            <a href="#" class="footer-nav__element"><?= __('Sitemap','mf');?></a>
        </nav>
        <p ><?= __('© 2017 Mariam Faso tous droits réservés','mf');?></p>
        <p class="footer-credits__designer"><?= __('Faite avec &#10084; par ','mf');?><a href="http://www.martinz.be">Martinz</a></p>
    </div>
</footer>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php theme_asset('/js/script.js')?>"></script>
<script type="text/javascript" src="<?php theme_asset('/js/lightbox-plus-jquery.min.js')?>"></script>
</body>
</html>
