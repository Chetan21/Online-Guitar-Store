<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>

<meta charset="UTF-8">
<title>Online Guitar Store</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">        </script>
     <script src="typeahead.min.js"></script>
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
						    	<li class="current"><a href="shop.php">Shop</a></li>
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
	            <div class="header_right">
	    		  <!-- start search-->
				  <div class="search-box">
							<div id="sb-search" class="sb-search">
								<form method = "POST">
									<input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
									<input class="sb-search-submit" type="submit" value="">
									<span class="sb-icon-search"> </span>
									<script>
										$(document).ready(function(){
										$('input.search').search({
											name: 'search',
											remote:'shop.php?key=%QUERY',
											limit : 10
										});
									});
										</script>
									<?php
									if(isset($_POST['search'])){
										$key=$_GET['key'];
										
										
										$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
										if(! $link )
											die('Could not connect: ' . mysql_error());
										mysql_select_db('guitar_store_schema');
										$search_sql = "SELECT * FROM guitar_details WHERE guitar_name = 'Yamaha'";
										$search_sql_result = mysql_query($search_sql);
										$i=0;
										$num = mysql_fetch_assoc($search_sql_result);
										while($i<$num)
										{
											$guitar_name=mysql_result($search_sql_result,$i,"guitar_name");
											$guitar_price = mysql_result($search_sql_result,$i,"guitar_price");
											$guitar_model = mysql_result($search_sql_result,$i,"guitar_model");
											$guitar_image = mysql_result($search_sql_result,$i,"guitar_image");
											$guitar_number = mysql_result($search_sql_result, $i, "guitar_number");
											$guitar_type = mysql_result($search_sql_result, $i, "guitar_type");
											$guitar_year = mysql_result($search_sql_result, $i, "guitar_year");
											echo '<div class="col-md-3 shop_box"><a href="single.php?id='.$guitar_number.'">';
											echo '<img height="200" width="175" src= "data:image/jpeg;base64,'.base64_encode($guitar_image).'"/>';
											echo '<span class="new-box">';
											echo '<div class="shop_desc">'.
													'<h3><a href="#">'.$guitar_name.'</a></h3>'.
													'<p>'.$guitar_type.'</p>'.
													'<p>'.$guitar_model.'</p><p>'.$guitar_year.'</p>'.
													'<span class="actual">$'.$guitar_price.'</span><br>'.
													'<ul class="buttons">'.
														'<li class="cart"><a href="#">Add To Cart</a></li>'.
														'<li class="shop_btn"><a href="single.php?id='.$guitar_number.'">Read More</a></li>'.
														'<div class="clear"> </div>'.
													'</ul>'.
												'</div>'.
												'</a></div>';
											$i++;
										}
										mysql_close($link);
									}
									?>
								</form>
							</div>
						</div>
						<!----search-scripts---->
						<script src="js/classie.js"></script>
						<script src="js/uisearch.js"></script>
						<script>
							new UISearch( document.getElementById( 'sb-search' ) );
						</script>
		        <div class="clear"></div>
	       </div>
	      </div>
		 </div>
	    </div>
	  </div>
     
		<div class="container">
			<div class="row">
			  <div class="col-md-12">
				 <div class="header-right">
	  
					<ul class="nav" id="nav">
						<li class="current"><a href="shop.php?sortby=1">Name</a></li>
						<li><a href="shop.php?sortby=2">Year</a></li>
						<li><a href="shop.php?sortby=3">Price</a></li>
						<li><a href="shop.php?sortby=4">Ratings</a></li>
					<div class="clear"></div>
					</ul>
		
		</div>
		</div>
		</div>
		</div>
		
		<div class="container">
			<div class="row shop_box-top">
			<?php
				if(!isset($_POST['search'])){
					$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
					if(! $link )
					die('Could not connect: ' . mysql_error());
					mysql_select_db('guitar_store_schema');
					$sort = isset($_POST['sort']) ? $_POST['sort'] : '';
					if(isset($_GET['sortby'])){
						if(1==$_GET['sortby'])
							$sql = "SELECT * FROM guitar_details ORDER BY guitar_name";
						else if(2==$_GET['sortby'])
							$sql = "SELECT * FROM guitar_details ORDER BY guitar_year DESC";
						else if(3==$_GET['sortby'])
							$sql = "SELECT * FROM guitar_details ORDER BY guitar_price DESC";
						
					}
					else
						$sql = "SELECT * FROM guitar_details";
					$result = mysql_query($sql);
					if(!$result )
						die('Could not enter data: ' . mysql_error());
					$num= mysql_numrows($result);
					$i=0;
					
					while ($i < $num) {
						$guitar_name=mysql_result($result,$i,"guitar_name");
						$guitar_price = mysql_result($result,$i,"guitar_price");
						$guitar_model = mysql_result($result,$i,"guitar_model");
						$guitar_image = mysql_result($result,$i,"guitar_image");
						$guitar_number = mysql_result($result, $i, "guitar_number");
						$guitar_type = mysql_result($result, $i, "guitar_type");
						$guitar_year = mysql_result($result, $i, "guitar_year");
						echo '<div class="col-md-3 shop_box"><a href="single.php?id='.$guitar_number.'">';
						echo '<img height="200" width="175" src= "data:image/jpeg;base64,'.base64_encode($guitar_image).'"/>';
						echo '<span class="new-box">';
						echo '<div class="shop_desc">'.
								'<h3><a href="#">'.$guitar_name.'</a></h3>'.
								'<p>'.$guitar_type.'</p>'.
								'<p>'.$guitar_model.'</p><p>'.$guitar_year.'</p>'.
								'<span class="actual">$'.$guitar_price.'</span><br>'.
								'<ul class="buttons">'.
									'<li class="cart"><a href="#">Add To Cart</a></li>'.
									'<li class="shop_btn"><a href="single.php?id='.$guitar_number.'">Read More</a></li>'.
									'<div class="clear"> </div>'.
								'</ul>'.
							'</div>'.
							'</a></div>';
						$i++;
					}
				}
							
			?>
			
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
							<li><a href="#">Sponsorships</a></li>
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