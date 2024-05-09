<?php
require_once('../../../config/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id'])) {
					$id = $_POST['id'];
					$checkforeingkey = 'select * from product where id_category = ' . $id;
					$product = executeSingleResult($checkforeingkey);
					if ($product == null) {
						$sql = 'delete from category where id = ' . $id;
						execute($sql);
						echo json_encode(['success' => true]);
					}else{
						echo json_encode(['success' => false, 'message' => 'Không thể xóa danh mục với các sản phẩm được liên kết.']);
					}
				}
				break;
		}
	}
}
?>