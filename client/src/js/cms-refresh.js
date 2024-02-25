import PopupModal from "./components/Popup";
import Banner from './components/Banner';

// Apply parent body class to allow cascade of custom CMS 5 styles
document.addEventListener('DOMContentLoaded', () => {
  const bodyEl = document.querySelector('html');
  bodyEl.classList.add('cms-refresh');

  PopupModal.createInstances();
  PopupModal.addWindowEvent();
  Banner.init();
});
