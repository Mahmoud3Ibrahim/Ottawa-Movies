// Authors: Mahmoud Ibrahim, Sharmarke Yusuf, Mustafa Tareki
// Section: 321, Course: CST8285 Web Programming, Assignment 02: Ottawa Movies

// This Page is to validate the regestration information that the user enters.


document.addEventListener('DOMContentLoaded', () => {
    
    // Form validation
    const form = document.getElementById('registerForm');
    form.addEventListener('submit', (e) => {
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirm_password').value.trim();
        const terms = document.getElementById('terms').checked;

        // Reset any previous error messages
        clearErrors();

        // Username validation
        if (username.length < 3) {
            showError('username', 'Username must be at least 3 characters long.');
            e.preventDefault();
            return;
        }

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            showError('email', 'Please enter a valid email address.');
            e.preventDefault();
            return;
        }

        // Password validation
        if (password.length < 6) {
            showError('password', 'Password must be at least 6 characters long.');
            e.preventDefault();
            return;
        }

        // Confirm password validation
        if (password !== confirmPassword) {
            showError('confirm_password', 'Passwords do not match.');
            e.preventDefault();
            return;
        }

        // Terms validation
        if (!terms) {
            showError('terms', 'You must agree to the terms and conditions.');
            e.preventDefault();
            return;
        }
    });

    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error';
        errorDiv.style.color = '#ff4d6d';
        errorDiv.style.fontSize = '14px';
        errorDiv.style.marginTop = '5px';
        errorDiv.textContent = message;
        field.parentElement.appendChild(errorDiv);
    }

    function clearErrors() {
        const errors = document.querySelectorAll('.error');
        errors.forEach(error => error.remove());
    }
});