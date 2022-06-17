@csrf

<div class="form-group  row"><label class="col-sm-2 col-form-label">*Cliente</label>
    <div class="col-sm-8">
        <select class="form-control m-b" name="roles">
            <option value="">Seleccione un cliente </option>
            @foreach ($customers as $customer)
                <option value="{{ $customer }}"> {{ $customer->name}} </option>
            @endforeach 
        </select>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-info btn-sm" href="{{ route('users.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Cliente</a>
    </div>
</div>
<div class="form-group  row"><label class="col-sm-2 col-form-label">*Cancha</label>
    <div class="col-sm-8">
        <select class="form-control m-b" name="roles">
            <option value="">Seleccione una cancha </option>
            @foreach ($grounds as $ground)
                <option value="{{ $ground }}"> {{ $ground->name}} </option>
            @endforeach 
        </select>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-info btn-sm" href="{{ route('grounds.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Cancha</a>
    </div>
</div>
<div class="form-group  row"><label class="col-sm-2 col-form-label">* Precio</label>
    <div class="col-sm-3">
        <input type="text" name="price" class="form-control" placeholder="Ingrese precio" autocomplete="off" value="{{ $booking->price ?? old('price') }}">
    </div>
</div>
<div class="form-group  row"><label class="col-sm-2 col-form-label">Descripcion / Observacion</label>
    <div class="col-sm-10">
        <input type="text" name="description" class="form-control" placeholder="Ingrese descripcion" autocomplete="off" value="{{ $booking->description ?? old('description') }}">
    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group  row">
    <label class="col-sm-2 col-form-label">Dias Habilitados</label>
    <div class="col-sm-4">
        @foreach ($days as $day )
            <div class="i-checks">
                <label>
                    <!-- guardo en array ya que se puede marcar mas de un valor -->
                    <input name="day[]" type="checkbox" value="{{ $day }}" @if(!empty($days_selected)) {{ in_array($day, $days_selected)  ? 'checked' : '' }} @endif><i></i> {{ $day }} 
                </label>
            </div>
        @endforeach
    </div>
    <label class="col-sm-2 col-form-label">Horarios Habilitados</label>
    <div class="col-sm-4">
        @foreach ($schedules as $schedule )
            <div class="i-checks">
                <label>
                    <!-- guardo en array ya que se puede marcar mas de un valor -->
                    <input name="schedule[]" type="checkbox" value="{{ $schedule }}" @if(!empty($schedules_selected)) {{ in_array($schedule, $schedules_selected)  ? 'checked' : '' }} @endif><i></i> {{ $schedule }} 
                </label>
            </div>
        @endforeach
    </div> 
</div>

<div class="hr-line-dashed"></div>

<div class="form-group  row">
    <label class="col-sm-2 col-form-label">Foto de la cancha</label>
    <div class="col-md-6">
        <h4>Vista previa</h4>
        <div class="img-preview img-preview-sm" style="width: 200px; height: 123.609px;"><img src="http://webapplayers.com/inspinia_admin-v2.9.4/img/p3.jpg" style="display: block; width: 250px; height: 167.293px; min-width: 0px !important; min-height: 0px !important; max-width: none !important; max-height: none !important; transform: translateX(-25px) translateY(-21.8419px);"></div>
        <p>
            * Subir una foto de la cancha
        </p>
        <div>
            <label title="Upload image file" for="inputImage" class="btn btn-info">
                <input type="file" accept="image/*" name="image" id="inputImage" style="display:none">
                Subir imagen
            </label>
        </div>
    </div>
</div>


<div class="hr-line-dashed"></div>
<div class="form-group row">
    <div class="col-sm-4 col-sm-offset-2">
        <a class="btn btn-white btn-sm" href="{{ route('grounds.index') }}" >Cancelar</a>
        <button class="btn btn-primary btn-sm" type="submit">Guardar Cambios</button>
    </div>
</div>