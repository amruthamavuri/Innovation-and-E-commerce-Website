// Store the user's full name in localStorage when they register
function handleEmailSignup(event) {
    event.preventDefault(); // Prevent default form submission
    const fullName = document.getElementById('fullName').value;
    localStorage.setItem('userFullName', fullName); // Store the name
    updateGreeting(fullName); // Update the greeting with the stored name
    document.getElementById('signupModal').style.display = 'none'; // Close modal
}

// Update the greeting message based on the user's name
function updateGreeting(fullName) {
    const userNameElement = document.getElementById('userDisplayName');
    userNameElement.textContent = `Hi, ${fullName}`;
}

// Check if the name exists in localStorage when the page loads
window.addEventListener('load', function() {
    const savedName = localStorage.getItem('userFullName');
    if (savedName) {
        updateGreeting(savedName); // If name exists, update the greeting
    } else {
        document.getElementById('signupModal').style.display = 'block'; // Show signup modal if no name
    }
});