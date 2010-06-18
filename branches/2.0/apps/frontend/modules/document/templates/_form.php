<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('document/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('document/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'document/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['file']->renderLabel() ?></th>
        <td>
          <?php echo $form['file']->renderError() ?>
          <?php echo $form['file'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['mime_type']->renderLabel() ?></th>
        <td>
          <?php echo $form['mime_type']->renderError() ?>
          <?php echo $form['mime_type'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['size']->renderLabel() ?></th>
        <td>
          <?php echo $form['size']->renderError() ?>
          <?php echo $form['size'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['public']->renderLabel() ?></th>
        <td>
          <?php echo $form['public']->renderError() ?>
          <?php echo $form['public'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['slug']->renderLabel() ?></th>
        <td>
          <?php echo $form['slug']->renderError() ?>
          <?php echo $form['slug'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['categories_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['categories_list']->renderError() ?>
          <?php echo $form['categories_list'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['tags_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['tags_list']->renderError() ?>
          <?php echo $form['tags_list'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['users_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['users_list']->renderError() ?>
          <?php echo $form['users_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
