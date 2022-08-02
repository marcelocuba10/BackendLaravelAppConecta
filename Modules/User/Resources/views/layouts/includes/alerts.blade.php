@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div style="position: absolute; top: 65px; right: 20px; z-index:9999">
            <div class="toast toast1 toast-bootstrap fade panel-warning show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header panel-heading" style="padding: 5px">
                    <i class="fa fa-info-circle"> </i>
                    <strong class="mr-auto m-l-sm"> Aviso</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
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
        <div class="toast toast1 toast-bootstrap fade panel-info show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header panel-heading" style="padding: 5px">
                <i class="fa fa-info-circle"> </i>
                <strong class="mr-auto m-l-sm"> Aviso</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session('message') }}
            </div>
        </div>
    </div>        
@endif

@if (session('error'))
    <div style="position: absolute; top: 65px; right: 20px; z-index:9999">
        <div class="toast toast1 toast-bootstrap fade panel-danger show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header panel-heading" style="padding: 5px">
                <i class="fa fa-info-circle"> </i>
                <strong class="mr-auto m-l-sm"> Aviso</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>        
@endif