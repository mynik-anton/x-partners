<form id="add_real_estate_form" enctype="multipart/form-data" class="mt-4 mb-4">
    <h2 class="mb-4">Форма для добавления объекта недвижимости</h2>
    <div class="row">
        <div class="col-md-12 mb-3">
            <input class="form-control" type="text" name="real_estates_title" placeholder="Заголовок" required>
        </div>
        <div class="col-md-6 mb-3">
            <div class="custom-file">
                <input type="file" class="form-control custom-file-input" name="real_estates_image" id="real_estates_image" accept="image/*" aria-describedby="image" required>
                <label class="custom-file-label" for="real_estates_image" data-browse="Выбрать">Выбрать изображение</label>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input class="form-control" type="text" name="real_estates_square" placeholder="Площадь" required>
        </div>
        <div class="col-md-6 mb-3">
            <input class="form-control" type="text" name="real_estates_price" placeholder="Стоимость" required>
        </div>
        <div class="col-md-6 mb-3">
            <input class="form-control" type="text" name="real_estates_adres" placeholder="Адрес" required>
        </div>
        <div class="col-md-6 mb-3">
            <input class="form-control" type="text" name="real_estates_living_square" placeholder="Жилая площадь" required>
        </div>
        <div class="col-md-6 mb-3">
            <input class="form-control" type="text" name="real_estates_floor" placeholder="Этаж" required>
        </div>
        <div class="col-md-6 mb-3">
            <?php
            $cities = get_posts(array(
                'post_type' => 'cities',
                'posts_per_page' => -1,
            ));
            // Выводим выпадающий список с городами    
            echo '<select class="form-control" style="width:100%" name="real_estates_city" id="real_estates_city">';
            echo '<option value="">Выберите город</option>';
            foreach ($cities as $city) {
                echo '<option value="' . $city->ID . '" ' . selected(get_post_meta($post->ID, 'real_estates_city', true), $city->ID, false) . '>' . $city->post_title . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <div class="col-md-6 mb-3">
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'real-estates-category',
                'hide_empty' => false,
            ));
            // Выводим выпадающий список с категориями    
            echo '<select class="form-control" style="width:100%" name="real_estates_category" id="real_estates_category">';
            echo '<option value="">Выберите категорию</option>';
            foreach ($categories as $category) {
                echo '<option value="' . $category->term_id . '" ' . selected(get_post_meta($post->ID, 'real_estates_category', true), $category->term_id, false) . '>' . $category->name . '</option>';
            }
            echo '</select>';
            ?>
        </div>
    </div>
    <button id="real_estates_button" class="btn btn-primary" type="submit">Добавить объект недвижимости</button>
</form>

<div class="modal fade" id="successMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Объект недвижимости успешно добавлен!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть окно</button>
            </div>
        </div>
    </div>
</div>

<div class="page-loader">
    <div class="spinner-border"></div>
</div>