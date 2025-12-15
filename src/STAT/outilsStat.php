<?php

function moyenne($list){
    return array_sum($list)/count($list);
}

function mediane($liste){

    if (sizeof($liste) % 2 == 1){
        $resultat = $liste[(sizeof($liste)/2) + 0.5];
    }
    else{
        $d1 = $liste[(sizeof($liste)/2) + 1];
        $d2 = $liste[(sizeof($liste)/2) - 1];
        $resultat = ($d1 + $d2) / 2;
    }
    return $resultat;
}

function topUtilisateur($list){

    if (empty($list)) {
        return null;
    }

    // Trie de la liste
    $compteur = array_count_values($list);
    arsort($compteur, SORT_STRING);

    return key($compteur);
}

function cacul_pourcentage($nombre ,$total){
    $resultat = ($nombre/$total) * 100;
    return round($resultat); // Arrondi la valeur
}

function maxTemps($list){
    $maxUser = "";
    $maxTemps = 0;
    foreach ($list as $key => $value) {
        if ($maxTemps < $value) {
            $maxUser = $key;
            $maxTemps = $value;
        }
    }

    return [$maxUser, $maxTemps];
}

function convert_int($list){
    for ($i=0; $i<count($list); $i++) {
        $list[$i] = intval($list[$i]);
    }
    return $list;
}

function tempsConnectionParUtlistateur($listUtilisateur, $listTemps){

    if (empty($listUtilisateur) || empty($listTemps)) {
        return null;
    }
    if (!is_int($listTemps[0])){
        $listTemps = convert_int($listTemps);
    }

    $listUserTemps = [];

    for($i = 0; $i < count($listUtilisateur); $i++) {
        $utilisateur = $listUtilisateur[$i];

        if (isset($listTemps[$utilisateur])) {
            $listUserTemps[$utilisateur] += $listTemps[$i];
        } else {
            $listUserTemps[$utilisateur] = $listTemps[$i];
        }
    }
    return $listUserTemps;
}
