xquery version "3.1";

(:  Escribe una consulta en XQuery que devuelva los títulos de las canciones en las que participen más de dos artistas. :)

(:  
for $i in doc("musica.xml")/bd-musica/cancion
let $numero := count($i/participa)
where $numero > 2
return $i/titulo:)

(:  Escribe una consulta en XQuery que devuelva los títulos de las canciones que hayan sido repro-
ducidas más de un millón de veces, independientemente de si han sido bloqueadas o no por los
usuarios que las escuchan :)

(:   for $a in doc("musica.xml")/bd-musica/cancion
let $total := count( doc("musica.xml")/bd-musica/reproduccion[@cancion =$a/@id])
where $total > 1000000
return $a/titulo :)

(:  Decimos que una canción es un placer culpable si ha sido bloqueada del historial más de cien ve-
ces, bien sea por el mismo usuario, o bien por usuarios distintos. Escribe una consulta XQuery que
devuelva un listado con las canciones de la base de datos que sean placeres culpables. El listado
estará ordenado de manera descendente según el número de bloqueos. Para cada entrada en
esta lista se debe mostrar el título de la canción y los nombres de los artistas que participan en la
misma. :)

for $a in doc("musica.xml")/bd-musica/cancion
let $b := doc("musica.xml")/bd-musica/reproduccion[@cancion = $a/@id and @bloqueado="sí"]
let $total := count($b)
where $total > 0
order by $total descending
return <placer-culpable titulo="{$a/titulo}">{
    for $participa in $a/participa
    let $artista := doc("musica.xml")/bd-musica/artista[@id = $participa/@id]
    return <artista> {$artista/nombre/text()} </artista>
}</placer-culpable>

