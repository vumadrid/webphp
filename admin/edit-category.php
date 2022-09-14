<?php 
	include 'layouts/header.php';
	// lấy về tất cả bản ghi của category 

  $category = mysqli_query($conn,"SELECT * FROM category");
  // lấy về danh mục  theo id để hiển thị form
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $cate = mysqli_query($conn,"SELECT * FROM category WHERE id = $id");
    $cate = mysqli_fetch_assoc($cate);
  }


  $error = [];

 
  // thêm mới
  if(isset($_POST['name'])){
    $name = $_POST['name'];
    $status = $_POST['status'];

    if($name == ''){
        $error['name'] = 'Tên không được để rỗng';
    }
    // kiểm tra tên đã tồn tài hay chưa
    $check_name = mysqli_query($conn,"SELECT * FROM category WHERE name = '$name' AND id != $id");

    if(mysqli_num_rows($check_name) == 1){
        $error['name'] = "$name tồn tại";
    }
   
    if(empty($error)){
      $query = mysqli_query($conn,"UPDATE category SET name = '$name',status = $status WHERE id = $id");

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
            <form action="" method="POST" role="form">
              <legend>Form thêm mới danh mục</legend>
            
              <div class="form-group <?php echo (!empty($error)) ? "has-error" : "" ?>">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" id="" name="name" value="<?=$cate['name']?>">
                <?php if(!empty($error)) {?>
                  <span class="help-block"><?php echo $error['name'] ?></span>
                <?php } ?>
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
                <?php foreach ($category as $key => $value) :?>
                  <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['status'] ?></td>
                    <td>
                      <a href="category.php?id=<?php echo $value['id'] ?>" class="btn btn-success">Edit</a>
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