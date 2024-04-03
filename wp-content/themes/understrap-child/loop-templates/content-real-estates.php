<?php

/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article id="post-<?php the_ID(); ?>">



    <?php the_title('<h1 class="entry-title mb-4">', '</h1>'); ?>




    <div class="row">

        <div class="col-md-6">
            <?php
            if (get_the_post_thumbnail_url()) {
                $thumbnail_id = get_post_thumbnail_id();
                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            ?>
                <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?= $alt; ?>" />
            <?php
            }
            ?>
        </div>


        <div class="col-md-6 ">
            <div class="entry-content mt-4 ">

                <?php if (get_field('real-estates-square')) { ?>
                    <div class="h3">Площадь: <?php the_field('real-estates-square') ?></div>
                <?php } ?>

                <?php if (get_field('real-estates-price')) { ?>
                    <div class="h3">Стоимость: <?php the_field('real-estates-price') ?></div>
                <?php } ?>

                <?php if (get_field('real-estates-adres')) { ?>
                    <div class="h3">Адрес: <?php the_field('real-estates-adres') ?></div>
                <?php } ?>

                <?php if (get_field('real-estates-living-square')) { ?>
                    <div class="h3">Жилая площадь: <?php the_field('real-estates-living-square') ?></div>
                <?php } ?>

                <?php if (get_field('real-estates-floor')) { ?>
                    <div class="h3">Этаж: <?php the_field('real-estates-floor') ?></div>
                <?php } ?>

                <?php
                the_content();
                understrap_link_pages();
                ?>
            </div>

        </div><!-- .entry-content -->

    </div>



    <footer class="entry-footer mt-4">

        <?php understrap_entry_footer(); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->