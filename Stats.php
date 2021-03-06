<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: signin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: signin.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		  <title>Counter Strike</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <link rel="stylesheet" type="text/css" href="style.css">
		  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js' type='text/javascript'></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <style>
		  		body {
					background-image: url(csgo1.jpg);
					background-repeat: no-repeat;
					background-size: 100%;
				}
		  		#footer{
		  			position: fixed;
    				bottom: 0;
    				width: 100%;
		  		}
				.navbar {
				  	margin-bottom: 0;
				  	border-radius: 0;
				}
				.row.content {height: 450px}
				.sidenav {
				  	padding-top: 20px;
				  	background-color: cadetblue;
				  	height: 100%;
				}
				footer {
				  	background-color: #555;
				  	color: white;
				  	padding: 15px;
				}
				@media screen and (max-width: 767px) {
				  	.sidenav {
						height: auto;
						padding: 15px;
				  	}
				  	.row.content {height:auto;} 
				}
		  </style>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					 </button>
					 <a class="navbar-brand" href="#">CSGO</a>
				</div>
				
				<div class="collapse navbar-collapse" id="myNavbar">
				  	<ul class="nav navbar-nav">
						<li><a href="home.html">Home</a></li>
						<li><a href="Player.php">Player Info</a></li>
						<li class="active"><a href="#">Stats</a></li>
						<li><a href="teams.php">Teams</a></li>
				  	</ul>
				  	<ul class="nav navbar-nav navbar-right">
					<li><a href="Player.php?logout='1'" style="color: white;"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
				
		  	</div>
		</nav>
		
		<h2 class="text-center" style="color:white">Player Stats</h2>
	<div class="content">	
  		<?php if (isset($_SESSION['success'])) : ?>
				<div class="error success" >
					<h3>
				    <?php 
				    	echo $_SESSION['success']; 
				    	unset($_SESSION['success']);
				    ?>
					</h3>
		  	<?php endif ?> 
			<?php  if (isset($_SESSION['username'])) : 
				$username = $_SESSION['username'];
				$con=mysqli_connect("localhost","root","","user");
				if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				$query = "SELECT * FROM stats,player where stats.player_name=player.name AND stats.player_name='$username'";
				$result=mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
			?>
			 	<p><strong><?php echo "NAME:".$row['player_name'] ?></strong></p>
			 	<p><strong><?php echo "RANK:".$row['player_rank'] ?></strong></p>
				<p><strong><?php echo "LEVEL:".$row['player_level'] ?></strong></p>
				<p><strong><?php echo "NUMBER OF HOURS PLAYED:".$row['hours_played'] ?></strong></p>
			 <?php endif ?>
		</div>  
	</body>
</html>
