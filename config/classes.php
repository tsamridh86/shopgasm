<?php
class Users{
	public function __construct($conn)
	{
		$this->conn=$conn;
	}
	public function isLogin($userName,$password)
	{
		if($userName == "admin" && $password == "admin")
		{
			$_SESSION['admin']=$userName;
			header("location:admin");
		}
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
		if($result2->num_rows == 0)
		{
			return 1;
		}
		else{
			return -1;
		}
	}
	public function isSignUp($firstName, $lastName,$userName,$password,$phoneNumber,$email){
		$check=$this->checkUsername($userName);
		if($check == -1)
		{
			return "Username Already exists";
		}
		else{
			$password = md5($password);
			$query1 = "INSERT INTO users(userName,password,firstName,lastName,phoneNo,email) Values('$userName','$password','$firstName','$lastName','$phoneNumber','$email')";
			if($this->conn->query($query1))
		{
			return true;
		}
			else
		{
			return "Soory something went wrong";
		}
		}
	}

	

}	
class Admin{
	public function __construct($conn)
	{
		$this->conn=$conn;
	}

	public function isProduct($name, $brand){
		$query3 = "SELECT * FROM products WHERE name = '$name' and brand = '$brand'";
		$result = $this->conn->query($query3);

		if($result->num_rows === 0)
			return 1;
		else
			return -1;
	}

	public function isProductId($id)
	{
		$query3 = "SELECT * FROM products WHERE productId = '$id'";
		$result = $this->conn->query($query3);

		if($result->num_rows === 0)
			return 1;
		else
			return -1;
	}

	public function addProduct($name, $brand, $price, $category, $quantity, $productImg){

		$query3 = "INSERT INTO products (name, brand, image, price, quantity, category) VALUES ('$name', '$brand', '$productImg', '$price', '$quantity', '$category')";
		if($this->conn->query($query3))
			return true;
		else
			return false;
	}

	public function logout()
	{
		unset($_SESSION['admin']);
	 	session_destroy();
	 	echo "<script type='text/javascript'>alert('Succesfully Logout');window.location.href = '../index.php';</script>";
	}

	public function getLastestId ()
    {
      $id = $this->conn->query("select max(productId) as max from products");
      $id = $id->fetch_assoc();
      $id = $id['max'];
      if($id != NULL) return  $id+1;
      else return 1;
    }


    public function updateProduct($id, $name, $brand, $productImg, $price, $quantity, $category)
    {
    	$query3 = "UPDATE products SET name = '$name', brand = '$brand', image = '$productImg', price = '$price', quantity = '$quantity', category = '$category' WHERE productId = '$id'";

    	if($this->conn->query($query3))
    		return true;
    	else
    		return false;
    }

    public function deleteProduct($id)
    {
    	$query3 = "DELETE FROM products WHERE productId = '$id'";

    	if($this->conn->query($query3))
    		return true;
    	else
    		return false;
    }

    public function getImgName($id)
    {
    	$query3 = "SELECT image FROM products WHERE productId = '$id'";
    	$result = $this->conn->query($query3);
    	$row = $result->fetch_assoc();
    	return $row;

    }

}
?>