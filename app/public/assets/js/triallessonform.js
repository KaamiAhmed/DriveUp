const form = document.getElementById('triallesson-form');
const requiredFields = document.querySelectorAll("[required]");
const pattern = /^(\+31|0)6\d{8}$/;

form.addEventListener('submit', (e) => {
    e.preventDefault();

    let isValid = true;
    requiredFields.forEach(field => {
        const feedback = field.nextElementSibling;
        feedback.textContent = "";
        if(!field.value.trim()){
            feedback.textContent = "This field is required";
            isValid = false;
        }
        
        if (field.type === 'email' && !field.checkValidity()) {
            feedback.textContent = "Please enter a valid email address";
            isValid = false;
        }

        if(field.type === 'tel'){
            if (!pattern.test(field.value)) {
                feedback.textContent = 'Please enter a valid mobile number';
                isValid = false;
            }
        }

        if(field.type === 'checkbox' && !field.checked){
            feedback.textContent = 'Please give consent.';
            isValid = false;
        }
        
    });

    if (isValid) {
        form.submit();
    }
});

requiredFields.forEach(field => {
    field.addEventListener('input', () => {
        const feedback = field.nextElementSibling;
        if (field.value.trim()) {
            feedback.textContent = "";
        }
    });
});
