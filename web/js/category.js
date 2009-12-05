CategoryCtrl = function ()
{
  /**
   * Add a user
   * @param form
   * @return
   */
  this.addUser = function(form)
  {
    jQuery.post(jQuery(form).attr('action'), jQuery(form).serialize(), function(data) { jQuery('div#category_users').html(data) });
  };
  
  /**
   * Remove a user
   * @param link
   * @return
   */
  this.removeUser = function (link)
  {
    jQuery.get(jQuery(link).attr('href'), {}, function(data) { jQuery('div#category_users').html(data) });
  };
};

var categoryCtrl = new CategoryCtrl();