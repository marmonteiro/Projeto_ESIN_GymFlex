<?php 
// compara datas para organizar cronologicamente
function compareDates($a, $b) //está a ser usada!!
{
    return strtotime($a['data']) - strtotime($b['data']);
}

?>