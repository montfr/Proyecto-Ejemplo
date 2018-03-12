<?php
require('ClaseInicial.php');
$ObjInicial = new Inicial(); 
if(isset($_COOKIE["MAS"])){
	$StmCookie= $ObjInicial->getConexion()->prepare('Delete  from  sessioncookie WHERE id=?');
	$StmCookie->execute(array($_COOKIE["MAS"]));
}
setcookie("MAS", "", time() - 3600);
session_start();
session_destroy();

header("location:http://".$_SERVER['HTTP_HOST']);
exit();
?>
