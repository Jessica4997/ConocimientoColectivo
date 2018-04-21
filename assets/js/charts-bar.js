/*$(document).ready(function () {
    var e = document.getElementById("myChart"),
        r = (new Chart(e, {
            type: "bar",
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: "# of Votes",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: ["rgba(255, 99, 132, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 206, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(255, 159, 64, 0.2)"],
                    borderColor: ["rgba(255,99,132,1)", "rgba(54, 162, 235, 1)", "rgba(255, 206, 86, 1)", "rgba(75, 192, 192, 1)", "rgba(153, 102, 255, 1)", "rgba(255, 159, 64, 1)"],
                    borderWidth: 1
                }]
            },
            options: {
                deferred: {
                    yOffset: "80%",
                    delay: 100
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        }), document.getElementById("myChart2")),
        a = new Chart(r, {
            type: "bar",
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: "# of Votes",
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: ["rgba(255, 99, 132, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 206, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(255, 159, 64, 0.2)"],
                    borderColor: ["rgba(255,99,132,1)", "rgba(54, 162, 235, 1)", "rgba(255, 206, 86, 1)", "rgba(75, 192, 192, 1)", "rgba(153, 102, 255, 1)", "rgba(255, 159, 64, 1)"],
                    borderWidth: 1
                }]
            },
            options: {
                deferred: {
                    yOffset: "80%",
                    delay: 100
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        }),
        t = document.getElementById("myChart3"),
        o = new Chart(t, {
            type: "bar",
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: "Label",
                    data: [12, 19, 3, 5, 8, 3],
                    backgroundColor: "rgba(255,255,255,.3)",
                    borderColor: "rgba(255,255,255,0.5)",
                    borderWidth: 1
                }]
            },
            options: {
                deferred: {
                    yOffset: "80%",
                    delay: 100
                },
                legend: {
                    labels: {
                        fontColor: "#fff",
                        fontFamily: "Roboto"
                    }
                },
                scales: {
                    xAxes: [{
                        display: !1
                    }],
                    yAxes: [{
                        display: !1,
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        }),
        l = document.getElementById("myChart4"),
        d = new Chart(l, {
            type: "bar",
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: "Label",
                    data: [12, 19, 3, 5, 8, 3],
                    backgroundColor: "rgba(255,255,255,.3)",
                    borderColor: "rgba(0,0,0,0.2)",
                    borderWidth: 2
                }]
            },
            options: {
                deferred: {
                    yOffset: "80%",
                    delay: 100
                },
                legend: {
                    labels: {
                        fontColor: "#fff",
                        fontFamily: "Roboto"
                    }
                },
                scales: {
                    xAxes: [{
                        display: !1
                    }],
                    yAxes: [{
                        display: !1,
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        }),
        n = document.getElementById("myChart5"),
        b = new Chart(n, {
            type: "bar",
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange", "Green", "Purple", "Orange", "Blue", "Red", "Blue", "Yellow", "Green", "Purple", "Orange", "Green", "Purple", "Orange", "Blue"],
                datasets: [{
                    label: "Label",
                    data: [12, 19, 3, 5, 8, 3, 6, 15, 13, 16, 12, 19, 3, 5, 8, 3, 6, 15, 13, 16],
                    backgroundColor: "rgba(255,255,255,.1)",
                    borderColor: "rgba(255,255,255,1)",
                    borderWidth: 0
                }]
            },
            options: {
                deferred: {
                    yOffset: "80%",
                    delay: 100
                },
                tooltips: {
                    enabled: !1
                },
                legend: {
                    display: !1
                },
                scales: {
                    xAxes: [{
                        display: !1
                    }],
                    yAxes: [{
                        display: !1,
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        }),
        s = document.getElementById("myChart6"),
        i = new Chart(s, {
            type: "bar",
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange", "Green", "Purple", "Orange", "Blue", "Red", "Blue", "Yellow", "Green", "Purple", "Orange", "Green", "Purple", "Orange", "Blue"],
                datasets: [{
                    label: "Label",
                    data: [12, 19, 3, 5, 8, 3, 6, 15, 13, 16, 12, 19, 3, 5, 8, 3, 6, 15, 13, 16],
                    backgroundColor: "rgba(255,255,255,.1)",
                    borderColor: "rgba(255,255,255,1)",
                    borderWidth: 0
                }]
            },
            options: {
                deferred: {
                    yOffset: "80%",
                    delay: 100
                },
                tooltips: {
                    enabled: !1
                },
                legend: {
                    display: !1
                },
                scales: {
                    xAxes: [{
                        display: !1
                    }],
                    yAxes: [{
                        display: !1,
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        });
    setInterval(function () {
        i.data.datasets[0].data.shift(), i.update(0), i.data.datasets[0].data.push(Math.floor(21 * Math.random()) + 10), i.update()
    }, 1200);
    var g = document.getElementById("myChart7"),
        f = new Chart(g, {
            type: "bar",
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: "Sales",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    backgroundColor: "rgba(255,255,255,.3)",
                    borderColor: "rgba(255,255,255,0.5)",
                    borderWidth: 1
                }]
            },
            options: {
                defaultFontColor: "#fff",
                deferred: {
                    yOffset: "80%",
                    delay: 100
                },
                title: {
                    display: !0,
                    text: "Sales Report",
                    fontColor: "#fff",
                    fontSize: 20,
                    fontFamily: "Roboto",
                    fontStyle: "normal",
                    padding: 20
                },
                legend: {
                    display: !1,
                    labels: {
                        fontColor: "#fff",
                        fontFamily: "Roboto"
                    }
                },
                scales: {
                    xAxes: [{
                        display: !0,
                        gridLines: {
                            color: "rgba(255,255,255,0.1)",
                            fontColor: "#fff",
                            drawOnChartArea: !1,
                            zeroLineColor: "rgba(255,255,255,.1)",
                            zeroLineWidth: 0
                        },
                        ticks: {
                            fontColor: "#fff"
                        }
                    }],
                    yAxes: [{
                        display: !0,
                        color: "#fff",
                        gridLines: {
                            color: "rgba(255,255,255,0.1)",
                            fontColor: "#fff",
                            drawOnChartArea: !1,
                            zeroLineColor: "rgba(255,255,255,.1)",
                            zeroLineWidth: 0
                        },
                        ticks: {
                            beginAtZero: !0,
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    setInterval(function () {
        p(f, u(12, 10, 200))
    }, 2e3);
    var y = document.getElementById("myChart8");
    new Chart(y, {
        type: "bar",
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Product 1",
                data: u(12, 1, 2e3),
                backgroundColor: "rgba(1, 188, 212, 1)",
                borderColor: "rgba(1, 188, 212, 1)",
                borderWidth: 1
            }, {
                label: "Product 2",
                data: u(12, 1, 2e3),
                backgroundColor: "rgba(255,152,0,1)",
                borderColor: "rgba(255,152,0,1)",
                borderWidth: 1
            }, {
                label: "Product 3",
                data: u(12, 1, 2e3),
                backgroundColor: "rgba(156, 39, 176, 1)",
                borderColor: "rgba(156, 39, 176, 1)",
                borderWidth: 1
            }]
        },
        options: {
            defaultFontColor: "#fff",
            deferred: {
                yOffset: "80%",
                delay: 100
            },
            title: {
                display: !0,
                text: "Sales Report",
                fontSize: 20,
                fontFamily: "Roboto",
                fontStyle: "normal",
                padding: 20
            },
            legend: {
                labels: {
                    fontFamily: "Roboto"
                }
            },
            scales: {
                xAxes: [{
                    display: !0,
                    gridLines: {
                        color: "rgba(255,255,255,0.1)",
                        drawOnChartArea: !1,
                        zeroLineColor: "rgba(255,255,255,.1)",
                        zeroLineWidth: 0
                    },
                    ticks: {}
                }],
                yAxes: [{
                    display: !0,
                    gridLines: {
                        zeroLineWidth: 1
                    },
                    ticks: {
                        beginAtZero: !0
                    }
                }]
            }
        }
    });

    function u(e, r, a) {
        result = [], e = void 0 !== e ? e : 5, r = void 0 !== r ? r : 0, a = void 0 !== a ? a : 10;
        for (var t = 0; t < e; t++) result.push((o = r, l = a, Math.floor(Math.random() * (l - o + 1)) + o));
        var o, l;
        return result
    }

    function p(e, r) {
        e.data.datasets[0].data = r, e.update()
    }
    setInterval(function () {
        p(a, u(6, 0, 20))
    }, 2e3), setInterval(function () {
        p(o, u(6, 0, 20))
    }, 2e3), setInterval(function () {
        p(d, u(6, 0, 20))
    }, 2e3), setInterval(function () {
        p(b, u(20, 0, 100))
    }, 100)
});