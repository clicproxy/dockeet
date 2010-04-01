<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo __('New document'); ?></h2>
  </div>
  <div id="title_bottom"></div>
</div>

  <div>
    <div id="filelist">No runtime found.</div>
    <br />
    <a id="pickfiles" href="#"><?php echo __('Select files'); ?></a>
    <a id="uploadfiles" href="#"><?php echo __('Upload files'); ?></a>
  </div>

<script>
$(document).ready( function ()
{
  var uploader = new plupload.Uploader({
    runtimes : 'gears,html5,flash,silverlight,browserplus',
    browse_button : 'pickfiles',
    max_file_size : '10mb',
    url : '<?php echo url_for("document/add?category_slug=" . $category->slug); ?>',
    unique_names : true,
    flash_swf_url : 'js/plupload.flash.swf',
    silverlight_xap_url : 'js/plupload.silverlight.xap',
    multipart: true,
    multipart_params: { '_csrf_token': '<?php echo $form->getCSRFToken(); ?>' }
  });

  uploader.bind('Init', function(up, params) {
    if (0 != params.runtime.length)
    {
  	  $('#filelist').html("");
    }
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
	  $('#' + file.id + " b").after(r.response);
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