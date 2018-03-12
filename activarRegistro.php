<?php
session_start();
require('ClaseInicial.php');
$ObjInicial = new Inicial(); 


$ObjInicial->ProbarCookie("MiCuenta.php");
$Resultado = $ObjInicial->DatosDeSocio($_SERVER['HTTP_HOST']);
header($ObjInicial->CharSet($Resultado['CharSet']));

require('./clases/class.User.php');
$ObjUser = new users(); 



$id = $_GET['id'];
$stm = $ObjInicial->getConexion()->prepare('SELECT * FROM invitacioninscripcion WHERE id =  ?');
$stm->execute(array($id));


$invitacionData = $stm->fetch();

if($invitacionData['status'] == 1){


	header("location:http://".$_SERVER['HTTP_HOST']."/mi-cuenta", true, 302);
}


?>
<!DOCTYPE html>
<html lang="<?php echo $Resultado['language'];?>">
    <head>
       	<?php 

            $ObjInicial->Header("Mi Cuenta",$Resultado['IdSocio']);
            
        ?>  

    </head>

    <body>

    	<?php 


            $ObjInicial->CargarCabeza($Resultado['IdSocio'],$Resultado['CompaniaSlogan'],$Resultado['NombreDeCompania'],$Resultado['language']);



      
        ?>

       

        <br>
    	<div class="container" style="min-height:800px;">

	    	<div class="container">
		    	<div class="row">
		    		

				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 toppad" >
				   
				   
				    	<div class="panel panel-info">
				            
				        	<div class="panel-heading">
				              <h3 class="panel-title">Terminar registro</h3>
				            </div>
				            
				            <div class="panel-body">
				            
				            	<div class="row">
				                	
				                	
					                
					              
					                <div class=" col-md-12 col-lg-12 "> 




					                <form id="formActivarDatos" class="form-horizontal text-center" role="form" >

										<div class="form-group">
							        	
							        		<div class="controls form-inline">

							        			<label for="optionsRadios" class="col-md-4 control-label">Sexo</label>


											    
											    <div class="radio col-sm-8 text-left">
											      <label>
											        <input type="radio" name="userActivarSex"  value="1" checked>
											        Hombre
											      </label>
											    	&nbsp;
											      <label>
											        <input type="radio" name="userActivarSex" value="2">
											        Mujer
											      </label>
											    </div>
							          	
							            	
							          		</div>

							          	</div>

										         
										<div class="form-group">        	       
												
											<label for="userActivarName" class="col-sm-3 control-label">Nombre</label>		
											<div class="col-sm-9">	
												<input type="text" value="" id="userActivarName" name="userActivarName" class="form-control" placeholder="Nombre"  >
											</div>	
												
										</div>		


										<div class="form-group">        	       
												
											<label for="userActivarContrasena" class="col-sm-3 control-label">Contraseña</label>		
											<div class="col-sm-9">	
												<input type="password" value="" id="userActivarContrasena" name="userActivarContrasena" class="form-control" placeholder="Contraseña"  >
											</div>	
												
										</div>		


										<div class="form-group">        	       
												
											<label for="userRepetActivarContrasena" class="col-sm-3 control-label">Repetir Contraseña</label>		
											<div class="col-sm-9">	
												<input type="password" value="" id="userRepetActivarContrasena" name="userRepetActivarContrasena" class="form-control" placeholder="Contraseña"  >
											</div>	
												
										</div>	

										<div class="form-group ">        	       

											<div class="col-md-9 col-md-offset-3" >

								        			<div class="col-md-3">
								        			<label for="userActivarDay" class="control-label">	Dia</label>
								        				<select id="userActivarDay" class="form-control  ">
												          	<?php
				                                                for ($i = 1; $i <= 31; $i++){
				                                                        
				                                                	?>
				                            							<option value="<?php  echo $i;?>">
				                                                        	<?php
				                                                            	echo $i;
				                                                            ?>
				                                                        </option>

				                                                    <?php
				                                                }
			                                            	?>
												          </select>	

								        			</div>		


								        			<div class="col-md-5">
								        			<label for="userActivarMonth" class="control-label">	Mes</label>
								        				<select id="userActivarMonth" class="form-control  ">

												          	<option value="01">Enero </option>
				                                            <option value="02">Febrero </option>
				                                            <option value="03">Marzo </option>
				                                            <option value="04">Abril </option>
				                                            <option value="05">Mayo </option>
				                                            <option value="06">Junio </option>
				                                            <option value="07">Julio </option>
				                                            <option value="08">Agosto </option>
				                                            <option value="09">Septiembre </option>
				                                            <option value="10">Octubre</option>
				                                            <option value="11">Noviembre </option>
				                                            <option value="12">Diciembre </option>

												        </select>	

								        			</div>		

								        			<div class="col-md-4">
								        			<label for="userActivarYear" class="control-label">	Año</label>
								        				<select id="userActivarYear" class="form-control  ">
												        	
												        	<?php
			                                          
			                                          			for ($i = 1920; $i <= 1996; $i++) {
			                                            
			                                          				?>
					
											                            <option value="<?php echo $i;?>">
					                                					    <?php
					                                          
					                                          					echo $i;
					                                          				?>

			                                      						</option>
			                                    					<?php
			                                      				}
			                                      			
			                                      			?>
												          </select>	

								        			</div>		
								        		
								        	</div>	
								        </div>	


							        	<div class="form-group ">
							          		<div class="col-sm-2 text-right " style="margin-top:.5em;">		
							            		<input type="checkbox" name="checkActivarPromo"  id="checkActivarPromo" checked   >
							            	</div>
							            	<div class="col-sm-10  text-left" >
							          			<label for="checkActivarPromo" class="control-label ">Deseo recibir ofertas y promociones</label>	
							          		</div>
							          	</div>

							          	<div class="form-group">
							          		<div class="col-sm-2 text-right " style="margin-top:.5em;">		
							            		<input type="checkbox" name="checkActivarConditions"  id="checkActivarConditions" checked   >
							            	</div>
							            	<div class="col-sm-10  text-left" >
							          			<label for="checkActivarConditions" class="control-label ">Acepto las condiciones de uso y privacidad</label>	
							          		</div>
							          	</div>

										      
										     
										
							          	<div class="form-group ">
							          		<div class="col-sm-offset-9">
							          			<button  onclick="GuardarCambiosAlta();" type="button" class="btn btn-primary ">Guardar</button>
							          		</div>		
							          	</div>     
									                        
							    	
							                        
									</form>



					                  
					                	
					                  
					                 
					                </div>
				              	</div>

				            </div>

			                
				            
				        </div>
				    </div>
				</div>
			</div>



	    </div>
       
        <?php

            $ObjInicial->getFooter($Resultado['IdSocio'],$Resultado['NombreDeCompania'],$Resultado['Direccion'],$Resultado['Telefono1']);

        ?>    



        <?php

            $ObjInicial->Scripts(0,1,$Resultado['IdSocio'],$Resultado['IdParnerEditor'],0);

        ?> 	


        <script type="text/javascript">

        	$('#userActivarName').focus();

        	$('#formActivarDatos').bootstrapValidator({
			                    	
	        	message: 'This value is not valid',
	            feedbackIcons: {
	                valid: 'glyphicon glyphicon-ok',
	                invalid: 'glyphicon glyphicon-remove',
	                validating: 'glyphicon glyphicon-refresh'
	            },

	            fields: {
	            
	            	userActivarName: {

	                    message: 'Nombre no valido',
	                    trigger:'blur',
	                    validators: {
	                        notEmpty: {
	                        message: 'Este campo es requerido y no puede estar vacio'
	                    },
	                    stringLength: {
	                            min: 4,
	                            max: 45,
	                            message: 'El nombre debe ser mas de 4 y menos de 45 caracteres '
	                        }
	                    
	                        
	                    },
				                           
				    },


				    userActivarContrasena: {
	            		trigger: 'blur',
	                    message: 'Nombre no valido',
	                    validators: {
	                        notEmpty: {
	                        message: 'Este campo es requerido y no puede estar vacio'
	                    },
	                    stringLength: {
	                            min: 6,
	                            max: 20,
	                            message: 'La contraseña  debe ser mas de 10 y menos de 100 caracteres '
	                        }
	                    
	                        
	                    },
				                           
				    },

				    userRepetActivarContrasena: {
                		trigger: 'blur',
                        message: 'Contraseña No Valida',
                        validators: {
                            notEmpty: {
                                message: 'Este campo es requerido , no puede estar vacio '
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: 'La Contraseña debe ser mas de 4 y menos de 15 caracteres '
                            },

                            identical: {
	                        field: 'userActivarContrasena',
	                        message: 'las contraseñas  deben ser iguales'
	                    	}
                            
                        },

                        
                       
                	},

				    
	                
	            }
			});

			$("#formActivarDatos").submit(function(e){
			    return false;
			});
			function GuardarCambiosAlta(){



				console.log('entrte a registrar');




				var checkActivarPromo=1;

				if ($('#checkActivarPromo').is(":checked")) {
                	checkActivarPromo = 2;
           		}


				var parametros = { 
					"function":12,
					"idQuienInvita": '<?php echo  $invitacionData["idUser"]?>',
		        	"userEmail": '<?php echo  $invitacionData["correo"]?>',
		        	"userSex": $("input[name='userActivarSex']:checked").val(),
		        	"userName":$("#userActivarName").val(),
		        	"userPassword": $("#userActivarContrasena").val(),
		        	"checkPromo": checkActivarPromo,
                    "userDay":$('#userActivarDay').val(),
                    "userMonth":$('#userActivarMonth').val(),
                    "userYear":$('#userActivarYear').val(),
		        	"id": '<?php echo  $id?>',
		        	"idSocio":'<?php echo  $invitacionData["idSocio"]?>',
		        	'idParnerEditor':'<?php echo $Resultado["IdParnerEditor"] ?>',


		            
		        };
		     	console.log('aki voy ');

                var formularioActivar = $('#formActivarDatos').data('bootstrapValidator').validate().isValid();

                console.log('pase formualrio activar ');
       			if(formularioActivar == true){

       				  console.log('estoy en el true ');
       				if(!$('#checkActivarConditions').is(':checked')) {
	                     alert("Debes Aceptar Las Condiciones Y Uso De Privacidad");
	                     
	                 	}

	                 	else{

	                 		console.log('ya voy al ajax');
					        $.ajax({
					                            	
					        	type: 'POST',
					        	url: 'http://<?php echo $_SERVER["HTTP_HOST"] ?>/manejadores/ManejadorUsuarios.php',
					            data: parametros,
					            dataType:'Json',
					            success: function(response) {
					              
					            	alert("A quedado registrado bienvenido ");
					            	window.location.href ='http://<?= $_SERVER["HTTP_HOST"] ?>';
					          
					            },
					            error: function(jqXHR, textStatus, errorThrown) {
					                console.log(jqXHR);
					                console.log(textStatus);
					                console.log(errorThrown);
					            }
					        });
					    }
			    }

			}



        </script>
    </body>
    
</html>    	