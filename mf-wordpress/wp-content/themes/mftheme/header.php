<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php theme_asset('/css/styles.css')?>">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/cropped-icon.png" />
    <title><?= custom_wp_title( get_field('page_title') ? get_field('page_title') : $post->post_title);?></title>
</head>
<body>
    <header class="header" style="background: linear-gradient(1deg, rgba(0, 0, 0, 0.6) 16%, rgba(0, 0, 0, 0.1) 43%, rgba(0, 0, 0, 0.7) 74%),url(<?php the_field('header_image');?>) no-repeat center center;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover; max-width: 100%;">
        <h1 class="header__title hidden"><?php bloginfo('name');?> — <?= get_field('page_title') ? get_field('page_title') : $post->post_title;?></h1>
        <div class="container">
            <div class="menu-wrapper">
                <div class="logo-wrapper">
                    <a href="<?= home_url(); ?>" class="logo"><img src="<?php theme_asset('/img/logo.svg')?>" alt="<?= __('Logo Mariam Faso','mf')?>" rel="<?= __('Logo Mariam Faso','mf')?>"></a>
                    <a role="button"  aria-haspopup="true" href="#" class="header__icon" id="js-header-icon"><?=__('Menu','mf')?></a>
                </div>
                <nav class="main-nav" id="js-responsive-nav">
                    <h2 class="main-nav__title hidden" ><?= __('Main navigation','mf')?></h2>
                    <?php foreach (mf_get_nav_items('header') as $item): ?>
                        <a href="<?= $item->url;?>" class="main-nav__element main-nav__element--<?= $item->icon;?>"><?= $item->label;?></a>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div class="header-title__wrapper">
                <h2 class="header__title">
                    <?php if(get_field('header_introduction')):?>
                        <?php nop_the_field('header_introduction');?>
                    <?php elseif(get_field('page_title')):?>
                        <?php nop_the_field('page_title');?>
                    <?php elseif(get_field('currentpage_title')):?>
                        <?php nop_the_field('currentpage_title');?>
                    <?php else:?>
                        <?=$post->post_title?>
                    <?php endif;?>
                </h2>
                <?php if (is_front_page()): ?>
                    <a href="<?= mf_get_page_url('donation.php')?>" class="cta-button cta-button--mt-44"><?= __('Soutenez nos projets','mf')?></a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="main">
        <?php if (!is_front_page()): ?>
            <?php get_template_part('partials/content','breadcrumbs');?>
        <?php endif; ?>
