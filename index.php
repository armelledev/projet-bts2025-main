<?php
require_once('database/database.php');

$pageTitle= "page d'accueile";

ob_start();

require_once('resources/views/blog/index_html.php');

$pageContent = ob_get_clean();

require_once('resources/views/layouts/presence-layout/presence-layout_html.php');
?>



