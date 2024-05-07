<?php
function checkPrivilege($uri = false){
    $uri = $uri !== false ? $uri : ($_SERVER['REQUEST_URI'] ?? '');

    if(isset($_SESSION['login']) && isset($_SESSION['login']['privileges'])) {
        $privileges = $_SESSION['login']['privileges'];
        $privileges = implode("|", $privileges);
    } else {
        return false;
    }

    if(!empty($privileges)) {
        preg_match('/'.$privileges.'/', $uri, $matches);
        return !empty($matches);
    } else {
        return false;
    }
}
?>