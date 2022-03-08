<?php

declare(strict_types=1);

$root = dirname(__DIR__).DIRECTORY_SEPARATOR;
define('APP_PATH', $root.'app'.DIRECTORY_SEPARATOR);
define('FILES_PATH', $root.'transaction_files'.DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root.'views'.DIRECTORY_SEPARATOR);

require APP_PATH.'App.php';
require APP_PATH.'helpers.php';

$files = getTransactionFiles(FILES_PATH);
$transactions = [];

// Pour chaque fichier qui existe dans le dossier transaction_files, ajoute ses informations à la suite du tableau $transactions.
foreach ($files as $file) {
    $transactions = array_merge($transactions, getTransactions($file, 'extractTransactions'));
}

$totals = 0;

require VIEWS_PATH.'transactions.php';