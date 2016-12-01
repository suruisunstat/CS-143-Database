<html>
	<head>
		<title>MovieDB: Actor Info</title>
		<center><h1>MovieDB: Actor Info</h1></center>
	</head>	
	
	<center>
	<table border="0">
		<tr>
			<th BGCOLOR="yellow">
				<a href="addActorDirector.php">Add Actor or Director</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="addMovieInfo.php">Add Movie Info</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="addMovieComment.php">Add Movie Comment</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="addMovieActor.php">Add Movie Actor</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="addMovieDirector.php">Add Movie Director</a>
			</th>
			<th BGCOLOR="#00FFFF">
				<a href="showActorInfo.php">Show Actor Info</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="showMovieInfo.php">Show Movie Info</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="search.php">Search</a>
			</th>
		</tr>
	</table>
	</center>
	
	<body style="background-color:powderblue;">
	<h2>Actor Details</h2>
	<?php
		$db_connection = mysqli_connect("localhost", "cs143", "","CS143");
		$dbID=trim($_GET["id"]);
		
		if($dbID=="")
		{
			echo "Invalid actor ID.";
			echo "<br/><br/>";
		}
		else 
		{
			$dbQuery = "SELECT last, first, sex, dob, dod FROM Actor WHERE id=$dbID";
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			$row = mysqli_fetch_row($rs);
			echo "<b>Name:</b> ".$row[1]." ".$row[0]."<br/>"; 
			echo "<b>Sex:</b> ".$row[2]."<br/>"; 
			echo "<b>Date of Birth:</b> ".$row[3]."<br/>"; 
			
			if($row[4]!="")
				echo "<b>Date of Death:</b> ".$row[4]."<br/><br/>"; 
			else
				echo "<b>Date of Death:</b> N/A <br/><br/>"; 
			mysqli_free_result($rs);
			
			echo "<hr>";
			echo "<h2>Movies Involved</h2>";
	
			$dbQuery2 = "SELECT MA.role, M.title, M.year, M.id FROM MovieActor MA, Movie M WHERE MA.aid=$dbID AND MA.mid=M.id ORDER BY M.year DESC";
			$rs2 = mysqli_query($db_connection, $dbQuery2) or die(mysqli_error($db_connection));
			
			//print movie links
			while ($row2 = mysqli_fetch_assoc($rs2))
			{
				$titleLink = "<a href=\"showMovieInfo.php?id=".$row2["id"]."\">".$row2["title"]." (".$row2["year"].")</a>";
				echo "\"".$row2["role"]."\" in ".$titleLink."<br/>";
			}
			
			echo "<br/>";
			
			//free up query results
			mysqli_free_result($rs2);
		}
		//close the database connection
		mysqli_close($db_connection);
		
	?>
	</body>
</html>