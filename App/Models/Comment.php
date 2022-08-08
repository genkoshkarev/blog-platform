<?php

namespace App\Models;

use App\Model;

class Comment extends Model
{
    const TABLE = 'comments';


    public $attributes = [
        'text' => '',
    ];

    public $rules = [
        'required' => [
            ['text']

        ],
        'lengthMin' => [
            ['text', 100],
        ],
    ];
}