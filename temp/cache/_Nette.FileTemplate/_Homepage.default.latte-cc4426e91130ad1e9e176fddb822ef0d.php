<?php //netteCache[01]000341a:2:{s:4:"time";s:21:"0.31096000 1302645521";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:52:"/var/www/evovin/app/templates/Homepage/default.latte";i:2;i:1302645520;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"7616569 released on 2011-03-10";}}}?><?php

// source file: /var/www/evovin/app/templates/Homepage/default.latte

?><?php
$_l = NLatteMacros::initRuntime($template, NULL, '7nzqfm8lj7'); unset($_extends);


//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbec44d55f43_content')) { function _lbec44d55f43_content($_l, $_args) { extract($_args)
?>

<h1>evovin generátor</h1>

<img style="float:left; margin-right:10px" src="new.png" /> <img src="new2.png" />

<script>
      $(document.body).ready(function () {
        $("img:hidden:eq(0)").fadeIn(1200);
        $("img:hidden:eq(1)").fadeIn(1200);
      });
</script>
    
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
