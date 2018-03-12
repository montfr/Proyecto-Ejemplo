<?php
/* Smarty version 3.1.30, created on 2017-12-01 13:57:04
  from "D:\mi-album\templates\main.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a21b410b2a034_17488966',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4de255e18c916c8ebb79e610050aae13d1538c68' => 
    array (
      0 => 'D:\\mi-album\\templates\\main.tpl',
      1 => 1512158221,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5a21b410b2a034_17488966 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->compiled->nocache_hash = '154475a21b410af84e0_25948630';
ob_start();
echo $_smarty_tpl->tpl_vars['title']->value;
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('title'=>$_prefixVariable1,'boot'=>$_smarty_tpl->tpl_vars['boot']->value,'menu'=>$_smarty_tpl->tpl_vars['menu']->value), 0, false);
?>

<div style="min-height:1200px">
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_254125a21b410b27b86_44970037', 'body');
?>

</div>   
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('boot'=>$_smarty_tpl->tpl_vars['boot']->value), 0, false);
}
/* {block 'body'} */
class Block_254125a21b410b27b86_44970037 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
