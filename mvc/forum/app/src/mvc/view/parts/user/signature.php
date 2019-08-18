<style>
    .signature { margin-top: 1rem; }
    .signature .content {
        text-align: center;
    }
</style>

<section class="signature">
    <div class="title">Assinatura</div>
    <div class="content">
        <hr>
        <?= $user->getSignature() ?>
    </div>
</section>