var MODULE_CONFIG = {
    easyPieChart: [public_folder_path + "/backEnd/libs/jquery/jquery.easy-pie-chart/dist/jquery.easypiechart.fill.js"],
    sparkline: [public_folder_path + "/backEnd/libs/jquery/jquery.sparkline/dist/jquery.sparkline.retina.js"],
    plot: [
        public_folder_path + "/backEnd/libs/jquery/flot/jquery.flot.js",
        public_folder_path + "/backEnd/libs/jquery/flot/jquery.flot.resize.js",
        public_folder_path + "/backEnd/libs/jquery/flot/jquery.flot.pie.js",
        public_folder_path + "/backEnd/libs/jquery/flot.tooltip/js/jquery.flot.tooltip.min.js",
        public_folder_path + "/backEnd/libs/jquery/flot-spline/js/jquery.flot.spline.min.js",
        public_folder_path + "/backEnd/libs/jquery/flot.orderbars/js/jquery.flot.orderBars.js",
    ],
    vectorMap: [
        public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap-1.2.2.min.js",
        public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap.css",
        public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap-world-mill-en.js",
        public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap-us-aea-en.js",
    ],
    dataTable: [
        public_folder_path + "/backEnd/libs/jquery/datatables/media/js/jquery.dataTables.min.js",
        public_folder_path + "/backEnd/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js",
        public_folder_path + "/backEnd/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css",
    ],
    footable: [public_folder_path + "/backEnd/libs/jquery/footable/dist/footable.all.min.js",
     public_folder_path + "/backEnd/libs/jquery/footable/css/footable.core.css"],
    screenfull: [public_folder_path + "/backEnd/libs/jquery/screenfull/dist/screenfull.min.js"],
    sortable: [public_folder_path + "/backEnd/libs/jquery/html.sortable/dist/html.sortable.min.js"],
    nestable: [public_folder_path + "/backEnd/libs/jquery/nestable/jquery.nestable.css",
     public_folder_path + "/backEnd/libs/jquery/nestable/jquery.nestable.js"],
    summernote: [public_folder_path + "/backEnd/libs/jquery/summernote/dist/summernote.css",
     public_folder_path + "/backEnd/libs/jquery/summernote/dist/summernote.js"],
    parsley: [public_folder_path + "/backEnd/libs/jquery/parsleyjs/dist/parsley.css", 
    public_folder_path + "/backEnd/libs/jquery/parsleyjs/dist/parsley.min.js"],
    select2: [
        public_folder_path + "/backEnd/libs/jquery/select2/dist/css/select2.min.css",
        public_folder_path + "/backEnd/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css",
        public_folder_path + "/backEnd/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.4.css",
        public_folder_path + "/backEnd/libs/jquery/select2/dist/js/select2.min.js",
    ],
    datetimepicker: [
        public_folder_path + "/backEnd/libs/jquery/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css",
        public_folder_path + "/backEnd/libs/jquery/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.dark.css",
        public_folder_path + "/backEnd/libs/js/moment/moment.js",
        public_folder_path + "/backEnd/libs/jquery/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js",
    ],
    chart: [public_folder_path + "/backEnd/libs/js/echarts/build/dist/echarts-all.js",
     public_folder_path + "/backEnd/libs/js/echarts/build/dist/theme.js", 
     public_folder_path + "/backEnd/libs/js/echarts/build/dist/jquery.echarts.js"],
    bootstrapWizard: [public_folder_path + "/backEnd/libs/jquery/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"],
    fullCalendar: [
        public_folder_path + "/backEnd/libs/jquery/moment/moment.js",
        public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/fullcalendar.min.js",
        public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/lang/" + public_lang + ".js",
        public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/fullcalendar.css",
        public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/fullcalendar.theme.css",
        public_folder_path + "/backEnd/scripts/plugins/calendar.js",
    ],
    dropzone: [public_folder_path + "/backEnd/libs/js/dropzone/dist/min/dropzone.min.js",
     public_folder_path + "/backEnd/libs/js/dropzone/dist/min/dropzone.min.css"],
};


!(function (a, b) {
    "function" == typeof define && define.amd ? define([], b) : "object" == typeof exports ? (module.exports = b()) : (a.palette = b());
})(this, function () {
    function a(a) {
        var b, c;
        b = [];
        for (var c in a) a.hasOwnProperty(c) && b.push(c);
        return b;
    }

    function b(a, b) {
        return Math.floor(Math.random() * (b - a + 1)) + a;
    }

    return {
        palette: {
            red: {
                50: "#FFEBEE",
                100: "#FFCDD2",
                200: "#EF9A9A",
                300: "#E57373",
                400: "#EF5350",
                500: "#F44336",
                600: "#E53935",
                700: "#D32F2F",
                800: "#C62828",
                900: "#B71C1C",
                A100: "#FF8A80",
                A200: "#FF5252",
                A400: "#FF1744",
                A700: "#D50000",
            },
            pink: {
                50: "#FCE4EC",
                100: "#F8BBD0",
                200: "#F48FB1",
                300: "#F06292",
                400: "#EC407A",
                500: "#E91E63",
                600: "#D81B60",
                700: "#C2185B",
                800: "#AD1457",
                900: "#880E4F",
                A100: "#FF80AB",
                A200: "#FF4081",
                A400: "#F50057",
                A700: "#C51162",
            },
            purple: {
                50: "#F3E5F5",
                100: "#E1BEE7",
                200: "#CE93D8",
                300: "#BA68C8",
                400: "#AB47BC",
                500: "#9C27B0",
                600: "#8E24AA",
                700: "#7B1FA2",
                800: "#6A1B9A",
                900: "#4A148C",
                A100: "#EA80FC",
                A200: "#E040FB",
                A400: "#D500F9",
                A700: "#AA00FF",
            },
            "deep-purple": {
                50: "#EDE7F6",
                100: "#D1C4E9",
                200: "#B39DDB",
                300: "#9575CD",
                400: "#7E57C2",
                500: "#673AB7",
                600: "#5E35B1",
                700: "#512DA8",
                800: "#4527A0",
                900: "#311B92",
                A100: "#B388FF",
                A200: "#7C4DFF",
                A400: "#651FFF",
                A700: "#6200EA",
            },
            indigo: {
                50: "#E8EAF6",
                100: "#C5CAE9",
                200: "#9FA8DA",
                300: "#7986CB",
                400: "#5C6BC0",
                500: "#3F51B5",
                600: "#3949AB",
                700: "#303F9F",
                800: "#283593",
                900: "#1A237E",
                A100: "#8C9EFF",
                A200: "#536DFE",
                A400: "#3D5AFE",
                A700: "#304FFE",
            },
            blue: {
                50: "#E3F2FD",
                100: "#BBDEFB",
                200: "#90CAF9",
                300: "#64B5F6",
                400: "#42A5F5",
                500: "#2196F3",
                600: "#1E88E5",
                700: "#1976D2",
                800: "#1565C0",
                900: "#0D47A1",
                A100: "#82B1FF",
                A200: "#448AFF",
                A400: "#2979FF",
                A700: "#2962FF",
            },
            "light-blue": {
                50: "#E1F5FE",
                100: "#B3E5FC",
                200: "#81D4FA",
                300: "#4FC3F7",
                400: "#29B6F6",
                500: "#03A9F4",
                600: "#039BE5",
                700: "#0288D1",
                800: "#0277BD",
                900: "#01579B",
                A100: "#80D8FF",
                A200: "#40C4FF",
                A400: "#00B0FF",
                A700: "#0091EA",
            },
            cyan: {
                50: "#E0F7FA",
                100: "#B2EBF2",
                200: "#80DEEA",
                300: "#4DD0E1",
                400: "#26C6DA",
                500: "#00BCD4",
                600: "#00ACC1",
                700: "#0097A7",
                800: "#00838F",
                900: "#006064",
                A100: "#84FFFF",
                A200: "#18FFFF",
                A400: "#00E5FF",
                A700: "#00B8D4",
            },
            teal: {
                50: "#E0F2F1",
                100: "#B2DFDB",
                200: "#80CBC4",
                300: "#4DB6AC",
                400: "#26A69A",
                500: "#009688",
                600: "#00897B",
                700: "#00796B",
                800: "#00695C",
                900: "#004D40",
                A100: "#A7FFEB",
                A200: "#64FFDA",
                A400: "#1DE9B6",
                A700: "#00BFA5",
            },
            green: {
                50: "#E8F5E9",
                100: "#C8E6C9",
                200: "#A5D6A7",
                300: "#81C784",
                400: "#66BB6A",
                500: "#4CAF50",
                600: "#43A047",
                700: "#388E3C",
                800: "#2E7D32",
                900: "#1B5E20",
                A100: "#B9F6CA",
                A200: "#69F0AE",
                A400: "#00E676",
                A700: "#00C853",
            },
            "light-green": {
                50: "#F1F8E9",
                100: "#DCEDC8",
                200: "#C5E1A5",
                300: "#AED581",
                400: "#9CCC65",
                500: "#8BC34A",
                600: "#7CB342",
                700: "#689F38",
                800: "#558B2F",
                900: "#33691E",
                A100: "#CCFF90",
                A200: "#B2FF59",
                A400: "#76FF03",
                A700: "#64DD17",
            },
            lime: {
                50: "#F9FBE7",
                100: "#F0F4C3",
                200: "#E6EE9C",
                300: "#DCE775",
                400: "#D4E157",
                500: "#CDDC39",
                600: "#C0CA33",
                700: "#AFB42B",
                800: "#9E9D24",
                900: "#827717",
                A100: "#F4FF81",
                A200: "#EEFF41",
                A400: "#C6FF00",
                A700: "#AEEA00",
            },
            yellow: {
                50: "#FFFDE7",
                100: "#FFF9C4",
                200: "#FFF59D",
                300: "#FFF176",
                400: "#FFEE58",
                500: "#FFEB3B",
                600: "#FDD835",
                700: "#FBC02D",
                800: "#F9A825",
                900: "#F57F17",
                A100: "#FFFF8D",
                A200: "#FFFF00",
                A400: "#FFEA00",
                A700: "#FFD600",
            },
            amber: {
                50: "#FFF8E1",
                100: "#FFECB3",
                200: "#FFE082",
                300: "#FFD54F",
                400: "#FFCA28",
                500: "#FFC107",
                600: "#FFB300",
                700: "#FFA000",
                800: "#FF8F00",
                900: "#FF6F00",
                A100: "#FFE57F",
                A200: "#FFD740",
                A400: "#FFC400",
                A700: "#FFAB00",
            },
            orange: {
                50: "#FFF3E0",
                100: "#FFE0B2",
                200: "#FFCC80",
                300: "#FFB74D",
                400: "#FFA726",
                500: "#FF9800",
                600: "#FB8C00",
                700: "#F57C00",
                800: "#EF6C00",
                900: "#E65100",
                A100: "#FFD180",
                A200: "#FFAB40",
                A400: "#FF9100",
                A700: "#FF6D00",
            },
            "deep-orange": {
                50: "#FBE9E7",
                100: "#FFCCBC",
                200: "#FFAB91",
                300: "#FF8A65",
                400: "#FF7043",
                500: "#FF5722",
                600: "#F4511E",
                700: "#E64A19",
                800: "#D84315",
                900: "#BF360C",
                A100: "#FF9E80",
                A200: "#FF6E40",
                A400: "#FF3D00",
                A700: "#DD2C00",
            },
            brown: {
                50: "#EFEBE9",
                100: "#D7CCC8",
                200: "#BCAAA4",
                300: "#A1887F",
                400: "#8D6E63",
                500: "#795548",
                600: "#6D4C41",
                700: "#5D4037",
                800: "#4E342E",
                900: "#3E2723",
            },
            grey: {
                50: "#FAFAFA",
                100: "#F5F5F5",
                200: "#EEEEEE",
                300: "#E0E0E0",
                400: "#BDBDBD",
                500: "#9E9E9E",
                600: "#757575",
                700: "#616161",
                800: "#424242",
                900: "#212121",
            },
            "blue-grey": {
                50: "#ECEFF1",
                100: "#CFD8DC",
                200: "#B0BEC5",
                300: "#90A4AE",
                400: "#78909C",
                500: "#607D8B",
                600: "#546E7A",
                700: "#455A64",
                800: "#37474F",
                900: "#263238",
            },
            black: {
                500: "#000000",
                Text: "rgba(0,0,0,0.87)",
                "Secondary Text": "rgba(0,0,0,0.54)",
                Icons: "rgba(0,0,0,0.54)",
                Disabled: "rgba(0,0,0,0.26)",
                "Hint Text": "rgba(0,0,0,0.26)",
                Dividers: "rgba(0,0,0,0.12)",
            },
            white: {
                500: "#ffffff",
                Text: "#ffffff",
                "Secondary Text": "rgba(255,255,255,0.7)",
                Icons: "#ffffff",
                Disabled: "rgba(255,255,255,0.3)",
                "Hint Text": "rgba(255,255,255,0.3)",
                Dividers: "rgba(255,255,255,0.12)",
            },
        },
        get: function (a, b) {
            return this.palette[a][b || "500"];
        },
        find: function (a) {
            var a,
                b = a.split("-"),
                c = 500;
            return 3 == b.length && ((a = b[0] + "-" + b[1]), (c = b[2])), 2 == b.length && (b[1].indexOf("0") > 0 ? ((a = b[0]), (c = b[1])) : (a = b[0] + "-" + b[1])), this.get(a, c);
        },
        random: function (c) {
            var d, e, f;
            return (d = a(this.palette)), (e = d[b(0, d.length - 1)]), null == c && ((f = a(e)), (c = f[b(0, f.length - 1)])), this.get(e, c);
        },
    };
});
var uiLoad = uiLoad || {};
!(function (a, b, c) {
    "use strict";
    var d = [],
        e = !1,
        f = a.Deferred();
    c.load = function (b) {
        return (
            (b = a.isArray(b) ? b : b.split(/\s+/)),
            e || (e = f.promise()),
            a.each(b, function (a, b) {
                e = e.then(function () {
                    return b.indexOf(".css") >= 0 ? h(b) : g(b);
                });
            }),
            f.resolve(),
            e
        );
    };
    var g = function (c) {
            if (d[c]) return d[c].promise();
            var e = a.Deferred(),
                f = b.createElement("script");
            return (
                (f.src = c),
                (f.onload = function (a) {
                    e.resolve(a);
                }),
                (f.onerror = function (a) {
                    e.reject(a);
                }),
                b.body.appendChild(f),
                (d[c] = e),
                e.promise()
            );
        },
        h = function (c) {
            if (d[c]) return d[c].promise();
            var e = a.Deferred(),
                f = b.createElement("link");
            return (
                (f.rel = "stylesheet"),
                (f.type = "text/css"),
                (f.href = c),
                (f.onload = function (a) {
                    e.resolve(a);
                }),
                (f.onerror = function (a) {
                    e.reject(a);
                }),
                b.head.appendChild(f),
                (d[c] = e),
                e.promise()
            );
        };
})(jQuery, document, uiLoad),
    (function ($, MODULE_CONFIG) {
        "use strict";
        $.fn.uiJp = function () {
            var lists = this;
            return (
                lists.each(function () {
                    var self = $(this),
                        options = eval("[" + self.attr("ui-options") + "]");
                    $.isPlainObject(options[0]) && (options[0] = $.extend({}, options[0])),
                        uiLoad.load(MODULE_CONFIG[self.attr("ui-jp")]).then(function () {
                            self[self.attr("ui-jp")].apply(self, options);
                        });
                }),
                lists
            );
        };
    })(jQuery, MODULE_CONFIG),
    (function ($) {
        "use strict";
        var promise = !1,
            deferred = $.Deferred();
        (_.templateSettings.interpolate = /{{([\s\S]+?)}}/g),
            ($.fn.uiInclude = function () {
                function compile(node) {
                    node.find("[ui-include]").each(function () {
                        var that = $(this),
                            url = that.attr("ui-include");
                        promise = promise.then(function () {
                            var request = $.ajax({
                                    url: eval(url),
                                    method: "GET",
                                    dataType: "text",
                                }),
                                chained = request.then(function (a) {
                                    var b = _.template(a.toString()),
                                        c = b({ app: app }),
                                        d = that.replaceWithPush(c);
                                    d.find("[ui-jp]").uiJp(), d.find("[ui-include]").length && compile(d);
                                });
                            return chained;
                        });
                    });
                }

                return promise || (promise = deferred.promise()), compile(this), deferred.resolve(), promise;
            }),
            ($.fn.replaceWithPush = function (a) {
                var b = $(a);
                return this.replaceWith(b), b;
            });
    })(jQuery),
    (function (a) {
        "use strict";
        (navigator.userAgent.match(/MSIE/i) || navigator.userAgent.match(/Trident.*rv:11\./)) && a("body").addClass("ie");
        var b = window.navigator.userAgent || window.navigator.vendor || window.opera;
        /iPhone|iPod|iPad|Silk|Android|BlackBerry|Opera Mini|IEMobile/.test(b) && a("body").addClass("smart");
    })(jQuery),
    (function (a) {
        "use strict";
        a("input, textarea").each(function () {
            a(this).val() ? a(this).addClass("has-value") : a(this).removeClass("has-value");
        }),
            a(document).on("blur", "input, textarea", function (b) {
                a(this).val() ? a(this).addClass("has-value") : a(this).removeClass("has-value");
            });
    })(jQuery),
    (function (a) {
        "use strict";
        a(document).on("click", "[ui-nav] a", function (b) {
            var c,
                d,
                e = a(b.target);
            e.is("a") || (e = e.closest("a")), (d = e.parent()), (c = d.siblings(".active")), d.toggleClass("active"), c.removeClass("active");
        });
    })(jQuery),
    (function (a) {
        "use strict";
        uiLoad.load(public_folder_path + "/backEnd/libs/jquery/screenfull/dist/screenfull.min.js"),
            a(document).on("click", "[ui-fullscreen]", function (a) {
                a.preventDefault(), screenfull.enabled && screenfull.toggle();
            });
    })(jQuery),
    (function (a) {
        "use strict";
        a.extend(jQuery.easing, {
            def: "easeOutQuad",
            easeInOutExpo: function (a, b, c, d, e) {
                return 0 == b ? c : b == e ? c + d : (b /= e / 2) < 1 ? (d / 2) * Math.pow(2, 10 * (b - 1)) + c : (d / 2) * (-Math.pow(2, -10 * --b) + 2) + c;
            },
        }),
            a(document).on("click", "[ui-scroll-to]", function (b) {
                b.preventDefault();
                var c = a("#" + a(this).attr("ui-scroll-to"));
                a("html,body").animate({ scrollTop: c.offset().top }, 600, "easeInOutExpo");
            });
    })(jQuery),
    (function (a) {
        "use strict";
        a(document).on("click", "[ui-toggle-class]", function (b) {
            b.preventDefault();
            var c = a(b.target);
            c.attr("ui-toggle-class") || (c = c.closest("[ui-toggle-class]"));
            var d = c.attr("ui-toggle-class").split(","),
                e = (c.attr("ui-target") && c.attr("ui-target").split(",")) || (c.attr("target") && c.attr("target").split(",")) || Array(c),
                f = 0;
            a.each(d, function (b, c) {
                var g = a(e[e.length && f]),
                    h = g.attr("ui-class"),
                    i = d[b];
                h != i && g.removeClass(g.attr("ui-class")), g.toggleClass(d[b]), g.attr("ui-class", i), f++;
            }),
                c.toggleClass("active");
        });
    })(jQuery),
    (function ($) {
        "use strict";
        function setTheme() {
            $("body").removeClass($("body").attr("ui-class")).addClass(app.setting.bg).attr("ui-class", app.setting.bg),
                app.setting.folded ? $("#aside").addClass("folded") : $("#aside").removeClass("folded"),
                app.setting.boxed ? $("body").addClass("container") : $("body").removeClass("container"),
                $('.switcher input[value="' + app.setting.themeID + '"]').prop("checked", !0),
                $('.switcher input[value="' + app.setting.bg + '"]').prop("checked", !0),
                $('[data-target="folded"] input').prop("checked", app.setting.folded),
                $('[data-target="boxed"] input').prop("checked", app.setting.boxed);
        }

        function setColor() {
            app.setting.color = {
                primary: getColor(app.setting.theme.primary),
                accent: getColor(app.setting.theme.accent),
                warn: getColor(app.setting.theme.warn),
            };
        }

        function getColor(a) {
            return app.color[a] ? app.color[a] : palette.find(a);
        }

        function init() {
            $("[ui-jp]").uiJp(), $("body").uiInclude();
        }

        window.app = {
            name: "Flatkit",
            version: "1.1.0",
            color: {
                primary: "#0cc2aa",
                accent: "#a88add",
                warn: "#fcc100",
                info: "#6887ff",
                success: "#6cc788",
                warning: "#f77a99",
                danger: "#f44455",
                white: "#ffffff",
                light: "#f1f2f3",
                dark: "#2e3e4e",
                black: "#2a2b3c",
            },
            setting: {
                theme: { primary: "primary", accent: "accent", warn: "warn" },
                color: { primary: "#0cc2aa", accent: "#a88add", warn: "#fcc100" },
                folded: !1,
                boxed: !1,
                container: !1,
                themeID: 1,
                bg: "",
            },
        };
        var setting = "jqStorage-" + app.name + "-Setting",
            storage = $.localStorage;
        storage.isEmpty(setting) ? storage.set(setting, app.setting) : (app.setting = storage.get(setting));
        for (var v = window.location.search.substring(1).split("&"), i = 0; i < v.length; i++) {
            var n = v[i].split("=");
            (app.setting[n[0]] = "true" == n[1] || "false" == n[1] ? "true" == n[1] : n[1]), storage.set(setting, app.setting);
        }
        $(document).on("click.setting", ".switcher input", function (e) {
            var $this = $(this),
                $target;
            ($target = $this.parent().attr("data-target") ? $this.parent().attr("data-target") : $this.parent().parent().attr("data-target")),
                (app.setting[$target] = $this.is(":checkbox") ? $this.prop("checked") : $(this).val()),
                "color" == $(this).attr("name") && (app.setting.theme = eval("[" + $(this).parent().attr("data-value") + "]")[0]) && setColor(),
                storage.set(setting, app.setting),
                setTheme(app.setting);
        }),
            $(document).on("pjaxStart", function () {
                $("#aside").modal("hide"), $("body").removeClass("modal-open").find(".modal-backdrop").remove(), $(".navbar-toggleable-sm").collapse("hide");
            }),
            init(),
            setTheme();
    })(jQuery),
    (function (a) {
        function b(b, d, e) {
            var f = this;
            return this.on("click.pjax", b, function (b) {
                var g = a.extend({}, p(d, e));
                g.container || (g.container = a(this).attr("data-pjax") || f), c(b, g);
            });
        }

        function c(b, c, d) {
            d = p(c, d);
            var f = b.currentTarget;
            if ("A" !== f.tagName.toUpperCase()) throw "$.fn.pjax or $.pjax.click requires an anchor element";
            if (!(b.which > 1 || b.metaKey || b.ctrlKey || b.shiftKey || b.altKey || location.protocol !== f.protocol || location.hostname !== f.hostname || (f.href.indexOf("#") > -1 && o(f) == o(location)) || b.isDefaultPrevented())) {
                var g = {
                        url: f.href,
                        container: a(f).attr("data-pjax"),
                        target: f,
                    },
                    h = a.extend({}, g, d),
                    i = a.Event("pjax:click");
                a(f).trigger(i, [h]), i.isDefaultPrevented() || (e(h), b.preventDefault(), a(f).trigger("pjax:clicked", [h]));
            }
        }

        function d(b, c, d) {
            d = p(c, d);
            var f = b.currentTarget;
            if ("FORM" !== f.tagName.toUpperCase()) throw "$.pjax.submit requires a form element";
            var g = { type: f.method.toUpperCase(), url: f.action, container: a(f).attr("data-pjax"), target: f };
            if ("GET" !== g.type && void 0 !== window.FormData) (g.data = new FormData(f)), (g.processData = !1), (g.contentType = !1);
            else {
                if (a(f).find(":file").length) return;
                g.data = a(f).serializeArray();
            }
            e(a.extend({}, g, d)), b.preventDefault();
        }

        function e(b) {
            function c(b, c, e) {
                e || (e = {}), (e.relatedTarget = d);
                var f = a.Event(b, e);
                return h.trigger(f, c), !f.isDefaultPrevented();
            }

            (b = a.extend(!0, {}, a.ajaxSettings, e.defaults, b)), a.isFunction(b.url) && (b.url = b.url());
            var d = b.target,
                f = n(b.url).hash,
                h = (b.context = q(b.container));
            b.data || (b.data = {}),
                a.isArray(b.data)
                    ? b.data.push({
                          name: "_pjax",
                          value: h.selector,
                      })
                    : (b.data._pjax = h.selector);
            var i;
            (b.beforeSend = function (a, d) {
                if (("GET" !== d.type && (d.timeout = 0), a.setRequestHeader("X-PJAX", "true"), a.setRequestHeader("X-PJAX-Container", h.selector), !c("pjax:beforeSend", [a, d]))) return !1;
                d.timeout > 0 &&
                    ((i = setTimeout(function () {
                        c("pjax:timeout", [a, b]) && a.abort("timeout");
                    }, d.timeout)),
                    (d.timeout = 0));
                var e = n(d.url);
                f && (e.hash = f), (b.requestUrl = m(e));
            }),
                (b.complete = function (a, d) {
                    i && clearTimeout(i), c("pjax:complete", [a, d, b]), c("pjax:end", [a, b]);
                }),
                (b.error = function (a, d, e) {
                    var f = t("", a, b),
                        h = c("pjax:error", [a, d, e, b]);
                    "GET" == b.type && "abort" !== d && h && g(f.url);
                }),
                (b.success = function (d, i, j) {
                    var l = e.state,
                        m = "function" == typeof a.pjax.defaults.version ? a.pjax.defaults.version() : a.pjax.defaults.version,
                        o = j.getResponseHeader("X-PJAX-Version"),
                        p = t(d, j, b),
                        q = n(p.url);
                    if ((f && ((q.hash = f), (p.url = q.href)), m && o && m !== o)) return void g(p.url);
                    if (!p.contents) return void g(p.url);
                    (e.state = {
                        id: b.id || k(),
                        url: p.url,
                        title: p.title,
                        container: h.selector,
                        fragment: b.fragment,
                        timeout: b.timeout,
                    }),
                        (b.push || b.replace) && window.history.replaceState(e.state, p.title, p.url);
                    try {
                        document.activeElement.blur();
                    } catch (r) {}
                    p.title && (document.title = p.title),
                        c("pjax:beforeReplace", [p.contents, b], {
                            state: e.state,
                            previousState: l,
                        }),
                        h.html(p.contents);
                    var s = h.find("input[autofocus], textarea[autofocus]").last()[0];
                    s && document.activeElement !== s && s.focus(), u(p.scripts);
                    var v = b.scrollTo;
                    if (f) {
                        var w = decodeURIComponent(f.slice(1)),
                            x = document.getElementById(w) || document.getElementsByName(w)[0];
                        x && (v = a(x).offset().top);
                    }
                    "number" == typeof v && a(window).scrollTop(v), c("pjax:success", [d, i, j, b]);
                }),
                e.state ||
                    ((e.state = {
                        id: k(),
                        url: window.location.href,
                        title: document.title,
                        container: h.selector,
                        fragment: b.fragment,
                        timeout: b.timeout,
                    }),
                    window.history.replaceState(e.state, document.title)),
                j(e.xhr),
                (e.options = b);
            var o = (e.xhr = a.ajax(b));
            return o.readyState > 0 && (b.push && !b.replace && (v(e.state.id, l(h)), window.history.pushState(null, "", b.requestUrl)), c("pjax:start", [o, b]), c("pjax:send", [o, b])), e.xhr;
        }

        function f(b, c) {
            var d = { url: window.location.href, push: !1, replace: !0, scrollTo: !1 };
            return e(a.extend(d, p(b, c)));
        }

        function g(a) {
            window.history.replaceState(null, "", e.state.url), window.location.replace(a);
        }

        function h(b) {
            B || j(e.xhr);
            var c,
                d = e.state,
                f = b.state;
            if (f && f.container) {
                if (B && C == f.url) return;
                if (d) {
                    if (d.id === f.id) return;
                    c = d.id < f.id ? "forward" : "back";
                }
                var h = E[f.id] || [],
                    i = a(h[0] || f.container),
                    k = h[1];
                if (i.length) {
                    d && w(c, d.id, l(i));
                    var m = a.Event("pjax:popstate", { state: f, direction: c });
                    i.trigger(m);
                    var n = {
                        id: f.id,
                        url: f.url,
                        container: i,
                        push: !1,
                        fragment: f.fragment,
                        timeout: f.timeout,
                        scrollTo: !1,
                    };
                    if (k) {
                        i.trigger("pjax:start", [null, n]), (e.state = f), f.title && (document.title = f.title);
                        var o = a.Event("pjax:beforeReplace", { state: f, previousState: d });
                        i.trigger(o, [k, n]), i.html(k), i.trigger("pjax:end", [null, n]);
                    } else e(n);
                    i[0].offsetHeight;
                } else g(location.href);
            }
            B = !1;
        }

        function i(b) {
            var c = a.isFunction(b.url) ? b.url() : b.url,
                d = b.type ? b.type.toUpperCase() : "GET",
                e = a("<form>", {
                    method: "GET" === d ? "GET" : "POST",
                    action: c,
                    style: "display:none",
                });
            "GET" !== d &&
                "POST" !== d &&
                e.append(
                    a("<input>", {
                        type: "hidden",
                        name: "_method",
                        value: d.toLowerCase(),
                    })
                );
            var f = b.data;
            if ("string" == typeof f)
                a.each(f.split("&"), function (b, c) {
                    var d = c.split("=");
                    e.append(a("<input>", { type: "hidden", name: d[0], value: d[1] }));
                });
            else if (a.isArray(f))
                a.each(f, function (b, c) {
                    e.append(a("<input>", { type: "hidden", name: c.name, value: c.value }));
                });
            else if ("object" == typeof f) {
                var g;
                for (g in f) e.append(a("<input>", { type: "hidden", name: g, value: f[g] }));
            }
            a(document.body).append(e), e.submit();
        }

        function j(b) {
            b && b.readyState < 4 && ((b.onreadystatechange = a.noop), b.abort());
        }

        function k() {
            return new Date().getTime();
        }

        function l(a) {
            var b = a.clone();
            return (
                b.find("script").each(function () {
                    this.src || jQuery._data(this, "globalEval", !1);
                }),
                [a.selector, b.contents()]
            );
        }

        function m(a) {
            return (a.search = a.search.replace(/([?&])(_pjax|_)=[^&]*/g, "")), a.href.replace(/\?($|#)/, "$1");
        }

        function n(a) {
            var b = document.createElement("a");
            return (b.href = a), b;
        }

        function o(a) {
            return a.href.replace(/#.*/, "");
        }

        function p(b, c) {
            return b && c ? (c.container = b) : (c = a.isPlainObject(b) ? b : { container: b }), c.container && (c.container = q(c.container)), c;
        }

        function q(b) {
            if (((b = a(b)), b.length)) {
                if ("" !== b.selector && b.context === document) return b;
                if (b.attr("id")) return a("#" + b.attr("id"));
                throw "cant get selector for pjax container!";
            }
            throw "no pjax container for " + b.selector;
        }

        function r(a, b) {
            return a.filter(b).add(a.find(b));
        }

        function s(b) {
            return a.parseHTML(b, document, !0);
        }

        function t(b, c, d) {
            var e = {},
                f = /<html/i.test(b),
                g = c.getResponseHeader("X-PJAX-URL");
            if (((e.url = g ? m(n(g)) : d.requestUrl), f))
                var h = a(s(b.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0])),
                    i = a(s(b.match(/<body[^>]*>([\s\S.]*)<\/body>/i)[0]));
            else var h = (i = a(s(b)));
            if (0 === i.length) return e;
            if (((e.title = r(h, "title").last().text()), d.fragment)) {
                if ("body" === d.fragment) var j = i;
                else var j = r(i, d.fragment).first();
                j.length && ((e.contents = "body" === d.fragment ? j : j.contents()), e.title || (e.title = j.attr("title") || j.data("title")));
            } else f || (e.contents = i);
            return (
                e.contents &&
                    ((e.contents = e.contents.not(function () {
                        return a(this).is("title");
                    })),
                    e.contents.find("title").remove(),
                    (e.scripts = r(e.contents, "script[src]").remove()),
                    (e.contents = e.contents.not(e.scripts))),
                e.title && (e.title = a.trim(e.title)),
                e
            );
        }

        function u(b) {
            if (b) {
                var c = a("script[src]");
                b.each(function () {
                    var b = this.src,
                        d = c.filter(function () {
                            return this.src === b;
                        });
                    if (!d.length) {
                        var e = document.createElement("script"),
                            f = a(this).attr("type");
                        f && (e.type = f), (e.src = a(this).attr("src")), document.head.appendChild(e);
                    }
                });
            }
        }

        function v(a, b) {
            (E[a] = b), G.push(a), x(F, 0), x(G, e.defaults.maxCacheLength);
        }

        function w(a, b, c) {
            var d, f;
            (E[b] = c), "forward" === a ? ((d = G), (f = F)) : ((d = F), (f = G)), d.push(b), (b = f.pop()) && delete E[b], x(d, e.defaults.maxCacheLength);
        }

        function x(a, b) {
            for (; a.length > b; ) delete E[a.shift()];
        }

        function y() {
            return a("meta")
                .filter(function () {
                    var b = a(this).attr("http-equiv");
                    return b && "X-PJAX-VERSION" === b.toUpperCase();
                })
                .attr("content");
        }

        function z() {
            (a.fn.pjax = b),
                (a.pjax = e),
                (a.pjax.enable = a.noop),
                (a.pjax.disable = A),
                (a.pjax.click = c),
                (a.pjax.submit = d),
                (a.pjax.reload = f),
                (a.pjax.defaults = {
                    timeout: 650,
                    push: !0,
                    replace: !1,
                    type: "GET",
                    dataType: "html",
                    scrollTo: 0,
                    maxCacheLength: 20,
                    version: y,
                }),
                a(window).on("popstate.pjax", h);
        }

        function A() {
            (a.fn.pjax = function () {
                return this;
            }),
                (a.pjax = i),
                (a.pjax.enable = z),
                (a.pjax.disable = a.noop),
                (a.pjax.click = a.noop),
                (a.pjax.submit = a.noop),
                (a.pjax.reload = function () {
                    window.location.reload();
                }),
                a(window).off("popstate.pjax", h);
        }

        var B = !0,
            C = window.location.href,
            D = window.history.state;
        D && D.container && (e.state = D), "state" in window.history && (B = !1);
        var E = {},
            F = [],
            G = [];
        a.inArray("state", a.event.props) < 0 && a.event.props.push("state"),
            (a.support.pjax = window.history && window.history.pushState && window.history.replaceState && !navigator.userAgent.match(/((iPod|iPhone|iPad).+\bOS\s+[1-4]\D|WebApps\/.+CFNetwork)/)),
            a.support.pjax ? z() : A();
    })(jQuery),
    (function (a) {
        "use strict";
        if (a.support.pjax) {
            a.pjax.defaults.maxCacheLength = 0;
            var b = a("#view");
            a(document).on("click", "a[data-pjax], [data-pjax] a, #aside .nav a", function (c) {
                0 == a("#view").length ||
                    a(this).hasClass("no-ajax") ||
                    a.pjax.click(c, {
                        container: b,
                        timeout: 6e3,
                        fragment: "#view",
                    });
            }),
                a(document).on("pjax:start", function () {
                    a(document).trigger("pjaxStart");
                }),
                a(document).on("pjax:end", function (b) {
                    a(b.target).find("[ui-jp]").uiJp(), a(b.target).uiInclude(), a(document).trigger("pjaxEnd");
                });
        }
    })(jQuery);
