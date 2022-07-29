@csrf
<div class="row">
    <div class="col-6">
      <div class="input-style-1">
        <label>Título</label>
        <input type="text" name="title" value="{{ $notification->title ?? old('title') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-6">
      <div class="input-style-1">
        <label>Fecha</label>
        <input type="date" name="date" id="date" placeholder="DD/MM/YYYY" value="{{ $notification->date ?? old('date') }}" class="bg-transparent">
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="input-style-1">
        <label>Mensaje</label>
        <textarea rows="5" name="subject" class="bg-transparent">{{ $notification->subject ?? old('subject') }}</textarea>
      </div>
    </div>
    <!-- end col -->
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button type="submit" class="main-btn primary-btn btn-hover m-2">Guardar</button>
        <a class="main-btn danger-btn-outline m-2" href="/user/notifications">Atrás</a>
      </div>
    </div>
</div>