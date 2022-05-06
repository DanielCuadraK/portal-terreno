<?php
require "queryServicios.php";

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

getServicioAutocomplete($term);

?>