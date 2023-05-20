<div>

    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-end">
                    <div class="col">
                        <h1 class="header-title">Todos los roles</h1>
                    </div>
                    <div class="col-auto">
                        @if(\Auth::user()->can('crear roles'))
                        <a href="{{ route('roles.nuevo') }}" class="btn btn-primary lift"><i class="fe fe-plus"></i>
                            Nuevo rol</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <!-- Goals -->
                <div class="card">
                    <div class="table-responsive mb-0">
                        <table class="table table-sm table-nowrap card-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Usuarios asignados</th>
                                    <th class="text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td>{{ $rol->id }}</td>
                                        <td>{{ $rol->name }}</td>
                                        <td>{{ $rol->users->count() }}</td>
                                        <td class="text-right">
                                            @if(\Auth::user()->can('editar roles'))
                                                <a href="{{ route('roles.editar', $rol->id) }}" class="mr-2">
                                                    <i class="fe fe-edit-3 fs-5"></i>
                                                </a>
                                            @endif
                                            @if(\Auth::user()->can('eliminar usuarios'))
                                                @if(\Auth::user()->id == 1)
                                                    <a wire:click="confirmDelete('{{ base64_encode($rol->id) }}')" class="mr-2" style="cursor:pointer">
                                                        <i class="fe fe-trash fs-5"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                {{-- {{ $roles->links() }} --}}
            </div>
        </div>

    </div>
</div>
