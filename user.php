<?php
require('header.php');
// เขียนคำสั่ง php เพื่อเพิ่ม แก้ไข ลบ แสดง ข้อมูล
// เชื่อมต่อ MySQL 
// เขียนคำสั่งเพื่อดึงข้อมูล
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = $con->query("SELECT * FROM tbuser");
    if ($sql) {
        while ($data = $sql->fetch_assoc()) {
            $datas[] = $data;
        }
        exit(json_encode($datas));
    } else {
        exit(json_encode(['status' => 'error']));
    }
}
// เขียนคำสั่งเพื่อ post หรือ insert ข้อมูล
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // อ่านข้อมูลที่ส่งมาแบบ post
    $data = json_decode(file_get_contents("php://input"));
    // อ่านค่า
    $name = $data->name;
    $gender = $data->gender;
    $address = $data->address;
    $telephone = $data->telephone;
    $email = $data->email;
    $username = $data->username;
    $password = $data->password;
    $statusid = $data->statusid;
    $picture=$data-> picture;
    $sql=$con->query("INSERT INTO tbuser ( name, gender, address, telephone, email, username, password, statusid,picture) 
    VALUES ( '$name', '$gender', '$address', '$telephone', '$email', '$username', '$password', '$statusid','$picture')" );
    // update ชื่อไฟล์ใหม่โดยใช้รหัสโดยใช้รหัสผู้ใช้งานเป็นชื่อไฟล์
    $last_id = $con->insert_id;
    if ($picture != ""){
        // มีชื่อไฟล์
        $f = explode('.',$picture);
        $newfliename=$last_id.".".$f[1];
        $sql=$con->query("UPDATE tbuser SET picture='$newfliename' WHERE userid='$last_id' ");
    }
    if ($sql) {
        exit(json_encode(['status' => 'insert success']));
    } else {
        exit(json_encode(['status' => 'insert error']));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // อ่านค่าที่ส่งมา
    $userid = $_GET["userid"];
    $sql = $con->query("DELETE FROM tbuser WHERE userid='$userid' ");
    if ($sql) {
        exit(json_encode(['status' => 'delete success']));
    } else {
        exit(json_encode(['status' => 'delete error']));
    }
}
// เขียนคำสั่งเพื่อ put หรือ insert ข้อมูล
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    // อ่านข้อมูลที่ส่งมาแบบ put
    $data = json_decode(file_get_contents("php://put"));
    // อ่านค่า
    $userid = $data->userid;
    $name = $data->name;
    $gender = $data->gender;
    $address = $data->address;
    $telephone = $data->telephone;
    $email = $data->email;
    $username = $data->username;
    $password = $data->password;
    $statusid = $data->statusid;
    $sql = $con->query("UPDATE INTO tbuser SET name='$name' , gender='$gender' , address='$address' , telephone='$telephone' , email=' $email' ,username='$username' , password='$password',
    statusid='$statusid' WHERE userid=' $userid' ");
    if ($sql) {
        exit(json_encode(['status' => 'update success']));
    } else {
        exit(json_encode(['status' => 'update error']));
    }
}