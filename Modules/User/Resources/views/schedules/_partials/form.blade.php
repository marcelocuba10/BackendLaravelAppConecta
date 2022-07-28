@csrf
<div class="row">
      <div class="col-6">
          <label>(*) Funcionario</label>
          @if ($schedule)
            <div class="input-style-1">
              <input type="text" name="date" id="date" value="{{ $schedule->user_name ?? old('user_name') }}" readonly>
            </div>
          @else
          <div class="select-style-1">
            <div class="select-position">
              <select name="user_id">
                @foreach ($users as $user)
                    {{-- <option value="{{ $user->id }}" {{ ( $user->id === $schedule->user_id) ? 'selected' : '' }}> {{ $user->name}} </option> --}}
                    <option value="{{ $user->id }}"> {{ $user->name}} </option>
                @endforeach 
              </select>
            </div>
          </div>
          @endif  
        
      </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Fecha</label>
        @if ($schedule)
          <input type="text" name="date" id="date" value="{{ $schedule->date ?? old('date') }}" readonly>
        @else
          <input type="date" name="date" id="date" value="{{ $schedule->date ?? old('date') }}" class="bg-transparent">  
        @endif
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Horario de Entrada</label>
        @if ($schedule)
          <input type="text" name="check_in_time" value="{{ $schedule->check_in_time ?? old('check_in_time') }}" readonly>
        @else
          <input type="time" name="check_in_time" value="{{ $schedule->check_in_time ?? old('check_in_time') }}" class="bg-transparent">
        @endif
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>(*) Horario de Salida</label>
        @if ($schedule)
          <input type="text" name="check_out_time" value="{{ $schedule->check_out_time ?? old('check_out_time') }}" readonly>
        @else
          <input type="time" name="check_out_time" value="{{ $schedule->check_out_time ?? old('check_out_time') }}" class="bg-transparent">
        @endif
        
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/user/schedules">Atrás</a>
      </div>
    </div>
</div>