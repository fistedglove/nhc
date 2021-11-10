<?php

	/**
	* This PHP Script Contains the Pagination Class for paginating between pages
	*
	*/

	class Pagination{
	
	public $perPage;
	public $rowCount;
	public $currentPage;
	
	/**
	* Class Constructor.
	* @param integer $perPage No. of items per page
	* @param integer $currentPage the Current Page
	* @param integer $rowCount No. of rows in DB Table
	*/
	
	public function __construct($perPage = 8, $currentPage = 1, $rowCount){
			
		$this->perPage = $perPage;
		$this->currentPage = $currentPage;
		$this->rowCount = $rowCount;
	}	
		
	/**
	* Calculates the total pages
	* @return integer 
	*/
	
	public function totalPages(){
		return ceil($this->rowCount/$this->perPage);		
	}	
	
	/**
	* Calculates the offSet
	* @return integer 
	*/
		
	public function offSet(){
		return ($this->currentPage - 1) * $this->perPage;			
	}	
	
	/**
	* Calculates the prevPage value
	* @return integer 
	*/
	
	public function prevPage(){
		return $this->currentPage - 1;		
	}
	
	/**
	* Calculates the nextPage value
	* @return integer 
	*/
	
	public function nextPage(){
		return $this->currentPage + 1;	
	}
	
	/**
	* Retrieves the hasNext value
	* @return boolean
	*/
	public function hasNext(){
		return ($this->nextPage() <= $this->totalPages()) ? true : false;	
	}
	
	/**
	* Retrieves the hasPrevious value
	* @return boolean
	*/
	
	public function hasPrevious(){
		return ($this->prevPage() >=1 ) ? true : false; 	
	}
	
 }

?>