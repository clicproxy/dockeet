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
    <div class="bt_expand_global">
    	<span class="bt_expand_left"></span>
    	<a id="pickfiles" class="bt_expand" href="#"><?php echo __('Select files'); ?></a>
    </div>
    <div class="bt_expand_global">
    	<span class="bt_expand_left"></span>
    	<a id="uploadfiles" class="bt_expand" href="#"><?php echo __('Upload files'); ?></a>
    </div>
  </div>

<script>
$(document).ready( function ()
{
  var uploader = new plupload.Uploader({
    runtimes : 'gears,html5,flash,silverlight,browserplus',
    browse_button : 'pickfiles',
    max_file_size : '30mb',
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
        '<div class="border_style" id="' + file.id + '">' +
        file.name + ' <span>(' + plupload.formatSize(file.size) + ')</span> <strong class="border_stylehover"></strong>' +
      '</div>');
    });
  });

  uploader.bind('FileUploaded', function (up, file, r)
  {
	  $('#' + file.id + " strong").after(r.response);
  });

  uploader.bind('UploadProgress', function(up, file) {
    $('#' + file.id + " strong").html(file.percent + "%");
  });

  $('#uploadfiles').click(function(e) {
    uploader.start();
    e.preventDefault();
  });

  uploader.init();
});
</script>