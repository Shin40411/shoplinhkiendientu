<?php
require_once ('../../../db/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id_admin'])) {
					$id_admin = $_POST['id_admin'];

					$sql = 'delete from admin where id_admin = '.$id_admin;
					execute($sql);
				}
				break;
		}
	}
}