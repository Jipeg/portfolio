<?php

require_once(__DIR__ . '/../models/Project.php');
require_once(__DIR__ . '/../auth.php');

class AdminController
{
    private $project;

    public function __construct()
    {
        $this->project = new Project();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (authenticate($username, $password)) {
                $_SESSION['authenticated'] = true;
                header('Location: /admin');
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        }

        require(__DIR__ . '/../views/admin/login.php');
    }

    public function index()
    {
        requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $desc = $_POST['desc'] ?? '';
            $link = $_POST['link'] ?? '';
            $cat = $_POST['cat'] ?? '';

            if ($name && $desc && $link && $cat) {
                $this->project->create($name, $desc, $link, $cat);
                $success = 'Project created successfully!';
            } else {
                $error = 'All fields are required';
            }
        }

        $categories = $this->project->getCategories();
        require(__DIR__ . '/../views/admin/index.php');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}

