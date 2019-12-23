<?php

/** Template version: 3.1.0
 *
 * -= 3.1.0 =-
 * - Add hooks
 *
 * -= 3.0.0 =-
 * - Improve UI for new master-skin
 *
 * -= 1.2.0 =-
 * - Compatibility with the new multiple attached files
 *
 * -= 1.1.0 =-
 * - Updated markup
 * - Normalized the extra class filter name
 *
 * -= 1.0.0 =-
 * - Initial version
 *
 */
?>

<?php
$title_popup = sprintf(__('Uploaded on %s', 'cuar'), get_the_date());
$file_count = cuar_get_the_attached_file_count($post->ID);

$attachments = cuar_get_the_attached_files($post->ID);
$attachment_count = count($attachments);
/* only one file per download */
$file = current($attachments);
?>

<tr>
  <td><?= get_the_date('d M Y') ?></td>
  <td><?= cuar_get_the_owner(); ?></td>
  <td>Investment</td>
  <td><?php the_title(); ?></td>
  <td><?php the_field('document_type') ?></td>
  <td class="cuar-actions">
    <a href="<?php cuar_the_attached_file_link($post->ID, $file); ?>" title="<?php esc_attr_e('Get file', 'cuar'); ?>"
      class="btn__download">
      <span class="fa fa-download"></span>
    </a>
  </td>
</tr>


<?php /*
<tr>
    <td class="cuar-title">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($title_popup); ?>"><?php the_title(); ?></a>
</td>
<td class="text-right cuar-extra-info">
  <?php do_action('cuar/templates/block/item/extra-info'); ?>
  <span
    class="label label-default cuar-file-count"><?php echo sprintf(_n('%1$s file', '%1$s files', $file_count, 'cuar'), $file_count); ?></span>
</td>
</tr>
*/ ?>