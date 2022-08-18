@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>Cliente</label>
        <input type="text" value="{{ $finance->customer_name ?? old(customer_name)}} {{ $finance->last_name ?? old(last_name) }} " readonly>
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Plan Contratado</label>
        <input type="text" value="{{ $finance->plan_name }}" readonly>
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Precio</label>
        <input type="text" value="{{ number_format($finance->price, 0) }}" readonly>
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="select-style-1">
        <label>(*) Fecha de Facturación</label>
        <div class="select-position">
          <select name="exp_date_plan">
            @foreach ($days as $day)
              <option value="{{ $day }}" {{ ( $day == $finance->exp_date_plan) ? 'selected' : '' }}> {{ $day }} </option>
            @endforeach 
          </select>
        </div>
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/admin/financial">Atrás</a>
      </div>
    </div>
</div>