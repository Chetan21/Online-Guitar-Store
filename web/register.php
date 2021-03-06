
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
 </head>
<body>
<?php
$nameErr = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
   if (!isset($_POST['first_name']) || $_POST['first_name'] == "") {
     $nameErr = "First name is required";
   }
   else if (!isset($_POST['last_name']) || $_POST['last_name'] == "") {
     $nameErr = "Last name is required";
   }
   else if (!isset($_POST['email']) || $_POST['email'] == "") {
     $nameErr = "Email ID is required";
   }
   else if (!isset($_POST['phone']) || $_POST['phone'] == "") {
     $nameErr = "Phone is required";
   }
   else if (!isset($_POST['pword']) || $_POST['pword'] == "") {
     $nameErr = "Password is required";
   }
   else if (!isset($_POST['cpword']) || $_POST['cpword'] == "") {
     $nameErr = "Password is required";
   }
   else if (!isset($_POST['address_line_1']) || $_POST['address_line_1'] == "") {
     $nameErr = "Address is required for shipping";
   }
   else if (!isset($_POST['city']) || $_POST['city'] == "") {
     $nameErr = "City is required";
   }
   else if (!isset($_POST['state']) || $_POST['state'] == "") {
     $nameErr = "State is required";
   }
   else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['first_name'])||!preg_match("/^[a-zA-Z ]*$/",$_POST['last_name'])) {
       $nameErr = "Only letters and white space allowed"; 
   } else {
     $first_name = ($_POST["first_name"]);
     $last_name = ($_POST["last_name"]);
	 $email = ($_POST["email"]);
	 $phone = ($_POST["phone"]);
	 $pword = ($_POST["pword"]);
	 $cpword = ($_POST["cpword"]);
	 $address_line_1 = ($_POST["address_line_1"]);
	 $address_line_2 = ($_POST["address_line_2"]);
	 $city = ($_POST["city"]);
	 $state = ($_POST["state"]);
   }
}
?>

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
									if($_COOKIE['User_Name'] == "chetanh1990@gmail.com"){
									echo '<li><a href="account.php">Account</a></li>';
									echo '<li><a href="logout.php">Logout</a></li>';
									echo '<li><a href="summary.php">Summary</a></li>';
									}
									else{
										echo '<li><a href="account.php">Account</a></li>';
										echo '<li><a href="logout.php">Logout</a></li>';
									}
										
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
						
						
								<div class="register-top-grid">
										<h3>PERSONAL INFORMATION</h3>
										<div>
											<span>First Name<label>*</label></span>
											<input type="text" name = "first_name" id="first_name" > 
										</div>
										<div>
											<span>Last Name<label>*</label></span>
											<input type="text" name="last_name" id="last_name"> 
										</div>
										<div>
											<span>Email Address<label>*</label> - This will be your login username</span>
											<input type="text" name="email" id="email"> 
										</div>
										<div>
											<span>Phone Number<label>*</label></span>
											<input type="text" name="phone" id="phone"> 
										</div>
										<p> 
										
										
										<h3>ADDRESS INFORMATION</h3>
										<div>
											<span>Address Line 1 <label>*</label></span>
											<input type="text" name = "address_line_1"> 
										</div>
										<div>
											<span>Address Line 2<label>*</label></span>
											<input type="text" name="address_line_2"> 
										</div>
										<div>
											<span>City<label>*</label></span>
											<input type="text" name="city"> 
										</div>
										<div>
											<span>State<label>*</label></span>
											<input type="text" name="state"> 
										</div>
										<p> 
										
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<div class="register-bottom-grid">
										<h3>LOGIN INFORMATION</h3>
										<div>
											<span>Password<label>*</label></span>
											<input type="password" name ="pword">
										</div>
										<div>
											<span>Confirm Password<label>*</label></span>
											<input type="password" name = "cpword">
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								
								<input type="submit" class = "button" value="Submit">
								<span class="error"><?php 
										if("" != $nameErr) {
										echo '<font color = "red">'.$nameErr.'</font>';
										}
										else{
											if(isset($_POST['first_name'])||isset($_POST['last_name'])||isset($_POST['phone'])||isset($_POST['email'])){
										
											if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
												
													if (ereg("^[0-9]{10}$", $phone) ){
														if($pword==$cpword){
															$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
															if(! $link )
																die('Could not connect: ' . mysql_error());
															mysql_select_db('guitar_store_schema');
															$sql = "SELECT email_id".
																" FROM customer_details". 
																"WHERE email_id = ".$email;
															
															$email_check = mysql_query($sql);
															
															if(FALSE == $email_check){
																$sql = "INSERT INTO customer_details ". 
																	"(first_name, last_name, email_id, phone_number, password, address_line_1, address_line_2, city, state) ".
																	"VALUES ('$first_name', '$last_name', '$email', '$phone', '$pword', '$address_line_1', '$address_line_2', '$city', '$state')";
																$retval = mysql_query($sql);
																if(! $retval )
																{	
																	die('Could not enter data: ' . mysql_error());
																}
																else
																	echo "<script type='text/javascript'>alert('User account created successfully !');</script>";
															mysql_close($link);
															}
															else 
																echo "Account associated with given Email ID already exists.";
													}
													else
														echo "Passwords do not match";
													}
													else
														echo "Phone number not valid";
											} 
											else 
												echo "The email address is not valid";
											}
										}
										
																				
										?>
										</span>
						</form>
						</div>
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