// law-firm-dpattorney lazyload.js
(function(){
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
})();
