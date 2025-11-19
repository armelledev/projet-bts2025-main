<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- <link rel="stylesheet" href="resources/css/header.css"> -->
    <link rel="stylesheet" href="resources/css/style.css">
    <!-- <link rel="stylesheet" href="resources/css/form.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
	      <!-- <link href="src/outpout.css" rel="stylesheet"> -->
		  <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
		     <script src="https://cdn.tailwindcss.com"></script>
			 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>gestin personnelle <?= $pageTitle ?></title>
</head>
<body>
    

	
	<!-- SIDEBAR -->
	<?php include('sidebar_html.php') ?>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<?php
       include('header_html.php')
       ?>
		<!-- NAVBAR -->

		<!-- MAIN -->
		 <?=  $pageContent ?>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->


  <?php include('footer_html.php')?>
    </body>
</html>