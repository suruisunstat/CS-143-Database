INSERT INTO Movie VALUES (2,'Faked Movie',1995,'R','Dream Entertainment Inc.');
-- violate the primary key in Movie table, where id = 2 can't appear twice in the same table
/*ERROR 1062 (23000): Duplicate entry '2' for key 'PRIMARY'*/

INSERT INTO Actor VALUES(10,'Soraka','Jinx','Female','1993-02-03', NULL);
-- violate the primary key in Actor table, where id = 10 can't appear twice in the same table
/*ERROR 1062 (23000): Duplicate entry '10' for key 'PRIMARY'*/

INSERT INTO Director VALUES(104,'Graves','Talon','1977-04-03',NULL);
-- violate the primary key in Director table, where id = 104 can't appear twice in the same table
/*ERROR 1062 (23000): Duplicate entry '104' for key 'PRIMARY'*/

UPDATE Movie
SET year = 2020
WHERE id = 3;
-- violate the check constraint that year must be smaller than the current year 2016.

UPDATE Actor
SET dob = '2025-03-02'
WHERE id = 10;
-- violate the check constraint that the birth year must be smaller than the current year 2016.

UPDATE Review
SET rating = 12;
-- violate the check constraint that rating must be between 0 and 10.

INSERT INTO MovieGenre VALUES (15000,'Drama');
-- violate the foreign key constraint such that there is no id=15000 in Movie table

/*ERROR 1452(23000): Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieGenre',
 CONSTRAINT 'MovieGenre_ibfk_1' FOREIGN KEY ('mid') REFENRENCES 'Movie' ('id'))*/

INSERT INTO MovieDirector VALUES (14325,112);
-- violate the foreign key constraint such that there is no id=14325 in Movie table
/*ERROR 1452(23000): Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieDirector',
 CONSTRAINT 'MovieDirector_ibfk_1' FOREIGN KEY ('mid') REFENRENCES 'Movie' ('id'))*/


INSERT INTO MovieDirector VALUES (9,1000000);
-- violate the foreign key constraint such that there is no id=1000000 in Director table
/*ERROR 1452(23000): Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieDirector',
 CONSTRAINT 'MovieDirector_ibfk_1' FOREIGN KEY ('did') REFENRENCES 'Director' ('id'))*/


INSERT INTO MovieActor VALUES(17953,162,'Debbie');
-- violate the foreign key constraint such that there is no id=17953 in Movie table
/*ERROR 1452(23000): Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieActor',
 CONSTRAINT 'MovieActor_ibfk_2' FOREIGN KEY ('mid') REFENRENCES 'Movie' ('id'))*/


INSERT INTO MovieActor VALUES(2,1345245,'Vince Dawkan');
-- violate the foreign key constraint such that there is no id=1345245 in Actor table
/*ERROR 1452(23000): Cannot add or update a child row: a foreign key constraint fails ('CS143'.'MovieActor',
 CONSTRAINT 'MovieActor_ibfk_1' FOREIGN KEY ('aid') REFENRENCES 'Actor' ('id'))*/


INSERT INTO Review VALUES('Tom','2008-01-01 00:00:01',10001,5,'It is a fantasitic movie');
-- violate the foreign key constraint such that there is no id=10001 in Movie table.
/*ERROR 1452(23000): Cannot add or update a child row: a foreign key constraint fails ('CS143'.'Review',
 CONSTRAINT 'Review_ibfk_1' FOREIGN KEY ('mid') REFENRENCES 'Movie' ('id'))*/



