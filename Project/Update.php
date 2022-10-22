<?php 

require '../src/autoloader.php';

use App\Classes\Project;
use App\Repository\ProjectRepository;
use App\Forms\Validator;
use slugifier as s;

function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_GET['id'])){
    $project = ProjectRepository::getProjectById($_GET['id']);
}

if (isset($_POST['submit'])){
    $newProject = new Project(0,
    verifyInput($_POST['name']),
    $code = s\slugify('PROJECT_'. verifyInput($_POST['name']), '_'),
    verifyInput($_POST['lastpass_folder']),
    verifyInput($_POST['link_mock_ups']),
    verifyInput($_POST['managed_server']),
    verifyInput($_POST['notes']),
    $host,
    $customer);

    $errors = Validator::checkProjet($newProject);
    if (null === $errors){
        ProjectRepository::updateProject($project, $newProject);
        header("Location: View.php");
    }
}

if (isset($_POST['submit_delete'])){
    $project = ProjectRepository::getProjectById($_GET['id']);
    ProjectRepository::deleteProject($project);
    header('Location: View.php');
}