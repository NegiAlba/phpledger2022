<?php

declare(strict_types=1);

function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
}

function formatDollarDisplay(float $amount): string
{
    if ($amount < 0) {
        return "<span style='color: red;'> -$".number_format(abs($amount), 2).'</span>';
    } elseif (0 == $amount) {
        return '$'.number_format(abs($amount), 2);
    } else {
        return "<span style='color: green;'>$".number_format(abs($amount), 2).'</span>';
    }
}

//? Fonction qui formate les montants
// si mon nombre est négatif
// alors afficher mon nombre avec un $ et un moins devant
// sinon afficher avec un dollar devant