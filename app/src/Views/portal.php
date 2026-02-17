<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/schedule.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/table.css?v=1.0">
</head>

<body>
    <main class="main">
        <?php
        use App\Models\Enums\StudentType;
        ?>

        <h1 class="text-center">All Students</h1>
        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-dark text-uppercase">
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Date of Birth</th>
                    <th>Street + House</th>
                    <th>Postcode</th>
                    <th>Residence Place</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student){ ?>
                <tr>
                    <td><?= htmlspecialchars($student->firstname) . " " . htmlspecialchars($student->lastname) ?></td>
                    <td><?= htmlspecialchars($student->email) ?></td>
                    <td><?= htmlspecialchars($student->mobile) ?></td>
                    <td><?= htmlspecialchars($student->dateofbirth) ?></td>
                    <td><?= htmlspecialchars($student->street_house) ?></td>
                    <td><?= htmlspecialchars($student->postcode) ?></td>
                    <td><?= htmlspecialchars($student->residenceplace) ?></td>
                    <td>
                        <select class="form-select student-type" data-student-id="<?= $student->id ?>"
                            aria-label="Change student type">
                            <?php foreach ($types as $type): ?>
                            <option value="<?= $type ?>" <?= $student->type === $type ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                    </td>
                    <td>
                        <?php if($student->type == StudentType::REGULAR->value){ ?>
                        <a href="/schedule/<?= $student->id ?>" class="btn btn-sm btn-primary">Lessons</a>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                            data-student-id="<?= $student->id ?>">Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a class="btn btn-info text-color ms-1" href="/">Back to Home Page</a>

        <div id="deleteModal" class="custom-modal" role="dialog">
            <div class="custom-modal-content">
                <p id="deleteText"></p>

                <div class="modal-actions">
                    <button id="confirmDelete" class="btn btn-danger">Delete</button>
                    <button id="cancelDelete" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>

        <div class="alert alert-success" id="delete-message" role="status"
            style="position:absolute;bottom:0;width:30%;"></div>

        <div class="alert alert-success" id="type-changed" role="status" style="position:absolute;bottom:0;width:30%;">
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/portal.js"></script>
    <script>
    let studentId = null;
    const deleteMessage = document.getElementById('delete-message');
    deleteMessage.style.display = 'none';
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            studentId = btn.dataset.studentId;

            document.getElementById('deleteText').textContent =
                `Are you sure you want to delete the student with ID ${studentId}? His/Her lessons will also be removed.`;

            document.getElementById('deleteModal').style.display = 'flex';
        });
    });

    document.getElementById('cancelDelete').addEventListener('click', () => {
        document.getElementById('deleteModal').style.display = 'none';
        studentId = null;
    });

    document.getElementById('confirmDelete').addEventListener('click', () => {
        if (!studentId) return;

        fetch(`/deletestudent/${studentId}`, {
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
                        .querySelector(`.delete-btn[data-student-id="${studentId}"]`)
                        .closest('tr')
                        .remove();

                    deleteMessage.textContent = data['message'];
                    deleteMessage.style.display = 'block';
                    setTimeout(() => {
                        deleteMessage.style.display = 'none';
                    }, 3000);
                } else {
                    alert(data.message);
                }
            })
            .catch(() => alert('Something went wrong'))
            .finally(() => {
                document.getElementById('deleteModal').style.display = 'none';
                studentId = null;
            });
    });
    </script>
</body>

</html>