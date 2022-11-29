<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div style="float: right;">
            <img src= "./images/biormed_logo.jpg" width="200">
            </div>
      <h3>BIORMED</h3>
       <h3> INVENTARIO</h3>  
       {{now()}}        
    <hr/>
    
 
   
   <table style="border: 1px solid black;  border-collapse: collapse;">
    <tr style="border: 1px solid black;">            
        <td style="border: 1px solid black;"><strong> # </strong></td>
                
        <td style="border: 1px solid black;"><strong> Porducto </strong></td>
              
        <td style="border: 1px solid black;"><strong> Descripcion </strong></td>
               
        <td style="border: 1px solid black;"><strong> Bodega </strong></td>

        <td style="border: 1px solid black;"><strong> Stock </strong></td>
    </tr>
    @foreach ($datos_detalle as $pedido)
                            <tr>
                            
                                <td style="border: 1px solid black;">
                                    <div class="text-sm text-gray-900"> {{ $pedido->indice }}</div>
                                </td>
                                <td style="border: 1px solid black;">
                                    <div class="text-sm text-gray-900"> {{ $pedido->codigo }}</div>
                                </td>
                                <td style="border: 1px solid black;">
                                    <div class="text-sm text-gray-900"> {{ $pedido->producto }}</div>
                                </td>
                                <td style="border: 1px solid black;">
                                    <div class="text-sm text-gray-900"> {{ $pedido->ciudad }}</div>
                                </td>
                                <td style="border: 1px solid black;">
                                    <div class="text-sm text-gray-900"> {{ $pedido->stock }}</div>
                                </td>
                                
                            
                            </tr>
                        @endforeach
     
</table>
    
 </body>
    
   
</html>