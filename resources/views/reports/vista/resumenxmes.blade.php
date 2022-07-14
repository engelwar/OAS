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
            <td>176.193,96</td>
            <td>14.004,66 </td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>34.681,10</td>
            <td>51.279,30</td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>10.541,11</td>
            <td>11.060,06</td>
           @endif
        @endif
        @if ($value=="Febrero")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>87.893,05</td>
            <td>29.623,95
            </td>
           @endif
           @if ($val->adusrNomb=="CAJERO LIBRO BALLIVIAN")
            <td>226.669,10</td>
            <td>244.799,70</td>
           @endif
           @if ($val->adusrNomb=="INS BALLIVIAN")
            <td>4.982,37</td>
            <td>14.108,67</td>
           @endif
        @endif
        @if ($value=="Marzo")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>13.517,70
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
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        @if ($value=="Mayo")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        @if ($value=="Junio")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        @if ($value=="Julio")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        @if ($value=="Agosto")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        @if ($value=="Octubre")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        @if ($value=="Noviembre")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        @if ($value=="Diciembre")
           @if ($val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
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
        
       <td>{{ $val->$val1 }}</td>
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
      
        @if ($value=="Enero")
        <td>174,490.36</td>
        @endif
        @if ($value=="Enero")
        <td>262,379.54</td>
        @endif
        
        @if ($value=="Febrero")
        <td>447,578.47</td>
        @endif
        @if ($value=="Febrero")
        <td>430,920.20</td>
        @endif
        
        @if ($value=="Marzo")
        <td>270,316.53</td>
        @endif
        @if ($value=="Marzo")
        <td>221,743.66</td>
        @endif
        
        @if ($value=="Abril")
        <td>274,469.37</td>
        @endif
        @if ($value=="Abril")
        <td>19,580.20</td>
        @endif
        
        @if ($value=="Mayo")
        <td>435,706.08</td>  
        @endif
        @if ($value=="Mayo")
        <td>32,775.03</td>
        @endif
        
        @if ($value=="Junio")
        <td>380,626.32</td>
        @endif
        @if ($value=="Junio")
        <td>242,005.93</td>
        @endif
        
        @if ($value=="Julio")
        <td>257,768.41</td>
        @endif
        @if ($value=="Julio")
        <td>271,506.99</td>
        @endif
        
        @if ($value=="Agosto")
        <td>288,075.86</td>
        @endif
        @if ($value=="Agosto")
        <td>232,889.40</td>
        @endif
        
        @if ($value=="Septiembre")
        <td>305,573.93</td>
        @endif
        @if ($value=="Septiembre")
        <td>263,863.58</td>
        @endif
        
        @if ($value=="Octubre")
        <td>283,797.88</td>
        @endif
        @if ($value=="Octubre")
        <td>303,518.34</td>
        @endif

        @if ($value=="Noviembre")
        <td>282,362.07</td> 
        @endif
        @if ($value=="Noviembre")
        <td>398,042.85</td>
        @endif

        @if ($value=="Diciembre")
        <td>435,544.63</td>
        @endif
        @if ($value=="Diciembre")
        <td>341,017.44</td>
        @endif

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
        
        @if ($value=="Enero")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>415.80</td>
          <td>589.90</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>34,817.38</td>
          <td>57,344.91</td>
          @endif
        @endif
        @if ($value=="Febrero")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>4,106.75</td>
          <td>3,765.70</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>187,834.00</td>
          <td>156,969.00</td>
          @endif
        @endif
        @if ($value=="Marzo")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>390.00</td>
          <td>273.80</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>142,814.11</td>
          <td>107,689.41</td>
          @endif
        @endif
        @if ($value=="Abril")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>431.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>145,192.65</td>
          <td>19,580.20</td>
          @endif
        @endif
        @if ($value=="Mayo")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>224.00</td>
          <td>18.80</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>289,214.41</td>
          <td>18,782.01</td>
          @endif
        @endif
        @if ($value=="Junio")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>0.00</td>
          <td>570.00</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>272,603.11</td>
          <td>119,480.03</td>
          @endif
        @endif
        @if ($value=="Julio")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>50.00</td>
          <td>154.30</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>120,757.42</td>
          <td>172,539.19</td>
          @endif
        @endif
        @if ($value=="Agosto")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>103.50</td>
          <td>201.70</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>155,312.17</td>
          <td>121,706.24</td>
          @endif
        @endif
        @if ($value=="Septiembre")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>132.00</td>
          <td>545.30</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>159,496.19</td>
          <td>121,652.88</td>
          @endif
        @endif
        @if ($value=="Octubre")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>151.00</td>
          <td>358.30</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>166,601.43</td>
          <td>162,944.47</td>
          @endif
        @endif
        @if ($value=="Noviembre")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>176.76</td>
          <td>66.15</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>145,672.90</td>
          <td>225,398.67</td>
          @endif
        @endif
        @if ($value=="Diciembre")
          @if ($val->adusrNomb=="CAJERO LIBRO MARISCAL")
          <td>174.24</td>
          <td>174.80</td>
          @endif
          @if ($val->adusrNomb=="INS MARISCAL")
          <td>261,670.65</td>
          <td>145,605.58</td>
          @endif
        @endif

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

        @if ($value=="Enero")
        <td></td>
        @endif
        @if ($value=="Enero")
        <td></td>
        @endif
        
        @if ($value=="Febrero")
        <td></td>
        @endif
        @if ($value=="Febrero")
        <td></td>
        @endif
        
        @if ($value=="Marzo")
        <td></td>
        @endif
        @if ($value=="Marzo")
        <td></td>
        @endif
        
        @if ($value=="Abril")
        <td></td>
        @endif
        @if ($value=="Abril")
        <td></td>
        @endif
        
        @if ($value=="Mayo")
        <td></td>  
        @endif
        @if ($value=="Mayo")
        <td></td>
        @endif
        
        @if ($value=="Junio")
        <td></td>
        @endif
        @if ($value=="Junio")
        <td></td>
        @endif
        
        @if ($value=="Julio")
        <td></td>
        @endif
        @if ($value=="Julio")
        <td></td>
        @endif
        
        @if ($value=="Agosto")
        <td></td>
        @endif
        @if ($value=="Agosto")
        <td></td>
        @endif
        
        @if ($value=="Septiembre")
        <td></td>
        @endif
        @if ($value=="Septiembre")
        <td></td>
        @endif
        
        @if ($value=="Octubre")
        <td></td>
        @endif
        @if ($value=="Octubre")
        <td></td>
        @endif

        @if ($value=="Noviembre")
        <td></td> 
        @endif
        @if ($value=="Noviembre")
        <td></td>
        @endif

        @if ($value=="Diciembre")
        <td></td>
        @endif
        @if ($value=="Diciembre")
        <td></td>
        @endif

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
        
        @if ($value=="Enero")
          @if ($val->adusrNomb=="GUADALUPE AMBA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="INES VELASQUEZ")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="MAGDY VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="VENTA MÓVIL 1")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Febrero")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Marzo")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Abril")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Mayo")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Junio")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Julio")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Agosto")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Septiembre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Octubre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Noviembre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif
        @if ($value=="Diciembre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td></td>
          <td></td>
          @endif
        @endif

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

        @if ($value=="Enero")
        <td></td>
        @endif
        @if ($value=="Enero")
        <td></td>
        @endif
        
        @if ($value=="Febrero")
        <td></td>
        @endif
        @if ($value=="Febrero")
        <td></td>
        @endif
        
        @if ($value=="Marzo")
        <td></td>
        @endif
        @if ($value=="Marzo")
        <td></td>
        @endif
        
        @if ($value=="Abril")
        <td></td>
        @endif
        @if ($value=="Abril")
        <td></td>
        @endif
        
        @if ($value=="Mayo")
        <td></td>  
        @endif
        @if ($value=="Mayo")
        <td></td>
        @endif
        
        @if ($value=="Junio")
        <td></td>
        @endif
        @if ($value=="Junio")
        <td></td>
        @endif
        
        @if ($value=="Julio")
        <td></td>
        @endif
        @if ($value=="Julio")
        <td></td>
        @endif
        
        @if ($value=="Agosto")
        <td></td>
        @endif
        @if ($value=="Agosto")
        <td></td>
        @endif
        
        @if ($value=="Septiembre")
        <td></td>
        @endif
        @if ($value=="Septiembre")
        <td></td>
        @endif
        
        @if ($value=="Octubre")
        <td></td>
        @endif
        @if ($value=="Octubre")
        <td></td>
        @endif

        @if ($value=="Noviembre")
        <td></td> 
        @endif
        @if ($value=="Noviembre")
        <td></td>
        @endif

        @if ($value=="Diciembre")
        <td></td>
        @endif
        @if ($value=="Diciembre")
        <td></td>
        @endif

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

        @if ($value=="Enero")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>234,000.10</td>
          <td>132,259.06</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>167,879.50</td>
          <td>131,158.13</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>471,071.60</td>
          <td>695,014.10</td>
          @endif
        @endif
        @if ($value=="Febrero")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>97,270.11</td>
          <td>270,771.12</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>115,210.32</td>
          <td>61,972.40</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>895,147.10</td>
          <td>782,622.82</td>
          @endif
        @endif
        @if ($value=="Marzo")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>40,934.00</td>
          <td>60,769.78</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>96,938.26</td>
          <td>12,931.50</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>315,491.86</td>
          <td>217,131.50</td>
          @endif
        @endif
        @if ($value=="Abril")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>169,941.29</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>124,334.92</td>
          <td>0.00</td>
          @endif
        @endif
        @if ($value=="Mayo")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>112,117.20</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>2,893.60</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>130,663.28</td>
          <td>0.00</td>
          @endif
        @endif
        @if ($value=="Junio")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>111,963.41</td>
          <td>68,675.90</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>161,885.18</td>
          <td>17,493.67</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>109,068.20</td>
          <td>238,801.70</td>
          @endif
        @endif
        @if ($value=="Julio")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>164,138.92</td>
          <td>59,022.65</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>97,510.00</td>
          <td>16,667.70</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>124,515.80</td>
          <td>25,146.72</td>
          @endif
        @endif
        @if ($value=="Agosto")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>164,484.67</td>
          <td>35,017.10</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>0.00</td>
          <td>4,194.90</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>230,540.20</td>
          <td>41,466.10</td>
          @endif
        @endif
        @if ($value=="Septiembre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>132,193.47</td>
          <td>86,120.45</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>42,805.86</td>
          <td>56,978.16</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>229,356.82</td>
          <td>96,174.00</td>
          @endif
        @endif
        @if ($value=="Octubre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>37,255.96</td>
          <td>126,435.72</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>35,214.65</td>
          <td>21,349.70</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>99,367.00</td>
          <td>82,459.50</td>
          @endif
        @endif
        @if ($value=="Noviembre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>106,371.44</td>
          <td>99,285.34</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>13,531.92</td>
          <td>24,973.50</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>66,381.80</td>
          <td>73,258.70</td>
          @endif
        @endif
        @if ($value=="Diciembre")
          @if ($val->adusrNomb=="DAVID CUTIPA")
          <td>0.00</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DAVID MAMANI")
          <td>104,609.00</td>
          <td>52,637.50</td>
          @endif
          @if ($val->adusrNomb=="ERWIN VILLARROEL")
          <td>59,859.44</td>
          <td>38,963.50</td>
          @endif
          @if ($val->adusrNomb=="JAVIER MACHICADO")
          <td></td>
          <td></td>
          @endif
          @if ($val->adusrNomb=="ROSALIA TICONA")
          <td>237,718.54</td>
          <td>63,462.40</td>
          @endif
        @endif

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
        @if ($value=="Enero")
        <td>561,600.52</td>    
        @endif
        @if ($value=="Enero")
        <td>676,594.54</td> 
        @endif
        
        @if ($value=="Febrero")
        <td>382,253.30</td>    
        @endif
        @if ($value=="Febrero")
        <td>434,288.50</td> 
        @endif
        
        @if ($value=="Marzo")
        <td>84,672.24</td>    
        @endif
        @if ($value=="Marzo")
        <td>52,518.98</td> 
        @endif
        
        @if ($value=="Abril")
        <td>72,300.00</td>    
        @endif
        @if ($value=="Abril")
        <td>0.00</td> 
        @endif
        
        @if ($value=="Mayo")
        <td>50,068.46</td>    
        @endif
        @if ($value=="Mayo")
        <td>0.00</td> 
        @endif
        
        @if ($value=="Junio")
        <td>56,193.50</td>    
        @endif
        @if ($value=="Junio")
        <td>45,236.60</td> 
        @endif
        
        @if ($value=="Julio")
        <td>80,478.70</td>    
        @endif
        @if ($value=="Julio")
        <td>36,690.80</td> 
        @endif
        
        @if ($value=="Agosto")
        <td>139,248.70</td>    
        @endif
        @if ($value=="Agosto")
        <td>42,483.60</td> 
        @endif
        
        @if ($value=="Septiembre")
        <td>99,842.70</td>    
        @endif
        @if ($value=="Septiembre")
        <td>82,528.00</td> 
        @endif
        
        @if ($value=="Octubre")
        <td>83,826.68</td>    
        @endif
        @if ($value=="Octubre")
        <td>43,755.70</td> 
        @endif

        @if ($value=="Noviembre")
        <td>36,459.24</td>    
        @endif
        @if ($value=="Noviembre")
        <td>83,501.90</td> 
        @endif

        @if ($value=="Diciembre")
        <td>51,365.50</td>    
        @endif
        @if ($value=="Diciembre")
        <td>52,485.10</td> 
        @endif

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
      
        @if ($value=="Enero")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>80,553.50</td>
          <td>89,986.96</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>313,899.60</td>
          <td>406,926.08</td>
          @endif
        @endif
        @if ($value=="Febrero")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>28,458.00</td>
          <td>76,304.52</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>84,196.20</td>
          <td>255,675.42</td>
          @endif
        @endif
        @if ($value=="Marzo")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>24,318.24</td>
          <td>31,766.00</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>20,269.60</td>
          <td>10,145.98</td>
          @endif
        @endif
        @if ($value=="Abril")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>31,478.60</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>16,910.00</td>
          <td>0.00</td>
          @endif
        @endif
        @if ($value=="Mayo")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>8,283.20</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>16,608.14</td>
          <td>0.00</td>
          @endif
        @endif
        @if ($value=="Junio")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>8,648.30</td>
          <td>0.00</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>24,041.60</td>
          <td>45,236.60</td>
          @endif
        @endif
        @if ($value=="Julio")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>20,896.90</td>
          <td>8,814.20</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>23,293.10</td>
          <td>27,876.60</td>
          @endif
        @endif
        @if ($value=="Agosto")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>57,877.20</td>
          <td>18,145.60</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>28,173.70</td>
          <td>24,338.00</td>
          @endif
        @endif
        @if ($value=="Septiembre")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>25,290.00</td>
          <td>28,367.20</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>26,121.70</td>
          <td>54,160.80</td>
          @endif
        @endif
        @if ($value=="Octubre")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>21,738.48</td>
          <td>25,743.70</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>14,323.20</td>
          <td>18,012.00</td>
          @endif
        @endif
        @if ($value=="Noviembre")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>9,464.04</td>
          <td>19,773.50</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>20,671.00</td>
          <td>63,728.40</td>
          @endif
        @endif
        @if ($value=="Diciembre")
          @if ($val->adusrNomb=="CARMELA ESCOBAR")
          <td>8,762.00</td>
          <td>16,035.40</td>
          @endif
          @if ($val->adusrNomb=="DANI CALDERON")
          <td>22,153.30</td>
          <td>36,449.70</td>
          @endif
        @endif

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