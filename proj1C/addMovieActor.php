<html>
	<head>
		<title>MovieDB: Add Actor to Movie</title>
		<center><h1>MovieDB: Add Actor to Movie</h1></center>
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
			<th BGCOLOR="#00FFFF">
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
			<th BGCOLOR="yellow">
				<a href="search.php">Search</a>
			</th>
		</tr>
	</table>
	</center>
	
	<body style="background-color:powderblue;">
	<h4>Add existing actor to movie:</h4>
		<form action="./addMovieActor.php" method="GET">	

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
		
		$actorRS=mysqli_query($db_connection, "SELECT id, first, last, dob FROM Actor ORDER BY first ASC") or die(mysqli_error($db_connection));
		$actorOptions="";
		while ($row=mysqli_fetch_array($actorRS))
		{
			$id=$row["id"];
			$first=$row["first"];
			$last=$row["last"];
			$dob=$row["dob"];
			$actorOptions.="<option value=\"$id\">".$first." ".$last." [".$dob."]</option>";
		}
		
		mysqli_free_result($actorRS);
		
?>		
			Movie:	<select name="mid">
						<?=$movieOptions?>
					</select><br/>
			Actor:	<select name="aid">
						<?=$actorOptions?>
					</select><br/>
			Role:	<input type="text" name="role" maxlength=50><br/>
			<br/>
			<input type="submit" value="Link Actor to Movie"/>
		</form>
		<hr/>

	<?php
		$dbRole=trim($_GET["role"]);
		$dbMovie=$_GET["mid"];
		$dbActor=$_GET["aid"];
		
		//pass in user inputs
		if($dbMovie=="" && $dbActor=="" && $dbRole=="")
		{ }
		else if($dbMovie=="")
		{
			echo "You must select a valid movie from the list.";
		}
		else if($dbActor=="")
		{
			echo "You must select a valid actor from the list.";
		}
		else 
		{	
			$dbMovie = mysqli_real_escape_string($db_connection, $dbMovie);
			$dbActor = mysqli_real_escape_string($db_connection, $dbActor);
			$dbRole = mysqli_real_escape_string($db_connection, $dbRole);

			$dbQuery = "INSERT INTO MovieActor (mid, aid, role) VALUES('$dbMovie', '$dbActor', '$dbRole')";
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			echo "Actor linked with Movie successfully.";
		}
		mysqli_close($db_connection);
	?>
	</body>
</html>