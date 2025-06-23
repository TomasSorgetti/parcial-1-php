<?php
require_once "../../../lib/classes/Database.php";
require_once "../../../lib/classes/Tag.php";

$tagName = trim($_POST['name']);

try {
    Tag::insertTag($tagName);
    header("Location: ../../index.php?page=admin-tags");
    exit();
} catch (Exception $error) {
    die("No se pudo agregar la Marca: " . $error->getMessage());
}
