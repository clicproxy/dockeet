DocumentCtrl = function ()
{
  /**
   * Add into a category
   * @param form
   * @return
   */
  this.addCategory = function(category_id)
  {
	jQuery('input#document_document_category_category_id').val(category_id);
    jQuery.post(jQuery('form#form_add_category').attr('action'), jQuery('form#form_add_category').serialize(), function(data) { jQuery('div#document_categories').html(data) });
  };
  
  /**
   * Remove from a category
   * @param link
   * @return
   */
  this.removeCategory = function (link)
  {
    jQuery.get(jQuery(link).attr('href'), {}, function(data) { jQuery('div#document_categories').html(data) });
  };
  
  this.addTag = function (link)
  {
    jQuery.get(jQuery(link).attr('href'), {}, function(data) { jQuery('div#document_tags').html(data) });
  };
  
  this.removeTag = function (link)
  {
    // TODO
  };
};

var documentCtrl = new DocumentCtrl();