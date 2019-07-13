<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Bill</title>
</head>
<body>
    <table class="table">
        <tr>
            <th>Sr. No</th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php $tot = 0; $k = 1; for( $i = 1; $i<11; $i++ ) {
            $x = 'q'.$i;
            $y = 'p'.$i;
            $z = 'n'.$i;
            if ($_POST[$x] >= 1) {
                $tot += ($_POST[$y]*$_POST[$x])
        ?>
            <tr>
                <td><?php echo $k; $k+=1; ?></td>
                <td><?php echo $_POST[$z]; ?></td>
                <td><?php echo $_POST[$y]; ?></td>
                <td><?php echo $_POST[$x]; ?></td>
            </tr>
        <?php } } ?>
        <tr><td colspan="4"><h2>Total: <?php echo $tot; ?> ₹</h2></td></tr>
    </table>
</body>
</html>
