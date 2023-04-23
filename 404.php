<?php
$title = 'Ошибка 404. Страница не найдена';
$description = 'К сожалению, мы не смогли найти страницу, которую вы искали. Попробуйте проверить ссылку еще раз или перейдите на главную страницу. Мы приносим извинения за доставленные неудобства и надеемся, что вы найдете то, что искали на других страницах нашего сайта.';
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once('parts/head.php');?>
</head>

<body>
    <?php 
    
    include_once('parts/header.php');

    include_once('parts/include/404.php');

    include_once('parts/footer.php');
    
    ?>
</body>

</html>