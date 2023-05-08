<?php 
class chartforum{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}

	public function select_users($user_id){

		$query = $this->db->prepare("SELECT * FROM users WHERE id = ?");
		$query->bindValue(1,$user_id);

	  	try
			{
				$query->execute();

				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}


	}

	  

	public function select_bookings(){

		$query = $this->db->prepare("SELECT * FROM booking");

	  	try
			{
				$query->execute();

				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}
		}

	public function insert_call($user_id, $callNum, $name, $d_id, $priority, $similar, $description, $dd)
	{
	   $query = $this->db->prepare("INSERT INTO `callog`(`user_id`,`callNum`,`name`, `d_id`, `priority`,`similar`,`description`,`dd`) VALUES (?,?,?,?,?,?,?,?)");

	   $query->bindValue(1, $user_id);
	   $query->bindValue(2, $callNum);
	   $query->bindValue(3, $name);
	   $query->bindValue(4, $d_id);
	   $query->bindValue(5, $priority);
	   $query->bindValue(6, $similar);
	   $query->bindValue(7, $description);
	   $query->bindValue(8, $dd);
	   

	   try
	   {
	   $query->execute();
	   }
	    catch (PDOException $e) 
	    {
			die($e->getMessage());
		}		

	}
	
	 public function departments()
	 {
		$query = $this->db->prepare("SELECT * FROM department");

		try
		{
		  $query->execute();
		  return $query->fetchAll();
			
		}
		catch(PDOException $e)
		{
		  die($e->getMessage());
		}
	}
	
	
	public function calls($user_id)
	{

		$query = $this->db->prepare("SELECT T1.callNum, T1.d_id,T1.status, T1.c_id, T2.d_id, T2.id FROM callog T1 INNER JOIN users T2 ON T1.d_id = T2.d_id WHERE T1.d_id = T2.d_id AND T2.id = ?");
		
		$query->bindValue(1, $user_id);
		
		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function select_callsss($c_id)
	{
		$query = $this->db->prepare("SELECT * FROM callog WHERE c_id = ?");

		$query->bindValue(1, $c_id);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOException $e)
		{ 
			die($e->getMessage());
 
		}
	}

	public function insert_solution($callNum, $user_id, $name, $status, $closedDate, $similar, $description)
	{
		$query = $this->db->prepare("INSERT INTO resolved(`callNum`,`user_id`,`name`,`status`,`closedDate`,`similar`,`description`) VALUES(?, ?, ?, ?, ?, ?, ?)");

		$query->bindValue(1, $callNum);
		$query->bindValue(2, $user_id);
		$query->bindValue(3, $name);
		$query->bindValue(4, $status);
		$query->bindValue(5, $closedDate);
		$query->bindValue(6, $similar);
		$query->bindValue(7, $description);

		try
		{
			$query->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());

		}
	}

	public function update_status($status, $callNum)
	{
       $query = $this->db->prepare("UPDATE callog SET status = ? WHERE callNum = ?");

       $query->bindValue(1, $status);
       $query->bindValue(2, $callNum);

       try
       {
       	 $query->execute();
       }
       catch(PDOException $e)
       {
       	 die($e->getMessage());
       }
	}

	public function select_attended($user_id)
	{ 
     	$query = $this->db->prepare("SELECT T1.c_name,T1.callNum, T1.status, T1.closedDate, T1.similar, T1.description, T2.c_id,T2.user_id, T3.id, T3.name FROM resolved T1 INNER JOIN callog T2 ON T1.c_id = T2.c_id INNER JOIN users T3 ON T2.user_id = T3.id WHERE T1.user_id = ?");

     	$query->bindValue(1, $user_id);

     	try
     	{
     		$query->execute();

     		return $query->fetchAll();
     	}
     	catch(PDOException $e)
     	{
     		die($e->getMessage());
     	}

	} 

	public function select_resolved($user_id)
	{ 
     	$query = $this->db->prepare("SELECT T1.callNum, T1.similar, T1.status, T2.c_name, T2.closedDate, T2.description FROM callog T1 INNER JOIN resolved T2 ON T1.c_id = T2.c_id WHERE T1.user_id = ? AND T1.status IN ('In Progress','Resolved')");

     	$query->bindValue(1, $user_id);

     	try
     	{
     		$query->execute();

     		return $query->fetchAll();
     	}
     	catch(PDOException $e)
     	{
     		die($e->getMessage());
     	}

	}

	public function select_call($callNum)
	{
		$query = $this->db->prepare("SELECT * FROM callog WHERE callNum = ?");

		$query->bindValue(1, $callNum);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

	public function select_techs()
	{
		$query = $this->db->prepare("SELECT T1.t_id, T1.name, T1.email, T1.hiredate, T2.dname FROM techs T1 INNER JOIN department T2 ON T1.d_id = T2.d_id ORDER BY T1.t_id ASC");

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

	/*=========Admin delete techniciand=======*/
    public function delete_users($user_id) {

		$query = $this->db->prepare("DELETE FROM techs WHERE t_id = ?");
	
		$query->bindValue(1, $user_id);
		
		try{
			
			$query->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function select_calls()
	{
		$query = $this->db->prepare("SELECT T1.c_id, T1.callNum, T1.user_id, T1.name, T1.priority, T1.similar, T1.description, T1.status, T1.dd, T2.dname FROM callog T1 INNER JOIN department T2 ON T1.d_id = T2.d_id");

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

	public function select_open_calls()
	{
		$query = $this->db->prepare("SELECT T1.callNum, T1.name, T1.user_id, T1.priority, T1.description, T1.status, T1.dd, T2.dname FROM callog T1 INNER JOIN department T2 ON T1.d_id = T2.d_id WHERE T1.status = 'Open'");

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

	public function select_technician($callNum)
	{
		$query = $this->db->prepare("SELECT T1.d_id, T1.t_id, T1.name, T2.dname, T3.callNum FROM techs T1 INNER JOIN department T2 ON T1.d_id = T2.d_id INNER JOIN callog T3 ON T2.d_id = T3.d_id WHERE T2.d_id = T3.d_id AND T1.d_id = T2.d_id AND callNum = ?");

		$query->bindValue(1, $callNum);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

	public function insert_assigned($callNum, $t_id, $user_id)
	{
		$query = $this->db->prepare("INSERT INTO assigned(`callNum`,`t_id`,`user_id`) VALUES(?, ?, ?)");

		$query->bindValue(1, $callNum);
		$query->bindValue(2, $t_id);
		$query->bindValue(3, $user_id);

		try
		{
			$query->execute();
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

	public function update_call_status($callNum)
	{
       $query = $this->db->prepare("UPDATE callog SET status = 'In Progress' WHERE callNum = ?");

       $query->bindValue(1, $callNum);

       try
       {
       	 $query->execute();
       }
       catch(PDOException $e)
       {
       	 die($e->getMessage());
       }
	}

	public function select_user_techs($user_id){

		$query = $this->db->prepare("SELECT * FROM techs WHERE t_id = ?");
		$query->bindValue(1,$user_id);

	  	try
	  	    {
				$query->execute();

				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}
	}

	public function view_all_assigned($user_id)
	{
		$query = $this->db->prepare("SELECT T1.callNum, T1.t_id, T1.user_id, T2.name, T2.description, T2.priority, T2.dd FROM assigned T1 INNER JOIN callog T2 ON T1.callNum = T2.callNum WHERE t_id = ? ");

		$query->bindValue(1, $user_id);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function view_assigned($user_id)
	{
		$query = $this->db->prepare("SELECT T1.callNum, T1.t_id, T1.user_id, T2.d_id, T2.name, T2.description, T2.priority, T2.dd FROM assigned T1 INNER JOIN callog T2 ON T1.callNum = T2.callNum WHERE t_id = ? AND T2.status IN ('Open','In Progress')");

		$query->bindValue(1, $user_id);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function view_resolved($user_id)
	{
		$query = $this->db->prepare("SELECT * FROM resolved WHERE user_id = ?");

		$query->bindValue(1, $user_id);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOException $e)
		{
			die($e->getmessage());
		}
	}

	public function tehcnician_resonsible($user_id)
	{
		$query = $this->db->prepare("SELECT T1.callNum, T1.dd, T1.priority, T1.status, T2.dname, T3.name FROM callog T1 LEFT JOIN department T2 ON T1.d_id = T2.d_id LEFT JOIN techs T3 ON T2.d_id = T3.d_id LEFT JOIN assigned T4 ON T3.t_id = T4.t_id WHERE T3.t_id = T4.t_id AND T1.user_id = ? LIMIT 0,1");

		$query->bindValue(1, $user_id);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

         
	public function select_different_technician($user_id, $d_id)
	{
		$query = $this->db->prepare("SELECT * FROM techs WHERE t_id != ? AND d_id = ?");

		$query->bindValue(1, $user_id);
		$query->bindValue(2, $d_id);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function escalate_call($t_id, $callNum)
	{
		$query = $this->db->prepare("UPDATE assigned SET t_id = ? WHERE callNum = ?");

		$query->bindValue(1, $t_id);
		$query->bindValue(2, $callNum);

		try
		{
			$query->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function view_all_open($user_id)
	{
		$query = $this->db->prepare("SELECT * FROM callog WHERE user_id = ? AND status = 'Open'");

		$query->bindValue(1, $user_id);

		try
		{
			$query->execute();

			return $query->fetchAll();
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

public function update_call($user_id, $callNum, $name, $d_id, $priority, $similar, $description, $dd, $c_id)
	{
	   $query = $this->db->prepare("UPDATE `callog`
	   	                                    SET `user_id` = ?,
	   	                                    SET `callNum` = ?,
	   	                                    SET `name` = ?,
	   	                                    SET `d_id` = ?,
	   	                                    SET `priority` = ?,
	   	                                    SET `similar` = ?,
	   	                                    SET `description` = ?,
	   	                                    SET `dd` = ?
	   	                                    WHERE c_id = ?");

	   $query->bindValue(1, $user_id);
	   $query->bindValue(2, $callNum);
	   $query->bindValue(3, $name);
	   $query->bindValue(4, $d_id);
	   $query->bindValue(5, $priority);
	   $query->bindValue(6, $similar);
	   $query->bindValue(7, $description);
	   $query->bindValue(8, $dd);
	   $query->bindValue(9, $c_id);
	   

	   try
	   {
	   $query->execute();
	   }
	    catch (PDOException $e) 
	    {
			die($e->getMessage());
		}		

	}

	public function view_callto_edit($c_id)
	{
		$query = $this->db->prepare("SELECT T1.user_id, T1.callNum, T1.name, T1.d_id, T1.priority, T1.similar, T1.description, T1.dd, T1.c_id, T2.dname FROM callog T1 INNER JOIN department T2 ON T1.c_id = T2.d_id WHERE T1.c_id = ?");

		$query->bindValue(1, $c_id);

		try
		{
			$query->execute();
return $query->fetchAll();
			
		}
		catch(PDOExcetion $e)
		{
			die($e->getMessage());
		}
	}

}

?>