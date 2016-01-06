<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
     <!----details-product-slider--->
				<!-- Include the Etalage files -->
					<link rel="stylesheet" href="css/etalage.css">
					<script src="js/jquery.etalage.min.js"></script>
				<!-- Include the Etalage files -->
				<script>
						jQuery(document).ready(function($){
			
							$('#etalage').etalage({
								thumb_image_width: 300,
								thumb_image_height: 400,
								
								show_hint: true,
								click_callback: function(image_anchor, instance_id){
									alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
								}
							});
							// This is for the dropdown list example:
							$('.dropdownlist').change(function(){
								etalage_show( $(this).find('option:selected').attr('class') );
							});

					});
				</script>
				<!----//details-product-slider--->	
</head>
<body>
<?php 
	
		if(isset($_GET['id'])) {
			$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
			if(! $link )
				die('Could not connect: ' . mysql_error());
			mysql_select_db('guitar_store_schema');
			$sql = "SELECT * FROM guitar_details WHERE guitar_number = ".$_GET['id'];
			$result = mysql_query($sql);
			$g = $_GET['id'];
			if(!$result ){
				
			}
			$avg_rating_query = "SELECT AVG(rating) FROM comments WHERE guitar_number = '$g'";
			$rating_query_result = mysql_query($avg_rating_query);
			if(!$rating_query_result){
				$avg_rating = "This product has not been rated.";
			}
			else{
				$avg_rating = mysql_result($rating_query_result, 0);
			}
				
			$guitar_name=mysql_result($result,0,"guitar_name");
			$guitar_model=mysql_result($result,0,"guitar_model");
			$guitar_price = mysql_result($result,0,"guitar_price");
			$guitar_desc = mysql_result($result,0,"guitar_description");
			$guitar_image = mysql_result($result,0,"guitar_image");
			$guitar_year = mysql_result($result,0,"guitar_year");
			mysql_close($link);
		} else {
			echo "Not present";
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
						    	<li class="current"><a href="shop.php">Shop</a></li>
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
			<div class="row">
				<div class="col-md-9 single_left">
				   <div class="single_image">
					     <ul id="etalage">
							<li>
								<a>
									<?php echo '<img height="200" width="175" class="etalage_source_image" src= "data:image/jpeg;base64,'.base64_encode($guitar_image).'"/>'; ?>
								</a>
							</li>
							
						</ul>
					    </div>
				        <!-- end product_slider -->
				        <div class="single_right">
				        	<h3><?php echo $guitar_name."  ".$guitar_model; ?></h3>
				        	<p class="m_10"><?php echo $guitar_desc; ?></p>
							<p class="m_10"><?php echo "Model : ".$guitar_model; ?></p>
							<p class="m_10"><?php echo "Year : ".$guitar_year; ?></p>
							<p class="m_10"><?php echo "Average Rating : ".$avg_rating; ?></p>
				        	<ul class="product-colors">
								<h3>available Colors</h3>
								<li><a class="color1" href="#"><span> </span></a></li>
								<li><a class="color2" href="#"><span> </span></a></li>
								<li><a class="color3" href="#"><span> </span></a></li>
								<li><a class="color4" href="#"><span> </span></a></li>
								<li><a class="color5" href="#"><span> </span></a></li>
								<li><a class="color6" href="#"><span> </span></a></li>
								<div class="clear"> </div>
							</ul>
							
							
							<div class="social_buttons">
								
								<button type="button" class="btn1 btn1-default1 btn1-twitter" onclick="">
					              <i class="icon-twitter"></i> Tweet
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-facebook" onclick="">
					              <i class="icon-facebook"></i> Share
					            </button>
					             <button type="button" class="btn1 btn1-default1 btn1-google" onclick="">
					              <i class="icon-google"></i> Google+
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-pinterest" onclick="">
					              <i class="icon-pinterest"></i> Pinterest
					            </button>
					        </div>
				        </div>
				        <div class="clear"> </div>
				</div>
				<div class="col-md-3">
				  <div class="box-info-product">
					<p class="price2"><?php echo "$".$guitar_price; ?></p>
					       <ul class="prosuct-qty">
								<span>Quantity:</span>
								<select name="quantity">
									<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
								</select>
							</ul>
							<form method = "POST" action = "checkout.php">
							<input type="hidden" name = "guitar_number" value = "<?php echo $_GET['id']; ?>">
							<input type="hidden" name = "guitar_price" value = "<?php echo $guitar_price; ?>">
							<input type="hidden" name = "guitar_quantity" value = "<?php $guitar_quantity = $_POST['quantity']; 
																							echo $guitar_quantity; ?>">
							<button type="submit" name="cart" class="exclusive">
							   <span>Add to cart</span>
							</button>
							
							</form>
				   </div>
			   </div>
			</div>		
			<div class="register-bottom-grid">
				<h2>COMMENTS</h2>
				<?php 
					
						$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
						if(! $link )
							die('Could not connect: ' . mysql_error());
						mysql_select_db('guitar_store_schema');
						$sql3 = "SELECT * FROM comments WHERE guitar_number = ".$_GET['id'];
						$comment_results = mysql_query($sql3);
						
						
						if(!$comment_results || $comment_results == null )
							echo "<span>No comments added till yet. Be the first one to add comment for this guitar.</span>";
						else{
							$num= mysql_numrows($comment_results);
							$i=0;
							
							while($i<$num){
								$customer_email = mysql_result($comment_results,$i,"customer_email");
								$customer_rating = mysql_result($comment_results,$i,"rating");
								
								$sql4 = "SELECT * FROM customer_details WHERE email_id = '$customer_email'";
								$customer_results = mysql_query($sql4) or die(mysql_error());
								$first_name = mysql_result($customer_results, 0, "first_name");
								$last_name = mysql_result($customer_results, 0, "last_name");
								$text = mysql_result($comment_results, $i, "text");
								echo 		'<div class="shop_top">'.
												'<h4 class="title">Reviewer : '.$first_name.' '.$last_name.'</h4>'.
												'<p>'.$text.'</p>'.
												'<p>Rating : '.$customer_rating.'/5</p>'.
											'</div>';
									
								$i++;
							}
							mysql_close($link);
						}
					
					
				?>
					<div class = "clear">
					<div class="btn_form">
					<form action="single.php?id=<?php echo $_GET['id'];?>" method="POST" >
						<span>Add a comment and rate the guitar between 1 to 5</span>
						<div class="clear"> </div>
						<span>Enter your comment here : </span><input type="text" name ="comments"/>
						<span>Enter the product rating : </span><input type="text" name ="rating"/>
						<input type="submit" value="Add"/>
						<?php
							$errMsg = "";
							$retval = null;
									if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
										if (!isset($_POST['comments']) || $_POST['comments'] == "") {
											$errMsg = "Please enter your comments";
										}
										else if (!isset($_POST['rating']) || $_POST['rating'] < 1 || $_POST['rating'] > 5 ) {
											$errMsg = "Rate item between 1 to 5";
										}
										else{
											if(isset($_COOKIE['User_Name'])){
												$comment = $_POST['comments'];
												$rating = $_POST['rating'];
												$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
												if(! $link )
													die('Could not connect: ' . mysql_error());
												mysql_select_db('guitar_store_schema');
												$guitar_number = $_GET['id'];
												$email_id = $_COOKIE['User_Name'];
												$insert_comment_query = "INSERT INTO comments (guitar_number, customer_email, text, rating) VALUES ('$guitar_number', '$email_id' ,'$comment', '$rating')";
												$retval = mysql_query($insert_comment_query);
												if(! $retval )
													die('Could not enter data: ' . mysql_error());
												else
													echo "Comment entered";
												mysql_close($link);
											}
											else
												echo '<span>You need to log in to enter comments. </span>';
										}											
									}
						?>
					</div>
				</div>	
				</div>
				</form>
				<div class="clear"> </div>
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