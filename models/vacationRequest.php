<?php
class vacation{
    private $db;
    //constructor to initialize private to the database connection
    function __construct($conn)
    {
        $this->db=$conn;
    }       
    //function to insert a new record into the attendee database
    public function insertVacation($description,$first_date,$last_date,$user_id){
     
        try {
    // define sql statement to be executed
    $sql="INSERT INTO vacation_request (description,first_date,last_date,user_id) VALUES(:description,:first_date,:last_date,:user_id)";
    //prepare the sql statement to be executuin
    $stmt=$this->db->prepare($sql);
//bin all placeholders to the actual values
    // $stmt->bindparam(':user_id',$user_id);
    $stmt->bindparam(':description',$description);
    $stmt->bindparam(':first_date',$first_date);
    $stmt->bindparam(':last_date',$last_date);
    $stmt->bindparam(':user_id',$user_id);

    // $stmt->bindparam(':vt_id',$vt_id);
//execute statment
    $stmt->execute();
    return true;
} catch (PDOException $e) {
echo $e->getMessage();
return false;
}
    }

 public function getVacation(){
    try{
        $sql="SELECT * FROM `vacation_request`,`user` WHERE `vacation_request`.`user_id`=`user`.`user_id`; ";
        $results=$this->db->query($sql);
        return $results;
    }catch (PDOException $e) {
    echo $e->getMessage();
    return false;
}
 }
public function getVacationDate($first_date,$last_date){
          try{
            $sql="SELECT * FROM `vacation_request` where first_date<=:first_date and last_date>=:first_date and last_date>=:last_date and first_date<:last_date" ;
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':first_date',$first_date);
            $stmt->bindparam(':last_date',$last_date);

            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

}

        public function getVacationType(){
          $sql = "SELECT * FROM `vacation_type` ";
        $result = $this->db->query($sql);
        return $result;
    }

       public function getVacationDetails($id){
        // $sql="SELECT * FROM `vacation_request` vr inner join vacation_type vt on vr.vt_id = vt.vt_id where vacation_id = :id";
        // $stmt=$this->db->prepare($sql);
        // $stmt->bindparam(':id',$id);
        // $stmt->execute();
        // $result=$stmt->fetch();
        // return $result;
              try{
            $sql="SELECT * FROM `vacation_request` where vacation_id = :id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
 }

 public function getVactionByid($id){
    try{
        $sql="SELECT count(*) as num FROM vacation_request where user_id= :user_id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':user_id',$user_id);

        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
    }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

 public function getVacationUsername($id) {
    $sql = "SELECT * FROM `vacation_request` vr INNER JOIN user u ON vr.user_id = u.user_id WHERE vr.user_id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


 public function getVacationById($id) {
    $sql ="SELECT * FROM (`vacation_request`,`user` WHERE `vacation_request`.`user_id`=`user`.`user_id` and `vacation_request`.`user_id`=:id)or(`user` where user_id=:id)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
    print_r($result);
}
     public function getVacations(){
        try {
              $sql = "SELECT * FROM `vacation_request` vr  inner join vacation_type vt on vr.vt_id = vt.vt_id ";
        $result = $this->db->query($sql);
        return $result;
        }
      catch (PDOExeption $e) {
    //throw $th;
    echo $e->getMessage();
    return false;
}
}
  public function deleteVacation($id){
        try {
                $sql = "DELETE from vacation_request where vacation_id = :id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->execute();
        return true;
        } catch (PDOExeption $e) {
             echo $e->getMessage();
    return false;
        }
    }
      public function deleteVacationbyUser($id){
        try {
                $sql = "DELETE from vacation_request where user_id = :id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->execute();
        return true;
        } catch (PDOExeption $e) {
             echo $e->getMessage();
    return false;
        }
    }

    public function updateVacation($id,$first_date,$last_date,$description,$answer){
        try {
                $sql = "UPDATE `vacation_request` SET `description`=:description,`first_date`=
       :first_date,`last_date`=:last_date,`answer`=:answer WHERE vacation_id = :id" ;
         $stmt = $this->db->prepare($sql);
  $stmt ->bindparam(':id',$id);
  $stmt ->bindparam(':description',$description);
  $stmt ->bindparam(':first_date',$first_date);
  $stmt ->bindparam(':last_date',$last_date);
  $stmt ->bindparam(':answer',$answer);
  $stmt->execute();
  return true;
        } catch (PDOExeption $e) {
           //throw $th;
    echo $e->getMessage();
    return false;
        }
  
    }
 }
?>