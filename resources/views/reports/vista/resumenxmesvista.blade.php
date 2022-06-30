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
</style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0'])
<div class="container">
  <div class="row justify-content-center mt-4 p-5 ">
    <div class="col">
      <table style="width:100%">
        <tr valign="middle">
          <td style="width: 20%;">
            <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                            height: auto;" />
          </td>
          <td style="width: 60%; text-align: right;">
            <h3 class="text-right">RESUMEN DE VENTAS TOTAL</h3>

          </td>
          <td style="width: 20%; text-align: right;">
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

<table class="table table-sm">
  <thead>
    <TR>
      <TH colspan="1" class="text-center"></TH>
      @foreach ($fxmes as $fx)
      <TH colspan="2" class="text-center">{{ $fx }}</TH>
      @endforeach
      <TH colspan="2" class="text-center" style="color: red">COMPARATIVO ANUAL</TH>
    </TR>
    <TR>
      <TH colspan="1" class="text-center"></TH>
      @foreach ($fxmes as $fx)
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      @endforeach
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
    </TR>
  </thead>




  <!-- <thead>
    
    <tr class="text-right table-bordered derecha">
      
      <th></th>
      @foreach ($fxmes as $fx)
      <th colspan="2" style="align-items: center">{{$fx}}</th>
      @endforeach
      <th colspan="2" style="color: red">COMPARATIVO ANUAL</th>
    </tr>
  </thead>

  <thead>

    <tr class="text-right table-bordered derecha">
      <th></th>
      @foreach ($fxmes as $fx)
      <th>2021</th>
      <th>2022</th>
      @endforeach
      <th style="color: red">2021</th>
      <th style="color: red">2022</th>
    </tr>
  </thead> -->
  <tbody>

    <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:solid #000 1px">
      <td style="text-align:left" class="bold">SUMA GENERAL</td>
      <!--enero-->
      @if (is_null($tarray1))

      @else
      @foreach ($tarray1 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach
      @endif
      <!--febrero-->
      @if (is_null($tarray2))

      @else
      @foreach ($tarray2 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach
      @endif
      <!--marzo-->
      @if (is_null($tarray3))

      @else
      @foreach ($tarray3 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach
      @endif
      <!--abril-->
      @if (is_null($tarray4))

      @else
      @foreach ($tarray4 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach
      @endif
      <!--mayo-->
      @if (is_null($tarray5))

      @else
      @foreach ($tarray5 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach
      @endif

      <!--junio--->
      @if (is_null($tarray6))

      @else
      @foreach ($tarray6 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach
      @endif
      <!--julio-->


      @foreach ($tarray7 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach

      @foreach ($tarray8 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach


      @foreach ($tarray9 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach

      @foreach ($tarray10 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach

      @foreach ($tarray11 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach

      @foreach ($tarray12 as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach
      @foreach ($tarrayAnual as $key=>$val)
      @if (is_null($val))
      <td class="bold">0</td>
      @else
      <td class="bold">{{$val}}</td>
      @endif
      @endforeach

    </tr>

  </tbody>
  <!--totales por sucursales-->



  @foreach ($compa as $key=>$val)
  <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:solid #000 1px">
    @if (is_null($val) || $val=="0")

    @else
    @if ($val!="0")
    <td style="text-align:left" class="bold">SUCURSAL {{$val}}</td>
    @endif

    @endif
    @if (!empty($totalSt1)&&!empty($totalSt11))
    @if (empty($totalSt1[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt1[$key]}}</td>
    @endif
    @if (empty($totalSt11[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt11[$key]}}</td>
    @endif
    @endif

    @if (!empty($totalSt2)&&!empty($totalSt22))
    @if (empty($totalSt2[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt2[$key]}}</td>
    @endif
    @if (empty($totalSt22[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt22[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt3)&&!empty($totalSt33))
    @if (empty($totalSt3[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt3[$key]}}</td>
    @endif
    @if (empty($totalSt33[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt33[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt4)&&!empty($totalSt44))
    @if (empty($totalSt4[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt4[$key]}}</td>
    @endif
    @if (empty($totalSt44[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt44[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt5)&&!empty($totalSt55))
    @if (empty($totalSt5[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt5[$key]}}</td>
    @endif
    @if (empty($totalSt55[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt55[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt6)&&!empty($totalSt66))
    @if (empty($totalSt6[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt6[$key]}}</td>
    @endif
    @if (empty($totalSt66[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt66[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt7)&&!empty($totalSt77))
    @if (empty($totalSt7[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt7[$key]}}</td>
    @endif
    @if (empty($totalSt77[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt77[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt8)&&!empty($totalSt88))
    @if (empty($totalSt8[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt8[$key]}}</td>
    @endif
    @if (empty($totalSt88[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt88[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt9)&&!empty($totalSt99))
    @if (empty($totalSt9[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt9[$key]}}</td>
    @endif
    @if (empty($totalSt99[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt99[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt10)&&!empty($totalSt100))
    @if (empty($totalSt10[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt10[$key]}}</td>
    @endif
    @if (empty($totalSt110[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt110[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt11)&&!empty($totalSt110))
    @if (empty($totalSt11[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt11[$key]}}</td>
    @endif
    @if (empty($totalSt110[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt110[$key]}}</td>
    @endif
    @endif


    @if (!empty($totalSt12)&&!empty($totalSt120))
    @if (empty($totalSt12[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt12[$key]}}</td>
    @endif
    @if (empty($totalSt120[$key]))
    <td>0</td>
    @else
    <td>{{$totalSt120[$key]}}</td>
    @endif
    @endif









    @endforeach


    <!---prueba-->
    @foreach($resumen2 as $f => $g)

    <tbody>
      @if($g)
      @foreach($total2[$f] as $h => $i)
      <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:1.1px solid #000">
        <td style="text-align:left" class="bold">SUCURSAL {{$f}}</td>

        <!--<td class="bold">{{$i->Total}}</td>-->

        <td>0</td>
        <td>0</td>
      </tr>
      @endforeach
      @foreach($g as $h => $i)
      <tr class="text-right table-bordered derecha">
        <td style="text-align:left" class="bold">{{$i->Tipo}}</td>

        <!--<td class="bold">{{$i->Total}}</td>-->

        <td>0</td>
        <td>0</td>
      </tr>
      @endforeach

      @endif

    </tbody>
    @endforeach












    <thead>
</table>


<table class="table table-sm">
  @if($resumen)
  <thead>
    <TR>
      <TH colspan="1" class="text-center"></TH>
      <TH colspan="2" class="text-center">ENERO</TH>
      <TH colspan="2" class="text-center">FEBRERO</TH>
      <TH colspan="2" class="text-center">MARZO</TH>
      <TH colspan="2" class="text-center">ABRIL</TH>
      <TH colspan="2" class="text-center">MAYO</TH>
      <TH colspan="2" class="text-center">JUNIO</TH>
      <TH colspan="2" class="text-center">JULIO</TH>
      <TH colspan="2" class="text-center">AGOSTO</TH>
      <TH colspan="2" class="text-center">SEPTIEMBRE</TH>
      <TH colspan="2" class="text-center">OCTUBRE</TH>
      <TH colspan="2" class="text-center">NOVIEMBRE</TH>
      <TH colspan="2" class="text-center">DICIEMBRE</TH>
      <TH colspan="2" class="text-center" style="color: red">COMPARATIVO ANUAL</TH>
    </TR>
    <TR>
      <TH colspan="1" class="text-center"></TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
      <TH colspan="1" class="text-center">2021</TH>
      <TH colspan="1" class="text-center">2022</TH>
    </TR>
  </thead>
  <tbody>
    @foreach($totalgen as $i)
    <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:solid #000 1px">
      <td style="text-align:left" class="bold">SUMA GENERAL</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td class="bold">{{$i->Total}}</td>
      <td>0</td>


    </tr>
    @endforeach
  </tbody>
  @foreach($resumen as $f => $g)

  <tbody>
    @if($g)
    @foreach($total[$f] as $h => $i)
    <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:1.1px solid #000">
      <td style="text-align:left" class="bold">SUCURSAL {{$f}}</td>
      <td>1</td>
      <td>1</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td class="bold">{{$i->Total}}</td>
      <td>0</td>


    </tr>
    @endforeach
    @foreach($g as $h => $i)
    <tr class="text-right table-bordered derecha">
      <td style="text-align:left" class="bold">{{$i->Tipo}}</td>
      <td>0</td>
      <td>2</td>
      <td>2</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td class="bold">{{$i->Total}}</td>
      <td>0</td>

    </tr>
    @endforeach
    @endif

  </tbody>
  @endforeach



  <thead>

    @foreach($resumenAdmin as $f => $g)

  <tbody>
    @if($g)
    @foreach($totalQ[$f] as $h => $i)
    <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:1.1px solid #000">
      <td style="text-align:left" class="bold">TOTAL ADMINISTRACION</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td class="bold">{{$i->Total}}</td>
      <td>0</td>

    </tr>
    @endforeach
    @foreach($g as $h => $i)
    <tr class="text-right table-bordered derecha">
      <td style="text-align:left" class="bold">{{$i->Tipo}}</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td class="bold">{{$i->Total}}</td>
      <td>0</td>


    </tr>
    @endforeach
    @endif

  </tbody>
  @endforeach
  </thead>

  @endif


</table>


@endsection

@section('mis_scripts')
<script>
  $(".page-wrapper").removeClass("toggled");
</script>
@endsection