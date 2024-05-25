<?php

include('lang/langswitch.php');


get_header();


?>

<div class="searchmain">
    <h1><?= $lang['searchtitle']; ?></h1>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="searchcontent">
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
            <button type="submit" class="search-submit"><?= $lang['search']; ?></button>
    </div>
    </form>

    <div class="tag">
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        <?php endif; ?>

        <!-- 调用自定义的随机标签函数 -->
        <?php display_random_tags(5); ?>
    </div>
</div>

<?php
get_footer();
?>
