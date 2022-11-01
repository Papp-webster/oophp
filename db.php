<?php
 
	namespace Api;

	use PDO;
	use PDOException;
      class DB {
	  
	  // Database Details
	  private const DBHOST = 'localhost';
	  private const DBUSER = 'root';
	  private const DBPASS = '';
	  private const DBNAME = 'laszlo_api';
	  // Data Source Network
	  private $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . '';
	  private $options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	  ];
	  // conn variable
	  protected $conn = null;

	  // Constructor Function
	  public function __construct() {
	    try {
	      $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS, $this->options);
	      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	    } catch (PDOException $e) {
	      die('Connectionn Failed : ' . $e->getMessage());
	    }
	    return $this->conn;
	  }

	  // Sanitize Inputs
	  public function test_input($data) {
	    $data = strip_tags($data);
	    $data = htmlspecialchars($data);
	    $data = stripslashes($data);
	    $data = trim($data);
	    return $data;
	  }

	  // JSON Format Converter Function
	  public function message($content) {
	    return json_encode(['message' => $content]);
	  }
	}

?>