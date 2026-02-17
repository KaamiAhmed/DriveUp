const email = document.getElementById('email');
const feedback = document.getElementById('feedback');
const form = document.getElementById('forgotpassword-form');

form.addEventListener('submit', (e) => {
    feedback.textContent = '';

    if (!email.value.trim()) {
        e.preventDefault();
        feedback.textContent = 'Email is required.';
    } 
    
    if (!email.checkValidity()) {
        e.preventDefault();
        feedback.textContent = 'Please provide a valid email address.';
    }
});

email.addEventListener('input', () => {
    feedback.textContent = '';
});

