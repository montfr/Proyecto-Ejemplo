<?php
spl_autoload_register(function ($clase) {
	include './clases/class.' . $clase . '.php';
});

if(isset($_COOKIE["MAS"])){
	$StmCookie= $boot->db->prepare('Delete  from  sessioncookie WHERE id=?');
	$StmCookie->execute(array($_COOKIE["MAS"]));
}
setcookie("MAS", "", time() - 3600);
session_start();
session_destroy();


