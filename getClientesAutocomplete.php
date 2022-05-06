<?php
require "queryClientes.php";

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

getClienteByNombreAutocomplete($term);

?>