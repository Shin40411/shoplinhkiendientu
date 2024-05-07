<?php
function checkPrivilege($uri = false){
	$uri = $uri != false ? $uri : $_SERVER['REQUEST_URI'];
	$privileges = $_SESSION['login']['privileges'];
	$privileges = implode("|", $privileges);
	preg_match('/'.$privileges.'/', $uri, $matches);
	return !empty($matches);
}
?>