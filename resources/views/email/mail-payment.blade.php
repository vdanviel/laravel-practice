    <div style="background:white; width:177%; height:100%; display:flex; justify-content: center; align-items: center; font-family: Arial, Helvetica, sans-serif">

        <div style="padding:25px; border-radius: 16px; background-color: white; width:50%; height:auto; display:flex; justify-content: center; flex-direction: column; align-items: center;">
    
            <div style="text-align: center">
                
                <img src="{{$message->embed($image_checked)}}" height="100" width="100" alt="checked">

                <h1 style="color: #242424; margin:0; margin-top:30px;">
                    {{$name}},<br> Seu pagamento foi efetuado com sucesso!
                </h1>
                
                <div style="text-align: -webkit-center;">
                    <table style="display: table; text-align: center; margin: 20px">
                        <tr>
                            <th>Total</th>
                            <th>Data</th>
                            <th>Método</th>
                        </tr>
                        <tr>
                            <td>R${{$price}}</td>
                            <td>{{$date}}</td>
                            <td>{{$payment_method}}</td>
                        </tr>
                    </table>
                </div>
    
                <p>Dolore culpa dolore ut dolore dolor incididunt voluptate. Mollit labore ex reprehenderit mollit in irure voluptate excepteur culpa. Aute dolor excepteur labore ea fugiat minim qui quis et pariatur laborum deserunt quis.</p>
        
                <h5>Obrigado por comprar conosco.</h5>
    
                <h5 style="margin-bottom:0;">Some practice &#128170; - 
                    <a href="https://www.github.com/vdanviel" style="color:#242424;">
                        <img src="{{$message->embed($image_github)}}" alt="github">
                        vdanviel
                    </a>
                </h5>
    
            </div>
            
        </div>
    
    </div>