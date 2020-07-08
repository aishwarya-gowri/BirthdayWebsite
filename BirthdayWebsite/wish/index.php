<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Happy Birthday!!!</title>
		<link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/styles.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
	</head>
	<body style="background-image: none;">
	<h3 align="center">Write your birthday wish for Lavanya</h3><br><hr/>
	<div class="container py-3">
		<a href="/index.php">Go Back to website</a>
		<div class="row">
			<div class="col-md-4 py-2 px-3">
				<p>Sample Wish</p>
				<div class="card">
					<img class="card-img-top" src="/assets/images/website-background2.jpg" alt="<Title>">
					<div class="card-body">
						<h5 class="card-title" id="inp4_prev">Title</h5>
						<p class="card-text" id="inp5_prev">---------------------------------------------------------------------------------------------------------------------- Your Message ----------------------------------------------------------------------------------------------------------------------</p>
					</div>
					<div class="card-footer text-muted" id="inp1_prev">
						Your Name
					</div>
				</div>
				<p class="text-muted">Sorry image cannot be updated in realtime (but it will be uploaded)</p>
			</div>
			<div class="col-md-6">
				<?php
				$success = 0;
				function save_record_image($image,$name = null){
					$API_KEY = '7f8c6fb9ac72283f6ab4fd96de4b3343';
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload?key='.$API_KEY);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
					$extension = pathinfo($image['name'],PATHINFO_EXTENSION);
					$file_name = ($name)? $name.'.'.$extension : $image['name'] ;
					$data = array('image' => base64_encode(file_get_contents($image['tmp_name'])), 'name' => $file_name);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					$result = curl_exec($ch);
					if (curl_errno($ch)) {
					    return 'Error:' . curl_error($ch);
					}else{
						return json_decode($result, true);
					}
					curl_close($ch);
				}

				if (!empty($_FILES['record_image'])) {
					$id = uniqid();
					$return = save_record_image($_FILES['record_image'],$id);
					echo "<br>File upload successful<br><br>";
					$url =  $return['data']['url'];
					if (trim($url)==false) {
						$url = "https://i.ibb.co/gtfxZDT/5ee34cf63e232-jpg.jpg";
					}
					$title = str_replace('\'', '\\\'', $_POST['title']);
					$title = str_replace('"', '\\"', $title);
					$msg = str_replace('\'', '\\\'', $_POST['message']);
					$msg = str_replace('\"', '\\"', $msg);
					$msg = nl2br($msg);
					$cat = $_POST['category'];
					$p_nam = str_replace('\'', '\\\'', $_POST['p_name']);
					$p_nam = str_replace('\"', '\\"', $p_nam);

					$servername = "sql12.freemysqlhosting.net";
					$username = "sql12353284";
					$password = "KNdr7Rfbvx";
					$dbname = "sql12353284";
					

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					
					// Check connection
					if ($conn->connect_error) {
					    die("SQL Connection failed: " . $conn->connect_error);
					}
					$img = $return['data']['image']['filename'];
					date_default_timezone_set("Asia/Kolkata");
					$d = date("d-m-Y h:i:sa");

					
					$sql = "INSERT INTO messages (timestamp,category,uniqueid,imgsrc,name,title,message)
					VALUES ('$d','$cat','$id','$url','$p_nam','$title','$msg')";
					if ($conn->query($sql) === TRUE) {
					    echo "SQL DATABASE UPDATED SUCCESFULLY<br>";
					    $success = 1;
					} else {
					    echo "<br>Error: " . $sql . "<br>" . $conn->error;
					}

					$conn->close();
					}
					if ($success==1) {
						echo '<script>alert("Your message has been saved successfully !!!");</script>';
						echo "Your message has been saved successfully !!!";
						echo '<a href="/index.php">Click here to go back to website</a>';
						echo "<br><br>";
						// header("Location: https://happybirthdayharsh.herokuapp.com/");
					}
				?>
				<h4>Fill this form</h4>
				<!-- <b>Please don't use apostrophe(')</b> -->
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="inp1">Your Name (you can skip this or write something else)</label>
						<input type="text" name="p_name" placeholder="enter your name" id="inp1" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="inp2">Category of Wish</label>
							<select class="form-control" id="inp2" name="category" required>
							<option value="both">Image + Text + Title</option>
							<option value="imag">Image + Title</option>
							<option value="text">Text + Title</option>
						</select>
					</div>
					<div class="form-group">
						<label for="inp3">Select image to upload (5MB MAX)</label>
						<input class="form-control-file" id="inp3" type="file" name="record_image" accept="image/*">
					</div>
					<div class="form-group">
						<label for="inp4">Title for the post (max 60 chars)</label>
						<input type="text" name="title" placeholder="enter title here" maxlength="60" id="inp4" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="inp5">Enter Message</label>
						<textarea name="message" placeholder="enter message here" class="form-control" id="inp5" rows="5"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<script src="/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function (){
          var content1 = $('#inp1').val();
          $('#inp1').keyup(function () {
              if (this.value != content1) {
                content1 = this.value.replace(/\n/g, "<br />");
                   $('#inp1_prev').html(content1 );            
               }
          });
          var content2 = $('#inp4').val();
          $('#inp4').keyup(function () {
              if (this.value != content2) {
                content2 = this.value.replace(/\n/g, "<br />");
                   $('#inp4_prev').html(content2 );            
               }
          });
          var content3 = $('#inp5').val();
          $('#inp5').keyup(function () {
              if (this.value != content3) {
                content3 = this.value.replace(/\n/g, "<br />");
                   $('#inp5_prev').html(content3 );            
               }
          });
    })
	</script>
	</body>
</html>