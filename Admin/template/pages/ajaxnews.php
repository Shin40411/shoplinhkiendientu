<?php
require_once ('../../../db/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id_baiviet'])) {
					$id = $_POST['id_baiviet'];

					$sql = 'delete from news where id_baiviet = '.$id;
					execute($sql);
				}
				break;
		}
	}
}