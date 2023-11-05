class Parallax
{
	constructor() {
		this.elements = []
	}

	bind() {
		document.addEventListener('DOMContentLoaded', () => this.update())

		return this
	}

	declarative() {
		document.querySelectorAll('[data-parallax]').forEach(el => this.add(el, el.dataset.parallax))

		return this
	}

	add(el, movement) {
		if (! el.offsetParent?.offsetTop) return
		
		this.elements.push({ el, movement, offset: el.offsetTop, parentOffset: el.offsetParent.offsetTop })
	}

	update() {
		if (this.lastPosition == window.scrollY) {
			return requestAnimationFrame(() => this.update())
		}

		this.lastPosition = window.scrollY

		this.elements.forEach(element => {
			let scrollCenter = window.scrollY + window.innerHeight / 2
			let difference = Math.abs(scrollCenter - element.offset - element.parentOffset)

			if (difference > window.innerHeight) return

			let change = difference / (window.innerHeight / 2) * element.movement

			if (scrollCenter < element.offset + element.parentOffset) {
				element.el.style.top = (element.offset - change).toString() + "px"
			} else {
				element.el.style.top = (element.offset + change).toString() + "px"
			}
		})

		requestAnimationFrame(() => this.update())
	}
}

export default new Parallax()