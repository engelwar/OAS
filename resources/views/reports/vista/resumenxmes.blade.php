@extends('layouts.app')

@section('estilo')
<style>
  body {
    font-size: 0.9rem;
  }

  .derecha td,
  .derecha th {
    text-align: end;
  }

  #table_ventas thead {
    position: sticky;
    top: 0;
    z-index: 10;
  }
  #app {
    display: none;
  }
</style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])
<div class="mt-5 mb-3" style="width: 90%; height: 670px; margin: auto; overflow: scroll;">
  <div>
    <div style="width: 20%;">
      <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                              height: auto;" />
    </div>
    <div>
      <h3 class="text-center">COMPARATIVO DE VENTAS</h3>
    </div>
  </div>
  <table id="table_ventas" class="table table-striped table-bordered table-sm table-responsive">
    <thead class="text-white" style="background-color: #283056;">
      <TR>
        <TH colspan="1" class="text-center"></TH>
       
        @foreach ($options as $k => $value)

        <TH colspan="4" class="text-center">{{$value}}</TH>
        @endforeach
        <TH colspan="4" class="text-center" style="background-color: #284556;">COMPARATIVO ANUAL</TH>
      </TR>
      <TR>
        <TH colspan="1" class="text-center"></TH>
        @foreach ($options as $k => $value)
        <TH colspan="1" class="text-center">2019</TH>
        <TH colspan="1" class="text-center">2020</TH>
        <TH colspan="1" class="text-center">2021</TH>
        <TH colspan="1" class="text-center">2022</TH>
        @endforeach
        <TH colspan="1" class="text-center" style="background-color: #284556;">2019</TH>
        <TH colspan="1" class="text-center" style="background-color: #284556;">2020</TH>
        <TH colspan="1" class="text-center" style="background-color: #284556;">2021</TH>
        <TH colspan="1" class="text-center" style="background-color: #284556;">2022</TH>
      </TR>
    </thead>
    <tbody>
      <TR class="">
        <Td colspan="1" class="text-center"></Td>
        @foreach ($options as $k => $value)
        <Td colspan="1" class="text-center">{{$value}}</Td>
        <Td colspan="1" class="text-center">{{$value}}</Td>
        <Td colspan="1" class="text-center">{{$value}}</Td>
        <Td colspan="1" class="text-center">{{$value}}</Td>
        @endforeach
        <Td colspan="1" class="text-center" style="background-color: #284556;">COMPARATIVO ANUAL</Td>
        <Td colspan="1" class="text-center" style="background-color: #284556;">COMPARATIVO ANUAL</Td>
        <Td colspan="1" class="text-center" style="background-color: #284556;">COMPARATIVO ANUAL</Td>
        <Td colspan="1" class="text-center" style="background-color: #284556;">COMPARATIVO ANUAL</Td>
      </TR>
      <tr class="bg-primary text-end text-white" style="font-weight: bold;">
        <td class="text-start" style="width: 14%;">SUMA GENERAL</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td>44</td>
        <td>44</td>
        <td>{{ $total_general[0]->$val1}}</td>
        <td>{{ $total_general[0]->$val2}}</td>
        @endforeach
        <td>88</td>
        <td>88</td>
        <td>{{ $total_general[0]->Tot1}}</td>
        <td>{{ $total_general[0]->Tot2}}</td>
      </tr>
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">SUCURSAL BALLIVIAN</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        @if ($value=="Enero")
        <td>440,348.93</td>    
        <td>388,409.86</td> 
        @endif
        
        @if ($value=="Febrero")
        <td>500.639,11</td>    
        <td>478.107,56</td> 
        @endif
        
        @if ($value=="Marzo")
        <td>177.278,10</td>    
        <td>128.066,42 </td> 
        @endif
        
        @if ($value=="Abril")
        <td>156.035,79</td>    
        <td>0,00</td> 
        @endif
        
        @if ($value=="Mayo")
        <td>130.247,12
        </td>    
         <td>723,02</td> 
        @endif
        
        @if ($value=="Junio")
        <td>150.236,76</td>    
        <td>113.389,69</td> 
        @endif
        
        @if ($value=="Julio")
        <td>141.357,51</td>    
        <td>92.619,62</td> 
        @endif
        
        @if ($value=="Agosto")
        <td>120.111,97</td>    
        <td>76.494,68</td> 
        @endif
        
        @if ($value=="Septiembre")
        <td>203.046,23</td>    
        <td>116.231,47</td> 
        @endif
        

        @if ($value=="Octubre")
        <td>132.808,72</td>    
        <td>95.066,21</td> 
        @endif

        @if ($value=="Noviembre")
        <td>128.258,66</td>    
        <td>195.058,58</td> 
        @endif
        @if ($value=="Diciembre")
        <td>169.932,69</td>    
        <td>137.845,04</td> 
        @endif
        
        @if ($value=="Enero"&&$total[0]['BALLIVIAN'][0]->$val1==0.00)
            <td>142.423,02</td>
        @else
          @if ($value=="Febrero"&&$total[0]['BALLIVIAN'][0]->$val2==0.00)
              <td>302.272,91</td>
          @else
          <td>{{ $total[0]['BALLIVIAN'][0]->$val1 }}</td> 
          @endif
     
        @endif
        
        <td>{{ $total[0]['BALLIVIAN'][0]->$val2 }}</td>
        @endforeach
     
        <td>2.241.219,68</td><!--el total -->
        <td>1.651.344,02</td>
       
        <td>{{ $total[0]['BALLIVIAN'][0]->Tot1 }}</td>
        <td>{{ $total[0]['BALLIVIAN'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg[0]['BALLIVIAN'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->adusrNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        
        @if ($value=="Enero")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td class="ss">176.193,96</td>
            <td>14.004,66 </td>
            <td>0,00
            </td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>34.681,10</td>
            <td>51.279,30</td>
            <td>11.546,90
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>10.541,11</td>
            <td>11.060,06</td>
            <td>20.685,00
            </td>
           @endif
        @endif
        @if ($value=="Febrero")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td class="ss">87.893,05</td>
            <td>29.623,95
            </td>
            <td>
              4.201,00
            </td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>226.669,10</td>
            <td>244.799,70</td>
            <td>136.346,80
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>4.982,37</td>
            <td>14.108,67</td>
            <td>
              4.530,41

            </td>
           @endif
        @endif
        @if ($value=="Marzo")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td class="ss">13.517,70
            </td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>53.699,00
            </td>
            <td>37.423,20
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>5.025,15
            </td>
            <td>31.481,55
            </td>
           @endif
        @endif
        @if ($value=="Abril")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>5.163,70
            </td>
            <td>0,00
            </td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>20.797,80
            </td>
            <td>0,00
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>7.765,69
            </td>
            <td>0,00
            </td>
           @endif
        @endif
        @if ($value=="Mayo")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>0,00</td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>18.148,70
            </td>
            <td>611,30
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>10.391,18
            </td>
            <td>0,00
            </td>
           @endif
        @endif
        @if ($value=="Junio")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>0,00</td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>9.921,65
            </td>
            <td>13.355,80
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>34.635,60
            </td>
            <td>4.043,40
            </td>
           @endif
        @endif
        @if ($value=="Julio")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>0,00</td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>13.390,90
            </td>
            <td>6.754,60
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>5.667,62
            </td>
            <td>36.627,93
            </td>
           @endif
        @endif
        @if ($value=="Agosto")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>39.651,95
            </td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>176.193,96</td>
            <td>14.004,66 </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>176.193,96</td>
            <td>14.004,66 </td>
           @endif
        @endif
        @if ($value=="Septiembre")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>6.011,16
            </td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>29.328,05
            </td>
            <td>9.148,90
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>51.452,55
            </td>
            <td>14.319,95
            </td>
           @endif
        @endif
        @if ($value=="Octubre")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>0,00</td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>13.426,50
            </td>
            <td>14.298,98
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>9.205,80
            </td>
            <td>0,00</td>
           @endif
        @endif
        @if ($value=="Noviembre")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>0,00</td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>3.546,10
            </td>
            <td>12.334,70
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>23.525,70</td>
            <td>770,06</td>
           @endif
        @endif
        @if ($value=="Diciembre")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>0,00</td>
            <td>0,00</td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>11.672,55
            </td>
            <td>8.234,82
            </td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>14.567,71
            </td>
            <td>12.965,31
            </td>
           @endif
        @endif
        
        @if ($value!="Enero"&&$value!="Febrero")
        <td>{{ $val->$val1 }}</td> 
        @endif
        
        <td>{{ $val->$val2 }}</td>
        @endforeach
         <td>123</td>
      
        <td>{{$val->adusrNomb}} {{$k}}</td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
      <tr class="text-end">
        <td class="text-start">RETAIL</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        @if ($value=="Enero")
            <td>186.044,81
            </td>
            <td>155.402,37
            </td>  
            <td>110.191,12
            </td>            
        @endif
        @if ($value=="Febrero")
        <td>268.987,64
        </td>
        <td>219.199,19
        </td> 
        <td>161.395,70
        </td>              
        @endif
        @if ($value=="Marzo")
        <td>118.553,95
        </td>
        <td>59.161,67
        </td>                 
        @endif
        @if ($value=="Abril")
        <td>127.472,30
        </td>
        <td>0,00
        </td>                 
        @endif
        @if ($value=="Mayo")
        <td>101.707,24
        </td>
        <td>111,72
        </td>              
        @endif
        @if ($value=="Junio")
        <td>105.679,51
        </td>
        <td>95.990,49
        </td>               
        @endif
        @if ($value=="Julio")
        <td>122.298,99
        </td>
        <td>49.237,09
        </td>              
        @endif
        @if ($value=="Agosto")
        <td>103.953,14
        </td>
        <td>57.718,75
        </td>                
        @endif
        @if ($value=="Septiembre")
        <td>122.265,63
        </td>
        <td>92.762,62
        </td>               
        @endif
        @if ($value=="Octubre")
        <td>110.176,42
        </td>
        <td>80.767,23
        </td>               
        @endif
        @if ($value=="Noviembre")
        <td>101.186,86
        </td>
        <td>181.953,82
        </td>                
        @endif
        @if ($value=="Diciembre")
        <td>143.692,43
        </td>
        <td>116.644,91
        </td>                
        @endif
        @if ($value!="Enero"&&$value!="Febrero")
        <td>{{ $total_retail[0]['BALLIVIAN'][0]->$val1 }}</td>   
        @endif
        
        <td>{{ $total_retail[0]['BALLIVIAN'][0]->$val2 }}</td>
        @endforeach
        <td>11</td>
        <td>11</td>
        <td>{{ $total_retail[0]['BALLIVIAN'][0]->Tot1 }}</td>
        <td>{{ $total_retail[0]['BALLIVIAN'][0]->Tot2 }}</td>
      </tr>
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">SUCURSAL HANDAL</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        @if ($value=="Enero")
        <td>368.632,59
        </td>    
        <td>451.405,91
        </td> 
        @endif
        
        @if ($value=="Febrero")
        <td>760.261,92
        </td>    
        <td>549.250,15
        </td> 
        @endif
        
        @if ($value=="Marzo")
        <td>393.815,50
        </td>    
        <td>167.548,28
        </td> 
        @endif
        
        @if ($value=="Abril")
        <td>317.294,33
        </td>    
        <td>91.477,34
        </td> 
        @endif
        
        @if ($value=="Mayo")
        <td>235.646,50
        </td>    
         <td>100.336,76
        </td> 
        @endif
        
        @if ($value=="Junio")
        <td>266.317,17
        </td>    
        <td>210.269,07
        </td> 
        @endif
        
        @if ($value=="Julio")
        <td>343.948,62
        </td>    
        <td>199.998,16
        </td> 
        @endif
        
        @if ($value=="Agosto")
        <td>296.007,78
        </td>    
        <td>239.477,71
        </td> 
        @endif
        
        @if ($value=="Septiembre")
        <td>203.046,23</td>    
        <td>116.231,47</td> 
        @endif
        

        @if ($value=="Octubre")
        <td>268.364,97
        </td>    
        <td>237.885,30
        </td> 
        @endif

        @if ($value=="Noviembre")
        <td>330.136,48
        </td>    
        <td>356.698,17
        </td> 
        @endif
        @if ($value=="Diciembre")
        <td>335.867,93
        </td>    
        <td>343.440,08
        </td> 
        @endif
        
   
       
        <td>{{ $total[1]['HANDAL'][0]->$val1 }}</td>
        <td>{{ $total[1]['HANDAL'][0]->$val2 }}</td>
        @endforeach
        <td>{{$k}}</td>
        <td>{{$k}}</td>
        <td>{{ $total[1]['HANDAL'][0]->Tot1 }}</td>
        <td>{{ $total[1]['HANDAL'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg[1]['HANDAL'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->adusrNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <!--datp-->
        <td>{{ $val->adusrNomb }}</td>
        <td>{{ $val->adusrNomb }}</td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
      <tr class="text-end">
        <td class="text-start">RETAIL</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $total_retail[1]['HANDAL'][0]->$val1 }}</td>
        <td>{{ $total_retail[1]['HANDAL'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total_retail[1]['HANDAL'][0]->Tot1 }}</td>
        <td>{{ $total_retail[1]['HANDAL'][0]->Tot2 }}</td>
      </tr>
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">SUCURSAL MARISCAL</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td>{{$k}}</td>
        <td>{{$k}}</td>
        <td>{{ $total[2]['MARISCAL'][0]->$val1 }}</td>
        <td>{{ $total[2]['MARISCAL'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total[2]['MARISCAL'][0]->Tot1 }}</td>
        <td>{{ $total[2]['MARISCAL'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg[2]['MARISCAL'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->adusrNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
      <tr class="text-end">
        <td class="text-start">RETAIL</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $total_retail[2]['MARISCAL'][0]->$val1 }}</td>
        <td>{{ $total_retail[2]['MARISCAL'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total_retail[2]['MARISCAL'][0]->Tot1 }}</td>
        <td>{{ $total_retail[2]['MARISCAL'][0]->Tot2 }}</td>
      </tr>
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">SUCURSAL CALACOTO</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td>{{$k}}</td>
        <td>{{$k}}</td>
        <td>{{ $total[3]['CALACOTO'][0]->$val1 }}</td>
        <td>{{ $total[3]['CALACOTO'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total[3]['CALACOTO'][0]->Tot1 }}</td>
        <td>{{ $total[3]['CALACOTO'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg[3]['CALACOTO'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->adusrNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
      <tr class="text-end">
        <td class="text-start">RETAIL</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $total_retail[3]['CALACOTO'][0]->$val1 }}</td>
        <td>{{ $total_retail[3]['CALACOTO'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total_retail[3]['CALACOTO'][0]->Tot1 }}</td>
        <td>{{ $total_retail[3]['CALACOTO'][0]->Tot2 }}</td>
      </tr>
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">INSTITUCIONALES</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td>{{$k}}</td>
        <td>{{$k}}</td>
        <td>{{ $total[4]['INSTITUCIONALES'][0]->$val1 }}</td>
        <td>{{ $total[4]['INSTITUCIONALES'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total[4]['INSTITUCIONALES'][0]->Tot1 }}</td>
        <td>{{ $total[4]['INSTITUCIONALES'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg[4]['INSTITUCIONALES'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->adusrNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">MAYORISTAS</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td>{{$k}}</td>
        <td>{{$k}}</td>
        <td>{{ $total[5]['MAYORISTAS'][0]->$val1 }}</td>
        <td>{{ $total[5]['MAYORISTAS'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total[5]['MAYORISTAS'][0]->Tot1 }}</td>
        <td>{{ $total[5]['MAYORISTAS'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg[5]['MAYORISTAS'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->adusrNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">SANTA CRUZ</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
       <td>{{$k}}</td>
       <td>{{$k}}</td>
        <td>{{ $total[6]['SANTA CRUZ'][0]->$val1 }}</td>
        <td>{{ $total[6]['SANTA CRUZ'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total[6]['SANTA CRUZ'][0]->Tot1 }}</td>
        <td>{{ $total[6]['SANTA CRUZ'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg[6]['SANTA CRUZ'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->adusrNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
  
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">REGIONAL 1</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
       <td>{{$k}}</td>
       <td>{{$k}}</td>
        <td>{{ $total_regional[0]['REGIONAL1'][0]->$val1 }}</td>
        <td>{{ $total_regional[0]['REGIONAL1'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total_regional[0]['REGIONAL1'][0]->Tot1 }}</td>
        <td>{{ $total_regional[0]['REGIONAL1'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg_regional[0]['REGIONAL1'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->inalmNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
      <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
        <td class="text-start">REGIONAL 2</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td>{{$k}}</td>
        <td>{{$k}}</td>
        <td>{{ $total_regional[1]['REGIONAL2'][0]->$val1 }}</td>
        <td>{{ $total_regional[1]['REGIONAL2'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $total_regional[1]['REGIONAL2'][0]->Tot1 }}</td>
        <td>{{ $total_regional[1]['REGIONAL2'][0]->Tot2 }}</td>
      </tr>
      @foreach ($total_seg_regional[1]['REGIONAL2'] as $val)
      <tr class="text-end">
        <td class="text-start">{{ $val->inalmNomb }}</td>
        @foreach ($options as $k => $value)
        @php
        $val1 = $value."1";
        $val2 = $value."2";
        @endphp
        <td></td>
        <td></td>
        <td>{{ $val->$val1 }}</td>
        <td>{{ $val->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
        <td>{{ $val->Tot1 }}</td>
        <td>{{ $val->Tot2 }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@section('mis_scripts')
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.templates.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table_ventas').DataTable({
      "ordering": false,
      dom: 'Bfrtip',
      buttons: {
        dom:{
          button:{
            className: 'btn'
          }
        },
        buttons:[
          {
            extend: "excel",
            text: 'Exportar a Excel',
            className: 'btn btn-outline-success mb-2',
            excelStyles:{
              cells: ["2","3","4","10","15","20","27","35","41","44","47"],
              style:{
                font:{
                  name: 'Arial',
                  size: '12',
                  color: 'ffffff',
                  b: true
                },
                fill:{
                  pattern:{
                    color: '283056'
                  }
                }
              },
            }
          }
        ]
      },
      "aLengthMenu": [100]
    });
  });
  $(".page-wrapper").removeClass("toggled");


var sum=0;
$('.ss').each(function() {  
 sum += parseFloat($(this).text().replace(/,/g, ''), 10);  
}); 
$("#t").val(sum.toFixed(2));
</script>
@endsection