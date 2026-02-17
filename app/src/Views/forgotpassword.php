<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

        <div class="modal fade text-black" id="success" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success">Email sent!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= strip_tags($_SESSION['email_sent'], '<a>') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-container">
            <h2 class="text-center">Forgot Password?</h2>
            <form method="POST" action="/forgotpassword" class="mb-4" id="forgotpassword-form" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" aria-required="true" required>
                    <span id="feedback" role="alert" style="color: red; font-size: 14px;"></span>
                </div>

                <button type="submit" class="btn btn-primary">
                    Send
                </button>

            </form>

        </div>
        <div class="alignment"><a href="/login" class="btn btn-secondary">Cancel</a></div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/forgotpassword.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(isset($_SESSION['email_sent'])): ?>
        const successModal = new bootstrap.Modal(document.getElementById('success'));
        successModal.show();
        <?php unset($_SESSION['email_sent']); ?>
        <?php endif; ?>
    });
    </script>
</body>

</html>