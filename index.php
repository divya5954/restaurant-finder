<!DOCTYPE html>
<?php
require ('config.php');
//session_unset();
//session_destroy();

//error_reporting(0);
 
//session_start();

/*//error_reporting(0);
if(isset($_)

if($_POST['logout'])
{ echo "1";
	try{
		unset($_SESSION['email']);
unset($_SESSION['password']);
//unset($_SESSION['mypassword']);
//unset($_SESSION['mytype']);
	
	session_unset(); 

	session_destroy();
	//header('Location: http://localhost/restro/restaurant-finder-master/index.php');
	
}catch(PDOException $e){
	echo $e->getMessage();
}
} */




if($_POST['email'] && $_POST['password'])
{
	$email= $_POST['email'];
	$pass = $_POST['password'];
	//$location=$_GET["location"];
	echo $email;
	echo $pass;
	//echo $location;
	/*$redirect = NULL;
	if($_GET['location']!=''){
		$redirect=$_GET['location'];
	}*/
	if($_POST["email"]=="admin@restro.com" && $_POST["password"] == "12345"){
		//if(!isset($_SESSION["email"]))
		$_SESSION['email']= $_POST['email']; //'admin@restro.com';
		$_SESSION['password']=$_POST['password'];
			//echo $_SESSION['email'];
		setcookie("email", $email, time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie("password", $pass, time() + (86400 * 30), "/"); // 86400 = 1 day
		exit();
	}


	try{
		$sql = $db->query("SELECT * FROM `user` WHERE `u_email`='".$email."'");
		$flag=0;
		if($row = $sql->fetch()){
			$flag=1;
			$p=$row['u_pass'];

			if($pass==$p){
			$_SESSION['email']=$email;
			$_SESSION['password']=$pass;
			setcookie("email", $email, time() + (86400 * 30), "/"); // 86400 = 1 day
			setcookie("password", $pass, time() + (86400 * 30), "/"); // 86400 = 1 day
			/*if(isset($redirect)){
				$url .= '&location='.urlencode($redirect);
			}
			header('Location:'.$url);*/
			//exit();
			}
			else
				echo'<script> alert("Invalid password") </script>';
		}
		if($flag==0)
			echo'<script> alert("Invalid username") </script>';
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


if($_POST["email"]&& $_POST["password"]&& $_POST["username"])
{
	$uemail=$_POST['email'];
	$uname=$_POST['username'];
	$upass=$_POST['password'];
	try{
	$sql=$db->query("SELECT `u_email` FROM `user` WHERE `u_email`='".$uemail."'");
	$row=$sql->fetch();
	if($uemail==$row['u_email']){
		echo '<script> alert("Username taken!");  </script>'; //window.location.href="../signup.html";
	}
	else{
		$sql=$db->prepare("INSERT INTO `user` (`u_name`,`u_pass`,`u_email`) VALUES(:user_name, :user_pass, :user_email)");
		$sql->execute(array(':user_name'=>$uname, ':user_pass'=>$upass, ':user_email'=>$uemail));
		$_SESSION['username']=$uname;
		$_SESSION['password']=$upass;
		$_SESSION['email']=$email;

	}
}catch(PDOException $e){
	echo $e->getMessage();
}
}


?>



<html>
		<head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
				<link rel="stylesheet" href="materialize/css/materialize.min.css">
				<link rel='stylesheet' href="css/materialize_red_black_theme.css">
				<link rel="stylesheet" href="css/style.css">
		</head>

		<body>
<!--
			 <nav class='z-depth-3 col s12'>
						<div class="nav-wrapper">
								<a href="#" class="brand-logo left hide-on-small-only">Kem Chow ? </a>
								
								<ul id="nav-mobile" class="right">
										<li class='waves-effect waves-light'><button id='login-popup' class="waves-effect waves-light btn z-depth-2 red">Login / Register</button></li>
								</ul>
						</div>
				</nav>
-->
				
				<nav class='z-depth-3 col s12'>
						<div class="nav-wrapper">
								<a href="#" class="brand-logo left hide-on-small-only">Food Panda </a>
								
								<ul id="nav-mobile" class="right">
										<!--<li class='waves-effect waves-light'><a href="#login-pop" name='log/reg' class="waves-effect waves-light btn modal-trigger z-depth-2 red">Login / Register</a></li>-->
					<?php if(isset($_SESSION['email']) && $_SESSION['email']){
					/*	echo '<form action="" method="post" id="logout" name="logout" >';
						echo '<li class="waves-effect waves-light"><input type="submit" name="logout" id="logout" value="Logout" class="waves-effect waves-light btn modal-trigger z-depth-2 red"></input></li>';
						echo '</form>';
					*/	echo '<li class="waves-effect waves-light"><a href="logout.php" name="logout" class="waves-effect waves-light btn z-depth-2 red">Logout</a></li>';
					}
					else
					{
						echo '<li class="waves-effect waves-light"><a href="#login-pop" name="log/reg" class="waves-effect waves-light btn modal-trigger z-depth-2 red">Login / Register</a></li>';
					}?>
								</ul>
						</div>
				</nav>
		 
				<!-- ************************ -->
				<!-- POPUP FOR LOGIN / SIGNUP -->
				<!-- ************************ -->  
				<div id="login-pop" class="modal">
						<div class="modal-content">
							<!-- login or signup markup -->
							<div class="col s12 tabs-col">
									<ul class="tabs">
										<li class="tab col s6 z-depth-1"><a href="#login">Login</a></li>
										<li class="tab col s6 z-depth-1"><a class="active" href="#signup">Sign Up</a></li> 
									</ul>
								</div>
								<!-- LOGIN -->
								<div class="col s12 m12 l8 offset-l2">
										<div class="row">
												<form action='' name='login' method='post' id='login' class="col s12">
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
						<input type="hidden" name="location" value="<?php if(isset($_GET['location'])){echo htmlspecialchars($_GET['location']);}?>">
												<input type="hidden" name='login' value='1'>
												<div class='col s12 l12 center'><button name='submit' id='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Login</button></div>

<!--                        <div class='col s12 l12 center'><p class='form-error center'><?php echo $error; ?></p></div>-->
												</form>
										</div>    
								</div>
								<!-- SIGNUP -->
								<div class="col s12 l8 offset-l2">
										<div class="row">
												<form action='' method="post" name='signup' id='signup' class="col s12" novalidate>
<!--                             do email validation in php-->
													<div class="row">
														<div class="input-field col s12">
															<input id="username" name='username' type="text" class="validate" autocomplete='name' required>
															<label for="username">Username</label>
														</div>
													</div>
												 <div class="row">
														<div class="input-field col s12">
															<input id="email" type="email" name="email" class="validate" autocomplete="email" required >
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
													<div class='col s12 l12 center'><button name='signup' id='signup' class="waves-effect waves-light btn z-depth-2 black-btn">Sign Up</button></div>

<!--                          <div class='col s12 l12 center'><p class='form-error center'><?php echo $error; ?></p></div>-->
												</form>
										</div>
								</div>
								
						</div>
				</div>
				
				<header>
						<div class='container fullscreen valign-wrapper'>
							<div class="row card">
										<div class="col m12 heading">
											 <h1 class='center'>Food Finder</h1>
											 <!--<h3 class='center'>don't stick pen into apple or pineapple</h3>-->
										</div>
										<div class='col s12 m12 l12'>
												<form method='post' name='search' id='search' class="col s12">
													<div class="col s12 m10 offset-m1 l8 offset-l2 valign-wrapper">
																<div class="input-field col s9 m10 l11 search-query">
																	<input name='search-query' id="search" class='autotype' type="text">
																</div>

																<div class='col s3 m2 l1 center'><button name='search-btn' id='search' class="waves-effect waves-light btn z-depth-2 black"><i class="material-icons">search</i></button></div>
													</div>
												</form>   
										</div> 
										<div class='col s12 center'>
												<a href="restaurant.php" class="waves-effect waves-light btn z-depth-2 red view-all-btn">View all restaurants</a>   
										</div>
							</div>
						 
						</div>
						 <img id='header-bg' src="images/header1.jpg" >
				</header>
				

	
		
		 
		 
				<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
				<script src="materialize/js/materialize.min.js"></script>
				<script src="js/jquery.waypoints.min.js"></script>
				<script src="js/typed.js"></script>

				<script>
						

					// WHEN DOC READY
					 $(document).ready(function(){
							 // FOR SELECTING TABS
							 $('ul.tabs').tabs();
							 $('.modal-trigger').leanModal();
					 });
						
						// TYPING EFFECT
						$(function(){
							$(".autotype").typed({
								strings: ["Search restaurants by name or type",'Vegetarian','Non-veg'],
								typeSpeed: 50,
								startDelay : 100, 
								loop : true,
								backDelay : 1000,
								backspeed : 500
							});
					});
						// STOP TYPING EFFECT WHEN ON FOCUS
						$('.autotype').focusin(function(){
								$(this).typed({
										strings : ['']
								});
								$(this).val('');
								
						});
						// RESTART THE TYPING EFFCT AFTER 3s 
						$('.autotype').focusout(function(){
								setTimeout(function(){
									 if ($('.autotype').val() == ''){  // check if no string
											 $(".autotype").typed({
														strings: ["Search restaurants by name or cuisine",'Vegetarian','Non-veg'],
														typeSpeed: 50,
														startDelay : 100, 
														loop : true,
														backDelay : 1000,
														backspeed : 500
													}); 
									 }
								},3000)
						});
						
						
						//CHANGE THE HEADER BG IMG EVERY 5S
						var imgIndex = 1;
						setTimeout(function(){
								$('#header-bg').css("opacity","0");
						},4700);   
						setInterval(function(){
								imgIndex+=1;
								if (imgIndex>4)   // max index upto 4, change if needed
										imgIndex=1;
								$('#header-bg').attr("src","images/header"+imgIndex+".jpg");
								
								//FOR CROSSFADING
								setTimeout(function(){
										$('#header-bg').css("opacity",".7");
								},100);
								setTimeout(function(){
										$('#header-bg').css("opacity","0");
								},4700);    
								
						},5000);
						
						
						
						// WAYPOINTS LOADING CONTENT
						/*$('#js-show-main-info').waypoint(function(direction) {
								if (direction == "down") {
								} 
										else {
										$('.tab-carousel').removeClass('fix-section');
								}

						}, {
								offset: '50%'
						});*/
						
								

			</script>
		 
		</body>
</html>