class HomeView

	constructor: () ->

		$('header').addClass('showIntro')
		$('header').on 'transitionend', () -> $('header').addClass('showScreenshots')

		$('.installation-framework a').on 'click', (ev) ->

			ev.preventDefault()

			showSection = $(this).attr('href').substr(1)

			$('.installation .section-text').addClass('hidden')
			$('.installation .section-text.' + showSection).removeClass('hidden')

			$('.installation-framework a').removeClass('selected')
			$(this).addClass('selected')

		this.initSlider()

	initSlider: () ->

		this.currentSlide = 1

		window.setInterval (() => this.nextSlide()), 3000

	nextSlide: () ->

		nextSlide = this.currentSlide + 1
		nextSlide = 1 if this.currentSlide == 5

		$('.screenshot').not('.screenshot-' + this.currentSlide).css('z-index', 1)
		$('.screenshot-' + this.currentSlide).css('z-index', 2)
		$('.screenshot-' + nextSlide).css({ 'opacity': 0, 'z-index': 3 }).animate({ opacity: 1 }, 666)

		this.currentSlide = nextSlide

module.exports = HomeView
