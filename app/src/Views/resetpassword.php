<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/resetpassword.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/triallessonform.css?v=1.0">
</head>

<body>
    <main class="main">
        <?php if(isset($_SESSION['error'])){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
        <?php } ?>

        <?php if(isset($_SESSION['password_validate'])){ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['password_validate']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['password_validate']); ?>
        <?php } ?>

        <div class="form-container">
            <h2 class="text-center">Reset Password</h2>
            <form method="POST" action="/resetpassword" class="mb-4" id="resetpassword-form">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <div class="mb-3">
                    <label for="newpassword" class="form-label">New Password:</label>
                    <div class="password-block">
                        <input type="password" class="form-control" id="newpassword" name="newpassword"
                            aria-required="true" required>
                        <div class="eye" style="cursor: pointer;" aria-label="Show password"><i tabindex="0"
                                class="bi bi-eye-fill" aria-hidden="true"></i></div>
                    </div>
                    <div id="rule-length" style="font-size: 14px;">Password must be at least 8 characters
                        long.</div>
                    <div id="rule-uppercase" style="font-size: 14px;">Password must contain an uppercase letter.</div>
                    <div id="rule-lowercase" style="font-size: 14px;">Password must contain a lowercase letter.</div>
                    <div id="rule-number" style="font-size: 14px;">Password must contain a number.</div>
                    <div id="rule-special" style="font-size: 14px;">Password must contain a special character.</div>
                </div>

                <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm Password:</label>
                    <div class="password-block">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                            aria-required="true" required>
                        <div class="eye" style="cursor: pointer;" aria-label="Show password"><i tabindex="0"
                                class="bi bi-eye-fill" aria-hidden="true"></i></div>
                    </div>
                    <span id="confirmpassword-feedback" style="color: red; font-size: 14px;"></span>
                </div>

                <button type="submit" class="btn btn-primary">
                    Reset Password
                </button>

            </form>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/resetpassword.js"></script>
    <script>
    const eyeIcons = document.querySelectorAll(".eye");

    eyeIcons.forEach((eye) => {
        const input = eye.previousElementSibling; // get the input right before the eye div
        const icon = eye.querySelector("i");

        function togglePassword() {
            if (input.type === "password") {
                input.type = "text";
                icon.className = "bi bi-eye-slash-fill";
                eye.setAttribute("aria-label", "Hide password");
            } else {
                input.type = "password";
                icon.className = "bi bi-eye-fill";
                eye.setAttribute("aria-label", "Show password");
            }
        }

        eye.addEventListener("click", togglePassword);
        eye.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                togglePassword();
            }
        });
    });
    </script>
</body>

</html>