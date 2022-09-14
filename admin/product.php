<?php 
	include 'layouts/header.php';
	// lấy về tất cả bản ghi của sản phẩm

  $products = mysqli_query($conn,"SELECT product.*,category.name as 'cate_name' FROM product JOIN category ON product.category_id = category.id");

  $total_r = mysqli_num_rows($products);
  $limit = 4;
  $total_page = ceil($total_r/$limit);
  $c_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = $c_page * $limit - $limit;
  // truy vấn phân trang
  $products = mysqli_query($conn,"SELECT product.*,category.name as 'cate_name' FROM product JOIN category ON product.category_id = category.id LIMIT $start,$limit");

  // tìm kiếm 
  // SELECT * FROM `product` WHERE name LIKE '%12%'
  if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $products = mysqli_query($conn,"SELECT product.*,category.name as 'cate_name' FROM product JOIN category ON product.category_id = category.id WHERE product.name LIKE '%$keyword%'");
    $total_r = mysqli_num_rows($products);
    $total_page = ceil($total_r/$limit);
    $products = mysqli_query($conn,"SELECT product.*,category.name as 'cate_name' FROM product JOIN category ON product.category_id = category.id WHERE product.name LIKE '%$keyword%'LIMIT $start,$limit ");
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
        Danh sách sản phẩm
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

          <h3 class="box-title">
            <form action="" method="GET" class="form-inline" role="form">
             <div class="input-group input-group-sm hidden-xs">
              <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
              </div>
          </h3>

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
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Giá</th>
                  <th>Giá Khuyến mãi</th>
                  <th>Tên danh mục</th>
                  <th>Số lượng</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($products as $key => $value) :?>
                  <tr>
                    <td><?php echo $key+$start+1 ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td><img src="../uploads/<?=$value['image']?>" alt="" width="100px"></td>
                     <td><?php echo $value['price'] ?></td>
                     <td><?php echo $value['sale_price'] ?></td>
                     <td><?php echo $value['cate_name'] ?></td>
                     <td><?php echo $value['quantity'] ?></td>
                    <td>
                      <a href="edit-category.php?id=<?php echo $value['id'] ?>" class="btn btn-success">Edit</a>
                      <a onclick="return confirm('Bạn muốn xóa ko')" href="delete-product.php?id=<?php echo $value['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="#">«</a></li>
            <?php for ($i=1; $i <=$total_page; $i++) : ?>
              
                  <?php if(isset($keyword)) {?>
                    <li class="<?php echo ($i == $c_page) ?'active' : ''?>"><a href="?keyword=<?php echo $keyword ?>&?page=<?=$i ?>"><?php echo $i ?></a></li>
                  <?php }else {?>
                    <li class="<?php echo ($i == $c_page) ?'active' : ''?>"><a href="?page=<?=$i ?>"><?php echo $i ?></a></li>
                  <?php } ?>
            <?php endfor ?>
            <?php if($c_page < $total_page) {?>
              <li><a href="?page=<?php echo $c_page + 1 ?>">»</a></li>
            <?php } ?>
          </ul>
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