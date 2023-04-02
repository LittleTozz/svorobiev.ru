<?php
$current_url = $_SERVER['REQUEST_URI'];
$menu_links = array(
    "/blog" => "Пишу",
    "/work" => "Работаю",
    "/contact" => "Беседую"
);
?>

<div class="header container">
    <div class="header__logo">
        <a href="/"<?php if ($current_url == "/") { echo(' class="active"'); } ?>>Воробьев Сергей</a>
    </div>
    <div class="header__menu">
        <?php foreach ($menu_links as $url => $title) { ?>
            <a href="<?php echo $url; ?>" class="header__menu-link<?php if ($current_url == $url || $current_url == $url . '/') { echo(' active');} ?>"><?php echo $title; ?></a>
        <?php } ?>
    </div>
</div>