/* Q1 */
SELECT * FROM cast;

/* Q2 */

SELECT * FROM `cast` WHERE deathYear IS NULL 
/* Q3 */
SELECT * FROM cast WHERE deathYear IS NULL AND 2018-birthYear > 65;
/* Q4 */
SELECT * FROM cast WHERE deathYear IS NULL ORDER BY birthYear ASC LIMIT 1;
/* Q5 */
SELECT * FROM cast WHERE deathYear IS NULL AND 2018-birthYear > 30 AND 2018-birthYear < 50 ORDER BY birthYear ASC;
/* Q6 */
SELECT * FROM movie WHERE title LIKE "%the%";

/* ########## EXO 2 ############ */

/* a */
SELECT title,releaseDate FROM movie,country WHERE movie.idCountry = country.code AND country.name = 'United States of America' ORDER BY releaseDate DESC ;
/* b*/
SELECT title,releaseDate,name FROM movie,country
WHERE movie.idCountry = country.code AND
(2018-YEAR(releaseDate)) <= 10 ORDER BY releaseDate ASC ;
/* c */
SELECT title,name FROM movie,genre,moviegenre
WHERE movie.id = moviegenre.idMovie
AND moviegenre.idGenre = genre.id
AND (2018-YEAR(releaseDate)) > 20 ;
/* d */
SELECT DISTINCT firstname,lastname FROM Cast
WHERE 2018-birthYear > 20
/* e */
SELECT title,genre.name,actor.name FROM movie,cast,moviegenre,genre,country,actor
WHERE movie.id=moviegenre.idMovie
AND moviegenre.idGenre=genre.id
AND actor.idMovie = movie.id
AND cast.id = actor.idActor
AND country.code = movie.idCountry
AND country.name = "France"
AND cast.firstname = "Élodie"
AND cast.lastname = "Deshayes"
/* f */
SELECT DISTINCT cast.firstname, cast.lastname,actor.name FROM cast,actor,director,movie
WHERE cast.id = actor.idActor
AND actor.idMovie = (
    SELECT DISTINCT director.idMovie FROM actor,director,cast
    WHERE cast.id = director.idDirector
    AND cast.firstname= "Myriam"
    AND cast.lastname="Anik")
    
/* ########## EXO 3 ############ */

/*  a  */
SELECT DISTINCT genre.name,COUNT(genre.name) FROM genre,moviegenre
WHERE genre.id = moviegenre.idGenre
GROUP BY genre.name

/* b */
SELECT DISTINCT COUNT(movie.id) FROM movie,actor
WHERE movie.id = actor.idMOvie 
AND actor.name="Voix Off"

/* c */
SELECT cast.firstname, cast.lastname, actor.name FROM cast, actor
WHERE cast.id =  actor.idActor 
AND (actor.name ="Développeuse" OR actor.name="Développeur" )

/* d */
SELECT DISTINCT title FROM movie,director
WHERE movie.id = (SELECT idMovie FROM director 
                  GROUP BY idMovie 
                  HAVING COUNT(idMovie)>1)
AND movie.id = director.idMovie
/* f */

SELECT movie.title,genre.name,country.name,movie.releaseDate,cast.firstname,cast.lastname
FROM actor,cast,country,director,genre,movie,moviegenre
WHERE movie.id =moviegenre.idMovie
AND moviegenre.idGenre = genre.id
AND cast.id = actor.idActor
AND actor.idMovie = movie.id
AND movie.idCountry = country.code
AND director.idMovie = movie.id
AND director.idDirector = cast.id
AND movie.title LIKE "METRO%"
AND (genre.name = "Drama" OR genre.name ="Action")
AND (YEAR(releaseDate) BETWEEN 2017 AND 2018)
AND (CONCAT(cast.firstname,cast.lastname) LIKE "%NI%")



