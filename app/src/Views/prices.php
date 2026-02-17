<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driving Lessons</title>
    <!-- Font Awesome Free CDN -->
    <script src="https://kit.fontawesome.com/da26891097.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/prices.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/header.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/footer.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/packages.css?v=1.0">
    <link rel="stylesheet" href="/assets/css/home.css?v=1.0">
</head>
<?php
    use App\ViewModels\IndividualPricesViewModel;

    /** @var IndividualPricesViewModel $vm2 */
?>

<body>
    <main class="main">
        <?php require __DIR__ . "/partials/header.php" ?>

        <section class="pricing container py-5">
            <div class="row">

                <!-- LEFT COLUMN -->
                <div class="col-lg-6">

                    <h2 class="section-title">Prices</h2>

                    <?php foreach($vm2->individualPrices as $individualPrice){ ?>
                    <?php if($individualPrice->category == "General"){ ?>
                    <div class="price-item">
                        <span><?= $individualPrice->title ?></span>
                        <span>€ <?= $individualPrice->price ?>,-</span>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <h2 class="section-title mt-5">Theory</h2>

                    <?php foreach($vm2->individualPrices as $individualPrice){ ?>
                    <?php if($individualPrice->category == "Theory"){ ?>
                    <div class="price-item">
                        <span><?= $individualPrice->title ?></span>
                        <span>€ <?= $individualPrice->price ?>,-</span>
                    </div>
                    <?php } ?>
                    <?php } ?>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-lg-6">

                    <h2 class="section-title mt-5">Manual</h2>

                    <?php foreach($vm2->individualPrices as $individualPrice){ ?>
                    <?php if($individualPrice->category == "Manual"){ ?>
                    <div class="price-item">
                        <span><?= $individualPrice->title ?></span>
                        <span>€ <?= $individualPrice->price ?>,-</span>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <h2 class="section-title mt-5">Automatic</h2>

                    <?php foreach($vm2->individualPrices as $individualPrice){ ?>
                    <?php if($individualPrice->category == "Automatic"){ ?>
                    <div class="price-item">
                        <span><?= $individualPrice->title ?></span>
                        <span>€ <?= $individualPrice->price ?>,-</span>
                    </div>
                    <?php } ?>
                    <?php } ?>

                </div>

            </div>
        </section>

        <?php
            use App\ViewModels\PackagesViewModel;

            /** @var PackagesViewModel $vm */
        ?>
        <section class="packages container mt-5 p-3">
            <div class="d-flex justify-content-center align-items-center mb-4">
                <span class="me-3 mt-1 fs-5">Manual</span>
                <div class="form-check form-switch">
                    <input class="form-check-input fs-5" type="checkbox" id="gearSwitch"
                        aria-label="Toggle between manual and automatic packages">
                </div>
                <span style="margin-left:-2px;" class="mt-1 fs-5">Automatic</span>
            </div>

            <div id="packagesContainer" class="row g-4" role="region" aria-live="polite">
                <?php
                require __DIR__ . "/partials/packages.php";
                ?>
            </div>
        </section>

        <?php require __DIR__ . "/partials/footer.php" ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/prices.js"></script>
</body>

</html>