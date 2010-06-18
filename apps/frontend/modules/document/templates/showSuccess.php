<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $document->getId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $document->getTitle() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $document->getDescription() ?></td>
    </tr>
    <tr>
      <th>File:</th>
      <td><?php echo $document->getFile() ?></td>
    </tr>
    <tr>
      <th>Mime type:</th>
      <td><?php echo $document->getMimeType() ?></td>
    </tr>
    <tr>
      <th>Size:</th>
      <td><?php echo $document->getSize() ?></td>
    </tr>
    <tr>
      <th>Public:</th>
      <td><?php echo $document->getPublic() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $document->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $document->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $document->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('document/edit?id='.$document->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('document/index') ?>">List</a>
