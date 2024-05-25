<?php
include('lang/langswitch.php');
get_header(); // 引用 header.php 文件
?>

<main class="mainpage">
    <h1 class="maintitle"><?= $lang['recentpost']; ?></h1>
    <div class="books">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <div class="booksitem">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
            <?php
            endwhile;
        else :
            echo '<p>No content found</p>';
        endif;
        ?>
    </div>

    <!-- 分页导航 -->
    <div class="pagination">
        <?php
        // 输出分页导航
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('« Previous', 'textdomain'),
            'next_text' => __('Next »', 'textdomain'),
        ));
        ?>
    </div>

</main>

<?php
get_footer(); // 引用 footer.php 文件，如果你有
?>

</body>
