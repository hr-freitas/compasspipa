document.addEventListener('DOMContentLoaded', () => {
  const nextBtn = document.querySelector('.next');
  const prevBtn = document.querySelector('.prev');
  const carousel = document.querySelector('.carousel');
  const list = document.querySelector('.list');
  const runningTime = document.querySelector('.carousel .timeRunning');

  if (!carousel || !list || !nextBtn || !prevBtn || !runningTime) {
    return;
  }

  const timeRunning = 3000;
  const timeAutoNext = 7000;
  let runTimeOut;
  let runNextAuto;

  function resetTimeAnimation() {
    runningTime.style.animation = 'none';
    runningTime.offsetHeight;
    runningTime.style.animation = 'runningTime 7s linear 1 forwards';
  }

  function showSlider(type) {
    const sliderItemsDom = list.querySelectorAll('.carousel .list .item');
    if (!sliderItemsDom.length) {
      return;
    }

    if (type === 'next') {
      list.appendChild(sliderItemsDom[0]);
      carousel.classList.add('next');
    } else {
      list.prepend(sliderItemsDom[sliderItemsDom.length - 1]);
      carousel.classList.add('prev');
    }

    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
      carousel.classList.remove('next');
      carousel.classList.remove('prev');
    }, timeRunning);

    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
      nextBtn.click();
    }, timeAutoNext);

    resetTimeAnimation();
  }

  nextBtn.addEventListener('click', () => showSlider('next'));
  prevBtn.addEventListener('click', () => showSlider('prev'));

  const menuToggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('navMenu');

  if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
      navMenu.classList.toggle('show');
    });

    navMenu.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => navMenu.classList.remove('show'));
    });
  }

  resetTimeAnimation();
  runNextAuto = setTimeout(() => {
    nextBtn.click();
  }, timeAutoNext);
});