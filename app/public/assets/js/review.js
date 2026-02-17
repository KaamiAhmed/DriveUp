const reviewForm = document.getElementById('review-form');
const successMessage = document.getElementById('review-submitted');
const nameFeedback = document.getElementById('name-feedback');
const reviewFeedback = document.getElementById('review-feedback');
const nameInput = document.getElementById('name');
const reviewInput = document.getElementById('review');
successMessage.style.display = 'none';
  reviewForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const name = nameInput.value.trim();
    const review = reviewInput.value.trim();

    if(!name){
        nameFeedback.textContent = 'Name is required';
        return;
    }

    if(!review){
        reviewFeedback.textContent = 'Review is required.';
        return;
    }

    fetch('/review', {
      method:'POST',
      headers: {'Content-Type': 'application/json', },
      body: JSON.stringify({name, review})
    })
    .then(res => res.json())
    .then(data => {
        if(!data.success){
            return;
        }
      successMessage.textContent = data['message'];
      successMessage.style.display = 'block';

      setTimeout(() => {
            successMessage.style.display = 'none';
        }, 3000);
        
      reviewForm.reset(); 
    });
});

 nameInput.addEventListener('input', () => {
        nameFeedback.textContent = "";
});

reviewInput.addEventListener('input', () => {
        reviewFeedback.textContent = "";
});