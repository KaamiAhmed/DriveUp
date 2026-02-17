let lessonId = null;
const successMessage = document.getElementById('delete-message');
successMessage.style.display = 'none';
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        lessonId = btn.dataset.lessonId;

        document.getElementById('deleteText').textContent =
            `Are you sure you want to delete lesson with ID ${lessonId}?`;

        document.getElementById('deleteModal').style.display = 'flex';
    });
});

document.getElementById('cancelDelete').addEventListener('click', () => {
    document.getElementById('deleteModal').style.display = 'none';
    lessonId = null;
});

document.getElementById('confirmDelete').addEventListener('click', () => {
    if (!lessonId) return;

    fetch(`/deletelesson/${lessonId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // remove row instantly
            document
                .querySelector(`[data-lesson-id="${lessonId}"]`)
                .closest('tr')
                .remove();

                successMessage.textContent = data['message'];
                successMessage.style.display = 'block';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
        } else {
            alert(data.message);
        }
    })
    .catch(() => alert('Something went wrong'))
    .finally(() => {
        document.getElementById('deleteModal').style.display = 'none';
        lessonId = null;
    });
});

