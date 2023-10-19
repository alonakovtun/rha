<?php

/**
 * Template name: Home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cocktail-club
 */


get_header();
?>

<main id="primary" class="site-main home-page">

    <div class="right-content">
     <div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a></p>
				<?php
			endif; ?>
			
		</div><!-- .site-branding -->

        <div class="title-block">
            <div class="title">
                <?= get_field('title') ?>
            </div>
            <div class="subtitle">
                <?= get_field('subtitle') ?>
            </div>
        </div>

        <div id="chapters" class="chapters-block">
            <div class="title"> <?= get_field('title_content') ?> </div>

            <div class="chapters">
                <?php if (have_rows('chapters')) : ?>
                    <?php while (have_rows('chapters')) : the_row();
                        $link = get_sub_field('link_chapter');
                    ?>
                        <?php
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                            <a class="link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <span class="chapter-title"><?php echo esc_html($link_title); ?>:</span>
                                <span class="chapter-subtitle"><?= get_sub_field('subtitle'); ?></span>

                            </a>
                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="site-footer">

            <div class="contact-info">
                <p class="title">
                    <?= get_field('footer_title', 'option') ?>
                </p>

                <div class="links">
                    <?php if (have_rows('contact', 'option')) : ?>
                        <?php while (have_rows('contact', 'option')) : the_row();
                            $image = get_sub_field('icon');
                            $link = get_sub_field('link');
                        ?>

                            <?php

                            if ($link) :
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                                <a class="link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                    <img src="<?= $image; ?>" alt="">
                                    <?php echo esc_html($link_title); ?>
                                </a>
                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>


                <?php $pdf = get_field('pdf', 'option') ?>
            </div><!-- .contact-info -->

            <?php if ($pdf) : ?>
                <a class="pdf" href="<?= $pdf['file']['url']; ?>" target="_blank">
                    <span class="pdf-title">
                        <?= $pdf['text']; ?>
                    </span>
                    <img src="<?= $pdf['icon']['url']; ?>" alt="">
                </a>
            <?php endif; ?>



        </div><!-- #colophon -->

    </div>



    <div class="main-image">
        <img class="image" src="<?= get_field('left_image') ?>" alt="">
    </div>




</main>

<?php
get_footer();