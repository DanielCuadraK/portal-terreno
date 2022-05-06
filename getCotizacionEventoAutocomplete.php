<?php
require "queryCotizaciones.php";

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

getCotizacionEventoAutocomplete($term);

?>