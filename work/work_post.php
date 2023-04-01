<!-- Вывод одной статьи -->

<?php

$url = $_GET['url'];

require_once('../config/db_config.php');

$sql_project = "SELECT work_projects.name, work_projects.content, work_projects.url, work_projects.img, work_projects.img_alt, work_projects.in_active
        FROM work_projects
        WHERE work_projects.url = '" . $url . "' and work_projects.in_active = '1'";
        
$result_project = mysqli_query($conn, $sql_project);

if (mysqli_num_rows($result_project) > 0) {

    $project = mysqli_fetch_assoc($result_project);
    
    mysqli_close($conn); ?>

    <div class="post container">
        <h1><?php echo $project["name"]; ?></h1>
        <div class="spacer16"></div>
        <p><?php echo $project["content"]; ?></p>
    </div>
<?php } else {
    header("HTTP/1.0 404 Not Found");
    header("Location: ../404.php");
    exit();
} ?>