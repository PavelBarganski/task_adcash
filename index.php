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
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="content-type" content="text/html" charset='utf-8'/>
	
<style type="text/css">
<!--
div{
    color: black;
    
    border: 2px solid black;
    }
   table{
	   font-family: arial, sans-serif;
	   border-collapse:collapse;
	   
   }
   th{
	   background-color:#dddddd;
	   }
	   tr:nth-child(even){
		background-color:#f0f0f0;   
	   }
 -->
    </style>    
    
   <title content="text/html; charset=utf-8">Task for Adcash</title>
<form action='index.php' method='post' id="ContactForm" accept-charset="utf-8">
</head>
<body>
<div><p align="center" ><font face="Arial"size="4">Task for Adcash</font></p></div>
<br/>

<div>
<p><font face="Arial"size="2">Add new order</font></p>
<table>
<tr>
<td align="left"><font face="Arial"size="2">User</font></td>
<td>
<select name="user">
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
<select name="product">
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
<input id="quantity" name="quantity" type="text" placeholder="enter quantity"/></td></tr>
<td align="left"></td>
<td>
<input type="submit" name="add" value="add" id="add"/>
</td>
</table>
<?php
if (isset($_POST["add"])) {
	mt_srand((double)microtime()*10000);
				$charid = md5(uniqid(rand(), true));
				$hyphen = chr(45);// "-"
				$uuid = chr(123)// "{"
				.substr($charid, 0, 8).$hyphen
				.substr($charid, 8, 4).$hyphen
				.substr($charid,12, 4).$hyphen
				.substr($charid,16, 4).$hyphen
				.substr($charid,20,12)
				.chr(125);
				$GUID = $uuid;
	$userID=$_POST['user'];
    $productID = $_POST['product'];
    $quantity = $_POST['quantity'];
	$priceProduct1=mysql_query("select p.price, p.name from products p where p.id='".$productID."'", 
										$dbLocalhost) or die("Problem reading table: " . mysql_error());	
	$priceProduct=mysql_fetch_row($priceProduct1);
	
	$priceUser1=mysql_query("select u.name from users u where u.id='".$userID."'", 
										$dbLocalhost) or die("Problem reading table: " . mysql_error());	
	$User_name=mysql_fetch_row($priceUser1);
	$date_now=date("Y-m-j H:i:s");
	$discount=1;
	if(($productID=='wr2132st4767583')&&($quantity>=3)){
		$discount=0.8;
	}
		
	$total=$priceProduct[0]*$quantity*$discount;
	$name_order=$priceProduct[1]." purchased from ".$User_name[0];
	if(!empty($GUID)){
	mysql_query("insert into orders (id, name, user_id, product_id, quantity, total, date_entered, date_modified, deleted) 
						 values('".$GUID."', '".$name_order."', '".$userID."', '".$productID."', '".$quantity."', '".$total."', '".$date_now."', '".$date_now."',0)" )
  or die("Problem updating table: " . mysql_error());
	}
}
if (isset($_POST["Edit"])) {
	$ID_edit=$_POST['ID_edit'];
    $userID2=$_POST['user2'];
    $productID2 = $_POST['product2'];
    $quantity2 = $_POST['quantity2'];
	$date_now=date("Y-m-j H:i:s");
     $discount=1;
	if(($productID2=='wr2132st4767583')&&($quantity2>=3)){
		$discount=0.8;
	}
	$priceProduct1=mysql_query("select p.price, p.name from products p where p.id='".$productID2."'", 
										$dbLocalhost) or die("Problem reading table: " . mysql_error());	
	$priceProduct=mysql_fetch_row($priceProduct1);
	$total=$priceProduct[0]*$quantity2*$discount;
mysql_query("UPDATE orders SET  user_id='".$userID2."',  product_id='".$productID2."', quantity='".$quantity2."' ,
					date_modified='".$date_now."', total='".$total."'
					WHERE id ='".$ID_edit."'")
  or die("Problem updating table: " . mysql_error());
}
?>
</div>

<br/>
<div>
<p><font face="Arial"size="2">Search</font></p>
<p>
<select name="date_order">
<option value="All time">All time</option>
<option value="Last 7 days">Last 7 days</option>
<option value="Today">Today</option>
</select>
<input id="search_user_or_product" name="search_user_or_product" type="text" placeholder="enter search term..."/>
<input type='submit' name='Search' value="Search"id="Search"/>
</p>
</div>
<?php
$filter_date="";
$filter_user_or_product=""; 

if (isset($_POST["Search"])) {
	$date_order=$_POST['date_order'];
	$search_user_or_product = $_POST['search_user_or_product'];
	if (($date_order=="")||($date_order=='All time')){
		if($search_user_or_product!=""){
		$filter_user_or_product=" where "; 
		}
	} else
	if(($date_order!="")||($date_order!='All time')){
		$filter_user_or_product=" and "; 
	}else{
		$filter_user_or_product=""; 
	}
    
	if(!empty($search_user_or_product)){
		$filter_user_or_product.="((select u2.name from users u2 inner join orders o2 on u2.id=o2.user_id where o2.id=o.id) like '%".$search_user_or_product."%' 
		or (select p3.name from products p3 inner join orders o3 on p3.id=o3.product_id where o3.id=o.id) like '%".$search_user_or_product."%' )";
	}
	switch($date_order){
		case 'All time': $filter_date=""; break;
		case 'Last 7 days': $filter_date="WHERE date_modified>DATE_SUB(NOW(), INTERVAL 7 DAY)";break;
		case 'Today':$filter_date="WHERE o.date_modified>=date_format(NOW(),'%Y-%m-%d')"; break;
	}
}

 $dbRecords = mysql_query("
										SELECT 
										o.id as id,
										(select u.name from users u where u.id=o.user_id)as user_name, 
										(select p.name from products p where p.id=o.product_id)as product_name, 
										concat((select cast(p.price as decimal(20,2)) from products p where p.id=o.product_id),' ', (select p.currency from products p where p.id=o.product_id))as product_price,
										o.quantity as quantity,
										concat(o.total,' ',(select p.currency from products p where p.id=o.product_id))as total,
										o.date_modified as date
										FROM orders o ".$filter_date.$filter_user_or_product, 
										$dbLocalhost)
    or die("Problem reading table: " . mysql_error()); 
    
        
?>

<br/>
<div>
        <table class="table" border="1">
		
<tr>
	<th>User</th>
	<th>Product</th>
	<th>Price</th></th>
	<th>Quantity</th>
	<th>Total</th>
	<th>Date</th>
	<th>Actions</th>
    </tr>
   <?php
		while ($arrRecord=mysql_fetch_row($dbRecords)){
		?>
<tr>
    <td><?php echo $arrRecord[1]; ?></td>
		<td><?php echo $arrRecord[2]; ?></td>
	<td><?php echo $arrRecord[3]; ?></td>
	<td><?php echo $arrRecord[4]; ?></td>
	<td><?php echo $arrRecord[5]; ?></td>
	<td><?php echo $arrRecord[6]; ?></td>
	 <td>
       <p><a href="Edit.php?id=<?php echo $arrRecord[0]; ?> "> Edit</a>
       <a href="index.php?id=<?php echo $arrRecord[0]; ?> "> Delete </a></p>
	</td>
	
	
	</tr>
<?php
        }
      if (isset($_GET['id'])) {
    $id = $_GET['id'];
   

    
  mysql_query("DELETE FROM orders WHERE id = '".$id."'", $dbLocalhost)
 or die("Problem reading table: " . mysql_error);}
?>
</table>
 
</div>
 </body>
 </form>
</html>