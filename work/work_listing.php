<!-- Вывод листинга статей -->

<?php

$months = array(
    'января',
    'февраля',
    'марта',
    'апреля',
    'мая',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря'
);

require_once('../config/db_config.php');

$sql_listion = "SELECT work_projects.name, work_projects.short_description, work_projects.url, work_projects.date_start, work_projects.date_finish, work_projects.img, work_projects.img_alt, work_projects.img_padding, work_projects.in_active
        FROM work_projects 
        WHERE work_projects.in_active = '1'
        ORDER BY work_projects.date_start DESC";

$result_listion = mysqli_query($conn, $sql_listion);

mysqli_close($conn);

if (mysqli_num_rows($result_listion) == 0) {
    exit;
}

?>

<main class="listing works">
    <h1 class="container">Мои последние работы</h1>
    <div class="spacer16"></div>
    <?php while($row = mysqli_fetch_assoc($result_listion)) { ?>
        <section>
            <a href="<?php echo $row["url"]; ?>">
                <img 
                    src="<?php echo '/assets/img/works/' . $row["img"]; ?>" 
                    alt="<?php echo $row["img_alt"]; ?>"
                    <?php if ($row["img_padding"] != null):  ?>class="not-full-size" style="padding: <?php echo($row["img_padding"]); ?>px 0;"<?php endif; ?> >
                <div class="listing__header-box listing__header-box-work">
                    <?php $date_year = strtotime($row["date_start"]); ?>
                    <h2><?php echo $row["name"] . " (" . date("Y", $date_year) . ")"; ?></h2>
                </div>
                <div class="listing__wrapper-short-description">
                    <?php echo htmlspecialchars($row["short_description"]); ?>
                </div>
                <div class="listing__time-work">
                    <time datetime="<?php echo $row["date_start"]; ?>">
                        <?php
                        $date = strtotime($row["date_start"]);
                        $month_name = $months[date('n', $date) - 1];
                        
                        echo date("d ", $date) . $month_name; 
                        ?>
                    </time>
                    <span> - </span>
                    <time datetime="<?php echo $row["date_finish"]; ?>">
                        <?php
                        $date = strtotime($row["date_finish"]);
                        $month_name = $months[date('n', $date) - 1];
                        
                        echo date("d ", $date) . $month_name; 
                        ?>
                    </time>
                </div>
            </a>
        </section>
    <?php } ?>
</main>