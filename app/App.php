<?php

declare(strict_types=1);

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