(function ($) {
  window.RtclBPAS = {
    init: function init() {
      this.ShareOptions();
      this.customShare();
      this.activityShare();
    },
    ShareOptions: function ShareOptions() {
      $('body').on('click', '.rtcl-show-share-options', function (e) {
        e.preventDefault();
        var activity_id = $(this).attr('data-activity-id');
        var modal = new RtclModal({
          footer: false,
          wrapClass: 'heading bp-modal'
        });
        var data = {
          action: 'rtcl_bp_share_option',
          activity_id: activity_id,
          __rtcl_wpnonce: rtcl_bp.__rtcl_wpnonce
        };
        $.ajax({
          url: rtcl_bp.ajaxurl,
          data: data,
          type: 'POST',
          beforeSend: function beforeSend() {
            modal.addModal().addLoading();
          },
          success: function success(response) {
            modal.removeLoading();
            modal.addTitle(response.title);
            if (response.success) {
              modal.content(response.content);
            }
          },
          error: function error(e) {
            modal.removeLoading();
          }
        });
      });
    },
    activityShare: function activityShare() {
      $('body').on('click', '.rtcl-share-options-wrapper .share-to > span', function (event) {
        event.preventDefault();
        var that = $(this),
          parent = that.closest('.rtcl-share-options-wrapper'),
          act_id = parent.attr('activity-id'),
          // shared_text = parent.attr('shared-text'),
          share_to = that.attr('data-value'),
          group_id = that.attr('group-id'),
          share_with = parent.find('#share-type').val();
        if ('rtcl-share-custom' === share_with) {
          custom_text = parent.find('.rtcl-bp-custom-text').val();
        } else {
          custom_text = '';
        }
        var ajaxdata = {
          action: 'rtcl_bp_share_activity',
          act_id: act_id,
          share_to: share_to,
          group_id: group_id,
          __rtcl_wpnonce: rtcl_bp.__rtcl_wpnonce,
          custom_text: custom_text
        };
        $.ajax({
          url: rtcl_bp.ajaxurl,
          data: ajaxdata,
          type: 'POST',
          beforeSend: function beforeSend() {
            parent.parents('.rtcl-modal-content').addClass('loading');
          },
          success: function success(response) {
            if (response.success) {
              parent.find('.notification').show();
              parent.parents('.rtcl-modal-content').removeClass('loading');
            } else {
              parent.find('.notification').hide();
            }
          },
          error: function error(e) {
            parent.find('.notification').text('Error Occurred');
            parent.find('.notification').show();
          }
        });
        return false;
      });
    },
    customShare: function customShare() {
      $('body').on('change', '#share-type', function () {
        var that = $(this),
          parent = that.parent('.rtcl-share-options-wrapper'),
          custom_option_wrapper = parent.find('.rtcl-bp-custom-text'),
          social_share_wrapper = parent.find('.social-share-button'),
          social_share_heading = parent.find('.social-share-heading'),
          share_option = that.val();
        if ('rtcl-share-custom' === share_option) {
          custom_option_wrapper.removeClass('hide').addClass('show');
          social_share_wrapper.removeClass('show').addClass('hide');
          social_share_heading.removeClass('show').addClass('hide');
        } else {
          custom_option_wrapper.removeClass('show').addClass('hide');
          social_share_wrapper.removeClass('hide').addClass('show');
          social_share_heading.removeClass('hide').addClass('show');
        }
      });
    }
  };
  $(document).ready(function () {
    window.RtclBPAS.init();
  });
})(jQuery);
