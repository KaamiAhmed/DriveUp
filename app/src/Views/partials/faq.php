<?php
use App\Models\Faq;
    /** @var Faq $faq */
?>
<div class="accordion-item shadow-sm">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#<?= $faq->id ?>" aria-expanded="true" aria-controls="<?= $faq->id ?>">
            <?= htmlspecialchars($faq->question) ?>
        </button>
    </h2>
    <div id="<?= $faq->id ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
        <div class="accordion-body">
            <?= htmlspecialchars($faq->answer) ?>
        </div>
    </div>
</div>
<!-- <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                Accordion Item #1
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <strong>This is the first item’s accordion body.</strong> It is shown by default, until the collapse
                plugin
                adds the appropriate classes that we use to style each element. These classes control the overall
                appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with
                custom
                CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within
                the
                <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
        </div>
    </div> -->