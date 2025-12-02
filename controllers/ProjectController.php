<?php

require_once(__DIR__ . '/../models/Project.php');

class ProjectController
{
    private $project;

    public function __construct()
    {
        $this->project = new Project();
    }

    public function index()
    {
        $category = $_GET['cat'] ?? null;
        $projects = $this->project->getAll($category);
        $categories = $this->project->getCategories();

        require(__DIR__ . '/../views/projects.php');
    }
}

