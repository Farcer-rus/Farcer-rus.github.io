$(function () {
	// calculate

	function calculate() {
		var $this = $('.calc-block'),
			rangeOne = $this.find('#range-1'),
			rangeTwo = $this.find('#range-2'),
			totalOne = $this.find('.calc-block__total:first-child span'),
			totalTwo = $this.find('.calc-block__total:last-child span'),
			rangeOneVal = rangeOne.val(),
			rangeTwoVal = rangeTwo.val();

		// range slider
		$("#range-1").ionRangeSlider({
			type: "single",
			skin: "big",
			min: 10,
			max: 100,
			from: 10,
			to: 0,
			grid: false,
			step: 5,
			hide_min_max: true,
			onStart: function (data) {
				rangeOneVal = (data.from);
				calculateTrigger();
			},
			onChange: function (data) {
				rangeOneVal = (data.from);
				calculateTrigger();
			},
		});

		$("#range-2").ionRangeSlider({
			type: "single",
			skin: "big",
			min: 20000,
			max: 150000,
			from: 20000,
			to: 0,
			grid: false,
			step: 500,
			hide_min_max: true,
			onStart: function (data) {
				// Called every time handle position is changed
				rangeTwoVal = (data.from);
				calculateTrigger();
			},
			onChange: function (data) {
				// Called every time handle position is changed
				rangeTwoVal = (data.from);
				calculateTrigger();
			},
		});

		function calculateTrigger() {
			var monthTotal = (rangeOneVal * rangeTwoVal) - (((rangeOneVal * rangeTwoVal) / 100) * 75),
				yearTotal = ((rangeOneVal * rangeTwoVal) - (((rangeOneVal * rangeTwoVal) / 100) * 75)) * 12;
			
			monthTotal = String(monthTotal).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
			yearTotal = String(yearTotal).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
			totalOne.text(monthTotal + ' руб')
			totalTwo.text(yearTotal + ' руб')
		}
		calculateTrigger();
	}
	calculate();

	// sliders
	function showCatalogSlider() {
		$('.catalog__tab .tab-pane.show.active').find('.catalog-slider').owlCarousel({
			loop: false,
			margin: 0,
			nav: false,
			dots: true,
			items: 3,
			slideBy: 1,
			smartSpeed: 1000,
			autoplaySpeed: 1000,
			responsive: {
				300: {
					items: 1,
					center: true,
				},
				768: {
					items: 2
				},
				1024: {
					items: 3
				}
			}
		});
		$('.catalog__navs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
			var activeTab = $($(this).attr('href'));
			activeTab.find('.catalog-slider').owlCarousel({
				loop: false,
				margin: 0,
				nav: false,
				dots: true,
				items: 3,
				slideBy: 1,
				smartSpeed: 1000,
				autoplaySpeed: 1000,
				responsive: {
					300: {
						items: 1,
						center: true,
					},
					768: {
						items: 2
					},
					1024: {
						items: 3
					}
				}
			});
		});
	}

	$(window).on('load', function () {
		showCatalogSlider();
	});


	$('.sb-slider').owlCarousel({
		loop: false,
		margin: 0,
		nav: true,
		dots: true,
		items: 1,
		slideBy: 1,
		smartSpeed: 1000,
		autoplaySpeed: 1000,
		navText: ['<img src="img/icons/arrow-left.png" alt="arrow-left">', '<img src="img/icons/arrow-right.png" alt="arrow-right">'],
	});

	$('.consist-slider').owlCarousel({
		loop: false,
		margin: 0,
		nav: false,
		dots: true,
		items: 3,
		slideBy: 1,
		smartSpeed: 1000,
		autoplaySpeed: 1000,
		responsive: {
			300: {
				items: 1,
				center: true,
			},
			820: {
				items: 2
			},
			768: {
				items: 2
			},
			1024: {
				items: 3
			}
		}
	});
	if ($(window).width() < 768) {
		$('.clients-slider').owlCarousel({
			loop: false,
			margin: 0,
			nav: false,
			dots: true,
			items: 1,
			slideBy: 1,
			smartSpeed: 1000,
			autoplaySpeed: 1000,
		});
		$('.steps__blocks').owlCarousel({
			loop: false,
			margin: 0,
			nav: false,
			dots: true,
			items: 1,
			slideBy: 1,
			smartSpeed: 1000,
			autoplaySpeed: 1000,
		});
		$('.map-catalog').owlCarousel({
			loop: false,
			margin: 0,
			nav: false,
			dots: true,
			items: 1,
			slideBy: 1,
			smartSpeed: 1000,
			autoplaySpeed: 1000,
		})
	}

	// phone mask
	$(".phone").mask("+7(999) 999-99-99");





	// mobile menu
	if ($(window).width() < 1200) {
		// Mobile Menu
		var burger = $('#burger');
		var mobileMenuBlock = $('.header-mobile');
		var closeBtn = $('.header-mobile__close');

		burger.on('change', function () {
			mobileMenuBlock.toggleClass('header-mobile--show');
		});

		closeBtn.on('click', function (e) {
			e.preventDefault();
			mobileMenuBlock.removeClass('header-mobile--show');
		})

		$('.header-menu a').on('click', function (e) {
			e.preventDefault();
			mobileMenuBlock.removeClass('header-mobile--show');
		})

		$(document).on('click', function (e) {
			var target = e.target;
			if (!target.closest('.burger') && !$(target).closest(".header-mobile").length) {
				burger.prop('checked', false);
				mobileMenuBlock.removeClass('header-mobile--show');
			}
		});

		//scroll
		$(".header__menu, .footer__menu").on("click", "a", function (event) {
			//отменяем стандартную обработку нажатия по ссылке
			event.preventDefault();
			//забираем идентификатор бока с атрибута href
			var id = $(this).attr('href'),
				//узнаем высоту от начала страницы до блока на который ссылается якорь
				top = $(id);
			topOffset = top.offset().top;
			if (top.length > 0) {
				//анимируем переход на расстояние - top за 1500 мс
				$('body,html').animate({
					scrollTop: topOffset
				}, 700);
			}
		});
	}

	// change tabs
	var catalogSelect = $('#catalogSelect');

	function changeTabs(select, tab) {
		select.on('change', function () {
			var tabs = $(tab);
			tabs.removeClass('show active');
			var activeTab = $(this).val();
			tabs.each(function (index, elem) {
				var elemId = elem.getAttribute('id');
				if (elemId === activeTab) {
					this.classList.add('active');
					this.classList.add('show');
				}
			})
			showCatalogSlider();
		})
	}
	if ($(window).width() < 1024) {
		changeTabs(catalogSelect, '#catalogTabs .tab-pane');
	}

	// forms
	$("form").on('submit', function () {
		sendAjaxForm($(this), 'action_ajax_form.php');
		$(this).trigger("reset");
		return false;
	});


	function sendAjaxForm(ajax_form, url) {
		$.ajax({
			url: url, //url страницы (action_ajax_form.php)
			type: "POST", //метод отправки
			dataType: "html", //формат данных
			data: $(ajax_form).serialize(), // Сеарилизуем объект
			success: function (response) { //Данные отправлены успешно
				result = $.parseJSON(response);
				setTimeout(function () {
					$('.callback-modal').modal('hide');
					$('.thanks-modal').modal('show');
				}, 1000);


			},
			error: function (response) { // Данные не отправлены
				ajax_form.find('.modal-form__result').text('Не удалось отправить письмо');
			}
		});
	}


});