SELECT A.first, A.last
FROM Actor A, Movie M, MovieActor MA
WHERE A.id=MA.aid AND M.id=MA.mid AND M.title = 'Die Another Day';