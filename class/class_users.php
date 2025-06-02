
<?php

require_once "db_config.php";

class DB_user
{
	// DB Construct Function
	function __construct(){
		$conn = mysqli_connect(db_host,db_user,db_pass,db_name);
		$this->dbs = $conn;

		if(mysqli_connect_errno()){
			echo "Error connecting DB". mysqli_connect_errno();
		}		
	}

	//Data Insertion Function
	public function insert($fname, $lname, $fullname, $emp_id, $pass, $email, $phone, $address, $pan_no, $role, $status){

		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM user WHERE email= '".$email."'");
		$count_row = $check_data->num_rows; //check no of rows

		$fname = $this->dbs->real_escape_string($fname);
		$lname = $this->dbs->real_escape_string($lname);
		$fullname = $this->dbs->real_escape_string($fullname);
		$email = $this->dbs->real_escape_string($email);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		
		if($count_row == 0){				
			$insert_data = mysqli_query($this->dbs, "INSERT INTO user(fname,lname,fullname,pass,email,phone,address,pan_no,role,status)VALUES('$fname','$lname','$fullname','$pass','$email','$phone','$address','$pan_no','$role','$status')");
			//return $insert_data;

			$last_id = mysqli_insert_id($this->dbs);
			$year1 = date('y');
			str_pad($value, 8, '0', STR_PAD_LEFT);

			if($insert_data == true){				
				$insert_data1 = mysqli_query($this->dbs,"UPDATE user SET emp_id='E-010".$last_id."' WHERE id = '$last_id'");		

				return $insert_data1;
			}
		}
		else		{
			//echo "Email already exist. &nbsp;";
		}
	}

	//Data updation Function
	public function update($id, $fname, $lname, $fullname, $phone, $address, $pan_no, $role, $status){

		$fname = $this->dbs->real_escape_string($fname);
		$lname = $this->dbs->real_escape_string($lname);
		$fullname = $this->dbs->real_escape_string($fullname);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		
		$update_data = mysqli_query($this->dbs, "UPDATE user SET fname='$fname', lname='$lname', fullname='$fullname', phone='$phone', address='$address', pan_no='$pan_no', role='$role', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data updation Function
	public function update_profile($id, $fname, $lname, $phone, $address, $profile_image){

		$fname = $this->dbs->real_escape_string($fname);
		$lname = $this->dbs->real_escape_string($lname);
		$fullname = $this->dbs->real_escape_string($fullname);
		$phone = $this->dbs->real_escape_string($phone);
		$address = $this->dbs->real_escape_string($address);
		
		$update_data = mysqli_query($this->dbs, "UPDATE user SET fname='$fname', lname='$lname', phone='$phone', address='$address', profile_image='$profile_image' WHERE id='$id'");
		return $update_data;
	}

	//Data password code updation Function
	public function update_pass_code($email, $code){		
		
		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM user WHERE email= '$email'");
		$count_row = $check_data->num_rows;

		if($count_row >0){
			$update_data = mysqli_query($this->dbs, "UPDATE user SET code='$code' WHERE email='$email'");
			return $update_data;
		}
	}

	//Data password updation with code Function
	public function update_pass_otp($code, $pass){		
		
		// check email duplicates entry
		$check_data = mysqli_query($this->dbs, "SELECT * FROM user WHERE code= '$code'");
		$count_row = $check_data->num_rows;

		if($count_row >0){
			$update_data = mysqli_query($this->dbs, "UPDATE user SET pass='$pass' WHERE code='$code'");
			return $update_data;
		}
	}
	
	//Data password updation Function
	public function update_profile_pass($id, $pass){		
		
		$update_data = mysqli_query($this->dbs, "UPDATE user SET pass='$pass' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id){
		$delete_data = mysqli_query($this->dbs, "DELETE FROM user WHERE id=$id");
		return $delete_data;
	}

	//user List View function
	public function list_user(){
		$list_user = mysqli_query($this->dbs, "SELECT * FROM user");
		return $list_user;
	}

	//user List View except admin function
	public function list_user_only(){
		$list_user = mysqli_query($this->dbs, "SELECT * FROM user WHERE id!=1");
		return $list_user;
	}
	

	//user List View with status function
	public function list_user_status(){
		$list_user = mysqli_query($this->dbs, "SELECT * FROM user WHERE id!=1 AND status = 1");
		return $list_user;
	}
	

	//Data particular one record read Function while update - user
	public function get_one_user($id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM user WHERE id=$id");
		return $get_data;
	}

	//Data particular one record read Function while update - company
	public function get_emp_id_user($emp_id){
		$get_data = mysqli_query($this->dbs, "SELECT * FROM user WHERE id=$emp_id");
		return $get_data;
	}	

	
}

?>