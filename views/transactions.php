<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    table tr th,
    table tr td {
        padding: 5px;
        border: 1px #eee solid;
    }

    tfoot tr th,
    tfoot tr td {
        font-size: 20px;
    }

    tfoot tr th {
        text-align: right;
    }
    </style>
</head>

<body>
    <?php require_once 'navbar.php'; ?>
    <div class="container text-end my-3">
        <a href="download.php" class="btn btn-primary">
            Export CSV
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo formatDate('03/08/2022'); ?></td>
                <td>0950</td>
                <td>???</td>
                <td><?php echo formatDollarDisplay(13579.24615411424); ?></td>
            </tr>
            <?php if (!empty($transactions)) { ?>
            <?php foreach ($transactions as $transaction) { ?>
            <tr>
                <td><?php echo formatDate($transaction['date']); ?></td>
                <td><?php echo $transaction['checkNumber']; ?></td>
                <td><?php echo $transaction['description']; ?></td>
                <td><?php echo formatDollarDisplay($transaction['amount']); ?></td>
            </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <?php echo formatDollarDisplay($totals['totalIncome']); ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <?php echo formatDollarDisplay($totals['totalExpense']); ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td>
                    <?php echo formatDollarDisplay($totals['netTotal']); ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>