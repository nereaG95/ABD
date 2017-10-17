xquery version "3.1";

(:  Escribe una consulta en XQuery que muestre el nombre y la categoría gramatical de las palabras

monosémicas (es decir, que tienen un único significado) pertenecientes al idioma español (ES). El
formato del resultado debe ser como el del siguiente ejemplo:)

(:  for $a in doc("dic.xml")/diccionario/palabra
let $total := count ($a[@idioma = "ES"]/significado)
where $total = 1
return <monosemicas nombre="{$a/nombre/text()}" categoria="{$a/@categoria}"> </monosemicas>:)

(: Escribe una consulta XQuery que devuelva, para cada palabra española (ES) del diccionario, su
nombre y una lista con sus definiciones. Cada palabra debe devolverse con el siguiente formato

<div>
<b>renunciar</b>
<ol>
<li>Hacer dejación voluntaria, dimisión o apartamiento de algo
que se tiene, o se puede tener.</li>
<li>Desistir de algún empeño o proyecto.</li>
<li>En algunos juegos, no entrar.</li>
</ol>
</div> :)

(: 
for $a in doc("dic.xml")/diccionario/palabra
where $a/@idioma = "ES"
return <div><b>{$a/nombre/text()} </b><ol> 
    {for $b in $a/significado
    let $lista := doc("dic.xml")/diccionario/definicion[@id = $b/@id] 
    return <li>{$lista/text()}</li>}
    </ol> </div>
 :)   

