<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div style="float: right;">
            <img src= "./images/biormed_logo.jpg" width="200">
            </div>
      <h3>BIORMED</h3>
          <h3> LISTA DE PRODUCTOS</h3>  
          {{ now()}}        
    <hr/>
    
    
    <table style="border: 1px solid black;  border-collapse: collapse;">
        <tr style="border: 1px solid black;">   
            <td style="border: 1px solid black;"><strong> # </strong></td>         
            <td style="border: 1px solid black;"><strong> Código </strong></td>
                    
            <td style="border: 1px solid black;"><strong> Nombre </strong></td>
                  
            <td style="border: 1px solid black;"><strong> Decripción </strong></td>
                   
            <td style="border: 1px solid black;"><strong> Existencia </strong></td>
            <td style="border: 1px solid black;"><strong> Precio 1 </strong></td>
            <td style="border: 1px solid black;"><strong> Precio 2 </strong></td>
            <td style="border: 1px solid black;"><strong> Precio 3 </strong></td>
        </tr>
        @foreach ($productos as $key =>$item)
         <tr>
            <td style="border: 1px solid black;">{{$item['secuencia']}}</td>
            <td style="border: 1px solid black;">{{$item['codigo']}}</td>
             <td style="border: 1px solid black;">{{$item['nombre']}}</td>
             <td style="border: 1px solid black;">{{$item['descripcion']}}</td>
             <td style="border: 1px solid black;">{{$item['existencia']}}</td>
             <td style="border: 1px solid black;">USD {{$item['precio_1']}}</td>
             <td style="border: 1px solid black;">USD {{$item['precio_2']}}</td>
             <td style="border: 1px solid black;">USD {{$item['precio_3']}}</td>                                                        
         </tr>                           
         @endforeach
    </table>
 </body>
    
   
</html>