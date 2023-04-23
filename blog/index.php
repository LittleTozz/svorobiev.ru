<?php
$current_url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($current_url);
$path = $parsed_url['path'];

// Костыль что бы работали Title и Description
if ($path == '/blog' || $path == '/blog/') {

    $title = 'Блог. Полезные советы для начинающих на сайте svorobiev.ru';
    $description = 'Привет, я Сергей - эксперт в области веб-технологий. На моем блоге вы найдете полезные советы для улучшения качества вашей работы, а также интересные моменты жизни. Будьте в курсе последних промптов для нейросетей и откройте для себя новые возможности в мире технологий вместе со мной.';

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
    
    } else {
        $title = 'Ошибка 404. Страница не найдена';
        $description = 'К сожалению, мы не смогли найти страницу, которую вы искали. Попробуйте проверить ссылку еще раз или перейдите на главную страницу. Мы приносим извинения за доставленные неудобства и надеемся, что вы найдете то, что искали на других страницах нашего сайта.';
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
        if (mysqli_num_rows($result_article) > 0) {

            // Выводим одну статью
            include_once('article_post.php');

        } else {
            header('HTTP/1.0 404 Not Found');
            include_once('../parts/include/404.php');
        }
    }
    ?>
    <?php include_once('../parts/footer.php');?>
</body>

</html>