<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div style="float: right;">
            <img src= "./images/biormed_logo.jpg" width="200">
            </div>
      <h3>BIORMED</h3>
      <h3> Traslado de productos</h3> 
      <strong>Código: </strong> {{$codigo}} <br/>
      <strong>Decripcion: </strong>{{$nombre}} <br/>
      <strong>Origen: </strong> {{$origen}} <br/>
      <strong>Destino: </strong> {{$destino}} <br/>
      <strong>Estado: </strong> {{$estado}} <br/>
      <br/> 
          {{ now()}}        
    <hr/>
    
    
    <table style="border: 1px solid black;  border-collapse: collapse;">
        <tr style="border: 1px solid black;">   
            <td style="border: 1px solid black;"><strong> # </strong></td>         
            <td style="border: 1px solid black;"><strong> id </strong></td>
                    
            <td style="border: 1px solid black;"><strong> Código </strong></td>
                  
            <td style="border: 1px solid black;"><strong> Nomvre </strong></td>
                   
            <td style="border: 1px solid black;"><strong> Cantidad </strong></td>

        </tr>
        @foreach ($productos as $key =>$item)
         <tr>
            <td style="border: 1px solid black;">{{$key}}</td>
            <td style="border: 1px solid black;">{{$item['producto_id']}}</td>
            <td style="border: 1px solid black;">{{$item['producto_codigo']}}</td>
             <td style="border: 1px solid black;">{{$item['producto_nombre']}}</td>
             <td style="border: 1px solid black;">{{$item['cantidad']}}</td>
                                                       
         </tr>                           
         @endforeach
    </table>
 </body>
    
   
</html>