<?php
use App\ViewModels\ReviewsViewModel;
    /** @var ReviewsViewModel $vm */
?>
<div class="container py-5">
    <h1 class="text-center mb-4">What Our Students Experience</h1>

    <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php if ($vm === null): ?>
            <div class="carousel-item active">
                <div class="text-center">No reviews yet.</div>
            </div>
            <?php else: ?>
            <?php
                    // Prepare slides: chunk reviews by 3
                    $chunks = array_chunk($vm->reviews, 3);
                    foreach ($chunks as $index => $chunk):
                    ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <div class="row justify-content-center">
                    <?php foreach ($chunk as $review): ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="review-card p-3 bg-white shadow-sm rounded h-100 d-flex flex-column">
                            <div class="stars mb-2">★★★★★</div>
                            <p class="flex-grow-1"><?= nl2br(htmlspecialchars($review->review)) ?></p>
                            <div class="reviewer-name fw-bold mt-2"><?= htmlspecialchars($review->name) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>