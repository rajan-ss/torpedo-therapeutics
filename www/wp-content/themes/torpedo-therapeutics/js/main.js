/**
 * File main.js.
 *
 * Theme main script.
 *
 * Contains all theme custom features.
 */
var ss;
(function ($) {
  ss = {
    init: function () {
      this.img();
      this.nav();
      this.form();
      this.misc();
      this.slider();
      this.gallery();
    },
    ie: function () {
      try {
        if (
          /MSIE (\d+\.\d+);/.test(navigator.userAgent) ||
          !!navigator.userAgent.match(/Trident.*rv\:11\./)
        ) {
          $("body").addClass("ie-user");
          return true;
        }
      } catch (err) {
        console.log(err);
      }
      return false;
    },
    img: function (context) {
      if (!context) context = $("body");
      context.find('.bg-cover,[data-fix="image"]').each(function () {
        var wrap = $(this),
          image = wrap.find(">img");
        if (image.attr("src")) {
          if (wrap.data("fix") != "image") {
            image.hide();
            wrap.css({
              "background-image": "url('" + image.attr("src") + "')",
            });
          } else {
            wrap
              .find(".svg.img-fluid")
              .css({ "background-image": "url('" + image.attr("src") + "')" });
          }
        }
        if (ss.ie()) {
          wrap.find(".svg").removeClass("img-fluid");
        }
      });
    },
    nav: function () {
      //sticky header
      function stickyHeader() {
        var height = jQuery(window).scrollTop();
        var header = jQuery(".site-header");

        if (height > 60) {
          header.addClass("sticky");
        } else {
          header.removeClass("sticky");
        }
      }

      jQuery(window).scroll(stickyHeader);
      stickyHeader();

      //dropdown toggle
      $(".navbar-nav .menu-item-has-children .caret").on("click", function () {
        $(this).next(".dropdown-menu").slideToggle();
      });
    },
    form: function () {
      try {
        $(".input-text.qty").each(function () {
          var elm = $(this);
          $(
            '<span class="qty-des"><i class="icon-angle-left"></i></span>'
          ).insertBefore($(this));
          $(
            '<span class="qty-ins"><i class="icon-angle-right"></i></span>'
          ).insertAfter($(this));
          elm.prev(".qty-des").on("click", function () {
            var val = parseInt(elm.val());
            if (val > 1) {
              elm.val(val - 1);
            }
          });
          elm.next(".qty-ins").on("click", function () {
            var val = parseInt(elm.val());
            elm.val(val + 1);
          });
        });
      } catch (err) {
        console.log(err);
      }
    },
    misc: function () {
      try {
        // $('[data-fix="height"]').matchHeight();
        /* smooth scroll*/
        $('.js-has-smooth a[href*="#"]:not([href="#"]), a.js-has-smooth[href*="#"]:not([href="#"])').click(function () {
          if (
            location.pathname.replace(/^\//, "") ==
              this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
          ) {
            var target = $(this.hash);
            target = target.length
              ? target
              : jQuery("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
              $("html, body").animate(
                {
                  scrollTop: target.offset().top - 90
                },
                1000
              );
              return false;
            }
          }
        });
      } catch (err) {
        console.log(err);
      }
    },
    slider: function () {},
    gallery: function () {
      try {
        // $('.fancybox').fancybox({
        // 	openEffect:'none',
        // 	closeEffect:'none'
        // });
      } catch (err) {
        console.log(err);
      }
      try {
        var fix = function () {
          var t = $(".woocommerce-product-gallery__trigger"),
            h = t.next(".flex-viewport").outerHeight() - 16;
          t.height(h);
        };
        $(window).bind("load resize", fix);
        $(".woocommerce-product-gallery .flex-control-nav li").on(
          "click",
          function () {
            setTimeout(fix, 500);
          }
        );
      } catch (err) {
        console.log(err);
      }
    },
  };
  $(function () {
    ss.init();
  });
})(jQuery);
