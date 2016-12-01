<html>
	<head>
		<title>MovieDB: Add Director to Movie</title>
		<center><h1>MovieDB: Add Director to Movie</h1></center>
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
			<th BGCOLOR="#00FFFF">
				<a href="addMovieDirector.php">Add Movie Director</a>
			</th>
			<th BGCOLOR="yellow">
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
	<h4>Add existing director to movie:</h4>
		<form action="./addMovieDirector.php" method="GET">	

<?php
		$db_connection = mysqli_connect("localhost", "cs143", "","CS143");
		$movieRS=mysqli_query($db_connection, "SELECT id, title, year FROM Movie ORDER BY title ASC") or die(mysqli_error($db_connection));
		$movieOptions="";
		while ($row=mysqli_fetch_array($movieRS))
		{
			$id=$row["id"];
			$title=$row["title"];
			$year=$row["year"];
			$movieOptions.="<option value=\"$id\">".$title." [".$year."]</option>";
		}
		$directorRS=mysqli_query($db_connection, "SELECT id, first, last, dob FROM Director ORDER BY first ASC") or die(mysqli_error($db_connection));
		$directorOptions="";
		while ($row=mysqli_fetch_array($directorRS))
		{
			$id=$row["id"];
			$first=$row["first"];
			$last=$row["last"];
			$dob=$row["dob"];
			$directorOptions.="<option value=\"$id\">".$first." ".$last." [".$dob."]</option>";
		}
		
		//free up query results
		mysqli_free_result($directorRS);
		
?>		
			Movie:	<select name="mid">
						<?=$movieOptions?>
					</select><br/>
			Director:	<select name="did">
						<?=$directorOptions?>
					</select><br/>
			<br/>
			<input type="submit" value="Link Director to Movie"/>
		</form>
		<hr/>

	<?php
		$dbRole=trim($_GET["role"]);
		$dbMovie=$_GET["mid"];
		$dbDirector=$_GET["did"];
		
		if($dbMovie=="" && $dbDirector=="" && $dbRole=="")
		{ }
		else if($dbMovie=="")
		{
			echo "You must select a valid movie from the list.";
		}
		else if($dbDirector=="")
		{
			echo "You must select a valid director from the list.";
		}
		else 
		{	
			$dbMovie = mysqli_real_escape_string($db_connection, $dbMovie);
			$dbDirector = mysqli_real_escape_string($db_connection, $dbDirector);

			$dbQuery = "INSERT INTO MovieDirector (mid, did) VALUES('$dbMovie', '$dbDirector')";
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			echo "Director linked with Movie successfully.";
		}
		
		//close the database connection
		mysqli_close($db_connection);
	?>


		
	</body>
</html>