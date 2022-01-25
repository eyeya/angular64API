<?php
require('header.php');
// php อ้างอิงข้อมูลจากแท็ก input type="file" ด้วยคำสั่ง $_FILES["ชื่อ"]["พารามิเตอร์"]
//เช่น อ้างอิงชื่อไฟล์ $_FILES["picture"]["name"]
//เช่น อ้างอิงขนาดไฟล์ $_FILES["picture"]["size"]
// exit(json_encode(["picture"=>$_FILES["picture"]]));
// อ่านค่า userid เพื่อใช้เปลี่ยนชื่อไฟล์ก่อน upload
$sql=$con->query("SELECT MAX(userid) AS userid FROM tbuser");
$result=$sql-> fetch_array();
$userid=$result["userid"];
//upload
if ($_FILES["picture"]){
    $name=$_FILES["picture"]["name"];
    $tmp_name=$_FILES["picture"]["tem_name"];
    //เปลี่ยนชื่อ
    $f=explode(".",$name);
    $newname=$userid.".".$f[1];
    if(move_uploaded_file($tmp_name,"images/$newname")){
        exit(json_encode(["status"=>"upload success"]));
    }else{
        exit(json_encode(["status"=>"upload error"]));
    }

}
?>