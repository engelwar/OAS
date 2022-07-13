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
        <td></td>
        <td></td>
        <td>{{ $total_general[0]->$val1}}</td>
        <td>{{ $total_general[0]->$val2}}</td>
        @endforeach
        <td></td>
        <td></td>
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
        @endif
        @if ($value=="Enero")
        <td>388,409.86</td> 
        @endif
        
        @if ($value=="Febrero")
        <td>500.639,11</td>    
        @endif
        @if ($value=="Febrero")
        <td>478.107,56</td> 
        @endif
        
        @if ($value=="Marzo")
        <td>177.278,10</td>    
        @endif
        @if ($value=="Marzo")
        <td>128.066,42 </td> 
        @endif
        
        @if ($value=="Abril")
        <td>156.035,79</td>    
        @endif
        @if ($value=="Abril")
        <td>0,00</td> 
        @endif
        
        @if ($value=="Mayo")
        <td>130.247,12
        </td>    
        @endif
        @if ($value=="Mayo")
        <td>723,02</td> 
        @endif
        
        @if ($value=="Junio")
        <td>150.236,76</td>    
        @endif
        @if ($value=="Junio")
        <td>113.389,69</td> 
        @endif
        
        @if ($value=="Julio")
        <td>141.357,51</td>    
        @endif
        @if ($value=="Julio")
        <td>92.619,62</td> 
        @endif
        
        @if ($value=="Agosto")
        <td>120.111,97</td>    
        @endif
        @if ($value=="Agosto")
        <td>76.494,68</td> 
        @endif
        
        @if ($value=="Septiembre")
        <td>203.046,23</td>    
        @endif
        @if ($value=="Septiempre")
        <td>116.231,47</td> 
        @endif
        

        @if ($value=="Octubre")
        <td>132.808,72</td>    
        @endif
        @if ($value=="Octubre")
        <td>95.066,21</td> 
        @endif

        @if ($value=="Noviembre")
        <td>128.258,66</td>    
        @endif
        @if ($value=="Noviembre")
        <td>195.058,58</td> 
        @endif
        @if ($value=="Diciembre")
        <td>169.932,69</td>    
        @endif
        @if ($value=="Diciembre")
        <td>137.845,04</td> 
        @endif
        
        @if ($value=="Enero"&&$total[0]['BALLIVIAN'][0]->$val1==0.00)
            <td>142.423,02</td>
        @else
          @if ($value=="Febrero"&&$total[0]['BALLIVIAN'][0]->$val1==0.00)
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
        
        @if ($value=="Enero"&&$val->adusrNomb=="CAJERO FERIA")
            <td>176.193,96</td>
            <td>14.004,66 </td>
        @else
        <td></td>
        <td></td>
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
        <td>33</td>
        <td>33</td>
        <td>{{ $total_retail[0]['BALLIVIAN'][0]->$val1 }}</td>
        <td>{{ $total_retail[0]['BALLIVIAN'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
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
        <td>{{$k}}</td>
        <td>{{$k}}</td>
        <td>{{ $total[1]['HANDAL'][0]->$val1 }}</td>
        <td>{{ $total[1]['HANDAL'][0]->$val2 }}</td>
        @endforeach
        <td></td>
        <td></td>
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
</script>
@endsection