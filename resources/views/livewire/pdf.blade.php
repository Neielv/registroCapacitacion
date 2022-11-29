<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div style="float: right;">
            <img src= "./images/biormed_logo.jpg" width="200">
            </div>
      <h3>BIORMED</h3>
          <h3>  Nota de pedido</h3>          
    <hr/>
    
    <table>
        <tr>
            <td><strong> Nro: </strong>  {{$datos->id}} </td>            
        </tr>
        <tr>            
            <td><strong> Fecha: </strong> {{$fecha}}
            </td>
        </tr>
        <tr>            
            <td><strong> Cédula/Ruc: </strong> {{$cedula}}
            </td>
        </tr>
        <tr>            
            <td><strong> Cliente: </strong> {{$cliente}}
            </td>
        </tr>
        <tr>            
            <td><strong> Teléfono: </strong> {{$telefono}}
            </td>
        </tr>
        <tr>            
            <td><strong> email: </strong> {{$email}}
            </td>
        </tr>
        <tr>            
            <td><strong> Nota de devolución: </strong> {{$devolucion}}
            </td>
        </tr>
        <tr>            
            <td><strong> Factura: </strong> {{$factura}}
            </td>
        </tr>
    </table><br/><br/>
    <table style="border: 1px solid black;  border-collapse: collapse;">
        <tr style="border: 1px solid black;">            
            <td style="border: 1px solid black;"><strong> Cantidad </strong></td>
                    
            <td style="border: 1px solid black;"><strong> Porducto </strong></td>
                  
            <td style="border: 1px solid black;"><strong> Precio </strong></td>
                   
            <td style="border: 1px solid black;"><strong> Subtotal </strong></td>
        </tr>
        @foreach ($orderProduct as $key =>$item)
         <tr>
            <td style="border: 1px solid black;">{{$item['cantidad']}}</td>
             <td style="border: 1px solid black;">{{$item['nombre']}}</td>
             <td style="border: 1px solid black;">{{$item['precio']}}</td>
             <td style="border: 1px solid black;">{{$item['subtotal']}}</td>                                                        
         </tr>                           
         @endforeach
         <tr>
            <td colspan="3" style="text-align:right; padding-right: 22px; "><strong> Subtotal</strong></td>
            <td style="text-align:left; margin-right: 8px; border: 1px solid black;">USD {{$subtotal}}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding-right: 22px;"><strong>Iva</strong></td>
            <td style="text-align:left; margin-right: 8px; border: 1px solid black;">USD {{$iva}}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding-right: 22px;"><strong>Total</strong></td>
            <td style="text-align:left; margin-right: 8px; border: 1px solid black;">USD {{$total}}</td>
        </tr>
    </table>
 </body>
    
   
</html>