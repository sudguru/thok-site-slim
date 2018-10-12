<div class="noo-slider-wrap">
  <ul class="noo-slider-image">
    <?php foreach ($topslides as $topslide): ?>
      <li>
        <div class="image-style">
          <a href="#">
            <img width="610" height="520" src="uploads/banner/<?= $topslide->banner; ?>" alt="" />
          </a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>