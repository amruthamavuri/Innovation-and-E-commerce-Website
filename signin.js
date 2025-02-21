// Script to handle modal behavior
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('signin-modal');
  const closeModal = document.getElementById('close-modal');

  // Automatically show modal on page load
  modal.style.display = 'block';

  // Close modal and remove blur
  closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
    document.getElementById('blur-background').style.filter = 'none';
  });

  // Simulate Sign-Up button toggle (optional)
  document.getElementById('show-signup').addEventListener('click', () => {
    alert('Sign-Up screen will appear here!');
  });

  // Handle form submission
  document.getElementById('signin-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    alert(`Email: ${email}, Password: ${password}`);
    // Replace the alert with actual sign-in functionality
  });
});
