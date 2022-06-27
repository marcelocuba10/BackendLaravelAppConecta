@csrf
<div class="row">
      <div class="col-6">
        <div class="select-style-1">
          <label>(*) Funcionario</label>
          <div class="select-position">
            <select name="user_id">
              @foreach ($users as $user)
                  @if (!$report)
                    <option value="{{ $user->id }}"> {{ $user->name}} </option>
                  @else
                    <option value="{{ $user->id }}" {{ ( $user->id === $report->user_id) ? 'selected' : '' }}> {{ $user->name}} </option>
                  @endif
              @endforeach 
            </select>
          </div>
        </div>
      </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Fecha</label>
        <input type="date" name="date" id="date" value="{{ $report->date ?? old('date') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Horario de entrada</label>
        <input type="time" name="check_in_time" value="{{ $report->check_in_time ?? old('check_in_time') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Horario de salida</label>
        <input type="time" name="check_out_time" value="{{ $report->check_out_time ?? old('check_out_time') }}" class="bg-transparent">
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