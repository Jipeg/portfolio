<?php

require_once(__DIR__ . '/../Db.php');
require_once(__DIR__ . '/../helpers.php');

class Project
{
    private $db;

    public function __construct()
    {
        $this->db = new Db(config()['db_path']);
        if (!$this->db) {
            throw new Exception("Failed to connect to the SQLite database.");
        }
    }

    public function getAll($category = null)
    {
        if ($category) {
            $result = $this->db->query('SELECT * FROM projects WHERE cat = ? ORDER BY id DESC', [$category]);
        } else {
            $result = $this->db->query('SELECT * FROM projects ORDER BY id DESC');
        }

        $projects = [];
        while ($data = $result->fetchArray(SQLITE3_ASSOC)) {
            $projects[] = $data;
        }
        return $projects;
    }

    public function getCategories()
    {
        $result = $this->db->query('SELECT DISTINCT cat FROM projects ORDER BY cat');
        $categories = [];
        while ($data = $result->fetchArray(SQLITE3_ASSOC)) {
            $categories[] = $data['cat'];
        }
        return $categories;
    }

    public function create($name, $desc, $link, $cat)
    {
        $stmt = $this->db->prepare('INSERT INTO projects (name, desc, link, cat) VALUES (?, ?, ?, ?)');
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $desc);
        $stmt->bindValue(3, $link);
        $stmt->bindValue(4, $cat);
        return $stmt->execute();
    }
}

