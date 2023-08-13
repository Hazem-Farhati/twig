<?php 
require_once 'vendor/autoload.php';

require_once 'db/config.php' ;
require_once 'models/user.php' ;
include_once 'session.php';

//regsiter
function register($twig)  {
    echo $twig->render('register.html',array(
    ));
}
function AddRegister($_user, $twig)  {
    if(isset($_POST['submit'])){
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $dob=$_POST['dob'];
        $user_type=$_POST['user_type'];
        
     $orig_file = $_FILES["user_image"]["tmp_name"];
    $ext = pathinfo($_FILES["user_image"]["name"], PATHINFO_EXTENSION);
    $target_dir = '../uploads/';
    $profile_image = "$target_dir$firstname.$ext";
    move_uploaded_file($orig_file,$profile_image);

    $result=$_user->InsertUser($firstname,$lastname,$email,$password,$dob,$user_type,$profile_image);
       
    
if($result){
echo $twig->render('login.html',array(
));
}else{
    echo $twig->render('register.html',array());
}
}
}
    
//end register

//login 

function login($twig)  {
    echo $twig->render('login.html',array(
    ));
}
  function Logout($twig)  {
            session_destroy();
    
            header('location:index.php?action=login');

        }
function ConfirmLogin($_user,$twig){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = strtolower(trim($_POST['email']));
        $password = $_POST['password'];
        $new_password = md5($password.$email);
        $result = $_user->getUser($email,$new_password);
        if(!$result){
            echo "<div class='alert alert-danger'>Username or Password are incorrect</div>";
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $result['user_id'];
if($_SESSION['email'] == "admin@gmail.com") {
echo $twig->render('requestAdmin.html',array(
    ));
}
    
    else{
echo $twig->render('home.html',array(
    ));
}

        }
    }
}
//end login
// function edit_user($twig,$_user)  {
//     $id=$_GET['id'];
//     $result=$_user->getUserDetails($id);
//     echo $twig->render('editUser.html',array(
//         'r'=>$result

//     ));
// }

function GetUsers($_user,$twig)  {
  
    $result=$_user->getUsers();
    echo $twig->render('users.html',array(
    'result'=>$result
    ));
}

function view_one_user($_user,$twig)  {
    $id=$_GET['id'];
    $result=$_user->getUserDetails($id);
    echo $twig->render('viewOneUser.html',array(
    'result'=>$result
    ));
}

function delete_user($_user,$twig)  {
    $id=$_GET['id'];
    $result=$_user->deleteUser($id);
    echo $twig->render('users.html',array(
    'result'=>$result
    ));
}

function edit_user($twig,$_user)  {
    $id=$_GET['id'];
    $result=$_user->getUserDetails($id);

    echo $twig->render('editUser.html',array(
        'r'=>$result
    
    ));
}

function GetUserdetail($twig,$_user)  {
    $id=$_GET['id'];
    $result=$_user->getUserDetails($id);

    echo $twig->render('viewOneUser.html',array(
        'r'=>$result
    
    ));
}
function EditUsersPost($twig,$_user)  {
    extract($_POST);
    $result=$_user->updateUser($id,$firstname,$lastname,$email,$password,$dob,$user_type);
 if($result){
//   echo $twig->render('users.html',array(
        
//     'r'=>$result
//     ));
  
}

}


//move to home page 
function home($_user,$twig)  {
    echo $twig->render('home.html',array(
    ));
}

//add vacation request to user

// --------------------------- current user ------------------------
function profile($twig,$_user)  {
    echo $twig->render('profile.html',array(
    ));
}

function editProfile($twig,$_user)  {
    $id=$_GET['id'];
    $result=$_user->getUserByUser_id($id);
    echo $twig->render('editProfile.html',array(
        'r'=>$result
    ));
}
function EditProfilePost($twig,$_user)   {
    extract($_POST);
    $result=$_user->updateUser($id,$firstname,$lastname,$email,$password,$dob,$user_type);



}
function current_user($twig,$_user,$vacation){
          if(isset( $_SESSION['user_id'])){
                $id=$_SESSION['user_id'];

                $reslut=$_user->getUserByUser_id($id);
                $reslut2=$_user->getUserByUser_id1($id);
                 echo $twig->render('profile.html',array(
                     'r'=>$reslut,
                     'rt'=>$reslut2
                     
    ));
            }
}
?>