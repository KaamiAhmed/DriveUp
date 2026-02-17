<?php
use App\ViewModels\PackagesViewModel;
    /** @var PackagesViewModel $packages */
?>

<?php foreach($packages as $package){ ?>
<div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100 p-4 text-center <?= $package->price == 1799 ? 'shadow-lg' : 'shadow-sm' ?>">
        <h2 class="price text-primary fw-bold">&euro;<?= $package->price ?>,-</h2>
        <p class="bg-light py-2 fw-bold"><?= $package->title ?></p>

        <ul class="list-unstyled text-start mt-3">
            <?php if($package->title == "Express Driving Licence"){ ?>
            <li class="border-bottom py-2">
                <i class="bi bi-check-circle-fill text-success me-2" aria-hidden="true"></i>Within 10 days
            </li>
            <?php } ?>
            <li class="border-bottom py-2">
                <?php if($package->trial_lesson){ ?>
                <i class="bi bi-check-circle-fill text-success me-2" aria-hidden="true"></i>Free trial lesson
                <?php } else{ ?>
                <i class="bi bi-x-circle-fill text-danger me-2" aria-hidden="true"></i>Free trial lesson
                <?php } ?>
            </li>
            <li class="border-bottom py-2">
                <i class="bi bi-check-circle-fill text-success me-2"
                    aria-hidden="true"></i><?= $package->lesson_count ?> driving
                lessons
            </li>
            <li class="border-bottom py-2">
                <?php if($package->exam_included){ ?>
                <i class="bi bi-check-circle-fill text-success me-2" aria-hidden="true"></i>Practical exam
                <?php } else{ ?>
                <i class="bi bi-x-circle-fill text-danger me-2" aria-hidden="true"></i>Practical exam
                <?php } ?>
            </li>
            <li class="border-bottom py-2">
                <?php if($package->interim_test){ ?>
                <i class="bi bi-check-circle-fill text-success me-2" aria-hidden="true"></i>Interim test
                <?php } else{ ?>
                <i class="bi bi-x-circle-fill text-danger me-2" aria-hidden="true"></i>Interim test
                <?php } ?>
            </li>
        </ul>

        <a href="/triallessonform" class="btn btn-primary w-100 mt-auto">Book Trial Lesson</a>
    </div>
</div>

<?php } ?>