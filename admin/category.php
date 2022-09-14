<?php 
	include 'layouts/header.php';
	// lấy về tất cả bản ghi của category 

  $sql = "SELECT * FROM `menu_product` order by id ASC";
  $menu = mysqli_query($con,$sql);
  $menu_pro = mysqli_fetch_all($menu,MYSQLI_ASSOC);
  $error = [];

 
  // thêm mới
  if(isset($_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];

    var_dump($_FILES);
    if($name == ''){
        $error['name'] = 'Tên không được để rỗng';
    }
    // kiểm tra tên đã tồn tài hay chưa
    $check_name = mysqli_query($conn,"SELECT * FROM menu_product WHERE id = '$id'");

    if(mysqli_num_rows($check_id) == 1){
        $error['id'] = "$id tồn tại";
    }
   
    if(empty($error)){
      $query = mysqli_query($conn,"INSERT INTO menu_product (id,name) VALUES ('$id','$name')");

        if($query){
          // echo "Thêm mới thành công";
         echo "<script>
           location.href = 'category.php?trang-thai=1';
         </script>";
        } else{
           echo "<script>
              location.href = 'category.php?trang-thai=0';
            </script>";
        }
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
        Quản lý danh mục
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
          <?php if(isset($_GET['trang-thai'])) {?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo ($_GET['trang-thai']) ? "Thêm mới thành công" : "Thêm mới thất bại"; ?></strong> 
          </div>
         <?php } ?>
          <div class="col-md-6">
            <form action="" method="POST" role="form" enctype='multipart/form-data'>
              <legend>Form thêm mới danh mục</legend>
            
              <div class="form-group <?php echo (!empty($error)) ? "has-error" : "" ?>">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" id="" name="name">
                <?php if(!empty($error)) {?>
                  <span class="help-block"><?php echo $error['name'] ?></span>
                <?php } ?>
              </div>
              <input type="file" name="file[]" value="" multiple>
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
          <div class="col-md-6">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên danh mục</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($menu_pro as $key => $value) :?>
                  <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td>
                      <a href="edit-category.php?id=<?php echo $value['id'] ?>" class="btn btn-success">Edit</a>
                      <a href="delete-category.php?id=<?php echo $value['id'] ?>" class="btn btn-success">Delete</a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
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