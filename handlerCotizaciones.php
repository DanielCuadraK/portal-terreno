<?
require "queryCotizaciones.php";

switch ($_POST['action']) {
    case "getCotizacionAll":
        getCotizacionAll();
        break;
}
?>