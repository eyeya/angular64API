<?php
require('header.php');
if ($_SERVER['REQUEST_METHOD'] == "GET"){
  // อ่านค่าที่ส่งมา
  $username = $_GET["username"];
  $password = $_GET["password"];
  $sql=$con->query("SELECT * FROM tbuser LEFT JOIN tbstatus ON tbuser.
  statusid=tbstatus.statusid WHERE username='$username'AND 
  password='$password'");
  if(mysqli_num_rows($sql)>0) { // นับแถวที่ได้จากการ SELECT 
             $data = $sql->fetch_array();// อ่านค่าที่ SELECT ได้มา 1 เรคคอร์ด
             exit(json_encode(['status'=>$data['status']]));
  }else{
      exit(json_encode(['status'=>'not found']));
  }
}
  if($_SERVER['REQUEST_METHOD']== "POST"){
   //อ่านค่าที่ส่งมาด้วยเมธอด post
   $data = json_decode(file_get_contents("php://input"));
   $username = $data->username;
   $password = $data->password;
   $sql=$con->query("SELECT * FROM tbuser LEFT JOIN tbstatus ON tbuser.
  statusid=tbstatus.statusid WHERE username='$username'AND 
  password='$password'");
  if(mysqli_num_rows($sql)>0) { // นับแถวที่ได้จากการ SELECT 
             $data = $sql->fetch_array();// อ่านค่าที่ SELECT ได้มา 1 เรคคอร์ด
             exit(json_encode(['status'=>$data['status']]));
  }else{
      exit(json_encode(['status'=>'not found']));
  }
  }
