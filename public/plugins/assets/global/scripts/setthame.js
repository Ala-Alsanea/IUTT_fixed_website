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
    })(jQuery)


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
    })(jQuery)