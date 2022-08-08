<?php

namespace App\Models;

use App\Model;

class Tag extends Model
{
    const TABLE = 'tags';

    public $attributes = [
        'name' => '',
        'article' => '',
        'author' => '',
    ];

}