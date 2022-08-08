<?php

namespace App;

use Valitron\Validator as Validator;


abstract class Model
{

    const TABLE = '';
    protected $pdo;
    public $id;
    public $attributes = [];
    protected $pk = 'id';

    public $errors_validation = [];
    public $rules_validation = [];

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    //https://www.youtube.com/watch?v=3W3BTce8kns&list=PLD-piGJ3Dtl1gX1wh22vBeeg6gMP1VlnW&index=21
    public function validate($data)
    {

        Validator::langDir(__DIR__ . '\..\vendor\vlucas\valitron\lang'); // always set langDir before lang.
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        }
        $this->errors_validation = $v->errors();
        return false;
    }

    public function getErrorsValidate()
    {
        $errors = '<ul>';
        foreach ($this->errors_validation as $error) {
            foreach ($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
        return $errors;
    }

    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function save($field_name = null)
    {
        return $this->insert($field_name);
    }
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC';
        return $this->pdo->query(
            $sql,
            [],
            static::class
        );
    }

    public function findAllBy($where)
    {
        $sql = 'SELECT * FROM ' . static::TABLE . " WHERE $where ORDER BY id DESC";
        return $this->pdo->query(
            $sql,
            [],
            static::class
        );
    }

    public function findAllByAuthor($id)
    {
        $sql = 'SELECT * FROM ' . static::TABLE . " WHERE author = $id ORDER BY id DESC";
        return $this->pdo->query(
            $sql,
            [],
            static::class
        );
    }

    public function findAll_Author_Tags()
    {
        $table = static::TABLE;
        $user = $_SESSION['user']["id"] | 0;
        $tag = $_GET['tag'];
        $category = $_GET['category'];
        $bookmarks = $_GET['bookmarks'];
        $likes = $_GET['likes'];
        $username = $_GET['username'];
        $where_table  = $table;
        $where_user  = '';

        if ($category != '') {
            $where_table = "
            (
                SELECT a.*, c.name AS category_name FROM categories c
				JOIN articles a ON c.id=a.category
				WHERE c.id=$category
            )";
        }
        if ($tag != '') {
            $where_table = "
            (
                SELECT a.* FROM tags t
				JOIN articles a ON t.article=a.id
				WHERE t.name='$tag'
            )";
        }
        if ($bookmarks != '') {
            $where_table = "
            (
                SELECT a.* FROM bookmarks b
				JOIN articles a ON b.article_id=a.id
				WHERE b.article_id=a.id AND b.user=$user AND b.state=1
            )";
        }
        if ($likes != '') {
            $where_table = "
            (
                SELECT a.* FROM likes l
				JOIN articles a ON l.article_id=a.id
				WHERE l.article_id=a.id AND l.user=$user AND l.state=1
            )";
        }
        if ($username != '') {
            $where_user = "WHERE u.name='$username'";
        }

        $sql = "SELECT a.*, u.name as username,
        i.name AS image, i.filetype AS image_type,
        ANY_VALUE(l.state) AS 'like', ANY_VALUE(b.state) AS 'bookmark',
        GROUP_CONCAT(DISTINCT t.name) AS tags
        FROM (
            SELECT a.*,
            COUNT(DISTINCT l.user) AS 'sum_likes', COUNT(DISTINCT b.user) AS 'sum_bookmarks'
            FROM $where_table AS a
            LEFT JOIN likes l ON a.id = l.article_id AND l.state=1
            LEFT JOIN bookmarks b ON a.id = b.article_id AND b.state=1
            GROUP BY a.id ORDER BY a.id DESC
        ) AS a
        LEFT JOIN tags t ON t.article = a.id
        LEFT JOIN users u ON a.author = u.id
        LEFT JOIN images i ON a.img = i.id
        LEFT JOIN likes l ON a.id = l.article_id AND l.user=$user
        LEFT JOIN bookmarks b ON a.id = b.article_id AND b.user=$user
        $where_user
        GROUP BY a.id ORDER BY a.id DESC";

        return $this->pdo->query(
            $sql,
            [],
            static::class
        );
    }

    public function findAllByTag($tag)
    {
        $sql = "SELECT a.*, u.name AS author_name,
        GROUP_CONCAT(distinct t_all.name) AS tags
        FROM tags t
        LEFT JOIN articles a ON t.article=a.id
        LEFT JOIN tags t_all ON t_all.article = a.id 
        LEFT JOIN users u ON a.author=u.id
        WHERE t.name='$tag'
        GROUP BY a.id ORDER BY id DESC";

        return $this->pdo->query(
            $sql,
            [],
            static::class
        );
    }

    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->pk;
        $table = static::TABLE;
        $sql = "SELECT * FROM $table WHERE $field = ? LIMIT 1";
        return $this->pdo->query(
            $sql,
            [$id],
            static::class
        );
    }


    public function findById($id)
    {
        $table = static::TABLE;
        $user = $_SESSION['user']["id"] | 0;
        $sql = "SELECT a.*, u.name AS username,
        c.name AS category_name,
        i.name AS image, i.filetype AS image_type,
        ANY_VALUE(l.state) AS 'like', ANY_VALUE(b.state) AS 'bookmark',
        GROUP_CONCAT(DISTINCT t.name) AS tags
        FROM (
            SELECT a.*,
            COUNT(DISTINCT l.user) AS 'sum_likes', COUNT(DISTINCT b.user) AS 'sum_bookmarks'
            FROM $table a
            LEFT JOIN likes l ON a.id = l.article_id AND l.state=1
            LEFT JOIN bookmarks b ON a.id = b.article_id AND b.state=1
            WHERE a.id=:id
            GROUP BY a.id ORDER BY a.id DESC
        ) AS a
        LEFT JOIN tags t ON t.article = a.id
        LEFT JOIN users u ON a.author = u.id
        LEFT JOIN images i ON a.img = i.id
        LEFT JOIN categories c ON a.category = c.id
        LEFT JOIN likes l ON a.id = l.article_id AND l.user=$user
        LEFT JOIN bookmarks b ON a.id = b.article_id AND b.user=$user
        GROUP BY a.id ORDER BY a.id DESC";

        $data = $this->pdo->query(
            $sql,
            [':id' => $id],
            static::class
        );
        return $data ? $data[0] : null;
    }

    public function find($fields, $value, $operator = 'AND')
    {
        $attrs = '';

        foreach ($fields as $key => $field) {
            $op = ($key == 0) ? '' : $operator;
            $attrs .= "$op $field=? ";
        }


        $table = static::TABLE;
        $sql = "SELECT * FROM $table WHERE $attrs LIMIT 1";
        $data = $this->pdo->query(
            $sql,
            $value,
            static::class,
            true
        );
        return $data ? $data[0] : null;
    }

    public function insert($field_name = null)
    {
        $fields = $this->attributes; //get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }

            $cols[] = $name;
            $data[":$name"] = $value;
        }

        $name = implode(',', $cols);
        $value = implode(',', array_keys($data));
        $sql = 'INSERT INTO ' . static::TABLE . " ($name) VALUES ($value)";

        $this->pdo->execute($sql, $data);
        $this->id = $this->pdo->getLastId();
        return ($field_name) ? $data[":$field_name"] : $this->id;
    }
}
