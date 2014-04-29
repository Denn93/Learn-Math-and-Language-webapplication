<?php 
session_start();
error_reporting(E_ALL);
ob_start();

require_once 'Data/Config.class.php'; 
Config::init();

//require_once 'Data/Database.class.php';
require_once 'Data/User.class.php';

$user = new User();
$beheer = null;
//require_once 'Data/Docent/Beheer.class.php';

if ($user->isDocent())
        $beheer = new Beheer();

//Get $_Post Request

if (isset($_POST['inloggen']))
    $user->userLogin ($_POST['username'], md5($_POST['password']));

if (isset($_POST['uitloggen']))
    $user->userLogOff();

if (isset($_POST['submitMathQuestion']))
    $beheer->insertMathQuestions ($_POST);

if (isset($_POST['cancelMathQuestion']))
    header('location: index.php?Page=BeheerRekenen');

//Get $_Get requests

$page = (!isset($_GET['Page'])) ? "Home" : $_GET['Page'];

//Get Content

require_once 'template/Main/header.template.php';

  switch ($page){
	case 'Home':
            require_once 'template/Content/Homepage.template.php';
            break;
        case 'Games':
            if (User::isLoggedIn())
              require_once 'template/Content/Games.template.php';
            else
              require_once 'template/Content/Error.template.php';
            break;
        case 'Test':
            if (User::isLoggedIn())
                require_once 'index_temp.php';
            else
                require_once 'template/Content/Error.template.php';
            break;
        case 'BeheerRekenen':
            if (User::isLoggedIn() && User::isDocent())
                require_once 'template/Docent/BeheerRekenen.template.php';
            else
                require_once 'template/Content/Error.template.php';
            break;
        case 'BeheerTaal':
            if (User::isLoggedIn() && User::isDocent())
                require_once 'template/Docent/BeheerTaal.template.php';
            else
                require_once 'template/Content/Error.template.php';
            break;
        case 'BeheerRekenenEdit':
            if (User::isLoggedIn() && User::isDocent())
                require_once 'template/Docent/BeheerRekenenEdit.template.php';    
            else
                require_once 'template/Content/Error.template.php';
            break;
	default:
            require_once 'template/Content/Error.template.php';
            break;
  }

require_once 'template/Main/footer.template.php';
ob_end_flush();
?>