<?php
require_once "../../../lib/utils/autoload.php";

$tagName = trim($_POST['name']);
$tagId = $_POST['id'];

try {
    Tag::updateTag($tagId, $tagName);

    Alert::add('success', 'Etiqueta actualizada correctamente.');

    header("Location: ../../index.php?page=admin-tags");
    exit();
} catch (Exception $error) {
    Alert::add('danger', "No se pudo actualizar la Etiqueta");
    header("Location: ../../index.php?page=admin-tags");
    exit();
}
