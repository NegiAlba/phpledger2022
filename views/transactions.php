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
                <td>Aujourd'hui</td>
                <td>0950</td>
                <td>???</td>
                <td>Très cher</td>
            </tr>
            <tr>
                <td><?php echo $transactions[0][0]; ?></td>
                <td><?php echo $transactions[0][1]; ?></td>
                <td><?php echo $transactions[0][2]; ?></td>
                <td><?php echo $transactions[0][3]; ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <!-- YOUR CODE -->
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <!-- YOUR CODE -->
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td>
                    <!-- YOUR CODE -->
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>