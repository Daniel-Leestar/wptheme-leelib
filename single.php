<?php
include('lang/langswitch.php');
get_header();
the_post();

$post_title = get_the_title();

// 获取特色图片
$post_thumbnail = get_the_post_thumbnail();

// 获取文章内容
$post_content = get_the_content();

// 获取作者信息
$post_author = get_the_author();

$download_link = get_post_meta(get_the_ID(), 'download_link', true);
$download_text = get_post_meta(get_the_ID(), 'download_text', true);
?>

    <article class="mainpage singlemain">
        <div class="mainleft">
            <!-- 输出特色图片 -->
            <div class="post-thumbnail">
                <?php echo $post_thumbnail; ?>
            </div>
        </div>
        <div class="mainright">
            <h1 class="singletitle"><?= the_title()?></h1>
            <?php
            // 获取当前文章的标签
            $post_tags = get_the_tags();

            if ($post_tags) {
                echo '<ul class="post-tags">';
                foreach($post_tags as $tag) {
                    // 输出每个标签的名称和链接
                    echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                }
                echo '</ul>';
            } else {
                echo '<ul class="post-tags">'.$lang['notag'].'</ul>';
            }
            ?>

            <!-- 输出文章内容 -->
            <div class="post-content">
                <?php if (is_user_logged_in()) : ?>
                    <?php echo $post_content; ?>
                <?php else : ?>
                   <div class="onlydiv" style="margin: 50px 0">
                       <div class="onlylogin"><?= $lang['onlylogin']; ?></div>
                   </div>
                <?php endif; ?>
            </div>

            <!-- 输出作者信息 -->
            <div class="post-author">
                <?= $lang['sharer']; ?>: <?php echo esc_html($post_author); ?>
            </div>
        </div>

    </article>

    <div class="mainpage recent">
        <h1 class="recenttitle"><?= $lang['recentpost']; ?></h1>
        <div class="recbooks">
            <?php
            // 自定义查询以获取最近的 5 篇文章
            $recent_posts_query = new WP_Query(array(
                'posts_per_page' => 7,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($recent_posts_query->have_posts()) :
                while ($recent_posts_query->have_posts()) : $recent_posts_query->the_post();
                    ?>

                        <a href="<?php echo esc_url(get_permalink()); ?>" class="recentitem">
                            <?php the_title(); ?>
                        </a>

                <?php
                endwhile;
                // 重置后恢复主查询
                wp_reset_postdata();
            else :
                echo '<p>No content found</p>';
            endif;
            ?>
        </div>
    </div>



<?php
get_footer();
?>