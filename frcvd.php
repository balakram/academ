<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <td width="201" bgcolor="#0033FF"><div align="center" class="style7">BRANCH</div></td>
    <td width="999" rowspan="7" bgcolor="#00FFFF">
	
	<center>
		<div>
	<form method="post" action="menu.php">
	<table width="607" height="96" border="10" align="center">
		<th width="138">Class</th>
		<th width="222">Date</th>
		<th width="225">Deposite by</th>
		<tr>
			<td>
			<select name="select">
					          <option selected="selected"></option>
					          <option>1st Semester</option>
					          <option>2nd Semester</option>
					          <option>3rd Semester</option>
					          <option>4th Semester</option>
					          <option>5thSemester</option>
					          <option>6th Semester</option>
					          <option>7th Semester</option>
					          <option>8th Semester</option>
              </select>		
		    </td>
			<td><input type="text" name="date" value="<?php  echo date("d-m-Y"); ?>"></td>
			<td><input type="text" name="depositer" placeholder="Depositer"></td>
		</tr>
	  </table>
<input type="submit" name="print" value="Print Bill" align="center">
</form>
</td>
  </tr>
  <tr>
    <td bgcolor="#009933"><div align="center" class="style7">FEES</div></td>
  </tr>
  <tr>
    <td bgcolor="#CC00CC"><div align="center" class="style7">STUDENT</div></td>
  </tr>
  <tr>
    <td bgcolor="#FF6699"><div align="center" class="style7">FEESRCVD</div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0033"><div align="center" class="style7">USER</div></td>
  </tr>
  <tr>
    <td height="61"  bgcolor="#6600CC">dfhcet</td>
  </tr>
  <tr>
    <td bgcolor="#FFFF00">szgetqx </td>
  </tr>
</table>
</body>
</html>