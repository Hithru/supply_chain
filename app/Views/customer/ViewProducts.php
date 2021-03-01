
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Level HTML Template</title>
<!--

Template 2095 Level

http://www.tooplate.com/view/2095-level

-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="http://localhost/supply_chain/public/font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="http://localhost/supply_chain/public/css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="http://localhost/supply_chain/public/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/supply_chain/public/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/supply_chain/public/css/datepicker.css"/>
    <link rel="stylesheet" href="http://localhost/supply_chain/public/css/tooplate-style.css">                                   <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
</head>

    <body>
        <div class="tm-main-content" id="top">
            <div class="tm-top-bar-bg"></div>
            <div class="tm-top-bar" id="tm-top-bar">
                <!-- Top Navbar -->
                <div class="container">
                    <div class="row">

                        <nav class="navbar navbar-expand-lg narbar-light">
                            <a class="navbar-brand mr-auto" href="#">
                                <img src="http://localhost/supply_chain/public/img/logo.png" alt="Site logo">
                                Level
                            </a>
                            <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                                <ul class="navbar-nav ml-auto">
                                  <li class="nav-item">
                                    <a class="nav-link" href="viewHome">Home </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="viewProducts">Buy Now</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="viewOrders">Your Orders</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="viewContact">Contact Us</a>
                                  </li>

                                    <li class="nav-item">
<!--                                        <form method="post" action="logout">
                                            <button class="nav-link">Logout</button>
                                        </form>-->
                                        <a class="nav-link" href="logout">Log Out</a>

                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="my-4 mx-auto">
                <?php  if($productDetails){ ?>
                <table style='background:#ffffff' class="table">
                    <thead class='thead-dark'>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Remaining Stocks</th>
                        <th>Select Quantity</th>
                        <th>Buy Now</th>
<!--                        <th>Qty</th>
                        <th>Update Qty</th>
                        <th>Total</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    $qty = 0;

                    foreach ($productDetails as $product) {?>
                        <tr>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['price'] ?></td>
                            <td><?php echo $product['stock'] ?></td>
                            <form action="buyProduct" method="POST">
                                <input name="item_id" value="<?php echo $product['item_id'] ?>" hidden>
                                <input name="price" value="<?php echo $product['price'] ?>" hidden>
                                <input name="stock" value="<?php echo $product['stock'] ?>" hidden>
                                <td>
                                <select  id="qty" name="qty"  >
                                    <?php
                                    $limit = $product['stock'];
                                    for ($x = 0; $x <= $limit; $x++ ){?>
                                        <option name="qty" value=<?php  echo $x ?>><?php  echo $x  ?></option>
                                    <?php  }  ?>

                                </select>
                                </td>
                                <td><button class='btn btn-sm btn-danger'>Buy Now</button></td>
                            </form>
 <!--                           <td>

                            </td>
                            <td>
                                <form class='d-inline' action="<?php /*echo URL */?>/carts/updateQty/<?php /*echo $cart->product */?> " method="POST">
                                    <input style='width:35px;height:20px' type="text" name="qty">
                                    <input type="hidden" name="csrf" value="<?php /*new Csrf(); echo Csrf::get()*/?>">
                                    <input  class='d-inline btn btn-info btn-sm py-0' name='upQty' type="submit" value='Up'>
                                </form>
                                <form class='d-inline' action="<?php /*echo URL */?>/carts/delete/<?php /*echo $cart->cart_id */?>" method='GET'>
                                    <input type="hidden" name="csrf" value="<?php /*new Csrf(); echo Csrf::get()*/?>">
                                    <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                            <td><?php
/*

                                echo number_format($cart->qty * $cart->price, 2 , '.', '');
                                */?></td>-->
                        </tr>
                        <?php
/*                        $total = $total + ($cart->qty * $cart->price);
                        $qty = $qty + ($cart->qty);*/
                    }?>
                    </tbody>
                </table>
                <?php  }  ?>
            </div>





        </div>

        <!-- load JS files -->
        <script src="http://localhost/supply_chain/public/js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="http://localhost/supply_chain/public/js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->
        <script src="http://localhost/supply_chain/public/js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
        <script src="http://localhost/supply_chain/public/js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
        <script src="http://localhost/supply_chain/public/js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        <script src="http://localhost/supply_chain/public/slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->



</body>
</html>

