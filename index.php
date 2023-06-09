<?php 
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Site 1</title>
	<!-- Bootstrap --> 
	<link href="css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
	<header class="col-sm-12 col-md-12 col-lg-12">
		<?php include_once("pages/login.php");?>
	</header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container" >	
            <a class="navbar-brand" href="#">Site 1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria>
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php include_once("pages/menu.php") ?>
        </div>
    </nav>

	<div class="container py-5">
		<?php
			if(isset($_GET['page']))
			{
				$page=$_GET['page'];
				if($page == 1)include_once('pages/tours.php');
				if($page == 2)include_once('pages/comments.php');
				if($page == 3)include_once('pages/register.php');
				if($page == 4)include_once('pages/admin.php');
				if($page==6 && isset($_SESSION['radmin']))include_once("pages/private.php");
				if($page == 7)include_once('pages/sector.php');
				if($page == 8)include_once('pages/hotelinfo.php');
			}
		?>
	</div>

</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>
