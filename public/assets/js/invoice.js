window.initInvoice = function () {
  $('.search > input').off('keyup').on('keyup', function() {
      var rex = new RegExp($(this).val(), 'i');
      $('.nav .nav-item').hide();
      $('.nav .nav-item').filter(function() {
          return rex.test($(this).text());
      }).show();
  });

  $('[data-toggle="tooltip"]').tooltip({
      'template': '<div class="tooltip actions-btn-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
  });

  var $btns = $('.list-actions');
  $btns.off('click').on('click', function () {
      var getDataInvoiceAttr = $(this).attr('data-invoice-id');
      var getParentDiv = $(this).parents('.doc-container');
      var getParentInvListContainer = $(this).parents('.inv-list-container');

      var $el = $('.' + this.id).show();
      $('#ct > div').not($el).hide();
      getParentDiv.find('.invoice-inbox .inv-number').text('#' + getDataInvoiceAttr);
      getParentDiv.find('.invoice-inbox .invoice-header-section').css('display', 'flex');
      getParentDiv.find('.invoice-inbox #ct').css('display', 'block');
      getParentDiv.find('.invoice-inbox').css('height', 'calc(100vh - 122px)');
      getParentDiv.find('.invoice-inbox .inv-not-selected').css('display', 'none');
      getParentDiv.find('.invoice-container .inv--thankYou').css('display', 'block');

      if ($(this).parents('.tab-title').hasClass('open-inv-sidebar')) {
          $(this).parents('.tab-title').removeClass('open-inv-sidebar');
      }

      $btns.removeClass('active');
      $(this).addClass('active');

      var myDiv = document.getElementsByClassName('invoice-inbox')[0];
      if (myDiv) myDiv.scrollTop = 0;
  });

  $('.action-print').off('click').on('click', function (event) {
      event.preventDefault();
      window.print();
  });

  if (window.invPs1) window.invPs1.destroy();
  if (window.invPs2) window.invPs2.destroy();

  window.invPs1 = new PerfectScrollbar('.inv-list-container', { suppressScrollX: true });
  window.invPs2 = new PerfectScrollbar('.invoice-inbox', { suppressScrollX: true });

  if (window.innerWidth < 768) {
      window.invPs2.destroy();
  }

  $('.hamburger, .inv-not-selected p').off('click').on('click', function () {
      $('.doc-container').find('.tab-title').toggleClass('open-inv-sidebar');
  });
};
