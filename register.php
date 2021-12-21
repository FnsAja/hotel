<?php
	
include 'koneksi.php';
	
class user{}
	
$fullname = $_POST["fullname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if ((empty($username)) || (empty($fullname)) || (empty($password)) || (empty($email))) {
	$response = new user();
	$response->success = 0;
	$response->message = "Field tidak boleh kosong";
	die(json_encode($response));
} else if ((empty($confirm_password)) || $password != $confirm_password) {
	$response = new user();
	$response->success = 0;
    $response->message = "Konfirmasi password harus sama";
	die(json_encode($response));
} else {
	if (!empty($username) && $password == $confirm_password){
		$num_rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE username='".$username."'"));

        if ($num_rows == 0){
		$query = mysqli_query($con, "INSERT INTO users (id, fullname, username, password, email) VALUES(NULL, '".$fullname."', '".$username."','".$password."', '".$email."')");
			if ($query){
				$response = new user();
				$response->success = 1;
				$response->message = "Register berhasil";
				die(json_encode($response));
			}
		} else {
			$response = new user();
			$response->success = 0;
			$response->message = "Username sudah terdaftar";
			die(json_encode($response));
		}
	}
}

mysqli_close($con);

?>