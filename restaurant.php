<!DOCTYPE html>
<?php require('config.php'); ?>
<html>
		<head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
				<link rel="stylesheet" href="materialize/css/materialize.min.css">
				<link rel='stylesheet' href="css/materialize_red_black_theme.css">
				<link rel="stylesheet" href="css/restaurants.css">
		</head>

		<body>
			 

			 <nav class='z-depth-3 col s12'>
						<div class="nav-wrapper">
								<a href="#" class="brand-logo left hide-on-small-only">Food Finder </a>
								
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
					 
					 <div class='row'>
							 <div class='col m2 card sidebar z-depth-2'>
									 <!-- filters here-->
									 <div class='col m12 filters'>
												<h4>Filters</h4>
												<h5>Veg / Non-Veg </h5>
												<ul>
													<li><a href="restaurant.php?type=<?php $value='veg'; echo $value ?>"><font size="3">Vegetarian</font></a></li>
													<li><a href="restaurant.php?type=<?php $value='nveg'; echo $value ?>"><font size="3">Non-Vegetarian</font></a></li>
												</ul>
												<h5>Sort by</h5>
												<ul>
												<li><a href="restaurant.php?sort=<?php $value='ca'; echo $value ?>"><font size="3">Cost - Low to high</font></a></li>
												<li><a href="restaurant.php?sort=<?php $value='cd'; echo $value ?>"><font size="3">Cost - High to low</font></a></li>
												<li><a href="restaurant.php?sort=<?php $value='rating'; echo $value ?>"><font size="3">Rating - High to low</font></a></li>
												</ul>
												<h5>Cuisines</h5>
												<ul>
													<?php 
														$sql= $db->query('SELECT DISTINCT`r_cuisine` FROM `restaurant` '); 
														while($row=$sql->fetch()){
															$value = $row['r_cuisine'];
															echo '<li><a href="restaurant.php?cuisine='.$value.'"><font size="3">'.$value.'</font></li>';
														}
													?>
												</ul>
												<h6><a href="restaurant.php">Remove filters</a></h6>
											 </div>
										</div>

							 <div class='col offset-m2 m10 restaurants'>
									 <!-- restaurants list here -->
									 <h4>Restaurants</h4>
					 
					 <?php 
	/*				 function urlvarRecreate ($exclude=''){
					 	$urlArray = array();
					 	foreach ($_GET as $key => $value) {
					 		if(!is_array($exclude)){
					 			if($key != $exclude){
					 				array_push($urlArray, $key.'='.urlencode($val));
					 			}
					 		}
					 		else{
					 				if(!in_array($key, $exclude)){
					 					array_push($urlArray, $key.'='.urlencode($val));
					 				}
					 		}
					 	}
					 	return implode('&', $urlArray);
					 }
*/
					 	try{
							$flag=0;
/*	-----------multiple filters-------
							$vars = array('cuisine', 'type', 'search', `sort`);
							$filter = array();
							$binds = array();
							$i=0;
							$href = '<a href="restaurant.php';
							foreach ($vars as $key => $value) {
								if($_GET[$value]!=''){
									$filter[]=$value."=:".$value;
									if($i==0){
										$href .='?'.$value.'='.$_GET[$value];
									}
									else{
										$href.='&'.$value.'='.$_GET[$value];
									}
									$i++;
								}
							}
*/
							$sql = $db->query('SELECT * FROM `restaurant`');
							if(isset($_GET['cuisine'])){
								$cui=$_GET['cuisine'];
								$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_cuisine`="'.$cui.'"');
							}
							if(isset($_GET['type'])){
								$id=$_GET['type'];
								if($id=='veg')
									$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_type`="Veg"');
								else if($id=='nveg')
									$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_type`="Non-Veg"');
							}
							
							if(isset($_GET['sort'])){ 
								$sort=$_GET['sort'];
								if($sort=='ca')
									$sql = $db->query('SELECT * FROM `restaurant` ORDER BY `r_cost`');   
								else if($sort=='cd')
								 $sql = $db->query('SELECT * FROM `restaurant` ORDER BY `r_cost` DESC');
								else if($sort=='rating')
								 $sql = $db->query('SELECT * FROM `restaurant` ORDER BY `r_rat_avg` DESC');
								else
									$sql = $db->query('SELECT * FROM `restaurant` ORDER BY `r_id`');
							}

							if(isset($_POST['search-query'])){
								$search= $_POST['search-query'];
								$sql = $db->query('SELECT * FROM `restaurant` WHERE `r_type`="'.$search.'" OR `r_cuisine`="'.$search.'" OR `r_name`="'.$search.'"');
							}

							while($row = $sql->fetch()){
								$flag=1;
								echo '<div class="col m12 restaurants-cards">';
								echo '<div class="col l4 card-holder">';
								echo '<div class="col m12 card z-depth-1">';
								echo '<div class="col m12 rest-pic center">';
								echo '<img src="'.$row['r_pic'].'">';
								//echo '<img src="/images/header3.jpg">';

								//echo $row['r_pic'];
								echo '</div>';
								echo '<div class="col m12 valign-wrapper">';
								echo '<div class="col l10 rest-name">';
								echo '<h6><a href=details.php?id='.$row['r_id'].'>'.$row['r_name'].'</a></h6>';
								echo '</div>';
								echo '<div class="col l2 rest-rating ">';
								echo '<div class="rating-badge good-rating  center z-depth-1">';
								echo '<span id="rest-rating" class="rating-value">'.$row['r_rat_avg'].'</span>';
								echo '<span class="caption">/5</span>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
								echo '<div class="col m12 center">';
								//echo '<button class="waves-effect waves-light btn z-depth-2 black" >View</button>';
								echo '<a href=details.php?id='.$row['r_id'].' class="waves-effect waves-light btn z-depth-2 black">View</a>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
								echo '</div>';

							}
								if($flag==0) { echo "<h3><strong>0 Results</strong></h3>"; }
						} catch(PDOException $e){
							echo $e->getMessage();
						}
					?>
									 
									 <!--<div class='col m12 restaurants-cards'>
											 <!-- repeat the following card with info -->
											 <!--<div class='col l4 card-holder'>
													 <div class='col m12 card z-depth-1'>
															 <div class='col m12 rest-pic center'>
									<img src="images/header3.jpg">
															 </div>
															 <div class='col m12 valign-wrapper'>
																	 <div class='col l10 rest-name'>
																			 <h6>Coffee Culture : the Ristorante lounge</h6>
																	 </div>
																	 <div class='col l2 rest-rating '>
																		<!-- change color of rating-badge according to the rating value -->
																		<!-- SANJAY will do that later -->
																				<!--<div class='rating-badge good-rating  center z-depth-1'>
																					 <span id='rest-rating' class='rating-value'>4.5</span>
																					 <span class='caption'>/5</span>
																			 </div>
																	 </div>
															 </div>
															 <div class='col m12 center'>
																	 <button class="waves-effect waves-light btn z-depth-2 black">View</button>
															 </div>
													 </div>
											 </div>
										 
											
												
											 
									 </div>-->
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
														strings: ["Search restaurants by name or type",'Vegetarian','Non-veg'],
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
						
						
						
					 
								

			</script>
		 
		</body>
</html>
?>