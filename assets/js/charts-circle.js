/*$(document).ready(function () {
    Circles.create({
        id: "circles-1",
        radius: 60,
        value: 43,
        maxValue: 100,
        width: 5,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-2",
        radius: 60,
        value: 60,
        maxValue: 100,
        width: 5,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-3",
        radius: 60,
        value: 80,
        maxValue: 100,
        width: 5,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-4",
        radius: 60,
        value: 100,
        maxValue: 100,
        width: 5,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-5",
        radius: 60,
        value: 43,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-6",
        radius: 60,
        value: 60,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-7",
        radius: 60,
        value: 80,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-8",
        radius: 60,
        value: 100,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#f1f1f1", "#000"],
        duration: 600,
        wrpClass: "circles-wrp",
        textClass: "circles-text",
        valueStrokeClass: "circles-valueStroke circle-primary",
        maxValueStrokeClass: "circles-maxValueStroke",
        styleWrapper: !0,
        styleText: !0
    }), Circles.create({
        id: "circles-9",
        radius: 60,
        value: 95,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#eee", "#54c8eb"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    }), Circles.create({
        id: "circles-10",
        radius: 60,
        value: 43,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#eee", "#ac60d0"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    }), Circles.create({
        id: "circles-11",
        radius: 60,
        value: 60,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#eee", "#f44336"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    }), Circles.create({
        id: "circles-12",
        radius: 60,
        value: 80,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#eee", "#02c66c"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    }), Circles.create({
        id: "circles-13",
        radius: 60,
        value: 95,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#eee", "#f44336"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    }), Circles.create({
        id: "circles-14",
        radius: 60,
        value: 43,
        maxValue: 100,
        width: 10,
        text: function (e) {
            return e + "%"
        },
        colors: ["#333", "#ff0084"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    }), Circles.create({
        id: "circles-15",
        radius: 60,
        value: 60,
        maxValue: 100,
        width: 20,
        text: function (e) {
            return e + "%"
        },
        colors: ["#eee", "#f44336"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    }), Circles.create({
        id: "circles-16",
        radius: 60,
        value: 80,
        maxValue: 100,
        width: 15,
        text: function (e) {
            return e + "%"
        },
        colors: ["#ddd", "#00b48a"],
        duration: 1e3,
        wrpClass: "circles-wrp",
        textClass: "circles-text"
    })
});