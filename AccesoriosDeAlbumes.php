<?php
session_start();
require('./clases/class.boot.php');
$boot = new boot();
$boot->probarSession($_SERVER['REQUEST_URI']);
header($boot->charSet());
require_once './FuncionesPrincipales.php'; 
$objSinfonia = new Sinfonia();


require_once './clases/class.albumes.php'; 
$objAlbumes = new albumes($boot->db,$boot->dbOnline,$boot->socio);

//--------------------------------------------------------------------OBTENEMOS LAS OPCIONES ELEGIDAS POR EL USAURIO---------------------------------------------------------------
if( !isset($_GET['Producto']) || !isset($_GET['P']) ){
  exit;
}

$idProducto = $_GET['Producto'];
$idPedido = $_GET['P'];
$productData = $objSinfonia->get_product_data($boot->db,$idProducto,$idPedido);
$albumType = $productData['albumType'];
$idTamano = $productData['idTamano'];
$servicio = $productData['servicio'];
$alto = $productData['alto'];  
$ancho  =  $productData['ancho'];
$numAlbumesSecundario = $productData['numAlbumesSecundario'];
$altoSecundario = $productData['altoSecundario'];  
$anchoSecundario = $productData['anchoSecundario'];
$empastado =  $productData['tipoEmpastado'];  
$material = $productData['material'];
$carpeta = $productData['carpeta'];
$proPiel =  $productData['colorProPiel'];  
$piel = $productData['colorPiel'];
$nombreDeAlbum = $objSinfonia->getProductName($boot->db,$idProducto);


if($empastado == 9){
  $nombreDeAlbum = 'Americano con contraportada';
}
else if($empastado == 5){
  $nombreDeAlbum = 'Foto portada con contraportada';
}

$aumentoSocio = 1;

if($boot->socio == 10){
  $aumentoSocio = 3;
}


$precioPorFotoEstuchePortadaPrincipal = $objAlbumes->getPrecioFotoEstuche($alto,1)['precio'];
$precioPorFotoEstucheConContraPortadaPrincipal = $objAlbumes->getPrecioFotoEstuche($alto,2)['precio'];

$precioPorFotoEstuchePortadaSecundario = $objAlbumes->getPrecioFotoEstuche($altoSecundario,1)['precio'];
$precioPorFotoEstucheConContraPortadaSecundario = $objAlbumes->getPrecioFotoEstuche($altoSecundario,2)['precio'];

$estuchesPrincipal = $productData['estuchesPrincipal']; 
$estuchesSecundario = $productData['estuchesSecundario']; 
$fotoEstuchesPrincipal = $productData['fotoEstuchesPrincipal']; 
$fotoEstuchesSecundario = $productData['fotoEstuchesSecundario']; 

$precioPorEstuchesPrincipal = $productData['precioPorEstuchePrincipal']*$estuchesPrincipal; 
$precioPorEstuchesSecundario = $productData['precioPorEstucheSecundario']*$estuchesSecundario; 
$precioPorFotoEstuchesPrincipal =  $productData['precioPorFotoEstuchePrincipal']*$fotoEstuchesPrincipal; 
$precioPorFotoEstuchesSecundario =  $productData['precioPorFotoEstucheSecundario']*$fotoEstuchesSecundario; 

$cajaDeLuxPrincipal = $productData['cajaDeLuxPrimario']; 
$cajaDeLuxSecundario = $productData['cajaDeLuxSecundario']; 

$precioPorCajaDeLuxProPielPrincipal = ($objAlbumes->getPrecioCajaDeLux($alto,1)['precio'])*$aumentoSocio;
$precioPorCajaDeLuxProPielSecundario = ($objAlbumes->getPrecioCajaDeLux($altoSecundario,1)['precio'])*$aumentoSocio;

$precioPorCajaDeLuxPielPrimario = $objAlbumes->getPrecioCajaDeLux($alto,2)['precio'];
$precioPorCajaDeLuxPielSecundario = $objAlbumes->getPrecioCajaDeLux($altoSecundario,2)['precio'];

$precioPorCajaDeLuxPrincipal = $productData['precioPorCajaDeLuxPrincipal'] * $productData['cajaDeLuxPrimario'];
$precioPorCajaDeLuxSecundario = $productData['precioCajaDeLuxSecundario'] * $productData['cajaDeLuxSecundario'];
//--------------------------------------------------CAJA ARTISTICA-------------------------------------------------------------//
$cajaArtisticoPrimario = $productData['cajaArtisticoPrimario']; 
$cajaArtisticoSecundario = $productData['cajaArtisticoSecundario']; 

$precioPorCajaArtisticoProPielPrincipal = ($objAlbumes->getPrecioCajaArtistica($alto,1)['precio'])*$aumentoSocio;
$precioPorCajaArtisticoProPielSecundario = ($objAlbumes->getPrecioCajaArtistica($altoSecundario,1)['precio'])*$aumentoSocio;

$precioPorCajaArtisticoPielPrimario =  ($objAlbumes->getPrecioCajaArtistica($alto,2)['precio'])*$aumentoSocio;
$precioPorCajaArtisticoPielSecundario =  ($objAlbumes->getPrecioCajaArtistica($altoSecundario,2)['precio'])*$aumentoSocio;

$precioPorCajaArtisticoPrincipal =  $productData['precioPorCajaArtisticaPrincipal'] * $productData['cajaArtisticoPrimario'];
$precioPorCajaArtisticoSecundario =  $productData['precioPorCajaArtisticaSecundario'] * $productData['cajaArtisticoSecundario'];
//-----------------------------------------------PRO BOX----------------------------------------------------------//
$proBoxPrincipal = $productData['proBoxPrincipal']; 
$proBoxSecundario = $productData['proBoxSecundario']; 

$precioPorProBoxPrincipalProPiel = ($objAlbumes->getPrecioProBox($alto,1)['precio'])*$aumentoSocio;
$precioPorProBoxSecundarioProPiel = ($objAlbumes->getPrecioProBox($altoSecundario,1)['precio'])*$aumentoSocio;

$precioPorProBoxPrincipalPiel = ($objAlbumes->getPrecioProBox($alto,2)['precio'])*$aumentoSocio;
$precioPorProBoxSecundarioPiel = ($objAlbumes->getPrecioProBox($altoSecundario,2)['precio'])*$aumentoSocio;

$totalPorProBoxPrincipal = $productData['precioPorProBoxPrincipal'] * $productData['proBoxPrincipal'];
$totalPorProBoxSecundario = $productData['precioPorProBoxSecundario'] * $productData['proBoxSecundario'];
//-------------------------------------------CLEAR BOX-----------------------------------------------------------//
$clearBoxPrincipal =  $productData['clearBoxPrincipal']; 
$clearBoxSecundario = $productData['clearBoxSecundario']; 

$precioPorClearBoxPrincipalProPiel =  ($objAlbumes->getPrecioClearBox($alto,1)['precio'])*$aumentoSocio;
$precioPorClearBoxSecundarioProPiel = ($objAlbumes->getPrecioClearBox($altoSecundario,1)['precio'])*$aumentoSocio;

$precioPorClearBoxPrincipalPiel =  ($objAlbumes->getPrecioClearBox($alto,2)['precio'])*$aumentoSocio;
$precioPorClearBoxSecundarioPiel =  ($objAlbumes->getPrecioClearBox($altoSecundario,2)['precio'])*$aumentoSocio;

$totalPorClearBoxPrincipal = $productData['precioPorClearBoxPrincipal'] * $productData['clearBoxPrincipal'];
$totalPorClearBoxSecudnario = $productData['precioPorClearBoxSecundario'] * $productData['clearBoxSecundario'];
//------------------------------------------ FOTO BOX ------------------------------------------------------------------//
$fotoBoxPrincipal = $productData['fotoBoxPrincipal']; 
$fotoBoxSecundario =  $productData['fotoBoxSecundario']; 

$precioPorFotoBoxPrincipal =  ($objAlbumes->getPrecioFotoBox($alto)['precio'])*$aumentoSocio;
$precioPorFotoBoxSecundario =  ($objAlbumes->getPrecioFotoBox($altoSecundario)['precio'])*$aumentoSocio;

$totalPorFotoBoxPrincipal = $productData['precioPorFotoBoxPrincipal'] * $productData['fotoBoxPrincipal'];
$totalPorFotoBoxSecundario = $productData['precioPorFotoBoxSecundario'] * $productData['fotoBoxSecundario'];
//------------------------------------------ GRABADO ------------------------------------------------------------------//
$grabadoPrincipal = $productData['grabadoPrincipal'];
$totalPorGrabadoPrincipal = $productData['precioPorGrabadoPrincipal']; 

$idCropper = $boot->randStrGen(10);
$idCropperContraPortada = $boot->randStrGen(10);

$idCropperPortadaFotoBox = $boot->randStrGen(10);
$idCropperImagenInterior = $boot->randStrGen(10);
$idCropperPortadaFotoEstuche = $boot->randStrGen(10);

$rutaCropFotoEstuche = '../pedidos/'.$boot->socio.'/20/'.$_SESSION["iduser"].'/'.$carpeta;
$rutaCropContraPortadaFotoEstuche = '../pedidos/'.$boot->socio.'/29/'.$_SESSION["iduser"].'/'.$carpeta;
$rutaFotoBoxPortada = '../pedidos/'.$boot->socio.'/26/'.$_SESSION["iduser"].'/'.$carpeta;
$rutaFotoBoxInterior =  '../pedidos/'.$boot->socio.'/27/'.$_SESSION["iduser"].'/'.$carpeta;
$rutaFotoBoxContraPortada = '../pedidos/'.$boot->socio.'/28/'.$_SESSION["iduser"].'/'.$carpeta;
$precioPorCharola = 15;

$stmTipografiaDeGrabado = $boot->db->prepare('select * from tipografiasDeGrabado');
$stmTipografiaDeGrabado ->execute();
$resTipografiasDeGrabado = $stmTipografiaDeGrabado ->fetchAll();
?>
<!DOCTYPE html>
<html lang="<?=$boot->language;?>">
  <head>
    <?php $boot->header('Accesorios de albumes'); ?>  
  
    <link href="/css/cropper.min.css" rel="stylesheet">
    <style type="text/css">
      div.clear{
        clear: both;
      }
      div.product-chooser.disabled div.product-chooser-item{
        zoom: 1;
        filter: alpha(opacity=60);
        opacity: 0.6;
        cursor: default;
      }
      div.product-chooser div.product-chooser-item{
        padding: 11px;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        border: 1px solid #efefef;
        margin-bottom: 10px;
        margin-left: 10px;
        margin-right: 10x;
      }
      div.product-chooser div.product-chooser-item:hover{
        border: 4px solid #428bca;
        background: #efefef;
        padding: 8px;
        filter: alpha(opacity=100);
        opacity: 1;
      }
      div.product-chooser div.product-chooser-item img{
        padding: 0;
      }
      div.product-chooser div.product-chooser-item span.title{
        display: block;
        margin: 10px 0 5px 0;
        font-weight: bold;
        font-size: 12px;
      }
      div.product-chooser div.product-chooser-item span.description{
        font-size: 12px;
      }
      div.product-chooser div.product-chooser-item input{
        position: absolute;
        left: 0;
        top: 0;
        visibility:hidden;
      }
      .col-item {
        border: 1px solid #E1E1E1;
        border-radius: 5px;
        background: #FFF;
      }
      .col-item .photo img {
        margin: 0 auto;
        width: 100%;
      }
      .col-item .info {
        padding: 10px;
        border-radius: 0 0 5px 5px;
        margin-top: 1px;
      }
      .col-item:hover .info{
        background-color: #F5F5DC;
      }
      .col-item .price  {
        /*width: 50%;*/
        float: left;
        margin-top: 5px;
      }
      .col-item .price h5{
        line-height: 20px;
        margin: 0;
      }

      .price-text-color{
        color: #219FD1;
      }
      .col-item .info{
        padding: 10px;
        border-radius: 0 0 5px 5px;
        margin-top: 1px;
      }
      .col-item:hover .info {
        background-color: #F5F5DC;
      }
      .col-item .price {
        /*width: 50%;*/
        float: left;
        margin-top: 5px;
      }
      .col-item .price h5{
        line-height: 20px;
        margin: 0;
      }
      .price-text-color{
        color: #219FD1;
      }
      .col-item .info .rating{
        color: #777;
      }
      .col-item .rating{
        /*width: 50%;*/
        float: left;
        font-size: 17px;
        text-align: right;
        line-height: 52px;
        margin-bottom: 10px;
        height: 52px;
      }
      .col-item .separator{
        border-top: 1px solid #E1E1E1;
      }
      .clear-left{
        clear: left;
      }
      .col-item .separator p{
        line-height: 20px;
        margin-bottom: 0;
        margin-top: 10px;
        text-align: center;
      }
      .col-item .separator p i{
        margin-right: 5px;
      }
      .col-item .btn-add{
        width: 50%;
        float: left;
      }
      .col-item .btn-add{
        border-right: 1px solid #E1E1E1;
      }
      .col-item .btn-details{
        width: 50%;
        float: left;
        padding-left: 10px;
      }
      .controls{
        margin-top: 20px;
      }
      [data-slide="prev"]{
        margin-right: 10px;
      }
      .jcrop-centered{
        display: inline-block;
      }
        
      .crop-image-wrapper{
        text-align: center;
      }

      .img-container img {
        max-width: 100%;
      }
      /*
      |
      |--------------------------------------------------------------------------
      | Estilo de botones redondos
      |--------------------------------------------------------------------------
      |
      */
      .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
      }
      .btn-circle.btn-lg {
        width: 50px;
        height: 50px;
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 25px;
      }
      .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border-radius: 35px;
      }

      .cajaColor{
        margin-bottom:1em;
        cursor:pointer;
      }

      .cajaColor img:hover{
        outline: none;
        border-color: #9ecaed;
        box-shadow: 0 0 10px #9ecaed;
      }
      .datepicker{z-index:1151 !important;}
    </style>
  </head>

  <body>
    <?php $boot->menu();?>

     	<div id="sb-site"  >
      	<div class="container">
          <div class="page-header">
            <h1>Accesorios  
              <div class="pull-right ">
                <a class="btn  btn-success" onClick="guardar();">
                  <i class="fa fa-bars"></i> &nbsp;  Continuar 
                </a>
              </div>  
                        
            </h1>

            <br><br>
            <div class="list-group" id="listaDeAccesoriosPedidos">
              <?php

                if($estuchesPrincipal != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liEstuchePrimario">
                      Estuches para álbum principal
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $estuchesPrincipal ?></button>
                        <button class="btn btn-xs btn-success">$<?= $precioPorEstuchesPrincipal ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarEstuchePrincipal">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($estuchesSecundario != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liEstucheSecundario">
                      Estuches para álbum extra
                      <span class="pull-right">
                          <button class="btn btn-xs btn-info"><?= $estuchesSecundario ?></button>
                          <button class="btn btn-xs btn-success">$<?= $precioPorEstuchesSecundario ?></button>
                          <button class="btn btn-xs btn-danger" id="btnEliminarEstucheSecundario">
                            <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </span>
                    </a>
                  <?php
                }

                if($fotoEstuchesPrincipal != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liFotoEstuchePrimario">
                      Foto estuches para álbum principal 
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $fotoEstuchesPrincipal ?> </button>
                        <button class="btn btn-xs btn-success">$<?= $precioPorFotoEstuchesPrincipal ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarFotoEstuchePrincipal">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($fotoEstuchesSecundario != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liFotoEstucheSecundario">
                      Foto estuches para álbum extra
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $fotoEstuchesSecundario ?> </button>
                        <button class="btn btn-xs btn-success">$<?= $precioPorFotoEstuchesSecundario ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarFotoEstucheSecundario">
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($cajaDeLuxPrincipal != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liCajaDeLuxPrincipal">
                      Caja de lux para álbum principal
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $cajaDeLuxPrincipal ?></button>
                        <button class="btn btn-xs btn-success">$<?= $precioPorCajaDeLuxPrincipal ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarCajaDeLuxPrincipal">
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($cajaDeLuxSecundario != 0){
                  ?>
                     
                    <a href="#" class="list-group-item clearfix" id="liCajaDeLuxSecundario">
                      Caja de lux para álbum extra
                      <span class="pull-right">
                          <button class="btn btn-xs btn-info"><?= $cajaDeLuxSecundario ?></button>
                          <button class="btn btn-xs btn-success">$<?= $precioPorCajaDeLuxSecundario ?></button>
                          <button class="btn btn-xs btn-danger" id="btnEliminarCajaDeLuxSecundario">
                              <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </span>
                    </a>
                  <?php
                }

                if($cajaArtisticoPrimario != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liCajaArtisticaPrincipal">
                      Caja artistica para álbum principal
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $cajaArtisticoPrimario ?></button>
                        <button class="btn btn-xs btn-success">$<?= $precioPorCajaArtisticoPrincipal  ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarCajaArtisticaPrincipal">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($cajaArtisticoSecundario != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liCajaArtisticaSecundario">
                      Caja artistica para álbum extra
                      <span class="pull-right">
                          <button class="btn btn-xs btn-info"><?= $cajaArtisticoSecundario ?></button>
                          <button class="btn btn-xs btn-success">$<?= $precioPorCajaArtisticoSecundario  ?></button>
                          <button class="btn btn-xs btn-danger" id="btnEliminarCajaArtisticaSecundario">
                              <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </span>
                    </a>
                  <?php
                }

                if($proBoxPrincipal != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liProBoxPrincipal">
                      Pro box para álbum principal 
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $proBoxPrincipal ?></button>
                        <button class="btn btn-xs btn-success">$<?= $totalPorProBoxPrincipal  ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarProBoxPrincipal">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($proBoxSecundario != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liProBoxSecundario">
                      Pro box para álbum extra
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $proBoxSecundario ?></button>
                        <button class="btn btn-xs btn-success">$<?= $totalPorProBoxSecundario  ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarProBoxSecundario">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($clearBoxPrincipal != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liClearBoxPrincipal">
                      Clear box para álbum principal
                      <span class="pull-right">
                          <button class="btn btn-xs btn-info"><?= $clearBoxPrincipal ?></button>
                          <button class="btn btn-xs btn-success">$<?= $totalPorClearBoxPrincipal  ?></button>
                          <button class="btn btn-xs btn-danger" id="btnEliminarClearBoxPrincipal">
                              <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </span>
                    </a>
                  <?php
                }

                if($clearBoxSecundario != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liClearBoxSecundario">
                      Clear box para álbum extra 
                      <span class="pull-right">
                          <button class="btn btn-xs btn-info"><?= $clearBoxSecundario ?></button>
                          <button class="btn btn-xs btn-success">$<?= $totalPorClearBoxSecudnario  ?></button>
                          <button class="btn btn-xs btn-danger" id="btnEliminarClearBoxSecundario">
                              <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </span>
                    </a>
                  <?php
                }

                if($fotoBoxPrincipal != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liFotoBoxPrincipal">
                      Foto box para álbum principal
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info"><?= $fotoBoxPrincipal ?></button>
                        <button class="btn btn-xs btn-success">$<?= $totalPorFotoBoxPrincipal  ?></button>
                        <button class="btn btn-xs btn-danger" id="btnEliminarFotoBoxPrincipal">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                      </span>
                    </a>
                  <?php
                }

                if($fotoBoxSecundario != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liFotoBoxSecundario">
                      Foto box para álbum extra
                      <span class="pull-right">
                          <button class="btn btn-xs btn-info"><?= $fotoBoxSecundario ?></button>
                          <button class="btn btn-xs btn-success">$<?= $totalPorFotoBoxSecundario  ?></button>
                          <button class="btn btn-xs btn-danger" id="btnEliminarFotoBoxSecundario">
                              <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </span>
                    </a>
                  <?php
                }

                if($grabadoPrincipal != 0){
                  ?>
                    <a href="#" class="list-group-item clearfix" id="liGrabadoPrincipal">
                      Grabado para álbum principal
                      <span class="pull-right">
                          <button class="btn btn-xs btn-info"><?= $grabadoPrincipal ?></button>
                          <button class="btn btn-xs btn-success">$<?= $totalPorGrabadoPrincipal  ?></button>
                          <button class="btn btn-xs btn-danger" onclick="eliminarGrabado();">
                              <span class="glyphicon glyphicon-trash"></span>
                          </button>
                      </span>
                    </a>
                  <?php
                }

              ?>
            </div>
          </div>

          <div class="row form-group product-chooser">
          
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnEstuche" data-toggle="modal" data-target="#modalEstuche" >
              <div class="product-chooser-item col-item">
                <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/estuche.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                  <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                </div>
                <div class="clear"></div>
                  <div class="info">
                    <div class="row">
                      <div class="price col-md-6">
                        <h5>Estuche</h5>
                        <h5 class="price-text-color">
                          Desde $<?= ($objAlbumes->getPrecioEstuche($alto)['precio'])*$aumentoSocio;?>
                        </h5>
                      </div>
                      <div class="rating hidden-sm col-md-6">
                        <i class="price-text-color fa fa-star"></i>
                        <i class="price-text-color fa fa-star"></i>
                        <i class="price-text-color fa fa-star"></i>
                        <i class="price-text-color fa fa-star"></i>
                        <i class="price-text-color fa fa-star"> </i>
                      </div>
                    </div>
                    <div class="separator clear-left">
                      <p class="btn-add">
                        <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a>
                      </p>
                      <p class="btn-details hidden">
                        <i class="fa fa-list"></i><a href="//www.jquery2dotnet.com" class="hidden-sm">More details</a>
                      </p>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>    
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnFotoEstuche">
              <div class="product-chooser-item col-item">
                <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/Foto estuche.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                  <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                </div>
                <div class="clear"></div>
                  <div class="info">
                    <div class="row">
                      <div class="price col-md-6">
                        <h5>Foto Estuche</h5>
                        <h5 class="price-text-color">
                            Desde $<?= ($objAlbumes->getPrecioFotoEstuche($alto,1)['precio'])*$aumentoSocio;?></h5>
                      </div>
                        <div class="rating hidden-sm col-md-6">
                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                            </i><i class="price-text-color fa fa-star"> </i>
                        </div>
                    </div>
                    <div class="separator clear-left">
                        <p class="btn-add">
                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a></p>
                        <p class="btn-details hidden">
                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
              </div>    
            </div>


            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnFotoBox">
                
                <div class="product-chooser-item col-item">
                    <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/Fotobox.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                    <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">

                       
                        <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                       
                    </div>
                    <div class="clear"></div>
                    
                        <div class="info">
                            <div class="row">
                                <div class="price col-md-6">
                                    <h5>
                                       Foto box</h5>
                                    <h5 class="price-text-color">
                                        Desde $<?= ($objAlbumes->getPrecioFotoBox($alto)['precio'])*$aumentoSocio;?></h5>
                                </div>
                                <div class="rating hidden-sm col-md-6">
                                    <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                    </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                    </i><i class="price-text-color fa fa-star"> </i>
                                </div>
                            </div>
                            <div class="separator clear-left">
                                <p class="btn-add">
                                    <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a></p>
                                <p class="btn-details hidden">
                                    <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>    
             
            </div>


            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnProBox">
                
                <div class="product-chooser-item col-item">
                    <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/ProBox.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                    <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">

                       
                        <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                       
                    </div>
                    <div class="clear"></div>
                    
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>
                                   Pro box</h5>
                                <h5 class="price-text-color">
                                    Desde $<?php  if($material == 1){echo $precioPorProBoxPrincipalProPiel;} else if($material == 2){ echo $precioPorProBoxPrincipalPiel; }   ?></h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"> </i>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a>
                            </p>
                            <p class="btn-details hidden">
                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a>
                            </p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>    
             
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnCajaDeLux">
                
                <div class="product-chooser-item col-item">
                    <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/caJaDeLux.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                    <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">

                       
                        <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                       
                    </div>
                    <div class="clear"></div>
                    
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>
                                   Caja de lux</h5>
                                <h5 class="price-text-color">
                                    Desde $<?php if($material == 1){ echo $precioPorCajaDeLuxProPielPrincipal; } else if($material == 2){ echo $precioPorCajaDeLuxPielPrincipal; } else if($material == 3){echo 'S/N';} else {echo $precioPorCajaDeLuxProPielPrincipal;} ?></h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"> </i>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a>
                            </p>
                            <p class="btn-details hidden">
                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a>
                            </p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>    
             
            </div>


            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnCajaArtistica">
                
                <div class="product-chooser-item col-item">
                    <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/cajaArtistica.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                    <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">

                       
                        <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                       
                    </div>
                    <div class="clear"></div>
                    
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>
                                   Caja  artistica</h5>
                                <h5 class="price-text-color">
                                    Desde $<?php if($material == 1){ echo $precioPorCajaArtisticoProPielPrincipal ; } else if($material == 2){ echo $precioPorCajaArtisticoPielPrincipal ; } else if($material == 3){echo 'S/N';} else {echo $precioPorCajaArtisticoProPielPrincipal ;} ?></h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"> </i>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a>
                            </p>
                            <p class="btn-details hidden">
                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a>
                            </p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>    
             
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnClearBox">
                
                <div class="product-chooser-item col-item">
                    <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/clearBox.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                    <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">

                       
                        <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                       
                    </div>
                    <div class="clear"></div>
                    
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>
                                   Clear box</h5>
                                <h5 class="price-text-color">
                                     Desde $<?php  if($material == 1){echo $precioPorClearBoxPrincipalProPiel;} else if($material == 2){ echo $$precioPorClearBoxPrincipalPiel; }   ?></h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                </i><i class="price-text-color fa fa-star"> </i>

                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a>
                            </p>
                            <p class="btn-details hidden">
                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a>
                            </p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>    
             
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="btnGrabado">
                
                <div class="product-chooser-item col-item">
                    <img src="/imagenes/<?= $boot->socioGenerico?>/AccesoriosAlbums/grabado.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Mobile and Desktop">
                    <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                       
                        <span class="description hidden">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. .</span>
                       
                    </div>
                    <div class="clear"></div>
                    
                        <div class="info">
                            <div class="row">
                                <div class="price col-md-6">
                                    <h5>
                                       Grabado</h5>
                                    <h5 class="price-text-color">
                                        Desde $125</h5>
                                </div>
                                <div class="rating hidden-sm col-md-6">
                                    <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                    </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                    </i><i class="price-text-color fa fa-star"> </i>
                                </div>
                            </div>
                            <div class="separator clear-left">
                                <p class="btn-add">
                                    <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Agregar</a></p>
                                <p class="btn-details hidden">
                                    <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                </div>    
             
            </div>
              
          </div>


        </div>

        <?php
          $boot->getFooter();
          $boot->scripts();
        ?>  

          <script src="./js/sweetalert.js"></script>
          <link rel="stylesheet" href="./css/sweetalert.css">
      </div>



      <div class="modal fade" id="modalEstuche" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Estuche</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de estuches para el álbum principal  </h4>
                      <p>Precio por estuche  $ <span id="precioEstuchePrincipal"><?php  $precio = $objAlbumes->getPrecioEstuche($alto); echo ($precio['precio']*$aumentoSocio) ?></span></h5></p>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="estuchesPrincipal">
                                  <option>0</option>
                                  <option selected>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                              </select>
                          </div>
                      </div> 

                  
                          <div class="<?php if($numAlbumesSecundario == 0){ echo "hidden"; } ?>">
                              <hr>    
                              <h4>Cantidad de estuches para el álbum extra</h4>
                              <p>Precio por estuche   $<span id="precioEstucheSecundario"><?php  $precio = $objAlbumes->getPrecioEstuche($altoSecundario); echo $precio['precio'] ?></span></h5></p>
                              <div class="row">
                                  <div class="col-md-6 col-md-offset-3">
                                      <select class="form-control" id="estuchesSecundario">
                                          <option selected>0</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10</option>
                                      </select>
                                  </div>
                              </div>
                          </div>    
                      


                      <br>
                      <div id="errorNumEstuche"></div>               
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="guardarEstuche">Guardar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalPortadaFotoEstuche" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Foto Estuche</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Que portada usar?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="portadaAUsarFotoEstuche">
                                <option value="1">Utilizar la misma portada del album</option>
                                <option  value="2">Subir una foto nueva</option>
                               
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="fotoEstucheTipoDePortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalContraPortadaFotoEstuche" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Foto Estuche</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Que Contra portada usar?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="contraPortadaAUsarFotoEstuche">
                                <option value="1">Utilizar la misma contra portada del album</option>
                                <option  value="2">Subir una foto nueva</option>
                               
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="fotoEstucheTipoDeContraPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalCantidadDeFotoEstuche" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Foto Estuche</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de Foto estuches para el álbum principal</h4>
                      <p>Precio por Foto estuche  $ <span id="priceFotoEstuchePrincipal"><?php  $precio = $objAlbumes->getPrecioFotoEstuche($alto,1); echo ($precio['precio']*$aumentoSocio) ?></span></h5></p>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="fotoEstuchesPrincipal">
                                  <option>0</option>
                                  <option selected>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                              </select>
                          </div>
                      </div> 

                      

                         
                               
                      <div class="<?php  if($numAlbumesSecundario == 0){ echo "hidden"; }?>">
                          <hr>
                          <h4>Cantidad de foto estuches para el álbum extra</h4>
                          <p>Precio por estuche   $<span id="priceFotoEstucheSecundario"><?php  $precio = $objAlbumes->getPrecioFotoEstuche($altoSecundario,1); echo ($precio['precio']*$aumentoSocio) ?></span></h5></p>
                          <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                  <select class="form-control" id="fotoEstuchesSecundario">
                                      <option selected>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                  </select>
                              </div>
                          </div>
                      </div>    
                             
                          
                   

                      <br>
                      <div id="errorNumFotoEstuche"></div>           
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="guardarFotoEstuche">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

    
      <div class="modal fade  bs-example-modal-lg" id="modalSubidorPortada"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Agregar imagen </h4>
                  </div>
            
                  <div class="modal-body" id="SubidorArchivos">
              
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btnContinuarSubidor btn btn-primary" id="continuarSubidaDePortadaFotoEstuche" disabled="disabled">Continuar </button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade  bs-example-modal-lg" id="modalSubidorContraPortada"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Agregar imagen </h4>
                  </div>
            
                  <div class="modal-body" id="SubidorArchivosContraPortada">
              
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btnContinuarSubidor btn btn-primary" id="continuarSubidaDeContraPortadaFotoEstuche" disabled="disabled">Continuar </button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCropPortadaFotoEstuche" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Recorte la imagen de la  portada</h4>
                  
                  </div>

                  <div class="modal-body" id="imgCropPortadaFotoEstuche">
                  
                    
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary recorteCropPortadaFotoEstuche" >Continuar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCropContraPortadaFotoEstuche" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Recorte la imagen de la contra portada</h4>
                  
                  </div>

                  <div class="modal-body" id="imgCropContraPortadaFotoEstuche">
                  
                    
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary recorteCropContraPortadaFotoEstuche" >Continuar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalPreguntaSiDeseanContraPortadaFotoEstuche" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Aviso</h4>
                  
                  </div>

                  <div class="modal-body" >
                      
                      <p>Deseas agregar foto para la contra portada del foto estuche</p>
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="respuestaSubirContraPortadaFotoEstuche(2)">Si</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="respuestaSubirContraPortadaFotoEstuche(1)">No</button>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="modal modal-chico fade" id="modalGuardando" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="text-center">
                    <i class="fa fa-cog fa-spin fa-5x"></i>
                    <h4>Guardando... </h4>
                    <br>
                    
                        
                  </div>
              </div>
            </div>
        </div>
      </div>

      <div class="modal fade" id="modalCantidadDeCajaDeLux" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Caja de lux</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de caja de lux para el álbum principal</h4>
                      <p>Precio por caja de lux  $ <span id="precioCajaDeLuxPrincipal"><?php if($material == 1){ echo $precioPorCajaDeLuxProPielPrincipal; } else if($material == 2){ echo $precioPorCajaDeLuxPielPrincipal; } else if($material == 3){echo 'S/N';} else {echo $precioPorCajaDeLuxProPielPrincipal;} ?></span></h5></p>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="cajaDeLuxPrimario">
                                  <option>0</option>
                                  <option selected>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                              </select>
                          </div>
                      </div> 

                      

                         
                               
                      <div class="<?php  if($numAlbumesSecundario == 0){ echo "hidden"; }?>">
                          <hr>
                          <h4>Cantidad de caja de lux para el álbum extra</h4>
                          <p>Precio por caja de lux   $<span id="precioCajaDeLuxSecundario"><?php if($material == 1){ echo $precioPorCajaDeLuxProPielSecundario; } else if($material == 2){ echo $precioPorCajaDeLuxPielSecundario; } else if($material == 3){echo 'S/N';} else {echo $precioPorCajaDeLuxProPielSecundario;} ?></span></h5></p>
                          <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                  <select class="form-control" id="cajaDeLuxSecundario">
                                      <option selected>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                  </select>
                              </div>
                          </div>
                      </div>    
                             
                          
                   

                      <br>
                      <div id="errorNumCajaDeLux"></div>           
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="cantidadCajaDeLux">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipoMaterialCajaDeLux" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Que material usar para la caja de lux?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="materialAUarCajaDeLux">
                                  <option value="1">Utilizar el mismo material del álbum</option>
                                  <option value="2"> Elegir material nuevo</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterialAUsarCajaDeLux">Guardar</button>
                  </div>
              </div>
          </div>
      </div>        

      <div class="modal fade" id="modalMaterialCajaDeLux" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Tipo de material</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="material">
                                  <option value="1">Pro piel</option>
                                  <option value="2" class="hidden"> Piel</option>
                                  <option value="3" class="hidden"> Amazing skin</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterial">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalColorProPiel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de pro piel</h4>
                  </div>
            
                  <div class="modal-body text-center">
              

                      <div class="row">


                          <?php

                              $stm = $boot->db->prepare('SELECT * FROM cajaalbumes WHERE IdPaso = 80');
                              $stm->execute();

                              $coloresDeProPiel = $stm->fetchAll(PDO::FETCH_ASSOC);

                              foreach ($coloresDeProPiel as $colorPorPiel) {
                                  
                                  ?>

                                      <div class="col-md-3 cajaColor">

                                          <img onClick="elegirColorProPiel(<?= $colorPorPiel['Valor'] ?>);" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/ProPiel/<?= $colorPorPiel['Valor'] ?>.png" alt="..." class="img-thumbnail">
                                          <p style="margin-top:.3em;"><?= $colorPorPiel['NombreOpcionCaja'] ?></p>
                                      

                                      </div>


                                  <?php
                              }



                          ?>



                          
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>
         
      <div class="modal fade" id="modalTipoMaterialCajaArtistica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Que material usar para la caja artistica?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="materialAUsarCajaArtistica">
                                  <option value="1">Utilizar el mismo material del álbum</option>
                                  <option value="2"> Elegir material nuevo</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterialAUsarCajaArtistica">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCantidadDeCajaArtistica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Caja artistica</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de caja artistica para el álbum principal</h4>
                      <p>Precio por caja artistica  $ <span id="precioCajaArtisticaPrincipal"><?php if($material == 1){ echo $precioPorCajaArtisticoProPielPrincipal ; } else if($material == 2){ echo $precioPorCajaArtisticoPielPrincipal ; } else if($material == 3){echo 'S/N';} else {echo $precioPorCajaArtisticoProPielPrincipal ;} ?></span></h5></p>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="cajaArtisticaPrimario">
                                  <option>0</option>
                                  <option selected>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                              </select>
                          </div>
                      </div> 

                      

                         
                               
                      <div class="<?php  if($numAlbumesSecundario == 0){ echo "hidden"; }?>">
                          <hr>
                          <h4>Cantidad de caja artistica para el álbum extra</h4>
                          <p>Precio por caja artistica    $<span id="precioCajaArtisticaSecundario"><?php if($material == 1){ echo $precioPorCajaArtisticoProPielSecundario ; } else if($material == 2){ echo $precioPorCajaArtisticoPielSecundario ; } else if($material == 3){echo 'S/N';} else {echo $precioPorCajaArtisticoProPielSecundario ;} ?></span></h5></p>
                          <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                  <select class="form-control" id="cajaArtisticaSecundario">
                                      <option selected>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                  </select>
                              </div>
                          </div>
                      </div>    
                             
                          
                   

                      <br>
                      <div id="errorNumCajaArtistica"></div>           
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="cantidadCajaArtistica">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalMaterialCajaArtistica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material para caja artistica</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Tipo de material</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="materialCajaArtistica">
                                  <option value="1">Pro piel</option>
                                  <option value="2" class="hidden"> Piel</option>
                                  <option value="3" class="hidden"> Amazing skin</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterialCajaArtistica">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalColorProPielCajaArtistica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de pro piel para la caja artistica</h4>
                  </div>
            
                  <div class="modal-body text-center">
              

                      <div class="row">


                          <?php

                              $stm = $boot->db->prepare('SELECT * FROM cajaalbumes WHERE IdPaso = 80');
                              $stm->execute();

                              $coloresDeProPiel = $stm->fetchAll(PDO::FETCH_ASSOC);

                              foreach ($coloresDeProPiel as $colorPorPiel) {
                                  
                                  ?>

                                      <div class="col-md-3 cajaColor">

                                          <img onClick="elegirColorProPielCajaArtistica(<?= $colorPorPiel['Valor'] ?>);" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/ProPiel/<?= $colorPorPiel['Valor'] ?>.png" alt="..." class="img-thumbnail">
                                          <p style="margin-top:.3em;"><?= $colorPorPiel['NombreOpcionCaja'] ?></p>
                                      

                                      </div>


                                  <?php
                              }



                          ?>



                          
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipoMaterialProBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Que material usar para el pro box?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="materialAUsarProBox">
                                  <option value="1">Utilizar el mismo material del álbum</option>
                                  <option value="2"> Elegir material nuevo</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterialAUsarProBox">Guardar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalCantidadDeProBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Pro box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de pro box para el álbum principal</h4>
                      <p>Precio por pro box  $ <span id="precioProBoxPrincipal"><?php  echo $precioPorProBoxPrincipalProPiel;  ?></span></h5></p>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="proBoxPrincipal">
                                  <option>0</option>
                                  <option selected>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                              </select>
                          </div>
                      </div> 

                      

                         
                               
                      <div class="<?php  if($numAlbumesSecundario == 0){ echo "hidden"; }?>">
                          <hr>
                          <h4>Cantidad de pro box para el álbum extra</h4>
                          <p>Precio por pro box    $<span id="precioProBoxSecundario"><?php  echo $precioPorProBoxSecundarioProPiel  ?></span></h5></p>
                          <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                  <select class="form-control" id="proBoxSecundario">
                                      <option selected>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                  </select>
                              </div>
                          </div>
                      </div>    
                             
                          
                   

                      <br>
                      <div id="errorNumProBox"></div>           
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="cantidadProBox">Continuar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalMaterialProBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elegir un material?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="materialProBox">
                                  <option value="1">Pro piel</option>
                                  <option value="2"> Piel</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterialProBox">Guardar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalColorProPielProBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de pro piel para el pro box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              

                      <div class="row">


                          <?php

                              $stm = $boot->db->prepare('SELECT * FROM cajaalbumes WHERE IdPaso = 80');
                              $stm->execute();

                              $coloresDeProPiel = $stm->fetchAll(PDO::FETCH_ASSOC);

                              foreach ($coloresDeProPiel as $colorPorPiel) {
                                  
                                  ?>

                                      <div class="col-md-3 cajaColor">

                                          <img onClick="elegirColorProPielProBox(<?= $colorPorPiel['Valor'] ?>);" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/ProPiel/<?= $colorPorPiel['Valor'] ?>.png" alt="..." class="img-thumbnail">
                                          <p style="margin-top:.3em;"><?= $colorPorPiel['NombreOpcionCaja'] ?></p>
                                      

                                      </div>


                                  <?php
                              }



                          ?>



                          
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>




      <div class="modal fade" id="modalTipoMaterialClearBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Que material usar para el clear box ?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="materialAUsarClearBox">
                                  <option value="1">Utilizar el mismo material del álbum</option>
                                  <option value="2"> Elegir material nuevo</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterialAUsarClearBox">Guardar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalCantidadDeClearBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Clear box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de clear box para el álbum principal</h4>
                      <p>Precio por clear box $ <span id="precioClearBoxPrincipal"><?php if($material == 1){ echo $precioPorClearBoxPrincipalProPiel ; } else if($material == 2){ echo $precioPorClearBoxPrincipalPiel ; } else if($material == 3){echo 'S/N';} else {echo $precioPorClearBoxPrincipalProPiel ;} ?></span></h5></p>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="clearBoxPrincipal">
                                  <option>0</option>
                                  <option selected>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                              </select>
                          </div>
                      </div> 

                      

                         
                               
                      <div class="<?php  if($numAlbumesSecundario == 0){ echo "hidden"; }?>">
                          <hr>
                          <h4>Cantidad de clear box para el álbum extra</h4>
                          <p>Precio por clear box    $<span id="precioClearBoxSecundario"><?php if($material == 1){ echo $precioPorClearBoxSecundarioProPiel ; } else if($material == 2){ echo $precioPorClearBoxSecundarioPiel ; } else if($material == 3){echo 'S/N';} else {echo $precioPorClearBoxSecundarioProPiel ;} ?></span></h5></p>
                          <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                  <select class="form-control" id="clearBoxSecundario">
                                      <option selected>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                  </select>
                              </div>
                          </div>
                      </div>    
                             
                          
                   

                      <br>
                      <div id="errorNumClearBox"></div>           
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" id="cantidadClearBox">Guardar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalMaterialClearBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Material</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Tipo de material</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="materialClearBox">
                                  <option value="1">Pro piel</option>
                                  <option value="2" class="hidden"> Piel</option>
                                  <option value="3" class="hidden"> Amazing skin</option>
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnMaterialClearBox">Guardar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalColorProPielClearBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de pro piel para el clear box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              

                      <div class="row">


                          <?php

                              $stm = $boot->db->prepare('SELECT * FROM cajaalbumes WHERE IdPaso = 80');
                              $stm->execute();

                              $coloresDeProPiel = $stm->fetchAll(PDO::FETCH_ASSOC);

                              foreach ($coloresDeProPiel as $colorPorPiel) {
                                  
                                  ?>

                                      <div class="col-md-3 cajaColor">

                                          <img onClick="elegirColorProPielClearBox(<?= $colorPorPiel['Valor'] ?>);" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/ProPiel/<?= $colorPorPiel['Valor'] ?>.png" alt="..." class="img-thumbnail">
                                          <p style="margin-top:.3em;"><?= $colorPorPiel['NombreOpcionCaja'] ?></p>
                                      

                                      </div>


                                  <?php
                              }



                          ?>



                          
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalPortadaFotoBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Foto Box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Que portada usar?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="portadaAUsarFotoBox">
                                <option value="1">Utilizar la misma portada del album</option>
                                <option  value="2">Subir una foto nueva</option>
                               
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="btnFotoBoxTipoDePortada">Continuar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalAgregarFotoInteriorFotoBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Foto interna</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Deseas agregar una foto para la parte interna del foto box?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="agregarFotoInternaFotoBox">
                                <option value="1">No</option>
                                <option  value="2">Si</option>
                               
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal" id="btnFotoInternaFotoBox">Continuar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalAgregarTextoEnLomoFotoBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Texto</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Desea agregar texto en el lomo del foto box?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="agregarTextoFotoBox">
                                <option value="1">No</option>
                                <option  value="2">Si</option>
                               
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTextoEnLomoFotoBox">Continuar</button>
                  </div>
              </div>
          </div>
      </div>      

      <div class="modal fade" id="modalPreguntaFotoBoxConContraPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Foto en contra portada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Deseas agregar una foto para la contra portada?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="agregarFotoEnContraPortadaDeFotoBox">
                                <option value="1">No</option>
                                <option  value="2">Si</option>
                               
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal" id="btnAgregarFotoEnContraPortadaDeFotoBox">Continuar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCantidadDeFotoBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Foto box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de foto box para el álbum principal</h4>
                      <p>Precio por foto box $ <span id="precioFotoBoxPrincipal"><?php echo $precioPorFotoBoxPrincipal  ?></span></h5></p>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="fotoBoxPrincipal">
                                  <option>0</option>
                                  <option selected>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                              </select>
                          </div>
                      </div> 

                      

                         
                               
                      <div class="<?php  if($numAlbumesSecundario == 0){ echo "hidden"; }?>">
                          <hr>
                          <h4>Cantidad de foto box para el álbum extra</h4>
                          <p>Precio por foto box secudnario   $<span id="precioFotoBoxSecundario"><?php echo $precioPorFotoBoxSecundario  ?></span></h5></p>
                          <div class="row">
                              <div class="col-md-6 col-md-offset-3">
                                  <select class="form-control" id="fotoBoxSecundario">
                                      <option selected>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                  </select>
                              </div>
                          </div>
                      </div>    
                             
                          
                   

                      <br>
                      <div id="errorNumFotoBox"></div>           
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="cantidadDeFotoBox">Continuar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade  bs-example-modal-lg" id="modalFotoBoxSubidorPortada"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Agregar imagen </h4>
                  </div>
            
                  <div class="modal-body" id="cajaFotoBoxSubidorPortada">
              
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btnContinuarSubidor btn btn-primary" id="continuarSubidorDePortadaFotoBox" disabled="disabled">Continuar </button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalCropPortadaFotoBox" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Recorte la imagen de la  portada</h4>
                  
                  </div>

                  <div class="modal-body" id="imgCropPortadaFotoBox">
                  
                    
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" data-dismiss="modal" class="btn btn-primary recorteCropPortadaFotoBox" >Continuar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalPreguntaSiDeseanContraPortadaFotoBox" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Aviso</h4>
                  
                  </div>

                  <div class="modal-body" >
                      
                      <p>Deseas agregar foto para la contra portada del foto box</p>
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="respuestaSubirContraPortadaFotoEstuche(2)">Si</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="respuestaSubirContraPortadaFotoEstuche(1)">No</button>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="modal fade  bs-example-modal-lg" id="modalFotoBoxSubidorInterior"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Agregar imagen </h4>
                  </div>
            
                  <div class="modal-body" id="cajaFotoBoxSubidorInterior">
              
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btnContinuarSubidor btn btn-primary" id="continuarSubidorDeInteriorFotoBox" disabled="disabled">Continuar </button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCropInteriorFotoBox" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Recorte la imagen del  interior</h4>
                  
                  </div>

                  <div class="modal-body" id="imgCropInteriorFotoBox">
                  
                    
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" data-dismiss="modal" class="btn btn-primary recorteCropInteriorFotoBox" >Continuar</button>
                  </div>
              </div>
          </div>
      </div>
  

      <div class="modal fade" id="modalTipoDeTipografiaYColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tipografia</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija la tipografia a usar en el lomo del foto box?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="tipoGrafia">
                                <option value="1">Cuerva</option>
                                <option  value="2">Clásica</option>
                               
                              </select>
                          </div>
                      </div>

                      <h4>Color de texto?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="colorDeTexto">
                                  <option value="1">A criterio del diseñador</option>
                                  <option value="2">L0001</option>
                                  <option value="3">L0002</option>
                                  <option value="4">L0003</option>
                                  <option value="5">L0004</option>
                                  <option value="6">L0005</option>
                                  <option value="7">L0006</option>
                                  <option value="8">L0007</option>
                                  <option value="9">L0008</option>
                                  <option value="10">L0009</option>
                                  <option value="11">L0010</option> 
                              </select>
                          </div>
                      </div>



                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTipografiaYColor">Continuar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTextoFechaYLineas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Opciones de lomo</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label for="textoDeGrabado" class="col-sm-4 control-label">Texto</label>
                              <div class="col-sm-8">
                                  <textarea class="form-control" rows="3" id="textoDeGrabado"></textarea>
                              </div>
                          </div>
                         
                      </div>

                      <div class="form-horizontal">
                          
                          <div class="form-group">
                              <label for="fechaDeGrabado" class="col-sm-4 control-label">Fecha</label>
                              <div class="col-sm-8">
                                  <div class="input-group date" data-provide="fechaDeGrabado">
                                          <input type="text" class="fechaDeGrabado datepicker form-control">
                                          <div class="input-group-addon">
                                              <span class="glyphicon glyphicon-th"></span>
                                          </div>
                                      </div>
                              </div>
                          </div>
                         
                      </div>


                      <div class="form-horizontal">
                          <div class="form-group">
                              <label for="lineasParaOcupar" class="col-sm-4 control-label">Cantidad de líneas para ocupar</label>
                              <div class="col-sm-8">
                                 <select id="lineasParaOcupar" class="form-control">

                                      <option>1</option>
                                      <option>2</option>
                                 </select>
                              </div>
                          </div>
                         
                      </div>
                  

                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary "   id="btnTextoFechaYLineas">Continuar</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalColorFotoBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color del foto box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              

                      <div class="row">


                          <?php

                              $stm = $boot->db->prepare('SELECT * FROM cajaalbumes WHERE IdPaso = 80');
                              $stm->execute();

                              $coloresDeProPiel = $stm->fetchAll(PDO::FETCH_ASSOC);

                              foreach ($coloresDeProPiel as $colorPorPiel) {
                                  
                                  ?>

                                      <div class="col-md-3 cajaColor">

                                          <img onClick="elegirColorFotoBox(<?= $colorPorPiel['Valor'] ?>);" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/ProPiel/<?= $colorPorPiel['Valor'] ?>.png" alt="..." class="img-thumbnail">
                                          <p style="margin-top:.3em;"><?= $colorPorPiel['NombreOpcionCaja'] ?></p>
                                      

                                      </div>


                                  <?php
                              }



                          ?>



                          
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade  bs-example-modal-lg" id="modalFotoBoxSubidorContraPortada"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Agregar imagen </h4>
                  </div>
            
                  <div class="modal-body" id="cajaFotoBoxSubidorContraPortada">
              
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btnContinuarSubidor btn btn-primary" id="continuarSubidorDeContraPortadaFotoBox" disabled="disabled">Continuar </button>
                  </div>
              </div>
          </div>
      </div>



      <div class="modal fade" id="modalCropContraPortadaFotoBox" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Recorte la imagen de la contra portada</h4>
                  
                  </div>

                  <div class="modal-body" id="imgCropContraPortadaFotoBox">
                  
                    
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" data-dismiss="modal" class="btn btn-primary recorteCropContraPortadaFotoBox" >Continuar</button>
                  </div>
              </div>
          </div>
      </div>
  

      <div class="modal fade" id="modalPreguntaSiDeseanCharolasDeDvd" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Aviso</h4>
                  
                  </div>

                  <div class="modal-body" >
                      
                      <p>Deseas agregar charolas de dvd para el  foto box</p>
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="respuestaCharolasDeDvd(1)">Si</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="respuestaCharolasDeDvd(0)">No</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalCharolasParaDvd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Charola para dvd</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de charolas para dvd?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="charolasParaDvd">
                                  <option >1</option>

                                  <?php

                                      

                                      if($alto>=14){

                                          ?>
                                              <option >2</option>
                                          <?php

                                      }

                                      if($alto>= 15){


                                          ?>

                                              <option >3</option>
                                              <option >4</option>

                                          <?php

                                      }


                                  ?>
                               
                                
                               
                              </select>
                              <hr>
                              <p class="text-center"> Precio por charola $ <?= $precioPorCharola ?></p>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal" id="btnCharolasParaDvd">Continuar</button>
                  </div>
              </div>
          </div>
      </div>


          
      <div class="modal fade" id="modalPreguntaSiDeseanCharolasDeDvdProBox" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                 
                      <h4 class="modal-title" id="modalLabel">Aviso</h4>
                  
                  </div>

                  <div class="modal-body" >
                      
                        <p>Deseas agregar charolas de dvd para el  pro box</p>
                  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="respuestaCharolasDeDvdProBox(1)">Si</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="respuestaCharolasDeDvdProBox(0)">No</button>
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalCharolasParaDvdProBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Charola para dvd</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Cantidad de charolas para dvd?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="charolasParaDvdProBox">
                                  <option >1</option>

                                  <?php

                                      

                                      if($alto>=14){

                                          ?>
                                              <option >2</option>
                                          <?php

                                      }

                                      if($alto>= 15){


                                          ?>

                                              <option >3</option>
                                              <option >4</option>

                                          <?php

                                      }


                                  ?>
                               
                                
                               
                              </select>
                              <hr>
                              <p class="text-center"> Precio por charola $ <?= $precioPorCharola ?></p>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal" id="btnCharolasParaDvdProBox">Continuar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalAreaDeGrabado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Area de Grabado</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Donde quiere colocar el grabado?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <label class="checkbox-inline areaPortada"><input id="areaPortada" name="areaPortada" type="checkbox" value="1">Portada</label>
                              <label class="checkbox-inline areaLomo"><input id="areaLomo" name="areaLomo" type="checkbox" value="2">Lomo</label>
                              <label class="checkbox-inline areaContraportada"><input id="areaContraportada" name="areaContraportada" type="checkbox" value="3">Parte de atrás</label>  
                          </div>
                      </div>
                  </div> 

                  <hr>
                  <p class="text-center"><i class="fa fa-chevron-circle-right"></i> Puede elegir mas de un grabado.</p>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="btnAreaDeGrabado">Guardar</button>                        
                  </div>
              </div>
          </div>
      </div>

      <!--- Modales Grabado en Portada -->

      <div class="modal fade" id="modalPosicionGrabadoPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Grabado en Portada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija la posición del grabado.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="posicionGrabadoPortada"> 
                                  <option value="1">Superior izquierdo</option>
                                  <option value="2">Superior centro</option>
                                  <option value="3">Superior derecho</option>
                                  <option value="4">Centro izquierdo</option>
                                  <option value="5">Centro centralizado</option>
                                  <option value="6">Centro derecho</option>
                                  <option value="7">Inferior izquierdo</option>
                                  <option value="8">Inferior centro</option>
                                  <option value="9">Inferior derecho</option>                                   
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnPosicionGrabadoPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCantidadLineasPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Lineas en Portada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elige cantidad de lineas de grabado.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="cantidadLineasPortada"> 
                                  <option value="1">Una linea</option> 
                                  <option value="2">Dos lineas</option>
                                  <option value="3">Tres lineas</option>                                 
                              </select>
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnCantidadLineasPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipografiaEnPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tipografia en Portada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija la tipografia.</h4>                        
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="tipografiaEnPortada"> 
                                  <?php 
                                  foreach ($resTipografiasDeGrabado as $tiposDeLetra) {
                                      echo '<option value="'.$tiposDeLetra['idTipografiaDeGrabado'].'">'.$tiposDeLetra['nombreTipografiaDeGrabado'].'</option>';    
                                  }
                                  ?>                                                                                                          
                              </select>
                          </div>
                      </div>
                      <a onclick="muestrarioDeLetras('modalTipografiaEnPortada');" style="color:#e50e0b;" href="#"><i class="fa fa-file-text-o"></i> Ver muestrario</a> | <a style="color:#e50e0b;" href="//www.mi-album.com/pdf/Tipografias%20de%20grabados%20en%20bajo%20relieve.pdf" target="_blank" download><i class="fa fa-arrow-circle-down"></i> Descargar PDF</a>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTipografiaEnPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipoDeGrabadoEnPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tipo de grabado en Portada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija un tipo.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="tipoDeGrabadoEnPortada"> 
                                  <option value="1">Bajo Relieve</option> 
                                  <!--<option value="2">Dorado</option>
                                  <option value="3">Plateado</option>-->                                 
                              </select>
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTipoDeGrabadoEnPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTextoPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Texto de grabado en Portada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Escriba el texto que desea grabar:</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                             <div class="form-group">                                   
                                  <label for="usr" class="textoPortada">Linea 1:</label>                                 
                                  <input type="text" class="form-control textoPortada" id="textoPortada">
                                  <label for="usr" class="textoPortadaDos">Linea 2:</label>
                                  <input type="text" class="form-control textoPortadaDos" id="textoPortadaDos">
                                  <label for="usr" class="textoPortadaTres">Linea 3:</label>
                                  <input type="text" class="form-control textoPortadaTres" id="textoPortadaTres">                                
                                  <label for="usr" id="errorMsgPortada"></label>
                              </div>

                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="btnTextoPortada">Siguiente</button>                       
                  </div>
              </div>
          </div>
      </div>

      <!--- Modales Grabado en Lomo -->

      <div class="modal fade" id="modalPosicionGrabadoLomo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Grabado en Lomo</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija la posición del grabado.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="posicionGrabadoLomo"> 
                                  <option value="1">Superior</option>
                                  <option value="2">Medio</option>
                                  <option value="3">Inferior</option>                                  
                              </select>
                          </div>
                      </div>
                  </div> 
                                          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnPosicionGrabadoLomo">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCantidadLineasLomo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Lineas en Lomo</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elige cantidad de lineas de grabado.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="cantidadLineasLomo"> 
                                  <option value="1">Una linea</option>                                                                    
                              </select>
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnCantidadLineasLomo">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipografiaEnLomo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tipografia en Lomo</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija la tipografia.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="tipografiaEnLomo"> 
                                  <?php 
                                  foreach ($resTipografiasDeGrabado as $tiposDeLetra) {
                                      echo '<option value="'.$tiposDeLetra['idTipografiaDeGrabado'].'">'.$tiposDeLetra['nombreTipografiaDeGrabado'].'</option>';    
                                  }
                                  ?>                                
                              </select>
                          </div>
                      </div>
                      <a onclick="muestrarioDeLetras('modalTipografiaEnLomo');" style="color:#e50e0b;" href="#"><i class="fa fa-file-text-o"></i> Ver muestrario</a> | <a style="color:#e50e0b;" href="//www.mi-album.com/pdf/Tipografias%20de%20grabados%20en%20bajo%20relieve.pdf" target="_blank" download><i class="fa fa-arrow-circle-down"></i> Descargar PDF</a>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTipografiaEnLomo">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipoDeGrabadoEnLomo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tipo de grabado en Lomo</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija un tipo.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="tipoDeGrabadoEnLomo"> 
                                  <option value="1">Bajo Relieve</option> 
                                  <!--<option value="2">Dorado</option>
                                  <option value="3">Plateado</option>-->                                 
                              </select>
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTipoDeGrabadoEnLomo">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTextoLomo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Texto de grabado en Lomo</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Escriba el texto que desea grabar:</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                             <div class="form-group"> 
                                <label for="usr" class="textoLomo">Linea 1:</label>                                 
                                <input type="text" class="form-control textoLomo" id="textoLomo"> 
                                <label for="usr" id="errorMsgLomo"></label>
                              </div> 
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="btnTextoLomo">Siguiente</button>                        
                  </div>
              </div>
          </div>
      </div>

       <!--- Modales Grabado en Contra Portada -->

      <div class="modal fade" id="modalPosicionGrabadoContraPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Grabado en contraportada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija la posición del grabado.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="posicionGrabadoContraPortada"> 
                                  <option value="1">Superior izquierdo</option>
                                  <option value="2">Superior centro</option>
                                  <option value="3">Superior derecho</option>
                                  <option value="4">Centro izquierdo</option>
                                  <option value="5">Centro centralizado</option>
                                  <option value="6">Centro derecho</option>
                                  <option value="7">Inferior izquierdo</option>
                                  <option value="8">Inferior centro</option>
                                  <option value="9">Inferior derecho</option>                                   
                              </select>
                          </div>
                      </div>
                  </div> 

                              
          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnPosicionGrabadoContraPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCantidadLineasContraPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Lineas en contraportada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elige cantidad de lineas de grabado.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="cantidadLineasContraPortada"> 
                                  <option value="1">Una linea</option> 
                                  <option value="2">Dos lineas</option>
                                  <option value="3">Tres lineas</option>                                 
                              </select>
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnCantidadLineasContraPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipografiaEnContraPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tipografia en contraportada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija la tipografia.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="tipografiaEnContraPortada"> 
                                  <?php 
                                  foreach ($resTipografiasDeGrabado as $tiposDeLetra) {
                                      echo '<option value="'.$tiposDeLetra['idTipografiaDeGrabado'].'">'.$tiposDeLetra['nombreTipografiaDeGrabado'].'</option>';    
                                  }
                                  ?>                                
                              </select>
                          </div>
                      </div>
                      <a onclick="muestrarioDeLetras('modalTipografiaEnContraPortada');" style="color:#e50e0b;" href="#"><i class="fa fa-file-text-o"></i> Ver muestrario</a> | <a style="color:#e50e0b;" href="//www.mi-album.com/pdf/Tipografias%20de%20grabados%20en%20bajo%20relieve.pdf" target="_blank" download><i class="fa fa-arrow-circle-down"></i> Descargar PDF</a>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTipografiaEnContraPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTipoDeGrabadoEnContraPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tipo de grabado en contraportada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Elija un tipo.</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <select class="form-control" id="tipoDeGrabadoEnContraPortada"> 
                                  <option value="1">Bajo Relieve</option> 
                                  <!--<option value="2">Dorado</option>
                                  <option value="3">Plateado</option>-->                                 
                              </select>
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " data-dismiss="modal"  id="btnTipoDeGrabadoEnContraPortada">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalTextoContraPortada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Texto de grabado en contraportada</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>Escriba el texto que desea grabar:</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                             <div class="form-group"> 
                                <label for="usr" class="textoContraPortada">Linea 1:</label>                                 
                                <input type="text" class="form-control textoContraPortada" id="textoContraPortada">
                                <label for="usr" class="textoContraPortadaDos">Linea 2:</label>
                                <input type="text" class="form-control textoContraPortadaDos" id="textoContraPortadaDos">
                                <label for="usr" class="textoContraPortadaTres">Linea 3:</label>
                                <input type="text" class="form-control textoContraPortadaTres" id="textoContraPortadaTres">
                                <label for="usr" id="errorMsgContraPortada"></label>
                              </div> 
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " id="btnTextoContraPortada">Siguiente</button>                        
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalRepetirGrabado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Confirmacion de replica</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>¿Desea añadir grabado a sus albums adicionales?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">
                              <div class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn btn-default" onclick="opcionReplicaGrabado(1);">Si</button>
                                <button type="button" class="btn btn-default" onclick="opcionReplicaGrabado(0);">No</button>                                  
                              </div>
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">

                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalCantidadReplicaDeGrabado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Cantidad de copias a grabar</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <h4>¿A cuantas copias desea añadir el grabado?</h4>
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">                                
                              <select class="form-control" id="cantidadReplicaDeGrabado"> 
                                  <option value="0"><?php echo 'Grabar en todas ('.$numAlbumesSecundario; ?>)</option> 
                                  <?php
                                      for ($i=1; $i< $numAlbumesSecundario; $i++) { 
                                          echo '<option value='.$i.'>Grabar en '.$i.'</option>';       
                                      }
                                  ?>                                 
                              </select>                            
                          </div>
                      </div>
                  </div> 

                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary " onclick="cantidadDeGrabadosReplicados();">Guardar</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalColorListonCajaDeLux" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de listón de Caja de lux</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <div class="row">

                          <div class="row">
                                  <div class="span12">                                        
                                      <div id="tab" class="btn-group" data-toggle="buttons-radio">
                                        <a href="#condisenoCajaDeLux" class="btn text-danger" data-toggle="tab">Colores con diseño</a>
                                        <a href="#lisosCajaDeLux" class="btn text-danger" data-toggle="tab">Colores lisos</a>
                                      </div>
                                      
                                      <div style="margin-top:1em;" class="tab-content">                                          
                                        <div class="tab-pane active" id="condisenoCajaDeLux">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_condiseno');
                                              $stm->execute();

                                              $coloresConDiseno = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresConDiseno as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarCajaDeLux('D<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/2/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                         

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                        <div class="tab-pane" id="lisosCajaDeLux">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_lisos');
                                              $stm->execute();

                                              $coloresLisos = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresLisos as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarCajaDeLux('L<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/1/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                        

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                      </div>
                                  </div>        
                          </div>
                          
                      </div>
                  </div> 
                                          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalColorListonCajaArtistica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de listón de Caja artistica</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <div class="row">

                          <div class="row">
                                  <div class="span12">                                        
                                      <div id="tab" class="btn-group" data-toggle="buttons-radio">
                                        <a href="#condisenoCajaArtistica" class="btn text-danger" data-toggle="tab">Colores con diseño</a>
                                        <a href="#lisosCajaArtistica" class="btn text-danger" data-toggle="tab">Colores lisos</a>
                                      </div>
                                      
                                      <div style="margin-top:1em;" class="tab-content">                                          
                                        <div class="tab-pane active" id="condisenoCajaArtistica">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_condiseno');
                                              $stm->execute();

                                              $coloresConDiseno = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresConDiseno as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarCajaArtistica('D<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/2/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                        

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                        <div class="tab-pane" id="lisosCajaArtistica">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_lisos');
                                              $stm->execute();

                                              $coloresLisos = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresLisos as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarCajaArtistica('L<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/1/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                         

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                      </div>
                                  </div>        
                          </div>
                          
                      </div>
                  </div> 
                                          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>
      
      <div class="modal fade" id="modalColorListonProBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de listón del Pro box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <div class="row">

                          <div class="row">
                                  <div class="span12">                                        
                                      <div id="tab" class="btn-group" data-toggle="buttons-radio">
                                        <a href="#condisenoProBox" class="btn text-danger" data-toggle="tab">Colores con diseño</a>
                                        <a href="#lisosProBox" class="btn text-danger" data-toggle="tab">Colores lisos</a>
                                      </div>
                                      
                                      <div style="margin-top:1em;" class="tab-content">                                          
                                        <div class="tab-pane active" id="condisenoProBox">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_condiseno');
                                              $stm->execute();

                                              $coloresConDiseno = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresConDiseno as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarProBox('D<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/2/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                      

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                        <div class="tab-pane" id="lisosProBox">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_lisos');
                                              $stm->execute();

                                              $coloresLisos = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresLisos as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarProBox('L<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/1/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                       

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                      </div>
                                  </div>        
                          </div>
                          
                      </div>
                  </div> 
                                          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalColorListonClearBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de listón del Clear box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <div class="row">

                          <div class="row">
                                  <div class="span12">                                        
                                      <div id="tab" class="btn-group" data-toggle="buttons-radio">
                                        <a href="#condisenoClearBox" class="btn text-danger" data-toggle="tab">Colores con diseño</a>
                                        <a href="#lisosClearBox" class="btn text-danger" data-toggle="tab">Colores lisos</a>
                                      </div>
                                      
                                      <div style="margin-top:1em;" class="tab-content">                                          
                                        <div class="tab-pane active" id="condisenoClearBox">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_condiseno');
                                              $stm->execute();

                                              $coloresConDiseno = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresConDiseno as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarClearBox('D<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/2/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                       

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                        <div class="tab-pane" id="lisosClearBox">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_lisos');
                                              $stm->execute();

                                              $coloresLisos = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresLisos as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarClearBox('L<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/1/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                         
                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                      </div>
                                  </div>        
                          </div>
                          
                      </div>
                  </div> 
                                          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="modalColorListonFotoBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Elegir color de listón del Foto box</h4>
                  </div>
            
                  <div class="modal-body text-center">
              
                      <div class="row">
                                                      
                          <div class="row">
                                  <div class="span12">                                        
                                      <div id="tab" class="btn-group" data-toggle="buttons-radio">
                                        <a href="#condisenoFotoBox" class="btn text-danger" data-toggle="tab">Colores con diseño</a>
                                        <a href="#lisosFotoBox" class="btn text-danger" data-toggle="tab">Colores lisos</a>
                                      </div>
                                      
                                      <div style="margin-top:1em;" class="tab-content">                                          
                                        <div class="tab-pane active" id="condisenoFotoBox">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_condiseno');
                                              $stm->execute();

                                              $coloresConDiseno = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresConDiseno as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarFotoBox('D<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/2/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                         

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                        <div class="tab-pane" id="lisosFotoBox">
                                          <?php

                                              $stm = $boot->db->prepare('SELECT * FROM coloresliston_lisos');
                                              $stm->execute();

                                              $coloresLisos = $stm->fetchAll(PDO::FETCH_ASSOC);

                                              foreach ($coloresLisos as $color) {
                                                  
                                                  ?>
                                                      <div class="col-md-3 cajaColor">

                                                          <img onClick="guardarFotoBox('L<?= $color['idColorListon'] ?>');" src="/imagenes/<?= $boot->socioGenerico?>/albums/albumes/liston/1/<?= $color['idColorListon'] ?>.png" alt="..." class="img-thumbnail">
                                                       

                                                      </div>

                                                  <?php
                                              }

                                          ?>
                                        </div>
                                      </div>
                                  </div>        
                          </div>

                      </div>
                  </div> 
                                          
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                 
                  </div>
              </div>
          </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalMuestrarioDeLetras" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button onclick="verOpcionTipografia('modalTipografiaEnPortada');" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">Tipografias disponibles.</h4> 
            </div>
            <div class="modal-body">
              <div style="text-align: center;">
                  <iframe src="//docs.google.com/gview?url=https://www.mi-album.com/pdf/Tipografias%20de%20grabados%20en%20bajo%20relieve.pdf&embedded=true" style="width:500px; height:500px;" frameborder="0"></iframe>
              </div>
            </div>
            <div class="modal-footer">
              <button onclick="verOpcionTipografia('modalTipografiaEnPortada');" type="button" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-chico fade" id="ModalGuardando" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <div class="text-center">
                  <i  class="fa fa-cog  fa-5x fa-spin"></i>
                  <h4 class="h4-modal-chico">Guardando...</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

     
      <script src="/js/cropper.min.js"></script>
      <script src="/js/moments.js"></script>
      <script src="/js/bootstrap-datetimepicker.js"></script>
                
      <script type="text/javascript">
          $(document).ready(function() {
            $('.fechaDeGrabado').datetimepicker({
              format: 'dd/mm/yyyy'
            });
          });
          var socio = <?= $boot->socio ?>;
          
          var replicarGrabado = 0;
          var cantidadReplicaDeGrabado = 0;
          var checkPortada = 0;
          var posicionPortada = 0;                        
          var cantidadLineasPortada = 0; 
          var tipografiaEnPortada = 0;  
          var tipoDeGrabadoEnPortada = 0;                                       
          var textoPortada = "";
          var textoPortadaDos = "";
          var textoPortadaTres = "";
          var checkLomo = 0;
          var posicionLomo = 0;                        
          var cantidadLineasLomo = 0;
          var tipografiaEnLomo = 0;
          var tipoDeGrabadoEnLomo = 0;                                          
          var textoLomo = "";
          var checkContraPortada = 0;
          var posicionContraPortada = 0;                        
          var cantidadLineasContraPortada = 0; 
          var tipografiaEnContraPortada = 0;  
          var tipoDeGrabadoEnContraPortada = 0;                                       
          var textoContraPortada = "";
          var textoContraPortadaDos = "";
          var textoContraPortadaTres = "";
          var tipoDeFotoEstuche = 1;
          var tipoDeSubidaContraPortadaParaFotoEstuche = 1;
          var material = <?= $material ?>;
          var materialAUsar = 1 ;
          var proPiel = <?= $proPiel ?>;
          var piel = <?= $piel ?>;
          var tipoDeFotoBox = 1;
          var tipoSubidaPortadaFotoBox = 1;
          var tipoDeSubidaContraPortadaFotoBox = 1;

         
          var agregarTextoFotoBox = 1;

          var tipoGrafia = 0;
          var colorDeTexto = 0;

          var colorFotoBox = 0;

          var agregarCharolasParaFotoBox = 0;
          var agregarCharolasParaProBox = 0;

          var modalActivo = "";

          $(function(){

              var empastado = [];
              empastado.push(4);
              empastado.push(5);
              empastado.push(6);
              empastado.push(8);
              empastado.push(9);
              empastado.push(12);
              empastado.push(14);
              empastado.push(17);

              //alert($.inArray(<?= $empastado ?>, empastado));

              if ($.inArray(<?= $empastado ?>, empastado) < 0) {
                 $('#btnGrabado').hide();
                //alert(<?= $empastado ?>+' not found');
              }
              else {
                //alert(<?= $empastado ?>+' found');
              }



              var alto = <?= $alto ?>;
              var ancho = <?= $ancho ?>;
              
              $('div.product-chooser').not('.disabled').find('div.product-chooser-item').on('click', function(){
                  $(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
                  $(this).addClass('selected');
                  $(this).find('input[type="radio"]').prop("checked", true);
                  
              });
              
             
          });

          function muestrarioDeLetras(modal){

              modalActivo = modal;

              $("#"+modal+"").modal('hide');

              $("#modalMuestrarioDeLetras").modal({          
                "keyboard"  : false,
                "show"      : true,
                "backdrop": 'static'       
              }); 

          }

          function verOpcionTipografia(){
              $('#modalMuestrarioDeLetras').modal('hide');

              $("#"+modalActivo+"").modal({          
                "keyboard"  : true,
                "show"      : true,
                "backdrop": 'static'       
              });   
          }

          $('#btnContinuarCantidadDeFotoBox').click(function(){

              if($('#fotoBoxPrincipal').val()== 0 && $('#fotoBoxSecundario').val() == 0){

                  $('<div  class="alert alert-error">Debe elegir por lo menos un foto box</div>').appendTo($('#errorNumFotoBox')).fadeIn(300).delay(3000).fadeOut(500);

              }
              else{

                  $('#modalCantidadDeFotoBox').modal('hide');

                  $('#modalPreguntaSiDeseanCharolasDeDvd').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }



          });


          function respuestaCharolasDeDvd(respuesta){

              if(respuesta == 1){

              
                  $('#modalPreguntaSiDeseanCharolasDeDvd').modal('hide');

                  $('#modalCharolasParaDvd').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });

                  agregarCharolasParaFotoBox = 1;

              }
              else{
                  agregarCharolasParaFotoBox = 0;
                  guardarFotoBox();

              }


          }



          $('#btnCharolasParaDvd').click(function(){


              guardarFotoBox();  
             



          });
          

          $('#btnClearBox').click(function(){


              switch(<?= $empastado ?>){

                  
                  case 6:
                  case 4:
                  case 5:
                  case 8:
                  case 9:
                  case 10:
                  case 11:
                  case 12:
                  case 13:
                  case 14:
                  case 15:
                  case 16:
                  case 17:
                  case 18:
                  case 19:

                      

                      $('#modalTipoMaterialClearBox').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });

                      


                  break;

                  case 1:
                  case 3:

                      $('#modalMaterialClearBox').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });


                  break;


              }
          


          });


          $('#btnMaterialAUsarClearBox').click(function(){
              

              var materialAUsarClearBox = $('#materialAUsarClearBox').val();

              if(materialAUsarClearBox == 1){

                  material = <?= $material ?>;
                  $('#modalCantidadDeClearBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });

              }
              else{

                 
                  $('#modalMaterialClearBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }


          });


          $('#cantidadClearBox').click(function(){

              $('#modalCantidadDeClearBox').modal('hide');

              $('#modalColorListonClearBox').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });
            
          });

          function guardarClearBox(idColor){

             $('#modalColorListonClearBox').modal('hide');

              if($('#clearBoxPrincipal').val()== 0 && $('#clearBoxSecundario').val() == 0){

                  $('<div  class="alert alert-error">Debe elegir por lo menos un clear box</div>').appendTo($('#errorNumClearBox')).fadeIn(300).delay(3000).fadeOut(500);

              }
              else{


                  $('#modalCantidadDeClearBox').modal('hide');

                  colorListonClearBox = idColor;                    
            
                  var parametros = {
                      'function':47,
                      'socio':socio,
                      'idPedido':<?= $idPedido ?>,
                      'material':material,
                      'clearBoxPrincipal':$('#clearBoxPrincipal').val(),
                      'clearBoxSecundario':$('#clearBoxSecundario').val(),
                      'alto':<?= $alto ?>,
                      'altoSecundario':<?= $altoSecundario ?>,
                      'piel':piel,
                      'proPiel':proPiel,
                      'numAlbumesSecundario':<?= $numAlbumesSecundario ?>,
                      'colorListonClearBox': colorListonClearBox                       
                  }

                  $.ajax({
            
                    data: parametros,
                    url: '/manejadores/manejadorAlbums.php',
                    type: 'post',
                    dataType: "JSON",
                    
                      success: function(data){
                             
                          if(data.status === 'success'){
                              swal({
                                  title: "Guardado",
                                  text: "Se agrego el accesorio clear box!",
                                  type: "success",
                                  showCancelButton: true,
                                  confirmButtonClass: 'btn-success',
                                  confirmButtonId: 'especial',
                                  cancelButtonText: "Agregar otro accesorio",
                                  confirmButtonText: "Continuar",

                              },
                              function(isConfirm){
                                  if (isConfirm) {
                                      guardar();
                                  } 
                                  else{

                                     
                                      if($('#clearBoxPrincipal').val() != 0){


                                          var clearBoxPrincipal = $('#clearBoxPrincipal').val();
                                          var precioClearBoxPrincipal =  $('#precioClearBoxPrincipal').text();
                                         

                                          var listado =   '<a href="#" class="list-group-item clearfix" id="liClearBoxPrincipal">'+
                                                              'Clear box  para álbum principal'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+clearBoxPrincipal+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioClearBoxPrincipal*clearBoxPrincipal)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarClearBoxPrincipal();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liClearBoxPrincipal').remove();               

                                          $('#listaDeAccesoriosPedidos').append(listado);

                                      }
                                      if($('#clearBoxSecundario').val() != 0){


                                          var clearBoxSecundario = $('#clearBoxSecundario').val();
                                          var precioClearBoxSecundario =  $('#precioClearBoxSecundario').text();

                                          var listado = ' <a href="#" class="list-group-item clearfix" id="liClearBoxSecundario">'+
                                                              'Pro box para álbum extra'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+clearBoxSecundario+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioClearBoxSecundario*clearBoxSecundario)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarClearBoxSecundario();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liClearBoxSecundario').remove();                              

                                          $('#listaDeAccesoriosPedidos').append(listado);
                                  


                                      }
              

                                     
                                     
                                  

                                  }

                                 
                              });
                          }
                          else{

                              alert('upss!! Existe un error en el sistema')
                          }
                      },

                      error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                      }
                    
                  });

              }

          }


          function eliminarClearBoxPrincipal(){

              swal({
                title: "Estas seguro",
                text: "Se eliminaran los pro box  del album principal  de este  pedido!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':48,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los clear box  del album principal fueron eliminados.", "success"); 
                                  $('#liClearBoxPrincipal').remove();
                              }
                              else{

                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Tu clear box sigue guardado en tu pedido :)", "error");

                  } 

                 
              });
          }


          $('#btnEliminarClearBoxPrincipal').click(function(){
              eliminarClearBoxPrincipal();
          });



          function eliminarClearBoxSecundario(){

             
              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los clear box  del álbum extra  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':49,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los clear box  del album principal fueron eliminados.", "success"); 
                                  $('#liClearBoxSecundario').remove();
                              }
                              else{

                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Tu clear box sigue guardado en tu pedido :)", "error");

                  } 

                 
              });
          }


          $('#btnEliminarClearBoxSecundario').click(function(){
              eliminarClearBoxSecundario();
          });



          $('#btnMaterialClearBox').click(function(){
              

              var materialClearBox = $('#materialClearBox').val();
              material = materialClearBox;
              if(materialClearBox == 1){
                 
                 
                  $('#modalColorProPielClearBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });

              }
              else{

                 
                  $('#modalColorPielProBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }


          });


          function elegirColorProPielClearBox(idColorProPiel){

             
              $('#modalColorProPielClearBox').modal('hide');
              proPiel = idColorProPiel;

              $('#modalCantidadDeClearBox').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });



          }




          $('#btnProBox').click(function(){


              switch(<?= $empastado ?>){

                  
                  case 6:
                  case 4:
                  case 5:
                  case 8:
                  case 9:
                  case 10:
                  case 11:
                  case 12:
                  case 13:
                  case 14:
                  case 15:
                  case 16:
                  case 17:
                  case 18:
                  case 19:

                      

                      $('#modalTipoMaterialProBox').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });

                      


                  break;

                  case 1:
                  case 3:

                      $('#modalMaterialProBox').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });


                  break;


              }
          


          });




          $('#btnMaterialAUsarProBox').click(function(){
              

              var materialAUarProBox = $('#materialAUsarProBox').val();
             
              if(materialAUarProBox == 1){
                  material = <?= $material ?>;
                  if(<?= $material ?> == 1){

                      $('#modalColorProPielProBox').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });


                  }
                  else if(<?= $material ?> == 2){



                  }
                  
                  

              }
              else{

               
                  $('#modalMaterialProBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }


          });

          $('#btnMaterialProBox').click(function(){

              material = $('#materialProBox').val();


              if(material == 1){

                  $('#modalColorProPielProBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });


              }
              else if(material == 2){


              }

             

          });

          $('#continuarCantidadProBox').click(function(){
             

              if($('#proBoxPrincipal').val()== 0 && $('#proBoxSecundario').val() == 0){

                  $('<div  class="alert alert-error">Debe elegir por lo menos un pro box</div>').appendTo($('#errorNumProBox')).fadeIn(300).delay(3000).fadeOut(500);

              }
             
              else{

                  $('#modalCantidadDeProBox').modal('hide');

                  $('#modalPreguntaSiDeseanCharolasDeDvdProBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });

              }



          });



          function respuestaCharolasDeDvdProBox(respuesta){

              if(respuesta == 1){

              
                  $('#modalPreguntaSiDeseanCharolasDeDvdProBox').modal('hide');

                  $('#modalCharolasParaDvdProBox').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });

                  agregarCharolasParaProBox = 1;

              }
              else{
                  agregarCharolasParaProBox = 0;
                  guardarProBox();

              }


          }


          $('#btnCharolasParaDvdProBox').click(function(){


              guardarProBox();  
             



          });


          $('#cantidadProBox').click(function(){

              $('#modalCantidadDeProBox').modal('hide');

              $('#modalColorListonProBox').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });
            
          });


          function guardarProBox(idColor){

              $('#modalColorListonProBox').modal('hide');

              colorListonProBox = idColor;                
            
              var parametros = {
                  'function':43,
                  'socio':socio,
                  'idPedido':<?= $idPedido ?>,
                  'material':material,
                  'proBoxPrincipal':$('#proBoxPrincipal').val(),
                  'proBoxSecundario':$('#proBoxSecundario').val(),
                  'alto':<?= $alto ?>,
                  'altoSecundario':<?= $altoSecundario ?>,
                  'proPiel':proPiel,
                  'piel':piel,
                  'numAlbumesSecundario':<?= $numAlbumesSecundario ?>,
                  'agregarCharolasProBox':agregarCharolasParaProBox,
                  'cantidadDeCharolasProBox':$('#charolasParaDvdProBox').val(),
                  'colorListonProBox': colorListonProBox                  
              }

              $.ajax({
        
                data: parametros,
                url: '/manejadores/manejadorAlbums.php',
                type: 'post',
                dataType: "JSON",
                
                  success: function(data){
                      
                      if(data.status === 'success'){
                          swal({
                              title: "Guardado",
                              text: "Se agrego el accesorio pro box!",
                              type: "success",
                              showCancelButton: true,
                              confirmButtonClass: 'btn-success',
                              confirmButtonId: 'especial',
                              cancelButtonText: "Agregar otro accesorio",
                              confirmButtonText: "Continuar",

                          },
                          function(isConfirm){
                              if (isConfirm) {
                                  guardar();
                                  
                              
                              } 
                              else{


                                  if($('#proBoxPrincipal').val() != 0){


                                      var proBoxPrincipal = $('#proBoxPrincipal').val();
                                      var precioProBoxPrincipal =  $('#precioProBoxPrincipal').text();

                                      if(material == 2){

                                          precioProBoxPrincipal =  <?= $precioPorProBoxPrincipalProPiel ?>;

                                      }

                                      if(agregarCharolasParaProBox == 1){


                                          var charolasParaDvdProBox = $('#charolasParaDvdProBox').val();
                                          precioProBoxPrincipal = parseInt(precioProBoxPrincipal) + parseInt(charolasParaDvdProBox*<?= $precioPorCharola ?>);
                                      }
                                     

                                      var listado =   '<a href="#" class="list-group-item clearfix" id="liProBoxPrincipal">'+
                                                          'Pro box  para álbum principal'+
                                                          '<span class="pull-right">'+
                                                              '<button class="btn btn-xs btn-info">'+proBoxPrincipal+'</button>'+
                                                              '<button class="btn btn-xs btn-success">$'+(precioProBoxPrincipal*proBoxPrincipal)+'</button>'+
                                                              '<button class="btn btn-xs btn-danger" onClick="eliminarProBoxPrincipal();proBoxPrincipal">'+
                                                                  '<span class="glyphicon glyphicon-trash"></span>'+
                                                              '</button>'+
                                                          '</span>'+
                                                      '</a>';

                                      $('#liProBoxPrincipal').remove();               

                                      $('#listaDeAccesoriosPedidos').append(listado);

                                  }
                                  if($('#proBoxSecundario').val() != 0){


                                      var proBoxSecundario = $('#proBoxSecundario').val();
                                      var precioProBoxSecundario =  $('#precioProBoxSecundario').text();


                                      if(material == 2){

                                          precioProBoxPrincipal =  <?= $precioPorProBoxSecundarioProPiel ?>;

                                      }

                                      var listado = ' <a href="#" class="list-group-item clearfix" id="liProBoxSecundario">'+
                                                          'Pro box para álbum extra'+
                                                          '<span class="pull-right">'+
                                                              '<button class="btn btn-xs btn-info">'+proBoxSecundario+'</button>'+
                                                              '<button class="btn btn-xs btn-success">$'+(precioProBoxSecundario*proBoxSecundario)+'</button>'+
                                                              '<button class="btn btn-xs btn-danger" onClick="eliminarProBoxSecundario();">'+
                                                                  '<span class="glyphicon glyphicon-trash"></span>'+
                                                              '</button>'+
                                                          '</span>'+
                                                      '</a>';

                                      $('#liProBoxSecundario').remove();                              

                                      $('#listaDeAccesoriosPedidos').append(listado);



                                  }


                                 
                                 
                              

                              }

                             
                          });
                      }
                      else{

                          alert('upss!! Existe un error en el sistema')
                      }
                  },

                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                  }
                
              });

          }

        



          function eliminarProBoxPrincipal(){

              swal({
                title: "Estas seguro",
                text: "Se eliminaran los pro box  del album principal  de este  pedido!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':44,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los pro box  del album principal fueron eliminados.", "success"); 
                                  $('#liProBoxPrincipal').remove();
                              }
                              else{

                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Tu pro box sigue guardado en tu pedido :)", "error");

                  } 

                 
              });
          }


          $('#btnEliminarProBoxPrincipal').click(function(){
              eliminarProBoxPrincipal();
          });




          function eliminarProBoxSecundario(){

             
              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los pro box  del álbum extra  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':45,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los pro box  del álbum extra fueron eliminados.", "success"); 
                                  $('#liProBoxSecundario').remove();
                              }
                              else{

                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Su pro box sigue guardado en su pedido :)", "error");

                  } 

                 
              });
          }


          $('#btnEliminarProBoxSecundario').click(function(){
              eliminarProBoxSecundario();
          });


          function elegirColorProPielProBox(idColorProPiel){

             
              $('#modalColorProPielProBox').modal('hide');
              proPiel = idColorProPiel;

              $('#modalCantidadDeProBox').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });



          }




          /*$('#continuarSubidaDePortadaFotoBox').click(function(){
              eliminarProBoxSecundario();
          });*/
          //------------------------CAJA ARTISTICA-----------------------------------------------------//





          $('#btnCajaArtistica').click(function(){


              switch(<?= $empastado ?>){

                  
                  case 6:
                  case 4:
                  case 5:
                  case 8:
                  case 9:
                  case 10:
                  case 11:
                  case 12:
                  case 13:
                  case 14:
                  case 15:
                  case 16:
                  case 17:
                  case 18:
                  case 19:

                      

                      $('#modalTipoMaterialCajaArtistica').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });

                      


                  break;

                  case 1:
                  case 3:

                      $('#modalMaterialCajaDeLux').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });


                  break;


              }
          


          });


          $('#btnMaterialAUsarCajaArtistica').click(function(){
              

              var materialAUarCajaArtistica = $('#materialAUsarCajaArtistica').val();

              if(materialAUarCajaArtistica == 1){

                  material = <?= $material ?>;
                  $('#modalCantidadDeCajaArtistica').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });

              }
              else{

                  $('#modalMaterialCajaArtistica').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }


          });



          $('#btnMaterialCajaArtistica').click(function(){

              var tipoDeMaterial = parseInt($('#materialCajaArtistica').val());

              
              switch(tipoDeMaterial){

                  case 1:
                      material = tipoDeMaterial;
                     //Mostrara colores de pro piel
                      $('#modalColorProPielCajaArtistica').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });
                  break;



              }




          });


          function elegirColorProPielCajaArtistica(idColorProPiel){

             
              $('#modalColorProPielCajaArtistica').modal('hide');
              proPiel = idColorProPiel;

              $('#modalCantidadDeCajaArtistica').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });



          }


          $('#cantidadCajaArtistica').click(function(){

              $('#modalCantidadDeCajaArtistica').modal('hide');

              $('#modalColorListonCajaArtistica').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });
            
          });

          function guardarCajaArtistica(idColor){

              $('#modalColorListonCajaArtistica').modal('hide');

              if($('#cajaArtisticaPrimario').val()== 0 && $('#cajaArtisticaSecundario').val() == 0){

                  $('<div  class="alert alert-error">Debe elegir por lo menos una caja artistica</div>').appendTo($('#errorNumCajaArtistica')).fadeIn(300).delay(3000).fadeOut(500);

              }
              else{


                  $('#modalCantidadDeCajaArtistica').modal('hide');

                  colorListonCajaArtistica = $('#colorListonCajaArtistica').val();                    

                  var parametros = {
                      'function':40,
                      'socio':socio,
                      'idPedido':<?= $idPedido ?>,
                      'material':material,
                      'cajaArtisticaPrimario':$('#cajaArtisticaPrimario').val(),
                      'cajaArtisticaSecundario':$('#cajaArtisticaSecundario').val(),
                      'alto':<?= $alto ?>,
                      'altoSecundario':<?= $altoSecundario ?>,
                      'proPiel':proPiel,
                      'piel':piel,
                      'numAlbumesSecundario':<?= $numAlbumesSecundario ?>,
                      'colorListonCajaArtistica': idColor                        
                  }

                  $.ajax({
            
                    data: parametros,
                    url: '/manejadores/manejadorAlbums.php',
                    type: 'post',
                    dataType: "JSON",
                    
                      success: function(data){
                          
                          if(data.status === 'success'){
                              swal({
                                  title: "Guardado",
                                  text: "Se agrego el accesorio caja artistica!",
                                  type: "success",
                                  showCancelButton: true,
                                  confirmButtonClass: 'btn-success',
                                  confirmButtonId: 'especial',
                                  cancelButtonText: "Agregar otro accesorio",
                                  confirmButtonText: "Continuar",

                              },
                              function(isConfirm){
                                  if (isConfirm) {
                                      guardar();
                                      
                                  
                                  } 
                                  else{


                                      if($('#cajaArtisticaPrimario').val() != 0){


                                          var cajaArtistica = $('#cajaArtisticaPrimario').val();
                                          var precioPorCajaArtisticaPrincipal =  $('#precioCajaArtisticaPrincipal').text();
                                         

                                          var listado =   '<a href="#" class="list-group-item clearfix" id="liCajaArtisticaPrincipal">'+
                                                              'Caja artistica  para álbum principal'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+cajaArtistica+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioPorCajaArtisticaPrincipal*cajaArtistica)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarCajaArtisticaPrincipal();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liCajaArtisticaPrincipal').remove();               

                                          $('#listaDeAccesoriosPedidos').append(listado);

                                      }
                                      if($('#cajaArtisticaSecundario').val() != 0){


                                          var cajaArtistica = $('#cajaArtisticaSecundario').val();
                                          var precioPorCajaArtisticaSecundario =  $('#precioCajaArtisticaSecundario').text();

                                          var listado = ' <a href="#" class="list-group-item clearfix" id="liCajaArtisticaSecundario">'+
                                                              'Caja artistica para álbum extra'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+cajaArtistica+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioPorCajaArtisticaSecundario*cajaArtistica)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarCajaArtisticaSecundario();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liCajaArtisticaSecundario').remove();                              

                                          $('#listaDeAccesoriosPedidos').append(listado);



                                      }


                                     
                                     
                                  

                                  }

                                 
                              });
                          }
                          else{

                              alert('upss!! Existe un error en el sistema')
                          }
                      },

                      error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                      }
                    
                  });

              }

          }




          


          function eliminarCajaArtisticaPrincipal(){

              swal({
                title: "Estas seguro",
                text: "Se eliminaran las cajas artisticas del album principal  de este  pedido!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':41,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Las cajas artisticas del album principal fueron eliminados.", "success"); 
                                  $('#liCajaArtisticaPrincipal').remove();
                              }
                              else{

                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Tu caja artistica sigue guardada en tu pedido.", "error");

                  } 

                 
              });
          }


          $('#btnEliminarCajaArtisticaPrincipal').click(function(){
              eliminarCajaArtisticaPrincipal();
          });




          function eliminarCajaArtisticaSecundario(){

             
              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran las cajas artisticas del álbum extra  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':42,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Las cajas artisticas del album extra fueron eliminados.", "success"); 
                                  $('#liCajaArtisticaSecundario').remove();
                              }
                              else{

                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Tu caja artistica  sigue guardada en tu pedido.", "error");

                  } 

                 
              });
          }


          $('#btnEliminarCajaArtisticaSecundario').click(function(){
              eliminarCajaArtisticaSecundario();
          });


          

          $('#btnCajaDeLux').click(function(){


              switch(<?= $empastado ?>){

                  
                  case 6:
                  case 4:
                  case 5:
                  case 8:
                  case 9:
                  case 10:
                  case 11:
                  case 12:
                  case 13:
                  case 14:
                  case 15:
                  case 16:

                      

                      $('#modalTipoMaterialCajaDeLux').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });

                      


                  break;

                  case 1:
                  case 3:

                      $('#modalMaterialCajaDeLux').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });


                  break;


              }
          


          });

          $('#btnMaterialAUsarCajaDeLux').click(function(){
              

              var materialAUarCajaDeLux = $('#materialAUarCajaDeLux').val();

              if(materialAUarCajaDeLux == 1){

                  material = <?= $material ?>;
                  $('#modalCantidadDeCajaDeLux').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });

              }
              else{

                  $('#modalMaterialCajaDeLux').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }


          });


          $('#btnMaterial').click(function(){

              var tipoDeMaterial = parseInt($('#material').val());

              
              switch(tipoDeMaterial){

                  case 1:
                      material = tipoDeMaterial;
                     //Mostrara colores de pro piel
                      $('#modalColorProPiel').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });
                  break;



              }




          });



          function elegirColorProPiel(idColorProPiel){

             
              $('#modalColorProPiel').modal('hide');
              proPiel = idColorProPiel;

              $('#modalCantidadDeCajaDeLux').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });



          }

          function elegirColorProPielCajaArtistica(idColorProPiel){

             
              $('#modalColorProPiel').modal('hide');
              proPiel = idColorProPiel;

              $('#modalCantidadDeCajaArtistica').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });



          }


          $('#cantidadCajaDeLux').click(function(){

              $('#modalCantidadDeCajaDeLux').modal('hide');

              $('#modalColorListonCajaDeLux').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });
            
          });

          function guardarCajaDeLux(idColor){

              $('#modalColorListonCajaDeLux').modal('hide');

              if($('#cajaDeLuxPrimario').val()== 0 && $('#cajaDeLuxSecundario').val() == 0){

                  $('<div  class="alert alert-error">Debe elegir por lo menos una caja de lux</div>').appendTo($('#errorNumCajaDeLux')).fadeIn(300).delay(3000).fadeOut(500);

              }
              else{


                  $('#modalCantidadDeCajaDeLux').modal('hide');

                  colorListonCajaDeLux = $('#colorListonCajaDeLux').val();                    
            
                  var parametros = {
                      'function':37,
                      'socio':socio,
                      'idPedido':<?= $idPedido ?>,
                      'material':material,
                      'cajaDeLuxPrimario':$('#cajaDeLuxPrimario').val(),
                      'cajaDeLuxSecundario':$('#cajaDeLuxSecundario').val(),
                      'alto':<?= $alto ?>,
                      'altoSecundario':<?= $altoSecundario ?>,
                      'proPiel':proPiel,
                      'piel':piel,
                      'numAlbumesSecundario':<?= $numAlbumesSecundario ?>,
                      'colorListonCajaDeLux': idColor                        
                  }

                  $.ajax({
            
                    data: parametros,
                    url: '/manejadores/manejadorAlbums.php',
                    type: 'post',
                    dataType: "JSON",
                    
                      success: function(data){
                          
                          if(data.status === 'success'){
                              swal({
                                  title: "Guardado",
                                  text: "Se agrego el accesorio caja de lux!",
                                  type: "success",
                                  showCancelButton: true,
                                  confirmButtonClass: 'btn-success',
                                  confirmButtonId: 'especial',
                                  cancelButtonText: "Agregar otro accesorio",
                                  confirmButtonText: "Continuar",

                              },
                              function(isConfirm){
                                  if (isConfirm) {
                                      guardar();
                                      
                                  
                                  } 
                                  else{


                                      if($('#cajaDeLuxPrimario').val() != 0){


                                          var cajaDeLux = $('#cajaDeLuxPrimario').val();
                                          var precioPorCajaDeLuxPrincipal =  $('#precioCajaDeLuxPrincipal').text();
                                         

                                          var listado =   '<a href="#" class="list-group-item clearfix" id="liCajaDeLuxPrincipal">'+
                                                              'Caja de lux  para álbum principal'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+cajaDeLux+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioPorCajaDeLuxPrincipal*cajaDeLux)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarCajaDeLuxPrincipal();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liCajaDeLuxPrincipal').remove();               

                                          $('#listaDeAccesoriosPedidos').append(listado);

                                      }
                                      if($('#cajaDeLuxSecundario').val() != 0){


                                          var cajaDeLux = $('#cajaDeLuxSecundario').val();
                                          var precioPorCajaDeLuxSecundario =  $('#precioCajaDeLuxSecundario').text();

                                          var listado = ' <a href="#" class="list-group-item clearfix" id="liCajaDeLuxSecundario">'+
                                                              'Caja de lux para álbum extra'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+cajaDeLux+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioPorCajaDeLuxSecundario*cajaDeLux)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarCajaDeLuxSecundario();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liCajaDeLuxSecundario').remove();                              

                                          $('#listaDeAccesoriosPedidos').append(listado);



                                      }


                                     
                                     
                                  

                                  }

                                 
                              });
                          }
                          else{

                              alert('upss!! Existe un error en el sistema')
                          }
                      },

                      error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                      }
                    
                  });

              }

          }


          function eliminarCajaDeLuxPrincipal(){

              swal({
                title: "Estas seguro",
                text: "Se eliminaran las cajas de lux del album principal  de este  pedido!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':38,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });
                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Las cajas de lux  del album principal fueron eliminados.", "success"); 
                                  $('#liCajaDeLuxPrincipal').remove();
                              }
                              else{                           
                                  swal("Cancelled", "Upss!! hubo un error en el sistema", "error");
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Tu caja de lux  sigue guardada en tu pedido.", "error");

                  } 

                 
              });
          }


          $('#btnEliminarCajaDeLuxPrincipal').click(function(){
              eliminarCajaDeLuxPrincipal();
          });



          function eliminarCajaDeLuxSecundario(){

             
              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran las cajas de lux del álbum extra  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':39,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Las cajas de lux del álbum extra fueron eliminados.", "success"); 
                                  $('#liCajaDeLuxSecundario').remove();
                              }
                              else{


                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                      swal("Cancelado", "Tu caja de lux  sigue guardada en tu pedido.", "error");

                  } 

                 
              });
          }


          $('#btnEliminarCajaDeLuxSecundario').click(function(){
              eliminarCajaDeLuxSecundario();
          });


          

          function eliminarEstuchePrincipal(){

             
              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los estuches del album principal  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':32,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los estuches del album principal fueron eliminados.", "success"); 
                                  $('#liEstuchePrimario').remove();
                              }
                              else{


                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                       swal("Cancelado", "Tu estuche sigue guardado en tu pedido.", "error");

                  } 

                 
              });
          }
              
          
          $('#btnEliminarEstuchePrincipal').click(function(){


              
             
              eliminarEstuchePrincipal();

          

          });


          function eliminarEstucheSecundario(){

              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los estuches del álbum extra  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':33,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los estuches del álbum extra fueron eliminados.", "success"); 
                                  $('#liEstucheSecundario').remove();
                              }
                              else{


                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                       swal("Cancelado", "Su estuche sigue guardado en su pedido :)", "error");

                  } 

                 
              });


          }


          $('#btnEliminarEstucheSecundario').click(function(){



              eliminarEstucheSecundario();



          });


          /*-----------------------------FOTO BOX -----------------------------------------*/


          $('#btnFotoBox').click(function(){

              

              switch(<?= $empastado ?>){

                  case 14:
                  case 15:
                  case 16:
                  case 6:

           
                      tipoSubidaPortadaFotoBox = 2;


                      subidorDeArchivosFotoBoxPortada(26,'foto-Box-Portada');
                      $('#modalFotoBoxSubidorPortada').modal({  
                          show:true,
                          keyboard:true,
                          backdrop:true
                      });



                      

                  break;

                  case 19:
                  case 18:
                  case 17:
                  case 12:
                  case 13:
                  case 8:
                  case 4:
                  case 3:
                  case 1:
                  case 5:
                  case 9:
                      $('#modalPortadaFotoBox').modal({  
                        show:true,
                        keyboard:true,
                        backdrop:true
                      });

                      
                  break;


              }


          });


          $('#btnFotoBoxTipoDePortada').click(function(){

          
              tipoSubidaPortadaFotoBox = $( "#portadaAUsarFotoBox" ).val();
              $('#modalPortadaFotoBox').modal('hide');

              switch(<?= $empastado ?>){

                  case 12:
                  case 13:
                  case 17:
                  case 18:
                  case 19:
                  case 8:
                  case 4:
                  case 3:
                  case 1:
                  case 5:
                  case 9:


                      if(tipoSubidaPortadaFotoBox == 1){                            
                          $('#modalAgregarFotoInteriorFotoBox').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });
                          
                         
                        
                      }

                      else{

                          subidorDeArchivosFotoBoxPortada(26,'foto-Box-Portada');
                          $('#modalFotoBoxSubidorPortada').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });

                      }
                  break;


              }

              


          }); 

          $('#btnFotoInternaFotoBox').click(function(){

              var agregarFotoInternaFotoBox = $('#agregarFotoInternaFotoBox').val();
             

              if(agregarFotoInternaFotoBox ==  1){


                  $('#modalAgregarTextoEnLomoFotoBox').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });






              }
              else{

                  subidorDeArchivosFotoBoxInterna(27,'foto-Box-Interna');
                  $('#modalFotoBoxSubidorInterior').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });

                      
              }

          });


          $('#btnTextoEnLomoFotoBox').click(function(){

              var agregar = $('#agregarTextoFotoBox').val();
              

              if(agregar ==  1){
                  
                  agregarTextoFotoBox = 1;
    
                  $('#modalPreguntaFotoBoxConContraPortada').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });
             

              }
              else{

                  agregarTextoFotoBox = 2;
                  $('#modalTipoDeTipografiaYColor').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });

              }

          });

          $('#btnTipografiaYColor').click(function(){

              tipoGrafia = $('#tipoGrafia').val();
              colorDeTexto = $('#colorDeTexto').val();

              $('#modalTextoFechaYLineas').modal({  
                  show:true,
                  keyboard:true,
                  backdrop:true
              });

          });


          $('#btnTextoFechaYLineas').click(function(){


              if($('#textoDeGrabado').val() == '' ){
                  alert('Debe agregar un texto')
              }
              

              else{

                  $('#modalTextoFechaYLineas').modal('hide');

                 

                  $('#modalColorFotoBox').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });



                      
              }

              

          });

         



          function elegirColorFotoBox(idColor){
             
              $('#modalColorFotoBox').modal('hide');
              colorFotoBox = idColor;

              $('#modalCantidadDeFotoBox').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });

          }

         
          


          $('#btnAgregarFotoEnContraPortadaDeFotoBox').click(function(){

              var agregarFotoEnContraPortadaDeFotoBox = $('#agregarFotoEnContraPortadaDeFotoBox').val();
             

              if(agregarFotoEnContraPortadaDeFotoBox ==  1){
                  tipoDeSubidaContraPortadaFotoBox = 0;
                  tipoDeFotoBox  = 1;
                 

                  $('#modalColorFotoBox').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });


              }
              else{


                  subidorDeArchivosFotoBoxContraPortada(28,'foto-Box-ContraPortada');
                  $('#modalFotoBoxSubidorContraPortada').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });



              }

          });



          $('#continuarSubidorDeContraPortadaFotoBox').click(function(){


              $('#modalFotoBoxSubidorContraPortada').modal('hide');

              

              var idProducto = 28;
              var parametros = {
                  "carpeta" : '<?= $carpeta ?>',
                  "idProducto" : idProducto,
                  "Product" : '<?= $_GET['Product'] ?>',
                  "idSocio" :  <?= $boot->socio ?>,
                  "idUser" : idUser,
                  "IdTamano": <?= $idTamano ?>,
                  "Compresion" : 2,
                  "Servicio": <?= $servicio ?>,
                  "IdPedido" : <?= $_GET['P'] ?>,
                  "RenombreArchivos" : 0,
                  "resize" : 1,
                  'idCropper' : '<?= $idCropperPortadaFotoBox ?>'
              };

              var altoDeFotoBox =  (<?= $alto ?>+2);
              var anchoDeFotoBox = (<?= $ancho ?>/2)+2;

              if(anchoDeFotoBox>altoDeFotoBox){
                  
                  aspect = (anchoDeFotoBox/ altoDeFotoBox);

              }

              else{
                  
                  aspect = (anchoDeFotoBox/ altoDeFotoBox);
              }



              $.ajax({
                  data: parametros,
                  url: '/cropKiosco/cropAccesoriosAlbumes.php',
                  type: 'post',
                  success: function(data) {
                      $('#imgCropContraPortadaFotoBox').empty().append(data);
                          $('#modalCropContraPortadaFotoBox').modal({  
                              show:true,
                              keyboard:false,
                              backdrop:false
                          });
                          $(function () {
                              var $image = $('#<?= $idCropperPortadaFotoBox ?>');
                              var cropBoxData;
                              var canvasData;
                              $('#modalCropContraPortadaFotoBox').on('shown.bs.modal', function () {
                                  $image.cropper({
                                      autoCropArea:1,
                                      aspectRatio: aspect,
                                      cropBoxMovable: false,
                                      cropBoxResizable: false,
                                      strict: true,
                                      dragCrop: false,

                                      built: function () {
                                          $image.cropper('setCanvasData', canvasData);
                                          $image.cropper('setCropBoxData', cropBoxData);
                                      }
                                  });
                              }).on('hidden.bs.modal', function () {
                                  cropBoxData = $image.cropper('getCropBoxData');
                                  canvasData = $image.cropper('getCanvasData');
                                  $image.cropper('destroy');
                              });
                          });

                     
                  }
              });


              
          });


          $( ".recorteCropContraPortadaFotoBox" ).click(function() {
              

              $('#modalGuardando').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });

              var data = [];

              $( "#imgCropContraPortadaFotoBox > img" ).each(function( key,index ){
              

                  var altoDeFotoBox =  (<?= $alto ?>+2);
                  var anchoDeFotoBox = (<?= ($ancho/2) ?>+2);

                  var altoDeCorte = altoDeFotoBox;
                  var anchoDeCorte = anchoDeFotoBox;

                  if(altoDeFotoBox>anchoDeFotoBox){

                      altoDeCorte = anchoDeFotoBox;
                      anchoDeCorte = altoDeFotoBox;


                  }




                  var idSocio = <?= $boot->socio ?>;
                  var id = index.id;
                  var img_data = $("#"+id).cropper("getData");
                  var NombreDeImagen = $('#'+id).data('name');
                  var imgName = $('#'+id).data('name');
                  var imgPath = '<?php echo $rutaFotoBoxContraPortada?>/'+imgName;
                  var altoOrginal = $(this).data('height');
                  var anchoOrginal = $(this).data('width');
                  var altoPreview =  $(this).data('altopreview');
                  var anchoPreview =  $(this).data('anchopreview');




                  var parametroRecorte = {
                      'src':imgPath,
                      'imgName':NombreDeImagen,
                      'alto':altoDeCorte,
                      'ancho':anchoDeCorte,
                     
                      'ruta':'<?php echo $rutaFotoBoxContraPortada ?>',
                      'width':img_data.width,
                      'height':img_data.height,
                      'x':img_data.x,
                      'y':img_data.y,
                      'rotate':img_data.rotate,
                      'anchoOriginal':anchoOrginal,
                      'altoOriginal':altoOrginal,
                      'anchoPreview':anchoPreview,
                      'altoPreview':altoPreview,
                      'idSocio':idSocio,
                      'idProducto':28,
                      'nombreDeImagen':NombreDeImagen
                
                  };
                
                  data.push(parametroRecorte);
                  var parametros = {
                      'data':data
                  };

                  console.log(JSON.stringify(parametros,null,4))

                  $.ajax({
                      data: parametros,
                      url: '/cropKiosco/recorteKiosco.php',
                      type: 'post',
                      success: function(data) {
                 
                          $('#modalGuardando').modal('hide');
                          $('#modalCropInteriorFotoBox').modal('hide');


                          $('#modalColorFotoBox').modal({

                              show:true,
                              keyboard:false,
                              backdrop: 'static'

                          });

                              


                         
                 
                      },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(jqXHR);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
         

              });



            });

            
            
          });


          $('#cantidadDeFotoBox').click(function(){

              $('#modalCantidadDeFotoBox').modal('hide');

              $('#modalColorListonFotoBox').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });
            
          });


          function guardarFotoBox(idColor) {

              $('#modalColorListonFotoBox').modal('hide');

              colorListonFotoBox = idColor;

              var fechaDeLomoFotoBox = '';
             
              if($('.fechaDeGrabado').val()!=''){

                  fechaDeLomoFotoBox = $('.fechaDeGrabado').val();

              }
        
                 
              var parametros = {
                  'function':50,
                  'socio':socio,
                  'idPedido':<?= $idPedido ?>,
                  'tipoDeFotoBox':tipoDeFotoBox,
                  'tipoSubidaPortadaFotoBox':tipoSubidaPortadaFotoBox,
                  'tipoDeSubidaContraPortadaFotoBox':tipoDeSubidaContraPortadaFotoBox,
                  'fotoBoxPrincipal':$('#fotoBoxPrincipal').val(),
                  'fotoBoxSecundario':$('#fotoBoxSecundario').val(),
                  'alto':<?= $alto ?>,
                  'altoSecundario':<?= $altoSecundario ?>,
                  'numAlbumesSecundario':<?= $numAlbumesSecundario ?>,
                  'agregarFotoInteriorDeFotoBox': $('#agregarFotoInternaFotoBox').val(),
                  'agregarTextoFotoBox': $('#agregarTextoFotoBox').val(),
                  'tipoGrafiaFotoBox':$('#tipoGrafia').val(),
                  'colorDeTextoFotoBox':$('#colorDeTexto').val(),
                  'textoLomoFotoBox' : $('#textoDeGrabado').val(),
                  'fechaDeLomoFotoBox':  fechaDeLomoFotoBox ,
                  'lineasParaOcuparLomoFotoBox': $('#lineasParaOcupar').val(),
                  'colorFotoBox':colorFotoBox,
                  'agregarCharolasAFotoBox':agregarCharolasParaFotoBox,
                  'cantidadDeCharolasFotoBox':$('#charolasParaDvd').val(),
                  'colorListonFotoBox': colorListonFotoBox
              }

              $.ajax({
        
                data: parametros,
                url: '/manejadores/manejadorAlbums.php',
                type: 'post',
                dataType: "JSON",
                
                  success: function(data){
                      
                      if(data.status === 'success'){
                          swal({
                              title: "Guardado",
                              text: "Se agrego el accesorio Foto box!",
                              type: "success",
                              showCancelButton: true,
                              confirmButtonClass: 'btn-success',
                              confirmButtonId: 'especial',
                              cancelButtonText: "Agregar otro accesorio",
                              confirmButtonText: "Continuar",

                          },
                          function(isConfirm){
                              if (isConfirm) {

                                  //Aqui tenemos que guardar los datos antes de ir al ticket

                                  guardar();
                              
                              }
                              else{

                                      if($('#fotoBoxPrincipal').val() != 0){

                                          var fotoBoxPrincipal = $('#fotoBoxPrincipal').val();
                                          var precioPorFotoBoxPrincipal =  $('#precioFotoBoxPrincipal').text();

                                          if(agregarCharolasParaFotoBox == 1){

                                              var charolasParaDvdfotoBox = $('#charolasParaDvd').val();
                                              precioPorFotoBoxPrincipal = parseInt(precioPorFotoBoxPrincipal) + parseInt(charolasParaDvdfotoBox*<?= $precioPorCharola ?>);
                                          }
                                                                                       
                                          var listado =   '<a href="#" class="list-group-item clearfix" id="liFotoBoxPrincipal">'+
                                                              'Foto box para álbum principal'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+fotoBoxPrincipal+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioPorFotoBoxPrincipal*fotoBoxPrincipal)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarFotoBoxPrincipal();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liFotoBoxPrincipal').remove();
                                          $('#listaDeAccesoriosPedidos').append(listado);
                                      }

                                      if($('#fotoBoxSecundario').val() != 0){

                                          var fotoBoxSecundario = $('#fotoBoxSecundario').val();
                                          var precioFotoBoxSecundario =  $('#precioFotoBoxSecundario').text();                                                                                   

                                          var listado =   '<a href="#" class="list-group-item clearfix" id="liFotoEstucheSecundario">'+
                                                              'Foto box para álbum extra'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+fotoBoxSecundario+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioFotoBoxSecundario*fotoBoxSecundario)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarFotoBoxSecundario();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liFotoBoxSecundario').remove();
                                          $('#listaDeAccesoriosPedidos').append(listado);

                                      }
                              } 
                          
                          });
                      }
                      else{

                          alert('upss!! Existe un error en el sistema')
                      }
                  },

                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                  }
                
              });

          }



          function eliminarFotoBoxPrincipal(){


              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los foto box para el  album principal  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':51,
                          'idPedido' : <?= $idPedido ?>,
                          'carpeta':'<?= $carpeta ?>',
                          'idSocio':<?= $boot->socio ?>,
                          'idUser': idUser
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los foto box para el  album principal fueron eliminados.", "success"); 
                                  $('#liFotoBoxPrincipal').remove();
                              }
                              else{


                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                       swal("Cancelado", "Su foto box sigue guardado en su pedido :)", "error");

                  } 

                 
              });


          }


          $('#btnEliminarFotoBoxPrincipal').click(function(){




              eliminarFotoBoxPrincipal();
          
              


          });
     

          function eliminarFotoBoxSecundario(){


              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los foto box para el  álbum extra  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':52,
                          'idPedido' : <?= $idPedido ?>,
                          'carpeta':'<?= $carpeta ?>',
                          'idSocio':<?= $boot->socio ?>,
                          'idUser': idUser
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los foto box para el  álbum extra fueron eliminados.", "success"); 
                                  $('#liFotoBoxSecundario').remove();
                              }
                              else{


                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                       swal("Cancelado", "Su foto box sigue guardado en su pedido :)", "error");

                  } 

                 
              });


          }


          $('#btnEliminarFotoBoxSecundario').click(function(){




              eliminarFotoBoxSecundario();
          
              


          });


          $('#continuarSubidorDePortadaFotoBox').click(function(){


              $('#modalFotoBoxSubidorPortada').modal('hide');

              

              var idProducto = 26;
              var parametros = {
                  "carpeta" : '<?= $carpeta ?>',
                  "idProducto" : idProducto,
                  "Product" : '<?= $_GET['Product'] ?>',
                  "idSocio" :  <?= $boot->socio ?>,
                  "idUser" : idUser,
                  "IdTamano": <?= $idTamano ?>,
                  "Compresion" : 2,
                  "Servicio": <?= $servicio ?>,
                  "IdPedido" : <?= $_GET['P'] ?>,
                  "RenombreArchivos" : 0,
                  "resize" : 1,
                  'idCropper' : '<?= $idCropper ?>'
              };

              var altoDeFotoBox =  (<?= $alto ?>+2);
              var anchoDeFotoBox = (<?= $ancho ?>/2)+2;

            
              var aspect = 0;


              if(anchoDeFotoBox>altoDeFotoBox){
                  
                  aspect = (anchoDeFotoBox/ altoDeFotoBox);

              }

              else{
                  
                  aspect= (anchoDeFotoBox/ altoDeFotoBox);
              }




              $.ajax({
                  data: parametros,
                  url: '/cropKiosco/cropAccesoriosAlbumes.php',
                  type: 'post',
                  success: function(data) {
                      $('#imgCropPortadaFotoBox').empty().append(data);


                      $('#modalCropPortadaFotoBox').modal({  
                          show:true,
                          keyboard:false,
                          backdrop:false
                      });

                      $(function () {
                          var $image = $('#<?= $idCropper ?>');
                          var cropBoxData;
                          var canvasData;
                          $('#modalCropPortadaFotoBox').on('shown.bs.modal', function () {
                              $image.cropper({
                                  autoCropArea:1,
                                  aspectRatio: aspect,
                                  cropBoxMovable: false,
                                  cropBoxResizable: false,
                                  strict: true,
                                  dragCrop: false,

                                  built: function () {
                                      $image.cropper('setCanvasData', canvasData);
                                      $image.cropper('setCropBoxData', cropBoxData);
                                  }
                              });
                          }).on('hidden.bs.modal', function () {
                              cropBoxData = $image.cropper('getCropBoxData');
                              canvasData = $image.cropper('getCanvasData');
                              $image.cropper('destroy');
                          });
                      });

                     
                  }
              });


              
          });


          $( ".recorteCropPortadaFotoBox" ).click(function() {
              

              $('#modalGuardando').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });

              var data = [];

              $( "#imgCropPortadaFotoBox > img" ).each(function( key,index ){
              

            


                  var altoDeFotoBox =  (<?= $alto ?>+2);
                  var anchoDeFotoBox = (<?= $ancho ?>/2)+2;


                  var altoDeCorte = altoDeFotoBox;
                  var anchoDeCorte = anchoDeFotoBox;

                  if(altoDeFotoBox>anchoDeFotoBox){

                      altoDeCorte = anchoDeFotoBox;
                      anchoDeCorte = altoDeFotoBox;


                  }



                  var idSocio = <?= $boot->socio ?>;
                  var id = index.id;
                  var img_data = $("#"+id).cropper("getData");
                  var NombreDeImagen = $('#'+id).data('name');
                  var imgName = $('#'+id).data('name');
                  var imgPath = '<?php echo $rutaFotoBoxPortada?>/'+imgName;
                  var altoOrginal = $(this).data('height');
                  var anchoOrginal = $(this).data('width');
                  var altoPreview =  $(this).data('altopreview');
                  var anchoPreview =  $(this).data('anchopreview');




                  var parametroRecorte = {
                      'src':imgPath,
                      'imgName':NombreDeImagen,
                      'alto':altoDeCorte,
                      'ancho':anchoDeCorte,
                      'ruta':'<?php echo $rutaFotoBoxPortada ?>',
                      'width':img_data.width,
                      'height':img_data.height,
                      'x':img_data.x,
                      'y':img_data.y,
                      'rotate':img_data.rotate,
                      'anchoOriginal':anchoOrginal,
                      'altoOriginal':altoOrginal,
                      'anchoPreview':anchoPreview,
                      'altoPreview':altoPreview,
                      'idSocio':idSocio,
                      'idProducto':26,
                      'nombreDeImagen':NombreDeImagen
                
                  };
                
                  data.push(parametroRecorte);
                  var parametros = {
                      'data':data
                  };

                  console.log(JSON.stringify(parametros,null,4))

                  $.ajax({
                      data: parametros,
                      url: '/cropKiosco/recorteKiosco.php',
                      type: 'post',
                      success: function(data) {
                 
                          $('#modalGuardando').modal('hide');
                          $('#modalCropPortadaFotoBox').modal('hide');


                          $('#modalAgregarFotoInteriorFotoBox').modal({

                              show:true,
                              keyboard:false,
                              backdrop: 'static'

                          });

                              


                         
                 
                      },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(jqXHR);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
         

              });



            });

            
            
          });


          $('#continuarSubidorDeInteriorFotoBox').click(function(){


              $('#modalFotoBoxSubidorInterior').modal('hide');

             
              var idProducto = 27;
              var parametros = {
                  "carpeta" : '<?= $carpeta ?>',
                  "idProducto" : idProducto,
                  "Product" : '<?= $_GET['Product'] ?>',
                  "idSocio" :  <?= $boot->socio ?>,
                  "idUser" : idUser,
                  "IdTamano": <?= $idTamano ?>,
                  "Compresion" : 2,
                  "Servicio": <?= $servicio ?>,
                  "IdPedido" : <?= $_GET['P'] ?>,
                  "RenombreArchivos" : 0,
                  "resize" : 1,
                  'idCropper' : '<?= $idCropperImagenInterior ?>'
              };

              var altoDeFotoBox =  (<?= $alto ?>+2);
              var anchoDeFotoBox = (<?= $ancho ?>/2)+2;


              if(anchoDeFotoBox>altoDeFotoBox){
                  
                  aspect = (anchoDeFotoBox/ altoDeFotoBox);

              }

              else{
                  
                  aspect = (anchoDeFotoBox/ altoDeFotoBox);
              }


              $.ajax({
                  data: parametros,
                  url: '/cropKiosco/cropAccesoriosAlbumes.php',
                  type: 'post',
                  success: function(data) {
                      $('#imgCropInteriorFotoBox').empty().append(data);

                      $('#modalCropInteriorFotoBox').modal({  
                          show:true,
                          keyboard:false,
                          backdrop:false
                      });


                          $(function () {
                              var $image = $('#<?= $idCropperImagenInterior ?>');
                              var cropBoxData;
                              var canvasData;
                              $('#modalCropInteriorFotoBox').on('shown.bs.modal', function () {
                                  $image.cropper({
                                      autoCropArea:1,
                                      aspectRatio:aspect,
                                      cropBoxMovable: false,
                                      cropBoxResizable: false,
                                      strict: true,
                                      dragCrop: false,

                                      built: function () {
                                          $image.cropper('setCanvasData', canvasData);
                                          $image.cropper('setCropBoxData', cropBoxData);
                                      }
                                  });
                              }).on('hidden.bs.modal', function () {
                                  cropBoxData = $image.cropper('getCropBoxData');
                                  canvasData = $image.cropper('getCanvasData');
                                  $image.cropper('destroy');
                              });
                          });

                     
                  }
              });


              
          });


          $( ".recorteCropInteriorFotoBox" ).click(function() {
              

              $('#modalGuardando').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });

              var data = [];

              $( "#imgCropInteriorFotoBox > img" ).each(function( key,index ){
              

                  var altoDeFotoBox =  (<?= $alto ?>+2);
                  var anchoDeFotoBox = (<?= ($ancho/2) ?>+2);


                  var altoDeCorte = altoDeFotoBox;
                  var anchoDeCorte = anchoDeFotoBox;

                  if(altoDeFotoBox>anchoDeFotoBox){

                      altoDeCorte = anchoDeFotoBox;
                      anchoDeCorte = altoDeFotoBox;


                  }


                  var idSocio = <?= $boot->socio ?>;
                  var id = index.id;
                  var img_data = $("#"+id).cropper("getData");
                  var NombreDeImagen = $('#'+id).data('name');
                  var imgName = $('#'+id).data('name');
                  var imgPath = '<?php echo $rutaFotoBoxInterior?>/'+imgName;
                  var altoOrginal = $(this).data('height');
                  var anchoOrginal = $(this).data('width');
                  var altoPreview =  $(this).data('altopreview');
                  var anchoPreview =  $(this).data('anchopreview');




                  var parametroRecorte = {
                      'src':imgPath,
                      'imgName':NombreDeImagen,
                      'alto':altoDeCorte,
                      'ancho':anchoDeCorte,
                      'ruta':'<?php echo $rutaFotoBoxInterior ?>',
                      'width':img_data.width,
                      'height':img_data.height,
                      'x':img_data.x,
                      'y':img_data.y,
                      'rotate':img_data.rotate,
                      'anchoOriginal':anchoOrginal,
                      'altoOriginal':altoOrginal,
                      'anchoPreview':anchoPreview,
                      'altoPreview':altoPreview,
                      'idSocio':idSocio,
                      'idProducto':27,
                      'nombreDeImagen':NombreDeImagen
                
                  };
                
                  data.push(parametroRecorte);
                  var parametros = {
                      'data':data
                  };

                  console.log(JSON.stringify(parametros,null,4))

                  $.ajax({
                      data: parametros,
                      url: '/cropKiosco/recorteKiosco.php',
                      type: 'post',
                      success: function(data) {
                 
                          $('#modalGuardando').modal('hide');
                          $('#modalCropInteriorFotoBox').modal('hide');


                          $('#modalAgregarTextoEnLomoFotoBox').modal({

                              show:true,
                              keyboard:false,
                              backdrop: 'static'

                          });

                              


                         
                 
                      },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(jqXHR);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
         

              });



            });

            
            
          });




          



          /****************************** FOTO ESTUCHE***********************************/


          function eliminarFotoEstuchePrincipal(){


              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los foto estuches del album primario  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':34,
                          'idPedido' : <?= $idPedido ?>,
                          'carpeta':'<?= $carpeta ?>',
                          'idSocio':<?= $boot->socio ?>,
                          'idUser': idUser
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los foto estuches del album primario fueron eliminados.", "success"); 
                                  $('#liFotoEstuchePrimario').remove();
                              }
                              else{


                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                       swal("Cancelado", "Tu foto estuche sigue guardado en tu pedido.", "error");

                  } 

                 
              });


          }


          $('#btnEliminarFotoEstuchePrincipal').click(function(){




              eliminarFotoEstuchePrincipal();
          
              


          });



          function eliminarFotoEstucheSecundario(){


              swal({
                  title: "Estas seguro",
                  text: "Se eliminaran los foto estuches del álbum extra  de este  pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':35,
                          'idPedido' : <?= $idPedido ?>,
                          'carpeta':'<?= $carpeta ?>',
                          'idSocio':<?= $boot->socio ?>,
                          'idUser': idUser
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });


                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los foto estuches del álbum extra fueron eliminados.", "success"); 
                                  $('#liFotoEstuchePrimario').remove();
                              }
                              else{


                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                       swal("Cancelado", "Su foto estuche sigue guardado en su pedido :)", "error");

                  } 

                 
              });


          }



          $('#btnEliminarFotoEstucheSecundario').click(function(){




              eliminarFotoEstucheSecundario();
          
              


          });
         


          $('#btnFotoEstuche').click(function(){

              

              switch(<?= $empastado ?>){

                  case 14:
                  case 15:
                  case 16:
                  case 6:

                      $('#portadaAUsarFotoEstuche').val(2);
                      subidorDeArchivos(20,'foto-Estuche-Portada');
                      $('#modalSubidorPortada').modal({  
                          show:true,
                          keyboard:true,
                          backdrop:true
                      });

                  break;

                  case 19:
                  case 18:
                  case 17:
                  case 12:
                  case 13:
                  case 8:
                  case 4:
                  case 3:
                  case 1:
                  case 5:
                  case 9:
                      $('#modalPortadaFotoEstuche').modal({  
                        show:true,
                        keyboard:true,
                        backdrop:true
                      });

                      
                  break;


              }


          });

          
          $('#fotoEstucheTipoDePortada').click(function(){

          
              var tipoDeSubidaFotoEstuche = $( "#portadaAUsarFotoEstuche" ).val();
              $('#modalPortadaFotoEstuche').modal('hide');

              switch(<?= $empastado ?>){

                  case 12:
                  case 13:
                   case 19:
                  case 18:
                  case 17:
                  case 8:
                  case 4:
                  case 3:
                  case 1:
                  case 5:
                  case 9:

                      if(tipoDeSubidaFotoEstuche == 1){

                          $('#modalCantidadDeFotoEstuche').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });
                          
                         
                        
                      }

                      else{

                          subidorDeArchivos(20,'foto-Estuche-Portada');
                          $('#modalSubidorPortada').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });

                      }
                  break;


              }

              


          });

          $('#continuarSubidaDePortadaFotoEstuche').click(function(){


              $('#modalSubidorPortada').modal('hide');

             

              var idProducto = 20;
              var parametros = {
                  "carpeta" : '<?= $carpeta ?>',
                  "idProducto" : idProducto,
                  "Product" : '<?= $_GET['Product'] ?>',
                  "idSocio" :  <?= $boot->socio ?>,
                  "idUser" : idUser,
                  "IdTamano": <?= $idTamano ?>,
                  "Compresion" : 2,
                  "Servicio": <?= $servicio ?>,
                  "IdPedido" : <?= $_GET['P'] ?>,
                  "RenombreArchivos" : 0,
                  "resize" : 1,
                  'idCropper' : '<?= $idCropperPortadaFotoEstuche ?>'
              };

              var altoDeFotoEstuche =  (<?= $alto ?>+.5);
              var anchoDeFotoEstuche = (<?php echo  $ancho/2 ?>)+.5;


              var altoDeCorte = altoDeFotoEstuche;
              var anchoDeCorte = anchoDeFotoEstuche;

              /*if(altoDeFotoEstuche>anchoDeFotoEstuche){

                  altoDeCorte = anchoDeFotoEstuche;
                  anchoDeCorte = altoDeFotoEstuche;


              }*/

              var divisor = parseFloat(anchoDeCorte/altoDeCorte);



              $.ajax({
                  data: parametros,
                  url: '/cropKiosco/cropAccesoriosAlbumes.php',
                  type: 'post',
                  success: function(data) {
                      $('#imgCropPortadaFotoEstuche').empty().append(data);
                      $('#modalCropPortadaFotoEstuche').modal({  
                          show:true,
                          keyboard:false,
                          backdrop:false
                      });

                          $(function () {
                              var $image = $('#<?= $idCropperPortadaFotoEstuche ?>');
                              var cropBoxData;
                              var canvasData;
                              $('#modalCropPortadaFotoEstuche').on('shown.bs.modal', function () {
                                  $image.cropper({
                                      autoCropArea:1,
                                      aspectRatio: divisor,
                                      cropBoxMovable: false,
                                      cropBoxResizable: false,
                                      strict: true,
                                      dragCrop: false,

                                      built: function () {
                                          $image.cropper('setCanvasData', canvasData);
                                          $image.cropper('setCropBoxData', cropBoxData);
                                      }
                                  });
                              }).on('hidden.bs.modal', function () {
                                  cropBoxData = $image.cropper('getCropBoxData');
                                  canvasData = $image.cropper('getCanvasData');
                                  $image.cropper('destroy');
                              });
                          });

                     
                  }
              });


              
          });



          $( ".recorteCropPortadaFotoEstuche" ).click(function() {
              

              $('#modalGuardando').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });

              var data = [];

              $( "#imgCropPortadaFotoEstuche > img" ).each(function( key,index ){
              

                  var altoDeFotoEstuche =  (<?= $alto ?>+.5);
                  var anchoDeFotoEstuche = ((<?php echo  $ancho /2 ?>)+.5);

                  var altoDeCorte = altoDeFotoEstuche;
                  var anchoDeCorte = anchoDeFotoEstuche;

                  if(altoDeFotoEstuche>anchoDeFotoEstuche){

                      altoDeCorte = anchoDeFotoEstuche;
                      anchoDeCorte = altoDeFotoEstuche;


                  }


                  var idSocio = <?= $boot->socio ?>;
                  var id = index.id;
                  var img_data = $("#"+id).cropper("getData");
                  var NombreDeImagen = $('#'+id).data('name');
                  var imgName = $('#'+id).data('name');
                  var imgPath = "<?= $rutaCropFotoEstuche ?>/"+imgName+"";
                  var altoOrginal = $(this).data('height');
                  var anchoOrginal = $(this).data('width');
                  var altoPreview =  $(this).data('altopreview');
                  var anchoPreview =  $(this).data('anchopreview');


                  var parametroRecorte = {
                      'src':imgPath,
                      'imgName':NombreDeImagen,
                      'ancho':anchoDeCorte,
                      'alto':altoDeCorte,
                      'ruta':'<?php echo $rutaCropFotoEstuche ?>',
                      'width':img_data.width,
                      'height':img_data.height,
                      'x':img_data.x,
                      'y':img_data.y,
                      'rotate':img_data.rotate,
                      'anchoOriginal':anchoOrginal,
                      'altoOriginal':altoOrginal,
                      'anchoPreview':anchoPreview,
                      'altoPreview':altoPreview,
                      'idSocio':idSocio,
                      'idProducto':20,
                      'nombreDeImagen':NombreDeImagen
                
                  };
                
                  data.push(parametroRecorte);
                  var parametros = {
                      'data':data
                  };

                  console.log(JSON.stringify(parametros,null,4))

                  $.ajax({
                      data: parametros,
                      url: '/cropKiosco/recorteKiosco.php',
                      type: 'post',
                      success: function(data) {
                 
                          $('#modalGuardando').modal('hide');
                          $('#modalCropPortadaFotoEstuche').modal('hide');


                          $('#modalPreguntaSiDeseanContraPortadaFotoEstuche').modal({

                              show:true,
                              keyboard:false,
                              backdrop: 'static'

                          });

                              


                         
                 
                      },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(jqXHR);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
         

              });



            });

            
            
          });





          $('#continuarCropDePortadaFotoEstuche').click(function(){


              switch(<?php echo  $empastado ?>){

                  case 17:
                  case 18:
                  case 19:
                      $('#modalCropPortadaFotoEstuche').modal('hide');
                      $('#modalPreguntaSiDeseanContraPortadaFotoEstuche').modal({  
                          show:true,
                          keyboard:true,
                          backdrop:true
                      });
                     
                          
                  break;



              }

             

          });
          

          function respuestaSubirContraPortadaFotoEstuche(respuesta){



              switch(<?= $empastado ?>){

                  case 1:
                  case 3:
                  case 5:
                  case 9:


                      //Es solo con portada
                      if(respuesta == 1){
                          tipoDeFotoEstuche = 1;
                          $('#priceFotoEstuche').empty().append(<?= $precioPorFotoEstuchePortadaPrincipal ?>);
                          $('#priceFotoEstucheSecundario').empty().append(<?= $precioPorFotoEstuchePortadaSecundario ?>);
                          $('#modalCantidadDeFotoEstuche').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });
                      }
                      else{

                          $('#modalContraPortadaFotoEstuche').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });



                      }

                  break;

                  case 12:
                  case 14:
                  case 15:
                  case 16:
                  case 17:
                  case 18:
                  case 19:
                  case 8:
                  case 4:
                  case 6:

                      //Es solo con portada
                      if(respuesta == 1){
                          tipoDeFotoEstuche = 1;
                          $('#priceFotoEstuche').empty().append(<?= $precioPorFotoEstuchePortadaPrincipal ?>);
                          $('#priceFotoEstucheSecundario').empty().append(<?= $precioPorFotoEstuchePortadaSecundario ?>);
                          $('#modalCantidadDeFotoEstuche').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });
                      }
                      else{

                          //priceFotoEstuche 
                          $('#priceFotoEstuchePrincipal').empty().append(<?= $precioPorFotoEstucheConContraPortadaPrincipal ?>);
                          $('#priceFotoEstucheSecundario').empty().append(<?= $precioPorFotoEstucheConContraPortadaSecundario ?>);


                          tipoDeFotoEstuche = 2;
                          tipoDeSubidaContraPortadaParaFotoEstuche = 2;
                                                      

                          subidorDeArchivosContraPortada(29,'foto-Estuche-ContraPortada');
                          $('#modalSubidorContraPortada').modal({  
                              show:true,
                              keyboard:true,
                              backdrop:true
                          });

                      }

                  break;



              }


             




          }


          $('#fotoEstucheTipoDeContraPortada').click(function(){



              $('#modalContraPortadaFotoEstuche').modal("hide");


              if($('#contraPortadaAUsarFotoEstuche').val() == 1){

                  //priceFotoEstuche 
                  $('#priceFotoEstuchePrincipal').empty().append(<?= $precioPorFotoEstucheConContraPortadaPrincipal ?>);
                  $('#priceFotoEstucheSecundario').empty().append(<?= $precioPorFotoEstucheConContraPortadaSecundario ?>);


                  tipoDeFotoEstuche = 2;
                  tipoDeSubidaContraPortadaParaFotoEstuche = 1;

                  $('#guardarFotoEstuche').trigger('click');


              }
              else{


                  //priceFotoEstuche 
                  $('#priceFotoEstuchePrincipal').empty().append(<?= $precioPorFotoEstucheConContraPortadaPrincipal ?>);
                  $('#priceFotoEstucheSecundario').empty().append(<?= $precioPorFotoEstucheConContraPortadaSecundario ?>);


                  tipoDeFotoEstuche = 2;
                  tipoDeSubidaContraPortadaParaFotoEstuche = 2;
                                              

                  subidorDeArchivosContraPortada(29,'foto-Estuche-ContraPortada');
                  $('#modalSubidorContraPortada').modal({  
                      show:true,
                      keyboard:true,
                      backdrop:true
                  });
              }


          });  

          $('#btnGrabado').click(function(){ 
         
              switch(<?= $empastado ?>){
                  
                  case 4:
                      $('.areaPortada').hide();                           
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                                        
                  break;

                  case 5:
                      $('.areaPortada').hide();
                      $('.areaContraportada').hide();            
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                    
                  break;

                  case 6:                    
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                    
                  break;

                  case 8:
                      $('.areaPortada').hide();                           
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                                        
                  break;

                  case 9:
                      $('.areaPortada').hide();
                      $('.areaContraportada').hide();            
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                    
                  break;

                  case 12:
                      $('.areaPortada').hide();                           
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                                        
                  break;

                  case 14:                    
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                    
                  break;

                  case 17:
                  case 18:
                  case 19:
                      $('.areaPortada').hide();                    
                      $('#modalAreaDeGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });                    
                  break;

              }
          

          });

          /////////////////////////////////////////////
          //       AREAS ELEGIDAS DEL GRABADO       //
          ////////////////////////////////////////////

          $('#btnAreaDeGrabado').click(function() {
          
              $('#modalAreaDeGrabado').modal('hide');

              if ($('#areaPortada').is(':checked')) {                
                  checkPortada = 1;                                        
                  $('#modalPosicionGrabadoPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }                
              else if ($('#areaLomo').is(':checked')) {                                        
                  $('#modalPosicionGrabadoLomo').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });                                 
              }                            
              else if ($('#areaContraportada').is(':checked')) {                
                  $('#modalPosicionGrabadoContraPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });     
              } 

              if ($('#areaLomo').is(':checked')) {
                  checkLomo = 1;
              } 
              if ($('#areaContraportada').is(':checked')) {
                  checkContraPortada = 1;
              }        

          });

          /////////////////////////////////////////////
          //    POSICIONES ELEGIDAS DEL GRABADO     //
          ////////////////////////////////////////////

          $('#btnPosicionGrabadoPortada').click(function() {
              posicionPortada = $( "#posicionGrabadoPortada" ).val(); 
              $('#modalCantidadLineasPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });              
          });

          $('#btnPosicionGrabadoLomo').click(function() {
              posicionLomo = $( "#posicionGrabadoLomo" ).val(); 
              $('#modalCantidadLineasLomo').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });              
          }); 

          $('#btnPosicionGrabadoContraPortada').click(function() {
              posicionContraPortada = $( "#posicionGrabadoContraPortada" ).val(); 
              $('#modalCantidadLineasContraPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });              
          });           
  
          /////////////////////////////////////////////
          //    CANTIDAD DE LINEAS DEL GRABADO      //
          ////////////////////////////////////////////

          $('#btnCantidadLineasPortada').click(function() {
              cantidadLineasPortada = $("#cantidadLineasPortada").val();
              $('#modalTipografiaEnPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });
          });
      
          $('#btnCantidadLineasLomo').click(function() {
              cantidadLineasLomo = $( "#cantidadLineasLomo" ).val();
              $('#modalTipografiaEnLomo').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });
          });

          $('#btnCantidadLineasContraPortada').click(function() {
              cantidadLineasContraPortada = $( "#cantidadLineasContraPortada" ).val();
              $('#modalTipografiaEnContraPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });
          });

          /////////////////////////////////////////////
          //         TIPOGRAFIA DEL GRABADO         //
          ////////////////////////////////////////////

          $('#btnTipografiaEnPortada').click(function() {
              tipografiaEnPortada = $( "#tipografiaEnPortada" ).val();
              $('#modalTipoDeGrabadoEnPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });
          });

          $('#btnTipografiaEnLomo').click(function() {
              tipografiaEnLomo = $( "#tipografiaEnLomo" ).val();
              $('#modalTipoDeGrabadoEnLomo').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });
          });

          $('#btnTipografiaEnContraPortada').click(function() {
              tipografiaEnContraPortada = $( "#tipografiaEnContraPortada" ).val();
              $('#modalTipoDeGrabadoEnContraPortada').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });
          });


          /////////////////////////////////////////////
          //             TIPO DE GRABADO            //
          ////////////////////////////////////////////

          $('#btnTipoDeGrabadoEnPortada').click(function() {
              tipoDeGrabadoEnPortada = $( "#tipoDeGrabadoEnPortada").val();
              cantidadLineasPortada = $( "#cantidadLineasPortada").val();
              if(cantidadLineasPortada == 1){
                  $( ".textoPortadaDos" ).hide();   
                  $( ".textoPortadaTres" ).hide();
              }
              else if(cantidadLineasPortada == 2){
                  $( ".textoPortadaTres" ).hide();   
              }

                  $('#modalTextoPortada').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                  });

          });

          $('#btnTipoDeGrabadoEnLomo').click(function() {
              tipoDeGrabadoEnLomo = $( "#tipoDeGrabadoEnLomo").val();               

              $('#modalTextoLomo').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
              });

          });

          $('#btnTipoDeGrabadoEnContraPortada').click(function() {
              tipoDeGrabadoEnContraPortada = $( "#tipoDeGrabadoEnContraPortada").val();
              cantidadLineasContraPortada = $( "#cantidadLineasContraPortada").val();
              if(cantidadLineasContraPortada == 1){
                  $( ".textoContraPortadaDos" ).hide();   
                  $( ".textoContraPortadaTres" ).hide();
              }
              else if(cantidadLineasContraPortada == 2){
                  $( ".textoContraPortadaTres" ).hide();   
              }

                  $('#modalTextoContraPortada').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                  });

          });

          /////////////////////////////////////////////
          //             TEXTO DE GRABADO            //
          ////////////////////////////////////////////

          $('#btnTextoPortada').click(function() {                
          
              textoPortada = $( "#textoPortada" ).val();
              textoPortadaDos = $( "#textoPortadaDos" ).val();
              textoPortadaTres = $( "#textoPortadaTres" ).val();

              if(cantidadLineasPortada == 1 && textoPortada.length == 0){
                  $('#errorMsgPortada').empty();
                  $('<div class="alert alert-danger text-center noExiste"><strong>Rellene los campos vacios.</strong></div>').appendTo($('#errorMsgPortada')).fadeIn(300).delay(1000).fadeOut(1000);
              }
              else if(cantidadLineasPortada == 2){
                  if(textoPortada.length == 0 || textoPortadaDos.length==0){ 
                      $('#errorMsgPortada').empty();
                      $('<div class="alert alert-danger text-center noExiste"><strong>Rellene los campos vacios.</strong></div>').appendTo($('#errorMsgPortada')).fadeIn(300).delay(1000).fadeOut(1000);
                  }
                  else{

                      $('#modalTextoPortada').modal('hide');
                      
                      if(checkLomo==1){
                          $('#modalPosicionGrabadoLomo').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });    
                      }
                      else if(checkContraPortada==1){
                          $('#modalPosicionGrabadoContraPortada').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });    
                      }
                      else{
                          $('#modalTextoPortada').modal('hide');
                          
                          if(<?= $numAlbumesSecundario ?> > 0){   
                              $('#modalRepetirGrabado').modal({  
                                  show:true,
                                  keyboard:false,
                                  backdrop: 'static'
                              });
                          }
                          else{
                              guardarDatosDelGrabado();
                          }
                      }

                  }
              }
              else if(cantidadLineasPortada == 3){
                  if(textoPortada.length == 0 || textoPortadaDos.length==0 || textoPortadaTres.length==0){ 
                      $('#errorMsgPortada').empty();
                      $('<div class="alert alert-danger text-center noExiste"><strong>Rellene los campos vacios.</strong></div>').appendTo($('#errorMsgPortada')).fadeIn(300).delay(1000).fadeOut(1000);
                  }
                  else{

                      $('#modalTextoPortada').modal('hide');
                      
                      if(checkLomo==1){
                          $('#modalPosicionGrabadoLomo').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });    
                      }
                      else if(checkContraPortada==1){
                          $('#modalPosicionGrabadoContraPortada').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });    
                      }
                      else{
                          $('#modalTextoPortada').modal('hide');
                          
                          if(<?= $numAlbumesSecundario ?> > 0){   
                              $('#modalRepetirGrabado').modal({  
                                  show:true,
                                  keyboard:false,
                                  backdrop: 'static'
                              });
                          }
                          else{
                              guardarDatosDelGrabado();
                          }
                      }
                  }
              }
              else{

                  if(checkLomo==1){
                      $('#modalTextoPortada').modal('hide');
                      $('#modalPosicionGrabadoLomo').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });    
                  }
                  else if(checkContraPortada==1){
                      $('#modalTextoPortada').modal('hide');
                      $('#modalPosicionGrabadoContraPortada').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });    
                  }
                  else{

                      $('#modalTextoPortada').modal('hide');
                      
                      if(<?= $numAlbumesSecundario ?> > 0){   
                          $('#modalRepetirGrabado').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });
                      }
                      else{
                          guardarDatosDelGrabado();
                      }
                  }
              }                                    
                      
          });

          $('#btnTextoLomo').click(function() {

              textoLomo = $( "#textoLomo" ).val();

              if(textoLomo.length == 0){
                  $('#errorMsgLomo').empty();
                  $('<div class="alert alert-danger text-center noExiste"><strong>Rellene los campos vacios.</strong></div>').appendTo($('#errorMsgLomo')).fadeIn(300).delay(1000).fadeOut(1000);
              }
              else{

                  $('#modalTextoLomo').modal('hide');

                  if(checkContraPortada == 1){
                      $('#modalPosicionGrabadoContraPortada').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });       
                  }
                  else{
                      $('#modalTextoLomo').modal('hide');
                      
                      if(<?= $numAlbumesSecundario ?> > 0){   
                          $('#modalRepetirGrabado').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });
                      }
                      else{
                          guardarDatosDelGrabado();
                      }
                  }

              }
                      
          });

          $('#btnTextoContraPortada').click(function() {                
          
              textoContraPortada = $( "#textoContraPortada" ).val();
              textoContraPortadaDos = $( "#textoContraPortadaDos" ).val();
              textoContraPortadaTres = $( "#textoContraPortadaTres" ).val();

              if(cantidadLineasContraPortada == 1 && textoContraPortada.length == 0){
                  $('#errorMsgContraPortada').empty();
                  $('<div class="alert alert-danger text-center noExiste"><strong>Rellene los campos vacios.</strong></div>').appendTo($('#errorMsgContraPortada')).fadeIn(300).delay(1000).fadeOut(1000);
              }
              else if(cantidadLineasContraPortada == 2){
                  if(textoContraPortada.length == 0 || textoContraPortadaDos.length==0){ 
                      $('#errorMsgContraPortada').empty();
                      $('<div class="alert alert-danger text-center noExiste"><strong>Rellene los campos vacios.</strong></div>').appendTo($('#errorMsgContraPortada')).fadeIn(300).delay(1000).fadeOut(1000);
                  }
                  else{
                      $('#modalTextoContraPortada').modal('hide');
                      
                      if(<?= $numAlbumesSecundario ?> > 0){   
                          $('#modalRepetirGrabado').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });
                      }
                      else{
                          guardarDatosDelGrabado();
                      }      
                  }
              }
              else if(cantidadLineasContraPortada == 3){
                  if(textoContraPortada.length == 0 || textoContraPortadaDos.length==0 || textoContraPortadaTres.length==0){ 
                      $('#errorMsgContraPortada').empty();
                      $('<div class="alert alert-danger text-center noExiste"><strong>Rellene los campos vacios.</strong></div>').appendTo($('#errorMsgContraPortada')).fadeIn(300).delay(1000).fadeOut(1000);
                  }
                  else{
                      $('#modalTextoContraPortada').modal('hide');
                      
                      if(<?= $numAlbumesSecundario ?> > 0){   
                          $('#modalRepetirGrabado').modal({  
                              show:true,
                              keyboard:false,
                              backdrop: 'static'
                          });
                      }
                      else{
                          guardarDatosDelGrabado();
                      }                      
                  }
              }
              else{
                  $('#modalTextoContraPortada').modal('hide');
                  
                  if(<?= $numAlbumesSecundario ?> > 0){   
                      $('#modalRepetirGrabado').modal({  
                          show:true,
                          keyboard:false,
                          backdrop: 'static'
                      });
                  }
                  else{
                      guardarDatosDelGrabado();
                  }
              }                                    
                      
          });

          function opcionReplicaGrabado(valor){
                  
              if(valor==1){
                  replicarGrabado = 1;
                  $('#modalRepetirGrabado').modal('hide');
                  $('#modalCantidadReplicaDeGrabado').modal({  
                      show:true,
                      keyboard:false,
                      backdrop: 'static'
                  });
              }
              else if(valor==0){
                  replicarGrabado = 0;
                  $('#modalRepetirGrabado').modal('hide');
                  guardarDatosDelGrabado();
              }

          }

          function cantidadDeGrabadosReplicados(){
                  
              cantidadReplicaDeGrabado = $('#cantidadReplicaDeGrabado').val();
              $('#modalCantidadReplicaDeGrabado').modal('hide');
              guardarDatosDelGrabado();

          }

          function guardarDatosDelGrabado(){
                                       
              var parametros = {
                  'function':55,
                  'socio':socio,
                  'tieneGrabado':1,
                  'grabadoEnPortada':checkPortada,
                  'posicionDelGrabadoEnPortada':posicionPortada,
                  'cantidadLineasPortada':cantidadLineasPortada,
                  'tipografiaEnPortada':tipografiaEnPortada,
                  'tipoDeGrabadoEnPortada':tipoDeGrabadoEnPortada,
                  'textoPortada':textoPortada,
                  'textoPortadaDos':textoPortadaDos,
                  'textoPortadaTres':textoPortadaTres,
                  'grabadoEnLomo':checkLomo,
                  'posicionDelGrabadoEnLomo':posicionLomo,
                  'cantidadLineasLomo':cantidadLineasLomo,
                  'tipografiaEnLomo':tipografiaEnLomo,
                  'tipoDeGrabadoEnLomo':tipoDeGrabadoEnLomo,
                  'textoLomo':textoLomo,
                  'grabadoEnContraPortada':checkContraPortada,
                  'posicionDelGrabadoEnContraPortada':posicionContraPortada,
                  'cantidadLineasContraPortada':cantidadLineasContraPortada,
                  'tipografiaEnContraPortada':tipografiaEnContraPortada,
                  'tipoDeGrabadoEnContraPortada':tipoDeGrabadoEnContraPortada,
                  'textoContraPortada':textoContraPortada,
                  'textoContraPortadaDos':textoContraPortadaDos,
                  'textoContraPortadaTres':textoContraPortadaTres,
                  'replicarGrabado': replicarGrabado,
                  'cantidadReplicaDeGrabado': cantidadReplicaDeGrabado,
                  'numAlbumesSecundario': <?= $numAlbumesSecundario ?>,                    
                  'idPedido': <?= $_GET['P'] ?>                        
              }

              $.ajax({
        
                data: parametros,
                url: '/manejadores/manejadorAlbums.php',
                type: 'post',
                dataType: "JSON",
                success: function(data){
                    
                    if(data.status === 'success'){
                        swal({
                            title: "Guardado",
                            text: "Se agrego el Grabado a su pedido!",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonClass: 'btn-success',
                            confirmButtonId: 'especial',
                            cancelButtonText: "Agregar otro accesorio",
                            confirmButtonText: "Continuar",

                        },
                        function(isConfirm){
                            if (isConfirm) {
                                //Aqui tenemos que guardar los datos antes de ir al ticket
                                guardar();
                            }
                            else{

                                if($('#fotoEstuchesPrincipal').val() != 0){

                                    var cantidad = 0;
                                    if(checkPortada==1){
                                        cantidad = cantidad+1;
                                    }
                                    if(checkLomo==1){
                                        cantidad = cantidad+1;
                                    }
                                    if(checkContraPortada==1){
                                        cantidad = cantidad+1;
                                    }
                                    
                                    var listado =   '<a href="#" class="list-group-item clearfix" id="liGrabadoPrincipal">'+
                                                        'Grabado para álbum principal'+
                                                        '<span class="pull-right">'+
                                                            '<button class="btn btn-xs btn-info">'+cantidad+'</button>'+
                                                            '<button class="btn btn-xs btn-success">$'+(data.precio)+'</button>'+
                                                            '<button class="btn btn-xs btn-danger" onClick="eliminarGrabado();">'+
                                                                '<span class="glyphicon glyphicon-trash"></span>'+
                                                            '</button>'+
                                                        '</span>'+
                                                    '</a>';

                                    $('#liGrabadoPrincipal').remove();
                                    $('#listaDeAccesoriosPedidos').append(listado);
                                }

                            }
                           
                        });
                    }
                    else{

                        alert('upss!! Existe un error en el sistema')
                    }
                },

                error: function(jqXHR, textStatus, errorThrown) {
                  console.log(jqXHR);
                  console.log(textStatus);
                  console.log(errorThrown);
                }   
                
              });

          }

          function eliminarGrabado(){

              swal({
                  title: "Estas seguro",
                  text: "Se eliminara el Grabado para este pedido!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false

              },
              function(isConfirm){
                  if (isConfirm) {
                      
                      var parametros = {
                          'function':56,
                          'idPedido' : <?= $idPedido ?>,
                      };

                      $.ajax({
                          data: parametros,
                          url: '/manejadores/manejadorAlbums.php',
                          type: 'post',
                          dataType : 'JSON',
                          beforeSend: function() {
                              $('#modalGuardando').modal({
                                  show:true,
                                  keyboard:false,
                                  backdrop:false
                              });
                          },
                          success: function(data) {

                              $('#modalGuardando').modal('hide');

                              if(data.status == 'success'){
                                  swal("Eliminado!", "Los Grabados del album principal fueron eliminados.", "success"); 
                                  $('#liGrabadoPrincipal').remove();
                              }
                              else{
                                  alert('Upss!! hubo un error en el sistema');
                              }
                             
                             
                             
                          }
                      });
                  
                  }
                  else{

                       swal("Cancelado", "Tu estuche sigue guardado en tu pedido.", "error");

                  } 

                 
              });
          } 

          function subidorDeArchivosContraPortada(idProducto,nombreDeFoto){

                   
              var parametros = {
                  "idPedido" : <?= $_GET['P'] ?>,
                  "carpeta" : '<?= $carpeta ?>',
                  "tamano": <?= $idTamano ?>,
                  "idProducto" : idProducto,
                  "idUsuario" : idUser,
                  "idSocio" :  <?= $boot->socio ?>,
                  "medioDeCompresion" : 2,
                  "servicio": <?= $servicio ?>,
                  "categoriaDeProducto":3,
                  "espacioDeColor":3
              };

              $.ajax({
                  data: parametros,
                  url: '/SubidorProcesoImpresiones.php',
                  type: 'post',
                  beforeSend: function() {
                      $('#ModalCargando').modal({
                          show:true,
                          keyboard:false,
                          backdrop:false
                      }); 
                  },
                  success: function(data) {
                      $('#SubidorArchivosContraPortada').empty();
                      $('#SubidorArchivosContraPortada').append(data);
                  }
              });


          }


          function subidorDeArchivos(idProducto,nombreDeFoto){

                   
              var parametros = {
                  "idPedido" : <?= $_GET['P'] ?>,
                  "carpeta" : '<?= $carpeta ?>',
                  "tamano": <?= $idTamano ?>,
                  "idProducto" : idProducto,
                  "idUsuario" : idUser,
                  "idSocio" :  <?= $boot->socio ?>,
                  "medioDeCompresion" : 2,
                  "servicio": <?= $servicio ?>,
                  "categoriaDeProducto":3,
                  "espacioDeColor":3
              };

              $.ajax({
                  data: parametros,
                  url: '/SubidorProcesoImpresiones.php',
                  type: 'post',
                  beforeSend: function() {
                      $('#ModalCargando').modal({
                          show:true,
                          keyboard:false,
                          backdrop:false
                      }); 
                  },
                  success: function(data) {
                      $('#SubidorArchivos').empty();
                      $('#cajaSubidor').show();
                      $('#ModalCargando').modal("hide");
                      $('#SubidorArchivos').append(data);
                  }
              });


          }


          function subidorDeArchivosFotoBoxPortada(idProducto,nombreDeFoto){
              var parametros = {
                  "idPedido" : <?= $_GET['P'] ?>,
                  "carpeta" : '<?= $carpeta ?>',
                  "tamano": <?= $idTamano ?>,
                  "idProducto" : idProducto,
                  "idUsuario" : idUser,
                  "idSocio" :  <?= $boot->socio ?>,
                  "medioDeCompresion" : 2,
                  "servicio": <?= $servicio ?>,
                  "categoriaDeProducto":3,
                  "espacioDeColor":3
              };
              $.ajax({
                  data: parametros,
                  url: '/SubidorProcesoImpresiones.php',
                  type: 'post',
                  beforeSend: function() {
                      $('#ModalCargando').modal({
                          show:true,
                          keyboard:false,
                          backdrop:false
                      }); 
                  },
                  success: function(data) {
                      $('#cajaFotoBoxSubidorPortada').empty();
                      $('#cajaFotoBoxSubidorPortada').append(data);
                      $('#ModalCargando').modal("hide");
                  }
              });


          }

          function subidorDeArchivosFotoBoxInterna(idProducto,nombreDeFoto){

                   
              var parametros = {

                  "idPedido" : <?= $_GET['P'] ?>,
                  "carpeta" : '<?= $carpeta ?>',
                  "tamano": <?= $idTamano ?>,
                  "idProducto" : idProducto,
                  "idUsuario" : idUser,
                  "idSocio" :  <?= $boot->socio ?>,
                  "medioDeCompresion" : 2,
                  "servicio": <?= $servicio ?>,
                  "categoriaDeProducto":3,
                  "espacioDeColor":3
              };

              $.ajax({
                  data: parametros,
                  url: '/SubidorProcesoImpresiones.php',
                  type: 'post',
                  beforeSend: function() {
                      $('#ModalCargando').modal({
                          show:true,
                          keyboard:false,
                          backdrop:false
                      }); 
                  },
                  success: function(data) {
                      $('#cajaFotoBoxSubidorInterior').empty();
                     
                      $('#cajaFotoBoxSubidorInterior').append(data);
                      $('#ModalCargando').modal("hide");
                  }
              });


          }


          function subidorDeArchivosFotoBoxContraPortada(idProducto,nombreDeFoto){

                   
              var parametros = {
                  "idPedido" : <?= $_GET['P'] ?>,
                  "carpeta" : '<?= $carpeta ?>',
                  "tamano": <?= $idTamano ?>,
                  "idProducto" : idProducto,
                  "idUsuario" : idUser,
                  "idSocio" :  <?= $boot->socio ?>,
                  "medioDeCompresion" : 2,
                  "servicio": <?= $servicio ?>,
                  "categoriaDeProducto":3,
                  "espacioDeColor":3
              };

              $.ajax({
                  data: parametros,
                  url: '/SubidorProcesoImpresiones.php',
                  type: 'post',
                  beforeSend: function() {
                      $('#ModalCargando').modal({
                          show:true,
                          keyboard:false,
                          backdrop:false
                      }); 
                  },
                  success: function(data) {
                      $('#cajaFotoBoxSubidorContraPortada').empty();
                     
                      $('#cajaFotoBoxSubidorContraPortada').append(data);
                      $('#ModalCargando').modal("hide");
                  }
              });


          }


          
          $('#continuarSubidaDeContraPortadaFotoEstuche').click(function() {

              $('#modalSubidorContraPortada').modal('hide');
              
               


             

             

              var idProducto = 29;
              var parametros = {
                  "carpeta" : '<?= $carpeta ?>',
                  "idProducto" : idProducto,
                  "Product" : '<?= $_GET['Product'] ?>',
                  "idSocio" :  <?= $boot->socio ?>,
                  "idUser" : idUser,
                  "IdTamano": <?= $idTamano ?>,
                  "Compresion" : 2,
                  "Servicio": <?= $servicio ?>,
                  "IdPedido" : <?= $_GET['P'] ?>,
                  "RenombreArchivos" : 0,
                  "resize" : 1,
                  'idCropper' : '<?= $idCropperContraPortada ?>'
              };

              var altoDeFotoEstuche =  (<?= $alto ?>+.5);
              var anchoDeFotoEstuche = (<?= $ancho ?>/2)+.5;

              var altoDeCorte = altoDeFotoEstuche;
              var anchoDeCorte = anchoDeFotoEstuche;

              if(altoDeFotoEstuche>anchoDeFotoEstuche){

                  altoDeCorte = anchoDeFotoEstuche;
                  anchoDeCorte = altoDeFotoEstuche;


              }



              $.ajax({
                  data: parametros,
                  url: '/cropKiosco/cropAccesoriosAlbumes.php',
                  type: 'post',
                  success: function(data) {
                      $('#imgCropContraPortadaFotoEstuche').empty().append(data);

                          $('#modalCropContraPortadaFotoEstuche').modal({  
                              show:true,
                              keyboard:false,
                              backdrop:false
                          });

                          $(function () {
                              var $image = $('#<?= $idCropperContraPortada ?>');
                              var cropBoxData;
                              var canvasData;
                              $('#modalCropContraPortadaFotoEstuche').on('shown.bs.modal', function () {
                                  $image.cropper({
                                      autoCropArea:1,
                                      aspectRatio: altoDeCorte / anchoDeCorte,
                                      cropBoxMovable: false,
                                      cropBoxResizable: false,
                                      strict: true,
                                      dragCrop: false,

                                      built: function () {
                                          $image.cropper('setCanvasData', canvasData);
                                          $image.cropper('setCropBoxData', cropBoxData);
                                      }
                                  });
                              }).on('hidden.bs.modal', function () {
                                  cropBoxData = $image.cropper('getCropBoxData');
                                  canvasData = $image.cropper('getCanvasData');
                                  $image.cropper('destroy');
                              });
                          });

                     
                  }
              });


              
      

          });


          $( ".recorteCropContraPortadaFotoEstuche" ).click(function() {
              

              $('#modalGuardando').modal({  
                  show:true,
                  keyboard:false,
                  backdrop: 'static'
              });

              var data = [];

              $( "#imgCropContraPortadaFotoEstuche > img" ).each(function( key,index ){
              

                  var altoDeFotoEstuche =  (<?= $alto ?>+.5);
                  var anchoDeFotoEstuche = ((<?= $ancho ?>/2)+.5);

                  var altoDeCorte = altoDeFotoEstuche;
                  var anchoDeCorte = anchoDeFotoEstuche;

                  if(altoDeFotoEstuche>anchoDeFotoEstuche){

                      altoDeCorte = anchoDeFotoEstuche;
                      anchoDeCorte = altoDeFotoEstuche;


                  }


                  var idSocio = <?= $boot->socio ?>;
                  var id = index.id;
                  var img_data = $("#"+id).cropper("getData");
                  var NombreDeImagen = $('#'+id).data('name');
                  var imgName = $('#'+id).data('name');
                  var imgPath = '<?php echo $rutaCropContraPortadaFotoEstuche?>/'+imgName;
                  var altoOrginal = $(this).data('height');
                  var anchoOrginal = $(this).data('width');
                  var altoPreview =  $(this).data('altopreview');
                  var anchoPreview =  $(this).data('anchopreview');


                  var parametroRecorte = {
                      'src':imgPath,
                      'imgName':NombreDeImagen,
                      'ancho':anchoDeCorte,
                      'alto':altoDeCorte,
                      'ruta':'<?php echo $rutaCropContraPortadaFotoEstuche ?>',
                      'width':img_data.width,
                      'height':img_data.height,
                      'x':img_data.x,
                      'y':img_data.y,
                      'rotate':img_data.rotate,
                      'anchoOriginal':anchoOrginal,
                      'altoOriginal':altoOrginal,
                      'anchoPreview':anchoPreview,
                      'altoPreview':altoPreview,
                      'idSocio':idSocio,
                      'idProducto':25,
                      'nombreDeImagen':NombreDeImagen
                
                  };
                
                  data.push(parametroRecorte);
                  var parametros = {
                      'data':data
                  };

                  console.log(JSON.stringify(parametros,null,4))

                  $.ajax({
                      data: parametros,
                      url: '/cropKiosco/recorteKiosco.php',
                      type: 'post',
                      success: function(data) {
                        
                 
                          $('#modalGuardando').modal('hide');
                          $('#modalCropContraPortadaFotoEstuche').modal('hide');


                          $('#modalCantidadDeFotoEstuche').modal({

                              show:true,
                              keyboard:false,
                              backdrop: 'static'

                          });


                              


                         
                 
                      },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log(jqXHR);
                      console.log(textStatus);
                      console.log(errorThrown);
                  }
         

              });



            });

            
            
          });

          $('#guardarFotoEstuche').click(function() {

              if($('#fotoEstuchesPrincipal').val()== 0 && $('#fotoEstuchesSecundario').val() == 0){

                  $('<div  class="alert alert-error">Debe elegir por lo menos un foto estuche</div>').appendTo($('#errorNumFotoEstuche')).fadeIn(300).delay(3000).fadeOut(500);

              }
              else{

              

                  $('#modalCantidadDeFotoEstuche').modal('hide');

                  var parametros = {
                      'function':31,
                      'socio':socio,
                      'idPedido':<?= $idPedido ?>,
                      'tipoDeFotoEstuche':tipoDeFotoEstuche,
                      'fotoEstuchesPrincipal':$('#fotoEstuchesPrincipal').val(),
                      'fotoEstuchesSecundario':$('#fotoEstuchesSecundario').val(),
                      'alto':<?= $alto ?>,
                      'altoSecundario':<?= $altoSecundario ?>,
                      'numAlbumesSecundario':<?= $numAlbumesSecundario ?>,
                      'tipoDeSubidaFotoEstuche':$( "#portadaAUsarFotoEstuche" ).val(),
                      'tipoDeSubidaContraPortadaParaFotoEstuche':tipoDeSubidaContraPortadaParaFotoEstuche

                  }

                  $.ajax({
            
                    data: parametros,
                    url: '/manejadores/manejadorAlbums.php',
                    type: 'post',
                    dataType: "JSON",
                    
                      success: function(data){
                          
                          if(data.status === 'success'){
                              swal({
                                  title: "Guardado",
                                  text: "Se agrego el accesorio Foto estuche!",
                                  type: "success",
                                  showCancelButton: true,
                                  confirmButtonClass: 'btn-success',
                                  confirmButtonId: 'especial',
                                  cancelButtonText: "Agregar otro accesorio",
                                  confirmButtonText: "Continuar",

                              },
                              function(isConfirm){
                                  if (isConfirm) {

                                      //Aqui tenemos que guardar los datos antes de ir al ticket

                                      guardar();
                                  
                                  }
                                  else{



                                          if($('#fotoEstuchesPrincipal').val() != 0){


                                              var fotoEstuches = $('#fotoEstuchesPrincipal').val();
                                              var precioPorFotoEstuchePrincipal =  $('#priceFotoEstuchePrincipal').text();

                                              if(tipoDeFotoEstuche == 2){

                                                  precioPorFotoEstuchePrincipal = <?= $precioPorFotoEstucheConContraPortadaPrincipal ?>;

                                              }

                                             
                                             

                                              var listado =   '<a href="#" class="list-group-item clearfix" id="liFotoEstuchePrimario">'+
                                                                  'Foto estuches para álbum principal'+
                                                                  '<span class="pull-right">'+
                                                                      '<button class="btn btn-xs btn-info">'+fotoEstuches+'</button>'+
                                                                      '<button class="btn btn-xs btn-success">$'+(precioPorFotoEstuchePrincipal*fotoEstuches)+'</button>'+
                                                                      '<button class="btn btn-xs btn-danger" onClick="eliminarFotoEstuchePrincipal();">'+
                                                                          '<span class="glyphicon glyphicon-trash"></span>'+
                                                                      '</button>'+
                                                                  '</span>'+
                                                              '</a>';

                                              $('#liFotoEstuchePrimario').remove();
                                              $('#listaDeAccesoriosPedidos').append(listado);
                                          }

                                          if($('#fotoEstuchesSecundario').val() != 0){





                                              var fotoEstuches = $('#fotoEstuchesSecundario').val();
                                              var precioPorFotoEstucheSecundario =  $('#priceFotoEstucheSecundario').text();
                                             
                                              if(tipoDeFotoEstuche == 2){

                                                  precioPorFotoEstucheSecundario = <?= $precioPorFotoEstucheConContraPortadaSecundario ?>;

                                              }



                                              var listado =   '<a href="#" class="list-group-item clearfix" id="liFotoEstucheSecundario">'+
                                                                  'Foto estuches para álbum extra'+
                                                                  '<span class="pull-right">'+
                                                                      '<button class="btn btn-xs btn-info">'+fotoEstuches+'</button>'+
                                                                      '<button class="btn btn-xs btn-success">$'+(precioPorFotoEstucheSecundario*fotoEstuches)+'</button>'+
                                                                      '<button class="btn btn-xs btn-danger" onClick="eliminarFotoEstucheSecundario();">'+
                                                                          '<span class="glyphicon glyphicon-trash"></span>'+
                                                                      '</button>'+
                                                                  '</span>'+
                                                              '</a>';

                                              $('#liFotoEstucheSecundario').remove();
                                              $('#listaDeAccesoriosPedidos').append(listado);





                                          }

                                  } 

                                 
                              });
                          }
                          else{

                              alert('upss!! Existe un error en el sistema')
                          }
                      },

                      error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                      }
                    
                  });

              }

              
          });
     


          $('#guardarEstuche').click(function() {


              if($('#estuchesPrincipal').val()== 0 && $('#estuchesSecundario').val() == 0){

                  $('<div  class="alert alert-error">Debe elegir por lo menos un  estuche</div>').appendTo($('#errorNumEstuche')).fadeIn(300).delay(3000).fadeOut(500);

              }
              else{


                  $('#modalEstuche').modal('hide');

                  var parametros = {
                      'function':30,
                      'socio':socio,
                      'idPedido':<?= $idPedido ?>,
                      'estuchesPrincipal':$('#estuchesPrincipal').val(),
                      'estuchesSecundario':$('#estuchesSecundario').val(),
                      'alto':<?= $alto ?>,
                      'altoSecundario':<?= $altoSecundario ?>,
                      'numAlbumesSecundario':<?= $numAlbumesSecundario ?>

                  }

                  $.ajax({
            
                    data: parametros,
                    url: '/manejadores/manejadorAlbums.php',
                    type: 'post',
                    dataType: "JSON",
                    
                      success: function(data){
                          
                          if(data.status === 'success'){
                              swal({
                                  title: "Guardado",
                                  text: "Se agrego el accesorio estuche!",
                                  type: "success",
                                  showCancelButton: true,
                                  confirmButtonClass: 'btn-success',
                                  confirmButtonId: 'especial',
                                  cancelButtonText: "Agregar otro accesorio",
                                  confirmButtonText: "Continuar",

                              },
                              function(isConfirm){
                                  if (isConfirm) {
                                      guardar();
                                      
                                  
                                  } 
                                  else{


                                      if($('#estuchesPrincipal').val() != 0){


                                          var estuches = $('#estuchesPrincipal').val();
                                          var precioPorEstuchePrincipal =  $('#precioEstuchePrincipal').text();
                                         

                                          var listado =   '<a href="#" class="list-group-item clearfix" id="liEstuchePrimario">'+
                                                              'Estuches para álbum principal'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+estuches+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioPorEstuchePrincipal*estuches)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarEstuchePrincipal();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liEstuchePrimario').remove();

                                          $('#listaDeAccesoriosPedidos').append(listado);

                                      }
                                      if($('#estuchesSecundario').val() != 0){


                                          var estuches = $('#estuchesSecundario').val();
                                          var precioPorEstucheSecundario =  $('#precioEstucheSecundario').text();

                                          var listado = ' <a href="#" class="list-group-item clearfix" id="liEstucheSecundario">'+
                                                              'Estuches para álbum extra'+
                                                              '<span class="pull-right">'+
                                                                  '<button class="btn btn-xs btn-info">'+estuches+'</button>'+
                                                                  '<button class="btn btn-xs btn-success">$'+(precioPorEstucheSecundario*estuches)+'</button>'+
                                                                  '<button class="btn btn-xs btn-danger" onClick="eliminarEstucheSecundario();">'+
                                                                      '<span class="glyphicon glyphicon-trash"></span>'+
                                                                  '</button>'+
                                                              '</span>'+
                                                          '</a>';

                                          $('#liEstucheSecundario').remove();               

                                          $('#listaDeAccesoriosPedidos').append(listado);



                                      }


                                     
                                     
                                  

                                  }

                                 
                              });
                          }
                          else{

                              alert('upss!! Existe un error en el sistema')
                          }
                      },

                      error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                      }
                    
                  });

              }

              
          });


          function guardar(){
              
              var parametros = {
                'function':26,
                'idSocio':<?= $boot->socio ?>,
                'idProducto': <?= $_GET['Producto'] ?>,
                'idPedidoAlbumes':<?= $idPedido?>,
                'usuario' : idUser,
                'producto':'<?= $nombreDeAlbum ?>'                
              }

              $('#ModalGuardando').modal({  
                  show:true,
                  keyboard:true,
                  backdrop:true
              });
             
              $.ajax({
            
                  data: parametros,
                  url: '/manejadores/manejadorAlbums.php',
                  type: 'post',
                  dataType: "text",
                    
                  success: function(data){
                      
                      location.href = "../tickets/ticket.php?product=<?= $_GET['Producto']; ?>&pedido=<?= $idPedido; ?>";
                  },

                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                  }
                
              });

          } 
  
      </script>
     
  </body>
  
</html>    	