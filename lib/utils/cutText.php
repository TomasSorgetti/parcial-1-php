<?php
    function cutText($text, $length) {
        if(count($text) == 0) return '';
        
        if (strlen($text) > $length) {
            return substr($text, 0, $length) . '...';
        }
        return $text;
    }