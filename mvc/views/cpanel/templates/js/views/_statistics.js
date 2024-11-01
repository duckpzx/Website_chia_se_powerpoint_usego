var optionsLine = {
  chart: {
    height: 328,
    type: 'line',
    fontFamily: 'usego-Regular',
    zoom: {
      enabled: false
    },
  },
  stroke: {
    curve: 'smooth',
    width: 2
  },
  series: [{
      name: "Thành viên",
      data: [1, 15, 26, 20, 33, 27]
    },
    {
      name: "Thanh toán",
      data: [3, 33, 21, 42, 19, 32]
    },
    {
      name: "Tải xuống",
      data: [0, 39, 52, 11, 29, 43]
    }
  ],
  fill: {
    type: 'gradient', 
    gradient: {
      shadeIntensity: 1,
      type: 'horizontal',
      gradientToColors: ['rgb(59, 130, 246)', 'rgb(234, 179, 8)', 'rgb(251, 113, 133)'],
      stops: [0, 50, 50, 100]
    }
  },
  colors: ['#76bfff', 'rgb(251, 113, 133)', 'rgb(253, 186, 116)'],
  markers: {
    size: 0,
    strokeWidth: 0,
    hover: {
      size: 9
    }
  },
  grid: {
    show: true,
    padding: {
      bottom: 0
    }
  },
  labels: ['01/15/2002', '01/16/2002', '01/17/2002', '01/18/2002', '01/19/2002', '01/20/2002'],
  xaxis: {
    tooltip: {
      enabled: false
    }
  },
  legend: {
    position: 'top',
    horizontalAlign: 'left',
    offsetY: 5
  }
}

var chartLine = new ApexCharts($('#line-adwords'), optionsLine);
chartLine.render();

var optionsDonut = {
  chart: {
    height: 284,
    fontFamily: 'usego-Regular',
    type: 'donut',  
  },
  series: [44, 155, 41], 
  labels: ['Thuyết trình', 'Bài viết', 'Dịch vụ'],  
  colors: ['rgb(251, 113, 133)', '#76bfff', '#8f93fb'],  
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 1,
      type: 'horizontal',
      gradientToColors: ['rgb(234, 179, 8)', 'rgb(59, 130, 246)', 'rgb(184, 70, 220)'],
      stops: [0, 50, 50, 100]
    }
  },
  legend: {
    position: 'top',
    horizontalAlign: 'right',
    offsetY: 5
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        height: 300
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
}

var chartDonut = new ApexCharts($('#donut-adwords'), optionsDonut);
chartDonut.render();
