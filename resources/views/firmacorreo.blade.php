<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="resources/style.css">
    <style>
        .imagen
        {
            width:130px;
            height: 130px;
            vertical-align:middle;
            border-radius:15%;
        }

@font-face {font-family: "FuturaBold";
    src: url("http://db.onlinewebfonts.com/t/9ab8abd11c40ee5c8d1905f9c9cb9ac8.eot"); /* IE9*/
    src: url("http://db.onlinewebfonts.com/t/9ab8abd11c40ee5c8d1905f9c9cb9ac8.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
    url("http://db.onlinewebfonts.com/t/9ab8abd11c40ee5c8d1905f9c9cb9ac8.woff2") format("woff2"), /* chrome firefox */
    url("http://db.onlinewebfonts.com/t/9ab8abd11c40ee5c8d1905f9c9cb9ac8.woff") format("woff"), /* chrome firefox */
    url("http://db.onlinewebfonts.com/t/9ab8abd11c40ee5c8d1905f9c9cb9ac8.ttf") format("truetype"), /* chrome firefox opera Safari, Android, iOS 4.2+*/
    url("http://db.onlinewebfonts.com/t/9ab8abd11c40ee5c8d1905f9c9cb9ac8.svg#Futura") format("svg"); /* iOS 4.1- */
}
@font-face {font-family: "FuturaBook";
    src: url("http://db.onlinewebfonts.com/t/fd6e6c30c7d355528ba9428eea942445.eot"); /* IE9*/
    src: url("http://db.onlinewebfonts.com/t/fd6e6c30c7d355528ba9428eea942445.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
    url("http://db.onlinewebfonts.com/t/fd6e6c30c7d355528ba9428eea942445.woff2") format("woff2"), /* chrome firefox */
    url("http://db.onlinewebfonts.com/t/fd6e6c30c7d355528ba9428eea942445.woff") format("woff"), /* chrome firefox */
    url("http://db.onlinewebfonts.com/t/fd6e6c30c7d355528ba9428eea942445.ttf") format("truetype"), /* chrome firefox opera Safari, Android, iOS 4.2+*/
    url("http://db.onlinewebfonts.com/t/fd6e6c30c7d355528ba9428eea942445.svg#Futura") format("svg"); /* iOS 4.1- */
}
@font-face {font-family: "FuturaLight";
    src: url("http://db.onlinewebfonts.com/t/2167e76f00e569cc11b3665679996380.eot"); /* IE9*/
    src: url("http://db.onlinewebfonts.com/t/2167e76f00e569cc11b3665679996380.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
    url("http://db.onlinewebfonts.com/t/2167e76f00e569cc11b3665679996380.woff2") format("woff2"), /* chrome firefox */
    url("http://db.onlinewebfonts.com/t/2167e76f00e569cc11b3665679996380.woff") format("woff"), /* chrome firefox */
    url("http://db.onlinewebfonts.com/t/2167e76f00e569cc11b3665679996380.ttf") format("truetype"), /* chrome firefox opera Safari, Android, iOS 4.2+*/
    url("http://db.onlinewebfonts.com/t/2167e76f00e569cc11b3665679996380.svg#Futura Light") format("svg"); /* iOS 4.1- */
}
        @import url(http://db.onlinewebfonts.com/c/2167e76f00e569cc11b3665679996380?family=Futura+Light);
        p{
            font-family: "Futurabold";  
        }
        .hexa
        {
            clip-path: polygon(50% 0%, 90% 20%, 100% 60%, 75% 100%, 25% 100%, 0% 60%, 10% 20%);
        }
    </style>
        <script>
            function copyToClipboard(id) {
                
               var xd =  document.getElementById(id).select();
               alert("XD");
                document.execCommand('copy');
            }
        </script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <table  width="700" cellspacing="0" cellpadding="0" border="0" id="firmaxd">
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td width="180" style="padding:0px 8px 0px 0px">
                            <table cellspacing="0" cellpadding="0" border="0" style="vertical-align:middle;">
                                <tr>
                                    <td colspan="2">
                                        <img alt="logo" src="{{asset("imagenes/firmacorreo/logo.png")}}" width="180"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 4px 0 0 0;text-align: center;" >
                                        <a target="_blank" class="social_link" href="https://www.facebook.com/olimpialibreria">
                                            <img alt="facebook" style="width:22px;" width="22" src="{{asset("imagenes/firmacorreo/facebook.png")}}">
                                        </a>
                                    </td>
                                    <td style="padding: 4px 0 0 0;text-align: center;" >
                                        <a target="_blank" class="social_link" href="https://www.instagram.com/libreriaolimpia/">
                                            <img alt="instagram" style="width:22px;" width="22" src="{{asset("imagenes/firmacorreo/instagram.png")}}">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>  
                        <td style="font-size:1em;padding:0 15px 0 8px;vertical-align:middle;" valign="top"> 
                            <table cellspacing="0" cellpadding="0" border="0" style="line-height: 1.4;font-size:90%;color: #000001;"> 
                                <tr> 
                                    <td> 
                                        <div style="font: 1em Futurabook !important;color:#203972;">
                                            <strong>{{Auth::user()->perfiles->nombre." ".Auth::user()->perfiles->paterno." ".Auth::user()->perfiles->materno}}</strong>
                                        </div> 
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td> 
                                        <div style="color:#203972;font-family:FuturaBook !important; font-size: 0.8rem;"> 
                                            {{Auth::user()->perfiles->cargo}}
                                        </div> 
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td> 
                                        <div style="color:#203972;font-family:FuturaBook !important; font-size: 0.8rem;"> 
                                            LIBRERIA Y PAPELERIA OLIMPIA SRL.
                                        </div> 
                                    </td> 
                                </tr> 
                                <tr> 
                                    <td> 
                                        <span style="font-family:FuturaLight !important;font-size: 0.9rem;">
                                            <img src="{{asset("imagenes/firmacorreo/phone.png")}}" width="12">
                                        </span> 
                                        <span>
                                            <a style="text-decoration:none;font-family:Futuralight !important;color:#203972;font-size: 0.8rem;" href="tel:telefono">
                                                (+591-2) 2204106 - 2203905 Int.108 / Celular (+591) 767-53245.
                                            </a>
                                        </span> 
                                    </td> 
                                </tr>         
                                <tr> 
                                    <td>
                                        <span>
                                            <a href="mailto:correo" target="_blank" style="font-family:Futuralight !important;color:#203972;font-size: 0.9rem;">
                                                Correo@libreriaolimpia.com
                                            </a>
                                        </span>
                                    </td> 
                                </tr>     
                                <tr> 
                                    <td> 
                                        <a href="http://www.libreriaolimpia.com" target="_blank" style="font-family:Futuralight !important;color:#203972;font-size: 0.9rem;">
                                            www.libreriaolimpia.com
                                        </a>
                                    </td> 
                                </tr>   
                            </table> 
                        </td>   
                    </tr>
                </table> 
            </td> 
        </tr>
    </table>
</body>

</html