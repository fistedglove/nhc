<?php

	/**
	* This PHP Script Contains the Session Class.
	*
	*/

	class Session{
	
	private $loggedIn;
	private $userId;
	private $message;
	private $userPosition;
    private $warning;
	
	/**
	* Class Constructor. Start the session and initialize class properties
	*/
	
	public function __construct(){
			session_start();
			$this->checkLogin();
			$this->checkMessage();	
            $this->checkWarning();
		}
	
	
	/**
	* Retrieves the Login user Id
	* @return integer 
	*/
	public function userId(){
	return $this->userId;	
		
	}
	
	/**
	* Retrieves the user Position
	* @return integer 
	*/
	public function userPosition(){
	return $this->userPosition;	
		
	}
	
	/**
	* Assigns User Login status to the $loggedin class property
	*
	*/
	
	public function checkLogin(){
		if(isset($_SESSION['userId'])){
		 $this->userId = $_SESSION['userId'];
		 $this->userPosition = $_SESSION['userPosition'];
		 $this->loggedIn = true;
		}	
	}
	
	/**
	* Check if user is Logged in
	* @return boolean
	*/
	
	public function isLoggedIn(){
		return $this->loggedIn;
	}
		
	
	/**
	* Log a User In
	*/
	public function logIn($user){
		if(isset($user)){
		$this->userId = $_SESSION['userId'] = $user->id;
		$this->userPosition = $_SESSION['userPosition'] = $user->position;
		$this->loggedIn = true;	
		}
	}
	
	/**
	* Log a User Out
	*/
	
	public function logOut(){
		unset($_SESSION['userId']);
		unset($this->userId);
		unset($this->userPosition);
		unset($_SESSION['userPosition']);
		$this->loggedIn = false;
		}
	
	/**
	* Retrieves flashed status Messages
	* @return string
	*/
	
	public function getMessage(){
		return $this->message;		
	}
    
	/**
	* Retrieves flashed warning Messages
	* @return string
	*/
    public function getWarning(){
		return $this->warning;		
	}
	
	
	/**
	* Flash status message in SESSION
	*/
	public function setMessage($msg){
		$_SESSION['message'] = $msg;		
	}
    
	/**
	* Flash warning message in SESSION
	*/
    public function setWarning($msg){
		$_SESSION['warning'] = $msg;		
	}
	
	
	/**
	* Assigns flashed status message to the class $message property
	*/
	public function checkMessage(){
		if(isset($_SESSION['message'])){
		$this->message = $_SESSION['message'];
		unset($_SESSION['message']);
		}else{
		$this->message = "";			
		}
	}
    
	/**
	* Assigns flashed warning message to the class $warning property
	*/
    public function checkWarning(){
		if(isset($_SESSION['warning'])){
		$this->warning = $_SESSION['warning'];
		unset($_SESSION['warning']);
		}else{
		$this->warning = "";			
		}
	}

  }

	/**
     * Creates an Instance of the Session Class
     */
	$session = new Session();

?>