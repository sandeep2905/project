<?php
include("include/header.php");
include("include/config.php");
?>
<!--Banner-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
  <ol class="carousel-indicators">
	<li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
	<li data-target="#carousel-example-1z" data-slide-to="1"></li>
	<li data-target="#carousel-example-1z" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
	<div class="carousel-item active">
	  <img class="d-block w-100" src="assets/img/banner1.jpg" alt="First slide" style="height: 438px;">
	  <div class="carousel-caption">
		<h1>Welcome To</h1>
		<h3>Paying Guest Accomodation..!!!</h3>
	  </div>
	</div>
	<div class="carousel-item">
	  <img class="d-block w-100" src="assets/img/banner2.jpg" alt="Second slide" alt="First slide" style="height: 438px;">
	</div>
	<div class="carousel-item">
	  <img class="d-block w-100" src="assets/img/banner3.png" alt="Third slide" alt="First slide" style="height: 438px;">
	</div>
  </div>
  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
  </a>
</div>
<!-- About Us -->	
<div class="container-fluid #eeeeee grey lighten-5" id="about">
	<div class="row">
	<div class="col-md-10 mx-auto my-5">
		<h2>ABOUT US</h2>
		<hr/>
		<p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
	</div>
</div>
<br/>
<!-- Paying Guest cart -->
<?php
$stmt0 = $conn->prepare("SELECT * FROM `property_details` ORDER by rand()");
$stmt0->execute();
if ($stmt0->rowCount() > 0) 
{
?>
	<center><h2>PAYING GUEST DETAILS</h2></center>
	<hr/>
	<div class="container my-5">
		<div class="owl-carousel owl-theme">
			<?php
			$j=0;
			$str = "";
			while($row = $stmt0->fetch())
			{
				$pid = $row["pid"];
				$image = $row["image"];
				if($image != "-")
				{
					$first = explode (",", $image);
					$img = "upload/$first[0]";
				}
				else
				{
					$img = "assets/img/noimg.png";
				}
				$rental = $row["rental_value"];
				$security = $row["security_deposit"];
				$total = $rental + $security;
				$city = $row["city"];
				$available = $row["available_for"];
				$occupancy = $row["occupancy"];
				$furnished = $row["furnished_status"];
				$meals_included = $row["meals_included"];
				$description = $row["description"]; 
				$state = $row["state"];
				$address = $row["address"];
				?>
				<div class="item">
					<div class="card">
						<div class='view overlay'>
						  <img class='card-img-top' src='<?php echo $img ?>' alt='Card image cap' style='height: 200px;'>
						  <a href='#!'>
							<h2><div class='mask rgba-white-slight'><?php echo $state ?></div><h2>
						  </a>
						</div>
						  <div class="card-body">
							<h5><?php echo $city ?></h5>
							  <p class='card-title'><i class='fas fa-map-marker-alt'></i> <?php echo $address ?></p>
							  <h4 class=''>₹ <?php echo $rental ?></h4>
							  <a data-toggle='modal' data-target='#loginmodal'><button type='button' class='btn btn-light-blue btn-md cartbutton'>See More Details</button></a>
						  </div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
<?php
}
?>
<br/>
<!-- State Vise Tabs -->	
<?php
$stmt1 = $conn->prepare("SELECT distinct(state) as state FROM `property_details` ORDER by rand()");
$stmt1->execute();
if ($stmt1->rowCount() > 0) 
{
	$heading = "Browse Residential Projects in Top Cities";
	$content = "";	
	$content1 = "";
	$i = 0;
	while($row = $stmt1->fetch())
	{
		$state = $row["state"];
		$content .= "<li class='nav-item'>";
		if($i == 0)
		{
			$content .= "<a class='nav-link active' id='tab".$i."' data-toggle='tab' href='#ar".$i."' role='tab' aria-controls='ar".$i."' aria-selected='true'>$state</a>";
		}
		else
		{
			$content .= "<a class='nav-link' id='tab".$i."' data-toggle='tab' href='#ar".$i."' role='tab' aria-controls='ar".$i."' aria-selected='true'>$state</a>";
		}
		$content .= "</li>";
					
		$stmt2 = $conn->prepare("SELECT city FROM `property_details` where state = '".$state."'");
		$stmt2->execute();
		if($i == 0)
		{
			$content1 .= "<div class='tab-pane fade show active' id='ar".$i."' role='tabpanel' aria-labelledby='tab".$i."'><ul>";
		}
		else
		{
			$content1 .= "<div class='tab-pane fade show' id='ar".$i."' role='tabpanel' aria-labelledby='tab".$i."'><ul>";
		}
		while($row = $stmt2->fetch())
		{
			$content1 .= "<li>".$row["city"]."</li>";
		}
		$content1 .= "</ul></div>";
		$i++;
	}
	?>
	<hr/>
	<div class="container my-5">
		<center><h2><?php echo $heading;?></h2></center>
		<br/>
		<ul class="nav nav-tabs navtabul" id="myTab" role="tablist">
			<?php echo $content;?>
		</ul>
		<div class="tab-content" id="myTabContent">
			<?php echo $content1;?>
		</div>
	</div>
<?php
}
?>
<!-- Sign in Modal -->	
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
	<div class="modal-content">
	  <div class="modal-header text-center">
		<h4 class="modal-title white-text w-100 font-weight-bold">Sign In</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true" class="white-text">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<div>
		  <div class="card-body px-lg-4 pt-0">
			<form class="text-center" style="color: #757575;" method="post" id="loginform">
			  <div class="md-form">
				<input type="email" id="lemail" name="lemail" class="form-control" required>
				<label for="lemail">E-mail</label>
			  </div>
			  <div class="md-form">
				<input type="password" id="lpassword" class="form-control" name="lpassword" required>
				<label for="lpassword">Password</label>
			  </div>
				<input type="submit" name="lsubmit" id="laction" class="btn cartbutton text-white" value="SIgn In" style="width: 100%"/>
			</form>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<!-- Resgistration Modal-->
<div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
	<div class="modal-content">
	  <div class="modal-header text-center">
		<h4 class="modal-title white-text w-100 font-weight-bold">Sign up</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true" class="white-text">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<div>
			<div class="card-body px-lg-4 pt-0">
				<form class="text-center" style="color: #757575;" method="post" id="registration_form" enctype="multipart/form-data">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="md-form">
									<input type="text" id="name" name="name" class="form-control" required>
									<label for="name">Name</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="md-form">
									<input type="email" id="email" name="email" class="form-control" required>
									<label for="email">E-mail</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="md-form">
									<input type="number" id="contact" name="contact" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock" required>
									<label for="contact">Contact</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="md-form">
									<input type="password" id="password" name="password" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required>
									<label for="password">Password</label>
								</div>
							</div>
							<div class="col-md-12"></div>
							<div class="col-md-6">
								<div class="md-form text-left">
									<label>Gender:</label><br/><br/>
									<div class="col-md-12 pl-4">
									<div class="custom-control custom-radio custom-control-inline pr-4">
									  <input type="radio" class="custom-control-input" id="male" name="gender" required value="Male">
									  <label class="custom-control-label" for="male">Male</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" class="custom-control-input" id="female" name="gender" value="Female">
									  <label class="custom-control-label" for="female">Female</label>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="md-form">
									<label>DOB:</label><br/><br/>
									<input type="date" id="date" name="date" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="md-form">
									<input type="number" id="age" name="age" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock" required>
									<label for="age">Age</label>
								</div>
							</div>
							<div class="col-md-6">
								<label for="file" style="text-align: left; width: 100%;">Upload Images</label>
								<div class="input-group">
								  <div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
								  </div>
								  <div class="custom-file">
									<input type="file" name="files" class="custom-file-input" id="file"  aria-describedby="inputGroupFileAddon01" required onchange="preview_image();">
									<label class="custom-file-label" for="file">Choose file</label>
								  </div>
								</div>	
							</div>
							<div class="col-md-12">
								<div class="md-form">
									<textarea id="address" name="address" class="form-control md-textarea" rows="1" required></textarea>
									<label for="address">Address</label>
								</div>
							</div>
							<div class="col-md-12">
								<input type="submit" name="submit" id="action" class="btn cartbutton text-white" value="Add" style="width: 100%"/>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php include('include/footer.php'); ?>
<script>
//On document Load
$(document).ready(function(){
	//Owl carousel
	var owl = $('.owl-carousel');
	  owl.owlCarousel({
		margin: 10,
		nav: true,
		loop: false,
		dots: false,
		autoplay:true,
		autoplayTimeout:5000,
		navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
		responsive: {
		  0: {
			items: 1
		  },
		  600: {
			items: 3
		  },
		  1000: {
			items: 3
		  }
		}
	  });
	 //On nav item click
    $( "a.scrollLink" ).click(function( event ) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: $($(this).attr("href")).offset().top }, 1000);
    });
	
	var date = new Date();
	var month = parseInt(date.getMonth())+1;
	var Parsedate = date.getDate();
	if(Parsedate < "10")
	{
		Parsedate = "0" + Parsedate;
	}
	if(month < "10")
	{
		month = "0" + month;
	}
	var futDate= date.getFullYear() + "-" + month + "-" + Parsedate;
	document.getElementById("date").setAttribute("max", futDate);
});
//Check Extension Of image
function preview_image() 
{
	var ext = $("#file")[0].files[0].name;
	ext = ext.replace(/^.*\./, '');
	if(ext == "jpg" || ext == "png" || ext == "jpeg")
	{
	}
	else
	{
		swal("You have choosed wrong extension of image..!!");
		document.getElementById("file").value = "";
	}
}
//Registration Form Submit
$(document).on('submit', '#registration_form', function(event){
	event.preventDefault();
	$.ajax({
		url:"RegistrationResponse.php",
		method:"POST",
		data:new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success:function(data)
		{
			if(data == "fail")
			{
				swal("This Email Id is already registered..!!");
			}
			else
			{
				swal({
					text: data,
					type: "success"
				}).then(function() {
					window.location = "index.php";
				});
			}
		}
	});
});
//Login Form Submit
$(document).on('submit', '#loginform', function(event){
	event.preventDefault();
	$.ajax({
		url:"LoginResponse.php",
		method:"POST",
		data:new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success:function(data)
		{
			if(data == "fail")
			{
				swal("You are not authorized..!!");
			}
			else
			{
				window.location.href="ManagePG.php";
			}
		}
	});
});
</script>
</body>
</html>