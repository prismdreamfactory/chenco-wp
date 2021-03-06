<?php

/** Template version: 3.1.0
 *
 * -= 3.1.0 =-
 * - Replace clearfix CSS classes with cuar-clearfix
 *
 * -= 3.0.0 =-
 * - Initial version
 *
 */
?>

<?php
global $post;

$is_author = get_the_author_meta('ID') == get_current_user_id();

if ($is_author) {
  $published = sprintf(__('Published on %s, by yourself, for %s', 'cuarse'), get_the_date(), cuar_get_the_owner());
} else {
  $published = sprintf(__('Published on %s, by %s, for %s', 'cuarse'), get_the_date(), get_the_author_meta('display_name'), cuar_get_the_owner());
}

$extra_class = ' ' . get_post_type();
$extra_class = apply_filters('cuar/templates/list-item/extra-class?post-type=' . get_post_type(), $extra_class, $post);
?>

<?php
$attachments = cuar_get_the_attached_files($post->ID);
$attachment_count = count($attachments);
/* only one file per download */
$file = current($attachments);

$owner = preg_replace('/,(.*)/', '', cuar_get_the_owner());
?>

<tr>
  <td><?= get_the_date('d M Y') ?></td>
  <td><?= $owner ?></td>
  <td><?php the_field('investment'); ?></td>
  <td><?php the_title(); ?></td>
  <td><?php the_field('document_type') ?></td>
  <td class="cuar-actions">
    <a href="<?php cuar_the_attached_file_link($post->ID, $file); ?>" title="<?php esc_attr_e('Get file', 'cuar'); ?>"
      class="btn__download">
      <span class="fa fa-download"></span>
    </a>
  </td>
</tr>