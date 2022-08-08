<?php

namespace App\Models;

use App\Model;

class User extends Model
{
    const TABLE = 'users';

    // public $email;
    // public $name;

    public $attributes = [
        'login' => '',
        'password' => '',
        'email' => '',
        'name' => '',
        'role' => 'user',
        'city' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['email'],
            ['name']

        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ],
    ];

    public $rulesLogin = [
        'required' => [
            ['login'],
            ['password']
        ]
    ];

    public function checkUnique()
    {
        $user = $this->find(['login', 'email'], [$this->attributes['login'], $this->attributes['email']], 'OR');
        if ($user) {
            if ($user['login'] == $this->attributes['login']) {
                $this->errors_validation['unique'][] = "Логин {$this->attributes['login']} уже занят";
            }
            if ($user['email'] == $this->attributes['email']) {
                $this->errors_validation['unique'][] = "email {$this->attributes['email']} уже занят";
            }
            return false;
        }
        return true;
    }

    public function login()
    {
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if ($login && $password) {
            $user = $this->find(['login'], [$this->attributes['login']]);
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    foreach ($user as $key => $value) {
                        if ($key != 'password') $_SESSION['user'][$key] = $value;
                    }
                    return true;
                }
            }
        }
        return false;
    }
}
