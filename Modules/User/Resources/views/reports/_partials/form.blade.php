@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Funcionario</label>
        <input type="text" name="name" value="{{ $report->name ?? old('name') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Fecha</label>
        <input type="text" name="date" id="date" value="{{ $report->date ?? old('date') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="input-style-1">
        <label>Horario de entrada</label>
        <input type="text" name="check_in_time" value="{{ $report->check_in_time ?? old('check_in_time') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Horario de salida</label>
        <input type="text" name="check_out_time" value="{{ $report->check_out_time ?? old('check_out_time') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Save</button>
        <a class="main-btn danger-btn-outline m-2" href="{{ route('reports.index') }}">Cancel</a>
      </div>
    </div>
</div>