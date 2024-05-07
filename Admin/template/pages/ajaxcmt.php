<?php
require_once ('../../../db/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id_comment'])) {
					$id = $_POST['id_comment'];

					$sql = 'delete from comment where id_comment = '.$id;
					execute($sql);
				}
				break;
		}
	}
}