<html>
	<head>
		<title>MovieDB: Add Movie Info</title>
		<center><h1>MovieDB: Add Movie Info</h1></center>
	</head>	
	
		<center>
	<table border="0">
		<tr>
			<th BGCOLOR="yellow">
				<a href="addActorDirector.php">Add Actor or Director</a>
			</th>
			<th BGCOLOR="#00FFFF">
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
			<th BGCOLOR="yellow">
				<a href="search.php">Search</a>
			</th>
		</tr>
	</table>
	</center>
	
	<body style="background-color:powderblue;">
	<h4>Add new movie to database:</h4>
		<form action="./addMovieInfo.php" method="GET">			
			Title : <input type="text" name="title" maxlength="20"><br/>
			Company: <input type="text" name="company" maxlength="50"><br/>
			Year : <input type="text" name="year" maxlength="4"><br/>	
			MPAA Rating : <select name="mpaarating">
				<option value="G">G</option>
				<option value="NC-17">NC-17</option>
				<option value="PG">PG</option>
				<option value="PG-13">PG-13</option>
				<option value="R">R</option>
				<option value="surrendere">surrendere</option>
			</select><br/>
			Genre :
			<table border="0" style="width:600px">
				<tr>
					<td><input type="checkbox" name="genre[]" value="Action">Action</input></td>
					<td><input type="checkbox" name="genre[]" value="Adult">Adult</input></td>
					<td><input type="checkbox" name="genre[]" value="Adventure">Adventure</input></td>
					<td><input type="checkbox" name="genre[]" value="Animation">Animation</input></td>
					<td><input type="checkbox" name="genre[]" value="Comedy">Comedy</input></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="genre[]" value="Crime">Crime</input></td>
					<td><input type="checkbox" name="genre[]" value="Documentary">Documentary</input></td>
					<td><input type="checkbox" name="genre[]" value="Drama">Drama</input></td>
					<td><input type="checkbox" name="genre[]" value="Family">Family</input></td>
					<td><input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="genre[]" value="Horror">Horror</input></td>
					<td><input type="checkbox" name="genre[]" value="Musical">Musical</input></td>
					<td><input type="checkbox" name="genre[]" value="Mystery">Mystery</input></td>
					<td><input type="checkbox" name="genre[]" value="Romance">Romance</input></td>
					<td><input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="genre[]" value="Short">Short</input></td>
					<td><input type="checkbox" name="genre[]" value="Thriller">Thriller</input></td>
					<td><input type="checkbox" name="genre[]" value="War">War</input></td>
					<td><input type="checkbox" name="genre[]" value="Western">Western</input></td>
				</tr>
			</table> 

			<br/>
			<input type="submit" value="Add Movie"/>
		</form>
		<hr/>

	<?php
		$db_connection = mysqli_connect("localhost", "cs143", "","CS143");
		
		$dbTitle=trim($_GET["title"]);
		$dbCompany=trim($_GET["company"]);
		$dbYear=$_GET["year"];
		$dbRating=$_GET["mpaarating"];
		$dbGenre=$_GET["genre"];
		
		$maxIDrs = mysqli_query($db_connection, "SELECT id FROM MaxMovieID") or die(mysqli_error($db_connection));
		$maxIDArray = mysqli_fetch_array($maxIDrs);
		$maxID = $maxIDArray[0];
		$newMaxID = $maxID + 1;
		
		if($dbTitle=="" && $dbCompany=="" && $dbYear=="")
		{ }
		else if ($dbTitle=="")
		{
			echo "You must enter a valid movie title.";
		}
		else if($dbYear=="" || $dbYear<=1800 || $dbYear>=2100)
		{
			echo "You must enter a valid movie production year.";
		}
		
		else 
		{	
			$dbTitle = mysqli_real_escape_string($db_connection, $dbTitle);
			$dbCompany = mysqli_real_escape_string($db_connection, $dbCompany);
			if($dbCompany=="")
				$dbQuery = "INSERT INTO Movie (id, title, year, rating, company) VALUES('$newMaxID', '$dbTitle', '$dbYear', '$dbRating', NULL)";
			else
				$dbQuery = "INSERT INTO Movie (id, title, year, rating, company) VALUES('$newMaxID', '$dbTitle', '$dbYear', '$dbRating', '$dbCompany')";
			
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			//update the max movie ID
			mysqli_query($db_connection, "UPDATE MaxMovieID SET id=$newMaxID WHERE id=$maxID") or die(mysqli_error($db_connection));
			
			for($i=0; $i < count($dbGenre); $i++)
			{
				$genreQuery = "INSERT INTO MovieGenre (mid, genre) VALUES ('$newMaxID', '$dbGenre[$i]')";
				$genreRS = mysqli_query($db_connection, $genreQuery) or die(mysqli_error($db_connection));
			}
			
			//present a success message`
			echo "New movie added (with id=$newMaxID).";
		}
		
		//close the database connection
		mysqli_close($db_connection);
	?>


		
	</body>
</html>