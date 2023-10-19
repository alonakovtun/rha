<?php

/**
 * Template name: Post page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cocktail-club
 */


get_header();
?>

<main id="primary" class="site-main post-page">
    <div class="site-branding">
        <?php
        the_custom_logo();
        if (is_front_page() && is_home()) :
        ?>
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"></a></h1>
        <?php
        endif; ?>

        <div class="title-page">
            <?= the_title(); ?>:
            <span class="chapter-title"><?= the_field('chapter_title')?></span>
        </div>

    </div><!-- .site-branding -->

    <div class="content-block">
        <div class="block">
        <?php if (have_rows('content')) : ?>
            <?php while (have_rows('content')) : the_row();
                $text = get_sub_field('text');
                $image = get_sub_field('image');
            ?> 

            <div class="content">
                <?= $text; ?>
            </div>

            <?php if($image): ?>
                <img src="<?= $image; ?>" alt="">
            <?php endif; ?>

            <?php endwhile; ?>
            <?php endif; ?>
    </div>
        </div>
      



</main>

<?php
//get_footer();