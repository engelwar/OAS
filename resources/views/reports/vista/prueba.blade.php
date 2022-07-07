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
<div class="container">
  <div class="row justify-content-center mt-4 p-5 border">
    <div class="col">
      <table style="width:100%">
        <tr valign="middle">
          <td style="width: 20%;">
            <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                            height: auto;" />
          </td>
          <td style="width: 60%; text-align: center;">
            <h3 class="text-center">COMPARATIVO DE VENTAS</h3>
          </td>
          <td style="width: 20%; text-align: right;">
          </td>
        </tr>
      </table>
      <div style="overflow:scroll; width: 100%; height: 650px;">
        <table class="table table-striped table-bordered table-sm table-responsive" id="table_ventas">
          <thead class="text-white" style="background-color: #283056;">
            <TR>
              <TH colspan="1" class="text-center"></TH>
              @foreach ($options as $k => $value)
              <TH colspan="2" class="text-center">{{$value}}</TH>
              @endforeach
              <TH colspan="2" class="text-center" style="background-color: #284556;">COMPARATIVO ANUAL</TH>
            </TR>
            <TR>
              <TH colspan="1" class="text-center"></TH>
              @foreach ($options as $k => $value)
              <TH colspan="1" class="text-center">2021</TH>
              <TH colspan="1" class="text-center">2022</TH>
              @endforeach
              <TH colspan="1" class="text-center" style="background-color: #284556;">2021</TH>
              <TH colspan="1" class="text-center" style="background-color: #284556;">2022</TH>
            </TR>
          </thead>
          <tbody>
            <tr class="bg-primary text-end text-white" style="font-weight: bold;">
              <td class="text-start" style="width: 14%;">SUMA GENERAL</td>
              @foreach ($options as $k => $value)
              @php
              $val1 = $value."1";
              $val2 = $value."2";
              @endphp
              <td>{{ $total_general[0]->$val1}}</td>
              <td>{{ $total_general[0]->$val2}}</td>
              @endforeach
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
              <td>{{ $total[0]['BALLIVIAN'][0]->$val1 }}</td>
              <td>{{ $total[0]['BALLIVIAN'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
              <td>{{ $val->Tot1 }}</td>
              <td>{{ $val->Tot2 }}</td>
            </tr>
            @endforeach
            <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
              <td class="text-start">SUCURSAL HANDAL</td>
              @foreach ($options as $k => $value)
              @php
              $val1 = $value."1";
              $val2 = $value."2";
              @endphp
              <td>{{ $total[1]['HANDAL'][0]->$val1 }}</td>
              <td>{{ $total[1]['HANDAL'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
              <td>{{ $val->Tot1 }}</td>
              <td>{{ $val->Tot2 }}</td>
            </tr>
            @endforeach
            <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
              <td class="text-start">SUCURSAL MARISCAL</td>
              @foreach ($options as $k => $value)
              @php
              $val1 = $value."1";
              $val2 = $value."2";
              @endphp
              <td>{{ $total[2]['MARISCAL'][0]->$val1 }}</td>
              <td>{{ $total[2]['MARISCAL'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
              <td>{{ $val->Tot1 }}</td>
              <td>{{ $val->Tot2 }}</td>
            </tr>
            @endforeach
            <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
              <td class="text-start">SUCURSAL CALACOTO</td>
              @foreach ($options as $k => $value)
              @php
              $val1 = $value."1";
              $val2 = $value."2";
              @endphp
              <td>{{ $total[3]['CALACOTO'][0]->$val1 }}</td>
              <td>{{ $total[3]['CALACOTO'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
              <td>{{ $val->Tot1 }}</td>
              <td>{{ $val->Tot2 }}</td>
            </tr>
            @endforeach
            <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
              <td class="text-start">INSTITUCIONALES</td>
              @foreach ($options as $k => $value)
              @php
              $val1 = $value."1";
              $val2 = $value."2";
              @endphp
              <td>{{ $total[4]['INSTITUCIONALES'][0]->$val1 }}</td>
              <td>{{ $total[4]['INSTITUCIONALES'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
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
              <td>{{ $total[5]['MAYORISTAS'][0]->$val1 }}</td>
              <td>{{ $total[5]['MAYORISTAS'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
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
              <td>{{ $total[6]['SANTA CRUZ'][0]->$val1 }}</td>
              <td>{{ $total[6]['SANTA CRUZ'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
              <td>{{ $val->Tot1 }}</td>
              <td>{{ $val->Tot2 }}</td>
            </tr>
            @endforeach
  
            <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
              <td class="text-start">Regional 1</td>
              @foreach ($options as $k => $value)
              @php
              $val1 = $value."1";
              $val2 = $value."2";
              @endphp
              <td>{{ $total_regional[0]['REGIONAL1'][0]->$val1 }}</td>
              <td>{{ $total_regional[0]['REGIONAL1'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
              <td>{{ $val->Tot1 }}</td>
              <td>{{ $val->Tot2 }}</td>
            </tr>
            @endforeach
            <tr class="text-end" style="font-weight: bold; background-color: rgb(190 205 251);">
              <td class="text-start">Regional 2</td>
              @foreach ($options as $k => $value)
              @php
              $val1 = $value."1";
              $val2 = $value."2";
              @endphp
              <td>{{ $total_regional[1]['REGIONAL2'][0]->$val1 }}</td>
              <td>{{ $total_regional[1]['REGIONAL2'][0]->$val2 }}</td>
              @endforeach
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
              <td>{{ $val->$val1 }}</td>
              <td>{{ $val->$val2 }}</td>
              @endforeach
              <td>{{ $val->Tot1 }}</td>
              <td>{{ $val->Tot2 }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@section('mis_scripts')
<script>
  $(".page-wrapper").removeClass("toggled");
</script>
@endsection