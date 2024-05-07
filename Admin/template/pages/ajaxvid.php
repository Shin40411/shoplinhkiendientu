<?php
require_once ('../../../db/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id_vid'])) {
					$id = $_POST['id_vid'];

					$sql = 'delete from videoqc where id_vid = '.$id;
					execute($sql);
				}
				break;
		}
	}
}