import { startStimulusApp } from '@symfony/stimulus-bridge';
import { Dropdown } from 'bootstrap';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

// Initialize Bootstrap dropdowns after Turbo renders
document.addEventListener('turbo:load', () => {
    const dropdownElements = document.querySelectorAll('.dropdown-toggle');
    dropdownElements.forEach((dropdown) => {
      new Dropdown(dropdown);
    });
  });
