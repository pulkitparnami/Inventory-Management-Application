<?php
class PageAttr{
	   public $site_title,
		         $description,
		         $body_class;

    public function __construct(){
      if(user_loggedin()){
        $this->body_class = 'logged-in ';
      }
    }

    private function attributes($site_title,$body_class,$description){
      $this->site_title  = $site_title;
      $this->body_class .= $body_class;
      $this->description = $description;
    }

    public function index(){
    	$this->attributes('Website','home','This is Home page.');
    }

    public function register(){
      $this->attributes('Register','register','User registration page.');
    }

    public function add_product(){
      $this->attributes('Website','admin-add-product','Website Page');
    }

    public function inventory(){
      $this->attributes('Website','admin-inventory','Website Page');
    }

    public function product(){
      global $product;
      $this->attributes($product->get_prod_code(),'single-product-page product-'.$product->get_id(),'Product page');
    }

    public function edit_product(){
      global $product;
      $this->attributes('Edit Product '.$product->get_prod_code(),'edit-product-page edit-product-'.$product->get_id(),'Product edit page');
    }

    public function changelog_product(){
      global $inventory;
      $this->attributes('ChangeLog | '.$inventory->get_prod_code(),'changelog-product','Product changelog page.');
    }

    public function changelog(){
      $this->attributes('Changelog','changelog','Website Page');
    }
    public function media_upload(){
      $this->attributes('Upload','upload-media-page','Page');
    }

    public function edit_user(){
      $this->attributes('','edit-user-page','');
    }

    public function users_list(){
      $this->attributes('Users list','users-list-page','');
    }

    public function single_user(){
      $this->attributes('Customer','single-user-page','');
    }

    public function my_orders(){
      $this->attributes('My Orders','my-orders-page','My Orders');
    }

    public function add_order(){
      $this->attributes('Add Order','add-order-page','Add new order');
    }

    public function edit_order(){
      $this->attributes('Edit Order','edit-order-page','Add new order');
    }

    public function order_list(){
      $this->attributes('Orders','order-list-page','Customers order');
    }

    public function add_vendor(){
      $this->attributes('','add-vendor','');
    }

    public function edit_vendor(){
      $this->attributes('','edit-vendor','');
    }

}


?>