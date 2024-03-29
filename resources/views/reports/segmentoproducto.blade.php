@extends('layouts.app')
@section('static', 'statick-side')
@section('estilo')
<style>
  .multi-select {
    display: block;
    width: 100%;
    font-weight: 400;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    height: auto;
    height: calc(1.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.7875rem;
    line-height: 1.5;
    overflow: hidden;
    white-space: nowrap;
    border-radius: 0.2rem;
    text-align: left;
  }

  .multi-select-op {
    clear: both;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    font-weight: 400;
    line-height: 1.6;
    color: #495057;
    background-color: #fff;

    height: auto;
    height: calc(1.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.7875rem;
    line-height: 1.5;
  }

  .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: scroll;
  }
</style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'1'])


<div class="container">
  <div class="row justify-content-center mt-4">
    <div class="col-md-8 col-lg-6 col-sm-12 border">
      <form method="POST" action="{{ route('segmentoproducto.store') }}">
        @csrf
        <div class=" row d-flex justify-content-center my-3">
          <div class="d-flex align-items-center justify-content-center">
            <h3 class="text-primary">REPORTE DE SEGMENTO X PRODUCTO</h3>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-12">
            <div class="mb-2 row d-flex justify-content-center">
              <div class="col-sm-4">
                <input id="ffin" type="date" class="form-control form-control-sm d-none" name="ffin" value="{{date('Y-m-d')}}">
              </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
              <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Linea:</label>
              <div class="col-sm-6">
                <input id="categoria" type="text" class="form-control form-control-sm " name="categoria">
              </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
              <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">AÑO:</label>
              <div class="col-sm-6">
                <select class="form-select" aria-label="Default select example" name="gestion">
                  <option selected value="2022">2022</option>
                  <option value="2021">2021</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-2 row d-flex justify-content-center">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">MES:</label>
          <div class="col-sm-6">
            <div class="dropdown">
              <button id="menu-despl" class="btn btn-default multi-select text-left" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>MES <span class="select-text">(TODOS)</span></span>
                <span class="caret"></span></button>
              <ul class="dropdown-menu w-100 scrollable-menu" aria-labelledby="menu-despl">
                <li><a href="#" class="multi-select-op">
                    <label>
                      <input type="checkbox" checked class="selectall text-bold" />
                      TODOS
                    </label>
                  </a></li>
                <li class="divider"></li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='1' />
                      ENERO
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='2' />
                      FEBRERO
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='3' />
                      MARZO
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='4' />
                      ABRIL
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='5' />
                      MAYO
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='6' />
                      JUNIO
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='7' />
                      JULIO
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='8' />
                      AGOSTO
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='9' />
                      SEPTIEMBRE
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='10' />
                      OCTUBRE
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='11' />
                      NOVIEMBRE
                    </label>
                  </a>
                </li>
                <li>
                  <a class="option-link multi-select-op" href="#">
                    <label>
                      <input name='options[]' checked type="checkbox" class="option justone" value='12' />
                      DICIEMBRE
                    </label>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-md-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mx-2" name="gen" value="ver">
              Ver <i class="fas fa-bullseye"></i>
            </button>
            <button type="submit" class="btn btn-primary mx-2" name="gen" value="excel">
              Excel <i class="far fa-file-excel"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('mis_scripts')
<script>
  $(".dropdown-menu").click(function() {
    $('.dropdown-menu').parent().is(".open") && e.stopPropagation();
  });

  $('.selectall').click(function() {
    if ($(this).is(':checked')) {
      $('.option').prop('checked', true);
      var total = $('input[name="options[]"]:checked').length;
      $(".dropdown-text").html('(' + total + ') Selected');
      $(".select-text").html('(TODOS)');
    } else {
      $('.option').prop('checked', false);
      $(".dropdown-text").html('(0) Selected');
      $(".select-text").html('');
    }
  });

  $("input[type='checkbox'].justone").change(function() {
    var a = $("input[type='checkbox'].justone");
    if (a.length == a.filter(":checked").length) {
      $('.selectall').prop('checked', true);
      $(".select-text").html('(TODOS)');
    } else {
      $('.selectall').prop('checked', false);
      $(".select-text").html('');
    }
    var total = $('input[name="options[]"]:checked').length;
    $(".dropdown-text").html('(' + total + ') Selected');
  });
</script>
@endsection