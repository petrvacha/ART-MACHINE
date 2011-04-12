<?php //netteCache[01]000341a:2:{s:4:"time";s:21:"0.57904300 1302455801";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:52:"/var/www/evovin/app/templates/Homepage/default.latte";i:2;i:1302455797;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"7616569 released on 2011-03-10";}}}?><?php

// source file: /var/www/evovin/app/templates/Homepage/default.latte

?><?php
$_l = NLatteMacros::initRuntime($template, NULL, 'ctm2as3h09'); unset($_extends);


//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb400fda9d3d_content')) { function _lb400fda9d3d_content($_l, $_args) { extract($_args)
?>
Ahoj
<img src="new.png" />
<?php
}}

//
// end of blocks
//

if ($_l->extends) {
	ob_start();
} elseif (isset($presenter, $control) && $presenter->isAjax() && $control->isControlInvalid()) {
	return NLatteMacros::renderSnippets($control, $_l, get_defined_vars());
}
if (!$_l->extends) { call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()); }  
if ($_l->extends) {
	ob_end_clean();
	NLatteMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
