<div class="objectives-wrapper">
    <div class="objectives-section">
        <h2 class="objectives-section__title"><?= __('Nos objectifs','mf');?></h2>
        <?php the_field('our_objectives');?>
        <a href="<?= mf_get_page_url('donation.php');?>" class="cta-button cta-button--to-start cta-button--mt-44"><?= __('Soutenez nos projets','mf')?></a>
    </div>
</div>
