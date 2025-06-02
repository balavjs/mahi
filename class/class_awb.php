
<?php

require_once "db_config.php";

class DB_awb
{
	// DB Construct Function
	function __construct()
	{
		$conn = mysqli_connect(db_host, db_user, db_pass, db_name);
		$this->dbs = $conn;

		if (mysqli_connect_errno()) {
			echo "Error connecting DB" . mysqli_connect_errno();
		}
	}

	//Data Insertion Function
	public function insert($awb_no, $bdate, $year, $consignor, $source, $cphone, $sgst, $consignee, $destination, $dphone, $dgst, $type, $qty, $description, $inv_no, $value, $frieght, $loading, $others, $total, $status)
	{
		$consignor = $this->dbs->real_escape_string($consignor);
		$source = $this->dbs->real_escape_string($source);
		$consignee = $this->dbs->real_escape_string($consignee);
		$destination = $this->dbs->real_escape_string($destination);
		$description = $this->dbs->real_escape_string($description);
		$inv_no = $this->dbs->real_escape_string($inv_no);

		$insert_data = mysqli_query($this->dbs, "INSERT INTO awb(awb_no, bdate, year, consignor, source, cphone, sgst, consignee, destination, dphone, dgst, type, qty, description, inv_no, value, frieght, loading, others, total, status)VALUES('$awb_no', '$bdate', '$year', '$consignor', '$source', '$cphone', '$sgst', '$consignee', '$destination', '$dphone', '$dgst', '$type', '$qty', '$description', '$inv_no', '$value', '$frieght', '$loading', '$others', '$total', '$status')");

		return $insert_data;
	}

	//Data updation Function
	public function update($id, $bdate, $consignor, $source, $cphone, $sgst, $consignee, $destination, $dphone, $dgst, $type, $qty, $description, $inv_no, $value, $frieght, $loading, $others, $total, $status)
	{

		$consignor = $this->dbs->real_escape_string($consignor);
		$source = $this->dbs->real_escape_string($source);
		$consignee = $this->dbs->real_escape_string($consignee);
		$destination = $this->dbs->real_escape_string($destination);
		$description = $this->dbs->real_escape_string($description);
		$inv_no = $this->dbs->real_escape_string($inv_no);


		$update_data = mysqli_query($this->dbs, "UPDATE awb SET bdate='$bdate', consignor='$consignor', source='$source', cphone='$cphone', sgst='$sgst', consignee='$consignee', destination='$destination', dphone='$dphone', dgst='$dgst', type='$type', qty='$qty', description='$description', inv_no='$inv_no', value='$value', frieght='$frieght', loading='$loading', others='$others', total='$total', status='$status' WHERE id='$id'");
		return $update_data;
	}

	//Data Deletion function
	public function delete($id)
	{
		$delete_data = mysqli_query($this->dbs, "DELETE FROM awb WHERE id=$id");
		return $delete_data;
	}

	//awb List View function
	public function list_awb()
	{
		$list_awb = mysqli_query($this->dbs, "SELECT * FROM awb ORDER BY id DESC");
		return $list_awb;
	}

	//awb List View with status function
	public function list_awb_status()
	{
		$list_awb = mysqli_query($this->dbs, "SELECT * FROM awb WHERE id!=1 AND status = 1");
		return $list_awb;
	}

	//Data particular one record read Function while update - awb
	public function get_one_awb($id)
	{
		$get_data = mysqli_query($this->dbs, "SELECT * FROM awb WHERE id=$id");
		return $get_data;
	}

	public function list_awb_last($y1)
	{
		$list_awb = mysqli_query($this->dbs, "SELECT * FROM awb WHERE year='$y1' ORDER BY id DESC LIMIT 1");
		return $list_awb;
	}

	public function list_awb_last1()
	{
		$list_awb = mysqli_query($this->dbs, "SELECT * FROM awb ORDER BY id DESC LIMIT 1");
		return $list_awb;
	}

	public function list_awb_year($y1)
	{
		$list_awb = mysqli_query($this->dbs, "SELECT * FROM awb WHERE year='$y1'");
		return $list_awb;
	}

	public function list_awb_by_month_year($month, $year)
	{
		$month = (int)$month;
		$year = (int)$year;

		$list_awb = mysqli_query($this->dbs, "SELECT * FROM awb WHERE MONTH(bdate) = $month AND YEAR(bdate) = $year ORDER BY id DESC");
		return $list_awb;
	}

	public function list_awb_by_date($bdate)
	{
		$list_awb = mysqli_query($this->dbs, "SELECT * FROM awb WHERE bdate = '$bdate' ORDER BY id DESC");
		return $list_awb;
	}
}

?>