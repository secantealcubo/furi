<div>

  <form class="mb-4 needs-validation" wire:submit.prevent="createPermissions">
    <div class="row">
      <div class="col-12 col-md-6">

          <!-- Start date -->
          <div class="form-group">
              <!-- Label -->
              <label>Selecciona un modulo: </label>
              <!-- Input -->

              <select class="form-control custom-select" wire:model="moduleChoosenId" wire:change="loadModulePermissions">
                <option value="" selected disabled>- Seleccione -</option>
                @foreach ($modules as $module)
                  <option value="{{ $module->id }}">{{ $module->nombre }}</option>
                @endforeach
              </select>

              @error('nombre')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror

          </div>

      </div>
      <div class="col-12 col-md-6">
          <div class="form-group">
              <!-- Label -->
              <label>
                Nombre permiso
              </label>
              <!-- Input -->
              
              <div class="input-group">
                <input type="text" wire:model="newModulePermission" class="custom-input form-control @error('newModulePermission')is-invalid @enderror" placeholder="Ej: editar [nombre del modulo en plural]">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" wire:click="addPermissionToArray" type="button">Agregar</button>
                </div>
              </div>
              @error('modelo')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
          </div>
      </div>
  </div> 


  @if ($showModulePermissions)
      
    <div class="row mt-3">
      <div class="col-sm-12 col-md-6">
        @if ($moduleChoosenPermissions->count() == 0)
        <i class="fe fe-alert-circle"></i> Actualmente, este módulo no tiene permisos asociados.
        @else
        <h4 class="h4">Este modulo tiene estos permisos <strong>ya asociados:</strong></h4>
        <ul>
          @foreach ($moduleChoosenPermissions as $modulePermission)
          <li>{{ $modulePermission->permiso->name }}</li>
          @endforeach
        </ul>
        @endif
      </div>


      @if (count($newModulePermissions) > 0)
        <div class="col-sm-12 col-md-6">
          <h4 class="h4">Agregarás los siguientes permisos:</h4>
          <ul>
            @foreach ($newModulePermissions as $modulePermission)
            <li>{{ $modulePermission }} <i class="fe fe-x-circle" wire:click="removePermissionFromArray('{{ $modulePermission }}')"></i> </li>
            @endforeach
          </ul>
        </div>
      @endif

    </div>

  @endif


    <!-- Divider -->
    <hr class="mt-5 mb-5">


    <!-- Buttons -->
    <button type="submit" class="btn btn-block btn-primary" @if(count($newModulePermissions) == 0) disabled @endif >
        Registrar permisos
    </button>
    <a href="{{ route('permisos.index') }}" class="btn btn-block btn-link text-muted">
        Cancelar
    </a>
  </form>

</div>
