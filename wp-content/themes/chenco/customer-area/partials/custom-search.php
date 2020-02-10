<?php

/** Customer area earch partial
 *
 */

$terms = get_terms(array(
  'taxonomy'   => 'cuar_private_file_category',
  'orderby'    => 'count',
  'hide_empty' => false,
  'fields'     => 'all'
));

/* Create investments array from ACF field group for select box */
$field_group_key = 'field_5e002af23371d';
$investments = get_field_object($field_group_key)['choices'];

// echo '<pre>', var_dump($investments), '</pre>';
?>

<div class="investor__search">
  <form name="search" method="post">
    <div class="form-group">
      <label class="control-label">Date Range</label>
      <input type="text" class="datepicker-here" data-language='en' data-range="true"
        data-multiple-dates-separator=" - " data-language="en" data-date-format="dd-mm-yyyy" name="file_date"
        value="<?php if (isset($_SESSION['file_date'])) echo $_SESSION['file_date']; ?>" />
    </div>


    <div class="form-group">
      <label class="control-label">Document Type</label>
      <select name="document_type">
        <option value="all" <?php if (($_SESSION['selected_document_type']) == 'all') echo 'selected="selected"'; ?>>
          All
        </option>
        <?php foreach ($terms as $term) : ?>
        <option value="<?= $term->slug; ?>"
          <?php if (($_SESSION['selected_document_type']) == $term->slug) echo 'selected="selected"'; ?>>
          <?= $term->name; ?>
        </option>
        <?php endforeach; ?>
      </select>
    </div>

    <?php /*
    <div class="form-group">
      <label class="control-label">Document Name</label>
      <input type="text" name="document_name" />
    </div>
    */ ?>

    <div class="form-group">
      <label class="control-label">Investment</label>
      <select name="investment">
        <option value="all" <?php if (($_SESSION['selected_investment']) == 'all') echo 'selected="selected"'; ?>>
          All
        </option>
        <?php foreach ($investments as $investment) : ?>
        <option value="<?= $investment; ?>"
          <?php if (($_SESSION['selected_investment']) == $investment) echo 'selected="selected"'; ?>>
          <?= $investment ?>
        </option>
        <?php endforeach; ?>
      </select>
    </div>


    <div class="form-group">
      <label class="control-label">Sort By</label>
      <select name="sortby">
        <option value="date" <?php if (($_SESSION['selected_sortby']) == 'date') echo 'selected="selected"'; ?>>Date
        </option>
        <option value="modified" <?php if (($_SESSION['selected_sortby']) == 'modified') echo 'selected="selected"'; ?>>
          Modified</option>
        <option value="title" <?php if (($_SESSION['selected_sortby']) == 'title') echo 'selected="selected"'; ?>>
          Document Name</option>
      </select>
    </div>

    <div class="form-group">
      <label class="control-label">Sort Order</label>
      <select name="order">
        <option value="ASC" <?php if (($_SESSION['selected_order']) == 'ASC') echo 'selected="selected"'; ?>>Ascending
        </option>
        <option value="DESC" <?php if (($_SESSION['selected_order']) == 'DESC') echo 'selected="selected"'; ?>>
          Descending</option>
      </select>
    </div>


    <?php /* <div class="form-group">
      <label class="control-label">Limit</label>
      <select name="posts_per_page">
        <option value="1">1</option>
        <option value="25">25</option>
        <option value="50">50</option>
      </select>
    </div> */ ?>

    <div class="form-group form-submit">
      <input type="submit" name="search" value="Search" class="btn" />
    </div>
  </form>
</div>