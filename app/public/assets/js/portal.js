const successMessage = document.getElementById('type-changed');
successMessage.style.display = 'none';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.student-type').forEach(select => {
        select.addEventListener('change', () => {
            const studentId = select.dataset.studentId;
            const type = select.value;

            fetch('/updatetype', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ student_id: studentId, type: type })
            })
            .then(response => response.json())
            .then(data => {
                successMessage.textContent = data['message'];
                successMessage.style.display = 'block';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);

            })
            .catch(error => {
                console.error(error);
                alert('Error updating type');
            });
        });
    });

});

document.querySelectorAll('.student-type').forEach(select => {
    select.addEventListener('change', () => {
        setTimeout(() => {
            window.location.reload();
        }, 3100);
    })
});