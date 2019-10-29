<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$branchname = "";
$branchname_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate branchname
    $input_branchname = trim($_POST["branchname"]);
    if(empty($input_branchname)){
        $branchname_err = "Please enter a branchname.";
    } elseif(!filter_var($input_branchname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $branchname_err = "Please enter a valid branchname.";
    } else{
        $branchname = $input_branchname;
    }
    
    
    
    
    // Check input errors before inserting in database
    if(empty ($branchname_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO branch (branchname) VALUES (?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_branchname);
            
            // Set parameters
            
            
           
			$param_branchname = $branchname;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location:thx.php");
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
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style7 {font-size: x-large; color: #FFFFFF; }
.style14 {
	font-size: 36px;
	color: #0033FF;
}
.style15 {
	font-size: 24px;
	font-weight: bold;
}
.style16 {color: #FF0000}
.style17 {font-size: 18px}
.style18 {font-size: 24px}
.style21 {
	color: #990000;
	font-size: x-large;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="1300" border="15" cellpadding="20">
  <tr>
    <td colspan="2" bgcolor="#FF9900"><div align="center" class="style14 style21">STUDENT ACADEMIC FEES</div>  </td>
  </tr>
  <tr>
    <td width="201" bgcolor="#0033FF"><div align="center" class="style7">BRANCH</div></td>
    <td width="999" rowspan="7" align="center" valign="top" bordercolor="#FFFF00" bgcolor="#33FFFF">
    
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class="style14">Add Branch </h2>
                    </div>
                    <p class="style15"><span class="style16">Please fill this form and submit to add branch record to the database</span>.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				
					
                        <div class="form-group <?php echo (!empty($branchname_err)) ? 'has-error' : ''; ?>">
                            <label><span class="style17">BranchName</span></label>
                            <input type="text" name="branchname" class="form-control" value="<?php echo $branchname; ?>">
                            <span class="help-block"><?php echo $branchname_err;?></span>
                        </div>
                        
                        
                        <input name="submit" type="submit" class="style17" value="Submit" />
                        <label>
                         <input name="reset" type="reset" class="style17" id="reset" value="Reset" />
                        </label>
                        <a href="menu.php" class="btn btn-default style18">Cancel</a>
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
