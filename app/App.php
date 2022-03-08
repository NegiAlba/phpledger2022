<?php

declare(strict_types=1);

/**
 * Fonction qui permet de récupérer les fichiers CSV contenant des transactions.
 */
function getTransactionFiles(string $dirPath): array
{
    $files = [];

    // Il va se passer quelque chose
    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        }

        $files[] = $dirPath.$file;
        // array_push($files);
    }

    return $files;
}

/**
 * Fonction qui permet de récupérer le contenu d'un fichier CSV contenant des transactions.
 */
function getTransactions(string $fileName): array
{
    if (!file_exists($fileName)) {
        trigger_error("File $fileName does not exist", E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    fgetcsv($file);

    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = $transaction;
    }

    return $transactions;
}

/**
 * Fonction qui permet de transformer les infos contenus dans chaque ligne d'un fichier CSV contenant des trnsactions.
 */
function extractTransactions(array $transactionRow): array
{
    [$date, $checkNumber, $description, $amount] = $transactionRow;

    //formater les montants et les dates pendant qu'on y est
    $amount = str_replace(['$', ','], '', $amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount,
    ];
}

/**
 * Fonction qui permet d'afficher les transactions contenues sous forme d'une ligne d'un tableau HTML.
 */
function displayTransactions(array $transactions): void
{
    foreach ($transactions as $transaction) {
        echo '<tr>';
        foreach (extractTransactions($transaction) as $field) {
            echo "<td> {$field} </td>";
        }
        echo '</tr>';
    }

    return;
}