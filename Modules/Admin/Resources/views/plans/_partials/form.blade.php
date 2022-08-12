@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>Nombre</label>
        <input type="text" name="name" value="{{ $plan->name ?? old('name') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Precio</label>
        <input type="text" id="currency" name="price" class="custom4 bg-transparent" value="{{ $plan->price ?? old('price') }}">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/admin/plans">Atrás</a>
      </div>
    </div>
</div>