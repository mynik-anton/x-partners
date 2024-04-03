<section class="cities">
    <h2 class="mb-4">База городов</h2>
    <div class="row">
        <?php
        $args = array(
            'post_type' => 'cities',
            'posts_per_page' => 9,
            'order' => 'DESC',
            'orderby' => 'date'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('loop-templates/content', 'cities-main');
            }
            wp_reset_postdata();
        } else {
            echo 'Посты не найдены.';
        }
        ?>
    </div>
</section>