<?php

namespace App\Html;

class Form
{
    public function __construct()
    {
    }
    public function input($key, $type, $title,$value=null)
    {
        return <<<HTML
         <label for="{$key}">$title</label><br>
            <input type="{$type}" id="{$key}" name="{$key}" value="{$value}"><br>
HTML;
    }
    public function textarea($key, $title,$value=null)
    {
        return <<<HTML
          <textarea name="{$key}" id="{$key}" cols="30" rows="10" placeholder="{$title}"></textarea><br><br>

HTML;
    }
}
