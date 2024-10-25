<?php

namespace Blog\Core;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);
        require "src/Views/{$view}";
    }
}