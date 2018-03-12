<?php
session_start();

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



$idPedido = 0;

if(isset($_GET['P'])){

  $idPedido = $_GET['P'];

}



$productData = $ObjSinfonia->get_product_data($ObjInicial->getConexion(),$Producto,$idPedido);
$NombreDeCarpeta = $productData['carpeta'];


$per_page = 6;
$page = $_GET['page'];
$has_previous = false;
$has_next = false;



$rutaOriginal =  'pedidos/'.$Resultado['IdSocio'].'/'.$_GET['idProducto'].'/'.$_SESSION['iduser'].'/'.$NombreDeCarpeta;

$dirname = "AjusteMonitor";
$filename = $rutaOriginal ."/". $dirname . "/";

if (!file_exists($filename)) {
  mkdir($rutaOriginal . "/" . $dirname, 0777);
    
}

copy('Imagenes/AjusteMonitor/1.png', $rutaOriginal.'/AjusteMonitor/negra.png');
copy('Imagenes/AjusteMonitor/2.png', $rutaOriginal.'/AjusteMonitor/blanca.png');
copy('Imagenes/AjusteMonitor/3.png', $rutaOriginal.'/AjusteMonitor/gris.png');

if($Resultado['esIndividual'] == 0){

  $idSocioGenerico  = 2;
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

    <link href="http://<?=  $_SERVER['HTTP_HOST']?>/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" media="all">
    <style>

      .cropperContainer {
        max-width: 100%;
        min-height:250px;
        max-height: 280px;
        

      }


      .cropperContainer >img {
        max-width: 100%;
        min-height:250px;
        max-height: 280px;
        

      }

      .cropperContainer >canvas{
        max-width: 100%;
        min-height:250px;
        max-height: 280px;
        

      }


      .jcrop-centered{
        display: inline-block;
      }
          
      .crop-image-wrapper{
        text-align: center;
      }

      .modal-static { 
          position: fixed;
          top: 50% !important; 
          left: 50% !important; 
          margin-top: -100px;  
          margin-left: -100px; 
          overflow: visible !important;
      }
      .modal-static,
      .modal-static .modal-dialog,
      .modal-static .modal-content {
          width: 200px; 
          height: 150px; 
      }
      .modal-static .modal-dialog,
      .modal-static .modal-content {
          padding: 0 !important; 
          margin: 0 !important;
      }
      .modal-static .modal-content .icon {
      }

    

    </style>

  </head>


  <body>
    
    <?php

      $ObjInicial->CargarCabeza($Resultado['IdSocio'],$idSocioGenerico,$Resultado['CompaniaSlogan'],$Resultado['NombreDeCompania'],$Resultado['language']);

    ?>

  

    <div id="sb-site" style="margin-top:7.5em;" >
  

      <div style="margin: 1em auto; min-height:1200px;" class="container">

        
        <div class="page-header">
              
          <h1>Ajuste balance de monitor <button id="guardar"  type="button" class="btn btn-success btn-lg pull-right" ><i class="fa fa-cog"></i> Guardar y continuar </button></h1>
              
          <br>
          
          <div class="progress" style="display:none">
            <div id="barra" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="2" style="width: 0%;">
              
            </div>
          
          </div>

          <i id="spinner" class="fa fa-cog fa-5x pull-right hidden"></i>

          <div class="clearfix"></div>

        </div>


        <div class="row" >

          <?php





            

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

        


            function showPictures($rutaMiniatura,$rutaOriginal){
              global $page, $per_page, $has_previous, $has_next;
              
                if ( $handle = opendir($rutaMiniatura)) {
                       $lightbox = rand();
                       echo '<ul id="pictures">';
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

                          <div class="col-md-4  ">
                            <div class="thumbnail">

                              <div class="cropperContainer" >
                                <img  class="img-responsive center-block foto"  id="<?php echo $id?>" data-name="<?php echo $nombreOriginal?>" src="<?php echo $rutaMiniatura.'/'.$foto;    ?>" alt="Picture" >
                              
                                <img  class="hidden img-responsive center-block "  id="grande-<?php echo $id?>" data-name="<?php echo $nombreOriginal?>" src="<?php echo $rutaOriginal.'/'.$foto;    ?>" alt="Picture" >
                              </div>

                              <div class="panel-footer">

                                  
                                      
                                      
                                <div class="btn-group col-md-12">

                                     

                                  <div class="col-md-4">
                                    <label for="demo_vertical2">Rojo</label> 
                                    <input class="red-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="red" name="red" data-id="<?php echo $id?>">
                                  </div>

                                  <div class="col-md-4">
                                    <label for="demo_vertical2">Verde</label> 
                                    <input class="green-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="green" name="green" data-id="<?php echo $id?>">
                                  </div>

                                  <div class="col-md-4">
                                    <label for="demo_vertical2">Azul</label> 
                                    <input class="blue-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="blue" name="blue" data-id="<?php echo $id?>">
                                  </div>

                                  <div class="col-md-4">
                                    <label for="demo_vertical2">Brillo</label> 
                                    <input class="brillo-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="brillo" name="brillo" data-id="<?php echo $id?>">
                                  </div>


                                  <div class="col-md-4">
                                    <label for="demo_vertical2">Contraste</label> 
                                    <input class="Clasecontraste contrast-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="contrast" name="contrast" data-id="<?php echo $id?>">
                                  </div>

                                  <div class="col-md-4">
                                    <label for="demo_vertical2">Densidad</label> 
                                    <input class="densidad-<?php echo $id?> filtro btn-xs" type="text"  value="0" id="densidad" name="densidad" data-id="<?php echo $id?>">
                                  </div>


                                    
                                
                                </div>  

                             
                                 
                                <div class="clearfix"></div>

                                      
                              </div>



                            </div>  



                          </div>
                      




                        <?php
                      
                      
                       $count++;
                    }
                  }
                     
                  echo '</ul>';
                     

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
               
    
    


            $rutaOriginal =  'pedidos/'.$Resultado['IdSocio'].'/'.$_GET['idProducto'].'/'.$_SESSION['iduser'].'/'.$NombreDeCarpeta."/AjusteMonitor";

            $rutaMiniatura =  'pedidos/'.$Resultado['IdSocio'].'/'.$_GET['idProducto'].'/'.$_SESSION['iduser'].'/'.$NombreDeCarpeta."/AjusteMonitor";
        

            showPictures($rutaMiniatura,$rutaOriginal);



          ?>
        
          

        </div>

        
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

    <script type="text/javascript" src="js/caman.full.js"></script>
    <script src="./js/jquery.bootstrap-touchspin.min.js"></script>
    <script type="text/javascript">
        
    $('.filtro').change(applyFilters);

 


      $(".filtro").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'glyphicon glyphicon-plus',
        verticaldownclass: 'glyphicon glyphicon-minus',
        min:-100,
        max:100,
        step:5
      });

      
      Caman.Event.listen("processStart", function (job) {
     
        $('#spinner').addClass('fa-spin');
        //$(".filtro").prop('disabled', true);

      });


      Caman.Event.listen("processComplete", function (job) {
        
        $('#spinner').removeClass('fa-spin');
       // $(".filtro").prop('disabled', false);
      });


      

      $( "#red" ).keyup(function(e) {
        

        if (e.keyCode === 109) { 
        
          e.preventDefault();
          var valor = $(this).val();
          var total = parseInt(valor)-1;
          $(this).val(total)
          $(this).trigger('change');
        }


        if (e.keyCode === 107) { 
          e.preventDefault();
          var valor = $(this).val();
          var total = parseInt(valor)+1;
          $(this).val(total);
          $(this).trigger('change');
        }

      

      });  

   
      function applyFilters() {
         
        var id = $( this ).data('id');
        var imgsrc = $("#"+id).attr('src');
       
       
        var cntrst = parseInt($('.contrast-'+id).val());
        var brillo = parseInt($('.brillo-'+id).val());
        var redColor = parseInt($('.red-'+id).val());
        var greenColor = parseInt($('.green-'+id).val());
        var blueColor = parseInt($('.blue-'+id).val());
        var densidad = parseInt($('.densidad-'+id).val());

       
        
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

        $('#processing-modal').modal({  
          show:true,
          keyboard:false,
          backdrop: 'static'
        });

        var i=0;
        var x=0;
      

        $( ".foto" ).each(function( key,index ) {

          var id = index.id;

           var imgsrc = "http://<?php echo $_SERVER["HTTP_HOST"]; ?>/"+$("#grande-"+id).attr('src');

           console.log(imgsrc)

          var nombreDeImagen = $('#grande-'+id).data('name');

          console.log(nombreDeImagen);
         
          var total = $( ".foto" ).length;

          var cntrst = parseInt($('.contrast-'+id).val());
          var brillo = parseInt($('.brillo-'+id).val());
          var redColor = parseInt($('.red-'+id).val());
          var greenColor = parseInt($('.green-'+id).val());
          var blueColor = parseInt($('.blue-'+id).val());
          var densidad = parseInt($('.densidad-'+id).val());

          

          $('.progress').show();
            
          
            
            Caman('#grande-'+id,imgsrc, function () {
             
              this.revert(false);

              this.contrast(cntrst);
              this.brightness(brillo);

              this.channels({
                red: redColor,
                green: greenColor,
                blue: blueColor
              });

              this.exposure(densidad);

              
              this.render(function () {
                 console.log('entro')
                this.toImage('jpg');

                var image = this.toBase64();
                

                var parametro = {
                  'img':image,
                  'nombreDeImagen':nombreDeImagen,
                  'ruta':'<?php echo $rutaOriginal ?>'
           
                };

                $.ajax({
                  data: parametro,
                  url: '/guardarEdicion.php',
                  type: 'post',
                  async: true,

                  
           
                  
                  success: function(data) {
                    
                  

                    i++;
                    x=(i*100)/total;
                        
                    console.log(x);  
                  
                    $('#barra').css('width', x+'%');
                    $('#barra').empty().append(x.toFixed()+'%');
                    
                    if(x==100){

                      setTimeout(procesoTerminado,1000);
                      
                    }
                   
                    
                  }
                });


              });

            });  


          });

     

      });



      function procesoTerminado(){

        $('#barra').css('width', 0);
        $('#barra').empty();
        $('.progress').hide();
        $('#processing-modal').modal("hide");
       

       
        switch(<?=  $_GET['idProducto']?>){
          case 1:
            location.href ="http://<?php echo $_SERVER['HTTP_HOST'] ?>/cropKiosco/crop.php?P=<?=  $idPedido?>&idProducto=<?=  $_GET['idProducto']?>&page=0";
          break;

          case 5:

            location.href  = "http://<?php echo $_SERVER['HTTP_HOST'] ?>/cropKiosco/cropTexturas.php?P=<?= $idPedido ?>&idProducto=<?=  $_GET['idProducto']?>&page=0"; 
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
          case 48:

             location.href  = "http://<?php echo $_SERVER['HTTP_HOST'] ?>/cropKiosco/cropBastidor.php?P=<?= $idPedido ?>&idProducto=<?=  $_GET['idProducto']?>&page=0"; 

          break;

          case 50:

             location.href  = "http://<?php echo $_SERVER['HTTP_HOST'] ?>/cropKiosco/cropMosaicos.php?P=<?= $idPedido ?>&idProducto=<?=  $_GET['idProducto']?>&page=0"; 

          break;

          default:

            switch(<?=  $_GET['idProducto']?>){

              case 6:
              case 12:


                window.location.replace("http://<?php echo $_SERVER['HTTP_HOST'] ?>/cropKiosco/cropAlbumesHojas.php?P=<?= $idPedido ?>&idProducto=<?=  $_GET['idProducto']?>&page=0");  

              break;

              default:
                window.location.replace("http://<?php echo $_SERVER['HTTP_HOST'] ?>/cropKiosco/cropAlbumesPortada.php?P=<?= $idPedido ?>&idProducto=<?=  $_GET['idProducto']?>&page=0");  
              break;


            }

          break;



        }
          
       
          

      


      }


      

        
        

    </script>



  </body>
  
</html>