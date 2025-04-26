<?php
session_start();
if (empty($_SESSION["user_id"])) {
	header("Location: ../login/login.php");
}
if (isset($_POST['message'])) {
	$message = $_POST['message'];
	include_once '../../db_connect.php';
	$sql = "INSERT INTO messages (user_id,message) VALUES (?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("is", $_SESSION["user_id"], $message);
	$stmt->execute();
	if ($stmt->affected_rows > 0) {
		echo "<script>alert('Message sent successfully!');</script>";
	} else {
		echo "<script>alert('Failed to send message.');</script>";
	}
	$stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>GeekStore</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bangers&family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<header>
		<a href="#"><img src="../../img/whitelogo.png" alt="GeekStore Logo" class="logo"></a>
		<nav class="navbar">
			<a href="#home">Home</a>
			<a href="../Products/index.php">Shop</a>
			<a href="#contact">Contact</a>
			<a href="#about">About</a>
			<a href="../card/main.php">card</a>
			<form class="logout-form" action="logout.php" method="post">
				<button type="submit" name="logout" class="submit">
					<i class="fa-solid fa-right-to-bracket"></i></button>
			</form>
		</nav>
	</header>
	<section id="home">
		<div class="hero-content">
			<h1>Welcome to GeekStore</h1>
			<p>Your ultimate destination for anime & manga merch – from stickers and clothes to figures and more!</p>
			<a href="../Products/index.php" class="btn">Shop Now</a>
		</div>
	</section>
	<section id="shop">
		<h2>Shop Anime & Manga Merch</h2>
		<div class="product-container" id="product-list">
			<div class="product-card">
				<img src="../../img/sakamoto_toy.webp" alt="Anime Figure">
				<h3>Anime Figure</h3>
				<a href="../Products/index.php?category=Figure">Explore</a>
			</div>
			<div class="product-card">
				<img src="../../img/sl_hoodie.webp" alt="Anime Hoodie">
				<h3>Anime Hoodie</h3>
				<a href="../Products/index.php?category=Hoodie">Explore</a>
			</div>
			<div class="product-card">
				<img src="../../img/anime stickers example.jpg" alt="Anime stickers">
				<h3>Anime stickers</h3>
				<a href="../Products/index.php?category=Sticker">Explore</a>
			</div>
		</div>
	</section>
	<section id="pose">
		<div class="poseimg">
			<img src="../../img/pose1.jpg" alt="Pose1">
			<div class="overlay"><a class="overlay-link" href="../Products/index.php?search=jujutsu kaisen">purchase jujutsu kaisen</a></div>

		</div>

		<div class="poseimg">
			<img src="../../img/pose2.jpg" alt="Pose2">
			<div class="overlay"><a class="overlay-link" href="../Products/index.php?search=blue lock">purchase blue lock</a></div>
		</div>

		<div class="poseimg">
			<img src="../../img/pose3.jpg" alt="Pose3">
			<div class="overlay"><a class="overlay-link" href="../Products/index.php?search=kaiju">purchase kaiju n°8</a></div>
		</div>
	</section>
	<section id="contact">
		<div class="overlay-contact"></div>
		<h2 class="contact-title">Contact Us</h2>
		<div class="contact-content">
			<div class="contact-info">
				<h3><i class="fa-solid fa-location-dot"></i>Address</h3>
				<p>143 Rue de la Nouvelle Delhi,Sfax</p>

				<h3><i class="fa-solid fa-phone"></i></i>Phone</h3>
				<p>28-460-080</p>

				<h3><i class="fa-solid fa-envelope"></i></i>Email</h3>
				<p>support@geekstore.com</p>
			</div>
			<form class="contact-form" action="" method="post">
				<h3>Send a message</h3>
				<!-- <div class="form-group">
					<input placeholder="Full Name" type="text" id="name" name="name" required>
				</div>

				<div class="form-group">
					<input placeholder="email" type="email" id="email" name="email" required>
				</div> -->
				<div class="form-group">
					<textarea id="message" placeholder="Type your Message..." name="message" required></textarea>
				</div>
				<button type="submit">Send</button>
			</form>

		</div>
	</section>

	<footer id="about">
		<p>We're passionate about bringing anime and manga fans the best merch in the galaxy.</p>
		<span>&copy; GeekStores, All Rights Reserved.</span>
	</footer>


</body>

</html>