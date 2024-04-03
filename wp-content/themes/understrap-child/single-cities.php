<?php

/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">


            <main class="site-main" id="main">

                <h1 class="mb-4"><?php the_title(); ?></h1>

                <section class="real-estates">

                    <div class="row">
                        <?php
                        $current_post_id = get_the_ID();

                        // Аргументы запроса
                        $args = array(
                            'post_type' => 'real-estates',
                            'posts_per_page' => 9,
                            'meta_query' => array(
                                array(
                                    'key' => 'real_estates_city',
                                    'value' => $current_post_id,
                                    'compare' => '='
                                )
                            ),
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('loop-templates/content', 'real-estates-main');
                            }
                            wp_reset_postdata();
                        } else {
                            echo 'Посты не найдены.';
                        }
                        ?>
                    </div>
                </section>

            </main>



        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
