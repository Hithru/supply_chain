
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

                                <a class="nav-link" href="logout">Log Out</a>

                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <?php echo ($data['orderDetails']) ?>
    <div class="   mt-4">
        <h5 class="text-center">Your Orders</h5>
        <div class="card my-3">
            <div class="card-header">
                <i class="fa fa-shopping-basket"></i> Order Details
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm" >

                    <?php if($orderDetails){ ?>
                        <thead class='text-truncate'>
                        <th>Series</th>
                        <th>Order Date</th>
                        <th>Ship Date</th>
                        <th>Status</th>
                        <th>SubTotal</th>
                        <th>Operations</th>
                        </thead>
                        <?php

                        $i = 0;
                        foreach ($orderDetails as $order) { $i++?>
                            <tbody>
                            <td><?php echo $order['order_id'] ?></td>
                            <td><?php echo $order['order_date'] ?></td>
                            <td><?php echo $order['ship_date'] ?></td>
                            <td><?php echo $order['status'] ?></td>
                            <td>Rs. <?php echo $order['total_bill'] ?></td>
                            <td>
                                <?php if ($order['status']=="Open") {?>
                                    <form action="cancelOrder" method="POST">
                                        <input name="order_id" value="<?php echo $order['order_id'] ?>" hidden>
                                        <button class='btn btn-sm btn-danger'>Cancel the Order</button>
                                    </form>


                                <?php  }  ?>
                            </td>
                            </tbody>
                        <?php }
                    }else{?>
                        <?php echo ($orderDetails[0]['order_id']) ?>
                        <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Orders</p>
                    <?php  }
                    ?>

                </table>
            </div>
        </div>
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

