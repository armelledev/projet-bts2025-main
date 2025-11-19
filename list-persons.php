<?php
session_start();
require_once('database/database.php');

$pageTitle= "page d'accueile";

ob_start();

require_once('resources/views/admin/list-personnel-html.php');

$pageContent = ob_get_clean();

require_once('resources/views/layouts/admin-layout/layout_html.php');
?>

