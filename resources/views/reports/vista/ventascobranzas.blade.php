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
  <div class="row justify-content-center mt-4 p-5 border">
    <div class="col">
      <table style="width:100%">
        <tr valign="middle">
          <td style="width: 20%;">
            <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                            height: auto;" />
          </td>
          <td style="width: 60%; text-align: center;">
            <h3 class="text-center">RESUMEN DE VENTAS Y COBRANZAS</h3>
            <h6 class="text-center">DEL {{$fini}} AL {{$ffin}}</h6>
          </td>
          <td style="width: 20%; text-align: right;">
          </td>
        </tr>
      </table>
      <table class="table table-sm table-striped table-bordered">
        @if($resumen)
        @foreach($resumen as $f => $g)
        <thead>
          <tr>
            <td style="border-style:none; padding-top:35px" colspan=9>
              <h4>{{$f}}</h4>
            </td>
          </tr>
          <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:1.1px solid #000">
            <th></th>
            <th class="text-center">SALDO CxC</th>
            <th class="text-center" colspan="3">VENTAS</th>
            <th class="text-center" colspan="4">COBRANZAS</th>
            <th></th>
          </tr>
          <tr class="texttable-bordered derecha">
            <th style="text-align:left" class="bold">Vendedor</th>
            <th>SaldoAnterior</th>
            <th>Contado</th>
            <th>Credito</th>
            <th>Total</th>
            <th class="text-center">Vigentes</th>
            <th class="text-center">Vencido</th>
            <th class="text-center">Mora</th>
            <th>Total</th>
            <th>SaldoActual</th>
          </tr>
        </thead>
        <tbody>
          @if($g)
          @foreach($g as $h => $i)
          <tr class="text-right table-bordered derecha">
            <td style="text-align:left" class="bold">{{$i->Tipo}}</td>
            <td class="bold">{{$i->SaldoAnterior}}</td>
            <td class="bold">{{$i->Contado}}</td>
            <td class="bold">{{$i->Credito}}</td>
            <td class="bold">{{$i->Total}}</td>
            <td class="bold">
              <form action="{{ route('cxc.cobranzas') }}" method="POST" target="_blank">
                @csrf
                <input type="date" class="form-control form-control-sm d-none" name="ffin" value="{{$fecha}}">
                <input name='options' class="form-control form-control-sm d-none" value='{{$i->idUser}}'/>
                <input name='estado' class="form-control form-control-sm d-none" value='Vigente'/>
                <button type="submit" style="width: 100%; padding: 0px 10px;" type="button" class="btn btn-outline-primary border-0" target="_blank">{{$i->Vigente}}</button>
              </form>
            </td>
            <td class="bold">
              <form action="{{ route('cxc.cobranzas') }}" method="POST" target="_blank">
                @csrf
                <input type="date" class="form-control form-control-sm d-none" name="ffin" value="{{$fecha}}">
                <input name='options' class="form-control form-control-sm d-none" value='{{$i->idUser}}'/>
                <input name='estado' class="form-control form-control-sm d-none" value='Vencido'/>
                <button type="submit" style="width: 100%; padding: 0px 10px;" type="button" class="btn btn-outline-primary border-0" target="_blank">{{$i->Vencido}}</button>
              </form>
            </td>
            <td class="bold">
              <form action="{{ route('cxc.cobranzas') }}" method="POST" target="_blank">
                @csrf
                <input type="date" class="form-control form-control-sm d-none" name="ffin" value="{{$fecha}}">
                <input name='options' class="form-control form-control-sm d-none" value='{{$i->idUser}}'/>
                <input name='estado' class="form-control form-control-sm d-none" value='Mora'/>
                <button type="submit" style="width: 100%; padding: 0px 10px;" type="button" class="btn btn-outline-primary border-0" target="_blank">{{$i->Mora}}</button>
              </form>
            </td>
            <td class="bold">{{$i->Total2}}</td>
            <td class="bold">{{$i->SaldoActual}}</td>
          </tr>
          @endforeach
          @endif
          @foreach($subTotal[$f] as $h => $i)
          <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:1.1px solid #000">
            <td style="text-align:left" class="bold">TOTAL {{$f}}</td>
            <td class="bold">{{$i->SaldoAnterior}}</td>
            <td class="bold">{{$i->Contado}}</td>
            <td class="bold">{{$i->Credito}}</td>
            <td class="bold">{{$i->Total}}</td>
            <td class="bold">{{$i->Vigente}}</td>
            <td class="bold">{{$i->Vencido}}</td>
            <td class="bold">{{$i->Mora}}</td>
            <td class="bold">{{$i->Total2}}</td>
            <td class="bold">{{$i->SaldoActual}}</td>
          </tr>
          @endforeach
        </tbody>
        @endforeach
        <thead>
          <tr>
            <td style="border-style:none; padding-top:35px" colspan=9>
              <h4>TOTAL GENERAL</h4>
            </td>
          </tr>
          <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:1.1px solid #000">
            <th></th>
            <th class="text-center">SALDO CxC</th>
            <th class="text-center" colspan="3">VENTAS</th>
            <th class="text-center" colspan="4">COBRANZAS</th>
            <th></th>
          </tr>
          <tr class="text-right table-bordered derecha">
            <th></th>
            <th>SaldoAnterior</th>
            <th>Contado</th>
            <th>Credito</th>
            <th>Total</th>
            <th>Vigentes</th>
            <th>Vencido</th>
            <th>Mora</th>
            <th>Total</th>
            <th>SaldoActual</th>
          </tr>
        </thead>
        <tbody>
          @foreach($total as $i)
          <tr class="text-right table-bordered font-weight-bold derecha" style="background:#e6ecff;border-top:1.1px solid #000">
            <td style="text-align:left" class="bold">TOTAL GENERAL</td>
            <td class="bold">{{$i->SaldoAnterior}}</td>
            <td class="bold">{{$i->Contado}}</td>
            <td class="bold">{{$i->Credito}}</td>
            <td class="bold">{{$i->Total}}</td>
            <td class="bold">{{$i->Vigente}}</td>
            <td class="bold">{{$i->Vencido}}</td>
            <td class="bold">{{$i->Mora}}</td>
            <td class="bold">{{$i->Total2}}</td>
            <td class="bold">{{$i->SaldoActual}}</td>
          </tr>
          @endforeach
        </tbody>
        @endif
      </table>
    </div>
  </div>
</div>
@endsection

@section('mis_scripts')
<script>
  $(".page-wrapper").removeClass("toggled");
</script>
@endsection