<?php
//fungi untuk normalisasi matriks keputusan
function normalisasi($value,$arrayValue,$sifat){
    if ($sifat=='Benefit'){
        $result=$value/max($arrayValue);
    }elseif ($sifat=='Cost'){
        $result=min($arrayValue)/$value;
    }
    return round($result,3);
}