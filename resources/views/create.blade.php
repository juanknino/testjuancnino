<?php
use App\Custom\Components;
?>
@extends('layout')

@section('content')
<style>
.inputpx{
    width: 50%;
    position: relative;
    display: inline;
}
input.inputpx+span:after {
  content: "px"
}

input:required:after {
    content: '*';
    color:red
}
</style>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
    <li class="nav-item">
    <a class="nav-link" href="{{ route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item  active">
    <a class="nav-link" href="{{ route('form.create')}}">
        <i class="fas fa-fw fa-folder"></i>
        <span>Crear Anuncio</span></a>
    </li>
    </ul>

<div id="content-wrapper">
<div class="card m-3">
  <div class="card-header">
    <h5>CREAR ANUNCIO</h5>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form id="formanun" method="post" action="{{ route('form.store') }}" enctype="multipart/form-data">
        @csrf
         <div class="form-group">
              <label for="name">Titulo: <span class="required">*</span></label>
              <input type="text" class="form-control" name="name" required/>
          </div>
          <div class="form-group">
                <label for="status">Estado: <span class="required">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Seleccione</option>
                    <option value="published">published</option>
                    <option value="stopped">stopped</option>
                    <option value="publishing">publishing</option>
                </select>
            </div>
                @php
                 $componentes= new Components();
                 echo $componentes->componentsform();
                @endphp
          <button type="submit" class="btn btn-warning mt-3">Guardar</button>
      </form>
  </div>
</div>
</div>
</div>


<script>
$(document).ready(function(){

    $("input[name='image[url]']").change(function () {

        var extensionesValidas = ".png, .jpg";
        var ruta = $(this).val();
        var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
        var extensionValida = extensionesValidas.indexOf(extension);

        if(extensionValida > 0) {
            $("input[name='image[type]']").val(extension).attr('disabled',true);
	    }else{
            $("input[name='image[url]']").val('');
            $("input[name='image[type]']").val('').attr('disabled',false);
            if(ruta !=''){
                alert('Imagenes con extensiones permitidas: '+extensionesValidas);
            }

        }
    });
    $("input[name='video[url]']").change(function () {
        var extensionesValidas = ".mp4 , .webm";
        var ruta = $(this).val();
        var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
        var extensionValida = extensionesValidas.indexOf(extension);

        if(extensionValida > 0) {
            $("input[name='video[type]']").val(extension).attr('disabled',true);
        }else{
            $("input[name='video[url]']").val('');
            $("input[name='video[type]']").val('').attr('disabled',false);
            if(ruta !=''){
                alert('Videos con extensiones permitidas: '+extensionesValidas);
            }

        }
    });

   function validarExtension(datos) {

	var ruta = datos.value;
	var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
	var extensionValida = extensionesValidas.indexOf(extension);

	if(extensionValida < 0) {
            return false;
        } else {
            return true;
        }
    }

    //$('#expand').click();
    $('#expand').click(function(){
        $('.collapse').collapse('dispose');
         $('#upbtn').removeClass('d-none');
         $('html, body').animate({ scrollTop: 4500}, 2500);
    });

    $.fn.serializeControls = function() {
        var data = {};

        function buildInputObject(arr, val) {
            if (arr.length < 1)
            return val;
            var objkey = arr[0];
            if (objkey.slice(-1) == "]") {
            objkey = objkey.slice(0,-1);
            }
            var result = {};
            if (arr.length == 1){
            result[objkey] = val;
            } else {
            arr.shift();
            var nestedVal = buildInputObject(arr,val);
            result[objkey] = nestedVal;
            }
            return result;
        }

        $.each(this.serializeArray(), function() {
            var val = this.value;
            var c = this.name.split("[");
            var a = buildInputObject(c, val);
            $.extend(true, data, a);
        });

        return data;
    }
});

$('#formanun').on('submit',function(e){
    e.preventDefault();

    $('.modal-backdrop.fade').removeClass('d-none').addClass('show');
    $('#loading').css('display','block');
    $('html, body').animate({ scrollTop: 0}, 200);
    $.ajax({
        type: "POST",
        url: "{{ route('anuncioajax.create') }}",
        data: $('#formanun').serializeControls(),
        //dataType:"json",
        success: function(data){

            $('#content-wrapper').prepend(data);
            setTimeout(function () {
                window.location.href = " {{ route('home')}} " ;
            }, 1500);
        }
    })
})
</script>
<!-- Scroll to Top Button-->
<a id="upbtn" class="scroll-to-top rounded d-none" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="modal-backdrop fade d-none">
</div>
<button id="loading" class="btn btn-outline-info" type="button" disabled>
    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
    Enviando...
</button>
@endsection
