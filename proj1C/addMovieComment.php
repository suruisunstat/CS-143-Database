<html>
	<head>
		<title>MovieDB: Add Movie Comment</title>
		<center><h1>MovieDB: Add Movie Comment</h1></center>
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
			<th BGCOLOR="#00FFFF">
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
			<th BGCOLOR="yellow">
				<a href="search.php">Search</a>
			</th>
		</tr>
	</table>
	</center>
	
	<body style="background-color:powderblue;">
	<h4>Add new comment to movie:</h4>
		<form action="./addMovieComment.php" method="GET">	

<?php
		$db_connection = mysqli_connect("localhost", "cs143", "","CS143");
		//select all movie ids, titles, and years and place as options into dropdown
		$movieRS=mysqli_query($db_connection, "SELECT id, title, year FROM Movie ORDER BY title ASC") or die(mysqli_error($db_connection));
		$movieOptions="";
		
		$urlID=$_GET['id'];
		
		while ($row=mysqli_fetch_array($movieRS))
		{
			$id=$row["id"];
			$title=$row["title"];
			$year=$row["year"];
			
			//if movie ID matches the GET id specified in the URL, select that option
			if($id==$urlID)
				$movieOptions.="<option value=\"$id\" selected>".$title." [".$year."]</option>";
			else
				$movieOptions.="<option value=\"$id\">".$title." [".$year."]</option>";	
		}
?>		
		
			Movie:	<select name="id">
						<?=$movieOptions?>
					</select><br/>
			Your Name:	<input type="text" name="name" maxlength=20><br/>
			Rating:	<select name="rating">
						<option value="5"> 5 out of 5 </option>
						<option value="4"> 4 out of 5 </option>
						<option value="3"> 3 out of 5 </option>
						<option value="2"> 2 out of 5 </option>
						<option value="1"> 1 out of 5 </option>
					</select><br/>
			Comments: <br/><textarea name="comment" cols="80" rows="10"></textarea><br/>
			<br/>
			<input type="submit" value="Submit Comment"/>
		</form>
		<hr/>

	<?php
		$dbName=trim($_GET["name"]);
		$dbMovie=$_GET["id"];
		$dbRating=$_GET["rating"];
		$dbComment=trim($_GET["comment"]);
		
		if($dbName=="" && $dbMovie=="" && $dbRating=="" && $dbComment=="")
		{ }
		else if($dbMovie=="")
		{
			echo "You must select a valid movie from the list.";
		}
		else if ($dbRating=="" || $dbRating>5 || $dbRating<1)
		{
			echo "You must select a valid rating.";
		}
		else 
		{	
			$dbName = mysqli_real_escape_string($db_connection, $dbName);
			$dbMovie = mysqli_real_escape_string($db_connection, $dbMovie);
			$dbComment = mysqli_real_escape_string($db_connection, $dbComment);

			if($dbName=="")
				$dbName = "Anonymous";
			$dbQuery = "INSERT INTO Review (name, time, mid, rating, comment) VALUES('$dbName', now(), '$dbMovie', '$dbRating', '$dbComment')";
			
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			
			echo "Thanks! Movie review added successfully.<br/>";
			echo "<a href=\"showMovieInfo.php?id=".$dbMovie."\">Back to Movie</a>";
		}
		
		//close the database connection
		mysqli_close($db_connection);
	?>


		
	</body>
</html>