class FitScreen
{
    constructor() {
        this.elements = []
    }

    bind() {
        document.addEventListener('DOMContentLoaded', () => this.update())

        return this
    }

    declarative() {
        document.querySelectorAll('[data-fit-screen]').forEach(el => this.add(el, parseInt(el.dataset.fitScreen)))
        
        return this
    }

    add(el, size) {
        this.elements.push({ el, size })
    }

    update() {
        if (this.lastWidth == window.innerWidth) {
            return requestAnimationFrame(() => this.update())
        }

        this.lastWidth = window.innerWidth
        
        this.elements.forEach(element => {
            let elementsPerRow = Math.floor(window.innerWidth / element.size)
            let extraSpace = window.innerWidth - elementsPerRow * element.size
            let finalSize = element.size + extraSpace / elementsPerRow
            
            element.el.style.width = element.el.style.height = finalSize.toString() + "px"
        })

        requestAnimationFrame(() => this.update())
    }
}

export default new FitScreen()