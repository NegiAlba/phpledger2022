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
        if (null !== $transactionHandler) {
            $transaction = $transactionHandler($transaction);
        }
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

function calculateTotals(array $transactions): array
{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach ($transactions as $transaction) {
        $totals['netTotal'] += $transaction['amount'];
        // $totals['netTotal'] = $totals['netTotal'] + $transaction['amount'];

        //? totalIncome augmente à chaque fois que le montant est positif

        if ($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
        //? totalExpense augmente (ou diminue) à chaque fois que le montant est négatif

        //? La condition match est similaire à switch en ce qu'elle permet de créer des conditions en fonctione de cas spécifiques. match permet aussi de comparer plusieurs cas en même temps et c'est une nouveauté de PHP8
        // match ($transaction['amount']) {
        //     $transaction['amount'] > 0 => $totals['totalIncome'] += $transaction['amount'],
        //     $transaction['amount'] < 0 => $totals['totalExpense'] -= $transaction['amount']
        // };
    }

    return $totals;
}

function exportCSV($array, $filename = 'export.csv', $delimiter = ';')
{
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    // clean output buffer
    ob_end_clean();

    $handle = fopen('php://output', 'w');

    // use keys as column titles
    fputcsv($handle, array_keys($array['0']), $delimiter);

    foreach ($array as $value) {
        fputcsv($handle, $value, $delimiter);
    }

    fclose($handle);

    // use exit to get rid of unexpected output afterward
    exit();
}