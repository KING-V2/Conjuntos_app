@extends('layouts.admin')
@section('content')
    <div class="card">
        <h1 class="card-header">Emprendimientos</h1>
        <div class="card-body">
            <form method="post" action="{{ url('cargar_emprendimiento',[]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Mes</label>
                        <select class="form-control" name="mes" id="mes" required>
                            <option value="">-- Seleccione --</option>
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Titulo</label>
                        <input class="form-control" type="text" id="titulo" name="titulo" />
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">imagen</label>
                        <input class="form-control" type="file" id="imagen" name="imagen" accept="image/jpg, image/png, image/jpeg"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Whatsapp</label>
                        <input class="form-control" type="text" id="whatsapp" name="whatsapp" placeholder="whatsapp"/>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="form" class="form-label">Instagram</label>
                        <input class="form-control" type="text" id="instagram" name="instagram" placeholder="instagram"/>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Cargar</button>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="card text-center mb-3">
                    <div class="card-header border-bottom">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                            <buttontype="button" class="nav-link active" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-enero" aria-controls="navs-tab-enero" aria-selected="true">Enero</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-febrero" aria-controls="navs-tab-febrero" aria-selected="false">Febrero</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-marzo" aria-controls="navs-tab-marzo" aria-selected="false">Marzo</button>
                            </li>

                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-abril" aria-controls="navs-tab-abril" aria-selected="true">Abril</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-mayo" aria-controls="navs-tab-mayo" aria-selected="false">Mayo</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-junio" aria-controls="navs-tab-junio" aria-selected="false">Junio</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-julio" aria-controls="navs-tab-julio" aria-selected="true">Julio</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-agosto" aria-controls="navs-tab-agosto" aria-selected="false">Agosto</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-septiembre" aria-controls="navs-tab-septiembre" aria-selected="false">Septiembre</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-octubre" aria-controls="navs-tab-octubre" aria-selected="true">Octubre</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-noviembre" aria-controls="navs-tab-noviembre" aria-selected="false">Noviembre</button>
                            </li>
                            <li class="nav-item">
                            <buttontype="button" class="nav-link" role="tab" data-bs-toggle="tab"data-bs-target="#navs-tab-diciembre" aria-controls="navs-tab-diciembre" aria-selected="false">Diciembre</button>
                            </li>
                            <!-- <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link disabled"
                                data-bs-toggle="tab"
                                role="tab"
                                aria-selected="false"
                            >
                                Disabled
                            </button>
                            </li> -->
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-tab-enero" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Enero') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Enero') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info mb-2" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger mb-2" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="material-icons-outlined">visibility</i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-febrero" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Febrero') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Febrero') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-marzo" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Marzo') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Marzo') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-abril" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Abril') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Abril') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-mayo" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Mayo') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Mayo') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-junio" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Junio') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Junio') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-julio" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Julio') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Julio') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-agosto" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Agosto') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Agosto') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-septiembre" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Septiembre') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Septiembre') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-octubre" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Octubre') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Octubre') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-noviembre" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Noviembre') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Noviembre') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-tab-diciembre" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                @if( $emprendimientos->where('mes','Diciembre') )
                                    <table class="table table-bordered" style="overflow-x: auto;">
                                        <thead>
                                            <tr>
                                                <th> Titulo </th>
                                                <th> Mes </th>
                                                <th> Imagen </th>
                                                <th> Instagram </th>
                                                <th> Whatsapp </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $emprendimientos->where('mes','Diciembre') as $emprendimiento )
                                                <tr>
                                                    <td>{{ $emprendimiento->titulo }}</td>
                                                    <td>{{ $emprendimiento->mes ? $emprendimiento->mes : 'Actualizar' }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/emprendimientos').'/'.$emprendimiento->imagen }}" alt="" width="40%">
                                                    </td>
                                                    <td>
                                                        <a href="{{ $emprendimiento->instagram }}"><i class="fa-brands fa-instagram" style="font-size: 40px; color: orange;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="https://wa.me/57{{ $emprendimiento->whatsapp }}?text=Buenos%20Dias"><i class="fa-brands fa-whatsapp" style="font-size: 40px; color: green;"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('emprendimiento_edit',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-info" alt="editar"><i class="material-icons-outlined">editar</i></a>
                                                        <a href="{{ url('emprendimiento_delete',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-danger" alt="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este emprendimiento?');" ><i class="material-icons-outlined">borrar</i></a>
                                                        <a href="{{ url('galeria_emprendimiento',[ 'id' =>  $emprendimiento->id ]) }}" class="btn btn-success" alt="galeria"><i class="fa fa-image"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>Sin Emprendimientos</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')

    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('assets/js/audios/configs.js') }}"></script>
    <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script>

    <script src="{{ asset('assets/js/archivos/archivos.js') }}"></script>
@endsection