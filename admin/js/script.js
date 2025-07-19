// Updated script.js - Dark/Light toggle removed

// Sidebar toggle
const openBtn = document.getElementById('openSidebar');
const closeBtn = document.getElementById('closeSidebar');
const sidebar = document.querySelector('.ap-sidebar');

// Open sidebar
if (openBtn) {
  openBtn.addEventListener('click', () => {
    sidebar.classList.remove('closed');
  });
}

// Close sidebar
if (closeBtn) {
  closeBtn.addEventListener('click', () => {
    sidebar.classList.add('closed');
  });
}

// Dark/Light mode toggle removed - no extra code needed
