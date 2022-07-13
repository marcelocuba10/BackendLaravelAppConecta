

@foreach($customers as $customer)
    <div class="card-style-3 mb-30">
        <div class="card-content">
            <h4><a href="#0">{{ $customer->name }}</a></h4>

            @php
            $api_response  = json_decode(file_get_contents('https://pool.api.btc.com/v1/worker?access_key='.$customer->access_key.'&puid='.$customer->puid.'&page_size=5'), true);

            // $client = new \GuzzleHttp\Client();
            // $response = $client->request('GET', 'https://pool.api.btc.com/v1/worker?access_key='.$customer->access_key.'&puid='.$customer->puid.'&page_size=1000');
            // $api_response = json_decode($response->getBody(), true);

            // $response->getStatusCode() == 200
            // dd($response->getStatusCode());
            // exit;
            @endphp

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
                            <p class="text-sm  text-white" style="margin-top: 10px;">{{ Str::limit($listApi['worker_name'], 5) }}</p>
                        </div>
                    </a> 
                @endforeach
            </div>
        </div>
    </div>
@endforeach