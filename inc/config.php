<?php

//configure constants
//$conn = mysqli_connect("localhost",'at_healthcare','bangna','cy!C51x3');
$conn = mysqli_connect("localhost",'root','','at_healthcare');
$result = mysqli_query($conn,"Select DISTINCT group1 From email Order By group1");
//while($row = mysqli_fetch_array($result)){
    //$tmp = array();
    //$tmp["group1"] = $row["group1"];
    //$tmp["prov_name"] = $row["prov_name"];
    //array_push($resultArray,$tmp);
//}
mysqli_close($conn);

$directory = realpath(dirname(__FILE__));
$document_root = realpath($_SERVER['DOCUMENT_ROOT']);
$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .
    $_SERVER['HTTP_HOST'];
if(strpos($directory, $document_root)===0) {
    $base_url .= str_replace(DIRECTORY_SEPARATOR, '/', substr($directory, strlen($document_root)));
}
$base_url = str_replace("inc","",$base_url);
$userLogin = "";
defined("APP_URL") ? null : define("APP_URL", str_replace("/lib", "", $base_url));
//Assets URL, location of your css, img, js, etc. files
defined("ASSETS_URL") ? null : define("ASSETS_URL", APP_URL);


//require library files
//require_once("util.php");

require_once("func.global.php");

require_once("smartui/class.smartutil.php");
require_once("smartui/class.smartui.php");

// smart UI plugins
require_once("smartui/class.smartui-widget.php");
require_once("smartui/class.smartui-datatable.php");
require_once("smartui/class.smartui-button.php");
require_once("smartui/class.smartui-tab.php");
require_once("smartui/class.smartui-accordion.php");
require_once("smartui/class.smartui-carousel.php");
require_once("smartui/class.smartui-smartform.php");
require_once("smartui/class.smartui-nav.php");

SmartUI::$icon_source = 'fa';

// register our UI plugins
SmartUI::register('widget', 'Widget');
SmartUI::register('datatable', 'DataTable');
SmartUI::register('button', 'Button');
SmartUI::register('tab', 'Tab');
SmartUI::register('accordion', 'Accordion');
SmartUI::register('carousel', 'Carousel');
SmartUI::register('smartform', 'SmartForm');
SmartUI::register('nav', 'Nav');

require_once("class.html-indent.php");
require_once("class.parsedown.php");



?>