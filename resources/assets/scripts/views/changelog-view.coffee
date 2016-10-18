class ChangelogView

	constructor: () ->

		$('.changelog-nav a').on 'click', (ev) ->

			ev.preventDefault()

			showSection = $(this).attr('href').substr(1)

			$('.changelog').addClass('hidden')
			$('.changelog.' + showSection).removeClass('hidden')

			$('.changelog-nav a').removeClass('selected')
			$(this).addClass('selected')

module.exports = ChangelogView
