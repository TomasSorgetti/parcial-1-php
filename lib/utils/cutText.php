<?php
    function cutText($text, $length) {
        if ($text === '' || strlen($text) == 0) {
            return '';
        }
        
        if (strlen($text) > $length) {
            return substr($text, 0, $length) . '...';
        }
        return $text;
    }