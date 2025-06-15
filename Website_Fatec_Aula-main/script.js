document.querySelectorAll('button').forEach(btn => {
    btn.addEventListener('mouseenter', () => btn.style.transform = 'scale(1.05)');
    btn.addEventListener('mouseleave', () => btn.style.transform = 'scale(1)');
  });

  // Scroll Reveal Effect
const fadeInElements = document.querySelectorAll('.fade-in');

function handleScroll() {
  fadeInElements.forEach(el => {
    const rect = el.getBoundingClientRect();
    if (rect.top < window.innerHeight - 100) {
      el.classList.add('visible');
    }
  });
}

window.addEventListener('scroll', handleScroll);
window.addEventListener('load', handleScroll); // já mostra os visíveis de cara
