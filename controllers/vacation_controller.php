<?php 
require_once 'vendor/autoload.php';

require_once 'db/config.php' ;
require_once 'models/vacationRequest.php' ;

// add vacation
function insert_vacation($vacation,$twig){
        // if(isset( $_SESSION['user_id'])){
        //         $id=$_SESSION['user_id'];
        //         $reslut=$user->getUserByUser_id($id);
        //     }
    if(isset($_POST['submit'])){
        //  $user_id=$_POST['user_id'];
         $description=$_POST['description'];
        //   $vt_id=$_POST['vt_id'];
        $first_date=$_POST['first_date'];
        $last_date=$_POST['last_date'];
         $user_id=$_SESSION['user_id'];
       
    $result=$vacation->InsertVacation($description,$first_date,$last_date,$user_id);
        if($result){
            echo 'g';
    echo $twig->render('home.html',array());
        }
        else{
           echo $twig->render('home.html',array());

        } 
    }
}

function get_Vacation($vacation,$twig)  {
  
    $result=$vacation->getVacation();
    echo $twig->render('requestAdmin.html',array(
    'requestResult'=>$result
    ));
}
// function get_VacationId($vacation,$twig)  {
//   $id=$_SESSION['user_id'];
//     $result=$vacation->getVacationById($id);
//     echo $twig->render('profile.html',array(
//     'rt'=>$result,
//     'rtt'=>'hhh'
//     ));
// }
function get_VacationId($twig,$_user,$vacation){
          
                $id=$_GET['id'];
                $reslut=$vacation->getVacationById($id);
                 echo $twig->render('profile.html',array(
                     'rt'=>$reslut,
                     'rr'=>'eee'
    ));
            }


// function get_Vacation_profile($vacation,$twig)  {
  
//     echo $twig->render('profile.html',array(
//     'pv'=>$result
//     ));
// }

//edit vacation

function edit_vacation($vacation,$twig)  {
    $id=$_GET['id'];
    $result=$vacation->getVacationDetails($id);
    echo $twig->render('editVacationAdmin.html',array(
        'r'=>$result
    ));
}

// function GetVacationdetail($twig,$vacation)  {
//     $id=$_GET['id'];
//     $result=$vacation->getVacationDetails($id);

//     echo $twig->render('editVacationAdmin.html',array(
//         'r'=>$result
    
//     ));
// }




function EditVacationsPost($vacation,$twig)  {
    extract($_POST);
    $result=$vacation->updateVacation($id,$first_date,$last_date,$description,$answer);

 if($result){
    


//  header('location:index.php?action=getvacations');
  
}

}
//delete vacation
function delete_vacation($vacation,$twig)  {
    $id=$_GET['id'];
    $result=$vacation->deleteVacation($id);
    echo $twig->render('users.html',array(
    'result'=>$result
    ));
}

?>