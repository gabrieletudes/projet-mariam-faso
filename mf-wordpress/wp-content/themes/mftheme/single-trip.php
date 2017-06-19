<?php get_header();?>
<!--debut voyage-->
<div class="section-wrapper">
    <div class="section article-section">
        <article class="article-section__article">
            <h2 class="article-section__title"><?php the_field('page_title');?></h2>
            <div class="article-section__labels-wrapper">
                <span class="article-section__label"><?= __('Du','mf');?></span>
                <time class="article-section__time" datetime="2017-11-03"><?php the_field('trip_start');?></time><span>au</span><time class="article-section__time" datetime="2017-11-03"><?php the_field('trip_end');?></time>
            </div>
            <div class="article-section__labels-wrapper">
                <span class="article-section__label"><?= __('Lieu','mf')?></span>
                <p class="article-section__place"><?= get_field('trip_destination') ? get_field('trip_destination') : __('Pas de lieu précisé','mf');?></p>
            </div>
            <span class="tag tag--orange"><?= __('voyage','mf');?></span>
            <div class="article-section__content">
                <?php the_field('trip_description');?>
            </div>
            <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
                <?php if (get_field('trip_link')): ?>
                    <a href="<?= mf_get_page_url('contact.php')?>" class="cta-button cta-button--mr-32"><?= __('Contactez-nous','mf');?></a>
                    <a href="<?php the_field('trip_link');?>" class="cta-button cta-button--mr"><?= __('Indiquer ma participation via Facebook','mf');?></a>
                <?php else:?>
                    <a href="<?= mf_get_page_url('contact.php')?>" class="cta-button cta-button--mr-32"><?= __('Contactez-nous','mf');?></a>
                <?php endif; ?>
            </div>
        </article>
    </div>
</div>
<!--Here starts the Gallery of this event-->
<?php
//Setup pagination variables
$gallery = get_field('event_photos'); // Get our gallery
$images = []; // Set images array for current page

$items_per_page  = 8; // How many items we should display on each page
$total_items = count($gallery); // How many items we have in total
$total_pages = ceil($total_items / $items_per_page); // How many pages we have in total
//Get current page
if ( get_query_var( 'paged' ) ) {
    $current_page = get_query_var( 'paged' );
}elseif ( get_query_var( 'page' ) ) {
    //this is just in case some odd rewrite, but paged should work instead of page here
    $current_page = get_query_var( 'page' );
}else{
    $current_page = 1;
}
$starting_point = (($current_page-1)*$items_per_page); // Get starting point for current page

// Get elements for current page
if($gallery){
    $images = array_slice($gallery,$starting_point,$items_per_page);
}?>
<?php if(!empty($images)):?>
    <div class="section-wrapper">
        <section class="section photos-section">
            <header class="section__header">
                <h2 class="section__title"><?= __('Des photos de ce voyage','mf')?></h2>
            </header>
            <?php foreach( $images as $image ):?>
                <?php if($i < $items_per_page): $i++?>
                    <a class="photos-section__img" href="<?php echo $image['url']; ?>">
                        <img src="<?php echo $image['sizes']['gallery-small']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>
                <?php endif;?>
            <?php endforeach;?>
        </section>
        <div class="button-wrapper button-wrapper--top button-wrapper--on-inversed">
            <a href="#" class="cta-button cta-button--on-inversed">Soutenez nos projets</a>
            <?php if($total_pages > 0 && $current_page <= $total_pages-1 && $current_page!=1):?>
                <a class="view-link view-link--previous view-link--to-right" href="<?= get_permalink().(($current_page-1)!=0 ? '&paged='.($current_page-1) : '');?>"><?=__('Previous','textdomain');?></a>
                <a class="view-link view-link--next" href="<?= get_permalink().'&paged='.($current_page+1);?>"><?=__('Next','textdomain');?></a>
            <?php elseif($total_pages >1 && $current_page<$total_pages && $current_page!=$total_pages):?>
                <a class="view-link view-link--next view-link--to-right" href="<?= get_permalink().'&paged='.($current_page+1);?>"><?=__('Next','textdomain');?></a>
            <?php else:?>
                <a class="view-link view-link--previous view-link--to-right" href="<?= get_permalink().(($current_page-1)!=0 ? '&paged='.($current_page-1) : '');?>"><?=__('Previous','textdomain');?></a>
            <?php endif;?>
        </div>
    </div>
<?php endif;?>
<!--A few events from the events page-->
<?php get_template_part('partials/content','fewevents')?>
<!--A few projects from the projects page-->
<?php get_template_part('partials/content','fewprojects')?>

<?php get_footer();?>
