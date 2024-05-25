<?php

//启用预览
add_theme_support('post-thumbnails');



//禁用工具栏
add_filter('show_admin_bar', '__return_false');

//自动创建search的page
function create_search_page_on_theme_activation() {
    // 检查是否已经存在名为 "search" 的页面
    $search_page = get_page_by_path('search');

    if (!$search_page) {
        // 页面不存在，则创建该页面
        $new_page_id = wp_insert_post(array(
            'post_title'     => 'Search',
            'post_name'      => 'search',
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_author'    => 1,
            'page_template'  => 'page-search.php' // 使用你创建的模板文件
        ));

        if (!is_wp_error($new_page_id)) {
            // 页面创建成功，可以在此处执行其他操作
        }
    }
}
add_action('after_switch_theme', 'create_search_page_on_theme_activation');

//标签
function display_random_tags($number = 5) {
    // 获取所有标签
    $tags = get_tags();

    // 如果标签少于等于需要显示的数量，直接展示全部标签
    if (count($tags) <= $number) {
        $random_tags = $tags;
    } else {
        // 打乱标签顺序并取前 $number 个标签
        shuffle($tags);
        $random_tags = array_slice($tags, 0, $number);
    }

    // 输出标签链接
    echo '<div class="random-tags">';
    foreach ($random_tags as $tag) {
        $tag_link = get_tag_link($tag->term_id);
        echo '<a href="' . esc_url($tag_link) . '" class="tag-link">' . esc_html($tag->name) . '</a> ';
    }
    echo '</div>';
}


// 更改logo
add_action( 'login_enqueue_scripts', 'custom_login_logo' );
function custom_login_logo() {
    echo '<style type="text/css">
        #login h1 a {
            font-family: "微软雅黑"!important;
            background-image: none;
            text-indent: 0;
            display: block;
            width: auto;
            height: auto;
            font-size: 50px;
            color: #000;
            text-decoration: none;
            font-weight: lighter;
        }
        #wp-submit{
            background: #059377;
        }
        .login .success{
            border-left: 4px solid #059377!important;
        }
    </style>';
}
add_action('login_head', 'custom_login_logo');

function custom_login_logo_text() {
    return 'LeeLibrary';
}
add_filter('login_headertext', 'custom_login_logo_text');








// 处理语言切换
add_action('init', 'handle_language_switch');

function handle_language_switch() {
    // 开启会话以便存储语言选择
    if (!session_id()) {
        session_start();
    }

    // 检查是否有语言选择参数
    if (isset($_GET['wp_lang'])) {
        $selected_lang = $_GET['wp_lang'];

        // 存储语言选择在会话中
        $_SESSION['wp_lang'] = $selected_lang;
    }

}






