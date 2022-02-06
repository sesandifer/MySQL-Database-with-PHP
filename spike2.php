<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","ellisken-db","cqs3Ii2O8xoRdNVI","ellisken-db");
if($mysqli->connect_errno){
  echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }
  echo "TEST: Connected to DB server successfully!";
?>
<!DOCTYPE html>
<html>

<head>

    <title>E-commerce and Philanthropy Platform (SPIKE DEMO)</title>

    <style type="text/css">

       div{

           text-align: center;
       }

        h1, h2 {
            color: #2d8730;
            margin: 10px auto 10px auto;
        }

        h1{
            font-size: 36px;
            max-width: 30%;
            text-shadow: 0px 2px 1px black;
            display: inline;
            border-bottom-color: lightpink;
            border-bottom-width: 5px;
            border-bottom-style: dashed;
        }

        h2{
           color: #2d8730;
            font-size: 28px;
            max-width: 30%;
            text-shadow: 0px 1px 1px lightpink;
            display: inline;
            border-bottom-color: lightpink;
            border-bottom-width: 2px;
            border-bottom-style: dashed;
            border-left-color: lightpink;
            border-left-width: 2px;
            border-left-style: dashed;
        }

        a {
            text-decoration: underline;
            color:#db4ce0;
        }

        a:hover{
            color:#f46b53;
        }

        p{
           font-family: Verdana, "Calibri Light", sans-serif;
            font-size: 14px;
            line-height: 150%;
            text-align: left;
        }

        body {
            font-family: arial;
            font-size: 80%;
            width: 100%;
            margin: 0;
            background-color: #e8f0ff;
            text-align:center;
        }

        #page{
            margin: 50px;

        }
      
        #image_logo {
            background-image: url(http://cdn.mysitemyway.com/etc-mysitemyway/icons/legacy-previews/icons/green-jelly-icons-business/082207-green-jelly-icon-business-cart5.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            margin-top: 10px;
            height: 160px;
            width: 180px;
            margin: 0 auto;
            display: block;
            
        }

       .content ul{
           text-align: left;
           font-size: 18px;
           text-style: italic;
           font-family: "Cambria Math", Cambria, sans-serif;
       }

       nav {
            display: inline-block;
            text-align:center;
        }

        nav ul li{
            display: inline-block;
            margin: 5px auto 5px auto;
        }

        nav ul li a {
            display: inline-block;
            padding: 22px;
            background-color: lightpink;
            color: black;
            box-shadow: 0px 3px 3px #999;
            margin: 5px auto 5px auto;
            font-family: "Trebuchet MS", sans-serif;
            font-size: 14px;
            text-decoration: none;
            text-transform:uppercase;
            border-radius: 30px;
        }

        nav ul li a:hover{
            background-color: steelblue;
        }

        p li{
            text-style: italic;
            text-align: left;
            text-size: 20px;
        }

        .content {
            background-color: white;
            padding: 20px;
            font-size: 12px;
        }

        .user_timeline{
            background-color: #caf2bf;
            text-size: 40px;
            font: sans-serif;
            color: #5e002d;
        }

        footer {
            border-bottom: 1px #ccc solid;
            margin: 20px;
            text-align: right;
            text-transform: uppercase;
            color: lightcoral;
        }
		
		
		table.grid {
		font-family: verdana,arial,sans-serif;
		font-size:18px;
		color:#333333;
		border-width: 1px;
		border-color: #666666;
		border-collapse: collapse;
		margin: 10px auto;
	}
	table.grid th {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #666666;
		background-color: #dedede;
	}
	table.grid td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #666666;
		background-color: #ffffff;
		width: 20%;
	}

    </style>

</head>

<!-- webpage content goes in the body -->
<body>

<div id="page">
    <h1>E-commerce and Philanthropy: Home</h1>

    <!--Note: This is a stock photo, not an actual logo we made -->
    <div id="image_logo"></div>
    
    <!--This is the main navigation bar for the site -->
    <nav>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/settings">Account Settings</a></li>
            <li><a href="/donationHistory">Donation History</a></li>
            <li><a href="/search">Search</a></li>
            <li><a href="/notifications"><b>Notifications (2)</b></a></li>

        </ul>
    </nav>


    <div class="content">
    
    <!--USER_NAME will be loaded from the "Donation_Profile" table -->
    <h2>Welcome, USER_NAME</h2>
        <p>           
    </div>
   
   <div class="user_timeline">
    <ul>
        <!--This section will need code included to retrieve donation history data from the "Donation_History" table -->
   
	<h3>RECENT DONATION HISTORY:</h3>
		<table class="grid">
			<caption><b>Donated Items</b></caption>
			<tr>
				<th>Organization</th>
                <th>Order Date</th>
                <th>Items</th>
                <th>Donor</th>
			</tr>

<?php
$stmt = $mysqli->prepare("SELECT organization.username, don_order. order_date, item.description, donor.username FROM donor INNER JOIN don_order ON donor.id = don_order.don_id INNER JOIN item ON don_order.id = item.order_id INNER JOIN organization ON don_order.org_id = organization.id
ORDER BY order_date desc LIMIT 7");

$stmt->execute();

$stmt->bind_result($org, $orddate, $item, $donor);

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $org . "\n</td>\n<td>\n" . $orddate . "\n</td>\n<td>\n" . $item . "\n</td>\n<td>\n" . $donor . "\n</td>\n</tr>";
}
$stmt->close();
?>

		</table>
   
   
   
   
   
   
   
   
   
   
   
   
        <!--This section will need code included to retrieve message notifications from the "Donor_Profile" table -->
   <li> NEW MESSAGES NOTIFICATIONS - LOADED FROM Donor_Profile TABLE </li>
    </ul></p>
       </div>

<footer>
    For CS 361 Project group 10: Mark Buckner, Kendra Ellis, Jonathan Gamble, Edwin Rubio, and Stuart Sandifer.
</footer>
</body>

</html>
