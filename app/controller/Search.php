<?php
class Search extends Controller 
{
   private $ProductModel;
   private $CategoriesModel;
   public function __construct()
   {
      $this->ProductModel = $this->model("ProductModel");
      $this->CategoriesModel = $this->model("CategoriesModel");
      if(isset($_GET['page']))
      {
         $this->ProductModel->offset = (esc($_GET['page']) - 1) * $this->ProductModel->limit;
      }
   }
   public function index()
   {
      $search = isset($_GET["search"]) ? $_GET["search"] :"";
      $categories = $this->CategoriesModel->findAll();
      $count = $this->ProductModel->getSearchTotalRecords(['name'],$search);
      $count = $count[0]->{"count(*)"};
      $result = $this->ProductModel->getDataSearch(['name'], $search);
      $pagination =ceil($count/ $this->ProductModel->limit);
      $categories_actives = $this->CategoriesModel->where(['status'=> 1]);
      $this->view(
         'client/layout', 
         [
            "title"=>"$search - Tìm kiếm",
            "page" => "search",
            "dataCategories"=>$categories,
            "result" => $result,
            "pagination" => $pagination,
            "count" => $count,
            "search" => $search,
            "categories_actives" => $categories_actives
         ]
      );
   }
}

?>