<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $data['title'] ? $data['title'] : "Admin - Dashboard" ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo ROOT ?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo ROOT ?>assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="<?php echo ROOT ?>assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once  './app/view/cpanel/blocks/sidebar.view.php';?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
               <?php require_once  './app/view/cpanel/blocks/header.view.php';?>

               <!-- Begin Page Content -->
               <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"><?php echo $data['heading'] ? $data['heading'] : "" ?></h1>
                </div>
                <?php if(isset($data['pagination']))
                    require_once  "./app/view/cpanel/blocks/sortbar.view.php";
                ?>
                <?php if(isset($data['page'])) {
                    require_once  "./app/view/cpanel/pages/$data[page].view.php";
                }?>
                <?php if(isset($data['pagination']))
                    require_once  "./app/view/cpanel/blocks/pagination.view.php";
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo ROOT ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo ROOT ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo ROOT ?>assets/admin/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo ROOT ?>assets/admin/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?php echo ROOT ?>assets/admin/js/demo/chart-area-demo.js"></script>
<script src="<?php echo ROOT ?>assets/admin/js/demo/chart-pie-demo.js"></script>
<script>
    const sort = document.querySelector(".sortBar-select");
   if(sort)
   {
    sort.addEventListener("change", handlerOnchange);
    function handlerOnchange(e) {
        const order = e.target.value;
        updateURL(order);
    }
   }
    const page = document.querySelector(".pagination")
    if(page)
    {
        page.addEventListener("click", function(e) {
        let page = +e.target.dataset.id;
        updateURL(undefined,undefined,page);
        })
    }
    function updateURL(order, col, page) {
        const url = new URL(window.location.href);

        if (order !== undefined) {
            url.searchParams.set('order', order);
        }
        if(page !== undefined) {
            url.searchParams.set('page', page);
        } 
        window.location.href = url;
    }
</script>
</body>

</html>