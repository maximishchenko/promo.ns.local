
<section class="choose-feedback">
    <div class="container">
      <div class="page-title">
        <?php if ($title): ?>
          <?= $title; ?>
        <?php else: ?>
          Оставить заявку
        <?php endif; ?>
      </div>
      <div class="choose-feedback__text">Если у вас есть вопросы или вы не нашли нужной вам информации, оставьте свой номер — мы позвоним, чтобы ответить на все ваши вопросы.</div>
      

      <?= $this->render('//layouts/template/form/_form'); ?>

    </div>
</section>