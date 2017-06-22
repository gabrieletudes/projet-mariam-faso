<?php
//Setup pagination variables
$gallery = get_field('project_photos',59); // Get our gallery
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
    <div class="section-wrapper section-wrapper--almost-white">
        <section class="section photos-section">
            <header class="section__header">
                <h2 class="section__title"><?= __('Quelques photos de nos plus recent voyage','mf') ?></h2>
            </header>
            <?php foreach( $images as $image ):?>
                <?php if($i < $items_per_page): $i++?>
                    <a class="photos-section__img" data-lightbox="trip" href="<?php echo $image['url']; ?>">
                        <img src="<?= $image['sizes']['gallery-small']; ?>" alt="<?= $image['alt']; ?>" />
                    </a>
                <?php endif;?>
            <?php endforeach; ?>
        </section>
        <div class="button-wrapper">
            <a href="<?= mf_get_page_url('archive-trip.php');?>" class="cta-button "><?= __('Voir des autres images','mf');?></a>
        </div>
    </div>
<?php endif;?>
