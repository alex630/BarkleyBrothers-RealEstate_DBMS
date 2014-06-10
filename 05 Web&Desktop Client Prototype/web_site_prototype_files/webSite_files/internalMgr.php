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
        	<p class="style6"><br/>
            	SYSTEM ADMINISTRATION FACILITY
            </p><br/><br/>
        	<div id="holder">
            	<div id="desc1"> 
                    <form  method="post" action="internalMgr.php" class= "style1">
                   		<b>Start your search</b><br/>                    
						Select Area <select name="tbl" size="1" class= "style1"/>
						<option value="PROPERTIES">Properties</option>
						<option value="BRANCH_OFFICES">Offices</option>
                        <option value="SALES_AGENTS">Agents</option> 
						<input  type="submit" value="Show Data"/>
					</form>	
                    <br/>   
                </div>
            </div>
            <div id="holder">  
            	<div id="desc2" class="style5">                
                	<?php
						if(isset($_POST['tbl'])) $tblName = $_POST['tbl'];
						else $tblName = 'PROPERTIES'; /*change for the table case*/
						echo "Displaying $tblName<br/><br/>";
						bringTableFacty($tblName);	
					?>                     
                </div>
            </div> 
            <div id="holder">
				<div id="filter" class="style5"> 
                	 <b class="style1">Check a Record</b><br/> 
                    <?php
						chekRecord($tblName);	
					?>                    
                </div>   
            </div>            
            <div id="holder">
				<div id="filter" class="style5"> 
                	 <b class="style1">Add a Record</b>&nbsp; (*) Reg. fields<br/> 
                    <?php
						addRecordFmt($tblName);
					?>                   
                </div>   
            </div> 
                        <div id="holder">
				<div id="filter" class="style5"> 
                	 <b class="style1">Delete a Record</b><br/> 
                    <?php
						deleteRecordFmt($tblName);
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
