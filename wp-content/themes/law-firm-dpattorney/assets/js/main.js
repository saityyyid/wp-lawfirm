// law-firm-dpattorney main.js
// Mobile nav, sticky header, counters, smooth scroll, AJAX filter, lazyload, reading time

document.addEventListener('DOMContentLoaded', function() {
  // Mobile nav toggle
  const navToggle = document.querySelector('.nav-toggle');
  const navMenu = document.querySelector('.main-navigation');
  if (navToggle && navMenu) {
    navToggle.addEventListener('click', function() {
      navMenu.classList.toggle('open');
      document.body.classList.toggle('nav-open');
    });
  }

  // Sticky header
  const header = document.querySelector('header.site-header');
  window.addEventListener('scroll', function() {
    if (window.scrollY > 100) {
      header && header.classList.add('is-sticky');
    } else {
      header && header.classList.remove('is-sticky');
    }
  });

  // Stats counter animation
  const counters = document.querySelectorAll('.stat-counter');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = +el.getAttribute('data-target');
        let count = 0;
        const duration = 1500;
        const step = Math.ceil(target / (duration / 16));
        function updateCounter() {
          count += step;
          if (count < target) {
            el.textContent = count;
            requestAnimationFrame(updateCounter);
          } else {
            el.textContent = target;
          }
        }
        updateCounter();
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.5 });
  counters.forEach(counter => observer.observe(counter));

  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  // Lazy loading images
  document.querySelectorAll('img[data-src]').forEach(img => {
    const io = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          img.src = img.getAttribute('data-src');
          img.removeAttribute('data-src');
          io.unobserve(img);
        }
      });
    });
    io.observe(img);
  });

  // Reading time
  document.querySelectorAll('.post-content').forEach(post => {
    const words = post.textContent.trim().split(/\s+/).length;
    const readingTime = Math.ceil(words / 200);
    const badge = document.createElement('span');
    badge.className = 'reading-time';
    badge.textContent = readingTime + ' min read';
    post.prepend(badge);
  });
});
