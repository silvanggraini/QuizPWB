<?php
session_start();
session_unset();
session_destroy();

setcookie('key','', time() - 3600);
setcookie('word','', time() - 3600);

header("Location: login.php");
exit;

?>