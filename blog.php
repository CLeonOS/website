<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>The CLeonOS official website</title>
</head>
<body>

<?php include "header.php"; ?>

<h1>CLeonOS Blog</h1>
<hr>
<h2>All Blogs :</h2>

<?php
$versionDir = __DIR__ . '/blog/';
$files = glob($versionDir . '/*.php');
$versions = array();

foreach ($files as $file) {
    $versions[] = basename($file, '.php');
}
usort($versions, 'version_compare');
$versions = array_reverse($versions);

foreach ($versions as $version) {
    $filePath = $versionDir . '/' . $version . '.php';
    $preview = '';
    
    // 读取文件内容并提取前30个可见字符（不识别title）
    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);
        if ($content !== false) {
            // 移除 PHP 代码块
            $content = preg_replace('/<\?php.*?\?>/s', '', $content);
            // 移除 <title> 标签及其内容
            $content = preg_replace('/<title[^>]*>.*?<\/title>/is', '', $content);
            // 移除 <head> 标签及其内容（可选）
            $content = preg_replace('/<head[^>]*>.*?<\/head>/is', '', $content);
            // 移除所有 HTML 标签，保留纯文本
            $text = strip_tags($content);
            // 压缩空白字符（多个空格/换行转为单个空格）
            $text = preg_replace('/\s+/', ' ', $text);
            // 去除首尾空格
            $text = trim($text);
            // 截取前30个字符（支持中文）
            $preview = mb_substr($text, 0, 30, 'UTF-8');
            // 如果原文超过30字，添加省略号
            if (mb_strlen($text, 'UTF-8') > 30) {
                $preview .= '…';
            }
            // 如果预览为空，显示提示
            if (empty($preview)) {
                $preview = '[无文本内容]';
            }
        } else {
            $preview = '[无法读取文件]';
        }
    } else {
        $preview = '[文件不存在]';
    }
    
    echo '<div>';
    echo '<strong><a href="/blog/' . $version . '.php">' . htmlspecialchars($version) . '</a></strong><br>';
    echo htmlspecialchars($preview);
    echo '</div>';
    echo '<hr>';
}
?>

</body>
</html>
