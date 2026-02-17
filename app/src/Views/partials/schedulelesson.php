<?php
use App\Models\DrivingLesson;

/** @var DrivingLesson|null $lesson */
$isUpdate = isset($lesson) && $lesson !== null;
$formAction = $isUpdate ? "/editlesson/{$lesson->id}" : "/planlesson/{$studentId}/plan";
?>

<?php if(isset($_SESSION['error'])){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert"><?= htmlspecialchars($_SESSION['error']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['error']); ?>
<?php } ?>
<div class="form-container">
    <h2 class="text-center"><?= $isUpdate ? 'Update Lesson' : 'Plan Lesson' ?></h2>

    <form method="POST" action="<?= htmlspecialchars($formAction) ?>" class="mb-4">
        <?php if ($isUpdate): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($lesson->id) ?>">
        <?php endif; ?>
        <div>
            <label for="lesson_date" class="form-label">Date</label>
            <input type="date" min="<?= date('Y-m-d'); ?>" name="lesson_date" id="lesson_date" class="form-control"
                value="<?= $isUpdate ? htmlspecialchars($lesson->lesson_date) : '' ?>" aria-required="true" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" min="07:00" max="22:00" name="start_time" id="start_time" class="form-control"
                value="<?= $isUpdate ? htmlspecialchars($lesson->start_time) : '' ?>" aria-required="true" required>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration (minutes)</label>
            <input type="number" min="60" max="180" name="duration_minutes" id="duration" class="form-control"
                value="<?= $isUpdate ? htmlspecialchars($lesson->duration_minutes) : '' ?>" aria-required="true"
                required>
        </div>
        <a href="<?= $isUpdate ? "/schedule/$lesson->student_id" : "/schedule/$studentId" ?>"
            class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary"> <?= $isUpdate ? 'Update Lesson' : 'Plan Lesson' ?></button>

    </form>
</div>