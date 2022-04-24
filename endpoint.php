<?php 
	require_once plugin_dir_path( __FILE__ ) . '/function.php';

	header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Max-Age: 1000');
	header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
	header('Content-Type: application/json');

	$method = $_SERVER['REQUEST_METHOD'];
	$response = false;
	if ($method == "GET") {
		$pages = isset($_GET["pages"]) ? $_GET["pages"] : 1;
		$per_page = isset($_GET["per_page"]) ? $_GET["per_page"] : 1;
		$response = belajar_api_plugin_get($pages,$per_page);
	}elseif ($method == "POST") {
		$judul = $_POST["judul"];
		$deskripsi = $_POST["deskripsi"];
		$response = belajar_api_plugin_post($judul,$deskripsi);
	}elseif ($method == "PUT") {
		parse_str(file_get_contents("php://input"),$request);
		$id = $request["id"];
		$judul = $request["judul"];
		$deskripsi = $request["deskripsi"];
		$response = belajar_api_plugin_put($id,$judul,$deskripsi);

	}elseif ($method == "DELETE") {
		parse_str(file_get_contents("php://input"),$request);
		$id = $request["id"];
		$response = belajar_api_plugin_delete($id);
	}
	echo json_encode($response);