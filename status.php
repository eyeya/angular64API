<?php
require('header.php'); 


// เขียนคำสั่งเพื่อดึงข้อมูล get หรือ  select
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = $con->query("SELECT * FROM tbstatus ");
    if($sql) {
        while($data=$sql->fetch_assoc()){
            $datas[] = $data;
        }
        exit(json_encode($datas));
    } else {
        exit(json_encode(['status' => 'error']));
    }
}