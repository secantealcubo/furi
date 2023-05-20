<div>
   <form class="mb-4 needs-validation" wire:submit.prevent="{{ ($mode == 'edit') ? 'updateUser' : 'crearUsuario' }}">
      <div class="row">
         <div class="col-12 col-md-6">
            <!-- Start date -->
            <div class="form-group">
               <!-- Label -->
               <label>
               Nombre
               </label>
               <!-- Input -->
               <input type="text" wire:model="name"
                  class="form-control mb-3 @error('name')is-invalid @enderror" placeholder="">
               @error('name')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <!-- Label  -->
               <label>
               Correo electrónico
               </label>
               <!-- Input -->
               <input type="email" wire:model="email" class="form-control @error('email')is-invalid @enderror">
               @error('email')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror
            </div>
         </div>
      </div>
      <!-- / .row -->
      <div class="row">
         <div class="col-12 col-md-6">
            <!-- Start date -->
            <div class="form-group">
               <!-- Label -->
               <label>
               Contraseña
               </label>
               <!-- Input -->
               <input type="password" wire:model="password"
                  class="form-control mb-3  @error('password')is-invalid @enderror" placeholder="">
               @error('password')
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
               Repetir contraseña
               </label>
               <!-- Input -->
               <input type="password" wire:model="password_confirmation"
                  class="form-control mb-3 @error('password')is-invalid @enderror" placeholder="">
            </div>
         </div>
      </div>
      <!-- / .row -->
      <!-- Divider -->
      <hr class="mt-5 mb-5">
      <div class="row">
         <div class="col-12 col-md-6">
            <!-- Private project -->
            <div class="form-group">
               <!-- Label -->
               <label class="mb-1">
               Define un rol al usuario
               </label>
               <!-- Text -->
               <small class="form-text text-muted">
               El rol que le asignes le permitirá ver los módulos habilitados para ese perfil
               </small>
            </div>
         </div>
         <div class="col-12 col-md-6">
            <div class="form-group">
               <!-- Input -->
               <select class="custom-select @error('rolUsuario') is-invalid @enderror" id="verifica"
                  wire:model="rolUsuario">
                  <option value="" selected>- Selecciona -</option>
                  
                  @foreach ($userRoles as $role)
                     <option value="{{ $role->name }}">{{ $role->name }}</option>
                  @endforeach
                  
               </select>
               @error('rolUsuario')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
               @enderror
            </div>
         </div>
      </div>
      <!-- / .row -->
      <!-- Divider -->
      <hr class="mt-5 mb-5">
      <!-- Buttons -->
      <button type="submit" class="btn btn-block btn-primary">
      {{ ($mode == 'edit' ) ? 'Editar usuario' : 'Crear usuario' }}
      </button>
      <a href="{{ route('usuarios.index') }}" class="btn btn-block btn-link text-muted">
      Cancelar
      </a>
   </form>
</div>