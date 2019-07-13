<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scan-n-order";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




?>
<!DOCTYPE html>
<html>

<head>
    <title>Invoices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/bill_style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
</head>

<body style="font-family: 'Roboto Mono', monospace;">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <div style="clear:both"></div>
    <h2 style="text-align:center;">SCAN-N-ORDER</h2><br>
    <h3 style="text-align:center;">INVOICE</h3>
    <hr>
    <center>
        <?php
        echo date("j M'y H:i");
        ?>
    </center>
    <hr>
    <div class="table-responsive">
        <table class="table table-borderless">

            <?php
            if (!empty($_SESSION["order"])) {
                $total = 0;
                foreach ($_SESSION["order"] as $key => $value) {
                    $item_name = "";
                    $item_quantity = "";
                    $item_price = "";
                    $insert_order_query = "";
                    $order_count = 1;

                    $item_name = $item_name.$value["item_name"].",";
                    $item_quantity = $item_quantity.$value["item_quantity"].",";
                    $item_price = $item_price.$value["item_quantity"]*$value["item_price"].",";



                    ?>
            <tr>

                <td><?php echo $value["item_quantity"]; ?></td>
                <td><?php echo $value["item_name"]; ?></td>
                <td><?php echo number_format($value["item_quantity"] * $value["item_price"], 2); ?></td>
            </tr>
            <?php
            $total = $total + ($value['item_quantity'] * $value['item_price']);
        }
        ?>
            <tr>
                <td colspan="2" align="right"><b>Grand Total</b></td>
                <td align="right"><b>₹<?php echo number_format($total, 2); ?><b></td>
            </tr>
            <?php

        }


        $insert_order_query = "INSERT INTO orders VALUES ('$order_count','$item_name','$item_quantity','$item_price')";
        if ($conn->query($insert_order_query) === true)
            echo "<script type='text/javascript'>alert('Order added Successfully ✔ ');</script>";
        else
            echo "Error: " . $insert_order_query . "<br>" . $conn->error;



        ?>
        </table>
</body>

</ht ml> 