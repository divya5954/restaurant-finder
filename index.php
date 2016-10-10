<!DOCTYPE html>
<?php

// admin email : admin@restrofinder.com  password : 12345678 
error_reporting(0);
//session_start();

require ('config.php');
require ('login.php');



?>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link rel='stylesheet' href="css/materialize_red_black_theme.css">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/jquery-1.11.3.js"></script>
    </head>

    <body>
       
        <nav class='z-depth-3 col s12'>
            <div class="nav-wrapper"> <a href="index.php" class="brand-logo left hide-on-small-only">Restrofinder</a>
                <ul id="nav-mobile" class="right">
                    <li><a id='log-option' class="waves-effect waves-light btn modal-trigger z-depth-2 red" href="#login-pop" name='log/reg'>Login / Register</a></li>
                </ul>
            </div>
        </nav>
        <?php

                if (array_key_exists("id",$_SESSION)){
                    // display logout button 
            ?>
            <script type="text/javascript">
                $('#log-option').removeClass('modal-trigger');
                $('#log-option').attr('href', 'index.php?logout=1');
                $('#log-option').text('Logout');
            </script>
            <?php
                }

            ?>
                <!-- ************************ -->
                <!-- POPUP FOR LOGIN / SIGNUP -->
                <!-- ************************ -->
                <div id="login-pop" class="modal">
                    <div class="modal-content">
                        <!-- login or signup markup -->
                        <div class="col s12 tabs-col">
                            <ul class="tabs">
                                <li class="tab col s6 z-depth-1"><a href="#login">Login</a></li>
                                <li class="tab col s6 z-depth-1"><a class="active" href="#signup">Register</a></li>
                            </ul>
                        </div>
                        <!-- LOGIN -->
                        <div class="col s12 m12 l8 offset-l2">
                            <div class="row">
                                <form name='login' method='post' id='login' class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="email" type="email" name="email" class="validate" autocomplete="email">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="password" type="password" name="password" class="validate">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name='login' value='1'>
                                    <div class='col s12 l12 center'>
                                        <button name='submit' id='submit login-btn' class="submit waves-effect waves-light btn z-depth-2 black-btn">Login</button>
                                    </div>
                                    <div class='col s12 l12 center'>
                                        <p class='form-error-1 form-error center'></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- SIGNUP -->
                        <div class="col s12 l8 offset-l2">
                            <div class="row">
                                <form method="post" name='signup' id='signup' class="col s12">
                                    <!--                             do email validation in php-->
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="username" name='username' type="text" class="validate" autocomplete='name' required>
                                            <label for="username">Username</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="email" type="email" name="email" class="validate" autocomplete="email" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="password" type="password" name='password' class="validate" required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name='login' value='0'>
                                    <div class='col s12 l12 center'>
                                        <button name='submit' id='submit signup' class=" submit waves-effect waves-light btn z-depth-2 black-btn">Register</button>
                                    </div>
                                    <div class='col s12 l12 center'>
                                        <p class='form-error-2 form-error center'></p>
                                    </div>
                                </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <header>
                    <div class='container fullscreen valign-wrapper'>
                        <div class="row card">
                            <div class="col m12 heading">
                                <h1 class='center'>Restrofinder</h1>
                                <h3 class='center'>Find restaurants that serve your fav food</h3>
                            </div>
                            <div class='col s12 m12 l12'>
                                <form method='post' name='search' id='search' class="col s12">
                                    <div class="col s12 m10 offset-m1 l8 offset-l2 valign-wrapper">
                                        <div class="input-field col s9 m10 l11 search-query">
                                            <input name='search-query' id="search" class='autotype' type="text"> </div>
                                        <div class='col s3 m2 l1 center'>
                                            <button name='search-btn' id='search' class="waves-effect waves-light btn z-depth-2 black"><i class="material-icons">search</i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class='col s12 center'> <a href="restaurant.php" class="waves-effect waves-light btn z-depth-2 red view-all-btn">View all restaurants</a> </div>
                        </div>
                    </div> <img id='header-bg' src="images/header1.jpg"> </header>
                <script src="materialize/js/materialize.min.js"></script>
                <script src="js/jquery.waypoints.min.js"></script>
                <script src="js/typed.js"></script>
                <script>
                    // LOGIN REQUEST AJAX
                    $('#login button').click(function (e) {
                        e.preventDefault();
                        // ajax to validate
                        $.ajax({
                            method: "POST"
                            , url: "loginValidate.php"
                            , data: {
                                email: $('#login #email').val()
                                , password: $("#login #password").val()
                            }
                        }).done(function (msg) {
                            if (msg != 'success') {
                                $('.form-error-1').text(msg);
                            }
                            else {
                                // refresh the page
                                $('.form-error-1').text('Logged in successfully');
                                location.reload();
                            }
                        });
                    });
                    // SIGNUP REQUEST AJAX
                    $('#signup button').click(function (e) {
                        e.preventDefault();
                        // ajax to validate
                        $.ajax({
                            method: "POST"
                            , url: "signupValidate.php"
                            , data: {
                                email: $('#signup #email').val()
                                , password: $("#signup #password").val()
                                , username: $("#signup #username").val()
                            }
                        }).done(function (msg) {
                            if (msg != 'success') {
                                $('.form-error-2').text(msg);
                            }
                            else {
                                //refresh the page
                                $('.form-error-2').text("Registered successfully");
                                location.reload();
                            }
                        });
                    });
                    
                    // WHEN DOC READY
                    $(document).ready(function () {
                        // FOR SELECTING TABS
                        $('ul.tabs').tabs();
                        $('.modal-trigger').leanModal();
                    });
                    // TYPING EFFECT
                    $(function () {
                        $(".autotype").typed({
                            strings: ["Search restaurants by name or type", 'Vegetarian', 'Non-veg']
                            , typeSpeed: 50
                            , startDelay: 100
                            , loop: true
                            , backDelay: 1000
                            , backspeed: 500
                        });
                    });
                    // STOP TYPING EFFECT WHEN ON FOCUS
                    $('.autotype').focusin(function () {
                        $(this).typed({
                            strings: ['']
                        });
                        $(this).val('');
                    });
                    // RESTART THE TYPING EFFCT AFTER 3s 
                    $('.autotype').focusout(function () {
                        setTimeout(function () {
                            if ($('.autotype').val() == '') { // check if no string
                                $(".autotype").typed({
                                    strings: ["Search restaurants by name or cuisine", 'Vegetarian', 'Non-veg']
                                    , typeSpeed: 50
                                    , startDelay: 100
                                    , loop: true
                                    , backDelay: 1000
                                    , backspeed: 500
                                });
                            }
                        }, 3000)
                    });
                    //CHANGE THE HEADER BG IMG EVERY 5S
                    var imgIndex = 1;
                    setTimeout(function () {
                        $('#header-bg').css("opacity", "0");
                    }, 4700);
                    setInterval(function () {
                        imgIndex += 1;
                        if (imgIndex > 4) // max index upto 4, change if needed
                            imgIndex = 1;
                        $('#header-bg').attr("src", "images/header" + imgIndex + ".jpg");
                        //FOR CROSSFADING
                        setTimeout(function () {
                            $('#header-bg').css("opacity", ".7");
                        }, 100);
                        setTimeout(function () {
                            $('#header-bg').css("opacity", "0");
                        }, 4700);
                    }, 5000);
                    // SET SIGNUP TAB ACTIVE BY DEFAULT
                </script>
    </body>

    </html>