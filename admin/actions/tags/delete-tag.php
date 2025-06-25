<?php
require_once "../../../lib/utils/autoload.php";

$tagId = $_GET['id'] ?? null;

try {
    Tag::deleteTag($tagId);

    Alert::add('success', 'Etiqueta eliminada correctamente.');
    header("Location: ../../index.php?page=admin-tags");
    exit();
} catch (Exception $error) {
    Alert::add('danger', $error->getMessage());
    header("Location: ../../index.php?page=admin-tags");
    exit();
}
