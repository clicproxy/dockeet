<div id="title_box">
  <div id="title_left"></div>
  <div id="title_content">
    <h2><?php echo __('New document'); ?></h2>
  </div>
  <div id="title_right"></div>
</div>



<form method="post" enctype="multipart/form-data" action="<?php echo url_for('document/add'); ?>">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>

  <?php echo $form['file']->renderError(); ?>
  <?php echo $form['file']->renderLabel(); ?>
  <?php echo $form['file']; ?>
  <?php echo $form['document_category']['category_id']->renderError(); ?>
  <?php echo $form['document_category']['category_id']->renderLabel(); ?>
  <?php echo $form['document_category']['category_id']; ?>
  <input class="submit" type="submit" value="<?php echo __('Save'); ?>" />


  <div>
    <div id="filelist">No runtime found.</div>
    <br />
    <a id="pickfiles" href="#"><?php echo __('Select files'); ?></a>
    <a id="uploadfiles" href="#"><?php echo __('Upload files'); ?></a>
  </div>

</form>


<script>
$(document).ready( function ()
{
  var uploader = new plupload.Uploader({
    runtimes : 'gears,html5,flash,silverlight,browserplus',
    browse_button : 'pickfiles',
    max_file_size : '10mb',
    url : '<?php echo url_for("document/add"); ?>',
    unique_names : true,
    flash_swf_url : 'js/plupload.flash.swf',
    silverlight_xap_url : 'js/plupload.silverlight.xap',
    multipart: true,
    multipart_params: { 'document_category[category_id]': jQuery('select#document_category_category_id').val(),
    '_csrf_token': jQuery('input#csrf_token').val() }
  });

  uploader.bind('Init', function(up, params) {
    $('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
  });

  uploader.bind('FilesAdded', function(up, files) {
    $.each(files, function(i, file) {
      $('#filelist').append(
        '<div id="' + file.id + '">' +
        file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
      '</div>');
    });
  });

  uploader.bind('FileUploaded', function (up, file, r)
  {
    jQuery('body').append('<div>' + r.response + '</div>');
    //console.log(r.response);
  });

  uploader.bind('UploadProgress', function(up, file) {
    $('#' + file.id + " b").html(file.percent + "%");
  });

  $('#uploadfiles').click(function(e) {
    uploader.start();
    e.preventDefault();
  });

  uploader.init();
});
</script>