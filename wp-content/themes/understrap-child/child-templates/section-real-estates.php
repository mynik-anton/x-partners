<section class="real-estates">
    <h2 class="mb-4">Объекты недвижимости</h2>
    <div class="row">
        <?php
        $args = array(
            'post_type' => 'real-estates',
            'posts_per_page' => 9,
            'order' => 'DESC',
            'orderby' => 'date'
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