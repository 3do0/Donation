try {


  Apex.tooltip = {
    theme: 'dark'
  }


    /*
        ==============================
        |    @Options Charts Script   |
        ==============================
    */

    /*
        ======================================
            Visitor Statistics | Options
        ======================================
    */

    
    // Total Visits
    document.addEventListener('visitorsData', function (event) {
      const visitors = event.detail[0].visitors;  
      console.log(visitors);
    var spark1 = {
        chart: {
            id: 'unique-visits',
            group: 'sparks2',
            type: 'line',
            height: 80,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                color: '#e2a03f',
                opacity: 0.7,
            }
        },
        series: [{
            data: visitors
        }],
        stroke: {
          curve: 'smooth',
          width: 2,
        },
        markers: {
            size: 0
        },
        grid: {
          padding: {
            top: 35,
            bottom: 0,
            left: 40
          }
        },
        colors: ['#e2a03f'],
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        },
        responsive: [{
            breakpoint: 1351,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        },
        {
            breakpoint: 1200,
            options: {
               chart: {
                  height: 80,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 40
                  }
              },
            },
        },
        {
            breakpoint: 576,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 45,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        }

        ]
    }
    d_1C_1 = new ApexCharts(document.querySelector("#total-users"), spark1);
    d_1C_1.render();
    });

    // Paid Visits
    document.addEventListener('donorsData', function (event) {
      const donors = event.detail[0].donors;  
      console.log(donors);
    var spark2 = {
        chart: {
          id: 'total-users',
          group: 'sparks1',
          type: 'line',
          height: 80,
          sparkline: {
            enabled: true
          },
          dropShadow: {
            enabled: true,
            top: 3,
            left: 1,
            blur: 3,
            color: '#009688',
            opacity: 0.7,
          }
        },
        series: [{
          data: donors
        }],
        stroke: {
          curve: 'smooth',
          width: 2,
        },
        markers: {
          size: 0
        },
        grid: {
          padding: {
            top: 35,
            bottom: 0,
            left: 40
          }
        },
        colors: ['#009688'],
        tooltip: {
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function formatter(val) {
                return '';
              }
            }
          }
        },
        responsive: [{
            breakpoint: 1351,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        },
        {
            breakpoint: 1200,
            options: {
               chart: {
                  height: 80,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 40
                  }
              },
            },
        },
        {
            breakpoint: 576,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        }
        ]
    }

    d_1C_2 = new ApexCharts(document.querySelector("#paid-visits"), spark2);
    d_1C_2.render();
     });
    

    /*
        ===================================
            Unique Visitors | Options
        ===================================
    */

    document.addEventListener('visitsAndDonationsData', function (event) {
      const donations = event.detail[0].donations;  
      const visitors = event.detail[0].visitors;  
        console.log(visitors);
              var d_1options1 = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                      show: false,
                    },
                    dropShadow: {
                        enabled: true,
                        top: 1,
                        left: 1,
                        blur: 1,
                        color: '#515365',
                        opacity: 0.3,
                    }
                },
                colors: ['#5c1ac3', '#ffbb44'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'  
                    },
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                      position: 'bottom',
                      horizontalAlign: 'center',
                      fontSize: '14px',
                      markers: {
                        width: 10,
                        height: 10,
                      },
                      itemMargin: {
                        horizontal: 0,
                        vertical: 8
                      }
                },
                grid: {
                  borderColor: '#191e3a',
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'الزيارات',
                    data: visitors
                }, {
                    name: 'التبرعات',
                    data: donations
                }],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                fill: {
                  type: 'gradient',
                  gradient: {
                    shade: 'dark',
                    type: 'vertical',
                    shadeIntensity: 0.3,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 0.8,
                    stops: [0, 100]
                  }
                },
                tooltip: {
                  theme: 'dark',
                    y: {
                        formatter: function (val) {
                            return val
                        }
                    }
                }
              }
              var d_1C_3 = new ApexCharts(
                document.querySelector("#uniqueVisits"),
                d_1options1
            );
            d_1C_3.render();
     });

    /*
        ==============================
            Statistics | Options
        ==============================
    */

    // Followers

    document.addEventListener('donorsData', function (event) {
      const donors = event.detail[0].donors;  
      console.log(donors);
    var d_1options3 = {
      chart: {
        id: 'sparkline1',
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      series: [{
        name: 'متبرع',
        data: donors
      }],
      labels: ['1', '2', '3', '4', '5', '6', '7'].reverse(),
      yaxis: {
        min: 0
      },
      colors: ['#1b55e2'],
      tooltip: {
        x: {
          show: false,
        }
      },
      fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .40,
              opacityTo: .05,
              stops: [45, 100]
          }
      },
    }
    var d_1C_5 = new ApexCharts(document.querySelector("#hybrid_followers"), d_1options3);
    d_1C_5.render()
    });

    // Referral

    document.addEventListener('DonationsData', function (event) {
      const donations= event.detail[0].donations;  
      console.log(donations);
    var d_1options4 = {
      chart: {
        id: 'sparkline1',
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      series: [{
        name: 'تبرع',
        data: donations
      }],
      labels: ['1', '2', '3', '4', '5', '6', '7'].reverse(),
      yaxis: {
        min: 0
      },
      colors: ['#e7515a'],
      tooltip: {
        x: {
          show: false,
        }
      },
      fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .40,
              opacityTo: .05,
              stops: [45, 100]
          }
      },
    }
    var d_1C_6 = new ApexCharts(document.querySelector("#hybrid_followers1"), d_1options4);
    d_1C_6.render()
    });

    // Engagement Rate
    document.addEventListener('CasesData', function (event) {
      const cases = event.detail[0].cases;  
      console.log(cases);
    var d_1options5 = {
      chart: {
        id: 'sparkline1',
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      fill: {
        opacity: 1,
      },
      series: [{
        name: 'حالة',
        data: cases
      }],
      labels: ['1', '2', '3', '4', '5', '6', '7'].reverse(),
      yaxis: {
        min: 0
      },
      colors: ['#009688'],
      tooltip: {
        x: {
          show: false,
        }
      },
      fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .40,
              opacityTo: .05,
              stops: [45, 100]
          }
      },
    }
    var d_1C_7 = new ApexCharts(document.querySelector("#hybrid_followers3"), d_1options5);
    d_1C_7.render()
    });

    


    /*
        ==============================
        |    @Render Charts Script    |
        ==============================
    */


    /*
        ======================================
            Visitor Statistics | Script
        ======================================
    */

    // Total Visits
  

    // Paid Visits
    

    /*
        ===================================
            Unique Visitors | Script
        ===================================
    */

    

    /*
        ==============================
            Statistics | Script
        ==============================
    */


    // Followers

    

    // Referral

    

    // Engagement Rate

  



  /*
      =============================================
          Perfect Scrollbar | Notifications
      =============================================
  */
  const ps = new PerfectScrollbar(document.querySelector('.mt-container'));


} catch(e) {
  // statements
  console.log(e);
}
