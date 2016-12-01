<html>
	<head>
		<title>MovieDB: Add Actor/Director</title>
		<center><h1>MovieDB: Add Actor/Director</h1></center>
	</head>
	
		<center>
	<table border="0">
		<tr>
			<th BGCOLOR="#00FFFF">
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
			<th BGCOLOR="yellow">
				<a href="search.php">Search</a>
			</th>
		</tr>
	</table>
	</center>
	
	<body style="background-color:powderblue;">
	<h4>Add new actor/director to database:</h4>
		<form action="./addActorDirector.php" method="GET">
			Type:	<input type="radio" name="type" value="Actor">Actor
					<input type="radio" name="type" value="Director">Director<br/>
			First Name:	<input type="text" name="first" maxlength="20"><br/>
			Last Name:	<input type="text" name="last" maxlength="20"><br/>
			Sex:	<input type="radio" name="sex" value="Male">Male
					<input type="radio" name="sex" value="Female">Female<br/>
			Date of Birth:	<input type="text" name="dob" maxlength="10" > (YYYY-MM-DD)<br/>
			Date of Death:	<input type="text" name="dod" maxlength="10" > (YYYY-MM-DD, if applicable)<br/>
			<br/>
			<input type="submit" value="Add Person"/>
		</form>
		<hr/>

	<?php
		$db_connection = mysqli_connect("localhost", "cs143", "","CS143");
		$dbType=trim($_GET["type"]);
		$dbFirst=trim($_GET["first"]);
		$dbLast=trim($_GET["last"]);
		$dbSex=trim($_GET["sex"]);
		$dbDOB=trim($_GET["dob"]);
		$dbDOD=trim($_GET["dod"]);
		
		$dateDOB = date_parse($dbDOB);
		$dateDOD = date_parse($dbDOD);
		
		$maxIDrs = mysqli_query($db_connection, "SELECT id FROM MaxPersonID") or die(mysqli_error($db_connection));
		$maxIDArray = mysqli_fetch_array($maxIDrs);
		$maxID = $maxIDArray[0];
		$newMaxID = $maxID + 1;
		
		//pass in user inputs
		if($dbType=="" && $dbFirst=="" && $dbLast=="" && $dbSex=="" && $dbDOB=="" && $dbDOD=="") //everything is empty
		{ }
		else if($dbType=="")
		{
			echo "You must select either Actor or Director.";
		}
		else if($dbFirst=="" || $dbLast=="")
		{
			echo "You must enter a valid first and last name.";
		}
		else if(preg_match('/[^A-Za-z\s\'-]/', $dbFirst) || preg_match('/[^A-Za-z\s\'-]/', $dbLast))
		{
			echo "Invalid name.";
		}
		else if($dbType=='Actor' && $dbSex=="")
		{
			echo "You must specify the Actor's sex.";
		}
		else if($dbDOB=="" || !checkdate($dateDOB["month"], $dateDOB["day"], $dateDOB["year"]))
		{
			echo "You must specify a valid date of birth.";
		}
		else if($dbDOD!="" && !checkdate($dateDOD["month"], $dateDOD["day"], $dateDOD["year"]))
		{
			echo "If you enter a date of death, it must be valid.";
		}
		else 
		{	
			$dbLast = mysqli_real_escape_string($db_connection, $dbLast);
			$dbFirst = mysqli_real_escape_string($db_connection, $dbFirst);

			if($dbType=="Actor")
			{
				if($dbDOD=="")
					$dbQuery = "INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES('$newMaxID', '$dbLast', '$dbFirst', '$dbSex', '$dbDOB', NULL)";
				else
					$dbQuery = "INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES('$newMaxID', '$dbLast', '$dbFirst', '$dbSex', '$dbDOB', '$dbDOD')";
			}
			else //Director
			{
				if($dbDOD=="")
					$dbQuery = "INSERT INTO Director (id, last, first, dob, dod) VALUES('$newMaxID', '$dbLast', '$dbFirst', '$dbDOB', NULL)";
				else
					$dbQuery = "INSERT INTO Director (id, last, first, dob, dod) VALUES('$newMaxID', '$dbLast', '$dbFirst', '$dbDOB', '$dbDOD')";
			}
			
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			
			//update the max person ID
			mysqli_query($db_connection, "UPDATE MaxPersonID SET id=$newMaxID WHERE id=$maxID") or die(mysqli_error($db_connection));
			echo "New $dbType added (with id=$newMaxID).";
		}
		mysqli_close($db_connection);
	?>
	</body>
</html>