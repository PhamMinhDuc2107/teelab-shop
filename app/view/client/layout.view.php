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
	<!-- toastr -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	<!-- css -->
	<link rel="stylesheet" href="<?php echo ROOT  ?>assets/client/css/app.css" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Jquery -->
<script src="<?php echo ROOT ?>assets/client/js/app.js"></script>
<script src="<?php echo ROOT ?>assets/client/js/home.js"></script>
<script>
	const inputQuantity  = document.querySelector(".input__quantity");
	if(inputQuantity){
		inputQuantity.addEventListener("change", function(e) {
			const quantity = e.target.value;
			 var dataId = $('.input__quantity').data('id');
			$.ajax({
                url: 'http://localhost/shop-teelab/giohang/check_quantity_cart',
                type: 'POST',
					 dataType: 'json', 
                data: {
                    quantity:quantity,
						  id:dataId,
                },
					 success: function (result) {
						console.log(result)
						const error = $(".quantity__error");
						if(result.mes){
							error.text(result.mes);
							toastr.warning(`${result.mes}`)
						}
						$(".input__quantity").val(result.quantity);
					},
					 error:function () {
						console.log("Lỗi")
					 }
            })
		})
	}
</script>
</html>
