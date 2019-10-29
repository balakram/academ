<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "VIEW FROM fees WHERE feesid = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_feesid = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
       
	        if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                    $branchname = $row["branchname"];
					$semester = $row["semester"];
					$amount = $row["amount"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
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
-->
</style>
</head>

<body>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1 align="center">View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>BranchName</label>
                        <p class="form-control-static"><?php echo $row["branchname"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label align="center">Semester</label>
                        <p class="form-control-static"><?php echo $semester = $row["semester"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label align="center">Amount</label>
                        <p class="form-control-static"><?php echo $amount = $row["amount"]; ?></p>
                    </div>
                    <p><a href="menu.php" class="btn btn-primary">OK</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
<table width="1300" border="15" cellpadding="20">
  <tr>
    <td colspan="2" bgcolor="#FF9900"><div align="center" class="style11 style13">STUDENT ACADEMIC FEES </div></td>
  </tr>
  <tr>
    <td width="201" align="center" bgcolor="#0033FF"><span class="style7">FEES</span></td>
    <td width="999" rowspan="7" bgcolor="#00FFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#009933">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CC00CC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FF6699">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FF0033">&nbsp;</td>
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
