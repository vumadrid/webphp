<?php 

include 'connect.php';

if(isset($_GET['id'])){
	$id = $_GET['id'];
	// xóa ảnh phụ 
	mysqli_query($conn,"DELETE FROM img_product WHERE id_product = $id");
	// xóa sản phẩm
	$query = mysqli_query($conn,"DELETE FROM product WHERE id = $id");
	
	if($query){
		header('location: product.php');
	}

}