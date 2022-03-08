<?php

declare(strict_types=1);

$root = dirname(__DIR__).DIRECTORY_SEPARATOR;
define('APP_PATH', $root.'app'.DIRECTORY_SEPARATOR);
define('FILES_PATH', $root.'transaction_files'.DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root.'views'.DIRECTORY_SEPARATOR);

require APP_PATH.'App.php';

getTransactionFiles(FILES_PATH);

echo '<pre>';
print_r(getTransactionFiles(FILES_PATH));
echo '</pre>';

echo '<pre>';
print_r($transactions = getTransactions('C:\xampp\htdocs\phpledger\transaction_files\example.csv'));
echo '</pre>';

//  getTransactions('C:\xampp\htdocs\phpledger\transaction_files\example.csv');

require VIEWS_PATH.'transactions.php';