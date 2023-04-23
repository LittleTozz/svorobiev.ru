<?php

$current_url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($current_url);
$path = $parsed_url['path'];

// Костыль что бы работали Title и Description
if ($path == '/work' || $path == '/work/') {

    $title = 'Портфолио проектов - работ по веб-программированию';
    $description = 'Здесь вы найдете подробную информацию о моих выполненных проектах, а также сможете ознакомиться с моим профессиональным опытом в области технологий. Приготовьтесь к вдохновению и новым идеям - в моем портфолио вы увидите, как я применяю свои знания и творческий подход в каждом проекте.';

} elseif (substr($path, 6) !== '') {
    $url = $_GET['url'];
    
    require_once('../config/db_config.php');
    
    $sql_article = "SELECT work_projects.seo_title, work_projects.seo_description, work_projects.in_active 
    FROM work_projects 
    WHERE work_projects.url = '" . $url . "'";
    //  and work_projects.in_active = '1'";
            
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
    if ($path == '/work' || $path == '/work/') {
        
        // Выводим листинг работ
        include_once('work_listing.php');

    } else {

        if (mysqli_num_rows($result_article) > 0) {

            // Выводим одну работу
            include_once('work_post.php');

        } else {
            header('HTTP/1.0 404 Not Found');
            include_once('../parts/include/404.php');
        }
    }
    ?>
    <?php include_once('../parts/footer.php');?>
</body>

</html>