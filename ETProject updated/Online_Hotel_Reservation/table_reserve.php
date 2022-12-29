<?php
	require_once 'admin/connect.php';
	if(ISSET($_POST['add_guest'])){
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$noofadults = $_POST['noofadults'];
        $noofchildren = $_POST['noofchildren'];
		$contactno = $_POST['contactno'];
        // $tguest_id = $_POST['tguest_id'];
		$date = $_POST['date'];
		$conn->query("INSERT INTO `tableguest` (firstname, middlename, lastname, noofadults,noofchildren, contactno,date) VALUES('$firstname', '$middlename', '$lastname', '$noofadults','$noofchildren', '$contactno', '$date')") or die(mysqli_error());
		$query = $conn->query("SELECT * FROM `tableguest` WHERE `firstname` = '$firstname' && `lastname` = '$lastname' && `contactno` = '$contactno'") or die(mysqli_error());
		$fetch = $query->fetch_array();
        $query2 = $conn->query("SELECT * FROM `tablereservation` WHERE `date` = '$date' &&   `status` = 'Pending'") or die(mysqli_error());
		// $fetch = $query2->fetch_array();
         $row = $query2->num_rows;
        if($date < date("Y-m-d", strtotime('+8 HOURS'))){	
            echo "<script>alert('Must be present date')</script>";
        }else{
            if($row > 0){
                echo "<div class = 'col-md-4'>";
                            
                        $q_date = $conn->query("SELECT * FROM `tablereservation` WHERE `status` = 'Pending'") or die(mysqli_error());
                        while($f_date = $q_date->fetch_array()){
                            echo "<ul>
                                    <li>	
                                        <label class = 'alert-danger'>".date("M d, Y", strtotime($f_date['date']."+8HOURS"))."</label>	
                                    </li>
                                </ul>";
                        }
                    "</div>";
            }else{	
                    if($tguest_id = $fetch['tguest_id']){
                        $table_id = $_REQUEST['table_id'];
                        $conn->query("INSERT INTO `tablereservation`(tguest_id, table_id, status, date) VALUES('$tguest_id', '$table_id', 'Pending', '$date')") or die(mysqli_error());
                        header("location:reply_reserve.php");
                    }else{
                        echo "<script>alert('Error Javascript Exception!')</script>";
                    }
            }	
        }	
}	
?>