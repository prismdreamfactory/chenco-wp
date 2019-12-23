<?php

/** Template version: 2.0.0
 *
 * -= 2.0.0 =-
 * - Add cuar- prefix to bootstrap classes
 *
 * -= 1.1.0 =-
 * - Handle the spacers when too many pages
 *
 * -= 1.0.0 =-
 * - Initial version
 *
 */ ?>

<div class="pagination">

  <div class="pagination__current">
    <?php foreach ($page_links as $num => $page_args) : ?>
    <?php if ($page_args['is_current']) : ?>

    <div>
      Page <?= $num; ?> of <?= count($page_links) ?>
    </div>

    <?php endif; ?>
    <?php endforeach; ?>
  </div>

  <ul class="pagination__nav">
    <?php foreach ($page_links as $num => $page_args) : ?>
    <?php if ($page_args['is_current']) : ?>

    <li class="active">
      <?= $num; ?>
    </li>

    <?php elseif ($page_args['link'] === false) : ?>

    <li>
      <a href="#">&hellip;</a>
    </li>

    <?php else : ?>

    <li>
      <a href="<?php echo esc_attr($page_args['link']); ?>"
        title="<?php printf(esc_attr__('Page %1$s', 'cuar'), $num); ?>">
        <?= $num; ?>
      </a>
    </li>

    <?php endif; ?>
    <?php endforeach; ?>

</div>