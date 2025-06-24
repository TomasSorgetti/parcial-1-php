<?php
require_once "../../../lib/utils/autoload.php";

$tagName = trim($_POST['name']);
$tagId = $_POST['id'];

try {
    Tag::updateTag($tagId, $tagName);
    header("Location: ../../index.php?page=admin-tags");
    exit();
} catch (Exception $error) {
    die("No se pudo actualizar la Marca: " . $error->getMessage());
}
