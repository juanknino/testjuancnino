<?php
$allanuncios= DB::table('anuncios')->select('*');
$published=$allanuncios->where('status','published')->count();
$stopped=$allanuncios->where('status','stopped')->count();
$publishing=$allanuncios->where('status','publishing')->count();
?>

@extends('layout')
@section('content')
        <div id="wrapper">

          <!-- Sidebar -->
          <ul class="sidebar navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('form.create')}}">
                <i class="fas fa-fw fa-folder"></i>
                <span>Crear Anuncio</span></a>
            </li>
          </ul>
          <div id="content-wrapper">
            <div class="container-fluid">
              <!-- Breadcrumbs-->
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Listado de Anuncios</li>
              </ol>

              <!-- Icon Cards-->
              <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                      </div>
                      <div class="mr-5">{{ $published }} Anuncios published!</div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                  <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-images"></i>
                      </div>
                      <div class="mr-5">{{ $publishing }} Anuncios publishing!</div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                  <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-life-ring"></i>
                      </div>
                      <div class="mr-5">{{ $stopped }} Anuncios stopped!</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- DataTables Example -->
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                  Anuncios</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Fecha de creación</th>
                            <th scope="col">Estado</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all=DB::table('anuncios')->select('*')->get();
                            $i=1;
                            foreach ($all as $anun){
                            ?>
                            <tr><th scope="row">{{$i}}</th><td>{{$anun->name}}</td><td>{{ date('Y-m-d',$anun->created_at) }}</td><td>{{$anun->status}}</td></tr>
                            <?php
                            $i ++;
                            }
                            ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <span>CREADO POR JUAN CARLOS NIÑO - COLOMBIA</span>
                </div>
              </div>
            </footer>

          </div>
          <!-- /.content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

@endsection
