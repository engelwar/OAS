<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        @font-face {
            font-family: "fuente";
            src: url('{{storage_path("fonts/light.ttf")}}') format("truetype");;
        }
        @font-face {
            font-family: "bold";
            src: url('{{storage_path("fonts/futura_book.ttf")}}') format("truetype");
            font-weight: bold;
        }
        html
        { 
            font-family: "fuente" !important;            
        }
        .bold
        { 
            font-family: "bold" !important;
            
        }
        @page { margin: 1cm 1cm 1cm 1cm; }

        .page-number:before {
        content: "Pagina " counter(page);
        }
        td {
  border: 1px none black;
}
    </style>
</head>
<!--div id="footer">
  <div class="page-number"></div>
</div-->
<body>
    <!--table style="margin-left: 280px; margin-top: 200px">
        <tr>
            <td>
                {{$fo->id}} {{$fo->nombre}} 
            </td>
        </tr>
    <tr>
        <td>
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(151)->margin(4)->generate($fo->qr)) !!}">
        </td>
    </tr>
    </table-->
    <table>
<tr><td>COMPUTADORAS</td></tr>
    </table>
<table>
    @if($form->count())
        @foreach($form as $fo)
        <tr> 
            @foreach($fo as $f)
            <td>
                <table>
                    <tr>
                        <td>
                            {{$f->id}} {{$f->nombre}} 
                        </td>
                    </tr>
                <tr>
                    <td>
                        <img style="border:solid;" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->margin(4)->generate($f->qr)) !!}">
                    </td>
                </tr>
                </table>
            </td> 
            @endforeach           
        </tr>                  
        @endforeach
    @endif 
</table>
<table>
    <tr><td>Monitores</td></tr>
        </table>
    <table>
        @if($monitor->count())
            @foreach($monitor as $mo)
            <tr> 
                @foreach($mo as $m)
                <td>
                    <table>
                        <tr>
                            <td>
                                {{$m->id}}
                                @if($m->pc)
                                @endif
                            </td>
                        </tr>
                    <tr>
                        <td>
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(94)->generate($m->qr)) !!}" style="width:84px;">
                        </td>
                    </tr>
                    </table>
                </td> 
                @endforeach           
            </tr>                  
            @endforeach
        @endif 
    </table>
    <table>
        <tr><td>Teclado</td></tr>
            </table>
        <table>
            @if($teclado->count())
                @foreach($teclado as $te)
                <tr> 
                    @foreach($te as $t)
                    <td>
                        <table>
                            <tr>
                                <td>
                                    {{$t->id}}
                                    @if($t->pc)
                                      pc:  {{$t->pc->id}}
                                    @endif
                                </td>
                            </tr>
                        <tr>
                            <td>
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(40)->generate($t->qr)) !!}" style="width: 40px;">
                            </td>
                        </tr>
                        </table>
                    </td> 
                    @endforeach           
                </tr>                  
                @endforeach
            @endif 
        </table>
        <table>
            <tr><td>Mouse</td></tr>
                </table>
            <table>
                @if($mouse->count())
                    @foreach($mouse as $mou)
                    <tr> 
                        @foreach($mou as $mo)
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        {{$mo->id}}
                                        @if($mo->pc)
                                        -{{$mo->pc->id}}
                                        @endif
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(40)->margin(0)->generate($mo->qr)) !!}" style="width: 40px;">
                                </td>
                            </tr>
                            </table>
                        </td> 
                        @endforeach           
                    </tr>                  
                    @endforeach
                @endif 
            </table>
            <table>
                <tr><td>Impresoras</td></tr>
                    </table>
                <table>
                    @if($mouse->count())
                        @foreach($imp_ter as $imp)
                        <tr> 
                            @foreach($imp as $im)
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            {{$im->id}}
                                            @if($im->pc)
                                            -{{$im->pc->id}}
                                            @endif
                                        </td>
                                    </tr>
                                <tr>
                                    <td>
                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(70)->margin(0)->generate($im->qr)) !!}" style="width: 70px;">
                                    </td>
                                </tr>
                                </table>
                            </td> 
                            @endforeach           
                        </tr>                  
                        @endforeach
                    @endif 
                </table>
</div>     
</body>
</html>

