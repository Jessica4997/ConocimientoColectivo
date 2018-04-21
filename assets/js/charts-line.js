/*$(document).ready(function () {
    var a = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Product 1",
            data: c(7, 0, 100),
            backgroundColor: "rgba(244, 67, 55, .6)"
        }, {
            label: "Product 2",
            data: c(7, 0, 100),
            backgroundColor: "rgba(76, 175, 81, .6)"
        }, {
            label: "Product 3",
            data: c(7, 0, 100),
            backgroundColor: "rgba(255, 152, 0, .6)"
        }]
    },
        o = {
            responsive: !0,
            scales: {
                xAxes: [{
                    gridLines: {
                        display: !1
                    }
                }],
                yAxes: [{
                    stacked: !0
                }]
            }
        },
        r = document.getElementById("myChart"),
        e = (new Chart(r, {
            type: "line",
            data: a,
            options: o
        }), {
                labels: c(200, 0, 10),
                datasets: [{
                    label: "System Load",
                    data: c(200, 100, 150),
                    pointBorderColor: "rgba(0,0,0,0)",
                    pointBackgroundColor: "rgba(0,0,0,0)",
                    backgroundColor: "rgba(3, 169, 244, .6) "
                }]
            }),
        t = document.getElementById("myChart2"),
        d = new Chart(t, {
            type: "line",
            data: e,
            options: {
                responsive: !0,
                scales: {
                    xAxes: [{
                        display: !1,
                        gridLines: {
                            display: !1
                        }
                    }],
                    yAxes: [{
                        stacked: !0,
                        ticks: {
                            beginAtZero: !0,
                            max: 200
                        }
                    }]
                }
            }
        }),
        l = {
            labels: c(50, 0, 10),
            datasets: [{
                label: "System Load",
                data: c(50, 100, 150),
                pointBorderColor: "rgba(0,0,0,0)",
                pointBackgroundColor: "rgba(0,0,0,0)",
                borderColor: "rgba(255,255,255, .5) ",
                borderWidth: 1,
                backgroundColor: "rgba(255,255,255, .2) "
            }]
        },
        n = document.getElementById("myChart3"),
        s = new Chart(n, {
            type: "line",
            data: l,
            options: {
                responsive: !0,
                legend: {
                    display: !1,
                    labels: {
                        fontColor: "#fff",
                        fontFamily: "Roboto"
                    }
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        gridLines: {
                            display: !1
                        }
                    }],
                    yAxes: [{
                        stacked: !0,
                        display: !1,
                        ticks: {
                            beginAtZero: !0,
                            max: 200,
                            display: !1
                        }
                    }]
                }
            }
        }),
        i = {
            labels: c(20, 0, 10),
            datasets: [{
                label: "System Load",
                data: c(20, 0, 20),
                pointBorderColor: "rgba(0,0,0,0)",
                pointBackgroundColor: "rgba(0,0,0,0)",
                borderColor: "rgba(255,255,255, .5) ",
                borderWidth: 1,
                backgroundColor: "rgba(255,255,255, .2) "
            }]
        },
        b = document.getElementById("myChart4"),
        p = new Chart(b, {
            type: "line",
            data: i,
            options: {
                responsive: !0,
                legend: {
                    display: !1,
                    labels: {
                        fontColor: "#fff",
                        fontFamily: "Roboto"
                    }
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        gridLines: {
                            display: !1
                        }
                    }],
                    yAxes: [{
                        stacked: !0,
                        display: !1,
                        ticks: {
                            beginAtZero: !0,
                            display: !1
                        }
                    }]
                }
            }
        }),
        u = document.getElementById("myChart5");
    new Chart(u, {
        type: "line",
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Line One",
                fill: !1,
                lineTension: .1,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                borderJoinStyle: "miter",
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: [65, 59, 80, 81, 56, 55, 40],
                spanGaps: !1
            }, {
                label: "Line Two",
                fill: !1,
                lineTension: .1,
                backgroundColor: "rgba(154,0,0,0.4)",
                borderColor: "rgba(154,0,0,1)",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                borderJoinStyle: "miter",
                pointBorderColor: "rgba(154,0,0,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(154,0,0,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: [65, 59, 80, 81, 56, 55, 40],
                spanGaps: !1
            }]
        },
        options: o
    });

    function g(a, o) {
        a.data.labels.splice(0, 1), a.data.datasets[0].data.splice(0, 1), a.data.labels.push(y(0, 10)), a.data.datasets[0].data.push(o), a.update(0)
    }

    function y(a, o) {
        return Math.floor(Math.random() * (o - a + 1)) + a
    }

    function c(a, o, r) {
        result = [], a = void 0 !== a ? a : 5, o = void 0 !== o ? o : 0, r = void 0 !== r ? r : 10;
        for (var e = 0; e < a; e++) result.push(y(o, r));
        return result
    }
    setInterval(function () {
        g(d, y(100, 150))
    }, 50), setInterval(function () {
        g(s, y(100, 150))
    }, 500), setInterval(function () {
        var a, o;
        a = p, o = y(0, 20), a.data.labels.splice(0, 1), a.data.datasets[0].data.splice(0, 1), a.data.labels.push(y(0, 10)), a.data.datasets[0].data.push(o), a.update()
    }, 1e3)
});