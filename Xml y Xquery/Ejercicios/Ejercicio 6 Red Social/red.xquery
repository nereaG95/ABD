xquery version "3.1";

(:  Nicks de usuarios cuya edad sea mayor o igual que 20. :)

(:   for $a in doc("red.xml")/red-social/usuario
where $a/edad >= 20
return $a/nick :)

(:  Nicks de usuarios que hayan realizado más de dos publicaciones en 2012:)
 
(: 
for $a in doc("red.xml")/red-social/usuario
let $publi := count ($a/publicacion[@año = "2012"])
where $publi > 2
return $a/nick :)

(:  Nicks de usuarios que hayan emitido un voto a alguna publicación propia. :)

(:   for $a in doc("red.xml")/red-social/usuario
let $votos := count($a/publicacion/voto[@id = $a/@id])
where $votos > 0
return $a/nick :)

(: Nicks de usuarios que hayan votado a más de cinco publicaciones, aunque sean propias. Por
simplicidad, puedes suponer que un usuario no puede votar más de una vez a una misma
publicación. :)

for $a in doc("red.xml")/red-social/usuario
let $votos := count($a/publicacion/voto)
where $votos > 5
return $a/nick


