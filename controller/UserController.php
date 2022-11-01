<?php
	use Api\DB;
	
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
		
	  // Fetch single token id
	  public function readUsers($id = 0) {
		
		// Check token
		$headers = apache_request_headers();

		if(isset($headers['Authorization'])) {	
		    
			$bearerToken = str_replace('Bearer ', '',$headers['Authorization']);
			$auth = $this->auth();
			$token = $auth[0]['token'];

	    //Get token ids
		$stmt = $this->conn->prepare('SELECT token_id, token_token, valid_to FROM token WHERE token_token = ?');
		$stmt->execute([$bearerToken]);
		$token_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
         
		
		
		
		
			// Decode token
			
			$decoded = JWT::decode($token, new Key($this->key, 'HS512'));

			// Check token expire
			$iat = $decoded->iat;
			$exp = $decoded->exp;
            
			$current_date = date("Y-m-d H:i:s", $iat);
			
			
			
			try {
                
				foreach ($token_id as $tokens) {
					
					$token_ids = $tokens['token_id'];
					$token_token = $tokens['token_token'];

					$valid = $tokens['valid_to'];
					
					$days=round(($iat-strtotime($valid))/60/60/24);
					
						while($token_ids == $id) {
							//Check token validation
							if(strtotime($valid) >= $iat) {
							
							$query = 'SELECT token.token_id, token.token_token, token.user_id, token.publisher_id, token.valid_to, 
							token_permissions.module_name, token_permissions.read, token_permissions.write, token_permissions.delete FROM token 
							LEFT JOIN token_permissions ON token.token_id = token_permissions.token_id
							WHERE token.token_token = ?';
		
							$result = $this->conn->prepare($query);
							$numRows = $result->execute([$bearerToken]);
							
								if ($numRows > 0) {
									while ($row = $result->fetchAll()) {
										$data['token_data'] = $row;
									}
									
								return $data;
								}
							} else {
								return array('message' => 'Authentikációs token '. $days .' napja lejárt!');
							}
					    }  
					
				}
					
			} catch (\Exception $e) {
				return false;
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
			
			//$days=($experied_time-strtotime($getToken['token_created']))/86400;
			
					
				/* Token with hit count (5)
				if ($getToken['hit_count'] > $hit) {
					return 'A token lejárt!';
					die();
				} else {
					$stmt = $this->conn->prepare('UPDATE token_permissions SET hit_count = ? WHERE token_id = ?');
					$stmt->execute([$getToken['hit_count'] + 1,$token]);
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
