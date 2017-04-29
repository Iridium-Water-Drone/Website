<?php
include("inc/config.php");

if(!isset($_SESSION['login_string'])) {
    include("index_header.php");
    include("pages/login.php");
    include("index_footer.php");
    return;
}

if (isset($_GET['p']) && file_exists('pages/'.$_GET['p'].'.php'))
{
    include("index_header.php");
  
    if(isset($_GET['p']))
        include('pages/'.$_GET['p'].'.php');
  
    include("index_footer.php");  
} elseif(!isset($_GET['p'])) {

    include("index_header.php");
    include('pages/home.php');
    include("index_footer.php");
} else {
    include("index_header.php");
    include('pages/404.php');
    include("index_footer.php");
}

?>
