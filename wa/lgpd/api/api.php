<?php 
header('Access-Control-Allow-Origin: *');
require_once('../../../includes/funcoes.php');
require_once('../../../database/config.database.php');
require_once('../../../database/config.php');
$id = $_GET['id'];
$codigo = $_GET['codigo'];
$banco = DBRead('lgpd_categoria','*' ,"WHERE id = '{$id}'")[0];
$ver = json_decode($banco['analitycs'],true);
echo $ver[$codigo]['codigo']
?>

