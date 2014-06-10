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
	global $agentID;	
    ?>
    <div id="wrapper">
    	<div id="cont">
        	<p class="style6"><br/>
            	AGENTS WORKING AREA
            </p>

            <div id="holder">  
            	<div id="desc2" class="style5">                
                    <?php 
						/*displaying special query involving 3 different tables using agent_id*/					
						echo "Displaying AGENTS DATA<br/><br/>";
						bringTable_Q1();
					?>
                                         
                </div>                
            </div>
            <div id="holder">
				<div id="filter" class="style5"> 
                	 <b class="style1">Filter your search</b><br/> 
                    <?php
						/*displaying format and some default data*/
						bringFormat_id();
					?>                    
                 </div>   
            </div>
            <div id="holder">
            	<div id="filter" class="style5"> 
                    <form class= "style1" method="post" action="internal.php">
                        <b>Agent Information</b><br/> 
                        Agent ID <input type="text" name="aid" />
                        <input  type="submit" value="Search" />
                    </form><br/>
                <?php
					if(isset($_POST['aid'])) $agentID = mysql_fix_string($_POST['aid']);
					else $agentID = 0;
					echo "<br/>Displaying Information Agent: $agentID<br/>";
					bringTable_SA($agentID)
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
