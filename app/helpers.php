<?php

declare(strict_types=1);

function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
}

//? Fonction qui formate les montants
// si mon nombre est négatif
// alors afficher mon nombre avec un $ et un moins devant
// sinon afficher avec un dollar devant