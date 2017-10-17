xquery version "3.1";

(: Escribe una consulta en XQuery para obtener la puntuación máxima obtenible por el alumno que realice el examen :)

(:  for $i in doc("examen2.xml")/examen
let $total := sum($i/ejercicio/@puntuacion)
return $total :)


(: Realiza una consulta XQuery que a partir del documento examen.xml devuelva otro documento con el enunciado, opciones y puntuación de cada pregunta. El documento devuelto deberá tener el siguiente aspecto:)
(: 
<examen>
{
    for $i in doc("examen2.xml")/examen/ejercicio
    let $pregunta := doc("catalogos.xml")/catalogo-preguntas/pregunta[@id = $i/@id]
    order by $i/@id
    return <ejercicio num="{$i/@num}" puntuacion="{$i/@puntuacion}"> {$pregunta/enunciado}
    {for $op in $pregunta/opcion
        order by $op/@num
        return <opcion> {$op/text()} </opcion>
    }
     </ejercicio>
}
</examen> 
:)

(:  Realiza una consulta XQuery que obtenga la calificación total del alumno a partir de la información
contenida en los documentos respuestas.xml, examen.xml y catalogo.xml :)

sum(
    for $i in doc("respuestas.xml")/respuestas/respuesta
    let $id := doc("examen2.xml")/exmamen/ejercicio[@num = $i/@ejNum]
    let $pregunta := doc("catalogos.xml")/catalogo-preguntas/pregunta[@id= $id/@id] 
    let $opcion := $pregunta/opcion[@num = $i/@opcionNum]
    where $opcion/@correcta = "sí"
    return data($id/@puntuacion)
)

