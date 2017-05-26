<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="content-type" content="text/html" charset='utf-8'/>
	
<style type="text/css">
<!--
div{
    color: black;
    
    border: 2px black;
    }
   
 -->
    </style>    
    
   <title content="text/html; charset=utf-8">Task for Adcash</title>

</head>
<body>
<form action='index.php' method='post' id="ContactForm" accept-charset="utf-8">
<div><p align="center" ><font face="Franklin Gothic Demi"size="6">Task for Adcash</font></p></div>
<div>
 <?php    
  
  $dbLocalhost=mysql_connect("localhost", "root", "")
or die("Could not connect: ". mysql_error() );
mysql_select_db("adcash", $dbLocalhost)
or die("Could not find database: ". mysql_error() );
mysql_set_charset("utf8", $dbLocalhost);

$dbUsers = mysql_query("select u.id as id, u.name as name from users u", 
										$dbLocalhost) or die("Problem reading table: " . mysql_error());
$userID="";
$dbProducts = mysql_query("select p.id as id, p.name as name from products p", 
										$dbLocalhost) or die("Problem reading table: " . mysql_error());		
$productID="";		
$quantity="";			 
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  
 
    
      $dbRecords = mysql_query("SELECT o.user_id, o.product_id, o.quantity FROM orders o WHERE id = '".$id."'", $dbLocalhost)
 or die("Problem reading table: " . mysql_error);
$userName2="";
$userID2="";
$productName2="";
$productID2="";
$quantity2="";	
 while ($arrRecord=mysql_fetch_row($dbRecords)){ 
 $quantity2=$arrRecord[2];
$dbUsers2 = mysql_query("select u.id as id, u.name as name from users u where u.id='".$arrRecord[0]."'", 
										$dbLocalhost) or die("Problem reading table: " . mysql_error());

while ($arrUser2=mysql_fetch_row($dbUsers2)){
	$userID2=$arrUser2[0];
	$userName2=$arrUser2[1];
}
$dbProducts2 = mysql_query("select p.id as id, p.name as name from products p where p.id='".$arrRecord[1]."'", 
										$dbLocalhost) or die("Problem reading table: " . mysql_error());		
	
while ($arrProduct2=mysql_fetch_row($dbProducts2)){	
$productID2=$arrProduct2[0];
$productName2=$arrProduct2[1];
}
 }
?>

  <div>
<p><font face="Arial"size="2">Edit order</font></p>
<table>
<tr>
<td align="left"><font face="Arial"size="2">User</font></td>
<td>
<input type="hidden" name="ID_edit" value=<?php echo $id; ?>>
<select name="user2">
<option value=<?php echo $userID2; ?>><?php echo $userName2; ?></option>
<?php 
while ($arrUser=mysql_fetch_row($dbUsers)){
?>
<option value=<?php echo $arrUser[0]; ?>><?php echo $arrUser[1]; ?></option>
<?php
}
?>
</select></td></tr>
</td>
<td align="left"><font face="Arial"size="2">Product</font></td>
<td>
<select name="product2">
<option value=<?php echo $productID2; ?>><?php echo $productName2; ?></option>
<?php 
while ($arrProduct=mysql_fetch_row($dbProducts)){
?>
<option value=<?php echo $arrProduct[0]; ?>><?php echo $arrProduct[1]; ?></option>
<?php
}
?>
</select></td></tr>
<tr>
<td align="left"><font face="Arial"size="2">Quantity</font></td>
<td>
<input id="quantity2" name="quantity2" type="text" value=<?php  echo $quantity2; ?>></td></tr>


</table>
      <p><input type='submit' name='Edit' value="Редактиране"id="Edit"/></p>
         
        <?php    
	  } 
  

?>
 
<p><a href="index.php">Към началната страница</a></p>
      </div>
        </form>

 </body>
</html>
