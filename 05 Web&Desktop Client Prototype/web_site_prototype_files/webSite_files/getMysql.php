<?php
	//file to get access into musql databases using the login file where name of database
	//is specified 
	require_once 'login.php';
	$db_server = mysql_connect($db_hostname, $db_username, $db_password);
	
	//in case there exist any problem with the connection get out letting know why
	if(!$db_server) die("Unable to connect to MySQL: ".mysql_error());
	
	//if connection is OK, then open the database needed
	mysql_select_db($db_database) or die("Unable to connect to database: ".mysql_error());
	
	
	function bringTable($tableName)
	{ 

		//defining each table depending on the input
		switch($tableName)
		{
		case "PROPERTIES":
			echo 	"<table><tr> <th>PROPERTY TYPE</th><th>PROPERTY ADDRESS</th><th>		                         CITY</th><th>STATE</th><th>ZIP CODE</th><th>PROPERTY PRICE</th>
						</tr>";
						
			$query = "SELECT P_TYPE, P_STREET, CITY, STATE, ZIP_CODE, ASKING_PRICE 
				  	  FROM $tableName";
		
		
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";										
			break;	
			
		case "BRANCH_OFFICES":
			echo 	"<table><tr> <th>BRANCH NAME</th><th>PO BOX</th><th>PHONE</th>	
					</tr>";
						
			$query = "SELECT BRANCH_NAME, POBOX_NUM, PHONE_NUM 
				      FROM $tableName";	
		
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";				  					
			break;	
			
		case "SALES_AGENTS":
			echo 	"<table><tr><th>NAME</th><th>SURNAME</th><th>CELLPHONE</th>                     <th>BRANCH NAME</th>
				     </tr>";
					 
			$query = "SELECT FNAME, LNAME, HOME_PHONE_NUM, BRANCH_NAME
				      FROM $tableName";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}											
			echo	"</table>";					 			
			break;		
		}
		
	}
	//function to display the filter format according to the table selected
	function bringFormat($tName)
	{

		switch($tName)
		{
			case "PROPERTIES":  //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
echo <<<_END
<form  method="post" action="dbhome.php"><pre class= "style1">
Zip code  <input type="text" name="zip"  /> *
Mx Price  <input type="text" name="prc"  /> *
      Type  <input type="text" name="tp"  /> *
                <input  type="submit" value="Filter" />
</pre></form>			
_END;
			
			//once the botton is clicked 
			//default values for the 3 constraints
			if(isset($_POST['zip'])) $userZip = mysql_fix_string($_POST['zip']);
			else $userZip = 'ZIP_CODE';
			
			if(isset($_POST['prc'])) $userPrice = mysql_fix_string($_POST['prc']);
			else $userPrice = 900000;
			
			if(isset($_POST['tp'])) $userType = mysql_fix_string($_POST['tp']);
			else $userType = 'Single Family';				
			
			//now constructing the table including the constraints
			echo 	"<br/>Filtering $tName<br/><br/>";
			echo 	"<table><tr> <th>PROPERTY TYPE</th><th>PROPERTY ADDRESS</th><th>		                         CITY</th><th>STATE</th><th>ZIP CODE</th><th>PROPERTY PRICE</th>
						</tr>";
									
			$query = "SELECT P_TYPE, P_STREET, CITY, STATE, ZIP_CODE, ASKING_PRICE 
				  	  FROM $tName
					  WHERE ZIP_CODE = $userZip
					  AND  ASKING_PRICE <= $userPrice
					  AND  P_TYPE = '$userType'";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";					
			break;
			
			case "SALES_AGENTS":
echo <<<_END
<form  method="post" action="agents.php"><pre class= "style1">
     Last Name  <input type="text" name="agName" /> or
            Phone  <input type="text" name="agPh" /> or
Branch Name  <input type="text" name="agBch" />
                        <input  type="submit" value="Filter"/>
</pre></form>			
_END;
			//once the botton is clicked 
			//default values for the 3 constraints
			if(isset($_POST['agName'])) $userLn = mysql_fix_string($_POST['agName']);
			else $userLn = 'Smith';
			
			if(isset($_POST['agPh'])) $userPh = mysql_fix_string($_POST['agPh']);
			else $userPh = '433-1010';
			
			if(isset($_POST['agBch'])) $userBch = mysql_fix_string($_POST['agBch']);
			else $userBch = 'Williamsburg';				
			
			//now constructing the table including the constraints
			echo 	"<br/>Filtering $tName<br/><br/>";
			echo 	"<table><tr><th>NAME</th><th>SURNAME</th><th>CELLPHONE</th>                     <th>BRANCH NAME</th>
				     </tr>";
					 
			$query = "SELECT FNAME, LNAME, HOME_PHONE_NUM, BRANCH_NAME
				      FROM $tName
					  WHERE LNAME = '$userLn'
					  OR  HOME_PHONE_NUM = '$userPh'
					  OR  BRANCH_NAME = '$userBch'";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";				
				
				break;
			case "BRANCH_OFFICES":
echo <<<_END
<form  method="post" action="branches.php" class= "style1">
Branch Name  <select name="bran" size="1" class= "style1"/>
<option value="Williamsburg">Williamsburg</option>
<option value="Elkton">Elkton</option>
<option value="Bridgewater">Bridgewater</option>
<input  type="submit" value="Filter"/>
</form>			
_END;
			//once the botton is clicked	
			if(isset($_POST['bran'])) $userBranch = $_POST['bran'];
			else $userBranch = 'Williamsburg';				
			
			//now constructing the table including the constraints
			echo 	"<br/><br/>Filtering $tName<br/><br/>";
			echo 	"<table><tr> <th>BRANCH NAME</th><th>PO BOX</th><th>PHONE</th>	
					</tr>";
						
			$query = "SELECT BRANCH_NAME, POBOX_NUM, PHONE_NUM 
				      FROM $tName
					  WHERE BRANCH_NAME = '$userBranch'";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";				
				
				break;
		}
	}
	/*function to sanitize user inputs from open forms*/
	function mysql_fix_string($string)
	{
		if(get_magic_quotes_gpc()) $string = stripslashes($string);
		return mysql_real_escape_string($string);
	}
	/*function to display the special query joining sales_ag, sellers and properties*/
	function bringTable_Q1()
	{
		//now constructing the special table including the constraints
			echo 	"<table><tr><th>AGENT ID</th><th>SELLER NAME</th><th>PROPERTY STREET		  					 </th><th>CITY</th><th>STATE</th><th>PRICE</th>
				     </tr>";
					 
			$query =   "SELECT 	sa.agent_id, s_name, p_street, p.city, p.state, 			 								asking_price
						FROM 	SALES_AGENTS sa, SELLERS s, PROPERTIES p
						WHERE	sa.agent_id = s.agent_id
						AND 	s.seller_id = p.seller_id";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";
	}
	/*function to display sales_agents table with agent_id input using GLOBAL id*/
	function bringTable_SA($a_id)
	{
			echo 	"<br/><table><tr><th>NAME</th><th>SURNAME</th><th>CELLPHONE</th>                     <th>BRANCH NAME</th>
				     </tr>";
			$query = "SELECT FNAME, LNAME, HOME_PHONE_NUM, BRANCH_NAME 
				      FROM SALES_AGENTS
					  WHERE AGENT_ID = $a_id";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}											
			echo	"</table>";
	}
	/*function to display a specific query and a filter using an agent_id */
	function bringFormat_id()
	{
echo <<<_END
<form  method="post" action="internal.php">
Agent ID <input type="text" name="a_id" />
<input  type="submit" value="Filter"/>
</form><br/><br/>		
_END;
			//once the botton is clicked 
			//default values for the 3 constraints
			if(isset($_POST['a_id'])) $userId = mysql_fix_string($_POST['a_id']);
			else $userId = 10;			
						
			//now constructing the special table including the constraints
			echo 	"<table><tr><th>AGENT ID</th><th>SELLER NAME</th><th>PROPERTY STREET		  					 </th><th>CITY</th><th>STATE</th><th>PRICE</th>
				     </tr>";
					 
			$query =   "SELECT 	sa.agent_id, s_name, p_street, p.city, p.state, 			 								asking_price
						FROM 	SALES_AGENTS sa, SELLERS s, PROPERTIES p
						WHERE	sa.agent_id = s.agent_id
						AND 	s.seller_id = p.seller_id
						AND		sa.agent_id = $userId";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";	
	}
	/*to display tables in system administration facility*///$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
	function bringTableFacty($tableName)
	{ 

		//defining each table depending on the input adding more columns for the tables
		switch($tableName)
		{
		case "PROPERTIES":
			echo 	"<table><tr> <th>LIST</th><th>TYPE</th><th>ADDRESS</th><th>		                         CITY</th><th>STE</th><th>ZIP C.</th><th>PRICE</th>
						 <th>SELLER</th><th>LISTED</th>
						</tr>";
						
			$query = "SELECT LIST_NUM,P_TYPE, P_STREET, CITY, STATE, ZIP_CODE, 			 			 					  ASKING_PRICE, SELLER_ID, LIST_ON 
				  	  FROM $tableName";
		
		
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";										
			break;	
			
		case "BRANCH_OFFICES":
			echo 	"<table><tr> <th>BRANCH NAME</th><th>PO BOX</th><th>PHONE</th>
				                 <th>AGENT ID</th>	
					        </tr>";
						
			$query = "SELECT BRANCH_NAME, POBOX_NUM, PHONE_NUM, AGENT_ID 
				      FROM $tableName";	
		
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";				  					
			break;	
			
		case "SALES_AGENTS":
			echo 	"<table><tr><th>ID</th><th>NAME</th><th>SURNAME</th>
			                    <th>PHONE</th><th>BRANCH NAME</th>
				     </tr>";
					 
			$query = "SELECT AGENT_ID, FNAME, LNAME, HOME_PHONE_NUM, BRANCH_NAME
				      FROM $tableName";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}											
			echo	"</table>";					 			
			break;		
		}
		
	}
	/*function to display the record in system admin facility*/
	function chekRecord($tName)
	{

		switch($tName)
		{
			case "PROPERTIES":
echo <<<_END
<form  method="post" action="internalMgr.php"><pre class= "style1">
List Number <input type="text" name="lnum"  />
                     <input  type="submit" value="See Record" />
</pre></form>			
_END;
			
			//once the botton is clicked 
			//default values for the 3 constraints
			if(isset($_POST['lnum'])) $userLnum = mysql_fix_string($_POST['lnum']);
			else $userLnum = '0';
			
			//now constructing the table including the constraints
			echo 	"<br/>Showing Record Table $tName<br/><br/>";
			echo 	"<table><tr><th>LIST</th><th>TYPE</th><th>ADDRESS</th><th>		                         CITY</th><th>ST.</th><th>ZIP C.</th><th>PRICE</th>
						</tr>";
									
			$query = "SELECT LIST_NUM,P_TYPE, P_STREET, CITY, STATE, ZIP_CODE, 			 		 					  ASKING_PRICE 
				  	  FROM $tName
					  WHERE LIST_NUM = $userLnum";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";					
			break;
			
			case "SALES_AGENTS":
echo <<<_END
<form  method="post" action="intMgrAgents.php"><pre class= "style1">
AGENT ID <input type="text" name="agID" />
                    <input  type="submit" value="See Record"/>
</pre></form>			
_END;
			//once the botton is clicked 
			//default values for the 3 constraints
			if(isset($_POST['agID'])) $userAgId = mysql_fix_string($_POST['agID']);
			else $userAgId = '';
						
			
			//now constructing the table including the constraints
			echo 	"<br/>Showing Record Table $tName<br/><br/>";
			echo 	"<table><tr><th>ID</th><th>NAME</th><th>SURNAME</th><th>PHONE</th>                     <th>BRANCH NAME</th>
				     </tr>";
					 
			$query = "SELECT AGENT_ID, FNAME, LNAME, HOME_PHONE_NUM, BRANCH_NAME
				      FROM $tName
					  WHERE AGENT_ID = '$userAgId'";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";				
				
				break;
			case "BRANCH_OFFICES":
echo <<<_END
<form  method="post" action="intMgrBranch.php" class= "style1">
Branch Name  <select name="bran" size="1" class= "style1"/>
<option value="Williamsburg">Williamsburg</option>
<option value="Elkton">Elkton</option>
<option value="Bridgewater">Bridgewater</option>
<input  type="submit" value="Filter"/>
</form>			
_END;
			//once the botton is clicked	
			if(isset($_POST['bran'])) $userBranch = $_POST['bran'];
			else $userBranch = 'Williamsburg';				
			
			//now constructing the table including the constraints
			echo 	"<br/><br/>Filtering $tName<br/><br/>";
			echo 	"<table><tr> <th>BRANCH NAME</th><th>PO BOX</th><th>PHONE</th>	
								 <th>AGENT ID</th>
					</tr>";
						
			$query = "SELECT BRANCH_NAME, POBOX_NUM, PHONE_NUM, AGENT_ID
				      FROM $tName
					  WHERE BRANCH_NAME = '$userBranch'";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			$cols= mysql_num_fields($results);
			
			//now organizing the data of the table asked
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				echo "<tr>";
				for ($k = 0 ; $k < $cols ; ++$k) echo "<td>$row[$k]</td>";
				echo "</tr>";
			}				
										
			echo	"</table>";				
				
				break;
		}
	}
	/*function to display format to add record to selected table*/	
	function addRecordFmt($tName)
	{

		switch($tName)
		{
			case "PROPERTIES":
echo <<<_END
<form  method="post" action="internalMgr.php">
<pre class= "style1">
List Number <input type="text" name="list" /> *
            Type <input type="text" name="tpe"  /> *
           Street <input type="text" name="street"  /> *
             City <input type="text" name="cty"  /> *
            State <input type="text" name="ste" /> *
      Zip code <input type="text" name="zipC" /> *
Asking Price <input type="text" name="prce" /> *
     Seller ID <input type="text" name="selID" /> * 
 Date Listed <input type="text" name="lstON" />yyyy-mm-dd *
                    <input  type="submit" value="Insert"/>
</pre>
</form>			
_END;
			
			//Inserting the record
			if(	isset($_POST['list']) 	&&
				isset($_POST['tpe']) 	&&
				isset($_POST['street']) &&
				isset($_POST['cty']) 	&&
				isset($_POST['ste']) 	&&
				isset($_POST['zipC']) 	&&
				isset($_POST['prce']) 	&&
				isset($_POST['selID'])  &&
				isset($_POST['lstON']))
			{
				$userLnum = get_post('list');
				$userType = get_post('tpe');
				$userSt = get_post('street');
				$userCty = get_post('cty');
				$userSte = get_post('ste');
				$userZip = get_post('zipC');
				$userPrc = get_post('prce');
				$userSid = get_post('selID');
				$userLon = get_post('lstON');
			
				$query = "INSERT INTO $tName VALUES".
				  	  	 "('$userLnum', '$userType', '$userSt', '$userCty',       	                         '$userSte', '$userZip', '$userPrc', '$userSid', '$userLon')";
				//triggering the query
				$results = mysql_query($query);
				//checking if access is given
				if(!$results) die("Database access failed: ".mysql_error());
				echo "<br/>Your INSERT was successful!";
				$_POST['list']='';$_POST['tpe']='';$_POST['street']='';$_POST['cty']='';
				$_POST['ste']='';$_POST['zipC']='';$_POST['prce']='';$_POST['selID']='';
				$_POST['lstON']='';				
			}
														
			break;
			
			case "SALES_AGENTS":
echo <<<_END
<form  method="post" action="intMgrAgents.php">
<pre class= "style1">
         Agent ID <input type="text" name="agentId" /> *
      First Name <input type="text" name="frtN"  /> *
       Last Name <input type="text" name="LstN"  /> *
   Ext. Number <input type="text" name="exN"  /> *	   
Phone Number <input type="text" name="Ph"  /> *
   Branch Name <input type="text" name="BranchN"  /> *
                          <input  type="submit" value="Insert"/>
</pre>
</form>			
_END;
			
			//Inserting the record
			if(	isset($_POST['agentId']) &&
				isset($_POST['frtN']) 	 &&
				isset($_POST['LstN']) 	 &&
				isset($_POST['exN']) 	 &&
				isset($_POST['Ph'])		 &&
				isset($_POST['BranchN']))
			{
				$userAgtId = get_post('agentId');
				$userFn = get_post('frtN');
				$userLn = get_post('LstN');
				$userExN = get_post('exN');
				$userPn = get_post('Ph');
				$userBrN = get_post('BranchN');
			
				$query = "INSERT INTO $tName VALUES".
				  	  	 "('$userAgtId', '$userFn', '$userLn', '$userExN','$userPn', 			 						   '$userBrN')";
				//triggering the query
				$results = mysql_query($query);
				//checking if access is given
				if(!$results) die("Database access failed: ".mysql_error());
				echo "<br/>Your INSERT was successful!";
				$_POST['agentId'] = '';$_POST['frtN']='';$_POST['LstN']='';$_POST['Ph']=''; 				
			}			
				
				break;
			case "BRANCH_OFFICES":
echo <<<_END
<form  method="post" action="intMgrBranch.php">
<pre class= "style1">
      Branch Name <input type="text" name="bName" />
POBOX Number <input type="text" name="pobx"  />
    Phone Number <input type="text" name="phN"  />
             Agent ID <input type="text" name="aID"  />
                             <input  type="submit" value="Insert"/>
</pre>
</form>			
_END;
			
			//Inserting the record
			if(	isset($_POST['bName']) 	&&
				isset($_POST['pobx']) 	&&
				isset($_POST['phN']) 	&&
				isset($_POST['aID']))
			{
				$userBname = get_post('bName');
				$userPobx = get_post('pobx');
				$userPhn = get_post('phN');
				$userAid = get_post('aID');
			
				$query = "INSERT INTO $tName VALUES".
				  	  	 "('$userBname', '$userPobx', '$userPhn', '$userAid')";
				//triggering the query
				$results = mysql_query($query);
				//checking if access is given
				if(!$results) die("Database access failed: ".mysql_error());
				echo "<br/>Record INSERTED!";
				$_POST['bName'] = '';$_POST['pobx']='';$_POST['phN']='';$_POST['aID']=''; 				
			}
														
			break;
		}
	}
	/*function to delete a record using table name input*/
	function deleteRecordFmt($tName)
	{
		switch($tName)
		{
			case "PROPERTIES":
echo <<<_END
<form  method="post" action="internalMgr.php"><pre class= "style1">
List Number <input type="text" name="lisNum"  />
                     <input  type="submit" value="See Record to Delete" />
</pre></form>			
_END;
			
			//once the botton is clicked 
			//default values for the 3 constraints
			if(isset($_POST['lisNum'])) $userLisn = mysql_fix_string($_POST['lisNum']);
			else $userLisn = '0';
			
			//now oranizing data to display
			echo 	"<br/>Showing Record Table $tName<br/><br/>";
			$query = "SELECT LIST_NUM,P_TYPE, P_STREET, CITY, STATE, ZIP_CODE, 			 		 					  ASKING_PRICE 
				  	  FROM $tName
					  WHERE LIST_NUM = '$userLisn'";	
			
			$results = mysql_query($query);
			//checking if access is given
			if(!$results) die("Database access failed: ".mysql_error());
			//if given then..
			$rows = mysql_num_rows($results);
			
			//now organizing the data for the record to delete
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$row = mysql_fetch_row($results);
				
				/*displaying the data of the record*/
echo <<<_END
<pre class= "style1" >
List Number    $row[0]
Type                $row[1]
Street    		$row[2]
City    		$row[3]
State			$row[4]
Zip Code    	$row[5]
Asking Price	$row[6]
</pre>
_END;

/*invisible form to delete the record showed before*/
echo <<<_END
<form  method="post" action="internalMgr.php">
<p class= "style1">
<input type="hidden" name="delete" value="yes" />
<input type="hidden" name="lstNm"  value='$row[0]' />
<pre>
	      <input  type="submit" value="Delete Record" />
</pre>
</p>
</form>
_END;
			}
			/*now deleting the record*/
			if(isset($_POST['delete']) && isset($_POST['lstNm']))
			{
				$delList = get_post('lstNm');
			
				$query2 = "DELETE FROM $tName 
						  WHERE LIST_NUM = '$delList'";
						  
				$results2 = mysql_query($query2);
				//checking if access is given
				if(!$results2) die("Database access failed: ".mysql_error());
				echo "<br/>Record DELETED!";				
			}
									
			break;
			
			case "SALES_AGENTS":

			
			break;
			
			case "BRANCH_OFFICES":
			
			break;
		}		
	}
	
	/*function to sanitize the user inputs*/
	function get_post($var)
	{
		return mysql_real_escape_string($_POST[$var]);
	}	
?>