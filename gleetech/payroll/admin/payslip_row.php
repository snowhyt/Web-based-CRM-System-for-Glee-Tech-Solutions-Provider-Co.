<?php 
	include 'includes/session.php';
    if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE employees.employee_id='$id' ORDER BY attendance.date DESC, attendance.time_in DESC";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>