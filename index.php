<?php
//enable php errors (For debugging only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("Controller/ControllerMovie.php");

$c = new ControllerMovie();

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
        if(isset($_GET['id']))
            $c->executeGET($_GET['id']);
        else
            $c->executeGET();
        break;

    case 'POST':
        if(isset($_POST['name']) && isset($_POST['year']) && isset($_POST['director']))
            $c->executeCREATE($_POST['name'], $_POST['year'], $_POST['director']);
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $_REQUEST);
        if(isset($_GET['id']) && isset($_REQUEST['name']) && isset($_REQUEST['year']) && isset($_REQUEST['director']))
            $c->executeUPDATE($_GET['id'], $_REQUEST['name'], $_REQUEST['year'], $_REQUEST['director']);
        break;

    case 'DELETE':
        if(isset($_GET['id']))
            $c->executeDELETE($_GET['id']);
        break;

    case 'OPTIONS':
        //needed for CORS 
        header("HTTP/1.1 200 OK");
        break;

    default:
        header("HTTP/1.1 405 Method Not Allowed");
        break;
}
?>