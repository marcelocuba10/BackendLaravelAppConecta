@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div style="position: absolute; top: 65px; right: 20px; z-index:9999">
            <div class="toast show toast-warning">
                <div class="toast-header">
                  Notice
                  <button type="button" class="btn-close" style="float: right" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                  {{ $error }}
                </div>
              </div>
        </div>  
    @endforeach
@endif

@if (session('message'))
    <div style="position: absolute; top: 65px; right: 20px; z-index:9999">
        <div class="toast show toast-success">
            <div class="toast-header">
            Notice
            <button type="button" class="btn-close" style="float: right" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('message') }}
            </div>
        </div>
    </div>        
@endif

@if (session('error'))
    <div style="position: absolute; top: 65px; right: 20px; z-index:9999">
        <div class="toast show toast-error">
            <div class="toast-header">
            Notice
            <button type="button" class="btn-close" style="float: right" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>           
@endif