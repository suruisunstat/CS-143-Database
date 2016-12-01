<html>
	<head>
		<title>MovieDB: Search</title>
		<center><h1>MovieDB: Search</h1></center>
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
			<th BGCOLOR="yellow">
				<a href="showActorInfo.php">Show Actor Info</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="showMovieInfo.php">Show Movie Info</a>
			</th>
			<th BGCOLOR="#00FFFF">
				<a href="search.php">Search</a>
			</th>
		</tr>
	</table>
	</center>
	
	<body style="background-color:powderblue;">
	<h2>Search Actors and Movies</h2>

<p>
	<form action="./search.php" method="GET">
	
		<input type="text" name="search"></input>		
		<input type="submit" value="Search" />
	</form>
</p>

<hr>

<body BGCOLOR="#CCFFCC">

	<?php
		$dbSearch = $_GET["search"];
		$terms=explode(' ', $dbSearch);
		$db_connection = mysqli_connect("localhost", "cs143", "","CS143");		
		if(trim($dbSearch)!="")
		{
			echo "<h2>Found Actors</h2>";
			$dbQuery = "SELECT id, last, first, dob FROM Actor WHERE (first LIKE '%$terms[0]%' OR last LIKE '%$terms[0]%')";

			for($i=1; $i<count($terms); $i++)
			{
				$term=$terms[$i];
				$dbQuery=$dbQuery."AND (first LIKE '%$terms[$i]%' OR last LIKE '%$terms[$i]%')";
			}
			
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			
			while ($row = mysqli_fetch_assoc($rs))
			{
				echo "<a href=\"showActorInfo.php?id=".$row["id"]."\">".$row["first"]." ".$row["last"]." (".$row["dob"].")</a><br/>";
			}
			mysqli_free_result($rs);
			
			echo "<br/>";
			echo "<hr>";
			echo "<h2>Found Movies</h2>";
			
			$dbQuery2 = "SELECT id, title, year FROM Movie WHERE title LIKE '%$terms[0]%'";
			
			for($i=1; $i<count($terms); $i++)
			{
				$term=$terms[$i];
				$dbQuery2=$dbQuery2." AND title LIKE '%$terms[$i]%'";
			}
			
			$rs2 = mysqli_query($db_connection, $dbQuery2) or die(mysqli_error($db_connection));
			while ($row2 = mysqli_fetch_assoc($rs2))
			{
				echo "<a href=\"showMovieInfo.php?id=".$row2["id"]."\">".$row2["title"]." (".$row2["year"].")</a><br/>";
			}
			
			echo "<br/>";
			
			//free up query results
			mysqli_free_result($rs2);
		}	
	?>	
	</body>
</html>