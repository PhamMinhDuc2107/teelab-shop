<div class="d-flex align-items-center justify-content-center flex-column">
   <h1 class="forbidden-title">403!</h1>
   <p class="forbidden-desc">Unfortunately,you do not have permission to view this page</p>
   <a href="<?php echo ROOT."cpanel"?>" class="forbidden-btn">Back to Dashboard</a>
</div>
<style>
   .forbidden-title {
      font-size: 100px;
   }
   .forbidden-desc {
      font-size: 14px;
      margin: 10px 0;
   }
   .forbidden-btn {
      padding: 15px 30px;
      display: inline-block;
      background-color: red;
      color: white;
      border-radius: 10px;
      margin-top: 20px;
      border: 1px solid transparent;
      transition: all 0.3s linear;
      text-decoration: none;
   }
   .forbidden-btn:hover {
      background-color: #fff;
      border-color: red;
      color: red;
   }
</style>