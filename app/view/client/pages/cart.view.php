<!-- cart -->
<div class="cart">
	<div class="container">
		<div class="cart__container">
			<h3 class="cart__title">Giỏ hàng của bạn</h3>
			<span class='order-success'><?php echo isset($_GET['valid'])? "Bạn đặt hàng thành công"."<a href='".ROOT."checkOrder'>kiểm tra đơn hàng</a>" : "" ?></span>
			<style>
				.order-success{
					display: block;
					text-align: center;
					font-size: 16px;
					color: #70e000;
					margin-bottom: 20px;
				}
				.order-success a {
					display: inline-block;
					margin-left: 5px;
					transition: all 0.3s linear;
				}
				.order-success a:hover {
					color: red;
				}
			</style>
			<div class="cart__wrapper">
				<div class="cart__header">
					<div>Thông tin sản phẩm</div>
					<div>Đơn giá</div>
					<div>Số lượng</div>
					<div>Thành tiền</div>
				</div>
				<?php $carts = getSession("carts");
				?>
				<?php if(is_array($carts) && !empty($carts)):?>
				<div class="cart__body">
				<?php foreach($carts as $cart) :?>
						<div class="cart__row">
							<div class="cart__info">
								<a
								href="<?php echo ROOT."sanpham/chitiet/".$cart['id'] ?>"
								class="cart__info--img"
								>
								<img
								src="<?php echo ASSET."uploads/product/".$cart['img'] ?>"
								alt=""
								/>
							</a>
							<div class="cart__info--name">
								<a href="<?php echo ROOT."sanpham/chitiet/".$cart['id']?>"
								><?php echo $cart['name'] ?></a
								>
								<span> Xám / M</span>
								<a href="<?php echo ROOT."giohang/remove_cart/".$cart['id'] ?>" class="cart__info--remove">Xoá</a>
							</div>
						</div>
						<?php $price = $cart['price'] - ($cart['price'] * $cart['discount'] / 100) ?>
						<div class="cart__price">
							<span><?php echo number_format($price) ?>đ</span>
						</div>
						<div class="cart__quantity">
							<input type="text" value="<?php echo $cart['quantity'] ?>" name="<?php echo $cart['id'] ?>" class="cart__quantity--input">
							<div class="cart__price">
								<span><?php echo number_format($price) ?>đ</span>
							</div>
						
						</div>
						<div class="cart__total">
							<span data-price=<?php echo $price?> data-id=<?php echo $cart['id']?>><?php echo number_format($price * $cart['quantity']) ?>đ</span>
						</div>
					</div>	
				<?php endforeach; ?>
				</div>	
			<?php else: ?>
				<?php echo "<div style='padding: 20px 10px; display:flex;align-items:center;justify-content:space-between; flex-direction:column'>
				<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' style='display:inline-block; width: 100px; height: 100px'>
				<path stroke-linecap='round' stroke-linejoin='round' d='M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z' />
				</svg>
				<p style='font-size:14px; text-align:center; margin: 20px 0'>Không có sản phẩm nào trong giỏ hàng của bạn</p> 
				</div>"?>
			<?php endif; ?>
		</div>
</div>
</div>
<?php if(is_array($carts) && !empty($carts)):?>
			<div class="container">
			<div class="cart__bottom">
			<div class="cart__price--total">
				<p>Tổng tiền :</p>
				<span class="total-price"><?php echo number_format(cartTotalPrice()) ?>đ</span>
			</div>
			<a href="<?php echo ROOT."checkout"?>" class="cart__checkout">
				<button type="button">Thanh toán</button>
			</a>		
		</div>
			</div>
	<?php endif; ?>
</div>
</div>
</div>
<script>
	function formatCurrency(number) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number).replace('.', ',');	
	}	
	$(".cart__quantity--input").blur("input", function() {
		let input = $(this);
    	const quantity = input.val();
		 let id = input.attr('name')
		$.ajax({
			url: 'http://localhost/shop-teelab/giohang/add_cart_with_ajax',
			type: 'POST',
			dataType: 'json', 
			data: {
				quantity:quantity,
				id:id,
			},
			success: function (result) {
				console.log(result)
				if(result.mes){
					toastr.warning(`${result.mes}`)
					$(".cart__quantity--input").val(result.quantity)
				}else {
					const quantity = result.quantity;
					const total = result.total;
					const totalQuantity = result.totalQuantity;
					$(".total-price").text(formatCurrency(total))
					$('.topbar__cart--number').text(totalQuantity)
					$('.cart__total span').each(function() {
						let price = parseInt($(this).data('price'));
						let quantity = parseInt($(this).closest('.cart__row').find('.cart__quantity--input').val());
						$(this).closest('.cart__row').find('.cart__quantity--input').val = quantity;
						let totalPrice = price * quantity;
						$(this).text(formatCurrency(totalPrice));
					})
				}
			},
			error:function () {
			console.log("Lỗi")
			}
		})
	});
</script>