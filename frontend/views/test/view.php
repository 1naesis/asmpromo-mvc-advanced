<?php
/**
 * @var $id param
 */
include $this->app . '/views/layouts/header.php'; ?>
    <h1>Тест</h1>
    <h2>Просмотр страницы № <?= $id ?></h2>
    <h2>Гет <?php print_r($_GET) ?></h2>
<?php include $this->app . '/views/layouts/footer.php'; ?>