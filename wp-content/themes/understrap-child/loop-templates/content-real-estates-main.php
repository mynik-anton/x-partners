<?php

/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>


<div class="col-lg-4 col-md-6 mb-4">
    <?php
    if (get_the_post_thumbnail_url()) {
        $thumbnail_id = get_post_thumbnail_id();
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    ?>
        <a href="<?= get_permalink() ?>" class="d-block mb-3">
            <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?= $alt; ?>" />
        </a>
    <?php
    }
    ?>

    <a href="<?= get_permalink() ?>" class="h3 mb-2 d-block"><?php the_title() ?></a>

    <ul>
        <?php if (get_field('real-estates-square')) { ?>
            <li>Площадь: <?php the_field('real-estates-square') ?></li>
        <?php } ?>

        <?php if (get_field('real-estates-price')) { ?>
            <li>Стоимость: <?php the_field('real-estates-price') ?></li>
        <?php } ?>

        <?php if (get_field('real-estates-adres')) { ?>
            <li>Адрес: <?php the_field('real-estates-adres') ?></li>
        <?php } ?>

        <?php if (get_field('real-estates-living-square')) { ?>
            <li>Жилая площадь: <?php the_field('real-estates-living-square') ?></li>
        <?php } ?>

        <?php if (get_field('real-estates-floor')) { ?>
            <li>Этаж: <?php the_field('real-estates-floor') ?></li>
        <?php } ?>
    </ul>
</div>