<?php
	/** 
	 * This module will be use to save time in and time out for the employee attendance
	 * It can automatically detect if the employee has an already existing time-in or time-out
	*/


	include 'session.php';
	include 'timezone.php';

	//check if the post submission came from sign-in
	if(isset($_POST['signin'])){
		$employee_id = $_POST['employee'];
		$status = $_POST['status'];
		$date_now = date('Y-m-d');

		//check if the employee id existing
		$sql = "SELECT id, schedule_id, firstname, lastname FROM employees WHERE employee_id='$employee_id'";
		$query = $conn->query($sql);
		if ($query->num_rows>0) {
			//employee is existing -> get the following details (id, schedule_id, firstname, and lastname)
		 	$row = $query->fetch_assoc();
		 	$id = $row['id'];
		 	$schedule_id = $row['schedule_id'];
		 	$employee_name = $row['firstname']." ".$row['lastname'];

		 	//check if the employee has an existing schedule
		 	if ($schedule_id==null || $schedule_id=='') {
		 		 $_SESSION['error']='No schedule found for '.$employee_name;
		 	}
		 	else{
		 		//check if time in or time out
		 		if ($status=="in") {

		 			//check if has time in for the current day
		 			$sql = "SELECT id FROM attendance WHERE employee_id=$id AND date='$date_now'";
					$query=$conn->query($sql);
					
		 			if ($query->num_rows>0) {
						//time in for the day found
		 				$_SESSION['error']='Time-In already logged for today.';
		 			}
		 			else{
						//no time in for the day
						$time_in = date('H:i:s');

						//check the employee schedule to determine if late or not
						$sql = "SELECT * FROM schedules WHERE id = $schedule_id";
						$squery = $conn->query($sql);
						$srow = $squery->fetch_assoc();
						$status = ($time_in > $srow['time_in']) ? 0 : 1;

		 				//insert the time-in details
		 				$sql=$conn->prepare("INSERT INTO attendance (employee_id, date, time_in, status) VALUES (?,?,?,?)");
		 				$sql->bind_param("issi",$id, $date_now, $time_in, $status);
		 				if ($sql->execute()) {
		 					$_SESSION['success']=$employee_name. 's time-in has been recorded.';
		 				}
		 				else{
		 					 $_SESSION['error']=$conn->error;
		 				}
		 				$sql->close();
		 			}
		 		}
		 		else{				
		 			$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
		 			$query=$conn->query($sql);

					//check if has existing time-in log for current day
					if ($query->num_rows>0) {
		 				$row=$query->fetch_assoc();
		 				$uid = $row['uid'];

						//time-out already logged for today
		 			    if ($row['time_out']!="00:00:00") {
		 			    	 $_SESSION['error']='You have been already logged your time-out.';
		 			    }
		 			    else{
							//no time-out record found
		 			    	$time_in = 	strtotime($row['time_in']);
			 				$time_out = date('H:i:s');

							//get the total working hours
			 				$hrs = round(abs(strtotime($time_out) - $time_in) / 3600,2);	

			 				//update attendance table
			 				$sql = $conn->prepare("UPDATE attendance SET time_out=?, num_hr=? WHERE id=? AND date=?");
			 				$sql->bind_param("sdis",$time_out, $hrs, $uid, $date_now);
			 				if ($sql->execute()) {
			 					 $_SESSION['success']='Time-out has been recorded.';
			 				}
			 				else{
			 					 $_SESSION['error']=$conn->error;
			 				}
			 				$sql->close();
			 			    }
		 			}
		 			else{
		 				 $_SESSION['error']='No time-in found.';
		 			}
		 		}
		 	}
		}
		else{
			  $_SESSION['error']='Employee ID not found.';
		}	
	}
	header('location: index');
?>	