<?php
require_once "../../../lib/utils/autoload.php";

$tagName = trim($_POST['name']);

try {
    Tag::insertTag($tagName);

    Alert::add('success', 'Etiqueta agregada correctamente.');

    header("Location: ../../index.php?page=admin-tags");

    exit();
} catch (Exception $error) {

    if (strpos($error->getMessage(), 'Duplicate entry') !== false) {
        Alert::add('danger', "La Etiqueta ya existe");
    } else {
        Alert::add('danger', "No se pudo agregar la Etiqueta");
    }

    header("Location: ../../index.php?page=admin-tags");
    exit();
}
