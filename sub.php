<?php
include_once 'classes/dominio/ProducaoBeneficiada.php';

$teste = new ProducaoBeneficiada(1, 100, 1500, 650, 10, 80);
echo $teste->getContido();
echo '<br />';
echo $teste->getQuantidadeComercializada();
echo '<br />';
echo $teste->getQuantidadeProduzida();
?>