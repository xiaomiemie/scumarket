define(['jquery'], function($) {
  function validateForm(opts) {};
  validateForm.prototype.requireText = function(el) {
    var val = el.val();
    if (val != '') {
      el.parent().parent().removeClass('has-error');
      return true;
    } else {
      el.parent().parent().addClass('has-error');
      return false;
    }
  };
  validateForm.prototype.requireCheck = function(el) {
    if (el.is(':checked')) {
      return true
    } else {
      return false;
    }
  };
  validateForm.prototype.regex = function(obj) {
    var el = obj.el;
    var val = el.val();
    // var reg = obj.reg;
    var flag = obj.reg.test(val);
    if (flag == false) {
      el.parent().parent().addClass('has-error');
    } else {
      el.parent().parent().removeClass('has-error');
    }
    return flag;
  };
  validateForm.prototype.checkEqual = function(el1, el2) {
    if (el1.val() == el2.val()) {
      return true;
    } else {
      el1.parent().parent().addClass('has-error');
      el2.parent().parent().addClass('has-error');
      return false;
    }
  };
  validateForm.prototype.lenlimit = function(obj) {
    var len = obj.len;
    var el = obj.el;
    if (el.val()) {
      var l = (el.val().length);
      if (0 < l && l < len) {
        el.parent().parent().removeClass('has-error');
        return true;
      }
    } else {
      el.parent().parent().addClass('has-error');
      return false;
    }
  }
  validateForm.prototype.keyupLimit = function(obj) {
    var el1 = obj.el1;
    var el2 = obj.el2;
    var len = obj.len;
    el1.on('keyup', function() {
      var l = el1.val().length;
      if (l <= len) {
        el2.html(len - l);
      } else {
        el1.val(el1.val().substring(0, len))
      }
    })
  };


  validateForm.DEFAULTS = {};
  return {
    validateForm: validateForm
  }
})