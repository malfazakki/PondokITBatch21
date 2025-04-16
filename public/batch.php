<?php
require_once '../controllers/BatchController.php';

$controller = new BatchController();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        if (isset($_GET['id'])) {
            $controller->edit($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    case 'delete':
        if (isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
    default:
        $controller->index();
        break;
}
