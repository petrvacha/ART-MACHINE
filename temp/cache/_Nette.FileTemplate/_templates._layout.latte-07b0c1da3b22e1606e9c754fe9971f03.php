<?php //netteCache[01]000340a:2:{s:4:"time";s:21:"0.04397900 1302357211";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:51:"/var/www/evovin/sandbox/app/templates/@layout.latte";i:2;i:1302134553;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"7616569 released on 2011-03-10";}}}?><?php

// source file: /var/www/evovin/sandbox/app/templates/@layout.latte

?><?php
$_l = NLatteMacros::initRuntime($template, NULL, '20rs498c4v'); unset($_extends);


//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb97a7092a57_head')) { function _lb97a7092a57_head($_l, $_args) { extract($_args)
;
}}

//
// end of blocks
//

if ($_l->extends) {
	ob_start();
} elseif (isset($presenter, $control) && $presenter->isAjax() && $control->isControlInvalid()) {
	return NLatteMacros::renderSnippets($control, $_l, get_defined_vars());
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="description" content="Nette Framework web application skeleton" /><?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo NTemplateHelpers::escapeHtml($robots) ?>" />
<?php endif ?>

	<title>EVOVIN generator</title>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo NTemplateHelpers::escapeHtml($basePath) ?>/css/screen.css" type="text/css" />
	<link rel="stylesheet" media="print" href="<?php echo NTemplateHelpers::escapeHtml($basePath) ?>/css/print.css" type="text/css" />
	<link rel="shortcut icon" href="<?php echo NTemplateHelpers::escapeHtml($basePath) ?>/favicon.ico" type="image/x-icon" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo NTemplateHelpers::escapeHtml($basePath) ?>/js/netteForms.js"></script>
	<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()); } ?>

</head>

<body><?php foreach ($iterator = $_l->its[] = new NSmartCachingIterator($flashes) as $flash): ?>
	<div class="flash <?php echo NTemplateHelpers::escapeHtml($flash->type) ?>"><?php echo NTemplateHelpers::escapeHtml($flash->message) ?></div>
<?php endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

<?php NLatteMacros::callBlock($_l, 'content', $template->getParams()) ?>
</body>
</html>
<?php
if ($_l->extends) {
	ob_end_clean();
	NLatteMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
