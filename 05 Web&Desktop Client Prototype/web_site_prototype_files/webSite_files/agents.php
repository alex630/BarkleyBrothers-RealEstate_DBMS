<!DOCTYPE html >

<html>
<head>
    <meta charset="utf-8" >
    <title>BLE Solutions | db prototype</title>
    <link href='http://fonts.googleapis.com/css?family=Sofadi+One' rel='stylesheet' type='text/css'>
    <link rel="icon" href="images/logo-icon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="images/logo-icon.ico" type="image/x-icon" />    
    <link href="dbstyle.css" rel="stylesheet" type="text/css" />
    
</head>

<body>
	<?php
    include_once 'dbheader.php';
	//accessing databases area in mySql
	require_once 'getMysql.php';
	global $tblName;	
    ?>
    <div id="wrapper">
        <div id="cont">
        	<div id= "holder">
            	<div id="pic1">
            		<img src="images/house.jpg" alt="The house" width="100%" height="100%" />
            	</div>
                <div id="desc1" class="style2">
                	Whether you're looking for a quick and easy way to find a home or just casually browse 					homes for sale, you've come to the right place.
                </div>
            </div>
        	<div id="holder">
            	<div id="desc1"> 
                    <form class= "style1" method="post" action="agents.php">
                    	<b>Start your search</b><br/>
                        
                    	<input type="radio" name="myTb" value= "PROPERTIES" /> Properties<br/>
                        <input  type="radio" name="myTb" value="BRANCH_OFFICES"/> Branch Offices<br/>
                        <input  type="radio" name="myTb" value="SALES_AGENTS" /> Sales Agents<br/>
                        <input  type="submit" value="Display"/>    
                    </form>
                    <br/>   
                </div>
             </div>
             <div id="holder">  
            	<div id="desc2" class="style5">                
                    <?php
						if(isset($_POST['myTb'])) $tblName = $_POST['myTb'];
						else $tblName = 'SALES_AGENTS'; /*change for the table case*/
						echo "Displaying $tblName<br/><br/>";
						bringTable($tblName);
						
					?>                     
                </div>
            </div>
            <div id="holder">
				<div id="filter" class="style5"> 
                	 <b class="style1">Filter your search</b><br/> 
                    <?php	
						bringFormat($tblName);	
					?>                    
                 </div>   
            </div>        
                    
            	
		</div>
 	</div>
    <?php
    include_once 'footer.php'; 
    ?>    
    
</body>
</html>

