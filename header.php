<!--语言-->
<?php
include('lang/langswitch.php');
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<script src="<?= get_template_directory_uri()?>/js/jquery.js"></script>
<link rel="stylesheet" href="<?= get_template_directory_uri()?>/style.css">
<script>
$(document).ready(function () {
    let dropdownVisible = false;


    var homeUrl = "<?= home_url()?>";
    // 对 URL 进行编码
    var encodedUrl = encodeURIComponent(homeUrl);
    // 构建登录链接
    var loginUrl = "<?= home_url()?>/wp-login.php?redirect_to=" + encodedUrl;
    $('.replace-link').attr('href', loginUrl);



    $(".dropbtn").click(function () {
        if (dropdownVisible) {
            $(".dropdown").css("display","none");
        } else {
            $(".dropdown").css("display","flex");
        }
        dropdownVisible = !dropdownVisible;
    });
})
</script>


<body style="margin-top: 0px!important;" lang="<?= $current_language?>">


<header>
    <div class="navbar">
        <div class="logo">
            <a href="<?= home_url()?>" style="text-decoration: none;cursor: pointer;">

                <div class="logoimg">
                    <?php
                    // 检查站点是否有自定义站点图标
                    if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
                        // 获取站点图标的URL
                        $site_icon_url = get_site_icon_url();
                        echo '<img src="' . esc_url( $site_icon_url ) . '" alt="Site Icon">';
                    } else {
                        // 如果没有自定义站点图标，可以显示默认图标或其他内容
                        echo '<img src="'.get_template_directory_uri().'/img/logo.png" alt="">';
                    }
                    ?>

                </div>
                <h1><?= get_bloginfo('name')?></h1>
            </a>


        </div>
        <div class="navright drop">
            <div class="dropbtn">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="dropdown">
                <a href="<?= home_url()?>/search" class="navitem"><?= $lang['search']; ?></a>
                <form id="language-switcher" method="get" action="">
                    <label for="language-switcher-locales">
                        <span class="dashicons dashicons-translation" aria-hidden="true"></span>
                        <span class="screen-reader-text">语言</span>
                    </label>
                    <select name="wp_lang" id="language-switcher-locales" onchange="this.form.submit()">
                        <option value="en_US" <?php if($current_language=='en_US'){echo "selected";} ?>>English</option>
                        <option value="zh_CN" <?php if($current_language=='zh_CN'){echo "selected";} ?>>简体中文</option>
                        <option value="ja" <?php if($current_language=='ja'){echo "selected";} ?>>日本語</option>
                    </select>
                    <noscript><input type="submit" value="更改"></noscript>
                </form>
                <?php if (is_user_logged_in()) :
                    $current_user = wp_get_current_user();
                    ?>
                    <a class="navitem" href="<?php echo esc_url(admin_url()); ?>"><?= $lang['board']; ?></a>
                    <div class="userinfo">
                    <?php echo get_avatar($current_user->ID, 32); ?>
                    <?php echo esc_html($current_user->display_name); ?>
                    <a href="<?php echo wp_logout_url(home_url()); ?>"><button class="loginbtn"><?= $lang['logout']; ?></button></a>
                <?php else : ?>
                    <a href="<?php echo wp_login_url(); ?>" class="replace-link"><button class="loginbtn"><?= $lang['login']; ?></button></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</header>
