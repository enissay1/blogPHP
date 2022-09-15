<?php

namespace App\Html;

class Form
{
    public function __construct()
    {
    }
    public function input($key, $type, $title)
    {
        return <<<HTML
         <label for="{$key}">$title</label><br>
            <input type="{$type}" id="{$key}" name="{$key}"><br>
HTML;
    }
}
