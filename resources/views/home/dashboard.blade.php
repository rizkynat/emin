<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | Emin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Podkova&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{asset('assets/scrollbar.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <style type="text/css">/* Chart.js */
      /* Chart.js */
    @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>

    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.output.css')
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="/assets/init-alpine.js"></script>
    <script src="{{asset('assets/focus-trap.js')}}"></script>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  </head>
  <body>
  @extends('layouts.admin-master')

  @section('content')

  <!--header-->
  <div class="flex justify-center flex-1 lg:mr-32">
  <div
                class="w-full max-w-xl mx-auto focus-within:text-primary-font"
              >
                <form action="/cari-artikel" method="get" class="relative">
                  <div class="flex items-center">
                  <input
                    id="input-artikel"
                    name="cari"
                    class="w-full pl-4 pr-2 text-sm placeholder-gray-600 bg-gray-100 focus:outline-none focus:shadow-outline-green border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-primary-normal  form-input"
                    type="text"
                    tabindex="99"
                    placeholder="Cari artikel"
                    aria-label="Search"
                  />
                  <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-primary-normal rounded-lg border-0 border-blue-700 hover:bg-primary-hover focus:ring-4 focus:outline-none focus:shadow-outline-green dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                  </button>
                  </div>
                </form>
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              @include('layouts.notifikasi')
            </ul>
          </div>
        </header>
        <main class="scrollbar h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
            <!--main-->
            <h4
                    class="mb-6 text-lg font-semibold text-gray-600 dark:text-gray-300"
                    >
                    <div class="bg-primary-normal w-60 h-8 shadow-md rounded-r-3xl"><span class="ml-4 text-primary-white">Dashboard</span></div>
                    </h4>
                    <div class="mb-4">
                    @if(\Session::has('alert-success'))              
                        <div class="flex mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Info</span>
                          <div>
                            <span class="font-medium">{{Session::get('alert-success')}}</span>
                          </div>
                        </div>
                      @elseif(\Session::has('alert'))              
                        <div class="flex mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                          <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Info</span>
                          <div>
                            <span class="font-medium">{{Session::get('alert')}}</span>
                          </div>
                        </div>
                      @endif
                    <div class="flex items-center">
                          <select id="filter_tahun" name="filter_tahun" class="p-2 w-28 text-sm font-medium text-primary-normal rounded-lg border-2 border-primary-normal focus:ring-primary-hover focus:border-primary-hover">
                          <option selected>Pilih tahun</option>  
                          @foreach($tahuns as $tahun)
                          <option value="{{$tahun->tahun}}">{{$tahun->tahun}}</option>
                          @endforeach
                          </select>
                    </div>
                    </div>

                    <div class="mb-4 grid gap-6 md:grid-cols-2">
                      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                          Keuangan
                        </h4>
                        <canvas id="bar" style="display: block; height: 249px; width: 498px;" width="996" height="498" class="chartjs-render-monitor"></canvas>
                        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                        </div>
                      </div>

                      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                          Artikel
                        </h4>
                        <canvas id="pie" style="display: block; height: 249px; width: 498px;" width="996" height="498" class="chartjs-render-monitor"></canvas>
                        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                        </div>
                      </div>
                    </div>
                    
                            
                </div>
            </div>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script >
    const currentYear = <?php echo $currentYear; ?>;
    const uangMasuk = <?php echo $uangMasuk; ?>;
    const uangKeluar = <?php echo $uangKeluar; ?>;
    const rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number);
  }
    const barChartData = {
        labels: <?php echo $bulan; ?>,
        datasets: [
          {
            label: 'Uang Masuk',
            backgroundColor: "#0E9F6E",
            data: uangMasuk
          },
          {
            label: 'Uang Keluar',
            backgroundColor: "#F05252",
            data: uangKeluar
          }
      ]
    };
        

        const ctxBar = document.getElementById("bar").getContext("2d");
        const Bar = new Chart(ctxBar, {
            type: 'bar',
            data: barChartData,
            options: {
              tooltips: {
        callbacks: {
            label: function(tooltipItem) {
                return rupiah(Number(tooltipItem.yLabel));
            }
        }
    },
                responsive: true,
                title: {
                    display: true,
                    text: 'Keuangan tahun '+currentYear
                },
                scales: {
                  xAxes: [{
                    gridLines: {
                      display: false,
                    },
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Bulan'
                    }
                  }],
                  yAxes: [{
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Nominal (Rp)'
                    }
                  }]
              }
            }
        });
    
</script>
<script>
  const status = <?php echo $status;?>;
  const jml_status = <?php echo $jml_status;?>;

  var config = {
  type: 'doughnutLabels',
  data: {
    datasets: [{
      data: jml_status,
      backgroundColor: ['#E94560', '#1c64f2', '#7e3af2', '#0E9F6E', '#F05252', '#F57328','#1C6758', '#0694a2', '#FF9551', '#FBDF07', '#42032C', '#1CD6CE'],
      label: 'Dataset 1'
    }],
    labels: status
  },
  options: {
    responsive: true,
    legend: {
      position: 'top',
    },
    title: {
      display: true,
      text: 'Status Artikel'
    },
    animation: {
      animateScale: true,
      animateRotate: true
    }
  }
};

Chart.defaults.doughnutLabels = Chart.helpers.clone(Chart.defaults.doughnut);

var helpers = Chart.helpers;
var defaults = Chart.defaults;

Chart.controllers.doughnutLabels = Chart.controllers.doughnut.extend({
	updateElement: function(arc, index, reset) {
    var _this = this;
    var chart = _this.chart,
        chartArea = chart.chartArea,
        opts = chart.options,
        animationOpts = opts.animation,
        arcOpts = opts.elements.arc,
        centerX = (chartArea.left + chartArea.right) / 2,
        centerY = (chartArea.top + chartArea.bottom) / 2,
        startAngle = opts.rotation, // non reset case handled later
        endAngle = opts.rotation, // non reset case handled later
        dataset = _this.getDataset(),
        circumference = reset && animationOpts.animateRotate ? 0 : arc.hidden ? 0 : _this.calculateCircumference(dataset.data[index]) * (opts.circumference / (2.0 * Math.PI)),
        innerRadius = reset && animationOpts.animateScale ? 0 : _this.innerRadius,
        outerRadius = reset && animationOpts.animateScale ? 0 : _this.outerRadius,
        custom = arc.custom || {},
        valueAtIndexOrDefault = helpers.getValueAtIndexOrDefault;

    helpers.extend(arc, {
      // Utility
      _datasetIndex: _this.index,
      _index: index,

      // Desired view properties
      _model: {
        x: centerX + chart.offsetX,
        y: centerY + chart.offsetY,
        startAngle: startAngle,
        endAngle: endAngle,
        circumference: circumference,
        outerRadius: outerRadius,
        innerRadius: innerRadius,
        label: valueAtIndexOrDefault(dataset.label, index, chart.data.labels[index])
      },

      draw: function () {
      	var ctx = this._chart.ctx,
						vm = this._view,
						sA = vm.startAngle,
						eA = vm.endAngle,
						opts = this._chart.config.options;
				
					var labelPos = this.tooltipPosition();
					var segmentLabel = vm.circumference / opts.circumference * 100;
					
					ctx.beginPath();
					
					ctx.arc(vm.x, vm.y, vm.outerRadius, sA, eA);
					ctx.arc(vm.x, vm.y, vm.innerRadius, eA, sA, true);
					
					ctx.closePath();
					ctx.strokeStyle = vm.borderColor;
					ctx.lineWidth = vm.borderWidth;
					
					ctx.fillStyle = vm.backgroundColor;
					
					ctx.fill();
					ctx.lineJoin = 'bevel';
					
					if (vm.borderWidth) {
						ctx.stroke();
					}
					
					if (vm.circumference > 0.15) { // Trying to hide label when it doesn't fit in segment
						ctx.beginPath();
						ctx.font = helpers.fontString(opts.defaultFontSize, opts.defaultFontStyle, opts.defaultFontFamily);
						ctx.fillStyle = "#fff";
						ctx.textBaseline = "top";
						ctx.textAlign = "center";
            
            // Round percentage in a way that it always adds up to 100%
						ctx.fillText(segmentLabel.toFixed(0) + "%", labelPos.x, labelPos.y);
					}
      }
    });

        var model = arc._model;
        model.backgroundColor = custom.backgroundColor ? custom.backgroundColor : valueAtIndexOrDefault(dataset.backgroundColor, index, arcOpts.backgroundColor);
        model.hoverBackgroundColor = custom.hoverBackgroundColor ? custom.hoverBackgroundColor : valueAtIndexOrDefault(dataset.hoverBackgroundColor, index, arcOpts.hoverBackgroundColor);
        model.borderWidth = custom.borderWidth ? custom.borderWidth : valueAtIndexOrDefault(dataset.borderWidth, index, arcOpts.borderWidth);
        model.borderColor = custom.borderColor ? custom.borderColor : valueAtIndexOrDefault(dataset.borderColor, index, arcOpts.borderColor);

        // Set correct angles if not resetting
        if (!reset || !animationOpts.animateRotate) {
          if (index === 0) {
            model.startAngle = opts.rotation;
          } else {
            model.startAngle = _this.getMeta().data[index - 1]._model.endAngle;
          }

          model.endAngle = model.startAngle + model.circumference;
        }

        arc.pivot();
      }
    });


  const ctxPie = document.getElementById("pie").getContext("2d");
  const Pie = new Chart(ctxPie, config);

</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#filter_tahun').change(function(){
        var tahun = $(this).val();
        window.location.assign('/filter-dashboard/'+tahun);
      });
      });

      $(function(){
        $(document).on("keypress", function(e) {
          if(e.which == 47){
            $("#input-artikel").focus();
          }else if(e.which == 46){
            window.location.assign('/list-artikel');
          }
        });
        });
</script>
@endsection