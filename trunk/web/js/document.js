DocumentCtrl = function ()
{
  /**
   * Add into a category
   * @param form
   * @return
   */
  this.addCategory = function(form)
  {
    jQuery.post(jQuery(form).attr('action'), jQuery(form).serialize(), function(data) { jQuery('div#document_categories').html(data) });
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
};

var documentCtrl = new DocumentCtrl();