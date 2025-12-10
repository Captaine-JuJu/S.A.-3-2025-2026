<?php


function moyenne($list){
    return array_sum($list)/count($list);
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

function topTempsConnection($list){
    if (empty($list)) {
        return null;
    }



}
