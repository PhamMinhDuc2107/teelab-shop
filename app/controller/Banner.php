<?php 
class Banner extends Controller 
{
	private $BannerModel;
	private $AuthMiddleware;
	private $PermissionMiddleware;

	public function __construct() 
	{
		$this->AuthMiddleware = $this->middleware("AdminMiddleware");
		$this->AuthMiddleware->handle();
		$this->PermissionMiddleware = $this->middleware("PermissionMiddleware");
		$this->BannerModel = $this->model("BannerModel");
		
	}
	public function index()
	{
		$this->PermissionMiddleware->handle("banner");
		if(isset($_GET['page']) && $_GET['page'] !== "")
		{
			$this->BannerModel->offset = (esc($_GET['page']) - 1 ) * $this->BannerModel->limit;
		}
		if(isset($_GET['col']) && $_GET['col'] !== "") {
			$this->BannerModel->order_column =esc( $_GET['col']);
		}
		if(isset($_GET['order']) && $_GET['order'] !== "") {
			$this->BannerModel->order_type = esc($_GET['order']);
		}
		if(isset($_GET['q']) && $_GET['q'] !== "") 
		{
			$q = esc($_GET['q']);
			$col_name = ['title'];
			$banner = $this->BannerModel->getDataSearch($col_name, $q);

		}else 
		{
			$banner = $this->BannerModel->findAll();

		}
		$count = $this->BannerModel->getTotalRecords();
		$limit = $this->BannerModel->limit;
		$per_page = ceil($count/$limit);
		$this->view("cpanel/layout", [
			"title" => "List Banner - Dashboard",
			"page"=>"banner/index",
			"heading" => "Banner",
			"data"=>$banner,
			"pagination" => $per_page,
			"col" => $this->BannerModel->allowedColumns,
		]);
	}
	public function add_banner() 
	{
		$this->PermissionMiddleware->handle("banner/add_banner");

		if(!getSession("login")) {
			redirect("cpanel/login");
		}
		$this->view("cpanel/layout", [
			"title" => "Add Banner - Dashboard",
			"page"=>"banner/form_banner",
			"heading" => "Add New Banner",
			"action"=>"banner/add_banner_post",
		]);
	}	
	public function add_banner_post () 
	{
		if(isset($_POST['submit_category']))
		{
			$title = isset($_POST['title']) ? $_POST['title'] : "";
			$status = isset($_POST['status']) ? 1 : 0;
			$tmp_img = $_FILES["image"]['tmp_name'];
			$unique_img = unique_img("image");
			$path_upload = "assets/uploads/banner/".$unique_img;
			$data = ["title" => $title, "img" => $unique_img,"status" => $status];
			if($this->BannerModel->insert($data)) 
			{
				move_uploaded_file($tmp_img,$path_upload);
				$messager['mes'] = "Thêm banner thành công!";
				redirect('banner?msg='.urldecode(serialize($messager)));
			}else {
				$messager['mes'] = "Thêm banner không thành công!";
				redirect('banner?msg='.urldecode(serialize($messager)));
			}
		}
	}
	public function edit_banner($id) 
	{
		$this->PermissionMiddleware->handle("banner/edit_banner");

		$banner = $this->BannerModel->where(["id" => $id]);
		$this->view("cpanel/layout", [
			"title" => "Edit Banner - Dashboard",
			"page"=>"banner/form_banner",
			"heading" => "Edit Banner",
			"action"=>"banner/edit_banner_post/$id",
			"data" => $banner,
		]);
	}	
	public function edit_banner_post ($id) 
	{
		if(isset($_POST))
		{
			$record = $this->BannerModel->where(["id" => $id]);
			$title = isset($_POST['title']) ? $_POST['title'] : "";
			$status = isset($_POST['status']) ? 1 : 0;
			$file = isset($_FILES["image"]) ? $_FILES['image'] : "";
			$file_tmp = $file["tmp_name"];
			$path = "assets/uploads/banner/";
			$data = ["title" => $title, "status" => $status];
			if(!empty($file_tmp)) 
			{
				if(file_exists($path.$record[0]->img))
				{
					delete_img("banner/".$record[0]->img);
				}
				$unique_img = unique_img("image");
				$path_upload = $path.$unique_img;
				$data = ["title" => $title,"img" => $unique_img, "status" => $status];
				if($this->BannerModel->update($id, $data)) { 
					move_uploaded_file($file_tmp,$path_upload);
					$messager['mes'] = "Sửa banner thành công!";
					redirect('banner?msg='.urldecode(serialize($messager)));
				}else {
					$messager['mes'] = "Sửa banner không thành công!";
					redirect('banner?msg='.urldecode(serialize($messager)));
				}
			}else 
			{
				if($this->BannerModel->update($id, $data)) { 
					$messager['mes'] = "Sưa banner thành công!";
					redirect('banner?msg='.urldecode(serialize($messager)));
				}else {
					$messager['mes'] = "Sửa banner không thành công!";
					redirect('banner?msg='.urldecode(serialize($messager)));
				}
			}
		}
	}
	public function delete_banner ($id) 
	{
		$this->PermissionMiddleware->handle("banner/delete_banner");

		$record= $this->BannerModel->where(["id"=> $id]);
		if($record[0])
		{
			$path = "banner/".$record[0]->img;
			if(file_exists("assets/uploads/$path"))
			{
				delete_img($path);
			}
			if(	$this->BannerModel->delete($id)) { 
				$messager['mes'] = "Xoá banner thành công!";
				redirect('banner?msg='.urldecode(serialize($messager)));
			}else {
				$messager['mes'] = "Xoá banner không thành công!";
				redirect('banner?msg='.urldecode(serialize($messager)));
			}
		}
	}
}
?>