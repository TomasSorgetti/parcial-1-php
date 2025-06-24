<?php

class Image
{

    public static function upload(string $dir, array $files)
    {
        $ogName = explode('.', $files['name']);

        $fileName = time() . '.' . end($ogName);

        $fileUpload = move_uploaded_file($files['tmp_name'], $dir . $fileName);

        if (!$fileUpload) {
            throw new Exception('Error al subir la imagen');
        }

        return $fileName;
    }

    public static function delete(string $dir, string $fileName): bool
    {
        $filePath = $dir . $fileName;

        if (!file_exists($filePath)) {
            throw new Exception("La imagen '$fileName' no existe en '$dir'");
        }

        if (!unlink($filePath)) {
            throw new Exception("Error al eliminar la imagen '$fileName'");
        }

        return true;
    }
}
