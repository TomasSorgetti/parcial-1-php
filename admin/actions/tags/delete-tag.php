<?php
require_once "../../../lib/classes/Database.php";
require_once "../../../lib/classes/Tag.php";

$tagId = $_GET['id'] ?? null;

try {
    $tag = Tag::getTagById($tagId);
    if ($tag === null) {
        die("Error: Marca no encontrada.");
    }
    $tag->deleteTag();
    header("Location: ../../index.php?page=admin-tags");
    exit();
} catch (Exception $error) {
    die("No se pudo eliminar la Marca: " . $error->getMessage());
}
