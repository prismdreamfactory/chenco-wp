<?php

/** Customer area earch partial
 *
 */ ?>

<div class="investor__search">
  <form name="search" method="post">
    <div class="form-group">
      <label class="control-label">Date Range</label>
      <input type="text" class="datepicker-here" data-language='en' data-range="true"
        data-multiple-dates-separator=" - " data-language="en" data-date-format="dd-mm-yyyy" name="file_date" />
    </div>

    <div class="form-group">
      <label class="control-label">Document Type</label>
      <!-- <select name="document_type">
        <option value="Monthly Report">Monthly Report</option>
        <option value="title">Document name</option>
      </select> -->
      <select name="document_type">
        <option value="All">All</option>
        <?php foreach ($terms as $term) : ?>
        <option value="<?= $term->name; ?>"><?= $term->name; ?></option>;
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label class="control-label">Document Name</label>
      <input type="text" name="document_name" />
    </div>

    <!-- <div class="form-group">
      <label class="control-label">Investment</label>
      <select name="investment"></select>
    </div> -->

    <div class="form-group">
      <label class="control-label">Sort By</label>
      <select name="orderby">
        <option value="date">Date</option>
        <option value="title">Document name</option>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label">Sort Order</label>
      <select name="order">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
      </select>
    </div>

    <!-- <div class="form-group">
      <label class="control-label">Limit</label>
      <select name="posts_per_page">
        <option value="1">1</option>
        <option value="25">25</option>
        <option value="50">50</option>
      </select>
    </div> -->

    <div class="form-group form-submit">
      <input type="submit" name="search" value="Search" class="btn" />
    </div>
  </form>
</div>