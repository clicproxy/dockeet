<h1>Documents List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Description</th>
      <th>File</th>
      <th>Mime type</th>
      <th>Size</th>
      <th>Public</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($documents as $document): ?>
    <tr>
      <td><a href="<?php echo url_for('document/show?id='.$document->getId()) ?>"><?php echo $document->getId() ?></a></td>
      <td><?php echo $document->getTitle() ?></td>
      <td><?php echo $document->getDescription() ?></td>
      <td><?php echo $document->getFile() ?></td>
      <td><?php echo $document->getMimeType() ?></td>
      <td><?php echo $document->getSize() ?></td>
      <td><?php echo $document->getPublic() ?></td>
      <td><?php echo $document->getCreatedAt() ?></td>
      <td><?php echo $document->getUpdatedAt() ?></td>
      <td><?php echo $document->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('document/new') ?>">New</a>
