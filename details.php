<?php include('config.php'); 
//error_reporting(0);
$_SESSION['email']="aabha@restro.com";
try{
if(isset($_POST['submit']))
{
	$id = $_GET['id'];
	$uemail=$_SESSION['email'];
	if($_POST['review'])
	{
			$rev=$_POST['review'];
	$sql = $db->query('SELECT * FROM `user` WHERE `u_email`="'.$uemail.'"');
										while($row = $sql->fetch())
										{
											if($uemail==$row['u_email'])
											{
												$uid=$row['u_id'];
											}
										}
	$sql=$db->prepare('INSERT INTO admin (a_rev,a_restid, u_id) VALUES (:a_rev,:a_restid,:a_uid)');
	$sql->execute(array(':a_rev'=>$rev, ':a_restid'=>$id, ':a_uid'=>$uid));
	}
	if($_POST['suggest'])
	{
		$sug=$_POST['suggest'];
		$sql = $db->query('SELECT * FROM `user` WHERE `u_email`="'.$uemail.'"');
										while($row = $sql->fetch())
										{
											if($uemail==$row['u_email'])
											{
												$uid=$row['u_id'];
											}
										}
		$sql=$db->prepare('INSERT INTO suggestion (s_id,u_id,suggestion) VALUES (:s_id, :u_id, :suggestion)');
	$sql->execute(array(':s_id'=>NULL, ':u_id'=>$uid, 'suggestion'=>$sug));
	}
	
	}

}catch(PDOException $e){
									echo $e->getMessage();
									}
?>
<!DOCTYPE html>
<html>
		<head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
				<link rel="stylesheet" href="materialize/css/materialize.min.css">
				<link rel='stylesheet' href="css/materialize_red_black_theme.css">
				<link rel="stylesheet" href="css/details.css">
		</head>

		<body>
			 

			 <nav class='z-depth-3 col s12'>
						<div class="nav-wrapper">
								<a href="#" class="brand-logo left hide-on-small-only">Kem Chow ? </a>
								
								<ul id="nav-mobile" class="right">
										<li class='waves-effect waves-light'><a href="#login-pop" name='search-btn' class="waves-effect waves-light btn modal-trigger z-depth-2 red">Login / Register</a></li>
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
												<div class='col s12 l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Login</button></div>

<!--                        <div class='col s12 l12 center'><p class='form-error center'><?php echo $error; ?></p></div>-->
												</form>
										</div>    
								</div>
								<!-- SIGNUP -->
								<div class="col s12 l8 offset-l2">
										<div class="row">
												<form method="post" name='signup' id='signup' class="col s12" novalidate>
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
													<div class='col s12 l12 center'><button name='submit' class="waves-effect waves-light btn z-depth-2 black-btn">Sign Up</button></div>

<!--                          <div class='col s12 l12 center'><p class='form-error center'><?php echo $error; ?></p></div>-->
												</form>
										</div>
								</div>
						</div>
				</div>
		
				<main>
					<?php 
						$id = $_GET['id'];
						$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_id`="'.$id.'"');
						$row = $sql->fetch();
						?>
							
						<div class='container'>

								<div class='row jumbo'>
										<div class='col s12 parallax-container'>
												<div class='col s12 parallax'>
														<img id='rest-img' src="images/rest1.jpg">
														<div class='text'>
																<h2><?php echo $row['r_name'];?></h2>
																<h5 class='valign-wrapper'><i class='material-icons'>location_on</i> <?php echo $row['r_add'];?> </h5>
																<div class='star-row'>
																<?php $star=floor($row['r_rat_avg']);
																      for($s=1;$s<=$star;$s++)
																      {
																      		echo "<span class='star' data-value='1'><i class='material-icons'>star</i></span>";
																      }?>
															</div>
												</div>   
										</div>
								</div>
								
								<!-- HIDE ADD REVIEW SECTION IF NOT LOGGED IN -->
								<?php 
									if(isset($_SESSION['email']) && isset($_SESSION['password'])){
										 
										$id = $_GET['id'];
										$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_id`="'.$id.'"');
										$row = $sql->fetch();
										
										echo "<div class='row add-reviews'>";
											echo "<h3>Add review</h3>";
											echo "<div class='col s12 m12 l10 offset-l1'>";
												echo "<form action='' method='POST' name='new-review' id='new-review' class='col s12' novalidate>";
													//<!-- STARS SHIT HERE -->
													//<!-- READ CAREFULLY : WHEN CLICKING ON A STAR, THE CORRESPONDING VALUE IS STORED IN THE HIDDEN INPUT ELEMENT WITH NAME RATING...SO WHEN FORM IS SUBMITTED, $_POST['rating'] WILL GIVE THE RATING -->
													echo "<div class='row'>";
														echo "<div class='col s12'>";
															 echo "<input name='rating' id='rating' type='hidden' value='1'>";
																echo "<div class='star-row'>";
																	echo "<span><p>Add your rating :</p></span>";
																	echo "<span class='star' data-value='1'><i class='material-icons'>star</i></span>";
																	echo "<span class='star' data-value='2'><i class='material-icons'>star</i></span>";
																	echo "<span class='star' data-value='3'><i class='material-icons'>star</i></span>";
																	echo "<span class='star' data-value='4'><i class='material-icons'>star</i></span>";
																	echo "<span class='star' data-value='5'><i class='material-icons'>star</i></span>";
															echo "</div>";
														echo "</div>";
													echo "</div>";
													echo "<div class='row'>";
														echo "<div class='input-field col s12'>";
															echo "<textarea name='review' id='review' class='materialize-textarea'></textarea>";
															echo "<label for='review'>Enter your review here</label>";
														echo "</div>";
													echo "</div>";
													echo "<div class='row'>";
														echo "<div class='input-field col s12'>";
															echo "<input id='suggestion' type='text' name='suggest'>";
															echo "<label for='suggestion'>Other suggestions</label>";
														echo "</div>";
													echo "</div>";
													echo "<div class='col s12 l12 center'><input type='submit' name='submit' class='waves-effect waves-light btn z-depth-2 black-btn'></input></div>";
												echo "</form>";
											echo "</div>";
										echo "</div>";
										
										if(isset($_POST['rating'])){
											$new_sum = $row['r_rat_sum'] + $_POST['rating'];
											$new_count = $row['r_rat_no'] + 1;
											$new_avg = round($new_sum/$new_count);
											$sql = $db->prepare('UPDATE `restaurant` SET `r_rat_no`=:r_rat_no, `r_rat_avg`=:r_rat_avg, `r_rat_sum`=:r_rat_sum WHERE `r_id`="'.$id.'"');
											$sql->execute(array(':r_rat_avg'=>$new_avg, ':r_rat_sum'=>$new_sum, ':r_rat_no'=>$new_count));	
											unset($_POST['rating']);
										}
									}
								?>
								<!-- ALL REVIEWS SECTION -->  
								<div class='row reviews'>
									 <h3>User reviews</h3>
									 
									 <!-- repeat the following markup for reviews -->
									 <?php
									    $id = $_GET['id'];
										$uemail=$_SESSION['email'];
										try{
										/*$sql=$db->query('SELECT * FROM `review` WHERE `r_restid`="'.$id.'"' );
										$sql = $db->query('SELECT * FROM `user` WHERE `u_email`="'.$uemail.'"');
										while($row = $sql->fetch())
										{
											if($uemail==$row['u_email'])
											{
												$username=$row['u_name'];
											}
										}
										$sql=$db->query('SELECT * FROM `review` WHERE `)
										echo '<div class="col s12 user-review card hoverable">';
												echo '<div class="col s12 valign-wrapper">';
														echo '<span><i class="material-icons">perm_identity</i></span>';
														echo '<span id="user-name">'.$username.'</span>';
												echo '</div>';
												echo '<div id="review-content" class="col s12">';
												 
														//review shit starts from here...Sorry for the language but it's f***ing 1:13 AM.....I'm stopping after designing this part.
												echo '</div> '; 
									 echo '</div>';*/
									 $sql=$db->query('SELECT * FROM `review`, `user` WHERE `rest_id`="'.$id.'" AND `review`.`u_id`=`user`.`u_id`');
											while($row=$sql->fetch()){
												//<!-- repeat the following markup for reviews -->
												echo "<div class='col s12 user-review card hoverable'>";
													echo "<div class='col s12 valign-wrapper'>";
														echo "<span><i class='material-icons'>perm_identity</i></span>";
														echo "<span id='user-name'>".$row['u_name']."</span>";
													echo "</div> ";
													echo "<div id='review-content' class='col s12'>";
														echo $row['review'];
													echo "</div>";
									 			echo "</div>";
											}
									 }catch(PDOException $e){
									echo $e->getMessage();
									}
?>
									 <!-- ........repeat till here..............  -->

								</div>
						</div>
					 
					 
						
				</main>
	
		
		 
		 
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
								$('.parallax').parallax();
								$('#review').val();
								$('#review').trigger('autoresize');
						 
						});
						
					 
						// STARS PART
						// hovering 
						$('.star-row').find('.star').hover(function(){
								var value = parseInt($(this).attr("data-value"));
								// check if clicked, then no hover effect
								if (!$('.star-row').hasClass('clicked') || value > parseInt($('#rating').val()) ){
										
										//first remove color for all stars greater than hovered
										for(var i=6;i>=value;i--){
												$('.star-row .star:nth-child('+i+')').removeClass('star-hover');
										}
										//add color to all star below and equal to hovered 
										for(i=1;i<=value;i++){
												$('.star-row .star:nth-child('+(i+1)+')').addClass('star-hover');
										}
								}
						}, function(){
								// on hoverout clear all stars
								// check if clicked, then don't clear, else clear
								var value = parseInt($(this).attr("data-value"));
								var clickedValue = parseInt($('#rating').val());
								console.log(clickedValue);
								
								if ($('.star-row').hasClass('clicked') && value > clickedValue){
												for(i=6;i>clickedValue+1;i--){
												$('.star-row .star:nth-child('+i+')').removeClass('star-hover');
										}
								} 
								else if (!$('.star-row').hasClass('clicked')){
												for(i=6;i>=1;i--){
												$('.star-row .star:nth-child('+i+')').removeClass('star-hover');
										}
								}
						});
						
						// on click
						$('.star-row').find('.star').click(function(){
								var value = parseInt($(this).attr("data-value"));
								//first remove color for all stars greater than hovered
								for(var i=6;i>=value;i--){
										$('.star-row .star:nth-child('+i+')').removeClass('star-hover');
								}
								//add color to all star below and equal to hovered 
								for(var i=1;i<=value;i++){
										$('.star-row .star:nth-child('+(i+1)+')').addClass('star-hover');
								}
								// also give selected value to hidden input rating
								$('#rating').val(value);
								$('.star-row').addClass('clicked');

						});
						
						
						
					 
								

			</script>
		 
		</body>
</html>