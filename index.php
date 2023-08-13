<?php 

 require_once 'controllers/user_controller.php' ;
 require_once './controllers/vacation_controller.php' ;
$loader = new \Twig\Loader\FilesystemLoader('views');
include_once 'session.php';

$twig = new \Twig\Environment($loader);
//register 
// nav bar switch
// ----------------current user -------------------

// -------------end current user ----------------
if (isset($_GET['action'])) {


    $action = $_GET['action'];
   
    if ($action === 'getusers') {
        GetUsers($_user, $twig);
    } elseif ($action === 'getvacations') {
        get_Vacation($vacation, $twig);
    }elseif ($action === 'home') {
       home($_user,$twig);  
    }  
    elseif ($action === 'profile') {
       if(isset($_SESSION['user_id']) ){
    $id=$_SESSION['user_id'];
    current_user($twig,$_user,$vacation);

    $result=$vacation->getVacation();
    // profile($twig,$_user);
            } 
    }   elseif ($action == 'editProfile') {
       editProfile($twig,$_user);
    }  elseif ($action == 'EditProfilePost') {
       EditProfilePost($twig,$_user);
    current_user($twig,$_user,$vacation);

    } 
    elseif ($action == 'editVacationAdmin') {
       edit_vacation($vacation,$twig);
    }   elseif ($action == 'EditVacationsPost') {
     EditVacationsPost($vacation,$twig);
        get_Vacation($vacation, $twig);
    }
    elseif ($action == 'deleteVacationAdmin') {
     delete_vacation($vacation,$twig);
        get_Vacation($vacation, $twig);

    }
      elseif ($action === 'register') {
register($twig);
    }elseif ($action === 'AddRegister') {
AddRegister($_user,$twig);
 }elseif ($action === 'login') {
login($twig);
 }elseif ($action === 'logOut') {
Logout($twig);
 }elseif ($action === 'ConfirmLogin') {
ConfirmLogin($_user,$twig);
 }elseif ($action === 'insert_vacation') {
       insert_vacation($vacation,$twig);  
    }elseif ($action === 'getVac') {
      get_VacationId($twig,$_user,$vacation);
    } 
     elseif($action == 'EditusersPost') {
       EditUsersPost($twig,$_user);
        GetUsers($_user, $twig);
    }   
       elseif ($action == 'viewOneUser') {
         view_one_user($_user,$twig);
    
    } elseif ($action == 'editUser') {
         edit_user($twig,$_user);

     
    } elseif ($action == 'deleteuser') {
       delete_user($_user,$twig);
        GetUsers($_user, $twig);
    }
}
// view users details and edit
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($action == 'viewOneUser') {
         view_one_user($_user,$twig);
    
    } elseif ($action == 'editUser') {
         edit_user($twig,$_user);

     
    } elseif ($action == 'deleteuser') {
       delete_user($_user,$twig);
        GetUsers($_user, $twig);
    }
     else {
    // header('location:index.php');   
    }} 


//     if(!isset($_GET['id'])){
//     // echo 'error';
//     header('location : users.html');
// }
// else {
//     $id = $_GET['id'];
//     $result = $_user->getUserDetails($id);
// }


// vacation details
//   if(!isset($_GET['id'])){
//     // echo 'error';
//     header('location : requestAdmin.html');
// }
// else {
//     $id = $_GET['id'];
//     $result = $vacation->getVacationDetails($id);
// }

//vacation in admin page 
// view users details and edit

?>