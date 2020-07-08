<?php

$servername = "sql12.freemysqlhosting.net";
$username = "sql12353284";
$password = "KNdr7Rfbvx";
$dbname = "sql12353284";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Happy Birthday!!!</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/styles.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
		<!-- <style type="text/css">
			.imag{
				background-color: pink;
			}
			.text{
				background-color: cyan;
			}
			.both{
				background-color: gray;
			}
		</style> -->
	</head>
	<body>
		<!-- Banner Section -->
		<section id="banner">
			<div class="banner-semi">
					<div class="banner-content">
						<h1 class="banner-heading d-md-none" style="font-size: 35px;">
								Happy Birthday Lavanya!!!
						</h1>
						<h1 class="banner-heading d-none d-md-block">
								Happy Birthday Lavanya!!!
						</h1>
					</div>
			</div>
			<div class="container p-3">
				<div class="row">
					<div class="col-md-5 mx-auto text-center d-none d-md-block">
						<img src="assets/images/header.png" style="width: 100%;">
					</div>
					<div class="col-md-5 mx-auto text-center d-md-none">
						<img src="assets/images/header_ph.png" style="width: 100%;">
					</div>
				</div>
			</div>
		</section>
		<!-- <div class="container">
			<a href="wish/" target="_blank">Write your wish here</a>
		</div> -->
		<section id = "picnwish">
			<div class="picnwish-pic">
				<div class="container">
					<div class="row">
						
						<?php
						$ok = 0 ;

						$sql = "SELECT * from messages ";

						$msg = "" ; 
						while ($ok == 0)
						{
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						$ok = 1 ;
						}
						}
						if (($result->num_rows > 0)&&($ok!=0)) {
							// output data of each row
							$i=0;
							while($row = $result->fetch_assoc()) {
								if (($i%3 == 0)&&($i!=0)) {
									echo '</div><div class="row">';
								}
						// $msg = '<br>'.$row['title'].'<br>'.$row['message'].'<br>';
						$imgsrc = $row['imgsrc'];
						if ($row['category']=='text') {
							$msg = '<div class="col-md-4 py-2 px-3 '.$row['category'].'">
										<div class="card">'.'
											<div class="card-body">
												<h5 class="card-title">'.$row['title'].'</h5>
												<p class="card-text">'.$row['message'].'</p>
											</div>
											<div class="card-footer text-muted">'.$row['name'].'</div>
										</div>
									</div>';
						}
						elseif ($row['category']=='both') {
							$msg = '<div class="col-md-4 py-2 px-3 '.$row['category'].'">
										<div class="card">'.'
											<img class="card-img-top" src="'.$imgsrc.'" alt="'.$row['title'].'">
											<div class="card-body">
												<h5 class="card-title">'.$row['title'].'</h5>
												<p class="card-text">'.$row['message'].'</p>
											</div>
											<div class="card-footer text-muted">'.$row['name'].'</div>
										</div>
									</div>';
						}
						elseif ($row['category']=='imag') {
							$msg = '<div class="col-md-4 py-2 px-3 '.$row['category'].'">
										<div class="card">'.'
											<img class="card-img-top" src="'.$imgsrc.'" alt="'.$row['title'].'">
											<div class="card-body">
												<h5 class="card-title">'.$row['title'].'</h5>
											</div>
											<div class="card-footer text-muted">'.$row['name'].'</div>
										</div>
									</div>';
						}
						else{
							$msg = '<div class="col-md-4 py-2 px-3 '.$row['category'].'">
										<div class="card">'.'
											<img class="card-img-top" src="'.$imgsrc.'" alt="'.$row['title'].'">
											<div class="card-body">
												<h5 class="card-title">'.$row['title'].'</h5>
												<p class="card-text">'.$row['message'].'</p>
											</div>
											<div class="card-footer text-muted">'.$row['name'].'</div>
										</div>
									</div>';
						}
						echo $msg ;
						$i = $i + 1;
						}

						}
						else 
						{
						echo "No results" ;
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<br><br>
		<section id = "wish">
			<div class = "wish-link-box">
				<a class="wish-link" href="wish/">Write your wish here!!!</a>
			</div>
		</section>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>