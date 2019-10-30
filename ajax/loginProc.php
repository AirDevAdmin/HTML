<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . "/lib/DB1.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/lib/function.php");


$id = $_POST['id'];
$passwd = $_POST['passwd'];

$sql = "SELECT * FROM tk_admin WHERE id = '{$id}'";
$row = $db->get_row($sql);


if ($id!=$row->id)
{
    echo "no|아이디가 없습니다.";
    exit;
}
else
{
    $sql = "SELECT * FROM tk_admin WHERE id = '{$id}' AND passwd = '{$passwd}' ";
    $row = $db->get_row($sql);
    if ($id!=$row->id){
        echo "no|비밀번호를 잘못 입력하셨습니다.";
        exit;
    } else {

        $sql = "UPDATE tk_admin SET 
		last_login = now()
		WHERE id = '$id'";

        $res = $db->query($sql);

        $user_idx = $row->idx;
        $kdex_uid = $row->kdex_uid;
        $user_id = $row->id;
        //$url = $row->url;

        $_SESSION['sess_idx']     = $user_idx;
        $_SESSION['sess_id']      = $user_id;
        $_SESSION['kdex_uid']     = $kdex_uid;

        echo "ok|".$kdex_uid;


    }

}
?>
