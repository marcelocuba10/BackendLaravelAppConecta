@foreach($customers as $customer)
    <div class="card-style-3 mb-30" style="border: 1px solid #817c7c36;padding: 20px 10px;">
        <div class="card-content">
            <div class="title d-flex justify-content-between">
                <div class="left">
                  <h6 class="text-medium mb-2"><a href="/user/customers/show/{{ $customer->id }}">Cliente: {{ $customer->name }}</a></h6>
                </div>
            </div>

            @if ($customer->access_key && $customer->puid)

                @if ($worker_stats)
                    <div id="legend4">
                        <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-active">
                                            <span class="text-dark">Machines Total</span>&nbsp;
                                            ({{ $customer->workers_total }})
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-custom-enabled">
                                            <span class="text-dark">Total Active</span>&nbsp;
                                            ({{ $customer->workers_active }})
                                            <i class="lni lni-arrow-up"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-gray">
                                            <span class="text-dark">Total Inactive</span>&nbsp;
                                            ({{ $customer->workers_inactive }})
                                            <i class="lni lni-arrow-down"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-gray">
                                            <span class="text-dark">Total Dead</span>&nbsp;
                                            ({{ $customer->workers_dead }})
                                            <i class="lni lni-arrow-down"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                @else
                    <div id="legend4">
                        <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-active">
                                            <span class="text-dark">Sin información disponible, revise datos de registro: <b>access_key</b> y <b>puid</b></span>&nbsp;
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            @else
                <div id="legend4">
                    <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                        <li>
                            <div class="d-flex">
                                <div class="text">
                                    <p class="text-sm text-active">
                                        <span class="text-dark">Sin información disponible, datos de registro faltantes: <b>access_key</b> y <b>puid</b></span>&nbsp;
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif

            <div id="grid">
                @if ($machines == null || $machines == "")
                    <div class="alert-box primary-alert" style="width: max-content;">
                        <div class="alert">
                            <p class="text-medium">Sin máquinas registradas con este cliente</p>
                        </div>
                    </div>
                @else
                    @foreach($machines as $machine)
                        <a href="/user/machines/{{ $machine->id }}/show_api">
                            <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->worker_name }}" 
                                class="
                                @if($machine->status == 'ACTIVE') bg-card-enabled 
                                @elseIf($machine->status == 'Apagado') bg-card-disabled
                                @elseIf($machine->status == 'Requiere Atención') bg-card-attention
                                @elseIf($machine->status == 'Mantenimiento') bg-card-maintenance
                                @elseIf($machine->status == 'Error') bg-card-error
                                @elseIf($machine->status == 'INACTIVE') bg-card-offline 
                                @endif">
                                <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($machine->worker_name, 3) }}</p>
                            </div>
                        </a> 
                    @endforeach
                @endif

            </div>
        </div>
    </div>

  <!-- ========= Scripts ======== -->
  <script>

    /** ========= Tooltip ======== **/
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });

  </script>
@endforeach