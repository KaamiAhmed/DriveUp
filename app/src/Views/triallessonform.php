<?php
use App\Models\Enums\StudentType;
$currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trial Lesson form</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/triallessonform.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/footer.css?v=1.0">
</head>

<body>
    <main class="main">
        <?php if(isset($_SESSION['form_submitted'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['form_submitted']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['form_submitted']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['error_registering'])){ ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['error_registering']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error_registering']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['consent_needed'])){ ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['consent_needed']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['consent_needed']); ?>
        <?php } ?>

        <a id="backBtn" tabindex="0" class="backBtn" role="button">&#10094;
            Back</a>
        <div class="form-container">
            <h2 class="text-center">Book Trial Lesson</h2>
            <p class="mt-2 mb-4">
                <i class="bi bi-info-circle me-1"></i>
                Note: The fee of <strong>€55</strong> applies for the trial lesson unless you plan to take a
                package
                afterwards.
            </p>
            <form method="post" action="/sendform" id="triallesson-form" novalidate>
                <div class="row mb-3">
                    <label class="form-label" for="name">Name:<span style="color:red;">*</span></label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="e.g John" id="firstname" name="firstname"
                            value="<?= htmlspecialchars($student->firstname ?? '') ?>" aria-required="true" required>
                        <span class="feedback" style="color: red; font-size: 14px;"></span>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="e.g Doe" id="lastname" name="lastname"
                            value="<?= htmlspecialchars($student->lastname ?? '') ?>" aria-required="true" required>
                        <span class="feedback" style="color: red; font-size: 14px;"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="dateofbirth">Date of Birth:<span style="color:red;">*</span></label>
                    <input type="date" min="1900-01-01" max="<?php echo date('Y-m-d', strtotime('-16 years')) ?>"
                        class="form-control" id="dateofbirth" name="dateofbirth" aria-required="true" required>
                    <span class="feedback" style="color: red; font-size: 14px;"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="street-house">Address details:<span
                            style="color:red;">*</span></label>
                    <input type="text" class="form-control mb-2" placeholder="e.g marconistraat 9" id="street-house"
                        name="street_house" value="<?= htmlspecialchars($student->street_house ?? '') ?>"
                        aria-required="true" required>
                    <span class="feedback" style="color: red; font-size: 14px;"></span>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="e.g 1234 AB" id="postcode"
                                name="postcode" value="<?= htmlspecialchars($student->postcode ?? '') ?>"
                                aria-required="true" required>
                            <span class="feedback" style="color: red; font-size: 14px;"></span>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="e.g Amsterdam" id="residence-place"
                                name="residence_place" value="<?= htmlspecialchars($student->residenceplace ?? '') ?>"
                                required>
                            <span class="feedback" style="color: red; font-size: 14px;"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email:<span style="color:red;">*</span></label>
                    <input type="email" class="form-control" placeholder="e.g abc@gmail.com" id="email" name="email"
                        value="<?= htmlspecialchars($student->email ?? '') ?>" aria-required="true" required>
                    <span class="feedback" style="color: red; font-size: 14px;"></span>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="mobile">Mobile:<span style="color:red;">*</span></label>
                    <input type="tel" class="form-control" placeholder="e.g 06xxxxxxxx" id="mobile" name="mobile"
                        value="<?= htmlspecialchars($student->mobile ?? '') ?>" aria-required="true" required>
                    <span class="feedback" style="color: red; font-size: 14px;"></span>
                </div>

                <div class="mb-3">
                    <label>
                        <input class="form-check-input" type="checkbox" name="consent" value="yes" required>
                        I agree to the <a href="/privacy" target="_blank">Privacy Policy</a> of DriveUp driving school.
                        <span class="feedback" style="color: red; font-size: 14px;"></span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Send</button>
            </form>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/triallessonform.js"></script>
    <script>
    document.getElementById("backBtn").addEventListener("click", (e) => {
        history.back();
    });

    if (history.length <= 1) {
        backBtn.style.display = "none";
    }
    </script>
</body>

</html>