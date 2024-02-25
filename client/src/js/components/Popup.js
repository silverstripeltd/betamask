// /** eslint no-param-reassign */
import { createPopper } from '@popperjs/core';

const PopupModal = {

  createInstances() {
    const knownInstances = document.querySelectorAll('.cms-popup');
    const popperConfig = {
      placement: 'bottom',
      options: {
        padding: {
          left: 10,
          right: 10,
        },
      },
      modifiers: [
        {
          name: 'preventOverflow',
          options: {
            boundary: document.querySelector('.cms-top-bar'),
          },
        },
        {
          name: 'offset',
          options: {
            offset: [0, 8],
          },
        },
      ],
    };

    knownInstances.forEach(element => {
      const content = element.querySelector('.cms-popup-content');
      const button = element.querySelector('.cms-popup-action');
      const  popperInstance = createPopper(element, content, popperConfig);

      element.addEventListener('click', event => {
        event.stopImmediatePropagation();

        if (element.hasAttribute('data-show')) {
            element.removeAttribute('data-show');
            button.setAttribute('aria-expanded', 'false');
            return;
        }

        this.closeAnyPopups();

        // Make the tooltip visible
        element.setAttribute('data-show', '');
        button.setAttribute('aria-expanded', 'true');

        // Enable the event listeners
        popperInstance.setOptions((options) => ({
          ...options,
          modifiers: [
            ...options.modifiers,
            { name: 'eventListeners', enabled: true },
          ],
        }));

        // Update its position
        popperInstance.update();
      });
    })
  },

  addWindowEvent() {
    window.addEventListener('click', () => {
      this.closeAnyPopups();
    })
  },

  closeAnyPopups() {
    const anyOpenPopups = document.querySelectorAll('.cms-popup[data-show]');

    if (anyOpenPopups.length > 0) {
      anyOpenPopups.forEach(popup => popup.removeAttribute('data-show'));
    }
  }

};

export default PopupModal;
