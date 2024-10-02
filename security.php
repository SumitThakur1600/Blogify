<?php
require("database.php");
if($_SESSION['login']=='true'){
}
else{
    header("Location: login.php");
}

?>