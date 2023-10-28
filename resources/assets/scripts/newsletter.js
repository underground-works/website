class Newsletter
{
    declarative() {
        document.querySelector('[data-newsletter]')?.addEventListener('submit', ev => this.submit(ev))

        return this
    }

    submit(ev) {
        ev.preventDefault()
        
        let input = ev.currentTarget.querySelector('[data-newsletter-input]')
        let button = ev.currentTarget.querySelector('[data-newsletter-submit]')
        
        fetch('/newsletter', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: input.value })
        })
        
        button.classList.remove('bg-zinc-100', 'hover:bg-zinc-200', 'border-zinc-200', 'text-zinc-600')
        button.classList.add('bg-green-200', 'border-green-300', 'text-zinc-900')
        
        button.innerText = 'Subscribed'
    }
}

export default new Newsletter()