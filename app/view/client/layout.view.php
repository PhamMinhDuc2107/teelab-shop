<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $data['title'] ? $data['title'] : "Home Page"?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
	href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,700&display=swap"
	rel="stylesheet"
	/>
	<!-- font awesome -->
	<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
	/>
	<!-- swiper -->
	<link
	rel="stylesheet"
	href="https://unpkg.com/swiper/swiper-bundle.min.css"
	/>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<!-- css -->
	<link rel="stylesheet" href="<?php echo ROOT  ?>assets/client/css/app.css" />
</head>
<body>
	<section class="wrapper">
		<?php require_once './app/view/client/blocks/header.view.php'; ?>
		<?php 
		if(isset($data['page']))
		{
			require_once "./app/view/client/pages/$data[page].view.php";
		}
		?>
		<?php require_once './app/view/client/blocks/footer.view.php'; ?>
	</section>
	<?php require_once './app/view/client/blocks/menu.view.php'; ?>
</body>
<script src="<?php echo ROOT ?>assets/client/js/app.js"></script>
<script src="<?php echo ROOT ?>assets/client/js/home.js"></script>
</html>
