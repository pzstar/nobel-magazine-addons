(function ($, elementor) {
    "use strict";
    var NMAElements = {

        init: function () {

            var widgets = {
                'nma-news-slider-one.default': NMAElements.sliderOneController,
                'nma-news-carousel-one.default': NMAElements.carouselOneController,
                'nma-news-carousel-two.default': NMAElements.carouselTwoController,
                'nma-news-carousel-three.default': NMAElements.carouselThreeController
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },

        sliderOneController: function ($scope) {
            var $element = $scope.find('.nma-post-slider-one');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: false,
                        animateOut: 'fadeOut',
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>']
                    });
                });
            }
        },
        carouselOneController: function ($scope) {
            var $element = $scope.find('.nma-post-carousel-one');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                                stagePadding: params.stagepadding_mobile
                            },
                            480: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                                stagePadding: params.stagepadding_tablet
                            },
                            768: {
                                items: params.items,
                                margin: params.margin,
                                stagePadding: params.stagepadding
                            }
                        }
                    });
                });
            }
        },
        carouselTwoController: function ($scope) {
            var $element = $scope.find('.nma-post-carousel-two');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                                stagePadding: params.stagepadding_mobile
                            },
                            480: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                                stagePadding: params.stagepadding_tablet
                            },
                            768: {
                                items: params.items,
                                margin: params.margin,
                                stagePadding: params.stagepadding
                            }
                        }
                    });
                });
            }
        },
        carouselThreeController: function ($scope) {
            var $element = $scope.find('.nma-post-carousel-three');
            if ($element.length > 0) {
                $element.each(function () {
                    var params = JSON.parse($(this).attr('data-params'));
                    $(this).owlCarousel({
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                                stagePadding: params.stagepadding_mobile
                            },
                            480: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                                stagePadding: params.stagepadding_tablet
                            },
                            768: {
                                items: params.items,
                                margin: params.margin,
                                stagePadding: params.stagepadding
                            }
                        }
                    });
                });
            }
        },

    };
    $(window).on('elementor/frontend/init', NMAElements.init);
}(jQuery, window.elementorFrontend));
