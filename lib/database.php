<?php 
	
	/**
	*This PHP Script Creates and Maintains connection to MYSQL Database Using PHP Data Objects(PDO)
	*
	*/
	
	class Database{
				
		public $connection;
			
		/**
		* Class Constructor to connection to Database and Set some PDO Attributes.
		* @param string $host a Host Address typically localhost
		* @param string $db_name a Database Name
		* @param string $db_user the MYSQL Username
		* @param string $db_pass the MYQSL Password
		*/
		public function __construct($host, $db_name, $db_user, $db_pass){
			$this->connection = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_pass);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);	
		}
		
		
		/**
		* find_by_query method
		* @param string $query an SQL Query
		* @param array $params Parameters to Bind
		* @param constant $fetchMode a PDO Fetch Mode Class Attibute
		* @return Mixed
		*/
		
		public function find_by_query($query,  $params = array(), $fetchMode= PDO::FETCH_OBJ){
		
		try{
			$statement = $this->connection->prepare($query);
			if(!empty($params)){
			foreach ($params as $key => $value){	
				$statement->bindValue("$key", $value);	
				}
			}
			$statement->execute();
			return $statement->fetchAll($fetchMode);
		}catch(PDOException $e){
		
		echo "An Error Occurred  ".$e->getMessage();
		
		}	
		
		}

		
		/**
		* find_by_column method
		* @param string $table a Database Table
		* @param string $pcolumn a Database Table Column
		* @param array $columnArray Parameters to Bind
		* @return Mixed
		*/
		
		public function find_by_column($table, $column, $columnArray){
				
				$query = "SELECT * FROM $table WHERE $column =:$column";
				return $this->find_by_query($query, $columnArray);	
			}
			
		
		/**
		* find_all method
		* @param string $table a Database Table 
		* @return Mixed
		*/
			
		public function find_all($table){
		
			$query = "SELECT * FROM	$table";
			return $this->find_by_query($query);	
		}
		
		
		
		/**
		* find_by_column method
		* @param string $query an SQL Query
		* @param bool $obj Boolean value
		* @param bool $fetch Boolean Value
		* @return Mixed
		*/
		
        public function execute_query($query, $fetch = false){
			try{
			
			$statement = $this->connection->prepare($query);
			$statement->execute();
			if($fetch)
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
		
			echo "An Error Occurred  ".$e->getMessage();	
	  	 	}		
	   }
        
		
		
		/**
		* insert method
		* @param string $table a Database Table
		* @param array $params Parameters to Bind
		* @return integer
		*/
		
		public function insert($table, $params)	{
			try{
			
			$columns  = implode(',', array_keys($params));
			$columnvalues = ':'. implode(', :', array_keys($params));
			
			$statement = $this->connection->prepare("INSERT INTO $table ($columns) VALUES($columnvalues)");
			foreach ($params as $key => $value){
				$statement->bindValue(":$key", $value);	
			}
			$statement->execute();
			return $this->connection->lastInsertId();
			
			}catch(PDOException $e){
		
			echo "An Error Occurred  ".$e->getMessage();	
			}		
		}
		
		
		
		/**
		* update method
		* @param string $table a Database Table
		* @param array $params Parameters to Bind
		* @param string $where SQL WHERE Clause
		* @param integer $limit
		*/
		
		public function update($table, $params, $where, $limit = 1){
		try{
				
			$columns = "";
			
			foreach($params as $key =>$value){
			$columns .= "$key = :$key,";	
			}
			$columns = rtrim($columns, ',');
			
			echo $columns;
			
			$statement = $this->connection->prepare("UPDATE $table SET $columns WHERE $where LIMIT $limit");
			foreach($params as $key => $value){
			$statement->bindValue(":$key", $value);		
			}
			$statement->execute();
			return true;
			
			}catch(PDOException $e){
			
			echo "An Error Occurred  ".$e->getMessage();	
			}
		
		}
	
		
		/**
		* find_by_column method
		* @param string $table a Database Table
		* @param string $where an SQL WHERE Clause
		* @param integer $limit
		*/
		function delete($table, $where, $limit = 1){
			
		return $this->connection->exec("DELETE FROM $table WHERE $where LIMIT $limit");		
		}

	}


		/**
		*This Creates an Instanace of the Database Class
		*
		*/
		
		try{	
		
		$database = new Database(DB_SERVER, DB_NAME, DB_USER, DB_PASS);
			
		}catch(PDOException $e){
			
			echo "An Error Occurred  ".$e->getMessage();
			
		}

?>