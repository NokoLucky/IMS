<?php 
class Users{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	public function update_user($first_name, $last_name, $gender, $bio, $image_location, $id){

		$query = $this->db->prepare("UPDATE `users` SET
								`first_name`	= ?,
								`last_name`		= ?,
								`gender`		= ?,
								`bio`			= ?,
								`image_location`= ?
								
								WHERE `id` 		= ? 
								");

		$query->bindValue(1, $first_name);
		$query->bindValue(2, $last_name);
		$query->bindValue(3, $gender);
		$query->bindValue(4, $bio);
		$query->bindValue(5, $image_location);
		$query->bindValue(6, $id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function change_password($user_id, $password) {

		global $bcrypt;

		/* Two create a Hash you do */
		$password_hash = $bcrypt->genHash($password);

		$query = $this->db->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");

		$query->bindValue(1, $password_hash);
		$query->bindValue(2, $user_id);				

		try{
			$query->execute();
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function change_email($user_id, $email) {


		$query = $this->db->prepare("UPDATE `users` SET `email` = ? WHERE `id` = ?");

		$query->bindValue(1, $email);
		$query->bindValue(2, $user_id);				

		try{
			$query->execute();
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}	
	
	public function recover($email, $generated_string) {

		if($generated_string == 0){
			return false;
		}else{
	
			$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = ? AND `generated_string` = ?");

			$query->bindValue(1, $email);
			$query->bindValue(2, $generated_string);

			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if($rows == 1){
					
					global $bcrypt;

					$username = $this->fetch_info('username', 'email', $email); // getting username for the use in the email.
					$user_id  = $this->fetch_info('id', 'email', $email);// We want to keep things standard and use the user's id for most of the operations. Therefore, we use id instead of email.
			
					$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$generated_password = substr(str_shuffle($charset),0, 10);

					$this->change_password($user_id, $generated_password);

					$query = $this->db->prepare("UPDATE `users` SET `generated_string` = 0 WHERE `id` = ?");

					$query->bindValue(1, $user_id);
	
					$query->execute();

					mail($email, 'Your New Tello Password', "Hello " . $username . ",\n\nYour your new password is: " . $generated_password . "\n\nPlease change your password once you have logged in using this password.\nPassword is case sensitive. \n\n--Tello Team");

				}else{
					return false;
				}

			} catch(PDOException $e){
				die($e->getMessage());
			}
		}
	}

    public function fetch_info($what, $field, $value){

		$allowed = array('id', 'username', 'first_name', 'last_name', 'gender', 'bio', 'email'); // I have only added few, but you can add more. However do not add 'password' eventhough the parameters will only be given by you and not the user, in our system.
		if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
		    throw new InvalidArgumentException;
		}else{
		
			$query = $this->db->prepare("SELECT $what FROM `users` WHERE $field = ?");

			$query->bindValue(1, $value);

			try{

				$query->execute();
				
			} catch(PDOException $e){

				die($e->getMessage());
			}

			return $query->fetchColumn();
		}
	}

	public function confirm_recover($email){

		$username = $this->fetch_info('username', 'email', $email);// We want the 'id' WHERE 'email' = user's email ($email)

		$unique = uniqid('',true);
		$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);
		
		$generated_string = $unique . $random; // a random and unique string

		$query = $this->db->prepare("UPDATE `users` SET `generated_string` = ? WHERE `email` = ?");

		$query->bindValue(1, $generated_string);
		$query->bindValue(2, $email);

		try{
			
			$query->execute();
			mail($email,'Recover Your Zerah Password', "Hello " . $username. ",\r\nPlease click the link below or copy it into your browser :\r\n\r\nhttp://www.vescor.co.za/recover.php?email=" . $email . "&generated_string=" . $generated_string . "\r\n\r\n We will generate a new password for you and send it back to your email.\r\n\r\n-- Zerah team");			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function user_exists($username) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username`= ?");
		$query->bindValue(1, $username);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}
	 
	public function email_exists($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function register($name, $username, $email, $password, $repassword, $job)
		   {

				global $bcrypt; // making the $bcrypt variable global so we can use here

				$query 	= $this->db->prepare("INSERT INTO `users` (`name`,`username`, `email`, `password`, `repassword`, `job`) VALUES (?, ?, ?, ?, ?, ?) ");

				$query->bindValue(1, $name);
				$query->bindValue(2, $username);
				$query->bindValue(3, $email);
				$query->bindValue(4, $password);
				$query->bindValue(5, $repassword);				
				$query->bindValue(6, $job);				

				try
				{
					$query->execute();
				}

				catch(PDOException $e)
				{
					die($e->getMessage());
				}	
			}

				public function register_tech($name, $username, $email, $password, $repassword, $d_id, $role, $hiredate)
		   {

				global $bcrypt; // making the $bcrypt variable global so we can use here

				$query 	= $this->db->prepare("INSERT INTO `techs` (`name`,`username`, `email`, `password`, `repassword`, `d_id`, `role`,`hiredate`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");

				$query->bindValue(1, $name);
				$query->bindValue(2, $username);
				$query->bindValue(3, $email);
				$query->bindValue(4, $password);
				$query->bindValue(5, $repassword);				
				$query->bindValue(6, $d_id);				
				$query->bindValue(7, $role);				
				$query->bindValue(8, $hiredate);				

				try
				{
					$query->execute();
				}

				catch(PDOException $e)
				{
					die($e->getMessage());
				}	
			}


	public function activate($email, $email_code) {
		
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = ? AND `email_code` = ? AND `confirmed` = ?");

		$query->bindValue(1, $email);
		$query->bindValue(2, $email_code);
		$query->bindValue(3, 0);

		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				
				$query_2 = $this->db->prepare("UPDATE `users` SET `confirmed` = ? WHERE `email` = ?");

				$query_2->bindValue(1, 1);
				$query_2->bindValue(2, $email);				

				$query_2->execute();
				return true;

			}else{
				return false;
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}


	public function email_confirmed($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ? AND `confirmed` = ?");
		$query->bindValue(1, $email);
		$query->bindValue(2, 1);
		
		try{
			
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function login($username, $password) 
			{

				global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

				$query = $this->db->prepare("SELECT `id`,`password` FROM `users` WHERE `username` = ? AND role = 'user'");
				$query->bindValue(1, $username);

				try{
					
					$query->execute();
					$data 				= $query->fetch();
					$stored_password 	= $data['password']; // stored hashed password
					$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
					
					if(($password == $stored_password)){ // using the verify method to compare the password with the stored hashed password.
						return $id;	// returning the user's id.
					}else{
						return false;	
					}

				}catch(PDOException $e){
					die($e->getMessage());
				}
	
	       }

	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM `users` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}
	  	  	 
	public function get_users($role, $username) {

		$query = $this->db->prepare("SELECT role FROM `users` WHERE role = ? AND username = ?");

		$query->bindValue(1, $role);
		$query->bindValue(2, $username);
		
		try
		{
			$query->execute();
			return $query->fetchAll();

		}catch(PDOException $e)
		{
			die($e->getMessage());
		}	
	}

	/*========================admin login with only admin role====================================*/
public function admin_login($username, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `users` WHERE `username` = ? and role = 'admin'");
		$query->bindValue(1, $username);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
			
			if(($password == $stored_password)){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}	

		/*========================technician login with only technician role====================================*/
public function technician_login($username, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `t_id` FROM `techs` WHERE `username` = ?");
		$query->bindValue(1, $username);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored password
			$id   				= $data['t_id']; // id of the user to be returned if the password is verified, below.
			
			if(($password == $stored_password)){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}
}

?>