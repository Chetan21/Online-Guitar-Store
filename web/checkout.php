
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
	            <div class="header_right">
	    		  
		        <div class="clear"></div>
	       </div>
	      </div>
		 </div>
	    </div>
	  </div>
     <div class="main">
      <div class="shop_top">
		<div class="container">
		<?php 
			if(isset($_POST['cart'])){
				if(!isset($_POST['remove'])){
					$guitar_number = $_POST['guitar_number'];
					$guitar_price = $_POST['guitar_price'];
					$guitar_quantity = 1;
					
					$i=0;
					$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
					if(! $link )
						die('Could not connect: ' . mysql_error());
					mysql_select_db('guitar_store_schema');
					$sql_guitar_price_query = "SELECT guitar_price FROM guitar_details WHERE guitar_number= '$guitar_number'";
					$guitar_price_result = mysql_query($sql_guitar_price_query);
					if(!$guitar_price_result)
						die('Price not found'.mysql_error());
					$guitar_price = mysql_result($guitar_price_result, 0, "guitar_price");
					
					$sql_create_cart_table = "CREATE  TABLE `guitar_store_schema`.`shopping_cart` (
											  `guitar_number` INT NOT NULL ,
											  `guitar_price` VARCHAR(45) NOT NULL,
											  `guitar_quantity` VARCHAR(45) NOT NULL)";
					$create = mysql_query($sql_create_cart_table);
					if($create ){
						$sql_insert = "INSERT INTO shopping_cart (guitar_number, guitar_price, guitar_quantity) VALUES ('$guitar_number', '$guitar_price', '$guitar_quantity')";
						$insert = mysql_query($sql_insert);
						if(!$insert)
							die('Couldnt insert data in new table'.mysql_error());
					}
					else{
						$sql_insert = "INSERT INTO shopping_cart (guitar_number, guitar_price, guitar_quantity) VALUES ('$guitar_number', '$guitar_price', '$guitar_quantity')";
						$insert = mysql_query($sql_insert);
						if(!$insert)
							die('Couldnt insert data in table'.mysql_error());
					}
				}
			}
			
			$total_price = 0;
			$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
				if(! $link )
					die('Could not connect: ' . mysql_error());
				mysql_select_db('guitar_store_schema');
			$guitar_cart_query= "SELECT * FROM shopping_cart";
			$guitar_result = mysql_query($guitar_cart_query);
			if(!$guitar_result || null == $guitar_result){
				echo '<div class="main">
						  <div class="shop_top">
							<div class="container">
								<h4 class="title">Shopping cart is empty</h4>
								<p class="cart">You have no items in your shopping cart.<br>Click<a href="shop.php"> here</a> to continue shopping</p>
							 </div>
						   </div>
						  </div>';
			} else{
				$total_rows= mysql_numrows($guitar_result);
				$i=0;
				echo '<h4 class="title">Your Shopping cart contains following items:</h4>';
				echo '<div class="col-md-3 shop_box">';
				echo '<form action="" method="POST">';
				while($i<$total_rows){
					$guitar_number_from_cart = mysql_result($guitar_result, $i, "guitar_number");
					$guitar_quantity_from_cart = mysql_result($guitar_result, $i, "guitar_quantity");
					$sql_guitar_info_query = "SELECT * FROM guitar_details WHERE guitar_number=".$guitar_number_from_cart;
					$cart_result = mysql_query($sql_guitar_info_query);
					if(!$cart_result )
						die('Error ' . mysql_error());
					$guitar_price_from_cart = mysql_result($cart_result, 0, "guitar_price");
					$guitar_image_from_cart = mysql_result($cart_result, 0, "guitar_image");
					$guitar_name_from_cart = mysql_result($cart_result, 0, "guitar_name");
					$guitar_type_from_cart = mysql_result($cart_result, 0, "guitar_type");
					$guitar_model_from_cart = mysql_result($cart_result, 0, "guitar_model");
					echo '<input type="checkbox" name = "guitar_check" value='.$guitar_number_from_cart.'>';
					echo '<img height="100" width="80" src= "data:image/jpeg;base64,'.base64_encode($guitar_image_from_cart).'">';
					echo '<h3><a>'.$guitar_name_from_cart.'</a></h3>'.
							'<p>'.$guitar_type_from_cart.'</p>'.
							'<p>'.$guitar_model_from_cart.'</p>'.
							'<span class="actual">$'.$guitar_price_from_cart.'</span><br>'.
							'<p>Quantity : '.$guitar_quantity_from_cart.'</p>'.
						'</div>'.
						'</img>';
					$total_price = $total_price	+ $guitar_price_from_cart*$guitar_quantity_from_cart;
						$i++;
					}
			}
			echo '</form>';
			echo 	'<div class="container">
					<h3> TOTAL = </h3>$'.$total_price;
			echo 	'</div>';
			echo 	'<div class="clear"></div>'.
					'<div class="container">'.
					'<div class = header-left>'.
					'<form action='.htmlspecialchars($_SERVER['PHP_SELF']).' method="POST">'.
					'<input name="remove" type="submit" value="Remove"/> </form>';
					
			if(isset($_POST['remove'])){
				if(!isset($_POST['guitar_check']))
					echo "Select a guitar to remove from cart.";
				else{
					$guitar_number_delete = $_POST['guitar_check'];
					$sql_query_removed_guitar_price = "SELECT guitar_price FROM guitar_details WHERE guitar_number= '$guitar_number_delete'";
					$subtract_guitar_price_query_result = mysql_query($sql_query_removed_guitar_price);
					if(!$subtract_guitar_price_query_result)
						die('ERRROR'.mysql_error());
					$total_price = $total_price - $subtract_guitar_price_query_result;
					$sql_query_remove_guitar = "DELETE FROM shopping_cart WHERE guitar_number= '$guitar_number_delete'";
					$remove_guitar_result = mysql_query($sql_query_remove_guitar);
					if(!$remove_guitar_result)
						die('ERRROR'.mysql_error());
					echo "<p>Selected guitar removed</p>";
				}
			}
			
			echo 	'<div class="clear"></div>'.
					'<div class = header_right>'.
					'<form action="payment.php" method="POST">'.
					'<input name="order" type="submit" value="Proceed to Payment"/>'.
					'</form>'.
					'</div>'.
				'</div>';
				
			mysql_close($link);	
?>
			
			</div>
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