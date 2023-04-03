<!-- Вывод одной статьи -->

<?php

$url = $_GET['url'];

require_once('../config/db_config.php');

$sql_article = "SELECT blog_articles.id, blog_articles.title, blog_articles.content, blog_articles.short_description, blog_articles.date, blog_category.name, blog_articles.in_active
        FROM blog_articles
        JOIN blog_category ON blog_articles.id_category = blog_category.id
        WHERE blog_articles.url = '" . $url . "'";
        
$result_article = mysqli_query($conn, $sql_article);

if (mysqli_num_rows($result_article) > 0) {

    $article = mysqli_fetch_assoc($result_article);
    
    mysqli_close($conn); ?>

    <div class="post container">
        <h1><?php echo $article["title"]; ?></h1>
        <p><a href="#" onclick="window.history.back();">👈 вернуться обратно</a></p>

        <?php if ($article["short_description"] != null) { ?>
            <p><?php echo htmlspecialchars($article["short_description"]); ?></p>
        <?php } ?>

        <p><?php echo $article["content"]; ?></p>
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