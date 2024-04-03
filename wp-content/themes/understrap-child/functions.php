<?php
function child_theme_enqueue_scripts()
{
    // Подключение скриптов
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), null, true);
    wp_localize_script('script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_scripts');


function child_theme_enqueue_style()
{
    // Подключение стилей
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/css/style.css');
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_style');


add_action('init', 'register_theme_post_type');
function register_theme_post_type()
{
    register_taxonomy('real-estates-category', array('real-estates'), array(
        'label'        => '',
        'labels'       => array(
            'name'              => 'Категории Недвижимости',
            'singular_name'     => 'Категория',
            'search_items'      => 'Поиск вкладок',
            'all_items'         => 'Все категорий',
            'view_item '        => 'Просмотр категории',
            'parent_item'       => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item'         => 'Редактировать категорию',
            'update_item'       => 'Обновить категорию',
            'add_new_item'      => 'Добавить новую категорию',
            'new_item_name'     => 'Новое имя категории',
            'menu_name'         => 'Категории Недвижимость',
        ),
        'hierarchical' => true,
        'public'       => true,
        'show_in_nav_menus'     => true,
    ));

    register_post_type('real-estates', array(
        'labels'        => array(
            'name'               => 'Недвижимость',
            'singular_name'      => 'Блок Недвижимость',
            'add_new'            => 'Добавить Недвижимость',
            'add_new_item'       => 'Добавить новую Недвижимость',
            'edit_item'          => 'Редактировать Недвижимость',
            'new_item'           => 'Новая Недвижимость',
            'view_item'          => 'Посмотреть Недвижимость',
            'search_items'       => 'Найти Недвижимость',
            'not_found'          => 'Недвижимость не найдена',
            'not_found_in_trash' => 'В корзине Недвижимость не найдена',
            'parent_item_colon'  => '',
            'menu_name'          => 'Недвижимость'

        ),
        'public'        => true,
        'show_ui'       => true,
        'show_in_nav_menus'     => true,
        'exclude_from_search' => 0,
        'menu_icon'     => 'dashicons-building',
        'hierarchical'  => false,
        'has_archive'   => 'real-estates',
        'can_export'    => true,
        'menu_position' => 3,
        'supports'      => array('title', 'editor', 'thumbnail'),
    ));


    register_post_type('cities', array(
        'labels'        => array(
            'name'               => 'База Городов',
            'singular_name'      => 'Блок База Городов',
            'add_new'            => 'Добавить Город',
            'add_new_item'       => 'Добавить новый Город',
            'edit_item'          => 'Редактировать Город',
            'new_item'           => 'Новый Город',
            'view_item'          => 'Посмотреть Город',
            'search_items'       => 'Найти Город',
            'not_found'          => 'Город не найден',
            'not_found_in_trash' => 'В корзине Город не найден',
            'parent_item_colon'  => '',
            'menu_name'          => 'База Городов'

        ),
        'public'        => true,
        'show_ui'       => true,
        'show_in_nav_menus'     => true,
        'exclude_from_search' => 0,
        'menu_icon'     => 'dashicons-book',
        'hierarchical'  => false,
        'has_archive'   => 'cities',
        'can_export'    => true,
        'menu_position' => 3,
        'supports'      => array('title', 'editor', 'thumbnail'),
    ));
}



// Добавление метабокса для поста "Недвижимость"
function add_real_estates_city_metabox()
{
    add_meta_box(
        'real_estates_city_metabox',
        'Выберите город',
        'render_real_estates_city_metabox',
        'real-estates',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_real_estates_city_metabox');

// Функция для отображения содержимого метабокса
function render_real_estates_city_metabox($post)
{
    // Получаем все посты из раздела "Города"
    $cities = get_posts(array(
        'post_type' => 'cities',
        'posts_per_page' => -1,
    ));

    // Выводим выпадающий список с городами    
    echo '<select style="width:100%" name="real_estates_city" id="real_estates_city">';
    echo '<option value="">Выберите город</option>';
    foreach ($cities as $city) {
        echo '<option value="' . $city->ID . '" ' . selected(get_post_meta($post->ID, 'real_estates_city', true), $city->ID, false) . '>' . $city->post_title . '</option>';
    }
    echo '</select>';
}

// Сохранение выбранного города при сохранении поста
function save_real_estates_city_metabox($post_id)
{
    if (array_key_exists('real_estates_city', $_POST)) {
        update_post_meta($post_id, 'real_estates_city', $_POST['real_estates_city']);
    }
}
add_action('save_post', 'save_real_estates_city_metabox');



//ajax форма
add_action('wp_ajax_add_real_estate', 'add_real_estate_callback');
add_action('wp_ajax_nopriv_add_real_estate', 'add_real_estate_callback');

function add_real_estate_callback()
{

    $response = array();

    $real_estates_title = sanitize_text_field($_POST['real_estates_title']);
    $real_estates_image = $_FILES['real_estates_image'];
    $real_estates_square = sanitize_text_field($_POST['real_estates_square']);
    $real_estates_price = sanitize_text_field($_POST['real_estates_price']);
    $real_estates_adres = sanitize_text_field($_POST['real_estates_adres']);
    $real_estates_living_square = sanitize_text_field($_POST['real_estates_living_square']);
    $real_estates_floor = sanitize_text_field($_POST['real_estates_floor']);
    $real_estates_city = sanitize_text_field($_POST['real_estates_city']);
    $real_estates_category = sanitize_text_field($_POST['real_estates_category']);

    // Создание поста типа "real-estates"
    $new_post = array(
        'post_title' => $real_estates_title,
        'post_type' => 'real-estates',
        'post_status' => 'publish'
    );

    $post_id = wp_insert_post($new_post);

    if (is_wp_error($post_id)) {
        $response['success'] = false;
        $response['message'] = 'Ошибка при создании поста: ' . $post_id->get_error_message();
    } else {
        // Сохранение мета полей
        update_post_meta($post_id, 'real-estates-square', $real_estates_square);
        update_post_meta($post_id, 'real-estates-price', $real_estates_price);
        update_post_meta($post_id, 'real-estates-adres', $real_estates_adres);
        update_post_meta($post_id, 'real-estates-living-square', $real_estates_living_square);
        update_post_meta($post_id, 'real-estates-floor', $real_estates_floor);
        update_post_meta($post_id, 'real_estates_city', $real_estates_city);


        // Добавление таксономии "real-estates-category" к посту по ее ID
        wp_set_post_terms($post_id, array($real_estates_category), 'real-estates-category');

        // Обработка загруженного изображения
        if (!empty($real_estates_image['name'])) {
            $upload_overrides = array('test_form' => false);
            $uploaded_image = wp_handle_upload($real_estates_image, $upload_overrides);

            if (!empty($uploaded_image['url'])) {
                $image_id = wp_insert_attachment(array(
                    'post_title' => $real_estates_title,
                    'post_content' => '',
                    'post_status' => 'inherit',
                    'post_mime_type' => $uploaded_image['type'],
                    'guid' => $uploaded_image['url']
                ), $uploaded_image['file'], $post_id);

                set_post_thumbnail($post_id, $image_id);
            }
        }


        $response['success'] = true;
        $response['message'] = 'Объект недвижимости успешно добавлен!';
    }

    echo json_encode($response);
    wp_die();
}






add_action('init', 'disable_comments');
function disable_comments()
{
    // Отключаем поддержку комментариев для постов и страниц
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
    // Закрываем возможность комментирования в админке
    update_option('default_comment_status', 'closed');
    // Удаляем комментарии из админ-бара
    add_action('admin_bar_menu', 'remove_comments_admin_bar', 999);
    function remove_comments_admin_bar($wp_admin_bar)
    {
        $wp_admin_bar->remove_node('comments');
    }
    // Удаляем комментарии из меню админки
    add_action('admin_menu', 'remove_comments_menu');
    function remove_comments_menu()
    {
        remove_menu_page('edit-comments.php');
    }
    // Перенаправляем пользователя при попытке доступа к странице комментариев
    add_action('admin_init', 'disable_comments_admin_redirect');
    function disable_comments_admin_redirect()
    {
        global $pagenow;
        if ($pagenow === 'edit-comments.php') {
            wp_redirect(admin_url());
            exit;
        }
    }
}

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('auto_update_plugin', '__return_false');

add_filter('auto_update_core', '__return_false');
