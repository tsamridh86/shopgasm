<?php
class Users{
	private $gradientFactor = 8;
	public function __construct($conn)
	{
		$this->conn=$conn;
	}
	public function logout()
	{
		unset($_SESSION['userName']);
	 	session_destroy();
	 	echo "<script type='text/javascript'>alert('Succesfully Logout');window.location.href = 'index.php';</script>";
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
	public function countSearchProducts($str)
	{
		$query1="SELECT count(productId) as totalProducts from products WHERE ((name LIKE '%$str%') OR (category LIKE '%$str%'))";
		$result=$this->conn->query($query1);
		if($result)
		{
			$row=$result->fetch_assoc();
			return $row['totalProducts'];
		}
		else{
			return false;
		}

	}
	public function searchProducts($str,$start,$limit)
	{
		$start=$start-1;
		$totalProducts=$this->countSearchProducts($str);
		$total=$start+$limit;
		if($totalProducts >= $total)
		{
		
		$query1="SELECT *  from products WHERE ((name LIKE '%$str%') OR (category LIKE '%$str%')) LIMIT $start,$limit";
		}
		else{
		$query1="SELECT *  from products WHERE ((name LIKE '%$str%') OR (category LIKE '%$str%')) LIMIT $start,$totalProducts";
		}
		$result= $this->conn->query($query1);
			if($result)
			{
				$i=0;
				$allProducts=array();
				while($row=$result->fetch_assoc())
				{
					$allProducts[$i]['productId']=$row['productId'];
					$allProducts[$i]['name']=$row['name'];
					$allProducts[$i]['brand']=$row['brand'];
					$allProducts[$i]['image']=$row['image'];
					$allProducts[$i]['price']=$row['price'];
					$allProducts[$i]['quantity']=$row['quantity'];
					$allProducts[$i]['category']=$row['category'];
					$i=$i+1;
				}
				return $allProducts;
			}
			else{
				return "Something went wrong";
			}
	}
	public function filterSearchProducts($str,$brand=-1,$category=-1,$price = -1)
	{
		$query="SELECT *  from products WHERE ((name LIKE '%$str%')";
		if($price != -1)
		{
			$allPrice=explode(",", $price);
			$gradient=$this->getGradient();
			$i=0;
			$query = $query." AND ";

			while($i < sizeof($allPrice))
			{
				$limit=$allPrice[$i]+$gradient;
				$limit = ceil($limit);
				$query=$query." (price BETWEEN $allPrice[$i] AND $limit)";
				$query=$query."OR";
				$i=$i+1;
			}
			$query=substr($query,0, -2);
		}
		if($brand !=-1)
		{
			$allBrands=explode(",", $brand);
			$i=0;
			$query = $query." AND ";
			while($i < sizeof($allBrands))
			{
				$query = $query."(brand LIKE '%$allBrands[$i]%') ";
				$query=$query."OR";
				$i=$i+1;
			}
			$query=substr($query,0, -2);

		}
		if($category !=-1)
		{
			$allCategory=explode(",", $category);
			$i=0;
			$query = $query." AND ";
			while($i < sizeof($allCategory))
			{
				$query = $query."(category LIKE '%$allCategory[$i]%') ";
				$query=$query."OR";
				$i=$i+1;
			}
			$query=substr($query,0, -2);

		}
		$query=$query.")";
		$result= $this->conn->query($query);
			if($result)
			{
				$i=0;
				$allProducts=array();
				while($row=$result->fetch_assoc())
				{
					$allProducts[$i]['productId']=$row['productId'];
					$allProducts[$i]['name']=$row['name'];
					$allProducts[$i]['brand']=$row['brand'];
					$allProducts[$i]['image']=$row['image'];
					$allProducts[$i]['price']=$row['price'];
					$allProducts[$i]['quantity']=$row['quantity'];
					$allProducts[$i]['category']=$row['category'];
					$i=$i+1;
				}
				return $allProducts;
			}
			else{
				return "Something went wrong";
			}
}

	public function suggestProducts($str,$limit)
	{
		$query1="SELECT *  from products WHERE ((name LIKE '%$str%') OR (category LIKE '%$str%')) LIMIT $limit";
		$result= $this->conn->query($query1);
		if($result)
		{
			$i=0;
				$allProducts=array();
				while($row=$result->fetch_assoc())
				{
					$allProducts[$i]['name']=$row['name'];
					$i=$i+1;
				}
				$allProducts=json_encode($allProducts);
				return $allProducts;
			}
			else{
				return "Something went wrong";
			}
		}	
	public function getUserByUserName($userName)
	{
		$query3 = "SELECT * FROM users WHERE userName = '$userName'";

		$result = $this->conn->query($query3);

		if($result->num_rows >= 0)
			return $result->fetch_assoc();
		else
			return "No user found";
	}

	public function getAllBrands()
	{
		$i =0;
		$queryb = "select distinct(brand) as brands from products";
		$result = $this->conn->query($queryb);
		while($row = $result->fetch_assoc() )
			{
				$output[$i] = $row['brands'];
				$i=$i+1;
			}
		return $output;
	}
	
	public function getAllCategory()
	{
		$i =0;
		$queryb = "select distinct(category) as category from products";
		$result = $this->conn->query($queryb);
		while($row = $result->fetch_assoc() )
			{
				$output[$i] = $row['category'];
				$i=$i+1;
			}
		return $output;
	}

	public function getCheapestProduct()
	{
		$query = "select min(price) as cheap from products";
		$result = $this->conn->query($query);
		$row = $result->fetch_assoc();
		return $row['cheap'];
	}

	public function getExpensiveProduct()
	{
		$query = "select max(price) as expensive from products";
		$result = $this->conn->query($query);
		$row = $result->fetch_assoc();
		return $row['expensive'];
	}

	public function getGradient()
	{
		return (($this->getExpensiveProduct() - $this->getCheapestProduct())/$this->gradientFactor);
	}

	public function addToCart($uId, $pId)
	{
		$query3 = "INSERT INTO cart (userId, productId) VALUES ('$uId', '$pId')";
		if($this->conn->query($query3))
			return true;
		else
			return false;
	}

	public function getLatestProducts()
	{
		$query = "select * from products order by productId desc limit 4";
		$result = $this->conn->query($query);
		if($result)
		{
			$i = 0 ;
			while($row = $result->fetch_assoc())
			{
				$latestProducts[$i]['productId']=$row['productId'];
				$latestProducts[$i]['name']=$row['name'];
				$latestProducts[$i]['brand']=$row['brand'];
				$latestProducts[$i]['image']=$row['image'];
				$latestProducts[$i]['price']=$row['price'];
				$latestProducts[$i]['quantity']=$row['quantity'];
				$latestProducts[$i]['category']=$row['category'];
				$i = $i + 1;
			}
			return $latestProducts;
		}
		else return -1;	

	}

	public function getValuePacks()
	{
		$query = "select * from products order by price asc limit 4";
		$result = $this->conn->query($query);
		if($result)
		{
			$i = 0 ;
			while ($row = $result->fetch_assoc())
			{
				$valuePacks[$i]['productId']=$row['productId'];
				$valuePacks[$i]['name']=$row['name'];
				$valuePacks[$i]['brand']=$row['brand'];
				$valuePacks[$i]['image']=$row['image'];
				$valuePacks[$i]['price']=$row['price'];
				$valuePacks[$i]['quantity']=$row['quantity'];
				$valuePacks[$i]['category']=$row['category'];
				$i = $i + 1;
			}
			return $valuePacks;
		}
		else return -1;
	}

	public function getLimitedStocks()
	{
		$query = "select * from products order by quantity asc limit 4";
		$result = $this->conn->query($query);
		if($result)
		{
			$i = 0 ;
			while ($row = $result->fetch_assoc())
			{
				$limitedStocks[$i]['productId']=$row['productId'];
				$limitedStocks[$i]['name']=$row['name'];
				$limitedStocks[$i]['brand']=$row['brand'];
				$limitedStocks[$i]['image']=$row['image'];
				$limitedStocks[$i]['price']=$row['price'];
				$limitedStocks[$i]['quantity']=$row['quantity'];
				$limitedStocks[$i]['category']=$row['category'];
				$i = $i + 1;
			}
			return $limitedStocks;
		}
		else return -1;
	}	
	public function isInCart($uId, $pId)
	{
		$query3 = "SELECT * FROM cart WHERE userId = '$uId' AND productId = '$pId'";
		$result = $this->conn->query($query3);
		if($result->num_rows == 0)
			return false;
		else
			return true;
	}
	public function removeFromCart($uId, $pId)
	{
		$query3 = "DELETE FROM cart WHERE userId = '$uId' AND productId = '$pId'";
		if($this->conn->query($query3))
			return true;
		else
			return false;	
	}
	public function getProductsForCart($uId)
	{
		$query3 = "SELECT productId,name, price,quantity FROM (cart NATURAL JOIN products) WHERE userId = '$uId'";
		$result = $this->conn->query($query3);
		if($result->num_rows == 0)
			return "No items in Cart";
		else
		{
			$i = 0;
			while($row = $result->fetch_assoc())
			{
				$products[$i]['pName'] = $row['name'];
				$products[$i]['pPrice'] = $row['price'];
				$products[$i]['pId'] = $row['productId'];
				$products[$i]['quantity'] = $row['quantity'];
				$i = $i + 1;
			}

			return $products;
		}		
	}

	public function placeOrder($uId, $total, $product, $quantity, $address)
	{
		$query3 = "INSERT INTO orders (userId, product, quantity, total, address) VALUES ('$uId', '$product', '$quantity', '$total', '$address')";
		if($this->conn->query($query3))
			return true;
		else
			return false;
	}

	public function decrementQuantity($pId, $quantity)
	{
		$query3 = "UPDATE products SET quantity = quantity - '$quantity' WHERE productId = '$pId'";
		if($this->conn->query($query3))
			return true;
		else
			return false;

	}

	public function deleteCart($uId)
	{
		$query3 = "DELETE FROM cart WHERE userId = '$uId'";
		if($this->conn->query($query3))
			return true;
		else
			return false;
	}
	public function getOrders($uId)
	{
		$query3 = "SELECT * FROM orders WHERE userId = '$uId'";
		$result = $this->conn->query($query3);

		if($result->num_rows == 0)
			return "No orders";
		else
		{
			$i = 0;
			while($row = $result->fetch_assoc())
			{
				$orders[$i]['orderId'] = $row['orderId'];
				$orders[$i]['product'] = $row['product'];
				$orders[$i]['quantity'] = $row['quantity'];
				$orders[$i]['total'] = $row['total'];
				$orders[$i]['address'] = $row['address'];
				$i = $i + 1;
			}
			return $orders;
		}
	}

	public function getProductByPId($pId)
	{
		$query3 = "SELECT name, price FROM products WHERE productId = '$pId'";
		$result = $this->conn->query($query3);
		if($result->num_rows == 0)
			return "No such Product";
		else
			return $result->fetch_assoc();
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

	public function getLatestId ()
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

   	public function getAllUsers()
   	{
   		$query3 = "SELECT * FROM users";
   		$result = $this->conn->query($query3);
   		if($result->num_rows >= 1)
   		{
   			$usersList = array('index' => array('userId'=>'',
   												'userName'=>'',
   												'password'=>'',
   												'firstName'=>'',
   												'lastName'=>'',
   												'phoneNo'=>'',
   												'email'=>''
   												 ) );

   			$i = 0;
   			while($row = $result->fetch_assoc())
   			{
   				$usersList[$i]['userId'] = $row['userId'];
   				$usersList[$i]['userName'] = $row['userName'];
   				$usersList[$i]['password'] = $row['password'];
   				$usersList[$i]['firstName'] = $row['firstName'];
   				$usersList[$i]['lastName'] = $row['lastName'];
   				$usersList[$i]['phoneNo'] = $row['phoneNo'];
   				$usersList[$i]['email'] = $row['email'];
   				$i = $i + 1;
   			}

   			return $usersList;
   		}
   		elseif($result->num_rows == 0)
   			return -1;
   		else
   			return 0;
   	}

	public function totalProducts()
	{
		$query1="SELECT count(productId) as totalProducts from products";
		$result=$this->conn->query($query1);
		if($result)
		{
			$row=$result->fetch_assoc();
			return $row['totalProducts'];
		}
		else{
			return false;
		}
	}
	public function getAllProducts($start,$limit){
		$start=$start-1; //0 index
		$totalProducts=$this->totalProducts();
		$total=$start+$limit;
		if($totalProducts >= $total)
		{

			$query1="SELECT * FROM products LIMIT $start, $limit";
		}
		else{

			$query1="SELECT * FROM products LIMIT $start,$totalProducts";

		}
		$result= $this->conn->query($query1);
		if($result)
		{
			$i=0;
			$allProducts=array();
			while($row=$result->fetch_assoc())
			{
				$allProducts[$i]['productId']=$row['productId'];
				$allProducts[$i]['name']=$row['name'];
				$allProducts[$i]['brand']=$row['brand'];
				$allProducts[$i]['image']=$row['image'];
				$allProducts[$i]['price']=$row['price'];
				$allProducts[$i]['quantity']=$row['quantity'];
				$allProducts[$i]['category']=$row['category'];
				$i=$i+1;
			}
			return $allProducts;
		}
		else{
			return "Something went wrong";
		}
	}

	public function getAllOrders()
	{
		$query = "select orderId, userName, phoneNo , address, total from orders natural join users";
		$result = $this->conn->query($query);
		if($result)
		{
			$i = 0 ;
			while ($row = $result->fetch_assoc())
			{
				$allOrders[$i]['orderId'] = $row['orderId'];
				$allOrders[$i]['userName'] = $row['userName'];
				$allOrders[$i]['phoneNo'] = $row['phoneNo'];
				$allOrders[$i]['address'] = $row['address'];
				$allOrders[$i]['total'] = $row['total'];
				$i = $i + 1 ;
			}
			return $allOrders;
		}
		else 
			return -1 ;
	}
}
?>