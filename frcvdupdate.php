
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$branchid= $semester= $amount  = "";
$branchname_err= $input_branchname= $semester_err = $input_semester= $amount_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
 // Validate branchname
   echo "here";

  // Validate AMOUNT
    $input_amount = trim($_POST["amount"]);
	$branchid = trim($_POST["branchid"]);
	$semester = trim($_POST["semester"]);
    if(empty($input_amount))
	{
        $amount_err = "Please enter the  amount.";     
    } elseif(!ctype_digit($input_amount))
	{
        $amount_err = "Please enter a amount value.";
    } else
	{
        $amount = $input_amount;
    }
	
   // Check input errors before inserting in database
    if(empty ($branchname_err) && empty($semester_err) && empty($amount_err))
	{
        // Prepare an insert statement
        $sql = "INSERT INTO fees (branchid, semester, feesamount) VALUES (?,?,?)";
 
        if($stmt = $mysqli->prepare($sql))
		{
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("iii", $param_branchname, $param_semester, $param_amount);
            
            // Set parameters
			$param_branchname = $branchid;
			$param_semester = $semester;
			$param_amount = $amount;            
            
            // Attempt to execute the prepared statement
            if($stmt->execute())
			{
                // Records created successfully. Redirect to landing page
                header("location:fees.php");
                exit();
            } else
			{
                echo "Something went wrong. Please try again later.";
            }
        
         
        // Close statement
        $stmt->close();
    	}
    }
    // Close connection
    $mysqli->close();
}
?>
<strong></strong>
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style7 {font-size: x-large; color: #FFFFFF; }
.style11 {font-weight: bold; font-size: xx-large; color: #FF0000;}
.style13 {color: #990033}
.style14 {
	font-size: x-large;
	color: #FF0000;
}
.style15 {font-size: xx-large}
-->
</style>
</head>

<body>
<table width="1300" border="15" cellpadding="20">
  <tr>
    <td colspan="2" bgcolor="#FF9900"><div align="center" class="style11 style13">STUDENT ACADEMIC FEES </div></td>
  </tr>
  <tr>
    <td width="201" bgcolor="#0033FF"><div align="center" class="style7">FEES</div></td>
    <td width="999" rowspan="7" align="center" bgcolor="#00FFFF">
	
	<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class="style15">SEMESTER FEES </h2>
                    </div>
                    <p class="style14">Please fill this form and submit semesterfees to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					
					<div class="form-group <?php echo (!empty($branchname_err)) ? 'has-error' : ''; ?>">
                            <label><span class="style17">BranchName</span></label>
                            <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM branch";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0)
						{
						echo "<select name='branchid'>	
					          <option selected='selected'>Select Branch</option>";
						while($row = $result->fetch_array())
						{ 
							echo "<option value =". $row['branchid'].">".$row['branchname']."</option>";
							
						}
						echo "</select>";
                              
                            // Free result set
                            $result->free();
                        } 
						else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    $mysqli->close();
					
                    ?>
                            <span class="help-block"><?php echo $branchname_err;?></span>
                        </div>
						
					  <div class="form-group <?php echo (!empty($semester_err)) ? 'has-error' : ''; ?>">
                            <label></label>
				        <label>Semester
					        <select name="semester">
                              <option selected="selected">Select Semester</option>
                              <option value="1">1st Semester</option>
                              <option value="2">2nd Semester</option>
                              <option value="3">3rd Semester</option>
                              <option value="4">4th Semester</option>
                              <option value="5">5thSemester</option>
                              <option value="6">6th Semester</option>
                              <option value="7">7th Semester</option>
                              <option value="8">8th Semester</option>
                            </select>
</label>
					  </div>
						
                      <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                            <label>                            Amount</label>
                            <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
                          <span class="help-block"><?php echo $amount_err;?></span>
                      </div>
						  
						  <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                            <label>                            Amount</label>
                            <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
                          <span class="help-block"><?php echo $amount_err;?></span>
                      </div>

					
                     
                      
                        <input name="submit" type="submit" class="btn btn-primary" value="Submit" />
                        <a href="fees.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
	</td>
  </tr>
  <tr>
    <td bgcolor="#009933"><div align="center" class="style7"></div></td>
  </tr>
  <tr>
    <td bgcolor="#CC00CC"><div align="center" class="style7"></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF6699"><div align="center" class="style7"></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0033"><div align="center" class="style7"></div></td>
  </tr>
  <tr>
    <td height="61"  bgcolor="#6600CC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00">
	
	</td>
  </tr>
</table>
</body>
</html>