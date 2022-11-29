<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div style="float: right;">
            <img src= "./images/biormed_logo.jpg" width="200">
            </div>
      <h3>BIORMED</h3>
       <h3>REPORTE CONSOLIDADO POR {{$tipo}}</h3>          
    <hr/>
    
 
   
   <table style="border: 1px solid black;  border-collapse: collapse;">
    <tr style="border: 1px solid black;">            
        <td style="border: 1px solid black;"><strong> idPedido </strong></td>
                
        <td style="border: 1px solid black;"><strong> Cliente </strong></td>
              
        <td style="border: 1px solid black;"><strong> Subtotal </strong></td>
               
        <td style="border: 1px solid black;"><strong> Total </strong></td>

        <td style="border: 1px solid black;"><strong> Estado </strong></td>


        <td style="border: 1px solid black;"><strong> Cantidad </strong></td>


        
     @foreach ($datos as $key =>$item)
     <tr>
        <td style="border: 1px solid black;">{{$item['id']}}</td>
        <td style="border: 1px solid black;">{{$item['nombre']}}</td>
        <td style="border: 1px solid black;">{{$item['subtotal']}}</td>
        <td style="border: 1px solid black;">{{$item['total']}}</td> 
        <td style="border: 1px solid black;">{{$item['nombre_estado']}}</td> 
        <td style="border: 1px solid black;">{{$item['cantidad']}}</td>   
                                             
     </tr>                           
     @endforeach
     
</table>
    
 </body>
    
   
</html>