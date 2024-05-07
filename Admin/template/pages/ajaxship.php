<?php
require_once ('../../../db/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id_shipping'])) {
					$id = $_POST['id_shipping'];

					$sql = 'delete from shipping where id_shipping = '.$id;
					execute($sql);
				}
				break;
		}
	}
}