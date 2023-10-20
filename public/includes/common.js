
function toasterOptions() {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "100",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "show",
        "hideMethod": "hide"
    };
};

 toasterOptions();
 
/*
* function for notify 
*/

function notify(msg, msgtype) {
    swal({
        type: msgtype,
        title: msg,
        text: ''
    });
}

/*
*function for notify successs 

*/

function redirect_notify(msg, subtext, redirect,msgtype) {
    swal({
    type: msgtype,
        title: msg,
        text: subtext,
        timer: 3000,  
    allow_dismiss: false,
        onOpen: function onOpen() {
            swal.showLoading();
        }
    }).then(function(result) {
        if (redirect == '') {
            // location.reload();
        } else {
            // window.location.href = redirect;
        }
    });
}

 

 $("#formvalidate").click(function(e)
{
    var formname = $(this).attr("data-form");
    $('#'+formname).validate();
    if($('#'+formname).valid())
    {
        $('#'+formname).submit();
        return false;
    }
    else
    {
        return false
    }
});


//Validate email

function isValidEmailAddress(emailAddress) {

    emailAddress = emailAddress.toLowerCase();

    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

    return pattern.test(emailAddress);

}

// var base_url = window.location.origin+'/';



 
 /** add active class and stay opened when selected */
// var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.metismenu a').filter(function() {
    $('ul.metismenu li').removeClass('active');
	 return this.href == url;
}).parent().addClass('active');

// for treeview
$('ul.collapse  li').filter(function() {
	 return this.href == url;
}).closest('ul.collapse  li').addClass('active');


$(document).ready(function () {
           // $('.popovers').popover();
           $(".popovers").popover({
                trigger: "manual",
                html: true,
                animation: false
              })
              .on("mouseenter", function() {
                var _this = this;
                $(this).popover("show");
                $(".popover").on("mouseleave", function() {
                  $(_this).popover('hide');
                });
              }).on("mouseleave", function() {
                var _this = this;
                //setTimeout(function() {
                  if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                  }
              //  }, 500);
              }); 
            
        });

//

/***
    
$.fn.extend({
  treed: function() {
    return this.each(function() {
      //initialize each of the top levels
      var tree = $(this);
      tree.addClass("tree");
      tree.find('li').has("ul").each(function() {
        var branch = $(this); //li with children ul
        branch.prepend("<i class='indicator fa fa-plus-square-o'></i>");
        branch.addClass('branch');
        branch.on('click', function(e) {
          if (this == e.target) {
            var icon = $(this).children('i:first');
            icon.toggleClass("fa-minus-square-o fa-plus-square-o");
            $(this).children().children().toggle();
          }
        })
        branch.children().children().toggle();
      });
      //fire event from the dynamically added icon
      $('.branch .indicator').on('click', function() {
        $(this).closest('li').click();
      });
      //fire event to open branch if the li contains an anchor instead of text
      $('.branch a').on('click', function(e) {
        $(this).closest('li').click();
        e.preventDefault();
      });
      //fire event to open branch if the li contains a button instead of text
      $('.branch button').on('click', function(e) {
        $(this).closest('li').click();
        e.preventDefault();
      });
    });
  }
});

$('.tree').treed();

****/

$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});
/*
$('input[name="options"]').on('click', function () {
   $(this).toggleClass('active').siblings().removeClass('active');
});
*/

/* ========================================================================
 * Bootstrap: button.js v3.3.6
 * https://getbootstrap.com/javascript/#buttons
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

+

function($) {
  'use strict';

  // BUTTON PUBLIC CLASS DEFINITION
  // ==============================

  var Button = function(element, options) {
    this.$element = $(element)
    this.options = $.extend({}, Button.DEFAULTS, options)
    this.isLoading = false
  }

  Button.VERSION = '3.3.6'

  Button.DEFAULTS = {
    loadingText: 'loading...'
  }

  Button.prototype.setState = function(state) {
    var d = 'disabled'
    var $el = this.$element
    var val = $el.is('input') ? 'val' : 'html'
    var data = $el.data()

    state += 'Text'

    if (data.resetText == null) $el.data('resetText', $el[val]())

    // push to event loop to allow forms to submit
    setTimeout($.proxy(function() {
      $el[val](data[state] == null ? this.options[state] : data[state])

      if (state == 'loadingText') {
        this.isLoading = true
        $el.addClass(d).attr(d, d)
      } else if (this.isLoading) {
        this.isLoading = false
        $el.removeClass(d).removeAttr(d)
      }
    }, this), 0)
  }

  Button.prototype.toggle = function() {
    var changed = true
    var $parent = this.$element.closest('[data-toggle="buttons"]')

    if ($parent.length) {
      var $input = this.$element.find('input')
      if ($input.prop('type') == 'radio') {
        if ($input.prop('checked')) changed = false
        $parent.find('.active').removeClass('active')
        this.$element.addClass('active')
      } else if ($input.prop('type') == 'checkbox') {
        if (($input.prop('checked')) !== this.$element.hasClass('active')) changed = false
        this.$element.toggleClass('active')
      }
      $input.prop('checked', this.$element.hasClass('active'))
      if (changed) $input.trigger('change')
    } else {
      this.$element.attr('aria-pressed', !this.$element.hasClass('active'))
      this.$element.toggleClass('active')
    }
  }

  // BUTTON PLUGIN DEFINITION
  // ========================

  function Plugin(option) {
    return this.each(function() {
      var $this = $(this)
      var data = $this.data('bs.button')
      var options = typeof option == 'object' && option

      if (!data) $this.data('bs.button', (data = new Button(this, options)))

      if (option == 'toggle') data.toggle()
      else if (option) data.setState(option)
    })
  }

  var old = $.fn.button

  $.fn.button = Plugin
  $.fn.button.Constructor = Button

  // BUTTON NO CONFLICT
  // ==================

  $.fn.button.noConflict = function() {
    $.fn.button = old
    return this
  }

  // BUTTON DATA-API
  // ===============

  $(document)
    .on('click.bs.button.data-api', '[data-toggle^="button"]', function(e) {
      var $btn = $(e.target)
      if (!$btn.hasClass('btn')) $btn = $btn.closest('.btn')
      Plugin.call($btn, 'toggle')
      if (!($(e.target).is('input[type="radio"]') || $(e.target).is('input[type="checkbox"]')))

        e.preventDefault()
    })
    .on('focus.bs.button.data-api blur.bs.button.data-api', '[data-toggle^="button"]',

      function(e) {
        $(e.target).closest('.btn').toggleClass('focus', /^focus(in)?$/.test(e.type))
      })

}(jQuery);


CKEDITOR.replace( 'details' );
$(function () {
  $(".datepicker").datepicker({ 
      format: 'yyyy-m-d',
        autoclose: true, 
        todayHighlight: true
  }).datepicker();
});

$(function () {
  $(".datepicker1").datepicker({ 
      format: 'yyyy-m-d',
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});





