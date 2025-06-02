<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'mahi');

class DB_con
{
	public $connection;
	function __construct()
	{
		$this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);
	}

	function ret_obj()
	{
		return $this->connection;
	}
}



class User
{
	protected $db;
	public function __construct()
	{
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}

	/*** for registration process ***/
	public function reg_user($name, $username, $password, $email)
	{
		//echo "k";

		$password = md5($password);

		//checking if the username or email is available in db
		$query = "SELECT * FROM user WHERE uname='$username' OR uemail='$email'";

		$result = $this->db->query($query) or die($this->db->error);

		$count_row = $result->num_rows;

		//if the username is not in db then insert to the table

		if ($count_row == 0) {
			$query = "INSERT INTO user SET uname='$username', upass='$password', fullname='$name', uemail='$email'";

			$result = $this->db->query($query) or die($this->db->error);

			return true;
		} else {
			return false;
		}
	}

	/*** for login process ***/
	public function check_login($emailusername, $password)
	{
		$password = md5($password);

		$query = "SELECT id from user WHERE email='$emailusername' and pass='$password' and status='1'";
		$result = $this->db->query($query) or die($this->db->error);

		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
			$_SESSION['login'] = true; // this login var will use for the session thing
			$_SESSION['id'] = $user_data['id'];
			return true;
		} else {
			return false;
		}
	}

	public function get_fullname($id)
	{
		$query = "SELECT * FROM user WHERE id = $id";

		$result = $this->db->query($query) or die($this->db->error);

		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		echo $user_data['fname'] . ' ' . $user_data['lname'];
	}

	/*** starting the session ***/
	public function get_session()
	{
		return $_SESSION['login'];
	}

	public function user_logout()
	{
		$_SESSION['login'] = FALSE;
		unset($_SESSION);
		session_destroy();
	}

	//Data particular one record read Function while login
	public function getonerecord($id)
	{
		$get_data = mysqli_query($this->db, "SELECT * FROM user WHERE id = $id");
		return $get_data;
	}
}
