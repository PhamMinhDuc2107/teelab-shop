<section class="notfound">
	<h1 class="notfound__title">404</h1>
	<p class="notfound__subtitle">
		Không tìm thấy nội dung 😓
	</p>
	<p class="notfound__desc">
		URL của nội dung này đã bị thay đổi hoặc không còn tồn tại.
	</p>
	<p class="notfound__desc">
		Nếu bạn đang lưu URL này, hãy thử truy cập lại từ trang chủ thay vì dùng URL đã lưu.
	</p>
	<a href="<?php echo ROOT ?>" class="notfound__btn">Quay về trang chủ</a>
</section>
<style>
	.notfound {
		padding: 130px 20px;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
	}
	.notfound__title {
		font-size: 150px;
		height: 200px;
		font-weight: bold;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.notfound__subtitle {
		font-size: 45px;
		font-weight: bold;
		margin: 20px 0;
	}
	.notfound__desc {
		line-height: 1.5;
		display: inline-block;
		font-size: 16px;
		padding: 5px 0;
	}
	.notfound__btn {
		display: inline-block;
		padding: 20px;
		border-radius: 10px;
		background-color: #ccc;
		border: none;
		margin-top: 30px;
		font-size: 16px;
		cursor: pointer;
	}
</style>

