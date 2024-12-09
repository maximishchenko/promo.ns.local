"use strict";
$(function () {
  $(function () {
    new Swiper(".offers-slider", { slidesPerView: "auto", loop: !0, spaceBetween: 50, navigation: { nextEl: ".offers--next", prevEl: ".offers--prev" }, breakpoints: {} }),
      new Swiper(".room-slider", { slidesPerView: 2, spaceBetween: 16, navigation: { nextEl: ".room--next", prevEl: ".room--prev" }, breakpoints: { 550: { slidesPerView: 4 }, 425: { slidesPerView: 3 } } }),
      new Swiper(".flats-slider", { slidesPerView: 1, spaceBetween: 24, navigation: { nextEl: ".flats--next", prevEl: ".flats--prev" }, breakpoints: { 1080: { slidesPerView: 4 }, 820: { slidesPerView: 3 }, 550: { slidesPerView: 2 } } }),
      new Swiper(".banner-slider", { slidesPerView: 1, navigation: { nextEl: ".banner--next", prevEl: ".banner--prev" }, breakpoints: {} }),
      new Swiper(".gallery-slider", { slidesPerView: 1, navigation: { nextEl: ".banner--next", prevEl: ".banner--prev" }, breakpoints: {} });
  }),
    $(function () {
      $(".header__burger").on("click", function () {
        $(window).width() >= 1080 ? $(".header__menu").toggleClass("header__menu--active") : $(".mobile-menu").toggleClass("mobile-menu--active"), $(this).toggleClass("header__burger--active");
      });
    }),
    $(function () {
      function e() {
        return $(t).removeClass("is-active"), $(".ordering__delivery-item").length && $(".ordering__delivery-item--active").removeClass("ordering__delivery-item--active"), $(".accordion__description").css("height", 0), !0;
      }
      var t = document.getElementsByClassName("accordion");
      $(".accordion__header").on("click", function () {
        var t = this.parentNode,
          n = this.nextElementSibling;
        $(t).is(".is-active")
          ? e()
          : (e(),
            t.classList.toggle("is-active"),
            (n.style.height = n.scrollHeight + "px"),
            $(".ordering__delivery-item").length && ($(".ordering__delivery-item--active").removeClass("ordering__delivery-item--active"), $(this).parents(".ordering__delivery-item").addClass("ordering__delivery-item--active")));
      });
    }),
    $(function () {
      $(".room__tab").on("click", function () {
        var e = $(this).attr("data-id"),
          t = $(this).parents(".container").find(".room__top"),
          n = t.find("[data-id=" + e + "]");
        $(this).parents(".container").find(".room__tab--active").removeClass("room__tab--active"), $(this).addClass("room__tab--active"), t.find(".room__top-item").css("display", "none"), n.fadeIn("slow");
      });
    }),
    $(function () {
      $(".room-search__select-top").on("click", function () {
        $(this).parents(".room-search__select").toggleClass("room-search__select--active");
      }),
        $(".room-search .room-search__select-inside-link").on("click", function () {
          var e = $(this).text(),
            t = $(this).attr("data-id");
          $(this).parents(".room-search__select").find(".room-search__select-top span").text(e),
            $(this).parents(".room-search__select").find(".room-search__select-top input").val(t),
            $(this).parents(".room-search__select").removeClass("room-search__select--active");
        });
    }),
    $(function () {
      $(".js-open-feedback, .free").on("click", function (e) {
          e.preventDefault();
        $(".modal--feedback").addClass("modal--active"), $("body").addClass("overflow");
      }),
        $(".js-open-feedback2, .free").on("click", function () {
          $(".modal--feedback2").addClass("modal--active"), $("body").addClass("overflow");
        }),
        $(".js-open-feedback3, .free").on("click", function () {
          $(".modal--feedback3").addClass("modal--active"), $("body").addClass("overflow");
        }),
        $(".modal__close").on("click", function () {
          $(".modal--active").removeClass("modal--active"), $("body").removeClass("overflow");
        });
    }),
    $(function () {
      $(".mortgage__item .page-btn").on("click", function () {
        var e = $(this).parents(".mortgage__item").find(".mortgage__item-text"),
          t = $(this).parents(".mortgage__item").find(".mortgage__item-text").prop("scrollHeight") + "px";
        if (($(this).parents(".mortgage__item").toggleClass("mortgage__item--active"), "РџРѕРґСЂРѕР±РЅС‹Рµ СѓСЃР»РѕРІРёСЏ" == $(this).text())) {
          $(this).text("РЎРєСЂС‹С‚СЊ"), e.css("max-height", t);
          var n = $(".mortgage").prop("scrollHeight") + "px";
          $(".mortgage").css("height", n);
        } else $(this).text("РџРѕРґСЂРѕР±РЅС‹Рµ СѓСЃР»РѕРІРёСЏ"), $(window).width() >= 980 ? (e.css("max-height", "170px"), $(".mortgage").css("height", "auto")) : e.css("max-height", "205px");
      });
    }),
    $(".liter__image svg path").on("mouseenter", function () {
      var e = $(this).attr("data-id");
      $(".liter .tooltip").text(e);
    }),
    $(function () {
      $(window).scroll(function () {
        $(window).scrollTop() > 0 ? $(".header").addClass("header--hide") : $(".header").removeClass("header--hide");
      });
    }),
    $(function () {
      $(".parking-scheme__tab").on("click", function () {
        var e = $(this).attr("data-id"),
          t = $(this).parents(".container").find(".parking-scheme__content"),
          n = t.find("[data-id=" + e + "]");
        $(this).parents(".container").find(".parking-scheme__tab").removeClass("parking-scheme__tab--active"), $(this).addClass("parking-scheme__tab--active"), t.find(".parking-scheme__icon").css("display", "none"), n.fadeIn("slow");
      }),
        $(".parking").on("click", function () {
          var e = $(this).attr("data-litter");
          void 0 != e && ($(".choose-apartments--parking").hide(), $('.parking-scheme[data-litter="'.concat(e, '"')).show());
        }),
        $(".parking-scheme__back").on("click", function () {
          $(".parking-scheme").hide(), $(".choose-apartments--parking").show();
        });
    });
}),
  $(document).ready(function () {
    var e = new Swiper(".information-slider", {
      slidesPerView: 1,
      navigation: { nextEl: ".information__navigation-btn--next", prevEl: ".information__navigation-btn--prev" },
      pagination: { el: ".information__navigation-pagination--active", type: "fraction" },
      breakpoints: {},
    });
    $(".information .information__tab").on("click", function () {
      var t = $(this).attr("data-id"),
        n = $(this).parents(".container").find(".information__right"),
        i = n.find("[data-id=" + t + "]");
      if (
        ($(this).parents(".container").find(".information__tab--active").removeClass("information__tab--active"),
        $(this).addClass("information__tab--active"),
        n.find(".information__right-item").css("display", "none"),
        i.fadeIn("slow"),
        $(".information__navigation-pagination--active").removeClass("information__navigation-pagination--active"),
        i.find(".information__navigation-pagination").addClass("information__navigation-pagination--active"),
        $(".information-slider").length)
      )
        for (var a = 0; a < e.length; a++) e[a].update();
    });
    var mainOffersSlider = new Swiper(".main-offers-slider", {
      slidesPerView: 1,
      spaceBetween: 24,
      navigation: { nextEl: ".main-offers--next", prevEl: ".main-offers--prev" },
      breakpoints: { 1080: { slidesPerView: 2 }, 820: { slidesPerView: 2 }, 550: { slidesPerView: 2 } },
    });
    var mainGallerySlider = new Swiper(".main-gallery-slider", {
      autoplay: true,
      slidesPerView: 1,
      spaceBetween: 24,
      navigation: { nextEl: ".main-gallery--next", prevEl: ".main-gallery--prev" },
      breakpoints: { 1080: { slidesPerView: 3 }, 820: { slidesPerView: 3 }, 550: { slidesPerView: 2 } },
    });
    var t = new Swiper(".main-rooms-slider", {
      slidesPerView: 1,
      spaceBetween: 24,
      navigation: { nextEl: ".main-rooms--next", prevEl: ".main-rooms--prev" },
      breakpoints: { 1080: { slidesPerView: 4 }, 820: { slidesPerView: 3 }, 550: { slidesPerView: 2 } },
    });
    $(".main-rooms .information__tab").on("click", function () {
      var e = $(this).attr("data-id"),
        n = $(this).parents(".container").find(".main-rooms__wrap"),
        i = n.find("[data-id=" + e + "]");
      $(this).parents(".container").find(".information__tab--active").removeClass("information__tab--active"),
        $(this).addClass("information__tab--active"),
        n.find(".main-rooms__slider").css("display", "none"),
        i.fadeIn("slow"),
        t.length &&
          t.forEach(function (e) {
            e.update();
          });
    }),
      $(".liter__wrapper--nav .information__tab").on("click", function () {
        var e = $(this).attr("data-id"),
          t = $(this).parents(".container").find(".liter__wrapper--tabs"),
          n = t.find("[data-id=" + e + "]");
        $(this).parents(".container").find(".information__tab--active").removeClass("information__tab--active"), $(this).addClass("information__tab--active"), t.find(".liter__image").css("display", "none"), n.fadeIn("slow");
      });
    var n = new Swiper(".construction-progress-slider", {
      slidesPerView: 1,
      spaceBetween: 32,
      navigation: { nextEl: ".construction-progress--next", prevEl: ".construction-progress--prev" },
      breakpoints: { 1140: { slidesPerView: 3 }, 550: { slidesPerView: 2 } },
    });
    if (
      ($(".construction-progress__tab").on("click", function () {
        var e = $(this).attr("data-id"),
          t = $(this).parents(".container").find(".construction-progress__bottom"),
          i = t.find("[data-id=" + e + "]");
        if (
          ($(this).parents(".container").find(".circle-btn--active").removeClass("circle-btn--active"),
          $(this).addClass("circle-btn--active"),
          t.find(".construction-progress__bottom-item").css("display", "none"),
          i.fadeIn("slow"),
          $(".construction-progress-slider").length)
        )
          for (var a = 0; a < n.length; a++) n[a].update();
      }),
      $(window).width() < 768 && ($(".footer__links-col").addClass("accordion"),
      $(".footer__links-title").addClass("accordion__header"),
      $(".footer__links-items").addClass("accordion__description")),
      // $('[name="f_phone"]').inputmask("+7 (999) 999-99-99"),
      $(".plug").length && ($(".header").addClass("header--plug"),
      $(".header__logo").attr("href", "#")),
      $(".choose-apartments__wrap").length && $(window).width() <= 550)
    ) {
      var i = $(".choose-apartments__wrap"),
        a = i.width();
      (a /= 2), (i[0].scrollLeft = i[0].scrollLeft + a);
    }
    
    let rangeParams = document.querySelector('.room-search__title');
    if (rangeParams) {
      var minArea = rangeParams.getAttribute('data-min-area');
      var maxArea = rangeParams.getAttribute('data-max-area');
      var fromSliderValue = document.getElementById('minArea');
      var toSliderValue = document.getElementById('maxArea');
      var fromValue = (fromSliderValue.value != '') ? fromSliderValue.value : minArea;
      var toValue = (toSliderValue.value != '') ? toSliderValue.value : maxArea;
    }
    if (
      (
      
      $(".js-range-slider").length && $(".js-range-slider").ionRangeSlider({ 
        min: minArea, 
        max: maxArea, 
        from: fromValue, 
        to: toValue, 
        type: "double", 
        step: 5 ,
        onStart: function (data) {
            // fired then range slider is ready
        },
        onChange: function (data) {
            // fired on every range slider update
        },
        onFinish: function (data) {
            // fired on pointer release
            fromSliderValue.value = Number(data.from);
            toSliderValue.value = Number(data.to);
            // console.log(data.from);
            // console.log(data.to);
        },
        onUpdate: function (data) {
            // fired on changing slider with Update method
        }
      }),
      $(".modal.hidden").removeClass("hidden"),
      $(".mortgage__item").length)
    )
      for (var r = $(".mortgage__item"), o = 0; o < r.length; o++) {
        var s = $(".mortgage__item").eq(o).find(".mortgage__item-text").prop("scrollHeight");
        $(window).width() >= 768 ? s < 175 && $(".mortgage__item").eq(o).find(".page-btn").hide() : s < 205 && $(".mortgage__item").eq(o).find(".page-btn").hide();
      }
    var l = function () {
      var e = document.querySelector(".liter .tooltip");
      window.addEventListener("mousemove", function (t) {
        var n = t.target;
        n && (n.closest(".liter__image svg path") ? e.classList.add("tooltip--active") : e.classList.remove("tooltip--active"), (e.style.left = t.pageX - 60 + "px"), (e.style.top = t.pageY - 40 + "px"));
      });
    };
    $(".js-hover").length && l(), $(window).scrollTop() > 0 ? $(".header").addClass("header--hide") : $(".header").removeClass("header--hide");
  });
