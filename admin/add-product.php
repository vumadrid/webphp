<?php 
	include 'layouts/header.php';
	// lấy về tất cả bản ghi của category 

  $category = mysqli_query($conn,"SELECT * FROM category");
  
 
  // thêm mới
  if(isset($_POST['name'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $category_id = $_POST['category_id'];
    $desscription = $_POST['desscription'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    // xử lý up ảnh đại diện

    if(isset($_FILES['file'])){
      $file_name = $_FILES['file']['name'];
      $tmp_name = $_FILES['file']['tmp_name'];
      move_uploaded_file($tmp_name,'../uploads/'.$file_name);
    } 


    $sql = "INSERT INTO `product` (`name`, `price`, `sale_price`, `image`, `category_id`, `quantity`, `desscription`, `status`) VALUES ('$name', '$price', '$sale_price', '$file_name', '$category_id', '$quantity', '$desscription', $status)";

    $query = mysqli_query($conn,$sql);

    // lấy id của bản ghi truy vất ở dong 29
    $id_product = mysqli_insert_id($conn);
    
    // xử lý up load nhiều ảnh
  
   // print_r($_FILES['files']);
    foreach ($_FILES['files']['name'] as $key => $name) {   
      $tmp_name =  $_FILES['files']['tmp_name'][$key];
      move_uploaded_file($tmp_name,'../uploads/'.$name);
      // lưu ảnh mô tả vào bảng img_product
      mysqli_query($conn,"INSERT INTO img_product(image,id_product) VALUES('$name',$id_product)");
    }
  
    
  }



 ?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
 <?php include 'layouts/sidebar.php' ?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý sản phẩm
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <div class="col-md-12">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
              <legend>Form thêm mới sản phẩm</legend>
            
              <div class="form-group ">
                <label for="">Tên sản phẩm</label>
                <input type="text" class="form-control" id="" name="name" value="">
                
              </div>
              <div class="form-group ">
                <label for="">Giá sản phẩm</label>
                <input type="text" class="form-control" id="" name="price" value="">
                
              </div>
              <div class="form-group ">
                <label for="">Giá Khuyến mãi</label>
                <input type="text" class="form-control" id="" name="sale_price" value="">
                
              </div>
               <div class="form-group ">
                <label for="">Số lượng sản phẩm</label>
                <input type="text" class="form-control" id="" name="quantity" value="1">
                
              </div>
               <div class="form-group ">
                <label for="">Ảnh đại diện</label>
                <input type="file" class="form-control" id="" name="file" value="">
              </div>
              <div class="form-group ">
                <label for="">Ảnh mô tả</label>
                <input type="file" class="form-control" id="" name="files[]" value="" multiple>
              </div>
              <div class="form-group ">
                <label for="">Danh mục</label>
               <select name="category_id" id="input" class="form-control" required="required">
                <?php foreach ($category as $key => $value) : ?>
                 <option value="<?=$value['id']?>"><?php echo $value['name'] ?></option>
               <?php endforeach ?>
               </select>
              </div>
              <div class="form-group ">
                <label for="">Mô tả</label>
                <textarea name="desscription" id="input" class="form-control" rows="3" required="required"></textarea>
              </div>
               <div class="form-group">
                <label for="">Trạng thái</label>
               <div class="radio">
                 <label>
                   <input type="radio" name="status" id="input" value="0">
                   Ẩn
                 </label>
                 <label>
                   <input type="radio" name="status" id="input" value="1" checked="checked">
                   Hiện
                 </label>
               </div>
              </div>
            
              <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
          </div>
         
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
 	include 'layouts/footer.php';
  ?>