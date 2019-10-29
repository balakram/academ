<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$branchid= $semester=$stdreg=$stdroll= $stdname =$address =$stdph =$email = "";
$branchname_err= $input_branchname= $semester_err = $input_semester=$stdreg_err=$input_stdreg =$stdroll_err =$input_stdroll= $stdname_err = $input_stdname =$address_err =$input_address  =$stdph_err =$input_stdph =$email_err =$input_email ="";
  
  // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    echo"here";
	 // Validate name
	$branchid = trim($_POST["branchid"]);
    $input_semester = trim($_POST["semester"]);
	$input_stdreg = trim($_POST["stdreg"]);
	$input_stdroll = trim($_POST["stdroll"]);
	$input_stdname= trim($_POST["stdname"]);
    $input_address = trim($_POST["address"]);
	$input_stdph= trim($_POST["stdph"]);
	$input_email = trim($_POST["email"]);
   
	
    // Validate registration
    $input_stdreg = trim($_POST["stdreg"]);
    if(empty($input_stdreg)){
        $stdreg_err = "Please enter reg no.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")))){
        $stdreg_err = "Please enter a valid reg no.";
    } else{
        $stdreg = $input_stdreg;
    }
	
	   // Validate phone
    $input_stdroll = trim($_POST["stdroll"]);
    if(empty($input_stdroll)){
        $stdroll_err = "Please enter the roll number.";     
    } elseif(!ctype_digit($input_stdroll)){
        $stdroll_err = "Please enter a valid roll number.";
    } else{
        $stdroll = $input_stdroll;
    }
	
       // Validate name
    $input_stdname = trim($_POST["stdname"]);
    if(empty($input_stdname)){
        $stdname_err = "Please enter a name.";
    } elseif(!filter_var($input_stdname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $stdname_err = "Please enter a valid name.";
    } else{
        $stdname = $input_stdname;
    }
	
  // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
	
	   // Validate phone
    $input_stdph = trim($_POST["stdph"]);
    if(empty($input_stdph)){
        $stdphe_err = "Please enter the mobile number.";     
    } elseif(!ctype_digit($input_stdph)){
        $stdph_err = "Please enter a valid mobile number.";
    } else{
        $stdphe = $input_stdph;
    }
	
   
    // Check input errors before inserting in database
    if(empty($branchname_err)&& empty($input_branchname)&& empty($semester_err)&& empty($input_semester) &&empty($stdreg_err) && empty($stdroll_err)&& empty($stdname_err )&& empty($address_err )&& empty($stdph_err)&& empty($email_err))
	{
        // Prepare an insert statement
        $sql = "INSERT INTO student(branchid,stdreg, stdroll, stdname, stdaddress, stdph, stdemail
) VALUES (?, ?, ?, ?, ?, ?,?)";
 
        if($stmt = $mysqli->prepare($sql))
		{
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("isisss", $param_branchname, $param_stdreg, $param_stdroll, $param_stdname,$param_address, $param_stdph,$param_email );
            
            // Set parameters
            $param_branchname = $branchid;
            $param_stdreg = $stdreg;
            $param_stdroll= $stdroll;
            $param_stdname= $stdname;
			$param_address= $stdaddress;
			$param_stdph= $stdph;
			$param_email= $stdemail;
            // Attempt to execute the prepared statement
            if($stmt->execute())
			{
                // Records created successfully. Redirect to landing page
                header("location: student.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 <"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style7 {font-size: x-large; color: #FFFFFF; }
.style11 {font-weight: bold; font-size: xx-large; color: #FF0000;}
.style13 {color: #990033}
-->
</style>
</head>

<body>
<table width="1300" border="15" cellpadding="20">
  <tr>
    <td colspan="2" bgcolor="#FF9900"><div align="center" class="style11 style13">STUDENT ACADEMIC FEES </div></td>
  </tr>
  <tr>
    <td width="201" bgcolor="#0033FF"><div align="center" class="style7">STUDENT</div></td>
    <td width="999" rowspan="7" align="center" valign="top" bgcolor="#00FFFF"><body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <div class="page-header">
                        <h2>STUDENT DETAILS </h2>
                  </div>
                    <p>Please fill this form and submit to add student detail to the database.</p>
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
					
				 <div class="form-group <?php echo (!empty($stdreg_err)) ? 'has-error' : ''; ?>">
                   <label>Registration no</label>
                   <input type="text" name="name" class="form-control" value="<?php echo $stdreg; ?>">
                   <span class="help-block"><?php echo $stdreg_err;?></span>
                </div>
				
				 <div class="form-group <?php echo (!empty($stdroll_err)) ? 'has-error' : ''; ?>">
                   <label>Rollno</label>
                   <input type="text" name="name" class="form-control" value="<?php echo $stdroll; ?>">
                   <span class="help-block"><?php echo $stdroll_err;?></span>
                </div>
					
					
                <div class="form-group <?php echo (!empty($stdname_err)) ? 'has-error' : ''; ?>">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $stdname; ?>">
                    <span class="help-block"><?php echo $stdname_err;?></span>
                </div>
                 
				 <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
				 <label>ADDRESS</label>
				 <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                     <span class="help-block"><?php echo $address_err;?></span>
                 </div>
                 
				<div class="form-group <?php echo (!empty($stdph_err)) ? 'has-error' : ''; ?>">
                    <label>PHONE</label>
				  <input type="text" name="phonetxt" class="form-control" value="<?php echo $stdph['phone'];?>" /><span class="help-block"><?php echo $stdph_err;?></span>
				  </div>
				  
				   <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="text" name="emailtxt" class="form-control" value="<?php echo $rs_upd['email'];?> " />
                    <span class="help-block"><?php echo $email_err;?></span>
                </div>
                      <input type="submit" class="btn btn-primary" value="Submit">
                      <a href="menu.php" class="btn btn-default">Cancel</a>
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
    <td height="61"  bgcolor="#6600CC"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00"></td>
  </tr>
</table>
</body>
</html>
