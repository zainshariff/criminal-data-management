<?php
	session_start();
    include_once "dbh.php";
	if(isset($_POST["submitted"]))
	{
		$posname = $_POST["psname"];
		$psid = $_POST["pscode"];  

		$posname = stripcslashes($posname);  
		$psid = stripcslashes($psid);  
		$posname = mysqli_real_escape_string($conn, $posname);  
		$psid = mysqli_real_escape_string($conn, $psid);  
        
        $sql = "SELECT * FROM `station` where STN_NAME= '$posname' ; ";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_assoc($result);  
        $count1 =mysqli_num_rows($result);
		
		
		if($count1 == 1)
		{  
            echo "<script>
            window.location.href='aps.php';
            alert('A Station already exists in the specified location!!! ');
            </script>";
            exit(); 			
		} 

        $sql = "INSERT INTO `station`(`STN_ID`, `STN_NAME`) VALUES ($psid,'$posname')";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>
            window.location.href='admindash.php';
            alert('The record has been inserted successfully!!! ');
            </script>";
            exit();
        }
        else{
            echo "<script>
            window.location.href='aps.php';
            alert('Station ID already exists!!! ');
            </script>";
            exit();
            // $message = "ERROR: Could not execute $sql. " . mysqli_error($conn);
            //     echo '<script language="Javascript" type="text/javascript">';
            //     echo     'alert('. json_encode($message) .');';
            //     echo '</script>';
            //     exit();
        }
    }
    else {
        echo "<script>
            window.location.href='aps.php';
            alert('There was a error!!! ');
            </script>";
            exit();
    }
?>