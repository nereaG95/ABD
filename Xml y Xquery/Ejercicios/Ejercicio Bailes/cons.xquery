xquery version "3.1";

(: Mostrar cada uno de los nombres de los bailes con las etiquetas los bailes  :)
(:  for $baile in doc ("bailes2.xml")/bailes/baile
return <losbailes>{$baile/nombre/text()}</losbailes>:)

(: Mostrar los nombres de los bailes seguidos con el numero de plazas
entre parentesis, ambos dentro de la misma etiqueta 'losbailes' :)
(:  :for $baile in doc ("bailes2.xml")/bailes/baile
return <losbailes>{$baile/nombre/text()} ({$baile/plazas/text()})</losbailes> :)

(: Mostrar los nombres de los bailes cuyo precio sea mayor de 30. :)
 
(:  :for $bailes in doc ("bailes2.xml")/bailes/baile
where $bailes/precio > 30
return $bailes/nombre:)

(:  :Mostrar los nombres de los bailes cuyo precio sea mayor de 30 y la
moneda 'euro'.:)

(:  for $bailes in doc ("bailes2.xml")/bailes/baile
where $bailes/precio >10 and $bailes/precio/@moneda="euro"
return $bailes/nombre:)

(: Mostrar los nombres y la fecha de comienzo de los bailes que comiencen el mes 
 de enero (utiliza para buscarlo la cadena de texto'/1/') :)
 
(:  for $bailes in doc ("bailes2.xml")/bailes/baile
 where contains ($bailes/comienzo, "/1/")
 return <bailes>{$bailes/nombre} {$bailes/comienzo}</bailes>:)
 
(: Mostrar los nombres de los profesores y la sala en la que dan clase,
ordenalos por sala :)

(: for $bailes in doc ("bailes2.xml")/bailes/baile
order by $bailes/sala
return <resultado>{$bailes/profesor} {$bailes/sala} </resultado>:)

(: Mostrar los nombres de los profesores eliminando los repetidos y acampanar 
cada nombre con todas las salas en la que da clase, ordenalos por nombre :)

(: for $bailes in distinct-values(doc("bailes2.xml")/bailes/baile/profesor)
(: como si fuera un if :)
let $salas := doc("bailes2.xml")/bailes/baile[profesor = $bailes]/sala
order by $bailes
return <resultado> {$bailes} {$salas}</resultado>:)

(:  Mostrar la media de los precios de todos los bailes.:)
(:  Opcion 1 :)
(:  for $media in avg(doc("bailes2.xml")/bailes/baile/precio)
return <media> {$media}</media>:)
(:  Opcion 2 (es mejor
let $baile := doc("bailes2.xml")/bailes/baile/precio
return <media>{avg($baile)}</media> :)

(:  Mostrar la suma de los precios de los bailes de la sala 1. :)
(:   let $var := sum(doc("bailes2.xml")/bailes/baile[sala="1"]/precio)
 return <sumaTotal> {$var} </sumaTotal>:)
 
 (: Mostrar cuantas plazas en total oferta el profesor 'Jesus Lozano'.:)
(:  let $var := sum(doc("bailes2.xml")/bailes/baile[profesor="JesusLozano"]/plazas)
 return <plazas> {$var} </plazas>:)
 
(: Mostrar el dinero que ganara la profesora 'Laura Mendiola' si se
completaran todas las plazas de su baile, sabiendo que solo tiene un baile:)
(:  let $plazas := doc("bailes2.xml")/bailes/baile[profesor="LauraMendiola"]/plazas
let $precio := doc("bailes2.xml")/bailes/baile[profesor="LauraMendiola"]/precio
return <total>{$plazas*$precio} </total>:)


(: Mostrar el dinero que ganara el profesor 'Jesus Lozano' si se completaran todas las plazas de su baile, pero mostrando el benecio de cada baile por separado :)
(:  :for $var in doc("bailes2.xml")/bailes/baile[profesor="JesusLozano"]
return <ganancias>{$var/nombre}<Dinero>{$var/plazas * $var/precio}</Dinero></ganancias>:)

(: Mostrar el nombre del baile, su precio y el precio con un descuento del 15% para familias numerosas. Ordenar por el nombre del baile:)
(:  for $var in doc("bailes2.xml")/bailes/baile
let $descuento := $var/precio - ($var/precio * 0.15)
order by $var/nombre
return <Resultado>{$var/nombre} <Precio>{$var/precio/text()}</Precio> <Descuento>{$descuento}</Descuento></Resultado>:)


(: Mostrar todos los datos de cada baile excepto la fecha de comienzo y de fin. :)
(:  for $var in doc("bailes2.xml")/bailes/baile 
return <RES>{$var/* except $var/comienzo except $var/fin}</RES>:)

(: Mostrar en una tabla de HTML los nombres de los bailes y su profesor, cada uno en una tabla :)
<table>{
for $var in doc("bailes2.xml")/bailes/baile
return <tr>  <td> {$var/nombre/text()}</td> <td>{$var/profesor/text()}</td> </tr>
} </table>
