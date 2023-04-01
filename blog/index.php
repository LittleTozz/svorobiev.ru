<?php
$current_url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($current_url);
$path = $parsed_url['path'];

// Костыль что бы работали Title и Description
if ($path == '/blog' || $path == '/blog/') {

    $title = 'Листинг статей';
    $description = 'Листинг статей';

} elseif (substr($path, 6) !== '') {
    $url = $_GET['url'];
    
    require_once('../config/db_config.php');
    
    $sql_article = "SELECT blog_articles.seo_title, blog_articles.seo_description, blog_articles.in_active 
    FROM blog_articles 
    WHERE blog_articles.url = '" . $url . "'";
    //  and blog_articles.in_active = '1'";
            
    $result_article = mysqli_query($conn, $sql_article);
    
    if (mysqli_num_rows($result_article) > 0) {
        
        $article = mysqli_fetch_assoc($result_article);
    
        $title = $article["seo_title"];
        $description = $article["seo_description"];
    
    }
}
// Конец костыля
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once('../parts/head.php');?>
</head>

<body>
    <?php include_once('../parts/header.php');?>
    <?php
    if ($path == '/blog' || $path == '/blog/') {
        
        // Выводим листинг статей
        include_once('article_listing.php');

    } else {

        // Выводим одну статью
        include_once('article_post.php');

    }
    ?>
    <?php include_once('../parts/footer.php');?>
</body>

</html>