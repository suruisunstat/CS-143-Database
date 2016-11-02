/*Select the names of all the actors in the movie 'Die Another Day'.*/
SELECT concat(A.first," ",A.last) as Name
FROM Movie M, MovieActor MA, Actor A
WHERE M.title = "Die Another Day" AND M.id = MA.mid AND A.id = MA.aid;

/*The count of all the actors who acted in multiple movies.*/
SELECT COUNT(DISTINCT m1.aid) 
FROM MovieActor m1, MovieActor m2
WHERE m1.aid = m2.aid AND m1.mid <> m2.mid;


/*Select the number of people who are both actors and directors in the same movie*/

SELECT COUNT(DISTINCT MA.aid) as People_Both_Act_And_Direct_Count
FROM MovieDirector MD, MovieActor MA
WHERE MD.mid = MA.mid AND MD.did = MA.aid;


