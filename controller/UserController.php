<?php
	// Include config.php file
	include_once './db.php';
	

	// Create a class Users
	class UserController extends DB {

		public function generateToken()
		{
			$len = 90;
			$token = array();
			for ($i = 0; $i <= $len; $i++) {
			$ord = 0;
			switch(rand(1,3)) {
				case 1: // 0 - 9
				$ord = rand(48,57);
				break;
				case 2: // A - Z
				$ord = rand(65,90);
				break;
				case 3: // a - z
				$ord = rand(97,112);
				break;
			}
			$token[] = chr($ord);
			
			}
			return $token;
			
		}
		
	  // Fetch all or a single user from database
	  public function allData($id = 0, $token='') {
			if(isset($_GET['token'])) {
            //token generator
			$tokengenerate = implode($this->generateToken());
			
	 
			$token = $_GET['token'];
			$code = 'K8Ebl37ndddMK104S1E67885bcgbTfA82hUMC1a232d01XOb75gMkWKO1R7bIfjM17H5dFU9JeX2P5lG2bHPnchQ2Zb';
			$hit = 5;
			// token date current time 
			$current_date = date("Y-m-d H:i:s", time());
			// token date time end
			$expire_date = date("Y-m-d H:i:s", strtotime("+ 6 days"));
			$days=ceil((strtotime("+ 22 days")-time())/60/60/24);
			
			
			/* Token with hit count (5)
			$stmt = $this->conn->prepare('SELECT id,hit_count FROM token_permissions WHERE token_id = ?');
			$stmt->execute([$token]);
			$getToken = $stmt->fetch(PDO::FETCH_ASSOC);*/

			$stmt = $this->conn->prepare('SELECT id,token_id,token_created,token_experied FROM token_type WHERE token_id = ?');
			$stmt->execute([$token]);
			$getTokenTime = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
				if ($getTokenTime['token_id'] == $code)  {
					
					/* Token with hit count (5)
					if ($getToken['hit_count'] > $hit) {
						return 'A token lejárt!';
						die();
					} else {
						$stmt = $this->conn->prepare('UPDATE token_permissions SET hit_count = ? WHERE token_id = ?');
						$stmt->execute([$getToken['hit_count'] + 1,$token]);
					}*/
					
					// Token with experied date
					if ($getTokenTime['token_experied'] <= $current_date) {
						$stmt = $this->conn->prepare('UPDATE token_type SET token_id = ?, token_created = ?,token_experied = ? WHERE token_id = ?');
						$stmt->execute([$tokengenerate,$current_date,$expire_date,$token]);
						return 'A token ' . $days . ' napig volt érvényes!';
						die();
					} else {
						$stmt = $this->conn->prepare('UPDATE token_type SET token_experied = ? WHERE token_id = ?');
						$stmt->execute([$expire_date,$token]);
						die();
					}

					$sql = 'SELECT token_type.token_id,token_type.token_experied, 
					token_permissions.permissions as permissions,
					token_permissions.table_id as table_id, 
					user.name as user_name,
					user.email as user_email, 
					db_publisher.name as publisher_name
					FROM token_type
					LEFT JOIN token_permissions ON token_type.token_id = token_permissions.token_id  
					LEFT JOIN user ON token_type.user_id = user.id
					LEFT JOIN db_publisher
					ON db_publisher.id = user.db_publisher_id';
					if ($id != 0) {
						$sql .= ' WHERE token_type.id = ' . $id;
					}
					$result = $this->conn->prepare($sql);
					$numRows = $result->execute();
						if ($numRows > 0) {
							while ($row = $result->fetchAll()) {
								$data[] = $row;
							}
							return $data;
						}
				} else {
					return 'Helytelen token!';
					die();
				}
	    
			} else {
				return print_r(json_encode(['status'=> 401,'message' =>'Authentikációs token szükséges!']));
				die();
			}
	  }

	  /* Insert an user in the database
	  public function insert($name, $description, $price) {
	    $sql = 'INSERT INTO products (name, description, price) VALUES (:name, :description, :price)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price]);
	    return true;
	  }*/
      
	  /* search users
	  public function search($name) {
		$sql = "SELECT * FROM products WHERE name LIKE '%" .$name. "%'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	  
	  // Update an user in the database
	  public function update($name, $description, $price, $id) {
	    $sql = 'UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'id' => $id]);
	    return true;
	  }

	  // Delete an user from database
	  public function delete($id) {
	    $sql = 'DELETE FROM products WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    return true;
	  }
	  */
	}

?>