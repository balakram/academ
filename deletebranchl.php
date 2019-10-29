<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--s
.style7 {font-size: x-large; color: #FFFFFF; }
.style11 {font-weight: bold; font-size: xx-large; color: #FF0000;}
.style13 {color: #990033}
.style16 {font-size: x-large; color: #FFFFFF;}
.style17 {font-size: xx-large}
.style19 {color: #00FF00}
-->
</style>
</head>

<body>


<table width="1300" border="15" cellpadding="20">
  <tr>
    <td colspan="2" bgcolor="#FF9900"><div align="center" class="style11 style13">STUDENT ACADEMIC FEES </div></td>
  </tr>
  <tr>
    <td width="201" bgcolor="#0033FF"><div align="center" class="style7 style16">BRANCH</div></td>
    <td width="999" rowspan="7" bgcolor="#00FFFF"><?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM branch";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>BranchName</th>";
										 echo "<th>Action</th>";
										 
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
								$rc = 1;
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
									echo "<td> $rc</td>";
                                        $rc++;
                                        echo "<td>" . $row['branchname'] . "</td>";

                                        echo "<td><a href='deletebranch.php?id=".$row['branchid']."' title='delete Record' data-toggle='tooltip'><img src = peen.jpg></a></td>";
                                           
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    $mysqli->close();
                    ?>
  <tr>
        <td width="86" align="center" valign="middle" bordercolor="#30FFFF" bgcolor="#FF6600"><div align="center" class="style7 style16 style17"><a href="branchmenu.php" class="style19"> BACK</a></div></td>
  </tr>
      </table>
</td>
  </tr>
  <tr>
    <td bgcolor="#009933"><div align="center" class="style7 style16">FEES</div></td>
  </tr>
  <tr>
    <td bgcolor="#CC00CC"><div align="center" class="style7 style16">STUDENT</div></td>
  </tr>
  <tr>
    <td bgcolor="#FF6699"><div align="center" class="style7 style16">FEESRCVD</div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0033"><div align="center" class="style7  style16">USER</div></td>
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
