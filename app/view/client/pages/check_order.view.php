 <!-- main -->
 <div class="checkOrder">
   <div class="container">
      <div class="checkOrder__container">
         <form class="search__box" action="<?php echo ROOT.$data['action']?>">
            <div class="search__box--title">
               <i class="fa fa-search"></i>
               <span>Kiểm tra đơn hàng của bạn</span>
            </div>
            <p class="search__box--text">Kiểm tra bằng</p>
            <div class="search__box--group">
               <div class="group__input">
                  <input type="radio" id="madonhang" value='madonhang' name="check_order" checked/>
                  <label for="madonhang">Mã đơn hàng</label>
               </div>
            </div>
            <input
            type="text"
            class="search__box--input"
            name="search_value"
            placeholder="Mã đơn hàng"
            />
            <button type="submit" class="search__box--btn">Kiểm tra</button>
         </form>
        <div class="checkOrder__tab" >
        
        </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function () {
        // Bắt sự kiện submit của form
         $(".search__box").submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'), 
                data: $(this).serialize(), 
                success: function (response) {
                   $('.checkOrder__tab').html(response)
                },
                error: function () {
                    console.log("Error");
                }
            });
        });
        $(".order-detail").on("click",function (event) {
         console.log("1")
         let order_id = $(this).data("id");

            $.ajax({
                type: "POST",
                url: "http://localhost/shop-teelab/checkOrder/detail", 
                data: {
                  id:order_id,
                }, 
                success: function (response) {
                  console.log(response);
                   $('.checkOrder__tab').html(response)
                },
                error: function () {
                    console.log("Error");
                }
            });
        });
    });
</script>
         <!-- main -->