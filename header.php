<?php
	session_start();
	include'connection.php';
	$username = $_SESSION["username"];

	$sql = "SELECT agent_id FROM agent WHERE agent_id = '$username'";
    $query=mysqli_query($conn,$sql) or die (mysqli_error($conn));
	$result = mysqli_fetch_assoc($query);
    $row=mysqli_num_rows($query);
	if ($row > 0) {
     
    }
    else {
	header("Location: clientHome.php");
   }
	
?>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
	
           
            <div class="header-right">
			
                 <a href="<?php echo "logout.php" ?>" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>

            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                

            </div>
		

        </nav>
		 
		  
	
   