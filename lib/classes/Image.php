<?php

class Image
{

    /**
     * Sube una imagen al directorio especificado.
     *
     * @param string $dir Directorio donde se guardará la imagen.
     * @param array $files Información del archivo subido (de $_FILES).
     * @return string Nombre del archivo generado (con timestamp).
     * @throws Exception Si ocurre un error al subir la imagen.
     */
    public static function upload(string $dir, array $files): string
    {
        $ogName = explode('.', $files['name']);

        $fileName = time() . '.' . end($ogName);

        $fileUpload = move_uploaded_file($files['tmp_name'], $dir . $fileName);

        if (!$fileUpload) {
            throw new Exception('Error al subir la imagen');
        }

        return $fileName;
    }

    /**
     * Elimina una imagen del directorio especificado.
     *
     * @param string $dir Directorio donde se encuentra la imagen.
     * @param string $fileName Nombre del archivo a eliminar.
     * @return bool Verdadero si la imagen se eliminó correctamente.
     * @throws Exception Si la imagen no existe o no se puede eliminar.
     */
    public static function delete(string $dir, string $fileName): bool
    {
        $filePath = $dir . $fileName;

        if (!file_exists($filePath)) {
            // throw new Exception("La imagen '$fileName' no existe en '$dir'");
            return true;
        }

        if (!unlink($filePath)) {
            throw new Exception("Error al eliminar la imagen '$fileName'");
        }

        return true;
    }
}
