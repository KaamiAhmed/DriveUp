<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/schedule.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/footer.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/table.css?v=1.0">
</head>

<tbody>
    <?php 
        use App\ViewModels\LessonsViewModel;
        /** @var LessonsViewModel $vm */

        $groupedLessons = [];
        foreach ($vm->lessons as $lesson) {
            $key = ($lesson->lesson_date < date("Y-m-d")) ? 'Past' : 'Upcoming';
            $groupedLessons[$key][] = $lesson;
        }
    ?>
    <main class="main">
        <?php if(isset($_SESSION['success'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="status">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['no_lessons'])){ ?>
        <div class="alert alert-info" role="status"><?= htmlspecialchars($_SESSION['no_lessons']) ?>
        </div>
        <?php unset($_SESSION['no_lessons']); ?>
        <?php } ?>

        <?php if($_SESSION['user']['role'] == 'admin'){ ?>
        <h1 class="text-center">Lessons of <?= htmlspecialchars($student->firstname . " " . $student->lastname) ?></h1>
        <?php } else{ ?>
        <h1>My Lessons</h1>
        <?php } ?>

        <?php if($_SESSION['user']['role'] == 'admin'){ ?>
        <a class="btn btn-info ms-1" href="/planlesson/<?= $studentId ?>">Plan Lesson</a>
        <?php } ?>

        <table class="table table-striped table-bordered my-3 align-middle">

            <thead class="table-dark text-center text-uppercase">
                <tr>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>Duration</th>
                    <?php if($_SESSION['user']['role'] == 'admin'){ ?>
                    <th>Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php foreach ($groupedLessons as $group => $lessonsGroup): ?>
                <tr>
                    <td colspan="4">
                        <h5><?= $group ?> Lessons </h5>
                    </td>
                </tr>

                <?php foreach ($lessonsGroup as $lesson): ?>
                <tr>
                    <td><?= htmlspecialchars($lesson->lesson_date) ?></td>
                    <td><?= htmlspecialchars(date('H:i', strtotime($lesson->start_time))) ?></td>
                    <td><?= htmlspecialchars($lesson->duration_minutes) ?></td>
                    <?php if($_SESSION['user']['role'] == 'admin'){ ?>
                    <td>
                        <button type="button" class="btn btn-danger delete-btn"
                            data-lesson-id="<?= $lesson->id ?>">Delete</button>
                        <?php if($lesson->lesson_date > date("Y-m-d") ){ ?>
                        <a href="/editlesson/<?= $lesson->id ?>" class="btn btn-info">Edit</a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if($_SESSION['user']['role'] == 'admin'){ ?>
        <a class="btn btn-info text-color ms-1" href="/adminportal">Back to Portal</a>
        <?php } else{ ?>
        <a class="text-color btn btn-info" href="/">Back to Home</a>
        <?php } ?>

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
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/schedule.js"></script>
    </body>

</html>