CREATE TABLE Movie (
   id INTEGER,
   title VARCHAR(100) NOT NULL,
   year INTEGER NOT NULL,
   rating VARCHAR(10),
   company VARCHAR(50),
   PRIMARY KEY(id),  
   /*Movie id is unique to every movie*/
   CHECK(year <= 2016 AND year >= 1895)
   /*Movie must be made after 1895 and before 2016*/
) ENGINE = InnoDB;

CREATE TABLE Actor (
   id INTEGER,
   last VARCHAR(20),
   first VARCHAR(20),
   sex VARCHAR(6),
   dob DATE NOT NULL,
   dod DATE,
   PRIMARY KEY(id),  
   /*Actor id should be unique to every Actor*/
   CHECK(YEAR(dob) <=2016)
   /*Actor must be born no later than 2016*/
) ENGINE = InnoDB;

CREATE TABLE Director (
   id INTEGER,
   last VARCHAR(20),
   first VARCHAR(20),
   dob DATE,
   dod DATE,
   PRIMARY KEY(id)  
   /*Director id should be unique to every Director*/
) ENGINE = InnoDB;

CREATE TABLE MovieGenre (
   mid INTEGER, 
   genre VARCHAR(20),
   FOREIGN KEY(mid) REFERENCES Movie(id) 
   /*Every mid in MovieGenre table also appear in Movie table*/
) ENGINE = InnoDB;

CREATE TABLE MovieDirector (
   mid INTEGER,
   did INTEGER,
   FOREIGN KEY(mid) REFERENCES Movie(id), 
   /*Every mid in MovieDirector table also appear in Movie table*/
   FOREIGN KEY(did) REFERENCES Director(id) 
   /*Every did in MovieDirector table also appear in Director table*/
) ENGINE = InnoDB;

CREATE TABLE MovieActor (
   mid INTEGER,
   aid INTEGER,
   role VARCHAR(50),
   FOREIGN KEY(aid) REFERENCES Actor(id), 
   /*Every aid in MovieActor table also appear in Actor table*/
   FOREIGN KEY(mid) REFERENCES Movie(id) 
   /*Every mid in MovieActor table also appear in Movie table*/
) ENGINE = InnoDB;

CREATE TABLE Review (
   name VARCHAR(20),
   time TIMESTAMP,
   mid INTEGER,
   rating INTEGER,
   comment VARCHAR(500),
   FOREIGN KEY(mid) REFERENCES Movie(id),
   /*Every mid in Review table also appear in Movie table*/
   CHECK(rating >=0 AND rating <= 10) 
   /*rating must be between 0 and 10*/
) ENGINE = InnoDB;

CREATE TABLE MaxPersonID (
   id INTEGER
) ENGINE = InnoDB;

CREATE TABLE MaxMovieID (
   id INTEGER
) ENGINE = InnoDB;

