<?php
/* Smarty version 3.1.30, created on 2017-12-20 22:48:46
  from "C:\xampp\htdocs\mi-album\templates\descripcionDeProductos\proPoster.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a3adabe12d762_94652642',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78689ca4d34a9cbf5f5d6e8a63d0629d5bccec44' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mi-album\\templates\\descripcionDeProductos\\proPoster.tpl',
      1 => 1513806524,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_5a3adabe12d762_94652642 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\htdocs\\mi-album\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_combine')) require_once 'C:\\xampp\\htdocs\\mi-album\\smarty\\plugins\\function.combine.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_75865a3adabe0eb0d7_05799754', 'head');
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_108035a3adabe106651_74312531', 'body');
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_127845a3adabe11dd65_10004091', 'sb'-'site'-'exclude');
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_49695a3adabe1298e8_77088906', 'scripts');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'head'} */
class Block_75865a3adabe0eb0d7_05799754 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['boot']->value->socio == 5) {?><meta name="title" content="Pro Poster"><meta name="description" content="Todos los servicios en un mismo lugar, Impresión fotográfica profesional en todos formatos y tamaños. Álbumes digitales, foto acabados, software y más…"><meta name="keywords" content="bastidor, bastidores, pro poster, pro-poster, proposter"><meta name="copyright" content="<?php echo $_smarty_tpl->tpl_vars['boot']->value->company;?>
 <?php echo smarty_modifier_date_format(time(),"%Y");?>
"><meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['boot']->value->company;?>
"><meta name="language" content="Spanish"><meta name="revisit" content="1 month"><meta name="robots" content="index, follow"><meta name="distribution" content="global"><meta name="rating" content="general"><meta name="contact" content="<?php echo $_smarty_tpl->tpl_vars['boot']->value->email;?>
"><meta name="abstract" content="Todos los servicios en un mismo lugar, Impresión fotográfica profesional en todos formatos y tamaños."><link rel="canonical" href="//<?php echo $_SERVER['SERVER_NAME'];
echo $_SERVER['REQUEST_URI'];?>
" /><?php }?><meta property="og:title" content="Pro Poster" /><meta property="og:url" content="//<?php echo $_SERVER['SERVER_NAME'];?>
/Descripcion/Bastidores/Economico/Pro-poster"/><meta property="og:type" content="website" /><meta property="og:description" content="Todos los servicios en un mismo lugar, Impresión fotográfica profesional en todos formatos y tamaños. Álbumes digitales, foto acabados, software y más…"/><meta property="og:image" content="/img/descripcion/proPoster/pro-poster.jpg" /><meta property="og:site_name" content="<?php echo '<?=';?> $boot->company <?php echo '?>';?>"/><meta property="og:locale" content="es_LA" /><meta property="fb:app_id" content="<?php echo $_smarty_tpl->tpl_vars['boot']->value->company;?>
" /><meta property="og:image:width" content="785" /><meta property="og:image:height" content="412" /><meta name="twitter:card" content="summary_large_image"><meta name="twitter:site" content="@Mi_Album1"><meta name="twitter:title" content="Pro Poster"><meta name="twitter:description" content="Todos los servicios en un mismo lugar, Impresión fotográfica profesional en todos formatos y tamaños. Álbumes digitales, foto acabados, software y más…"><meta name="twitter:image:src" content="/img/descripcion/proPoster/pro-poster.jpg"><?php echo smarty_function_combine(array('input'=>array('/descripcionDeProductos/fotoBook/assets/css/styles.css','/css/aos.css','/css/redesSociales.css','/css/abeeZee.css','/css/sansPro.css'),'output'=>'/cache/estilosDescripcion.css','use_true_path'=>false,'age'=>'30','debug'=>false),$_smarty_tpl);
}
}
/* {/block 'head'} */
/* {block 'body'} */
class Block_108035a3adabe106651_74312531 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="article-dual-column" style="font-family:ABeeZee, sans-serif;"><div class="container"><h1 class="text-center" style="font-size:calc(5rem + 1vw);font-family:ABeeZee, sans-serif;color: rgb(86,88,91);margin-top:60px;">Pro Poster</h1><picture><source media="(min-width: 1024px)" srcset="/img/descripcion/proPoster/pro-poster.jpg"><source media="(min-width: 768px)" srcset="/img/descripcion/proPoster/pro-poster-frente-mediana.jpg"><source media="(min-width: 300px)" srcset="/img/descripcion/proPoster/pro-poster-frente-chica.jpg"><img class="img-responsive" src="/img/descripcion/proPoster/pro-poster.jpg" alt="imagen principal proPoster" title="pro Poster"></picture><p class="text-justify hidden-xs hidden-sm hidden-md hidden-lg" style="font-family:ABeeZee, sans-serif;font-size:20px;"></p><div style="text-align: center !important;padding-left: 1em;padding-top:.4em;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;">Cotizador</a></div><hr style="width:75%;"></div></div><div class="container hidden-xs hidden-sm" data-aos="fade-right" style="margin-top:5%;"><div class="col-lg-9 col-md-9 col-sm-9"><img class="img-responsive" src="/img/descripcion/proPoster/pro-poster-frente.jpg" alt="bastidor pro-poster frente" title="Pro-poster frente" data-bs-hover-animate="pulse" style="padding:18px;"></div><div class="col-lg-3 col-md-3 col-sm-3 " style="text-align:center;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;">Cotizador </a></div></div><div class="container" data-aos="fade-right" style="margin-top:5%;"><div class="col-lg-3 col-md-3 hidden-sm hidden-xs" style="text-align:center;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;">Cotizador </a></div><div class="col-lg-9 col-md-9 col-sm-12"><picture><source media="(min-width: 1024px)" srcset="/img/descripcion/proPoster/proPoster-inclinado.jpg"><source media="(min-width: 768px)" srcset="/img/descripcion/proPoster/proPoster-inclinado-mediana.jpg"><source media="(min-width: 300px)" srcset="/img/descripcion/proPoster/proPoster-inclinado-chica.jpg"><img class="img-responsive" src="/img/descripcion/proPoster/proPoster-inclinado.jpg" alt="proPoster inclinado izquierda" title="pro poster izquierda" data-bs-hover-animate="pulse" style="padding:18px;"></picture></div></div><div class="container" data-aos="fade-right" style="margin-top:5%;"><div class="col-lg-9 col-md-9 col-sm-12"><picture><source media="(min-width: 1024px)" srcset="/img/descripcion/proPoster/grosor-pro-poster.jpg"><source media="(min-width: 768px)" srcset="/img/descripcion/proPoster/grosor-pro-poster-mediana.jpg"><source media="(min-width: 300px)" srcset="/img/descripcion/proPoster/grosor-pro-poster-chica.jpg"><img class="img-responsive" src="/img/descripcion/proPoster/grosor-pro-poster.jpg" alt="grosor del bastidor pro-poster" title="grosor bastidor" data-bs-hover-animate="pulse" style="padding:18px;"></picture></div><div class="col-lg-3 col-md-3 col-sm-12 hidden-xs" style="text-align:center;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;">Cotizador </a></div></div><div class="container" data-aos="zoom-out-up" style="margin-top:5%;"><div class="col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs" style="text-align:center;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;margin:0px 15px;">Cotizador </a></div><div class="col-lg-9 col-md-9 col-sm-12"><picture><source media="(min-width: 1024px)" srcset="/img/descripcion/proPoster/pro-poster-diagonal.jpg"><source media="(min-width: 768px)" srcset="/img/descripcion/proPoster/pro-poster-diagonal-mediana.jpg"><source media="(min-width: 300px)" srcset="/img/descripcion/proPoster/pro-poster-diagonal-chica.jpg"><img class="img-responsive" src="/img/descripcion/proPoster/pro-poster-diagonal.jpg" alt="proPoster vista diagonal" title="pro poster diagonal" data-bs-hover-animate="pulse"></picture></div></div><div class="container" data-aos="zoom-out-up" style="margin-top:5%;"><div class="col-lg-9 col-md-9 col-sm-12"><picture><source media="(min-width: 1024px)" srcset="/img/descripcion/proPoster/pro-poster-acostado.jpg"><source media="(min-width: 768px)" srcset="/img/descripcion/proPoster/pro-poster-acostado-mediana.jpg"><source media="(min-width: 300px)" srcset="/img/descripcion/proPoster/pro-poster-acostado-chica.jpg"><img class="img-responsive" src="/img/descripcion/proPoster/pro-poster-acostado.jpg" alt="bastidor proPoster vista horizontal" title="pro poster horizontal" data-bs-hover-animate="pulse"></picture></div><div class="col-lg-3 col-md-3 col-sm-12 hidden-xs" style="text-align:center;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;">Cotizador </a></div></div><div class="container" data-aos="zoom-out-up" style="margin-top:5%;"><div class="col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs" style="text-align:center;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;margin:0px 15px;">Cotizador </a></div><div class="col-lg-9 col-md-9 col-sm-12"><picture><source media="(min-width: 1024px)" srcset="/img/descripcion/proPoster/pro-poster-grosor-horizontal.jpg"><source media="(min-width: 768px)" srcset="/img/descripcion/proPoster/pro-poster-grosor-horizontal-mediana.jpg"><source media="(min-width: 300px)" srcset="/img/descripcion/proPoster/pro-poster-grosor-horizontal-chica.jpg"><img class="img-responsive" src="/img/descripcion/proPoster/pro-poster-grosor-horizontal.jpg" alt="grosor horizontal bastidor pro-poster" title="Pro-poster grosor de borde" data-bs-hover-animate="pulse"></picture></div></div><div class="container" data-aos="zoom-out-up" style="margin-top:5%;"><div class="col-lg-9 col-md-9 col-sm-12"><picture><source media="(min-width: 1024px)" srcset="/img/descripcion/proPoster/vista-posterior-bastidor.jpg"><source media="(min-width: 768px)" srcset="/img/descripcion/proPoster/vista-posterior-bastidor-mediana.jpg"><source media="(min-width: 300px)" srcset="/img/descripcion/proPoster/vista-posterior-bastidor-chica.jpg"><img class="img-responsive" src="/img/descripcion/proPoster/vista-posterior-bastidor.jpg" alt="proposter vista posterior" title="Contra portada pro poster" data-bs-hover-animate="pulse"></picture></div><div class="col-lg-3 col-md-3 col-sm-12" style="text-align:center;"><a class="btn btn-danger" role="button" href="/Cotizador/bastidores/Economico/Pro-poster" style="font-size:20px;font-family:ABeeZee, sans-serif;margin:0px 15px;">Cotizador </a></div></div><div data-aos="slide-up"><div class="container"><div class="row"><div class="col-md-12"><h2 style="font-family:ABeeZee, sans-serif;color: rgb(86,88,91);">Productos Relacionados:</h2></div></div><div class="row"><div class="col-md-3 col-sm-6" style="height:334px;"><div class="thumbnail" style="height:314px;"><img src="/img/descripcion/proPoster/productos relacionados/bastidor-maria-luisa-cuadrado.jpg" alt="portada maria luisa cuadrado" title="Bastidor maria luisa cuadrado" data-bs-hover-animate="pulse" style="height:183px;"><div class="caption" style="height:66px;"><h4 class="text-left" style="font-family:ABeeZee, sans-serif;font-size:17px;text-align:center;">Bastidor María Luisa Cuadrado</h4></div><a class="btn btn-danger btn-block" role="button" href="/Descripcion/Bastidores/Economico/Bastidor-maria-luisa-cuadrado" style="margin-top:11px;">Descripción </a></div></div><div class="col-md-3 col-sm-6" style="height:334px;"><div class="thumbnail" style="height:314px;"><img src="/img/descripcion/proPoster/productos relacionados/concavo-1.jpg" alt="portada concavo 1" title="Concavo 1" data-bs-hover-animate="pulse" style="height:183px;"><div class="caption" style="height:66px;"><h4 class="text-left" style="font-family:ABeeZee, sans-serif;font-size:17px;text-align:center;">Concavo 1</h4></div><a class="btn btn-danger btn-block" role="button" href="/Descripcion/Bastidores/Economico/Concavo-1" style="margin-top:11px;">Descripción </a></div></div><div class="col-md-3 col-sm-6"><div class="thumbnail" style="height:314px;"><img src="/img/descripcion/proPoster/productos relacionados/bastidor-maria-luisa-gerardo.jpg" alt="Portada bastidor Maria Luisa Gerardo" title="Maria luisa gerardo bastidor" data-bs-hover-animate="pulse" style="height:183px;"><div class="caption" style="height:66px;"><h4 class="text-left" style="font-family:ABeeZee, sans-serif;font-size:17px;text-align:center;">Bastidor Maria Luisa Gerardo</h4></div><a class="btn btn-danger btn-block" role="button" href="/Descripcion/Bastidores/Economico/Bastidor-maria-luisa-Gerardo" style="margin-top:11px;">Descripción </a></div></div><div class="col-md-3 col-sm-6"><div class="thumbnail" style="height:314px;"><img src="/img/descripcion/proPoster/productos relacionados/pro-base.jpg" alt="portada bastidor pro base" title="Pro-base" data-bs-hover-animate="pulse" style="height:183px;"><div class="caption" style="height:66px;"><h4 class="text-left" style="font-family:ABeeZee, sans-serif;font-size:17px;text-align:center;">Pro Base</h4></div><a class="btn btn-danger btn-block" role="button" href="/Descripcion/Bastidores/Economico/Pro-base" style="margin-top:11px;">Descripción </a></div></div></div></div></div><?php
}
}
/* {/block 'body'} */
/* {block 'sb'-'site'-'exclude'} */
class Block_127845a3adabe11dd65_10004091 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<!--- Botones redes sociales --><div class="social sb-slide"><ul><li><div data-network="facebook" class="st-custom-button"><i class="fa fa-facebook-square fa-3x bgbtn" aria-hidden="true"></i></div></li><li><div data-network="whatsapp" class="st-custom-button <?php if ($_smarty_tpl->tpl_vars['boot']->value->vistaDesdeMovil == 0) {?> hidden <?php }?>"><i class="fa fa fa-whatsapp fa-3x bgbtn" aria-hidden="true"></i></div></li><li><div data-network="twitter" class="st-custom-button"><i class="fa fa-twitter-square fa-3x bgbtn" aria-hidden="true"></i></div></li><li><div data-network="googleplus" class="st-custom-button"><i class="fa fa-google-plus-square fa-3x bgbtn" aria-hidden="true"></i></div></li><li><div data-network="pinterest" class="st-custom-button"><i class="fa fa-pinterest-square fa-3x bgbtn" aria-hidden="true"></i></div></li></ul></div><?php
}
}
/* {/block 'sb'-'site'-'exclude'} */
/* {block 'scripts'} */
class Block_49695a3adabe1298e8_77088906 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo smarty_function_combine(array('input'=>array('/descripcionDeProductos/jsGeneral/bs-animation.js','/js/aos.js'),'output'=>'/cache/jsDescripcionProductos.js','use_true_path'=>false,'age'=>'30','debug'=>false),$_smarty_tpl);
echo '<script'; ?>
 type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5983630bee81010012e43782&product=custom-share-buttons"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'scripts'} */
}
