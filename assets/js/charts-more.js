$(document).ready(function () {
    var r = {
            labels: ["Red", "Blue", "Yellow"],
            datasets: [{
                data: [300, 50, 100],
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
                hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
            }]
        },
        o = {},
        a = document.getElementById("myChart1"),
        e = (new Chart(a, {
            type: "pie",
            data: r,
            options: o
        }), document.getElementById("myChart2")),
        t = (new Chart(e, {
            type: "doughnut",
            data: r,
            options: o
        }), {
            labels: ["Red", "Blue", "Yellow"],
            datasets: [{
                data: function (r, o, a) {
                    result = [], r = void 0 !== r ? r : 5, o = void 0 !== o ? o : 0, a = void 0 !== a ? a : 10;
                    for (var e = 0; e < r; e++) result.push(b(o, a));
                    return result
                }(5, 0, 100),
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#9c27b0", "#4caf51"],
                hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#9c27b0", "#4caf51"]
            }]
        }),
        n = {
            legend: {
                display: !1
            }
        },
        d = document.getElementById("myChart3"),
        l = (new Chart(d, {
            type: "pie",
            data: t,
            options: n
        }), document.getElementById("myChart4")),
        y = (new Chart(l, {
            type: "doughnut",
            data: t,
            options: n
        }), document.getElementById("myChart5")),
        C = (new Chart(y, {
            type: "polarArea",
            data: {
                datasets: [{
                    data: [11, 16, 7, 3, 14],
                    backgroundColor: ["#FF6384", "#4BC0C0", "#FFCE56", "#9c27b0", "#36A2EB"],
                    label: "My dataset"
                }],
                labels: ["Red", "Green", "Yellow", "Grey", "Blue"]
            },
            options: {}
        }), {
            datasets: [{
                label: "First Dataset",
                data: [{
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }, {
                    x: b(0, 20),
                    y: b(0, 40),
                    r: b(5, 20)
                }],
                backgroundColor: "#FF6384",
                hoverBackgroundColor: "#FF6384"
            }]
        }),
        g = document.getElementById("myChart6"),
        u = (new Chart(g, {
            type: "bubble",
            data: C,
            options: {}
        }), {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            datasets: [{
                label: "User 1",
                backgroundColor: "rgba(79,181,198,0.2)",
                borderColor: "rgba(79,181,198,1)",
                pointBackgroundColor: "rgba(79,181,198,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(79,181,198,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                label: "User 2",
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }, {
                label: "User 3",
                backgroundColor: "rgba(100,150,0,0.2)",
                borderColor: "rgba(100,150,0,1)",
                pointBackgroundColor: "rgba(100,150,0,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(100,150,132,1)",
                data: [b(0, 100), b(0, 100), b(0, 100), b(0, 100), b(0, 100), b(0, 100), b(0, 100)]
            }]
        }),
        i = document.getElementById("myChart7");
    new Chart(i, {
        type: "radar",
        data: u,
        options: {}
    });

    function b(r, o) {
        return Math.floor(Math.random() * (o - r + 1)) + r
    }
});