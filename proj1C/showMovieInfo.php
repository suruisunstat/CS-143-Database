<html>
	<head>
		<title>MovieDB: Movie Info</title>
		<center><h1>MovieDB: Movie Info</h1></center>
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
			<th BGCOLOR="#00FFFF">
				<a href="showMovieInfo.php">Show Movie Info</a>
			</th>
			<th BGCOLOR="yellow">
				<a href="search.php">Search</a>
			</th>
		</tr>
	</table>
	</center>
	
	<body style="background-color:powderblue;">
	<h2>Movie Details</h2>
	<?php
		$db_connection = mysqli_connect("localhost", "cs143", "","CS143");
		$dbID=trim($_GET["id"]);
		
		if($dbID=="")
		{
			echo "Invalid movie ID.";
			echo "<br/><br/>";
		}
		else 
		{
			$dbQuery = "SELECT title, year, rating, company FROM Movie WHERE id=$dbID";
			$rs = mysqli_query($db_connection, $dbQuery) or die(mysqli_error($db_connection));
			
			$row = mysqli_fetch_row($rs);
			echo "<b>Title:</b> ".$row[0]." (".$row[1].")<br/>"; 
			echo "<b>MPAA Rating:</b> ".$row[2]."<br/>"; 
			
			if($row[3]!="")
				echo "<b>Producer:</b> ".$row[3]."<br/>"; 
			else
				echo "<b>Producer:</b> N/A <br/>";
				
			mysqli_free_result($rs);
			
			echo "<b>Director(s):</b> ";
		
			$dbQuery2 = "SELECT D.last, D.first FROM MovieDirector MD, Director D WHERE MD.mid=$dbID AND MD.did=D.id";
			$rs2 = mysqli_query($db_connection, $dbQuery2) or die(mysqli_error($db_connection));
			$firstInList=true;
		
			while($row2 = mysqli_fetch_assoc($rs2))
			{
				if(!$firstInList)
					echo ", ";
				else
					$firstInList=false;
				echo $row2["first"]." ".$row2["last"];
			}
			
			if($firstInList) 
			{
				echo "N/A";
			}
			
			echo "<br/>";
			mysqli_free_result($rs2);
			echo "<b>Genre(s):</b> ";
			
			$dbQuery1 = "SELECT genre from MovieGenre WHERE mid=$dbID";
			$rs1 = mysqli_query($db_connection, $dbQuery1) or die(mysqli_error($db_connection));
			$firstInList=true;
			
			while ($row1 = mysqli_fetch_assoc($rs1))
			{
				if(!$firstInList)
					echo ", ";
				else
					$firstInList=false;
					
				echo $row1["genre"];
			}
			
			if($firstInList)
			{
				echo "N/A";
			}
			mysqli_free_result($rs1);
			
			echo "<br/><br/>";
			echo "<hr>";
			echo "<h2>Related Actors</h2>";
			
			$dbQuery3 = "SELECT MA.aid, MA.role, A.last, A.first FROM MovieActor MA, Actor A WHERE MA.mid=$dbID AND MA.aid=A.id";
			$rs3 = mysqli_query($db_connection, $dbQuery3) or die(mysqli_error($db_connection));
			
			//print role and movie links
			while ($row3 = mysqli_fetch_assoc($rs3))
			{
				$nameLink = "<a href=\"showActorInfo.php?id=".$row3["aid"]."\">".$row3["first"]." ".$row3["last"]."</a>";
				echo $nameLink." as ".$row3["role"]."<br/>";
			}
			
			echo "<br/>";
			
			//free up query results
			mysqli_free_result($rs3);
		
			echo "<hr>";
			echo "<h2>User Reviews</h2>";
			echo "<b>Average Rating:</b>";
		
			//query for count and average rating
			$dbQuery4 = "SELECT AVG(rating), COUNT(rating) FROM Review WHERE mid=$dbID";
			$rs4 = mysqli_query($db_connection, $dbQuery4) or die(mysqli_error($db_connection));
			$row4 = mysqli_fetch_row($rs4);
			if($row4[0]=="")
			{
				echo " N/A<br/><br/>";
				echo "Be the first to <a href=\"addMovieComment.php?id=".$dbID."\">submit a review</a> now!<br/><br/>";
			}
			else
			{
				$formattedAvgRating = $row4[0] + 0;
				echo " $formattedAvgRating out of 5<br/>";
				echo "Reviewed $row4[1] times. <a href=\"addMovieComment.php?id=".$dbID."\">Add your comment</a> now!<br/><br/>";
			}
			
			$dbQuery4 = "SELECT time, name, rating, comment FROM Review WHERE mid=$dbID ORDER BY time DESC";
			$rs4 = mysqli_query($db_connection, $dbQuery4) or die(mysqli_error($db_connection));
			
			$count=mysqli_num_rows($rs4);
			
			while ($row4 = mysqli_fetch_assoc($rs4))
			{
				echo "<b>Review #".$count."</b> written on ".$row4["time"]."<br/>";
				echo $row4["name"]."'s rating: ".$row4["rating"]."<br/>";
				echo "Comment: ".$row4["comment"]."<br/>";
				echo "<br/>";
				$count--;
			}
			echo "<br/>";
			mysqli_free_result($rs4);
		}
		mysqli_close($db_connection);
?>
	</body>
</html>