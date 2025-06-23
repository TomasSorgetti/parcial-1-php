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

    public static function delete() {}
}
