<?php
include('lang/langswitch.php');
get_header(); // 引用 header.php 文件
?>

<main class="mainpage page404">
    <div>
        <h1><span>404</span></h1>
        <h1><?= $lang['page404']; ?></h1>
    </div>
</main>

<?php
get_footer(); // 引用 footer.php 文件，如果你有
?>

</body>
