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
        <a href="/blog">Воробьев Сергей</a>
    </div>
    <div class="header__menu">
        <?php foreach ($menu_links as $url => $title) { ?>
            <a href="<?php echo $url; ?>" class="header__menu-link<?php echo strpos($current_url, $url) !== false ? ' active' : ''; ?>"><?php echo $title; ?></a>
        <?php } ?>
    </div>
</div>