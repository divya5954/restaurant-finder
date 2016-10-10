<?php 
error_reporting(0);
include('config.php'); 
require('login.php'); 

// redirect if no rest_id
if (!$_GET){
    header('location:index.php');
}

// *****************************************
// DON'T KNOW WHAT THE FOLLOWING CODE IS FOR
// *****************************************
//$_SESSION['email']="aabha@restro.com";
//try{
//if(isset($_POST['submit']))
//{
//	$id = $_GET['id'];
//	$uemail=$_SESSION['email'];
//	if($_POST['review'])
//	{
//        $rev=$_POST['review'];
//	    $sql = $db->query('SELECT * FROM `user` WHERE `u_email`="'.$uemail.'"');
//            while($row = $sql->fetch())
//            {
//                if($uemail==$row['u_email'])
//                {
//                    $uid=$row['u_id'];
//                }
//            }
//	$sql=$db->prepare('INSERT INTO admin (a_rev,a_restid, u_id) VALUES (:a_rev,:a_restid,:a_uid)');
//	$sql->execute(array(':a_rev'=>$rev, ':a_restid'=>$id, ':a_uid'=>$uid));
//	}
//	if($_POST['suggest'])
//	{
//		$sug=$_POST['suggest'];
//		$sql = $db->query('SELECT * FROM `user` WHERE `u_email`="'.$uemail.'"');
//        while($row = $sql->fetch())
//        {
//            if($uemail==$row['u_email'])
//            {
//                $uid=$row['u_id'];
//            }
//        }
//		$sql=$db->prepare('INSERT INTO suggestion (s_id,u_id,suggestion) VALUES (:s_id, :u_id, :suggestion)');
//	$sql->execute(array(':s_id'=>NULL, ':u_id'=>$uid, 'suggestion'=>$sug));
//	}
//	
//	}
//
//}catch(PDOException $e){
//    echo $e->getMessage();
//    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <link rel='stylesheet' href="css/materialize_red_black_theme.css">
    <link rel="stylesheet" href="css/details.css"> 
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
    
    <!-- START WORKING FROM HERE --> 
    <main>
        
    <?php
    // for restaurant details
        $query = "SELECT * FROM `restaurant` WHERE r_id = '".$_GET['id']."' LIMIT 1";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
//        print_r($row);
        
        
    ?>
         
    <div class='row jumbo'>
        <div class='col s12 parallax-container'>
            <div class='col s12 parallax'>
                <img id='rest-img' src="images/rest1.jpg">
                <img id='rest-img' src="<?php echo $row['r_pic'];?>">


                <div class='text valign-wrapper'>
                    <div class='col l8 info-set-1'>
                        <h2><?php echo $row['r_name']; ?></h2>
                        <h5 class='valign-wrapper'><i class='material-icons'>location_on</i> <?php echo $row['r_add']; ?></h5>
                        <h5 class='valign-wrapper'><i class='material-icons'>stay_current_portrait</i><?php echo $row['r_contact']; ?></h5>
                    </div>
                    <div class='col l4 info-set-2'>
                        <h5><i class='material-icons'>&#8377; &nbsp;</i><span><?php echo $row['r_cost']; ?></span></h5>
                        <h5 class='valign-wrapper'><i class='material-icons'>query_builder</i> <span><?php echo $row['r_time']; ?></span><span>&nbsp;-&nbsp; </span><span>closing time</span></h5>
                        <h5 class='valign-wrapper'><i class='material-icons'>done</i><?php echo $row['r_cuisine']; ?></h5>
                        <h5 class='valign-wrapper'><i class='material-icons'>done</i> <?php echo $row['r_type']; ?></h5>
                        
                        
                    </div>
                </div>
               

                </div>   
            </div>
        </div>
        
        <!-- MENU POPUP STARTS HERE -->
        <div id='menu-pop' class='modal menu-pop'>
            <div class='modal-content'>
               
                <!-- *********** -->
                <!-- MENU IMAGES -->
                <!-- *********** -->
                <img src="images/header2.jpg">
            </div>
        </div>
      

        <div class='container'>
           <div class='col s12 center'>
               <a href="#menu-pop" name='menu-btn' class="waves-effect waves-light btn modal-trigger z-depth-1 menu-btn">View Menu</a>
           </div>
            
            <!-- HIDE ADD REVIEW SECTION IF NOT LOGGED IN -->
            <div class='row add-reviews'>
                <h3>Add review</h3>
                
                <div class='col s12 m12 l10 offset-l1'>
                <form method="post" name='new-review' id='new-review' class="col s12" novalidate>
                <!-- STARS SHIT HERE -->
                <!-- READ CAREFULLY : WHEN CLICKING ON A STAR, THE CORRESPONDING VALUE IS STORED IN THE HIDDEN INPUT ELEMENT WITH NAME RATING...SO WHEN FORM IS SUBMITTED, $_POST['rating'] WILL GIVE THE RATING -->
                <div class='row'>
                  <div class='col s12'>
                        <input name='rating' id='rating' type="hidden" value='1'>
                        <div class='star-row'>
                            <span><p>Add your rating :</p></span>                                   
                            <span class='star' data-value='1'><i class='material-icons'>star</i></span>
                            <span class='star' data-value='2'><i class='material-icons'>star</i></span>
                            <span class='star' data-value='3'><i class='material-icons'>star</i></span>
                            <span class='star' data-value='4'><i class='material-icons'>star</i></span>
                            <span class='star' data-value='5'><i class='material-icons'>star</i></span>
                        </div>
                  </div>
                </div>

                 <div class="row">
                    <div class="input-field col s12">
                      <textarea id='review' class='materialize-textarea'></textarea>
                      <label for="review">Enter your review here</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="suggestion" type="text" name='suggestion'>
                      <label for="suggestion">Other suggestions</label>
                    </div>
                  </div>


                  <div class='col s12 l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Submit</button></div>


                </form>
                </div>
            </div>
            
            <!-- CODE FOR HIDING ADD REVIEW SECTION -->
            <?php

                if (!array_key_exists("id",$_SESSION)){
                    
            ?>
            <script type="text/javascript">
               $('.add-reviews').empty();
               $('.add-reviews').append("<h3>Add review</h3>");
               $('.add-reviews').append("<div class='col s12 center'><p class='muted-text'>Please login or register to write a review </p></div>");
            </script>
            <?php
                }

            ?>
            
            
            <!-- ALL REVIEWS SECTION -->  
            <div class='row reviews'>
               <h3>User reviews</h3>

               <!-- repeat the following markup for reviews -->
               <div class='col s12 user-review card hoverable'>
                    <div class='col s12 valign-wrapper'>
                        <span><i class='material-icons'>perm_identity</i></span>
                        <span id='user-name'>Name of the idiot</span>
                    </div>  
                    <div id='review-content' class='col s12'>
                        review shit starts from here...Sorry for the language but it's f***ing 1:13 AM.....I'm stopping after designing this part.
                    </div>  
               </div>
               <!-- ........repeat till here..............  -->

            </div>
        </div>
         
    </main>
    
    
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
            $('.parallax').parallax();
            $('#review').val();
            $('#review').trigger('autoresize');
        });
        // STARS PART
        // hovering 
        $('.star-row').find('.star').hover(function () {
            var value = parseInt($(this).attr("data-value"));
            // check if clicked, then no hover effect
            if (!$('.star-row').hasClass('clicked') || value > parseInt($('#rating').val())) {
                //first remove color for all stars greater than hovered
                for (var i = 6; i >= value; i--) {
                    $('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
                }
                //add color to all star below and equal to hovered 
                for (i = 1; i <= value; i++) {
                    $('.star-row .star:nth-child(' + (i + 1) + ')').addClass('star-hover');
                }
            }
        }, function () {
            // on hoverout clear all stars
            // check if clicked, then don't clear, else clear
            var value = parseInt($(this).attr("data-value"));
            var clickedValue = parseInt($('#rating').val());
            console.log(clickedValue);
            if ($('.star-row').hasClass('clicked') && value > clickedValue) {
                for (i = 6; i > clickedValue + 1; i--) {
                    $('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
                }
            }
            else if (!$('.star-row').hasClass('clicked')) {
                for (i = 6; i >= 1; i--) {
                    $('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
                }
            }
        });
        // on click
        $('.star-row').find('.star').click(function () {
            var value = parseInt($(this).attr("data-value"));
            //first remove color for all stars greater than hovered
            for (var i = 6; i >= value; i--) {
                $('.star-row .star:nth-child(' + i + ')').removeClass('star-hover');
            }
            //add color to all star below and equal to hovered 
            for (var i = 1; i <= value; i++) {
                $('.star-row .star:nth-child(' + (i + 1) + ')').addClass('star-hover');
            }
            // also give selected value to hidden input rating
            $('#rating').val(value);
            $('.star-row').addClass('clicked');
        });
    </script>
</body>
</html>