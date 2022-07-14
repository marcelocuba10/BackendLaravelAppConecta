@foreach($customers as $customer)
    <div class="card-style-3 mb-30">
        <div class="card-content">
            @php
                $worker_stats = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker/stats?access_key=r_4r5R3sWHDUXwR&puid=480356'), true);
                $api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key='.$customer->access_key.'&puid='.$customer->puid.'&status='.$status.'&page_size=1000'), true);
            @endphp

            <h4><a href="/user/customers/edit/{{ $customer->id }}">Cliente: {{ $customer->name }}</a></h4>
            {{-- <p>{{ $status }}</p> --}}

            <div id="grid">
                @foreach($api_response['data']['data'] as $listApi)
                    <a href="#">
                        <div id="item" data-toggle="tooltip" data-placement="bottom" title="{{ $listApi['worker_name'] }}" 
                            class="
                            @if($listApi['status'] == 'ACTIVE') bg-card-enabled 
                            @elseIf($listApi['status'] == 'Apagado') bg-card-disabled
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
    <script>
        console.log('fdsfdsfsdf');
    </script>
@endforeach