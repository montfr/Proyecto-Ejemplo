<?php
/* Smarty version 3.1.30, created on 2017-12-01 15:00:01
  from "D:\mi-album\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a21c2d1883126_31756966',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74627e4cb767b4a8f5563cc9b22460ac78b5cd34' => 
    array (
      0 => 'D:\\mi-album\\templates\\index.tpl',
      1 => 1512161998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_5a21c2d1883126_31756966 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_replace')) require_once 'D:\\mi-album\\smarty\\plugins\\modifier.replace.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->compiled->nocache_hash = '72815a21c2d17d4ab1_96063387';
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_149345a21c2d1812b01_82366032', 'head');
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_150635a21c2d187b2e9_77413300', 'body');
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_163245a21c2d18817a9_16607842', 'scripts');
?>
  <?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'head'} */
class Block_149345a21c2d1812b01_82366032 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<style type="text/css">.carousel {max-height: 700px;overflow: hidden;}.item img {width: 100%;height: auto;}.carousel-inner{width:100%;max-height: 500px !important;}.work-item {margin-bottom: 1em;padding: 0px;}.work-item > img {display: block;height: auto;width: 100%;text-align: center;}.work-item:hover .overlay {opacity: 1;filter: alpha(opacity=100);-webkit-transform: rotateY(0deg) scale(1,1);-moz-transform: rotateY(0deg) scale(1,1);-ms-transform: rotateY(0deg) scale(1,1);-o-transform: rotateY(0deg) scale(1,1);transform: rotateY(0deg) scale(1,1);}.work-item .overlay h4 {font-size: 18px;font-weight: 700;line-height: 24px;margin: 25px 0 8px;}.work-item .overlay p {font-size: 14px;line-height: 24px;}.row-centered {text-align:center;}.col-centered {display:inline-block;float:none;text-align:left;margin-right:-4px;}.col-fixed {width:320px;}.col-min {min-width:320px;}.col-max {max-width:320px;}.btn-product{width: 100%;}hr.style-separator {padding: 0;border: none;border-top: medium double #333;color: #333;text-align: center;}hr.style-separator:after {content: "📷";display: inline-block;position: relative;top: -0.7em;font-size: 1.9em;padding: 0 0.25em;background: white;}.thumbnail:hover{border: 1px solid #e50e0b;}@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css);@import url(//s.mlcdn.co/animate.css);.col-item {border: 1px solid #E1E1E1;background: #FFF;margin-bottom:12px;}.col-item .options {position:absolute;top:6px;right:22px;}.col-item .photo {overflow: hidden;}.col-item .photo .options {display:none;}.col-item .photo img {margin: 0 auto;width: 100%;}.col-item .options-cart {position:absolute;left:22px;top:6px;display:none;}.col-item .photo:hover .options,.col-item .photo:hover .options-cart {display:block;-webkit-animation: fadeIn .5s ease;-moz-animation: fadeIn .5s ease;-ms-animation: fadeIn .5s ease;-o-animation: fadeIn .5s ease;animation: fadeIn .5s ease;}.col-item .options-cart-round {position:absolute;left:42%;top:22%;display:none;}.col-item .options-cart-round button {border-radius: 50%;padding:14px 16px;}.col-item .options-cart-round button .fa {font-size:22px;}.col-item .photo:hover .options-cart-round {display:block;-webkit-animation: fadeInDown .5s ease;-moz-animation: fadeInDown .5s ease;-ms-animation: fadeInDown .5s ease;-o-animation: fadeInDown .5s ease;animation: fadeInDown .5s ease;}.col-item .info {padding: 10px;margin-top: 1px;}.col-item .price-details {width: 100%;margin-top: 5px;}.col-item .price-details h1 {font-size: 14px;line-height: 20px;margin: 0;float:left;}.col-item .price-details .details {margin-bottom: 0px;font-size:12px;}.col-item .price-details span {float:right;}.col-item .price-details .price-new {font-size:16px;}.col-item .price-details .price-old {font-size:18px;text-decoration:line-through;}.col-item .separator {border-top: 1px solid #E1E1E1;}.col-item .clear-left {clear: left;}.col-item .separator a {text-decoration:none;}.col-item .separator p {margin-bottom: 0;margin-top: 6px;text-align: center;}</style><?php
}
}
/* {/block 'head'} */
/* {block 'body'} */
class Block_150635a21c2d187b2e9_77413300 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="carousel-example-generic" class="carousel slide " data-ride="carousel"><ol class="carousel-indicators"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slider']->value, 'curr_slider', false, 'key');
$_smarty_tpl->tpl_vars['curr_slider']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['curr_slider']->value) {
$_smarty_tpl->tpl_vars['curr_slider']->index++;
$_smarty_tpl->tpl_vars['curr_slider']->first = !$_smarty_tpl->tpl_vars['curr_slider']->index;
$__foreach_curr_slider_0_saved = $_smarty_tpl->tpl_vars['curr_slider'];
?><li data-target="#carousel-example-generic" data-slide-to="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['curr_slider']->first) {?>class="active"<?php }?>></li><?php
$_smarty_tpl->tpl_vars['curr_slider'] = $__foreach_curr_slider_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
</ol><div class="carousel-inner"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slider']->value, 'curr_slider', false, 'key');
$_smarty_tpl->tpl_vars['curr_slider']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['curr_slider']->value) {
$_smarty_tpl->tpl_vars['curr_slider']->index++;
$_smarty_tpl->tpl_vars['curr_slider']->first = !$_smarty_tpl->tpl_vars['curr_slider']->index;
$__foreach_curr_slider_1_saved = $_smarty_tpl->tpl_vars['curr_slider'];
?><div class="item  <?php if ($_smarty_tpl->tpl_vars['curr_slider']->first) {?> active<?php }?>"><img class="sliderImg" src="<?php echo $_smarty_tpl->tpl_vars['curr_slider']->value['img'];?>
" alt="..."></div><?php
$_smarty_tpl->tpl_vars['curr_slider'] = $__foreach_curr_slider_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
</div><a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a></div><br><div class="flex-container"><div class="container"><h1 class="text-center"><?php echo $_smarty_tpl->tpl_vars['slider']->value[0]['titulo'];?>
</h1><p class="lead text-justify" style="line-height: 1.8em;"><?php echo $_smarty_tpl->tpl_vars['slider']->value[0]['descripcion'];?>
</p></div><hr></div><div class="row"><div class="col-md-12"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value, 'curr_menu', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['curr_menu']->value) {
if ($_smarty_tpl->tpl_vars['curr_menu']->value['producto'] == 1) {?><div class="col-sm-12 col-md-12" style="margin-top: 2em;"><div class="thumbnail"><div class="row"><div class="col-md-12 text-center"><h2><?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'];?>
</h2></div><div class="col-md-2 pull-right"><button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Comprar" onclick="window.open('/cotizador/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['categoria'],' ','-');?>
/<?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['servicio'];?>
/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
','_self');"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button><button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Descripción" onclick="window.open('/cotizador/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['categoria'],' ','-');?>
/<?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['servicio'];?>
/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
','_self');"><i class="fa fa-eye" aria-hidden="true"></i></button></div></div><a title="Comprar" href="/cotizador<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['categoria'],' ','-');?>
/<?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['servicio'];?>
/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
);<?php echo '/*%%SmartyNocache:72815a21c2d17d4ab1_96063387%%*/<?php echo \'?>\';?>/*/%%SmartyNocache:72815a21c2d17d4ab1_96063387%%*/';?>
"><img class="img-responsive" style="height: 400px;" src="/img/2/fotosIndex/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
" ></a></div></div><?php } elseif ($_smarty_tpl->tpl_vars['curr_menu']->value['producto'] == 1 && $_smarty_tpl->tpl_vars['boot']->value->socio == 7) {?><div class="col-sm-12 col-md-12 product"><div class="thumbnail"><div class="row"><div class="col-md-2 pull-right"><button style="margin-top: 16px;" class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Comprar" onclick="mostrarTipoDeProyecto()"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button></div></div><a href="#"><img onclick="envioDeDatosImpresionesDirecto()" style="height: 400px;" src="/img/2/fotosIndex/banner-impresion.jpg" class="img-responsive"></a></div></div><?php } else {
if ($_smarty_tpl->tpl_vars['curr_menu']->value['categoria'] != $_smarty_tpl->tpl_vars['menu']->value[$_smarty_tpl->tpl_vars['key']->value-1]['categoria']) {?><div class="row-fluid"><div class="col-md-12 text-center"><h1><?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'];?>
</h1></div></div><?php } elseif ($_smarty_tpl->tpl_vars['curr_menu']->value['producto'] != 59) {?><div class="col-sm-6 col-md-6 product" style="margin-top: 2em;"><div class="thumbnail"><div class="row"><div class="col-md-9 col-md-offset-1" style="min-height:100px;"><h2><?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'];?>
</h2></div><div class="col-md-2 pull-right"><button style="margin-top: 16px;" class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Comprar" onclick="window.open('/cotizador/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['categoria'],' ','-');?>
/<?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['servicio'];?>
/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
','_self');"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button><button style="margin-top: 16px;" class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Descripción" onclick="window.open('/cotizador/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['categoria'],' ','-');?>
/<?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['servicio'];?>
/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
','_self');"><i class="fa fa-eye" aria-hidden="true"></i></button></div></div><a title="Comprar" href="/cotizador<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['categoria'],' ','-');?>
/<?php echo $_smarty_tpl->tpl_vars['curr_menu']->value['servicio'];?>
/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
"><img class="img-responsive" style="height: 400px;" src="/img/2/fotosIndex/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['curr_menu']->value['nombreProducto'],' ','-');?>
.jpg" ></a></div></div><?php }
}
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
</div></div><?php
}
}
/* {/block 'body'} */
/* {block 'scripts'} */
class Block_163245a21c2d18817a9_16607842 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="/js/index.js"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'scripts'} */
}
