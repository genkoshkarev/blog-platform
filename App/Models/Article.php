<?php

namespace App\Models;

use App\Model;

class Article extends Model
{
    const TABLE = 'articles';

    // public $title;
    // public $content;

    public $attributes = [
        'title' => '',
        'category' => '',
        'description' => '',
        'keywords' => '',
        // 'img' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
            ['category'],
            ['keywords'],
            ['description']

        ],
        'lengthMin' => [
            ['title', 6],
        ],
    ];
}