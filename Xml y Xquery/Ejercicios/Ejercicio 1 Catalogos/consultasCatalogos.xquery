xquery version "3.1";

(:  Enunciado de la pregunta cuyo identificador es p3.:)

(:  let $enunciado := doc("catalogos.xml")/catalogo-preguntas/pregunta[@id = "p3"]/enunciado
return $enunciado:)

(:  Número de preguntas del catálogo.:)
(:  for $i in doc("catalogos.xml")/catalogo-preguntas
let $num := count($i/pregunta)
return $num :)

(:  Preguntas con más de tres opciones.:)
(:  for $i in doc("catalogos.xml")/catalogo-preguntas/pregunta
let $numOp := count($i/opcion)
where $numOp > 3
return $i :)

(:  Preguntas que, debido a algún error en la elaboración del documento, aparezcan con más de una opción correcta. :)
(:  for $i in doc("catalogos.xml")/catalogo-preguntas/pregunta
let $num := count($i/opcion[@correcta = "sí"])
where $num > 1
return $i:)

(: Preguntas que tengan una opción con el texto "Ninguna de las anteriores". :)

(:  for $i in doc("catalogos.xml")/catalogo-preguntas/pregunta
where $i/opcion = "Ninguna de las anteriores"
return $i:)

(: Preguntas que tengan una opción con el texto "Ninguna de las anteriores", y que dicha opción
no sea la última de la pregunta, es decir, que exista otra opción dentro de la misma pregunta
que tenga un valor de num mayor que el de la opción "Ninguna de las anteriores". :)
for $i in doc("catalogos.xml")/catalogo-preguntas/pregunta
let $opcion := $i/opcion[text()= "Ninguna de las anteriores"]
where $i/opcion = "Ninguna de las anteriores" and (some $x in $i/opcion satisfies $x/@num >  $opcion/@num)
return $i





