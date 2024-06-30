$(document).ready(function () {
    const xValues = [];
    const yValues = [20,80,80,99,9,20,87];
    let max_val = Math.max.apply(null, yValues);
    var curMonth = new Date().getMonth()+ 1;
    for(let i=1; i<curMonth+1;i++){
        xValues.push('T'+i);
    }
    var year=new Date().getFullYear();
    var title='Doanh thu '+year+' (triệu)'
    new Chart("myChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: "rgb(253,160,29)",
        //   borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        }]
      },
      options: {
        legend:{ display: false, },
        title: { display: true, text:title },
        scales: {
          yAxes: [{ticks: {min: 0,
                           max: max_val,
                           stepSize: 20}}],
        }
      }
    });
    //donut chart for course
    let a="<?php echo $course?>"
    console.log(a);
    var x = [];
    var y = [55, 49, 44, 24, 15];
    var barColors = [
    "#5E5DF",
    "rgb(253,160,29)",
    "rgb(238,174,202",
    "#FAAB78",
    "#95BDFF"
    ];
    
    new Chart("courseChart", {
    type: "doughnut",
    data: {
        labels: x,
        datasets: [{
        backgroundColor: barColors,
        data: y
        }]
    },
    options: {
        title: {
        display: true,
        text: "THỐNG KÊ LỚP HỌC THEO KHÓA"
        }
    }
    });
});