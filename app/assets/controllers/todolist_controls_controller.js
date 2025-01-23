import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    loadItems(event) {
        event.preventDefault();
        const url = event.currentTarget.dataset.todolistControlsUrl;
        console.log(url);
        this.element.dispatchEvent(
            new CustomEvent('item-selected', {
                detail: { url },
                bubbles: true,
            })
        );
    }
}
