<?php

// Calcule l'âge à partir d'une date de naissance jj/mm/aaaa
function Age($date_naissance)
{
$am = explode('/', $date_naissance);
$an = explode('/', date('d/m/Y'));
if(($am[1] < $an[1]) || (($am[1] == $an[1]) && ($am[0] <= $an[0]))) return $an[2] - $am[2];
return $an[2] - $am[2] - 1;
}



