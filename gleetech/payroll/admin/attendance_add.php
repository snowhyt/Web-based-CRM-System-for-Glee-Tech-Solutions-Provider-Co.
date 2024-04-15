<?php
	include 'includes/session.php';
	$range_to = date('m/t/Y');
	$range_from = date('m/01/Y');

	//check if POST id is add
	if(isset($_POST['add'])){
		//get employee name
		$employee = $_POST['employee'];
		//get selected date
		$date = $_POST['date'];
		//get selected time-in and convert it to time format
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		//get selected time-out and convet it to time format
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		//select query to check if the employee is existing
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee' AND active=1";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			//no return
			$_SESSION['error'] = 'Employee is already termed.';
		}
		else{
			//with return
			$row = $query->fetch_assoc();
			$emp = $row['id'];

			$sql = "SELECT * FROM attendance WHERE employee_id = '$emp' AND date = '$date'";
			$query = $conn->query($sql);

			if($query->num_rows > 0){
				$_SESSION['error'] = 'Employee attendance for the day exist';
			}
			else{
				//get the schedule id
				$sched = $row['schedule_id'];
				$sql = "SELECT * FROM schedules WHERE id = '$sched'";
				$squery = $conn->query($sql);
				$scherow = $squery->fetch_assoc();
				//for status 0=late, 1=ontime
				$logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;				
				$sql = "INSERT INTO attendance (employee_id, date, time_in, time_out, status) VALUES ('$emp', '$date', '$time_in', '$time_out', '$logstatus')";
				
				//check if attendance was successfully inserted
				if($conn->query($sql)){
					$_SESSION['success'] = 'Attendance added successfully';
					$id = $conn->insert_id;

					$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
					$query = $conn->query($sql);
					$srow = $query->fetch_assoc();

					if($srow['time_in'] > $time_in){
						$time_in = $srow['time_in'];
					}

					if($srow['time_out'] < $time_out){
						$time_out = $srow['time_out'];
					}

					$time_in = new DateTime($time_in);
					$time_out = new DateTime($time_out);
					$interval = $time_in->diff($time_out);
					$hrs = $interval->format('%h');
					$mins = $interval->format('%i');
					$mins = $mins/60;
					$int = $hrs + $mins;
					if($int > 4){
						$int = $int - 1;
					}

					//update the attendance table
					$sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '$id'";
					$conn->query($sql);

				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: attendance?range='.$range_from."-".$range_to);

?>