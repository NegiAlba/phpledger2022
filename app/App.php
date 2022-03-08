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
function getTransactions(string $fileName, ?callable $transactionHandler = null): array
{
    if (!file_exists($fileName)) {
        trigger_error("File $fileName does not exist", E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    fgetcsv($file);

    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        //? Rajouter le traitement de la ligne de transaction par un callable
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

    //formater les montants pendant qu'on y est

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount,
    ];
}

function calculateTotals(array $transactions): array
{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach ($transactions as $transaction) {
        //? La condition match est similaire à switch en ce qu'elle permet de créer des conditions en fonctione de cas spécifiques. match permet aussi de comparer plusieurs cas en même temps et c'est une nouveauté de PHP8

        //! VOUS N'ETES PAS OBLIGÉS D'UTILISER MATCH
    }

    return $totals;
}