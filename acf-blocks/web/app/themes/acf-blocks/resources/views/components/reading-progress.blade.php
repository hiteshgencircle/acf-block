{{--
  Reading Progress Bar Component

  A fixed progress bar that shows reading progress on long articles.
  Add this to single post templates for better UX.
--}}

<div
  id="reading-progress"
  class="fixed top-0 left-0 h-1 z-50 transition-all duration-150"
  style="background-color: var(--color-signal-teal); width: 0%;"
  role="progressbar"
  aria-label="Reading progress"
  aria-valuemin="0"
  aria-valuemax="100"
  aria-valuenow="0"
></div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const progressBar = document.getElementById('reading-progress');

    if (!progressBar) return;

    function updateProgressBar() {
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight - windowHeight;
      const scrolled = window.scrollY;
      const progress = (scrolled / documentHeight) * 100;

      progressBar.style.width = Math.min(progress, 100) + '%';
      progressBar.setAttribute('aria-valuenow', Math.min(Math.round(progress), 100));
    }

    window.addEventListener('scroll', updateProgressBar);
    window.addEventListener('resize', updateProgressBar);

    // Initial update
    updateProgressBar();
  });
</script>
