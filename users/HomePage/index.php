<?php
session_start();
if (empty($_SESSION["user_id"])) {
	header("Location: ../login/login.php");
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
			<a href="#shop">Shop</a>
			<a href="#about">About</a>
			<a href="#contact">Contact</a>
			<form class="logout-form" action="logout.php" method="post">
			<button type="submit" name="logout" class="submit">
			<i class="fa-solid fa-right-to-bracket"></i>
			<button type="submit" name="logout" class="submit"></button>
			</form>
		</nav>
	</header>
	<section id="home">
		<div class="hero-content">
			<h1>Welcome to GeekStore</h1>
			<p>Your ultimate destination for anime & manga merch – from stickers and clothes to figures and more!</p>
			<a href="../Products/index.html" class="btn">Shop Now</a>
		</div>
	</section>
	<section id="shop">
		<h2>Best Seller</h2>
		<div class="product-container" id="product-list">
			<div class="product-card">
				<img src="../../img/sakamoto_toy.webp" alt="Anime Figure">
				<h3>Sakamoto Figure</h3>
				<a href="../Products figures/index.html">Explore</a>
			</div>
			<div class="product-card">
				<img src="../../img/sl_hoodie.webp" alt="Anime Hoodie">
				<h3>Solo Leveling Hoodie</h3>
				<a href="../Products hoodie/index.html">Explore</a>
			</div>
			<div class="product-card">
				<img src="../../img/anime stickers example.jpg" alt="Anime stickers">
				<h3>Anime stickers</h3>
				<a href="../Products sticker/index.html">Explore</a>
			</div>
			<div class="product-card">
				<img src="../../img/gfreddy_plush.jpg" alt="Anime stickers">
				<h3>Golden Freddy Plushie</h3>
				<a href="../Products sticker/index.html">Explore</a>
			</div>
			</div>
		</div>
	</section>
	<section id="pose">
  <div class="poseimg">
    <img src="../../img/pose1.jpg" alt="Pose1">
    <div class="overlay"><a class="overlay-link" href="../Products figures/index.html">purchase jujutsu kaisen</a></div>
	
  </div>

  <div class="poseimg">
    <img src="../../img/pose2.jpg" alt="Pose2">
    <div class="overlay"><a class="overlay-link" href="../Products figures/index.html">purchase blue lock</a></div>
	
  </div>

  <div class="poseimg">
    <img src="../../img/pose3.jpg" alt="Pose3">
    <div class="overlay"><a class="overlay-link" href="../Products figures/index.html">purchase kaiju n°8</a></div>
  </div>
</section>
	<section id="contact">
		<h2>Contact Us</h2>
		<p>Email: support@geekstore.com</p>
		<p>Follow us on social media!</p>
	</section>

	<footer id="about">
		<h2>About GeekStore</h2>
		<p>We're passionate about bringing anime and manga fans the best merch in the galaxy.</p>
	</footer>

</body>

</html>