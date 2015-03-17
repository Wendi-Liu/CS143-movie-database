##############primary key constrains
UPDATE Movie 
SET id = 1
WHERE year = 1990;
#this statement violates the primary key feature of id in Movie table by setting multiple movie as same id
#ERROR 1062 (23000): Duplicate entry '1' for key 1

UPDATE Actor
SET id = 5
WHERE last = 'Lopez';
#this violates the primary key feature of id in Actor table by setting all actors named Lopez to the same id
#ERROR 1062 (23000): Duplicate entry '5' for key 1

UPDATE Director
SET id = 5
WHERE last = 'Lopez';
#this violates the primary key feature of id in Director table by setting all directors named Hanks to the same id
#ERROR 1062 (23000): Duplicate entry '5' for key 1


###########check constrains
UPDATE Movie
SET year = -5
WHERE id = 212;
#this violates the year constraints of Movie table as it's less than 0

UPDATE Actor
SET sex = 'Girl'
WHERE last = 'Lopez';
#this violates the sex constrains of table Actor because it's not 'Male' or 'Female'

UPDATE Director
SET id = -3
WHERE last = 'Hanks';
#this violates the id constrains of Director table because id < 0



##########foreign key constrains
DELETE FROM Movie
#this violates the referential integrity constrains where a tuple in movie is deleted but the movie is not  in MovieActor 
#this also violates the referential integrity constrains where a tuple in movie is deleted but the movie is not deleted in the MovieGenre
#this also violates the referential integrity constrains where a tuple in movie is deleted but the movie is not deleted in the MovieDirector
#this also violates the referential integrity constrains where a tuple in movie is deleted but the movie is not deleted in the Review
#ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143/MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
#ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143/MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
#ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143/MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
#As there is no tupples in the Review Table, so deleting this would not generate an error;


DELETE FROM Actor 
WHERE id = 10;
#this violates the referential integrity constrains where a tuple in Actor is deleted but the movie is not  in MovieActor 
#ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143/MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

DELETE FROM Director
WHERE id = 5563;
#this violates the referential integrity constrains where a tuple in Director is deleted but the movie is not  in MovieDirector
#ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143/MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

