<?php
class template {
	var $tpl_vars = array();
	
	function repvar($name, $value, $string) {
		return str_replace('{'.$name.'}', $value, $string);
	}
	
	function addvar($name, $value) {
		$this->tpl_vars[$name] = $value;
	}
	
	function display($page) {
		$fhandle = file_get_contents($page);
		foreach($this->tpl_vars as $name=>$value) $fhandle = $this->repvar($name, $value, $fhandle);
		return $fhandle;
	}
}
/*
//EXAMPLE
$tpl = new template;
$tpl->addvar('TITLE', 'Template Test');
$tpl->addvar('CONTENT', $content);
$tpl->addvar('MENU', 'Template Test');
echo $tpl->display('main.htm');
*/
?> 