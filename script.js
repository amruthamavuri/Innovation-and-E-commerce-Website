// Function to update user name in the navbar
        function updateUserName(name) {
            document.getElementById('userDisplayName').textContent = Hi, ${name};
        }  

        
        
// Show modal on page load
window.addEventListener('load', function() {
    showSignup();
});

// Show signup modal
function showSignup() {
    const modal = document.getElementById('signupModal');
    modal.style.display = 'flex';
}

// Show signin modal
function showSignin() {
    closeModal('signupModal');
    const modal = document.getElementById('signinModal');
    modal.style.display = 'flex';
}

// Close modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
}

// Show email signup form
function showEmailSignup() {
    const modalContent = document.querySelector('#signupModal .auth-modal-content');
    modalContent.innerHTML = `
        <div class="auth-logo">Vikraya</div>
        <form class="auth-form">
            <input type="text" class="auth-input" placeholder="Full Name">
            <input type="email" class="auth-input" placeholder="Email">
            <input type="password" class="auth-input" placeholder="Password">
            <button type="submit" class="auth-submit">Create Account</button>
        </form>
        <div class="auth-footer">
            By registering you agree to our
            <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>
            <p>Already have an account? <a onclick="showSignin()">Sign in</a></p>
        </div>
    `;
}

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    if (event.target.classList.contains('auth-modal-overlay')) {
        event.target.style.display = 'none';
    }
});