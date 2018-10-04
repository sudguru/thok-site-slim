!function(e) {
  "use strict";
  var o = function() {
      var e = window
        , o = "inner";
      return "innerWidth"in window || (o = "client",
      e = document.documentElement || document.body),
      {
          width: e[o + "Width"],
          height: e[o + "Height"]
      }
  }
    , a = function() {
      var a = "ontouchstart"in window;
      if (a && e(".carousel-inner").length > 0 && e(".carousel-inner").swipe({
          swipeLeft: function(o, a, t, n, s) {
              e(this).parent().carousel("prev")
          },
          swipeRight: function(o, a, t, n, s) {
              e(this).parent().carousel("next")
          },
          threshold: 0
      }),
      e(".navbar").length) {
          var t = e(window)
            , n = e("body")
            , s = e(".navbar").offset().top
            , i = 0
            , r = function() {
              if (o().width > 992) {
                  var a = e(window)
                    , t = e(".navbar")
                    , r = t.outerHeight();
                  if (t.hasClass("fixed-top")) {
                      var l = "navbar-fixed-top";
                      t.hasClass("shrinkable") && !n.hasClass("one-page-layout") && (l += " navbar-shrink");
                      var c = s;
                      a.scrollTop() + i >= c ? t.hasClass("navbar-fixed-top") || (n.hasClass("page-menu-transparent") ? (t.closest(".noo-header").css({
                          height: "1px"
                      }),
                      t.closest(".noo-header").css({
                          position: "relative"
                      })) : e(".navbar-wrapper").css({
                          "min-height": r + "px"
                      }),
                      t.addClass(l),
                      t.css("top", i)) : (n.hasClass("page-menu-transparent") ? (t.closest(".noo-header").css({
                          height: ""
                      }),
                      t.closest(".noo-header").css({
                          position: ""
                      })) : e(".navbar-wrapper").css({
                          "min-height": ""
                      }),
                      t.removeClass(l))
                  }
              }
          };
          t.bind("scroll", r).resize(r),
          n.hasClass("one-page-layout") && (e('.navbar-scrollspy > .nav > li > a[href^="#"]').on("click", function(o) {
              o.preventDefault();
              var a = e(this).attr("href").replace(/.*(?=#[^\s]+$)/, "");
              if (a && e(a).length) {
                  var t = Math.max(0, e(a).offset().top);
                  t = Math.max(0, t - (i + e(".navbar").outerHeight()) + 5),
                  e("html, body").animate({
                      scrollTop: t
                  }, {
                      duration: 800,
                      easing: "easeInOutCubic",
                      complete: window.reflow
                  })
              }
          }),
          n.scrollspy({
              target: ".navbar-scrollspy",
              offset: i + e(".navbar").outerHeight()
          }),
          e(window).resize(function() {
              n.scrollspy("refresh")
          }))
      }
      e(".cat-mega-menu").each(function() {
          var o = e(this)
            , a = o.find(".cat-mega-filters a");
          a.on("mouseenter", function() {
              o.find(".cat-mega-filters li.selected").removeClass("selected"),
              e(this).closest("li").addClass("selected");
              var a = e(this).data("cat-id");
              o.find(".cat-mega-content").hide(),
              o.find('[data-control-id="cat-mega-' + a + '"]').show()
          })
      }),
      e(".navbar-toggle").on("click", function(o) {
          o.stopPropagation(),
          o.preventDefault(),
          e("body").hasClass("offcanvas-open") ? e("body").removeClass("offcanvas-open").addClass("offcanvas-close") : e("body").removeClass("offcanvas-close").addClass("offcanvas-open")
      }),
      e(document).on("click", ".offcanvas-close-btn", function() {
          e("body").removeClass("offcanvas-open").addClass("offcanvas-close")
      }),
      e("body").on("mousedown", e.proxy(function(o) {
          var a = e(o.target);
          e(".offcanvas").length && e("body").hasClass("offcanvas-open") && (a.is(".offcanvas") || 0 !== a.parents(".offcanvas").length || e("body").removeClass("offcanvas-open"))
      }, this)),
      e(".noo-slider-revolution-container .noo-slider-scroll-bottom").on("click", function(o) {
          o.preventDefault();
          var a = e(".noo-slider-revolution-container").outerHeight();
          e("html, body").animate({
              scrollTop: a
          }, 900, "easeInOutExpo")
      }),
      e("body").on("mouseleave ", ".masonry-style-elevated .masonry-portfolio.no-gap .masonry-item", function() {
          e(this).closest(".masonry-container").find(".masonry-overlay").hide(),
          e(this).removeClass("masonry-item-hover")
      }),
      e(".masonry").each(function() {
          var o = e(this)
            , a = e(this).find(".masonry-container")
            , t = e(this).find(".masonry-filters a")
            , n = {
              gutter: 0
          };
          a.isotope({
              itemSelector: ".masonry-item",
              transitionDuration: "0.8s",
              masonry: n
          }),
          imagesLoaded(o, function() {
              a.isotope("layout")
          }),
          e(window).resize(function() {
              a.isotope("layout")
          }),
          t.on("click", function(e) {
              e.stopPropagation(),
              e.preventDefault();
              var t = jQuery(this);
              if (t.hasClass("selected"))
                  return !1;
              o.find(".masonry-result h3").text(t.text());
              var n = t.closest("ul");
              n.find(".selected").removeClass("selected"),
              t.addClass("selected");
              var s = {
                  layoutMode: "masonry",
                  transitionDuration: "0.8s",
                  masonry: {
                      gutter: 0
                  }
              }
                , i = n.attr("data-option-key")
                , r = t.attr("data-option-value");
              r = "false" === r ? !1 : r,
              s[i] = r,
              a.isotope(s)
          })
      }),
      e(window).scroll(function() {
          e(this).scrollTop() > 500 ? e(".go-to-top").addClass("on") : e(".go-to-top").removeClass("on")
      }),
      e("body").on("click", ".go-to-top", function() {
          return e("html, body").animate({
              scrollTop: 0
          }, 800),
          !1
      }),
      e("body").on("click", ".search-button", function() {
          return e(".searchbar").hasClass("hide") && (e(".searchbar").removeClass("hide").addClass("show"),
          e(".searchbar #s").focus()),
          !1
      }),
      e("body").on("mousedown", e.proxy(function(o) {
          var a = e(o.target);
          a.is(".searchbar") || 0 !== a.parents(".searchbar").length || e(".searchbar").removeClass("show").addClass("hide")
      }, this)),
      e(document).on("mouseenter", ".cart-item", function() {
          clearTimeout(e(this).data("timeout")),
          e(".noo-minicart").addClass("show")
      }),
      e(document).on("mouseleave", ".noo-menu-item-cart", function() {
          var o = setTimeout(function() {
              e(".noo-minicart").removeClass("show")
          }, 400);
          e(this).data("timeout", o)
      }),
      e(".content-featured .sliders").length > 0 && e(".content-featured .sliders").each(function() {
          var o = {
              infinite: !0,
              circular: !0,
              auto: !1,
              responsive: !0,
              items: {
                  visible: {
                      min: 1,
                      max: 1
                  }
              },
              prev: {
                  button: e(this).siblings(".slider-control.prev-btn")
              },
              next: {
                  button: e(this).siblings(".slider-control.next-btn")
              },
              pagination: {
                  container: e(this).siblings(".slider-indicators")
              }
          };
          e(this).carouFredSel(o)
      }),
      e(".full-screen").length > 0 && e(".full-screen").fitVids()
  };
  e(document).ready(function() {
      a()
  }),
  e(window).load(function() {
      e("body").hasClass("enable-preload") && (e("#loader-wrapper #loader").length ? e("#loader-wrapper").fadeOut({
          duration: 200,
          complete: function() {
              e(this).remove(),
              e(".site").animate({
                  opacity: 1
              }, {
                  easing: "swing",
                  duration: 350
              })
          }
      }) : e(".site").animate({
          opacity: 1
      }, {
          easing: "swing",
          duration: 350
      }))
  }),
  e(document).bind("noo-layout-changed", function() {
      a()
  })
}(jQuery);
