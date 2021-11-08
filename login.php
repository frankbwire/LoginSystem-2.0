<!--== author (c)frankline_bwire ==-->
<!--== @knightlypro ==-->
<!--== (c)Notchcom Solutions Kenya ==-->
<!--== Facebook, Youtube ==-->

<!--== LOGIN IN SYSTEM 2.0 ==-->
<!--== LOGIN USING ONE INTERFACE WITH TWO OR MORE TABLES ==-->
<?php
	session_start();
	include 'connection.php';
	
	
	if(isset($_POST['login'])){
        
        //get form values
        
        $username = $_POST["username"] ?? '';
		$password = $_POST["password"] ?? '';
        
        //CHECK IF USER EXISTS
            
        //CHECK ADMIN TABLE
        $sql0="SELECT * FROM `agent` WHERE agent_id = '$username' LIMIT 1";
        $query0=mysqli_query($conn,$sql0) or die (mysqli_error($conn));
        $result0=mysqli_fetch_assoc($query0);
        $row0=mysqli_num_rows($query0);
            
        //CHECK CLIENT TABLE
        $sqlc="SELECT * FROM `client` WHERE client_id = '$username' LIMIT 1";
        $queryc=mysqli_query($conn,$sqlc) or die (mysqli_error($conn));
        $resultc=mysqli_fetch_assoc($queryc);
        $rowc=mysqli_num_rows($queryc);
         
        if($row0 <=0 and $rowc <= 0){
            
            //USER DOES NOT EXIST
            
            echo "<script type='text/javascript'>alert('User account does not exist. Try again.');
    window.location='index.php';
    </script>";
        }
        else if ($row0 >= 1 or $rowc >= 1){
            
            //LOGIN USERS
            
        $sql="SELECT * FROM `agent` WHERE `agent_id` = '$username';";
        $query=mysqli_query($conn,$sql) or die (mysqli_error($conn));
        $result=mysqli_fetch_assoc($query);
        $row=mysqli_num_rows($query);
        $user=$result["agent_id"] ?? '';
        $pass=$result["agent_password"] ?? '';
        $type=$result["usertype"] ?? '';
            
            //CLIENT LOGIN
            
               if($row <= 0){
                   
                   // CLIENT ROOT
                   
        $sql1="SELECT * FROM `client` WHERE `client_id` = '$username';";
        $query1=mysqli_query($conn,$sql1) or die (mysqli_error($conn));
        $result1=mysqli_fetch_assoc($query1);
        $row1=mysqli_num_rows($query1);
        $user1=$result1["client_id"] ?? '';
        $pass1=$result1["client_password"] ?? '';
        $type1=$result1["usertype"] ?? '';
                   
                   //CHECK PASSWORD MATCH
                   
        if($row1 <= 0){
            
            //CLIENT DOES NOT EXIST
            
            echo "<script type='text/javascript'>alert('Client account does not exist. Try again.');
    window.location='index.php';
    </script>";
        }
                    //CLIENT PASSWORD CHECK
                   
                   else if ($row1 >= 1 and $pass1 !== $password){
                       
                       //CLIENT PASSWORD INCORRECT
                       
                       echo "<script type='text/javascript'>alert('ALERT! Incorrect CLIENT Password. Try again.');
    window.location='index.php';
    </script>";
                   }
                   else if ($row1>= 1 and $pass1 == $password) {
                       
                       //save session id
                       $_SESSION ['username'] = $user1;
                       
                       //redirect to client home page
                       header ("location:clientHome.php");
                       
   /*  echo "<script type='text/javascript'>alert('CLIENT LOGIN SUCCESSFUL');
    window.location='clientHome.php';
    </script>";
    */
                   };
   
        }
            //AGENT LOGIN
            
            else if ($row0 >= 1){
                
                //AGENT ROOT
                
        $sql2="SELECT * FROM `agent` WHERE `agent_id` = '$username';";
        $query2=mysqli_query($conn,$sql2) or die (mysqli_error($conn));
        $result2=mysqli_fetch_assoc($query2);
         $row2=mysqli_num_rows($query2);
        $user2=$result2["agent_id"] ?? '';
        $pass2=$result2["agent_password"] ?? '';
        $type2=$result2["usertype"] ?? '';
                
       //CHECK PASSWORD MATCH
                
        if($row2 <= 0){
            
            //AGENT DOES NOT EXIST
            
    echo "<script type='text/javascript'>alert('Agent account does not exist. Try again.');
    window.location='index.php';
    </script>";
        }
                //AGENT PASSWORD CHECK
                
                else if ($row2 >= 1 and $pass2 != $password){
                    
                    //AGENT PASSWORD INCORECT
                    
                     echo "<script type='text/javascript'>alert('ALERT! Incorrect AGENT Password. Try again.');
    window.location='index.php';
    </script>";
                }
                
                 else if ($row2 >= 1 and $pass2 == $password){
                     
                      //save session id
                       $_SESSION ['username'] = $user2;
                       
                       //redirect to client home page
                       header ("location:Home.php");
    /* echo "<script type='text/javascript'>alert('AGENT LOGIN SUCCESSFUL');
    window.location='Home.php';
    </script>";
    */
                 };
            };
        };
    };
?>
