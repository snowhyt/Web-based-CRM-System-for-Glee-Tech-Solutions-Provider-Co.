<?php
    include 'session.php';	 

    if(isset($_POST['update_request']))
    {   
       $customer_notes = $_POST["edit_notes"];
       $request_id = $_POST['request_id'];
        
       $sql = $conn->prepare("UPDATE requests SET customer_notes=? WHERE request_id=?");
       $sql->bind_param("si",$customer_notes, $request_id);

       if ($sql->execute()) {           
            $_SESSION['success']='Service Request Notes has been updated.';
       }
       else{
            $_SESSION['error'] = $conn->error;
       }
        
        $sql->close();
    }

    header('location: home');

?>