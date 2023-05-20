<div>
  <div class="header">
    <div class="container-fluid">
        <!-- Body -->
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col">
                    <!-- Title -->
                    <h1 class="header-title">
                        Añadir nuevo rol
                    </h1>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .header-body -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/admin/roles') }}">Roles</a></li>
              <li class="breadcrumb-item active" aria-current="page">Crear</li>
            </ol>
          </nav>
      </div>
  </div>
  <div class="container-fluid">
      <div class="row justify-content-center">
          <div class="col-12 col-lg-10 col-xl-8">
            <livewire:rol-usuario.form :formMode="'create'"/>
          </div>
      </div> <!-- / .row -->
  </div>
</div>
