<div>

  <div class="header">
      <div class="container-fluid">
          <div class="header-body">
              <div class="row align-items-end">
                  <div class="col">
                      <h1 class="header-title">Módulos registrados</h1>
                  </div>
                  <div class="col-auto">
                      <a href="{{ route('modulos.nuevo') }}" class="btn btn-primary lift"><i class="fe fe-plus"></i> Registrar módulo</a>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid">

      <div class="row">
          <div class="col-12">
            @if ($modulos->count() > 0)
              <div class="card">
                <div class="table-responsive mb-0">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Modelo</th>
                                <th class="text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($modulos as $modulo)
                                <tr>
                                    <td>{{ $modulo->id }}</td>
                                    <td>{{ $modulo->nombre }}</td>
                                    <td>{{ $modulo->modelo }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-ellipses dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a href="{{ route('modulos.editar', $modulo->id) }}"
                                                    class="dropdown-item">
                                                    <i class="fe fe-edit-3"></i> Editar
                                                </a>

                                                <div class="dropdown-divider"></div>
                                                
                                                <button wire:click="confirmDelete('{{ base64_encode($modulo->id) }}')"
                                                    class="dropdown-item">
                                                    <i class="fe fe-trash"></i> Eliminar
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @else
             <p class="text-muted text-center mt-5"><i class="fe fe-info"></i> No hay modulos registrados. Comienza registrando uno para administrar los permisos.</p>
            @endif

          </div>
      </div>

      <div class="row">
          <div class="col-sm-12">
              {{-- {{ $roles->links() }} --}}
          </div>
      </div>

  </div>
</div>
