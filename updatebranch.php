<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$branchname = "";
$branchname_err = "";
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"]) && $_SERVER['REQUEST_METHOD']=='POST')
{
	
    // Validate name
    $input_branchname = trim($_POST["branchname"]);
	$branchid = trim($_POST["id"]);
    if(empty($input_branchname))
	{
        $branchname_err = "Please enter a branchname.";
    } elseif(!filter_var($input_branchname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $branchname_err = "Please enter a valid branchname.";
    } 
	else
	{
        $branchname = $input_branchname;
    }
    

    // Check input errors before inserting in database
    if(empty($branchname_err))
	{
        // Prepare an update statement
		
        $sql = "UPDATE branch SET branchname=? WHERE branchid=?";
 
        if($stmt = $mysqli->prepare($sql))
		{
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_branchname, $param_id);
            
            // Set parameters
            $param_branchname= $branchname;
            
            $param_id = $branchid;
			/*
			print_r($_SERVER);
echo "GDGDGDG";
		exit();
			*/
            
            // Attempt to execute the prepared statement
            if($stmt->execute())
			{
                
				// Records updated successfully. Redirect to landing page
                header("location:updatebranchl.php");
                exit();
            } 
			else
			{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} 
else
{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM branch WHERE branchid = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $branchname = $row["branchname"];
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
        
        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style7 {font-size: x-large; color: #FFFFFF; }
.style11 {font-weight: bold; font-size: xx-large; color: #FF0000;}
.style13 {color: #990033}
.style14 {font-size: 24px}
.style16 {
	font-size: x-large;
	color: #FF0000;
}
.style17 {
	font-size: xx-large;
	color: #9900FF;
}
-->
</style>
</head>

<body>
<table width="1300" border="15" cellpadding="20">
  <tr>
    <td colspan="2" bgcolor="#FF9900"><div align="center" class="style11 style13">STUDENT ACADEMIC FEES </div></td>
  </tr>
  <tr>
    <td width="201" bgcolor="#0033FF"><div align="center" class="style7">BRANCH</div></td>
    <td width="999" rowspan="7" align="center" bgcolor="#00FFFF">
	 <body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class="style17">Update Record</h2>
                    </div>
                    <p class="style16">Please edit the input values and submit to update the record.</p>
                    <form action="updatebranch.php" method="post">
                        <div class="form-group <?php echo (!empty($branchname_err)) ? 'has-error' : ''; ?>"> <span class="style14">
                          <label><strong>BranchName</strong></label>
                          </span>
  <input type="text" name="branchname" class="form-control" value="<?php echo $branchname; ?>">
                          <span class="help-block"><?php echo $branchname_err;?></span>
                        </div>
						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input name="submit" type="submit" class="style14" value="Submit" />
                        <a href="updatebranchl.php" class="btn btn-default style14"> Cancel</a>
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
    <td bgcolor="#FFFF00">&nbsp;</td>
  </tr>
  
</table>
</body>
</html>
