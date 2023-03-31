<?php

function minify($overview) {

    if (strlen($overview) <= 500) {
        return $overview;
    }
    
    // Sépare le paragraphe en phrases en utilisant un point, un point d'exclamation ou un point d'interrogation comme séparateurs
    $phrases = preg_split('/(?<=[.!?])\s+/', $overview, -1, PREG_SPLIT_NO_EMPTY);

    // Supprime les phrases en trop jusqu'à ce que la longueur de l'overview soit égale ou inférieure à 300 caractères
    while (strlen($overview) > 500) {
        array_pop($phrases);
        $overview = implode(' ', $phrases);
    }

    return $overview;
}

