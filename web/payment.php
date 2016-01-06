<!DOCTYPE HTML>
<html>
<head>
<title>Online Guitar Store</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>
     <!-- Add fancyBox main JS and CSS files -->
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
		<script>
			$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
			});
		});
		</script>
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="logo">
						<a href="index.php"><img src="images/logo.jpg" height = "55" width = "55" alt=""/></a>
					 </div>
					 <div class="menu">
						  <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
						    <ul class="nav" id="nav">
						    	<li><a href="shop.php">Shop</a></li>
						    	<li><a href="guitar_info.php">Guitar Information</a></li>
						    	<li><a href="guitar_history.php">History</a></li>
								<li><a href="contact.php">Contact</a></li>
								<?php
								if(!isset($_COOKIE['User_Name'])){
								echo '<li><a href="login.php">Login/Signup</a></li>';
								}
								else{
									echo '<li><a href="account.php">Account</a></li>';
									echo '<li><a href="logout.php">Logout</a></li>';
								}
								?>
								<div class="clear"></div>
							</ul>
							<script type="text/javascript" src="js/responsive-nav.js"></script>
				    </div>							
	    		    <div class="clear"></div>
	    	    </div>
		        <div class="clear"></div>
	       </div>
	      </div>
		 </div>
	    </div>
	  </div>
     <div class="main">
      <div class="shop_top">
		<div class="container">
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
								<?php
									if(isset($_COOKIE['User_Name'])){
										$email = $_COOKIE['User_Name'];
										$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
										if(! $link )
											die('Could not connect: ' . mysql_error());
										mysql_select_db('guitar_store_schema');
										$user_info_query = "SELECT * FROM customer_details WHERE email_id = '$email'";
										
										$user_info_query_results = mysql_query($user_info_query);
										if(!$user_info_query_results)
											die("Error :".mysql_error());
										$first_name = mysql_result($user_info_query_results, 0, "first_name");
										$last_name = mysql_result($user_info_query_results, 0, "last_name");
										$address_line_1 = mysql_result($user_info_query_results, 0, "address_line_1");
										$address_line_2 = mysql_result($user_info_query_results, 0, "address_line_2");
										$city = mysql_result($user_info_query_results, 0, "city");
										$state = mysql_result($user_info_query_results, 0, "state");
										$triggger_query = "drop table `guitar_store_schema`.`shopping_cart`";
										echo '<div class="register-top-grid">
													<h3>PERSONAL INFORMATION</h3>
													<div>
														<span>First Name : <label>'.$first_name.'</label></span>
													</div>
													<div>
														<span>Last Name : <label>'.$last_name.'</label></span>
													</div>
													<p> 
													
													
													<h3>DELIVERY ADDRESS INFORMATION</h3>
													<span>Address can be changed by editing from your account details. Click<a href="account.php"> here</a> to change your address.</span>
													<div>
														<span>Address Line 1 : <label>'.$address_line_1.'</label></span>
													</div>
													<div>
														<span>Address Line 2 : <label>'.$address_line_2.'</label></span>
													</div>
													<div>
														<span>City : <label>'.$city.'</label></span>
													</div>
													<div>
														<span>State : <label>'.$state.'</label></span>
													</div>
													<p> 
													
													<div class="clear"> </div>
											</div>
											<div class="clear"> </div>
											<div class="register-top-grid">
													<h3>PAYMENT INFORMATION</h3>
													<div>
														<span>Credit Card Number<label>*</label></span>
														<input type="text" name ="credit_card">
													</div>
													<div>
														<span>Expiry Date<label>*</label></span>
														<input type="text" name = "month" size="35">
														<div class="clear"> </div>
														<input type="text" name = "year" size="35">
													</div>
													<div class="clear"> </div>
											</div>
											<div class="clear"> </div>';
											
											$guitar_cart_query= "SELECT * FROM shopping_cart";
											$guitar_result = mysql_query($guitar_cart_query);
											if(!$guitar_result)
												die('Error: '.mysql_error());
											$total_rows= mysql_numrows($guitar_result);
											$i =0;
											$total_price=0;
											while($i<$total_rows){
												$guitar_number = mysql_result($guitar_result, $i, "guitar_number");
												$sql_query = "SELECT * FROM guitar_details WHERE guitar_number=".$guitar_number;
												$guitar_info_result = mysql_query($sql_query);
												if(!$guitar_info_result )
													die('Error ' . mysql_error());
												$guitar_price = mysql_result($guitar_info_result, 0, "guitar_price");
												$guitar_quantity = mysql_result($guitar_result, $i, "guitar_quantity");
												$guitar_number = mysql_result($guitar_info_result, 0, "guitar_name");
												$guitar_model = mysql_result($guitar_info_result, 0, "guitar_model");
												$total_price = $total_price + $guitar_price*$guitar_quantity;
												$i++;
											}
											echo '<h3><a>Total Price = $'.$total_price.'</a></h3>'.
													'<div class="clear"> </div>'.
													'<input type="submit" class = "button" name = "place_order" value="PLACE ORDER">';
											if(isset($_POST['place_order'])){
												$date = time();
												$email_id = $_COOKIE['User_Name'];
												$order_entry_query = "INSERT INTO order_info (email_id, total_price, order_date) VALUES ('$email_id', '$total_price', '$date')";
												$order_entry_query_results = mysql_query($order_entry_query);
												if(!$order_entry_query_results)
													die('Error :'.mysql_error());
												else {
													echo "<script type='text/javascript'>alert('Order placed successfully !');</script>";
													$trigger_query = "DELIMITER $$ 
																		CREATE TRIGGER drop_cart_trigger
																		AFTER INSERT
																		   ON order_info FOR EACH ROW
																		   
																		BEGIN
																			DROP TABLE shopping_cart
																		END$$
																		DELIMITER" ;
													$trigger_query_results = mysql_query($triggger_query);
													if(!$trigger_query_results)
														die('Trigger Error :'.mysql_error());
													
												}
											}
											
									} else{
										echo "you need to login to make a purchase";
									}
								?>
			</form>
		</div>
	   </div>
	  </div>
	  <div class="footer">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3">
						<ul class="footer_box">
							<h4>About</h4>
							<li><a href="#">Careers and internships</a></li>
							<li><a href="#">Sponserships</a></li>
							<li><a href="#">team</a></li>
							<li><a href="#">Catalog Request/Download</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<ul class="footer_box">
							<h4>Customer Support</h4>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Shipping and Order Tracking</a></li>
							<li><a href="#">Easy Returns</a></li>
							<li><a href="#">Warranty</a></li>
							<li><a href="#">Replacement Binding Parts</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<ul class="footer_box">
							
							<ul class="social">	
							  <li class="facebook"><a href="#"><span> </span></a></li>
							  <li class="twitter"><a href="#"><span> </span></a></li>
							  <li class="instagram"><a href="#"><span> </span></a></li>	
							  <li class="pinterest"><a href="#"><span> </span></a></li>	
							  <li class="youtube"><a href="#"><span> </span></a></li>										  				
						    </ul>
		   					
						</ul>
					</div>
				</div>
				
			</div>
		</div>
</body>	
</html>