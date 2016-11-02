<html>
<head>
   <title>Online Query for A Movie Dataset</title>
</head>
<body>
   <h1>Online Query for A Movie Dataset</h1>
   <h3>Author: Surui Sun</h3>
<br>
<p>Please do not run a complex query here. You may kill the server.</p>
<p>Type an SQL query in the following box:</p>
<p>"Example: "
   <tt>SELECT * FROM Actor WHERE id=10;</tt>
   <br>
</p>
<p></p>
<form action='query.php' method="GET">
    <textarea name="query" cols="60" rows="5">
      <?php if(isset($_GET['query'])){
        echo htmlentities ($_GET['query']);
      }?>
    </textarea>
    <br>
    <input type="submit" value="Submit">
</form>
<p></p>
<p>
   <small>
     "Note: tables and fields are case sensitive. All tables in Project 1B are available."
   </small>
</p>
<?php
  $query = $_GET["query"];
  $db = new mysqli('localhost', 'cs143', '', 'CS143');
  if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
else{
  //echo 'Connection Success';
}

$rs = $db->query($query);
/*while($row = $rs->fetch_assoc()) {
    $id = $row['id'];
    $last = $row['last'];
    $first = $row['first'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod'];
    print "$id, $last, $first, $sex, $dob, $dod<br />";
  }*/
//
if($query!=""){
  echo '<h3>Results from MySQL:</h3>';
}
echo '<table border="1" cellspacing="1" cellpadding="2">';
echo '<tr align="center">';
while($finfo= $rs->fetch_field()){
    echo '<td>'.$finfo->name. " ". '</td>';
  }
echo '</tr>';
//echo '</table>';
//echo '<tr align="center">';
//foreach($finfo->name as $value){
//echo '<td>' .$value. " ". '</td>';
  //printf($value);
//}
//echo "</tr>";

  
while($row = $rs->fetch_assoc()){
  echo '<tr align="center">';
  foreach ($row as $value) {
    if(empty($value)){echo '<td>' .'N/A'. " ". '</td>';}
    else {echo '<td>' .$value. " ". '</td>';}
  }
  echo "</tr>";
}
echo '</table>';
mysql_free_result($rs);
$db ->close();
?>

</body>

</html>
