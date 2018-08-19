<?php

error_reporting(E_ALL);

function dd($data, $die = false) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';

	if ($die) {
		die;
	}
}

function view($name, $data = []) {
	extract($data);

	return require "app/views/$name.view.php";
}