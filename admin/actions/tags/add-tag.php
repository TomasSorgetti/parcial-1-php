<?php
require_once "../../../lib/utils/autoload.php";

$tagName = trim($_POST['name']);

try {
    Tag::insertTag($tagName);

    Alert::add('success', 'Etiqueta agregada correctamente.');
    header("Location: ../../index.php?page=admin-tags");
    exit();
} catch (Exception $error) {
    Alert::add('danger', "No se pudo agregar la Etiqueta");
    header("Location: ../../index.php?page=admin-tags");
    exit();
}
