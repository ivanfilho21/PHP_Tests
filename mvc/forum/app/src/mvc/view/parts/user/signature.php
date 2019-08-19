<style>
    .signature { margin-top: 1rem; }
    .signature .content {
        text-align: center;
    }
</style>

<section class="signature">
    <div class="content">
        <?= $user->getSignature() ?>
    </div>
</section>