<?php
session_start();
// session_destroy();
$db = mysqli_connect('localhost', 'root', '', 'scan-n-order') or die('error to connect');


if (isset($_POST["add"])) {
    if (isset($_SESSION["order"])) {
        $item_array_id = array_column($_SESSION["order"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["order"]);
            $item_array = array(
                'item_id'   =>  $_GET["id"],
                'item_name'     =>  $_POST["hidden_name"],
                'item_price'     =>  $_POST["hidden_price"],
                'item_quantity'  =>  $_POST["quantity"]
            );
            $_SESSION["order"][$count] = $item_array;
            echo '<script>window.location="menu.php"</script>';
        } else {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="menu.php"</script>';
        }
    } else {
        $item_array = array(
            'item_id'   =>  $_GET["id"],
            'item_name'     =>  $_POST["hidden_name"],
            'item_price'     =>  $_POST["hidden_price"],
            'item_quantity'  =>  $_POST["quantity"]
        );
        $_SESSION["order"][0] = $item_array;
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["order"] as $keys => $value) {
            if ($value["item_id"] == $_GET["id"]) {
                unset($_SESSION["order"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="menu.php"</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Menu</title>
    <link rel="stylesheet" href="style/menu_style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        html {

            scroll-behavior: smooth;
        }
    </style>


</head>

<body style="background: #d0d5db">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Scan-N-Order</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="menu.php">Menu</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="contact_us.html">Contact Us</a>
                </li>

            </ul>
            <button id="login" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="width: 200px; background: #2ecc71;color: white;" onclick="location.href ='login.html'">Login</button>

        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1">
            <i class="fas fa-utensils"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href=#Starters>Starters</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#Chinese>Chinese</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#Italian>Italian</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#South_Indian>South Indian</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#Punjabi>Punjabi</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#Fast_Food>Fast Food</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#Ice_Cream>Ice Cream</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#Beverages>Beverages</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href=#Place_Order>PLACE ORDER</a>
                </li>

            </ul>
        </div>
    </nav>
    <!-- Heading -->



    <center id="Starters">
        <h2>Starters</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from Starters";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn" onclick="location.reload()" target="ordered">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>
    <center id="Chinese">
        <h2>Chinese</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from chinese";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn" onclick="location.reload()" target="ordered">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>
    <center id="Italian">
        <h2>Italian</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from italian";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn" onclick="location.reload()" target="ordered">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>
    <center id="South_Indian">
        <h2>South Indian</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from south_indian";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn" onclick="location.reload()" target="ordered">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>
    <center id="Punjabi">
        <h2>Punjabi</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from punjabi";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn" onclick="location.reload()" target="ordered">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>
    <center id="Fast_Food">
        <h2>Fast Food</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from fast_food";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn" onclick="location.reload()" target="ordered">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>
    <center id="Ice_Cream">
        <h2>Ice Cream</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from ice_cream";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>
    <center id="Beverages">
        <h2>Beverages</h2>
        <table class="table">
            <tr>

                <th name="name" width="35%">Name</th>
                <th width="20%">Price</th>
                <th width="20%">Quan.</th>
                <th width="25%">Action</th>
            </tr>
            <?php
            $query = "select * from beverages";
            $result = mysqli_query($db, $query);
            while ($rows = mysqli_fetch_array($result)) {
                ?>
            <div class="col-md-4">

                <tr>
                    <form action="menu.php?action=add&id=<?php echo $rows['Id']; ?>" method="post">

                        <td id="name" name="name"><?php echo $rows['Name']; ?></td>
                        <td id="price"><?php echo "₹";
                                        echo $rows['Price']; ?></td>
                        <td><input type="text" name="quantity" size="1" style="font-size:20px;" class="form-control" value="1"></td>
                        <input type="hidden" name="hidden_name" value="<?php echo $rows['Name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $rows['Price']; ?>" />
                        <td><button id="add" name="add" class="btn">ADD</button></td>

                    </form>
                </tr>
            </div>
            <?php 
        }
        ?>
        </table>
    </center>


    <div style="clear:both" id="Place_Order"></div>
    <h3 style="text-align:center;">Order Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Item Name</th>
                <th>Quan.</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
            if (!empty($_SESSION["order"])) {
                $total = 0;
                foreach ($_SESSION["order"] as $key => $value) {
                    ?>
            <tr>
                <td><?php echo $value["item_name"]; ?></td>
                <td><?php echo $value["item_quantity"]; ?></td>
                <td><?php echo $value["item_price"]; ?></td>
                <td><?php echo $value["item_quantity"] * $value["item_price"]; ?></td>
                <td><a href="menu.php?action=delete&id=<?php echo $value["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
            </tr>
            <?php
            $total = $total + ($value['item_quantity'] * $value['item_price']);
        }
        ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">₹ <?php echo $total; ?></td>
            </tr>
            <tr>
                <td colspan="5"><a href="backend/bill.php"><button id="add" name="add" class="btn">Place Order</button></a></td>
            </tr>
            <?php

        }
        ?>
        </table>
    </div>
</body>

</html> 