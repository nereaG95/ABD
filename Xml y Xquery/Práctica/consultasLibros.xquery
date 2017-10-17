xquery version "3.1";

(:  :Obtener todos los t´ıtulos de los libros.:)
(:  for $var in doc("libros.xml")/biblioteca/libros/libro
return <libros>{$var/titulo/text()}</libros>:)

(: Obtener todos los t´ıtulos de los libros del fichero libros.xml junto con los autores de cada libro :)
(:  for $var in doc("libros.xml")/biblioteca/libros/libro
return <libros>{$var/titulo/text()}{$var/autor}</libros>:)

(: Obtener los tıtulos de los libros prestados con sus autores y la fecha de inicio y devolucion del prestamo, ordenados por la fecha de inicio del prestamo. :)
(:  for $var in doc("libros.xml")/biblioteca/prestamos/entrada
let $autor:= doc("libros.xml")/biblioteca/libros/libro[titulo = $var/titulo]/autor
order by $var/prestamo/inicio
return <Prestamos>{$var/titulo}{$autor}{$var/prestamo/inicio}{$var/prestamo/devolucion}</Prestamos>:)

(:  Obtener los tıtulos de los libros almacenados en el fichero libros.xml y su primer autor.:)

for $var in doc("libros.xml")/biblioteca/libros/libro
return <Libros>{$var/titulo}{$var/autor[1]}</Libros>