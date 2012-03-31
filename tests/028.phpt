--TEST--
Bug segfault while call exit in a view template
--SKIPIF--
<?php if (!extension_loaded("yaf")) print "skip"; ?>
--INI--
yaf.library="/php/global/dir"
--FILE--
<?php
$view = new Yaf_View_Simple(dirname(__FILE__));

$view->assign("name", "laruence");
$tpl = dirname(__FILE__) . '/foo.phtml';
function cleartpl() {
	global $tpl;
	@unlink($tpl);
}
register_shutdown_function("cleartpl");

file_put_contents($tpl, <<<HTML
okey
<?php exit; ?>
HTML
);
echo $view->render($tpl);
?>
--EXPECTF--
