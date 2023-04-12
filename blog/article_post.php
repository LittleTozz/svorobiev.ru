<!-- Вывод одной статьи -->

<?php

$url = $_GET['url'];

require_once('../config/db_config.php');

$sql_article = "SELECT blog_articles.id, blog_articles.title, blog_articles.content, blog_articles.short_description, blog_articles.date, blog_category.name, blog_articles.in_active
        FROM blog_articles
        JOIN blog_category ON blog_articles.id_category = blog_category.id
        WHERE blog_articles.url = '" . $url . "' and blog_articles.in_active = '1'";
        
$result_article = mysqli_query($conn, $sql_article);

if (mysqli_num_rows($result_article) > 0) {
    $article = mysqli_fetch_assoc($result_article);

    // Получение двух рандомных статей
    $sql_two_random_articles = "SELECT blog_articles.title, blog_articles.url
            FROM blog_articles 
            WHERE id != " . $article["id"] . " AND in_active != 0
            ORDER BY RAND() 
            LIMIT 2";
    $result_two_random_articles = mysqli_query($conn, $sql_two_random_articles);
}
    
mysqli_close($conn); 

if (mysqli_num_rows($result_article) > 0) {?>

    <div class="post container">
        <h1><?php echo $article["title"]; ?></h1>
        <p><a href="#" onclick="window.history.back();">👈 вернуться обратно</a></p>

        <?php if ($article["short_description"] != null) { ?>
            <p><?php echo htmlspecialchars($article["short_description"]); ?></p>
        <?php } ?>

        <p><?php echo $article["content"]; ?></p>
        <?php
        if ($result_two_random_articles != null) {
            $count = 0;
            echo("<div class='other_links'>");
            while ($row = mysqli_fetch_array($result_two_random_articles)) {
                if ($count == 0) {
                    echo("<p><a href='" . $row["url"] ."'>←&nbsp;" . $row["title"] . "</a></p>");
                    $count++;
                } else if ($count == 1) {
                    echo("<p><a href='" . $row["url"] ."'>" . $row["title"] . "&nbsp;→</a></p>");
                }
            }
        }
        ?>
    </div>
    <script>
    // Подключаем js файл, который у каждого тега <code> создает кнопку Copy
    <?php include('./copy_code.js'); ?>
    </script>
<?php } else {
    header("HTTP/1.0 404 Not Found");
    header("Location: ../404.php");
    exit();
} ?>