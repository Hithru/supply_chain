<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/supply_chain/public/css/login.css">
</head>
<body>


<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="register" method="POST">

            <h1>Create Account</h1>

            <input type="text" placeholder="Name" name="name"/>
            <input type="email" placeholder="Email" name="email"/>
            <input type="password" placeholder="Password" name="password"/>
            <input type="text" placeholder="Address" name="address"/>

            <select type="text" id="route" name="route" >
                <?php
                foreach ($routeDetails as $route) {?>
                    <option value=<?php  echo $route["route_id"]  ?>><?php  echo $route["description"]  ?></option>
                <?php  }  ?>

            </select>
            <input type="text" placeholder="tel_no" name="tel_no"/>
            <select type="text" id="type" name="type" >
                <option value="consumer">consumer</option>
                <option value="retail">retail</option>
                <option value="wholesale">wholesale</option>
            </select>
            <button>Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="login" method="POST">
            <h1>Sign in</h1>


            <input type="email" id="email" name="email" placeholder="Email" />
            <input type="password" id ="email" name = "password" placeholder="Password" />

            <button>Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>


<script src="http://localhost/SUPPLY_CHAIN/public/js/login.js"></script>
</body>
</html>