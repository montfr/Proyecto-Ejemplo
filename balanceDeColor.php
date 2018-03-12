<?php
session_start();
$esProceso = 0;

require('ClaseInicial.php');
$ObjInicial = new Inicial();

$ObjInicial->ProbarCookie($_SERVER['REQUEST_URI']);

$Resultado = $ObjInicial->DatosDeSocio($_SERVER['HTTP_HOST']);

header($ObjInicial->CharSet($Resultado['CharSet']));


require 'FuncionesImpresiones.php';
$ObjFunciones = new Funciones($ObjInicial->getConexion());


require('FuncionesVinetas.php');
$ObjVinetas = new Vinetas();


require_once './FuncionesPrincipales.php'; 
$ObjSinfonia = new Sinfonia();


$Producto = $_GET['idProducto'];
$idPedido = $_GET['P'];



$productData = $ObjSinfonia->get_product_data($ObjInicial->getConexion(),$Producto,$idPedido);



$NombreDeCarpeta = $productData['carpeta']; 
$tipoDeAjuste = $productData['tipoDeAjuste'];
$tipoDeRetoque = $productData['tipoDeRetoque'];

$nombreDeBastidor = "";
$nombreDeMosaico = "";
switch ($Producto) {
  case 21:
  case 22:
  case 23:
  case 24:
  case 25:
  case 26:
  case 27:
  case 28:
  case 30:
  case 31:
  case 32:
  case 33:
  case 34:
  case 35:
  case 36:
  case 37:
  case 38:
  case 39:
  case 40:
  case 41:
  case 42:
  case 43:
  case 44:
  case 45:
  case 46:
  case 47:
  case 48:

    require('./clases/class.bastidores.php');
    $objBastidores = new bastidores($ObjInicial->getConexion(),$ObjInicial->getConexionOnline());


    $nombreDeBastidor = $objBastidores->getBastidorName($Producto);
  break;


  case 50:



    $nombreMosaico = 'Mosaico';

  break;
 
}




$per_page = 6;
$page = $_GET['page'];
$has_previous = false;
$has_next = false;

function randStrGen($len){
  $result = "";
  $chars = "abcdefghijklmnopqrstuvwxyz";
  $charArray = str_split($chars);
  for($i = 0; $i < $len; $i++){
    $randItem = array_rand($charArray);
    $result .= "".$charArray[$randItem];
  }
  return $result;

}

function showPictures($rutaMiniatura,$rutaOriginal,$tipoDeAjuste){
  global $page, $per_page, $has_previous, $has_next;
  
    if ( $handle = opendir($rutaMiniatura)) {
           $lightbox = rand();
        
           $count = 0;
           $skip = $page * $per_page;
    if ( $skip != 0 )
         $has_previous = true;

    while ( $count < $skip && ($file = readdir($handle)) !== false ){
  
      if ( !is_dir($file) && ($type = showPictureType($file)) != '' )
         $count++;
    }
     
      $count = 0;
         
      while ( $count < $per_page && ($file = readdir($handle)) !== false ){
         
         if ( !is_dir($file) && ($type = showPictureType($file)) != '' ) {

            $fecha = new DateTime();

            
            $nombreOriginal = $file;

            $foto = $file.'?'.$fecha->getTimestamp();
           
            $id = randStrGen(3);
          
            ?>

              <div class="col-md-12 " id="box-<?php echo $id?>" >
                <div class="thumbnail">
                  
                  <div>
                    <button data-toggle="tooltip" title="Regresar a original" type="button" class="close pull-left reload" data-id="<?php echo $id?>" data-name="<?php echo $nombreOriginal?>" data-src="<?php echo $rutaOriginal.'/'.$nombreOriginal?>" data-source="<?php echo $rutaMiniatura.'/'.$nombreOriginal?>"><i class="fa fa-refresh"></i></button>
                   
                    <div class="clearfix"></div>
                    
                  </div>
                 
              
                  <hr style="margin-top:.2em;">

                  <div class="cropperContainer" >
                    <img  class=" center-block foto"  id="<?php echo $id?>" data-name="<?php echo $nombreOriginal?>" src="<?php echo $rutaMiniatura.'/'.$foto;    ?>" alt="Picture" >
                  </div>

                  <hr>

                  <div class="panel-footer" style="margin-top:-1em;">
                          
                    

                         
                    <?php

                   
                      if($tipoDeAjuste==1){
                        ?>
                          <div class="row " style="color:black;">
                            <div class="col-md-1 col-md-offset-2 "  >
                              <label for="demo_vertical2">Rojo</label> 
                              <input class="red-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="red" name="red" data-id="<?php echo $id?>">
                            </div>

                            <div class="col-md-1">
                              <label for="demo_vertical2">Verde</label> 
                              <input class="green-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="green" name="green" data-id="<?php echo $id?>">
                            </div>

                            <div class="col-md-1">
                              <label for="demo_vertical2">Azul</label> 
                              <input class="blue-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="blue" name="blue" data-id="<?php echo $id?>">
                            </div>

                            <div class="col-md-1">
                              <label for="demo_vertical2">Brillo</label> 
                              <input class="brillo-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="brillo" name="brillo" data-id="<?php echo $id?>">
                            </div>


                            <div class="col-md-1 ">
                              <label for="demo_vertical2">Contraste</label> 
                              <input class="contraste-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="contraste" name="contraste" data-id="<?php echo $id?>">
                            </div>

                            <div class="col-md-1">
                              <label for="demo_vertical2">Densidad</label> 
                              <input class="densidad-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="densidad" name="densidad" data-id="<?php echo $id?>">
                            </div>


                            <div class="col-md-3 ">
                              <label for="demo_vertical2">Efectos</label> 
                              <select  class="selectEfectos  efectos-<?php echo $id?> form-control input-sm" data-id="<?php echo $id?>" autocomplete=off>
                                
                                <option value="0">Normal</option>
                                <option value="5">Blanco y Negro</option>
                                <option value="6">Sepia</option>
                                <option value="1">Vintage</option>
                                <option value="2">Lomo</option>
                                <!--<option value="3">Clarity</option>-->
                                <option value="4">Sin City</option>
                                <option value="7">Sun Rise</option>
                                <option value="8">Nostalgia</option>

                              </select>
                            </div>
                          </div> 
                        <?php
                      }
                      else{
                        
                        ?>

                          <div class="hidden">
                            <div class="col-md-3 "  >
                              <label for="demo_vertical2">Rojo</label> 
                              <input class="red-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="red" name="red" data-id="<?php echo $id?>">
                            </div>

                            <div class="col-md-3">
                              <label for="demo_vertical2">Verde</label> 
                              <input class="green-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="green" name="green" data-id="<?php echo $id?>">
                            </div>

                            <div class="col-md-3">
                              <label for="demo_vertical2">Azul</label> 
                              <input class="blue-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="blue" name="blue" data-id="<?php echo $id?>">
                            </div>

                            <div class="col-md-3">
                              <label for="demo_vertical2">Brillo</label> 
                              <input class="brillo-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="brillo" name="brillo" data-id="<?php echo $id?>">
                            </div>


                            <div class="col-md-3 " style="display:none">
                              <label for="demo_vertical2">Contraste</label> 
                              <input class="contraste-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="contraste" name="contraste" data-id="<?php echo $id?>">
                            </div>


                          </div>


                          <div class="row " style="color:black;">
                            <div class="col-md-3 col-md-offset-4">
                              <label for="demo_vertical2">Densidad</label> 
                             <input class="densidad-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="densidad" name="densidad" data-id="<?php echo $id?>">
                            </div>


                            <div class="col-md-7 hidden">
                              <label for="demo_vertical2">Efectos</label> 
                              <select  class="selectEfectos  efectos-<?php echo $id?> form-control input-sm" data-id="<?php echo $id?>">
                                
                                <option value="0">Normal</option>
                                <option value="5">Blanco y Negro</option>
                                <option value="6">Sepia</option>
                                <option value="1">Vintage</option>
                                <option value="2">Lomo</option>
                                <!--<option value="3">Clarity</option>-->
                                <option value="4">Sin City</option>
                                <option value="7">Sun Rise</option>
                                <option value="8">Nostalgia</option>

                              </select>
                            </div>
                          </div>

                          <hr>
                        
                        <?php
                          
                      }
                    

                    ?>
                        
                    
                     

                 
                     
                    <div class="clearfix"></div>

                          
                  </div>



                </div>  



              </div>
          




            <?php
          
          
           $count++;
        }
      }
         
   
         

      while ( ($file = readdir($handle)) !== false ) {
         
        if ( !is_dir($file) && ($type = showPictureType($file)) != '' ){
              $has_next = true;
                break;
          }
      }
  }

}

function showPictureType($file){
  $split = explode('.', $file);
  $ext = $split[count($split) - 1];
         
  if ( preg_match('/jpg|jpeg/i', $ext) ){
    return 'jpg';
  }
  
  else if ( preg_match('/png/i', $ext) ){
    return 'png';
    }
          
  else if ( preg_match('/gif/i', $ext) ){
    return 'gif';
    }
  
  else{
    return '';
  }

}

if($Resultado['esIndividual'] == 0){


  $idSocioGenerico = 2;
}
else{

  $idSocioGenerico = $Resultado['IdSocio'];

}


?>
<!DOCTYPE html>
<html lang="<?php echo $Resultado['language'];?>">
  <head>
    <?php 

      $ObjInicial->Header('Proceso Impresiones',$Resultado['IdSocio']);
          
    ?>     

    <link href="./css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" media="all">
    <style>

      .cropperContainer {
        
        /*max-width: 100%;
        
        height: 265px;
        background: #6C7A89;
        margin-top: -1em;*/
       background: #DADFE1;

      }


      .cropperContainer >img {
        
        
        padding-top: -1em;
       

      }


      .cropperContainer >canvas{

        /*max-width: 90%;
        max-height: 265px;
        padding-top: -1em;*/

      }
      .foto{

        /*max-width: 90%;
        max-height: 265px;
        padding-top: -1em;*/

      }

      .jcrop-centered{
        display: inline-block;
      }
          
      .crop-image-wrapper{
        text-align: center;
      }

      
      .col-condensed {
        margin-left: 0px;
        margin-right: 0px;
        div[class^="col-"]{
          padding-left: 0px;
          padding-right: 0px;
        }
      }
          

    </style>

  </head>


  <body>
   
    <?php

      $ObjInicial->CargarCabeza($Resultado['IdSocio'],$idSocioGenerico,$Resultado['CompaniaSlogan'],$Resultado['NombreDeCompania'],$Resultado['language']);
     
    ?>

    <div id="sb-site"  >

      <input type="hidden" id="refreshed" value="no">

  
  

      <div style="margin: 1em auto; min-height:1200px;" class="container">

        
        <div class="page-header">
              
          <h1>Balance de color y densidad <button id="guardar"  type="button" class="btn btn-circle btn-lg pull-right" > </i></button></h1>
              
          <br>
          
          

          <i id="spinner" class="fa fa-cog fa-5x pull-right hidden"></i>

          <div class="clearfix"></div>

        </div>


        <div class="row">

          <?php

            $rutaOriginal =  'pedidos/'.$Resultado['IdSocio'].'/'.$_GET['idProducto'].'/'.$_SESSION['iduser'].'/'.$NombreDeCarpeta.'/recortadas';

            $rutaMiniatura =  'pedidos/'.$Resultado['IdSocio'].'/'.$_GET['idProducto'].'/'.$_SESSION['iduser'].'/'.$NombreDeCarpeta.'/recortadas-miniaturas';

            showPictures($rutaMiniatura,$rutaOriginal,$tipoDeAjuste);

          ?>
        
          

        </div>

      



        <div id="contenedorImgTemporal" class="hidden"></div>

          <canvas id="canvas-id" class="hidden"></canvas>

        </div>        

     
      <?php

        $ObjInicial->getFooter($Resultado['IdSocio'],$Resultado['NombreDeCompania'],$Resultado['Direccion'],$Resultado['Telefono1']);

        $ObjInicial->Scripts(1,1,$Resultado['IdSocio'],$Resultado['IdParnerEditor'],0);
       
      ?>


    </div>

    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="text-center">
              <i class="fa fa-cog fa-spin fa-5x"></i>
              <h4>Procesando... </h4>
              
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="modal modal-static fade" id="guardando-modal" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="text-center">
              <i class="fa fa-cog fa-spin fa-5x"></i>
              <h4>Guardando... Por favor espere </h4>
              <br>
              <div class="progress" style="display:none">
                <div id="barra" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="2" style="width: 0%;">
                  
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div id="modalEliminar"  class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Aviso</h4>
          </div>
          <div class="modal-body">
            <p>Esta seguro que desea eliminar la imagen&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button id="eliminar" data-id="" data-src="" data-Miniatura="" data-name="" type="button" class="btn btn-danger">Borrar</button>
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript" src="js/caman.full.js"></script>
    <script src="./js/jquery.bootstrap-touchspin.min.js"></script>

    <script type="text/javascript">




    </script>
    <script type="text/javascript">

      
      onload=function(){
        var e=document.getElementById("refreshed");
        if(e.value=="no")e.value="yes";
        else{e.value="no";location.reload();}
      }


      


      $('[data-toggle="tooltip"]').tooltip();
      $('.filtro').change(applyFilters); 

      <?php
        if($has_next ){
          ?>

            $('#guardar').html('<i class="fa fa-angle-double-right">').addClass('btn-primary');

          <?php  
        }
        else{

          ?>

            $('#guardar').html(' <i class="fa fa-check"></i>').addClass('btn-success');
          
          <?php  

        }
      ?>          
      

      $(".filtro").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'glyphicon glyphicon-plus',
        verticaldownclass: 'glyphicon glyphicon-minus',
        min:-100,
        max:100,
        step:5
      });


      $(".selectEfectos").change(function(){


        var id = $(this).data('id');
        var efecto = parseInt($(this).val());

        switch(efecto){

          case 0:
            //Normal
            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.render();
            });
         

            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);

          break;

          case 1:
            //vintage
            
            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.greyscale();
              this.contrast(5);
              this.noise(3);
              this.sepia(100);
              this.channels({red:8,blue:2,green:4});
              this.gamma(0.87);
              this.render();
            });


            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);



          break;


          case 2:
            //LOMO


            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.brightness(15);
              this.curves("rgb",[0,0],[200,0],[155,255],[255,255]);
              this.saturation(-20);
              this.gamma(1.8);
              this.render();
            });


           



            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);


          break;

          case 3:
            //clarity

            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.vibrance(20);
              this.curves("rgb",[5,0],[130,150],[190,220],[250,255]);
              this.sharpen(15);
              this.vignette("45%",20)
              this.render();
            });

            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);



          break;


          case 4:
            //Sin city

            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.contrast(100);
              this.brightness(15);
              this.exposure(10);
              this.posterize(80);
              this.clip(30);
              this.greyscale();
              this.render();
            });

            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);



          break;

          case 5:
            //Blanco y negro

            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.greyscale();
              this.render();
            });

            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);



          break;  


          case 6:
            //sepia

            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.sepia(100);
              this.render();
            });

            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);



          break;  


          case 7:
            //sun rise

            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.exposure(3.5);
              this.saturation(-5);
              this.vibrance(50);
              this.sepia(60);
              this.colorize("#e87b22",10);
              this.channels({red:8,blue:8});
              this.contrast(5);
              this.gamma(1.2);
              this.vignette("55%",25);
              this.render();
            });

            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);



          break;  


          case 8:
            //sun rise

            Caman('#'+id, function() {
              this.allowRevert = false;
              this.revert(false);
              this.saturation(20);
              this.gamma(1.4);
              this.greyscale();
              this.contrast(5);
              this.sepia(100);
              this.channels({red:8,blue:2,green:4});
              this.gamma(0.8);this.contrast(5);
              this.exposure(10);
              this.newLayer(function(){this.setBlendingMode("overlay");
                this.copyParent();
                this.opacity(55);
                this.filter.stackBlur(10)});
              this.vignette("50%",30);
              this.render();
            });

            $('.red-'+id).val(0);
            $('.green-'+id).val(0);
            $('.blue-'+id).val(0);
            $('.brillo-'+id).val(0);
            $('.contraste-'+id).val(0);
            $('.densidad-'+id).val(0);



          break;  



        }

        
      });



      $(".reload").click(function() {
   

        var id = $(this).data('id');
        var src = $(this).data('src');

        var Miniatura = $(this).data('source');
        var name = $(this).data('name');

        Caman('#'+id,src,  function() {
          this.allowRevert = false;
          this.revert(false);
          this.render();
        


        });


        $('.red-'+id).val(0);
        $('.green-'+id).val(0);
        $('.blue-'+id).val(0);
        $('.brillo-'+id).val(0);
        $('.contraste-'+id).val(0);
        $('.densidad-'+id).val(0);
        $('.efectos-'+id).val(0);
       
        
      });
      
    
      $(".delete").click(function() {

        var id = $(this).data('id');
        var src = $(this).data('src');
        var Miniatura = $(this).data('source');
        var name = $(this).data('name');

        $( "#eliminar" ).data( "id", id );
        $( "#eliminar" ).data( "src", src );
        $( "#eliminar" ).data( "Miniatura", Miniatura );
        $( "#eliminar" ).data( "name", name );



        $('#modalEliminar').modal('show');

      });

      $("#eliminar").click(function() {

        $('#modalEliminar').modal('hide');
        var id = $(this).data('id');
        var src = $(this).data('src');
        var Miniatura = $(this).data('Miniatura');
        var name = $(this).data('name');
     

        var parametro = {

          'id':id,
          'src':src,
          'Miniatura': Miniatura,
          'name':name,
          'idImpresiones':'<?php echo $idPedido ?>'
        
        };

      
        $.ajax({
        
          data: parametro,
          url: 'http://<?= $_SERVER['HTTP_HOST'] ?>/eliminarFotoCrop.php',
          type: 'post',
           
            
          success: function(data) {
                       
    
            $('#box-'+id).remove();
            var total = $( ".cropperContainer > img" ).length;

            
            if(total == 0){

              <?php

                if ( $has_next ){

                  ?>
                  
                    location.href = "?page=<?php echo ($page + 1)?>&P=<?php echo $idPedido; ?>&idProducto=<?php echo $_GET['idProducto']; ?>";
                  
                  <?php


                }

                else{

                  ?>

                    guardar();

                  <?php
                }

              ?>


            }

            
          }
        

        });


      });

   
      function applyFilters() {
       
        var id = $( this ).data('id');
        var imgsrc = $("#"+id).attr('src');
        
        var cntrst = parseInt($('.contraste-'+id).val());
        var brillo = parseInt($('.brillo-'+id).val());
        var redColor = parseInt($('.red-'+id).val());
        var greenColor = parseInt($('.green-'+id).val());
        var blueColor = parseInt($('.blue-'+id).val());
        var densidad = parseInt($('.densidad-'+id).val());

        $('.efectos-'+id).val(0);
        
        Caman('#'+id,imgsrc,  function() {

          this.allowRevert = false;
          this.revert(false);
          this.contrast(cntrst);
          this.brightness(brillo);

          this.channels({
            red: redColor,
            green: greenColor,
            blue: blueColor
          });

          this.exposure(densidad);
          this.render();

        });

      }



      $( "#guardar" ).click(function() {
        console.log('guardando')
        $('#processing-modal').modal({  
          show:true,
          keyboard:false,
          backdrop: 'static'
        });

        var i=0;
        var x=0;
      

        $(".foto").each(function( key,index ) {
          console.log('recorrido' + <?= $Producto ?> )
          var id = index.id;
          var nombreDeImagen = $('#'+id).data('name');
          var cntrst = parseInt($('.contraste-'+id).val());
          var brillo = parseInt($('.brillo-'+id).val());
          var redColor = parseInt($('.red-'+id).val());
          var greenColor = parseInt($('.green-'+id).val());
          var blueColor = parseInt($('.blue-'+id).val());
          var densidad = parseInt($('.densidad-'+id).val());
          var efecto =  parseInt($('.efectos-'+id).val());

          if(efecto !=0){
            cntrst = 0;
            brillo = 0;
            redColor = 0;
            greenColor = 0;
            blueColor  = 0;
            densidad = 0;

          }

          var total = $( ".foto" ).length;
          
          $('.progress').show();



          switch(<?= $Producto ?> ){

            case 1:


              var manejador = 'manejadorImpresiones.php';


              var parametro = {
                'function':32,
                'IdImp':'<?php echo $idPedido ?>',
                'nombreDeImagen':nombreDeImagen,
                'red':redColor,
                'green':greenColor,
                'blue': blueColor,
                'brightness': brillo,
                'contrast': cntrst,
                'density': densidad,
                'efecto' : efecto
              };

            break;
         





            case 21:
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
            case 36:
            case 37:
            case 38:
            case 39:
            case 40:
            case 41:
            case 42:
            case 43:
            case 44:
            case 45:
            case 46:
            case 47:

              manejador = 'manejadorBastidores.php';

              var parametro = {
                'function':44,
                'idPedidoBastidores':<?php echo $idPedido ?>,
                'nombreDeImagen':nombreDeImagen,
                'red':redColor,
                'green':greenColor,
                'blue': blueColor,
                'brightness': brillo,
                'contrast': cntrst,
                'density': densidad,
                'efecto' : efecto
              };

            break;

            case 50:


              manejador = 'manejadorMosaico.php';
           

              var parametro = {
                'function':17,
                'idPedidoMosaico':<?php echo $idPedido ?>,
                'nombreDeImagen':nombreDeImagen,
                'red':redColor,
                'green':greenColor,
                'blue': blueColor,
                'brightness': brillo,
                'contrast': cntrst,
                'density': densidad,
                'efecto' : efecto
              };

            

            break;


            default:
            console.log('default '  )
              manejador = 'manejadoralbums.php';

              var parametro = {
                'function':27,
                'idPedidoAlbumes':<?php echo $idPedido ?>,
                'nombreDeImagen':nombreDeImagen,
                'red':redColor,
                'green':greenColor,
                'blue': blueColor,
                'brightness': brillo,
                'contrast': cntrst,
                'density': densidad,
                'efecto' : efecto
              };

            break;



          }


      

         
      
          $.ajax({
            data: parametro,
            url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/manejadores/"+manejador,
            type: 'post',
            async: true,
            success: function(data) {
        
            console.log('adna en el ajax ' + data)
        
              i++;
              x = (i*100)/total;
      
              if(x==100){

                <?php

                  if ($has_next){

                    ?>

                      location.href = "?page=<?php echo ($page + 1)?>&P=<?php echo $idPedido; ?>&idProducto=<?php echo $_GET['idProducto']; ?>";
                    
                    <?php


                  }
                  else{


                    ?>
                      console.log('se fue a guardar')
                      guardar();
                  
                    <?php

                  }


                ?>
              }   
              
              
            },

            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }




          });
      
        });
  
      });




      function procesoTerminado(){

        $('#barra').css('width', 0);
        $('#barra').empty();
        $('.progress').hide();
        $('#processing-modal').modal("hide");

      }


      

      function randString(n){
        
        if(!n) {
          n = 5;
        }

        var text = '';
        var possible = 'abcdefghijklmnopqrstuvwxyz';

        for(var i=0; i < n; i++){
          text += possible.charAt(Math.floor(Math.random() * possible.length));
        }

        return text;
      }

      
      function guardar(){


        $('#processing-modal').modal('hide');
        

        $('#guardando-modal').modal({  
          show:true,
          keyboard:false,
          backdrop: 'static'
        });






        switch(<?= $Producto ?>){
          case 1:

            var manejador = 'manejadorImpresiones.php';

            var parametro = {
              'function':33,
              'idImpresiones':'<?php echo $idPedido ?>'
             
            };


          break;

        

          case 21:
          case 22:
          case 23:
          case 24:
          case 25:
          case 26:
          case 27:
          case 28:
          case 30:
          case 31:
          case 32:
          case 33:
          case 34:
          case 35:
          case 36:
          case 37:
          case 38:
          case 39:
          case 40:
          case 41:
          case 42:
          case 43:
          case 44:
          case 45:
          case 46:
          case 47:


            manejador = 'manejadorBastidores.php';

            var parametro = {
              'function':45,
              'idPedidoBastidores':'<?= $idPedido ?>'
           
            };

          break;

          case 50:

            manejador = 'manejadorMosaico.php';

            var parametro = {
              'function':18,
              'idPedidoMosaico':'<?= $idPedido ?>'
           
            };

          break;

          default:
            console.log('default amenajdores albumes ')
            manejador = 'manejadoralbums.php';

            var parametro = {
              'function':28,
              'idPedidoAlbumes':'<?= $idPedido ?>'
           
            };
          break;



        }

       
        


        

        $.ajax({
          type: "POST",
          url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/manejadores/"+manejador,
          data: parametro,
          dataType: "json",
          async: true,
          success: function(data) {
    console.log('JSOn . ' + <?= $idPedido ?>)
            var total = data.length;
            var i = 0;
            var x = 0;
            var y = 0;
            
        
          
            $.each(data, function( index, value ) {

              var red = parseInt(value.red);
              var green = parseInt(value.green);
              var blue = parseInt(value.blue);
              var contrast = parseInt(value.contrast);
              var brightness = parseInt(value.brightness);
              var density = parseInt(value.density);
              var efecto = parseInt(value.efecto);
              var rand = randString(4);
            

              $('#contenedorImgTemporal').append('<canvas id="canvas-'+rand+'"></canvas>');

              if(red==0 && green == 0 && blue == 0 && contrast == 0 && brightness == 0 && density == 0 && efecto == 0){
                 
               

                var parametroMove = {

                  'rutaOriginal':'<?php echo $rutaOriginal ?>',
                  'NombreDeImagen':value.nombreDeImagen

                };

                
              

                $.ajax({
                  data: parametroMove,
                  url: '/moverImagen.php',
                  type: 'post',
                  async: true,
                  success: function(data) {
             
                    i++;
                    x = (i*100)/total;
                           
                    $('#barra').css('width', x+'%');
                    $('#barra').empty().append(x.toFixed()+'%');
                        
                    if(x==100){

                    
                      accionPrincipal();
                    }

                    y++;

                  }

                

                });  



                  
                

              }

              else{
   

                Caman('#canvas-'+rand,'http://<?php echo $_SERVER["HTTP_HOST"]; ?>/<?php echo $rutaOriginal; ?>/'+value.nombreDeImagen, function () {

                  this.revert(false);

         

                  if(efecto !=0){

             
                    switch(efecto){

                    
                      case 1:
                        //vintage
                         
                        this.greyscale();
                        this.contrast(5);
                        this.noise(3);
                        this.sepia(100);
                        this.channels({red:8,blue:2,green:4});
                        this.gamma(0.87);
                        



                      break;


                      case 2:
                        //LOMO
                        this.brightness(15);
                        this.curves("rgb",[0,0],[200,0],[155,255],[255,255]);
                        this.saturation(-20);
                        this.gamma(1.8);

                      break;

                      case 3:
                        //clarity
                        this.vibrance(20);
                        this.curves("rgb",[5,0],[130,150],[190,220],[250,255]);
                        this.sharpen(15);
                        this.vignette("45%",20)

                      break;


                      case 4:
                        //Sin city
                        this.contrast(100);
                        this.brightness(15);
                        this.exposure(10);
                        this.posterize(80);
                        this.clip(30);
                        this.greyscale();

                      break;

                      case 5:
                        //Blanco y negro
                        this.greyscale();

                      break;  


                      case 6:
                        //sepia
                        this.sepia(100);
                      break;  


                      case 7:
                        //sun rise
                        this.exposure(3.5);
                        this.saturation(-5);
                        this.vibrance(50);
                        this.sepia(60);
                        this.colorize("#e87b22",10);
                        this.channels({red:8,blue:8});
                        this.contrast(5);
                        this.gamma(1.2);
                        this.vignette("55%",25);

                      break;  


                      case 8:
                        //sun rise
                        this.saturation(20);
                        this.gamma(1.4);
                        this.greyscale();
                        this.contrast(5);
                        this.sepia(100);
                        this.channels({red:8,blue:2,green:4});
                        this.gamma(0.8);this.contrast(5);
                        this.exposure(10);
                        this.newLayer(function(){this.setBlendingMode("overlay");
                        this.copyParent();
                        this.opacity(55);
                        this.filter.stackBlur(10)});
                        this.vignette("50%",30);

                      break;  



                    }


                  }


                  else{


                    
                    this.brightness(brightness);

                    this.channels({
                      red: red,
                      green: green,
                      blue: blue
                    });

                    this.exposure(density);
                    this.contrast(contrast);

                  }
                  

                
                  this.render(function () {

                    this.toImage('jpg');

                    var image = this.toBase64();

                    var parametroImg = {
                      'img':image,
                      'nombreDeImagen':value.nombreDeImagen,
                      'ruta':'<?php echo $rutaOriginal ?>'
               
                    };
                     
                    $.ajax({
                      data: parametroImg,
                      url: '/guardarEdicion.php',
                      type: 'post',
                      async: false,
                      success: function(data) {
                   
                        
                     
                        i++;
                        x = (i*100)/total;
                            
                      
                      
                        $('#barra').css('width', x+'%');
                        $('#barra').empty().append(x.toFixed()+'%');
                        
                        if(x==100){

                        
                          accionPrincipal();

                          
                        }
                       
                        
                      }





                    });




                  });
                

                });


              }




            });

            
            
            
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
          }
        });

      }


      function accionPrincipal(){

        console.log('anda en acion principal')


        switch(<?= $Producto ?> ){

          case 1:

            var manejador = 'manejadorImpresiones.php';


            var parametros = {
              'function':34,
              'idSocio':<?= $Resultado['IdSocio'] ?>,
              'usuario':idUser,
              'idImpresiones':<?= $idPedido ?>,
              'idProducto': <?= $_GET['idProducto'] ?>,
              'producto':'Impresiones',
              'tipoDeAjuste':<?= $tipoDeAjuste ?>,
              'tipoDeRetoque':<?= $tipoDeRetoque; ?>
            };

          break;

     


          case 21:
          case 22:
          case 23:
          case 25:
          case 26:
          case 27:
          case 28:
          case 30:
          case 31:
          case 32:
          case 33:
          case 34:
          case 35:
          case 36:
          case 37:
          case 38:
          case 39:
          case 40:
          case 41:
          case 42:
          case 43:
          case 44:
          case 45:
          case 46:
          case 47:
          case 48:

            

            manejador = 'manejadorBastidores.php';

            var parametros = {
              'function':43,
              'idSocio':<?= $Resultado['IdSocio'] ?>,
              'idProducto': <?= $_GET['idProducto'] ?>,
              'tipoBastidor': <?= $_GET['idProducto'] ?>,
              'idPedidoBastidores':<?= $idPedido ?>,
              'usuario' : idUser,
              'producto':"<?= $nombreDeBastidor ?>"
            }
        

          break;

          case 50:



            manejador = 'manejadorMosaico.php';
          

            var parametros = {
              'function':16,
              'idSocio':<?= $Resultado['IdSocio'] ?>,
              'producto': <?= $_GET['idProducto'] ?>,
              'idPedido':<?= $idPedido ?>,
              'usuario' : idUser,
              'nombreMosaico':"<?= $nombreDeMosaico ?>",
              'idSocioGenerico':<?= $idSocioGenerico ?>
            }

          break;

          default:

          
            location.href = "../AccesoriosDeAlbumes.php?Producto=<?= $_GET['idProducto']?>&P=<?php echo $idPedido ; ?>&Product=albumes";

            /*manejador = 'manejadoralbums.php';


            var parametros = {
              'function':26,
              'idSocio':<?= $Resultado['IdSocio'] ?>,
              'idProducto': <?= $_GET['idProducto'] ?>,
              'idPedidoAlbumes':<?= $idPedido?>,
              'usuario' : idUser,
              'producto':'Album'

            }*/



          break;



        }


       

        $.ajax({
          type: "POST",
          url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/manejadores/"+manejador,
          data: parametros,
          dataType: "text",
          cache: false,
          success: function(data) {
            
            if(<?= $Producto ?> == 50){

              location.href = "../tickets/ticketProductosKiosco.php?Producto=<?php echo $_GET['idProducto']; ?>&P="+data+"&Product=";

            } 
            else{

       
              location.href = "../tickets/ticketProductosKiosco.php?Producto=<?php echo $_GET['idProducto']; ?>&P=<?php echo $idPedido; ?>&Product=";
            }
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