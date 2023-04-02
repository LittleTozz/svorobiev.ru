<!-- Вывод листинга статей -->

<?php

$months = array(
    'Январь',
    'Февраль',
    'Март',
    'Апрель',
    'Май',
    'Июнь',
    'Июль',
    'Август',
    'Сентябрь',
    'Октябрь',
    'Ноябрь',
    'Декабрь'
);

require_once('../config/db_config.php');

$sql_listion = "SELECT blog_articles.title, blog_articles.short_description, blog_articles.date, blog_articles.url, blog_articles.in_active, blog_category.name AS category_name
        FROM blog_articles 
        JOIN blog_category ON blog_articles.id_category = blog_category.id
        -- WHERE blog_articles.in_active = '1'
        ORDER BY blog_articles.date DESC";

$result_listion = mysqli_query($conn, $sql_listion);

mysqli_close($conn);

if (mysqli_num_rows($result_listion) == 0) {
    exit;
}

?>

<main class="listing article">
    <h1 class="container">Пишу в Блоге</h1>
    <div class="spacer16"></div>
    <?php while($row = mysqli_fetch_assoc($result_listion)) { ?>
            <section>
                <a href="<?php echo $row["url"]; ?>">
                    <div class="listing__header-box">
                        <div class="listing__h2-time">
                            <h2><?php echo $row["title"]; ?></h2>
                            <time datetime="<?php echo $row["date"]; ?>">
                                <?php
                                $date = strtotime($row["date"]);
                                $month_name = $months[date('n', $date) - 1];
                                
                                echo $month_name . date(" Y", $date); 
                                ?>
                            </time>
                        </div>
                        <span><?php echo $row["category_name"]; ?></span>
                    </div>
                    <div class="listing__wrapper-short-description">
                        <?php
                            // Вывод короткого описания
                            $user_agent = $_SERVER['HTTP_USER_AGENT'];
                            $short_description = htmlspecialchars($row["short_description"]);
                            
                            $string_without_spaces = str_replace(' ', '', $short_description);
                            $length = strlen($string_without_spaces);

                            if (strpos($user_agent, 'Mobile')) {
                                if ($length > 250) {
                                    $short_description = trim(rtrim(mb_substr($short_description, 0, 250, 'UTF-8'), "!,.-")) . '...';
                                    echo ($short_description);
                                } else {
                                    echo $short_description;
                                }
                                
                            } else {
                                echo $short_description;
                            }
                        ?>
                    </div>
                </a>
            </section>
    <?php } ?>
</main>