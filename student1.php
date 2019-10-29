<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$stdregno=$stdname=$stdaddress=$stdphn= "";
$stdregno_err=$stdname_err=$stdaddress_err=$stdphn_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate stdregno
    $input_stdregno = trim($_POST["stdregno"]);
    if(empty($input_name))
	{
        $stdregno_err = "Please enter regestration number";
    }
	 elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/0-9^[a-zA-Z\s]+$/"))))
	 {
        $branch_err = "Please enter a valid regestration number";
    } 
	else
	{
        $stdregno = $input_stdregno;
    }
	
	 // Validate name
    $input_stdname = trim($_POST["stdname"]);
    if(empty($input_name))
	{
        $name_err = "Please enter a name";
    }
	 elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))))
	 {
        $branch_err = "Please enter a valid name.";
    } 
	else
	{
        $stdname = $input_stdname;
    }
    
     // Validate address
    $input_stdaddress = trim($_POST["stdaddress"]);
    if(empty($input_stdaddress)){
        $address_err = "Please enter an address.";     
    } else{
        $stdaddress = $input_stdaddress;
    }
   
    
     // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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






<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 36px;
	color: #330066;
}
.style3 {color: #0000FF}
.style4 {color: #FFFFFF}
.style6 {font-family: "Times New Roman", Times, serif}
-->
</style>
</head>

<body>
<table width="980" height="552" border="1" cellpadding="10" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#663333" ><div align="center" class="style1 style4 style6">STUDENT  ACADEMIC  FEES </div></td>
  </tr>
  <tr>
    <td width="84" bgcolor="#999900"><span class="style4"><a href="branch.php">BRANCH</a></span></td>
    <td width="850" rowspan="5" bgcolor="#00FFFF">
	
	<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 align="center" class="style7"><span class="style4"><span class="style10 style3">STUDENT DETAILS</span></span></h2>
                    </div>
                    <p align="center" class="style8">Please fill this form and submit to add student details to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                             
                         <div class="form-group <?php echo (!empty($sstdregno_err)) ? 'has-error' : ''; ?>">
                            <label>
                          <div align="center">
                            Regestration No.
                              <input type="text" name="stdregno" class="form-control" value="<?php echo $stdregno; ?>" />
                            <span class="help-block"><?php echo $stdregno;?></span>
							</div>
                            </label>
                            <div align="center"></div>
                        </div><br />
                        
						
						   <div class="form-group <?php echo (!empty($stdname_err)) ? 'has-error' : ''; ?>">
                            <label>
                          <div align="center">
                            Name
                              <input type="text" name="stdname" class="form-control" value="<?php echo $stdname; ?>" />
                            <span class="help-block"><?php echo $stdname_err;?></span>
							</div>
                            </label>
                            <div align="center"></div>
                        </div><br />
						
						
						<div class="form-group <?php echo (!empty($stdaddress_err)) ? 'has-error' : ''; ?>">
                            <label>
                            <div align="center">Address
                              <textarea name="stdaddress" class="form-control"><?php echo $stdaddress; ?></textarea>
                            </div>
                            </label>
                            <div align="center"><span class="help-block"><?php echo $stdaddress_err;?></span>                                </div>
						</div><br />
						
						
						
						 <div class="form-group <?php echo (!empty($stdphn_err)) ? 'has-error' : ''; ?>">
                            <label>
                          <div align="center">
                            Phone No.
                              <input type="text" name="stdphn" class="form-control" value="<?php echo $stdphn; ?>" />
                            <span class="help-block"><?php echo $stdphn_err;?></span>
							</div>
                            </label>
                            <div align="center"></div>
                        </div><br />
						
						
						
						
						
                        <div align="center">
                          <input type="submit" class="btn btn-primary" value="Submit">
                          <a href="menu.php" class="btn btn-default">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>

	
	</td>
  </tr>
  <tr>
    <td bgcolor="#FF00CC"><span class="style4">FEES</span></td>
  </tr>
  <tr>
    <td bgcolor="#0000FF"><span class="style3 style4">STUDENT</span></td>
  </tr>
  <tr>
    <td bgcolor="#663399"><span class="style3 style4">FEESRCPT</span></td>
  </tr>
  <tr>
    <td bgcolor="#660033"><span class="style4">USER</span></td>
  </tr>
  
</table>


</body>
</html>
