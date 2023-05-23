<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monos, libro</title>
</head>
<body>
    <table border="1" style="border-collapse:separate;" cellpadding="35px" align="center">

<?php
    /*salir: FECHA, HORA Y ZONA DE GENERACIÓN SELECCIONABLE(para la consulta); existe una fecha de creación rándom 
    tener 3 opciones: 
        salir el arreglo como tal en un punto dado con letras alrededor
        palabra por palabra en desorden 
        lo mismo que en el primero, pero con palabras desordenadas
    Num. rand del libro */  
    $fechaH=(isset($_POST["option"])&&$_POST["option"]!="")?$_POST["option"]:false;

    if($fechaH=='caso11'){
    date_default_timezone_set("America/Mexico_City");
    $fechaH = date_default_timezone_get();
    }

    if($fechaH=='caso22'){
    date_default_timezone_set("America/Chicago");
    $fechaH = date_default_timezone_get();
    }

    if($fechaH=='caso33'){
    date_default_timezone_set("America/Vancouver");
    $fechaH = date_default_timezone_get();
    }

    $consulta= date("d-m-y");

    $dia= rand(1,28);
    $mes= rand(1,12);
    $año= rand(2000, 2023);

    $fecharandom = mktime ($dia, $mes, $año);
    $fechaRandom= date("d-m-y", $fecharandom);

    $consulta= date("d-m-y H:i");

    //  PARTE DE LA ALEATORIEDAD -------------------------------------
    $frase=(isset($_POST["frase"])&&$_POST["frase"]!="")?$_POST["frase"]:false;    
    $select=(isset($_POST["op"])&&$_POST["op"]!="")?$_POST["op"]:false;
    if($select!="caso1")
    {
        //explotar cadena, generar arreglo y shuffle
        $fex=explode(" ",$frase);
        //como se necesita un arreglo a fuerza (para el ciclo do-while que puse abajo), decidí explotarlo y crear un arreglo por palabra
        
        if($select=="caso2")
        {
            //que la variable de conteo sea igual a cont (contar palabras para generar el while)
            //esto es para que cada vez que sea el caso 1, se reste este valor y se vaya poniendo la frase
            $cont=count($fex);
        }
        if($select=="caso3")
        {
            //implotar en cadena
            //acá lo reordena, lo implota en una sola cadena para que cuando se explote de nuevo, quede solamente una localidad
            shuffle($fex);
            $fin=implode(" ",$fex);
            $fex=explode(" ",$fin,1);
            $cont=1;
        }
    }
    else
    {
        //dejarla como cadena; tal vez ni siquiera haga falta el else
        $fex=explode(" ",$frase,1);
        $cont=1;
    }
    //TABLA------------------------------------------------------------------->
    //NUMERO DEL LIBRO (TABLA)
    $numero= rand(1,1000);  
    $letra=rand(1, 100);
    echo'
           <thead>
             <tr>
                <th>
                  Libro número:'.$numero.$letra.'
                </th>
             </tr>
            </thead>';
    echo'<tr><td>';

    do
    {
        $r=rand(1,10000);//si toca 1, se ejecuta el proceso de la frase
        if($r!=1)
        {
                echo chr(rand(33,100));//aquí hace un cálculo y arroja un valor ASCII de entre 33 y 100
        }
        else
        {   
                echo '<font color="#FF0000">'.$fex[$cont-1].'</font>';//la razón por la que se necesita un arreglo es 
                $cont--;                                              //que así se puede generalizar el caso 2 con el 1 y 3
                //así, cada vez que toca 1, la variable de conteo, que en el caso 1 y 3 vale 1. En el caso 2, vale el máximo de palabras de la frase
                //se va restando hasta que queda 0 y cuando pasa se sale del ciclo
        }
    }
    while($cont!=0);
    while(rand(1,10000)!=1)//esto es para que se vea chido; genera caracteres a lo idiota
    {
        echo chr(rand(32,100));
    }
    echo'</tr></td>';
    echo'
        <tr>     
            <td>Zona horaria: '.$fechaH.' Fecha de consulta:'.$consulta.'</td>    
        </tr>
        <tr>
            <td>La fecha de creación de este libro fue:'.$fechaRandom.'</td>
        </tr>
        ';
?>
        </tbody>
    </table>
</body>
</html>