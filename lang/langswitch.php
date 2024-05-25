<?php
session_start();
$current_language = isset($_SESSION['wp_lang']) ? $_SESSION['wp_lang'] : get_locale();


// 从语言代码中获取语言部分（例如 "en", "zh"）


if ($current_language == 'en_US') {
    include('en.php');
} else if ($current_language == 'zh_CN') {
    include('zh.php');
}else if ($current_language == 'ja'){
    include('ja.php');
}else{
    include('en.php');
}