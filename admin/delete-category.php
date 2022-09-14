<script src="http://localhost:86/project/admin/js/jquery.min.js"></script>
<?php 
include 'connect.php';
print_r($_GET);
if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(isset($_GET['status']) == 1){
		$img = mysqli_query($conn,"SELECT * FROM product WHERE category_id = $id");

		foreach ($img as $key => $value) {
			$id_pro = $value['id'];
			mysqli_query($conn,"DELETE FROM img_product WHERE id_product = $id_pro");
		}
		// mysqli_query($conn,"DELETE FROM img_product WHERE id_product")
		$query = mysqli_query($conn,"DELETE FROM product WHERE category_id = $id");

		mysqli_query($conn,"DELETE FROM category WHERE id = $id");

		var_dump("DELETE FROM product WHERE category_id = $id");
		// die();
		header('location: category.php');
		// die();
	} else {
			// kiểm tra xem có sản phẩm nào thuộc danh mục này ko 
		$check = mysqli_query($conn,"SELECT * FROM product WHERE category_id = $id");
		var_dump(mysqli_num_rows($check));
		if(mysqli_num_rows($check) != 0){
			echo '<script>
				let url = location.href;
				
				var test = confirm("Danh mục này đang có sản phẩm bạn có muốn xóa hết sp ko");
				if(test){
					location.href =url+"&status=1"
				} else{
						location.href = "http://localhost:86/project/admin/category.php";
				}</script>';
			
		} else {
			// xóa sản phẩm
			$query = mysqli_query($conn,"DELETE FROM category WHERE id = $id");
			header('location: category.php');
		}
	}
	
	
}
?>