<!-- Вывод одной статьи -->

<?php

$url = $_GET['url'];

require_once('../config/db_config.php');

$sql_project = "SELECT work_projects.id, work_projects.name, work_projects.content, work_projects.url, work_projects.link_in_project, work_projects.img, work_projects.img_alt, work_projects.in_active
        FROM work_projects
        WHERE work_projects.url = '" . $url . "' and work_projects.in_active = '1'";
        
$result_project = mysqli_query($conn, $sql_project);

if (mysqli_num_rows($result_project) > 0) {
    $project = mysqli_fetch_assoc($result_project);

    // Получение двух рандомных статей
    $sql_two_random_works = "SELECT work_projects.name, work_projects.url
            FROM work_projects 
            WHERE id != " . $project["id"] . " AND in_active != 0
            ORDER BY RAND() 
            LIMIT 2";
    $result_two_random_works = mysqli_query($conn, $sql_two_random_works);
}
    
mysqli_close($conn);

if (mysqli_num_rows($result_project) > 0) { ?>
    <div class="post container">
        <h1><?php echo $project["name"]; ?></h1>
        <p><a href="#" onclick="window.history.back();">👈 вернуться обратно</a></p>
        <p><?php echo $project["content"]; ?></p>
        <?php
        if ($project["link_in_project"] != null) echo("<a href='https://svorobiev.ru/work/" . $project["link_in_project"] . "' target='_blank'>Ссылка на проект</a>");
        ?>
        <?php
        if ($result_two_random_works != null) {
            $count = 0;
            echo("<div class='other_links'>");
            while ($row = mysqli_fetch_array($result_two_random_works)) {
                if ($count == 0) {
                    echo("<p><a href='" . $row["url"] ."'>← " . $row["name"] . "</a></p>");
                    $count++;
                } else if ($count == 1) {
                    echo("<p><a href='" . $row["url"] ."'>" . $row["name"] . " →</a></p>");
                }
            }
        }
        ?>
    </div>
<?php } else {
    header("HTTP/1.0 404 Not Found");
    header("Location: ../404.php");
    exit();
} ?>