@extends('admin::tema.app')
@section('content')
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> Available Balance </span>
                                        <h2 class="font-bold">$ 4,232</h2>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Customers </span>
                                    @php
                                    use Modules\Admin\Entities\SuperUser;
                                        $cant_users = SuperUser::count(); 
                                    @endphp
                                    <h2 class="font-bold">{{$cant_users}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Customer Balance </span>
                                    <h2 class="font-bold">$ 4,232</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 yellow-bg">
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <span> My Afiliates </span>
                                    <h2 class="font-bold">1152</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Monthly Average </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#" class="dropdown-item">Config option 1</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div id="morris-bar-chart" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="342" version="1.1" width="752" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.84082px; top: -0.484375px;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                    <text x="32.84765625" y="303" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.34765625,303H726.5" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625" y="233.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">25</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.34765625,233.5H726.5" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625" y="164" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.34765625,164H726.5" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625" y="94.50000000000003" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.000000000000028" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.34765625,94.50000000000003H726.5" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="32.84765625" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan></text><path fill="none" stroke="#aaaaaa" d="M45.34765625,25H726.5" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="677.8462611607143" y="315.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><text x="580.5387834821429" y="315.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="483.23130580357144" y="315.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><text x="385.923828125" y="315.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text><text x="288.61635044642856" y="315.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2008</tspan></text><text x="191.30887276785714" y="315.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007</tspan></text><text x="94.00139508928572" y="315.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2006</tspan></text><rect x="57.51109095982143" y="136.20000000000002" width="34.990304129464285" height="166.79999999999998" r="0" rx="0" ry="0" fill="#1ab394" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="95.50139508928572" y="164" width="34.990304129464285" height="139" r="0" rx="0" ry="0" fill="#cacaca" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="154.8185686383929" y="94.50000000000003" width="34.990304129464285" height="208.49999999999997" r="0" rx="0" ry="0" fill="#1ab394" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="192.80887276785717" y="122.30000000000001" width="34.990304129464285" height="180.7" r="0" rx="0" ry="0" fill="#cacaca" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="252.12604631696428" y="164" width="34.990304129464285" height="139" r="0" rx="0" ry="0" fill="#1ab394" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="290.11635044642856" y="191.8" width="34.990304129464285" height="111.19999999999999" r="0" rx="0" ry="0" fill="#cacaca" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="349.4335239955357" y="94.50000000000003" width="34.990304129464285" height="208.49999999999997" r="0" rx="0" ry="0" fill="#1ab394" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="387.423828125" y="122.30000000000001" width="34.990304129464285" height="180.7" r="0" rx="0" ry="0" fill="#cacaca" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="446.74100167410717" y="164" width="34.990304129464285" height="139" r="0" rx="0" ry="0" fill="#1ab394" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="484.73130580357144" y="191.8" width="34.990304129464285" height="111.19999999999999" r="0" rx="0" ry="0" fill="#cacaca" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="544.0484793526786" y="94.50000000000003" width="34.990304129464285" height="208.49999999999997" r="0" rx="0" ry="0" fill="#1ab394" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="582.0387834821429" y="122.30000000000001" width="34.990304129464285" height="180.7" r="0" rx="0" ry="0" fill="#cacaca" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="641.35595703125" y="25" width="34.990304129464285" height="278" r="0" rx="0" ry="0" fill="#1ab394" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="679.3462611607143" y="52.80000000000001" width="34.990304129464285" height="250.2" r="0" rx="0" ry="0" fill="#cacaca" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg>
                                    <div class="morris-hover morris-default-style" style="left: 53.3139px; top: 131px; display: none;">
                                        <div class="morris-hover-row-label">2006</div>
                                        <div class="morris-hover-point" style="color: #1ab394">Series A: 60</div>
                                        <div class="morris-hover-point" style="color: #cacaca">Series B: 50</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Donut Chart Example</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#" class="dropdown-item">Config option 1</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div id="morris-donut-chart"><svg height="342" version="1.1" width="752" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.84082px; top: -0.671875px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#87d6c6" d="M375.75,278.3333333333333A107.33333333333333,107.33333333333333,0,0,0,477.10888475900094,206.31035152552312" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#87d6c6" stroke="#ffffff" d="M375.75,281.3333333333333A110.33333333333333,110.33333333333333,0,0,0,479.94189706592954,207.29728681660916L523.066639960287,222.32063513647458A156,156,0,0,1,375.75,327Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#54cdb4" d="M477.10888475900094,206.31035152552312A107.33333333333333,107.33333333333333,0,0,0,279.4668788296735,123.56578215945092" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#54cdb4" stroke="#ffffff" d="M479.94189706592954,207.29728681660916A110.33333333333333,110.33333333333333,0,0,0,276.7757356913724,122.23998103968403L235.8105568083453,102.05834177212121A156,156,0,0,1,523.066639960287,222.32063513647458Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#1ab394" d="M279.4668788296735,123.56578215945092A107.33333333333333,107.33333333333333,0,0,0,375.71628023940616,278.3333280366457" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#1ab394" stroke="#ffffff" d="M276.7757356913724,122.23998103968403A110.33333333333333,110.33333333333333,0,0,0,375.71533776162556,281.3333278886016L375.69942035910924,331.9999920549685A161,161,0,0,1,231.3253182445102,99.84867323917638Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="375.75" y="161" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 800 15px Arial;" font-size="15px" font-weight="800" transform="matrix(1.4273,0,0,1.4273,-160.5623,-73.4976)" stroke-width="0.7006178830227744"><tspan dy="6" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Mail-Order Sales</tspan></text><text x="375.75" y="181" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 14px Arial;" font-size="14px" transform="matrix(2.2361,0,0,2.2361,-464.5973,-213.8472)" stroke-width="0.4472049689440994"><tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">20</tspan></text></svg></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="widget style1 yellow-bg">
                            <div class="row vertical-align">
                                <div class="col-3">
                                    <i class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="font-bold">217</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 red-bg">
                            <div class="row vertical-align">
                                <div class="col-3">
                                    <i class="fa fa-thumbs-up fa-3x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="font-bold">400</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 blue-bg">
                            <div class="row vertical-align">
                                <div class="col-3">
                                    <i class="fa fa-rss fa-3x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="font-bold">10</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 lazur-bg">
                            <div class="row vertical-align">
                                <div class="col-3">
                                    <i class="fa fa-phone fa-3x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="font-bold">120</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 lazur-bg">
                            <div class="row vertical-align">
                                <div class="col-3">
                                    <i class="fa fa-euro fa-3x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="font-bold">462</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 yellow-bg">
                            <div class="row vertical-align">
                                <div class="col-3">
                                    <i class="fa fa-shield fa-3x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="font-bold">610</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer fixed">
                <div class="float-right">
                    <strong>Integrating Ideas</strong>
                </div>
                <div>
                    <strong>Copyright</strong> Developed by Conectacode - Apis &copy; 2022
                </div>
            </div>

@endsection