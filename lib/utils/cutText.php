<?php

/**
 * Corta un texto si supera el largo
 * 
 * @param string $text Texto a cortar
 * @param int $length Largo a cortar
 * @return string
 */
function cutText($text, $length = 100)
{
    if (trim($text) === "") {
        return "";
    }

    if (strlen($text) > $length) {
        return substr($text, 0, $length) . "...";
    }

    return $text;
}
