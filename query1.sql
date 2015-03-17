##############query1
SELECT A.first, A.last
FROM Actor A, Movie M, MovieActor MA
WHERE A.id=MA.aid AND M.id=MA.mid AND M.title = 'Die Another Day';
--Give me the names of all the actors in the movie 'Die Another Day'. 
--Please also make sure actor names are in this format:  <firstname> <lastname>   (seperated by single space).
###############query2
SELECT COUNT(*)
FROM(
SELECT A.id
FROM Actor A,MovieActor M
WHERE A.id=M.aid
GROUP BY A.id
HAVING COUNT(M.mid)>1) N;
--Give me the count of all the actors who acted in multiple movies.

#############query3
SELECT A.dob, count(*)
FROM Actor A
GROUP BY A.dob
HAVING count(*) > 5
ORDER BY A.dob;
--Give me the number of Actors whose birthday is same and if the number is greater than 5