<?php
require_once __DIR__.'/../includes/.php';
session_start();

if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location:/');exit;}

$e=trim($_POST['email']??'');
$p=$_POST['password']??'';

$stmt=$pdo->prepare();
$stmt->execute([]);
$u=$stmt->fetch();

if($u){
    if(password_verify($p,$u['password'])){
        session_regenerate_id();
        $_SESSION['user_id']=$u[''];
        $_SESSION['user_name']=$u[''];
        $_SESSION['is_admin']=$u[''];
        header('Location:/');
        exit;
    }
}

$_SESSION['login_error']='Invalid';
header('Location:/.php');
exit;
?>
