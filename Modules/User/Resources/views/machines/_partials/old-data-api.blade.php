@foreach($customers as $customer)
    <div class="card-style-3 mb-30">
        <div class="card-content">
            @php
                $worker_stats = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker/stats?access_key='.$customer->access_key.'&puid='.$customer->puid), true);
                $api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key='.$customer->access_key.'&puid='.$customer->puid.'&status='.$status.'&page_size=1000'), true);
            @endphp

            <div class="title d-flex justify-content-between">
                <div class="left">
                  <h6 class="text-medium mb-2"><a href="/user/customers/edit/{{ $customer->id }}">Cliente: {{ $customer->name }}</a></h6>
                </div>
            </div>
            <div id="legend4">
                <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                    <li>
                        <div class="d-flex">
                            <div class="text">
                                <p class="text-sm text-active">
                                    <span class="text-dark">Machines Total</span>&nbsp;
                                    ({{ $worker_stats['data']['workers_total'] }})
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex">
                            <div class="text">
                                <p class="text-sm text-custom-enabled">
                                    <span class="text-dark">Total Active</span>&nbsp;
                                    ({{ $worker_stats['data']['workers_active'] }})
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
                                    ({{ $worker_stats['data']['workers_inactive'] }})
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
                                    ({{ $worker_stats['data']['workers_dead'] }})
                                    <i class="lni lni-arrow-down"></i>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div id="grid">
                @foreach($api_response['data']['data'] as $listApi)
                    <a href="#">
                        <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $listApi['worker_name'] }}" 
                            class="
                            @if($listApi['status'] == 'ACTIVE') bg-card-enabled 
                            @elseIf($listApi['status'] == 'DEAD') bg-card-disabled
                            @elseIf($listApi['status'] == 'Requiere Atención') bg-card-attention
                            @elseIf($listApi['status'] == 'Mantenimiento') bg-card-maintenance
                            @elseIf($listApi['status'] == 'Error') bg-card-error
                            @elseIf($listApi['status'] == 'INACTIVE') bg-card-offline 
                            @endif">
                            <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($listApi['worker_name'], 3) }}</p>
                        </div>
                    </a> 
                @endforeach
            </div>
        </div>
    </div>
@endforeach