@foreach($customers as $customer)
    <div class="card-style-3 mb-30" style="border: 1px solid #817c7c36;padding: 20px 10px;">
        <div class="card-content">
            <div class="title d-flex flex-wrap pl-10 pr-30 mb-10 align-items-center justify-content-between">
                <h6><a href="/user/customers/show/{{ $customer->id }}">Cliente: {{ $customer->name }}</a> | {{ $customer->pool }}</h6>
                <div class="d-flex align-items-center">
                  <span class="text-regular text-sm">Actualizado:&nbsp;{{ $customer->updated_at }}</span>
                </div>
              </div>
            <div class="title d-flex justify-content-between">
                <div class="left">
                </div>
            </div>

            @if ($customer->pool == "btc.com")
                @if ($customer->access_key && $customer->puid)
                    <div id="legend4">
                        <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-active">
                                            <span class="text-dark">Total Máquinas</span>&nbsp;({{ $customer->workers_total }})
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-custom-enabled">
                                            <span class="text-dark">Total Activas</span>&nbsp;({{ $customer->workers_active }})<i class="lni lni-arrow-up"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-gray">
                                            <span class="text-dark">Total Inactivas</span>&nbsp;({{ $customer->workers_inactive }})<i class="lni lni-arrow-down"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-gray">
                                            <span class="text-dark">Total Apagadas</span>&nbsp;({{ $customer->workers_dead }})<i class="lni lni-arrow-down"></i>
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
                                            <span class="text-dark">Sin información disponible, revise los datos de registro.</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            @endif

            @if ($customer->pool == "antpool.com")
                @if ($customers[0]->userIdPool && $customers[0]->apiKey && $customers[0]->secretKey)
                    <div id="legend4">
                        <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-active">
                                            <span class="text-dark">Total Máquinas</span>&nbsp;({{ $customer->totalWorkerNum }})
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-custom-enabled">
                                            <span class="text-dark">Total Activas</span>&nbsp;({{ $customer->activeWorkerNum }})<i class="lni lni-arrow-up"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-gray">
                                            <span class="text-dark">Total Inactivas</span>&nbsp;({{ $customer->inactiveWorkerNum }})<i class="lni lni-arrow-down"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="text">
                                        <p class="text-sm text-gray">
                                            <span class="text-dark">Total Apagadas</span>&nbsp;({{ $customer->invalidWorkerNum }})<i class="lni lni-arrow-down"></i>
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
                                            <span class="text-dark">Sin información disponible, revise los datos de registro.</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            @endif

            <div id="grid">
                @if ($machines == null || $machines == "")
                    <div class="alert-box primary-alert" style="width: max-content;">
                        <div class="alert">
                            <p class="text-medium">Sin información de máquinas </p>
                        </div>
                    </div>
                @else
                    @if ($customer->pool == "btc.com")
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
                    
                    @if ($customer->pool == "antpool.com")
                        @foreach($machines as $machine)
                            @php
                                $machineStatus = '';
                            @endphp
                            @if ($machine->last10m > 0)
                                @php
                                    $machineStatus = "bg-card-enabled";        
                                @endphp    
                            @else
                                @php
                                    $machineStatus = "bg-card-disabled";   
                                @endphp  
                            @endif 
                            <a href="/user/machines/{{ $machine->id }}/show_api">
                                <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $machine->worker }}" class="{{ $machineStatus }}">
                                    <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($machine->worker, 3) }}</p>
                                </div>
                            </a> 
                        @endforeach
                    @endif
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