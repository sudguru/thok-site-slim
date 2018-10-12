<div class="noo-simple-product-wrap">
  <ul class="noo-simple-product-slider">
    <?php foreach ($subslides as $subslide): ?>
      <li>
        <a href="<?= $subslide->link; ?>">
          <div class="noo-simple-slider-item" data-bg="uploads/banner/<?= $subslide->banner; ?>">
            <div class="n-simple-content">
              <h3><?= $subslide->title; ?></h3>
              <span class="price"><span class="amount">&#36;25.00</span></span>
            </div>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>