<?php

class Users{
	public function __construct($conn)
	{
		$this->conn=$conn;
	}
	public function isLogin($userName,$password)
	{
		$password1 = md5($password);
		$sql = "SELECT * FROM users WHERE userName = '$userName' AND password = '$password1'";
		$result = $this->conn->query($sql);
		if ($result->num_rows == 0)
			return false;
		else
			return true;
	}
	public function checkUsername($userName){
		$query2 = "SELECT userName from users where userName = '$userName'";
		$result2= $this->conn->query($query2);
		if($result2->num_rows === 0)
		{
			return 1;
		}
		else{
			return -1;
		}
	}
}
?>