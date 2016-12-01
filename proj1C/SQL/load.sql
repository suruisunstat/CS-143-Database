/*Load data into Movie Table*/
LOAD DATA LOCAL INFILE '~/data/movie.del' INTO TABLE Movie
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

/*Load data into Actor Table*/
LOAD DATA LOCAL INFILE '~/data/actor1.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

LOAD DATA LOCAL INFILE '~/data/actor2.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

LOAD DATA LOCAL INFILE '~/data/actor3.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

/*Load data into Director Table*/
LOAD DATA LOCAL INFILE '~/data/director.del' INTO TABLE Director
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

/*Load data into MovieGenre Table*/
LOAD DATA LOCAL INFILE '~/data/moviegenre.del' INTO TABLE MovieGenre
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

/*Load data into MoveDirector Table*/
LOAD DATA LOCAL INFILE '~/data/moviedirector.del' INTO TABLE MovieDirector
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

/*Load data into MovieActor Table*/
LOAD DATA LOCAL INFILE '~/data/movieactor1.del' INTO TABLE MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE '~/data/movieactor2.del' INTO TABLE MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

/*No Load data into Review table*/
/*Insert into MaxPersonID table*/
INSERT INTO MaxPersonID VALUES (69000);

/*Insert into MaxMovieID table*/
INSERT INTO MaxMovieID VALUES (4750);

