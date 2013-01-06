<?php
/*if(file_exists('update.php'))
{
    echo "Please delete update.php! (After running it!)";
    exit;
}*/
if(file_exists('convert.php'))
{
    echo "Please delete convert.php! (After running it!)";
    exit;
}
define('ALLOW_INCLUDE', 1); 

require 'system/includes/config.php';
$settings['version'] = "2.02"; 
require 'system/includes/functions.php';

// ####################### SET PHP ENVIRONMENT ###########################
error_reporting (E_ALL | E_STRICT);

// ####################### START MAIN SCRIPT ###########################
ob_start("ob_gzhandler");

header("Content-Type: text/html; charset=utf-8"); 

if (isset($_GET['do']))    
{
    $valid_tools=array("fetch_avatars");
    
    if (in_array($_GET['do'], $valid_tools)) 
    {
        require "system/tools/".$_GET['do'].".php";
        exit;
    }
}

$pages = array("drops");
$page="";
if (isset($_GET['page'])) $page = strtolower($_GET['page']);

if(!in_array($page, $pages))
{                    
     $page = "drops";
}

?>

<!DOCTYPE html>
<html dir="ltr">
<?php
    include "system/pages/" . $page . '.php';
?>

</html>

