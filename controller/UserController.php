<?php
	// Include config.php file
	include_once './db.php';
	include_once './vendor/autoload.php';

	use \Firebase\JWT\JWT;
	use Firebase\JWT\Key;


	// Create a class Users
	class UserController extends DB {

		protected $key = 'secretkey';

		/*public function generateToken($length = 0)
		{
			$token = array();
			for ($i = 0; $i <= $length; $i++) {
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
			
		}*/
        // JWT token authorize 
		public function auth() {
              $iat = time();
			  $exp = $iat + 60 * 60;
			  $payload = array(
				"iss" => "http://localhost:8080/oophp",
				"aud" => "http://localhost:8080",
				"iat" => $iat,
				"username" => "Jhon doe",
				"exp" => $exp
			  );
			  $jwt = JWT::encode($payload,$this->key, 'HS512');
			 
			
			  $token_data[] = array(
				"token" => $jwt,
				"iat" => $iat,
				"expires" => $exp
			  );
			  return $token_data;
		}
		
	  // Fetch all or a single user from database
	  public function readUsers($id = 0) {
		/* Get token
		$stmt = $this->conn->prepare('SELECT id,token_id,token_created,token_experied FROM token_type WHERE user_id = ?');
		$stmt->execute([$id]);
		$getToken = $stmt->fetch(PDO::FETCH_ASSOC);

		$code = 'ji111eFb1iY9684CbSG0nigpl30bRVgKeKlTH9E70DCB7X5WXGTBF3PGZ914XHei92lSV12lhje6EVlaOja6gh4c28d';
        */
		
		// Check token
		$headers = apache_request_headers();

		if(isset($headers['Authorization'])) {	
		    
			//$token = str_replace('Bearer ', '',$headers['Authorization']);
			$auth = $this->auth();
			$token = $auth[0]['token'];
			
			// Decode token
			
			$decoded = JWT::decode($token, new Key($this->key, 'HS512'));

			// Check token expire
			$iat = $decoded->iat;
			$exp = $decoded->exp;

			if($exp >= $iat) {
			
			try {
				
                 
				$sql = 'SELECT token_type.user_id,token_type.token_experied, 
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
						$sql .= ' WHERE token_type.user_id = ' . $id;
					}
					$result = $this->conn->prepare($sql);
					$numRows = $result->execute();
						if ($numRows > 0) {
							while ($row = $result->fetchAll()) {
								$data['User'] = $row;
							}
							return $data;
						} 
			} catch (\Exception $e) {
				return false;
			}
		} else {
			return array('status' => 401, 'message' => 'Authentikációs token lejárt!');
		}
		} else {
		   http_response_code(401);
	            return print_r(json_encode(
					array(
					"status" => 401,
					'message' => 'Authentikációs token hiányzik!'
				)));
				
		}	
		
            /*token generator
			$tokengenerate = implode($this->generateToken(60));*/
			// token date current time 
			//$current_date = date("Y-m-d H:i:s", time());
			// token date time end
			//$experied_time = strtotime($getToken['token_experied']);
			// token experied time
			//$days=($experied_time-strtotime($getToken['token_created']))/86400;
			
					
				/* Token with hit count (5)
				if ($getToken['hit_count'] > $hit) {
					return 'A token lejárt!';
					die();
				} else {
					$stmt = $this->conn->prepare('UPDATE token_permissions SET hit_count = ? WHERE token_id = ?');
					$stmt->execute([$getToken['hit_count'] + 1,$token]);
				}*/
				
				/* Token with experied date
				if ($getToken['token_experied'] <= $current_date) {
					return 'A token ' . round($days,0) . ' napig volt érvényes!';
					die();
				}*/ 

					
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
