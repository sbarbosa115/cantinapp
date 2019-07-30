import $ from 'jquery';
const touch = false; const clickEv = 'click'; const checkDropdown = []; const
  checkSideMenu = [];

/* slideshow */
function sliderRevolution() {
  let slideshow;
  jQuery(document).ready(() => {
    slideshow = jQuery('.home-slideshow-content').css('visibility', 'visible').show().revolution({
      delay: 5000,
      startwidth: 1920,
      startheight: 801,
      autoHeight: 'on',
      navigationArrows: 'solo',
      fullWidth: 'on',
      fullScreen: 'off',
      stopAfterLoops: -1,
      stopAtSlide: -1,
      forceFullWidth: 'off',
      fullScreenOffsetContainer: '',
      lazyLoad: 'on',
    });
  });
}
/* slider product */
function sliderProduct() {
  /* Home1 */
  /* slides block products */
  if ($('.home-banslider-content').length) {
    $('.home-banslider-content').owlCarousel({
      navigation: true,
      pagination: false,
      autoPlay: false,
      items: 3,
      slideSpeed: 200,
      paginationSpeed: 800,
      rewindSpeed: 1000,
      itemsDesktop: [1200, 3],
      itemsTablet: [992, 3],
      itemsTabletSmall: [768, 3],
      itemsMobile: [425, 2],
    });
  }
  if ($('#gallery_main_qs .qs-vertical-slider').length) {
    $('#gallery_main_qs .qs-vertical-slider').owlCarousel({
      navigation: true,
      pagination: false,
      items: 3,
      slideSpeed: 200,
      paginationSpeed: 800,
      rewindSpeed: 1000,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 2],
      itemsTablet: [768, 2],
      itemsTabletSmall: [540, 1],
      itemsMobile: [360, 1],
      navigationText: ['<i class="fa fa-angle-left" title="Previous" data-toggle="tooltip" data-placement="top"></i>', '<i class="fa fa-angle-right" title="Next" data-toggle="tooltip" data-placement="top"></i>'],
    });
  }

  if ($('#gallery_main_qs-quick .qs-vertical-slider').length) {
    $('#gallery_main_qs-quick .qs-vertical-slider').owlCarousel({
      navigation: true,
      pagination: false,
      items: 3,
      slideSpeed: 200,
      paginationSpeed: 800,
      rewindSpeed: 1000,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 2],
      itemsTablet: [768, 2],
      itemsTabletSmall: [540, 1],
      itemsMobile: [360, 1],
      navigationText: ['<i class="fa fa-angle-left" title="Previous" data-toggle="tooltip" data-placement="top"></i>', '<i class="fa fa-angle-right" title="Next" data-toggle="tooltip" data-placement="top"></i>'],
    });
  }

  if ($('#product #featuted-image-mobile').length) {
    $('#product #featuted-image-mobile').owlCarousel({
		  navigation: true,
		  pagination: true,
		  autoPlay: false,
		  items: 1,
		  slideSpeed: 200,
		  paginationSpeed: 800,
		  rewindSpeed: 1000,
		  itemsDesktop: [1199, 1],
		  itemsDesktopSmall: [979, 1],
		  itemsTablet: [768, 1],
		  itemsTabletSmall: [540, 1],
		  itemsMobile: [360, 1],
    });
  }
  /* Slider Thumb */
  if ($('.slider-3itemsc').length) {
    $('.slider-3itemsc').owlCarousel({
		  navigation: true,
		  pagination: false,
		  autoPlay: false,
		  items: 3,
		  slideSpeed: 200,
		  paginationSpeed: 800,
		  rewindSpeed: 1000,
		  itemsDesktop: [1199, 3],
		  itemsDesktopSmall: [979, 3],
		  itemsTablet: [768, 3],
		  itemsTabletSmall: [767, 1],
		  itemsMobile: [360, 1],
    });
  }
  $('.show-load-detail').css('display', 'none');

  /* Slider Relatedpro */
  if ($('.related-products .rp-slider').length) {
    $('.related-products .rp-slider').owlCarousel({
      navigation: true,
      pagination: false,
      items: 3,
      slideSpeed: 200,
      paginationSpeed: 800,
      rewindSpeed: 1000,
      itemsDesktop: [1920, 3],
      itemsDesktopSmall: [1200, 3],
      itemsTablet: [1199, 2],
      itemsTabletSmall: [991, 1],
      itemsMobile: [767, 2],
    });
  }

  if ($('.may-like-content').length) {
    $('.may-like-content').owlCarousel({
      navigation: true,
      pagination: false,
      items: 3,
      slideSpeed: 200,
      paginationSpeed: 800,
      rewindSpeed: 1000,
      itemsDesktop: [1920, 3],
      itemsDesktopSmall: [1200, 3],
      itemsTablet: [1199, 2],
      itemsTabletSmall: [991, 1],
      itemsMobile: [767, 2],
    });
  }
}

/* slider product */
function sliderBlog() {
  if ($('.related-blog-slider').length) {
    $('.related-blog-slider').owlCarousel({
      navigation: true,
      pagination: false,
      autoPlay: false,
      items: 1,
      slideSpeed: 200,
      paginationSpeed: 800,
      rewindSpeed: 1000,
      itemsDesktop: [1199, 1],
      itemsDesktopSmall: [991, 1],
      itemsTablet: [767, 1],
      itemsTabletSmall: [540, 1],
      itemsMobile: [360, 1],
    });
  }
}

/* Handle dropdown box */
function handleDropdown() {
  const changeIconMenu = function () {
    $('.group_navbtn .dropdown-toggle-navigation').find('.cs-icon').attr('class', 'cs-icon icon-menu');
    $('.group_navbtn .dropdown-toggle-navigation').removeClass('active-dropdown');
    $('.group_navbtn .navigation_dropdown_scroll').removeClass('hover-dropdown');
  };
  const closeDropdownCart = function () {
    $('.close-dropdown').on('click', function () {
      $(this).parents('.m_cart-group').find('.dropdown-menu').hide();
      $(this).parents('.m_cart-group').find('.dropdownMobile-toggle').removeClass('active-dropdown');
      $('.show-opacity-dropdown').removeClass('active');
    });
  };
  const changeIcon = function () {
    $('.dropdownMobile-toggle').each(function (index) {
      $(this).parent().find('.dropdown-menu').hide();
      $(this).removeClass('active-dropdown');
      const icon_class = $(this).find('.icon-dropdown').data('class');
      $(this).find('.icon-dropdown').attr('class', `icon-dropdown ${icon_class}`);
    });
  };

  const dropdownDesktop = function () {
    if ($('.dropdown-toggle').length) {
      $('.dropdown-menu').on({
        mouseleave() {
          $(this).slideUp(300);
        },
      });
      $('.dropdown-toggle').parent().on({
        mouseenter() {
          if (touch == false && getWidthBrowser() > 767) {
            $(this).find('.dropdown-menu').stop(true, true).slideDown(300);
          }
        },
        mouseleave() {
          if (touch == false && getWidthBrowser() > 767) {

          }
        },
      });
    }
  };

  const dropdownTablet = function () {
    if ($('.dropdownMobile-toggle').length) {
      $('.dropdownMobile-toggle').on('click', function () {
        if (!$(this).hasClass('active-dropdown')) {
          changeIcon();
          changeIconMenu();
          $('body').addClass('active-overflow');
          $(this).parent().find('.dropdown-menu').stop(true, true)
            .slideDown(300);
          $(this).addClass('active-dropdown');
          $(this).find('.icon-dropdown').attr('class', 'icon-dropdown cs-icon icon-close');
        } else {
          $('body').removeClass('active-overflow');
          changeIcon();
        }
      });
    }
  };
  $('nav .dropdown-menu').each(function () {
    $(this).find('li').last().addClass('last');
  });
  $('.dropdown').on('click', function () {
    if (touch == false && getWidthBrowser() > 767) {
      const href = $(this).find('.dropdown-link').attr('href');
      window.location = href;
    }
  });
  closeDropdownCart();
  dropdownDesktop();
  dropdownTablet();
}

/* Fucntion get width browser */
function getWidthBrowser() {
  let myWidth;

  if (typeof (window.innerWidth) === 'number') {
    // Non-IE
    myWidth = window.innerWidth;
    // myHeight = window.innerHeight;
  } else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
    // IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    // myHeight = document.documentElement.clientHeight;
  } else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
    // IE 4 compatible
    myWidth = document.body.clientWidth;
    // myHeight = document.body.clientHeight;
  }

  return myWidth;
}

// handle scroll-to-top button
function handleScrollTop() {
  function totop_button(a) {
    const b = $('#scroll-to-top');
    const f = $('.cart-float-right');

    if (a == 'on') {
      f.addClass('on fadeInRight ').removeClass('off fadeOutRight');
      b.addClass('on fadeInRight ').removeClass('off fadeOutRight');
    } else {
      f.addClass('off fadeOutRight animated').removeClass('on fadeInRight');
      b.addClass('off fadeOutRight animated').removeClass('on fadeInRight');
    }
  }
  $(window).scroll(function () {
    const b = $(this).scrollTop();
    const c = $(this).height();
    if (b > 0) {
      var d = b + c / 2;
    } else {
      var d = 1;
    }
    if (d < 1e3 && d < c) {
      totop_button('off');
    } else {
      totop_button('on');
    }
  });
  $('#scroll-to-top').on('click', (e) => {
    e.preventDefault();
    $('body,html').animate({
      scrollTop: 0,
    }, 800, 'swing');
  });
}

// newsletter popup
function ModalNewsletter() {
  $('#newsletter-popup').modal('toggle');
  $('.nl-wraper-popup').addClass('animated');
  const tnout = 20;
  setTimeout(() => {
    $('#newsletter-popup').modal('hide');
  }, tnout * 1000);
}

/* Handle product quantity */
function handleQuantity() {
  if ($('.quantity-wrapper').length) {
    $('.quantity-wrapper').on(clickEv, '.qty-up', function () {
      const $this = $(this);

      const qty = $this.parents('.wrapper').find('input');
      $(qty).val(parseInt($(qty).val()) + 1);
    });
    $('.quantity-wrapper').on(clickEv, '.qty-down', function () {
      const $this = $(this);
      const qty = $this.parents('.wrapper').find('input');

      if (parseInt($(qty).val()) > 1) $(qty).val(parseInt($(qty).val()) - 1);
    });
  }
}

function toggleTagsFilter() {
  if (window.innerWidth >= 768) {
    const tagsbutton = document.getElementById('showTagsFilter');
    const tagscontent = document.getElementById('tags-filter-content');
    if (tagsbutton != null) {
      tagsbutton.onclick = function () {
        classie.toggle(this, 'closed');
        classie.toggle(tagscontent, 'tags-closed');
        if (classie.has(this, 'closed')) $('#showTagsFilter').html("Filter <i class='fa fa-angle-down'></i>");
        else $('#showTagsFilter').html("Filter <i class='fa fa-angle-up'></i>");
      };
    }
  }
}

/* Function update scroll product thumbs */
function updateScrollThumbsQS() {
  if ($('#gallery_main_qs').length) {
    $('#quick-shop-image .fancybox').on(clickEv, () => {
      const _items = [];
      let _index = 0;
      const product_images = $('#gallery_main_qs .image-thumb a');
      product_images.each(function (key, val) {
        _items.push({ href: val.href, title: val.title });
        if ($(this).hasClass('active')) {
          _index = key;
        }
      });
      $.fancybox(_items, {
        closeBtn: true,
        index: _index,
        helpers: {
          buttons: {},
        },
      });
      return false;
    });

    $('#quick-shop-image').on(clickEv, '.image-thumb a', function () {
      const $this = $(this);
      const background = $('.product-image .main-image .main-image-bg');
      const parent = $this.parents('.product-image-wrapper');
      const src_original = $this.attr('data-image-zoom');
      const src_display = $this.attr('data-image');

      background.show();

      parent.find('.image-thumb').removeClass('active');
      $this.parent().addClass('active');

      parent.find('.main-image').find('img').attr('data-zoom-image', src_original);
      parent.find('.main-image').find('img').attr('src', src_display).load(() => {
        background.hide();
      });

      return false;
    });
  }

  if ($('#gallery_main_qs-quick').length) {
    $('#quick-shop-image .fancybox').on(clickEv, () => {
      const _items = [];
      let _index = 0;
      const product_images = $('#gallery_main_qs-quick .image-thumb a');
      product_images.each(function (key, val) {
        _items.push({ href: val.href, title: val.title });
        if ($(this).hasClass('active')) {
          _index = key;
        }
      });
      $.fancybox(_items, {
        closeBtn: true,
        index: _index,
        helpers: {
          buttons: {},
        },
      });
      return false;
    });

    $('#quick-shop-image').on(clickEv, '.image-thumb a', function () {
      const $this = $(this);
      const background = $('.product-image .main-image .main-image-bg');
      const parent = $this.parents('.product-image-wrapper');
      const src_original = $this.attr('data-image-zoom');
      const src_display = $this.attr('data-image');

      background.show();

      parent.find('.image-thumb').removeClass('active');
      $this.parent().addClass('active');

      parent.find('.main-image').find('img').attr('data-zoom-image', src_original);
      parent.find('.main-image').find('img').attr('src', src_display).load(() => {
        background.hide();
      });

      return false;
    });
  }
}

// Change Quantity Quick Show
function change_qs_quantity(qs) {
  qs_quantity = qs;
}

function showMenuMobile() {
  const changeIconRight = function () {
    $('.dropdownMobile-toggle').each(function (index) {
      $(this).parent().find('.dropdown-menu').hide();
      $(this).removeClass('active-dropdown');
      const icon_class = $(this).find('.icon-dropdown').data('class');
      $(this).find('.icon-dropdown').attr('class', `icon-dropdown ${icon_class}`);
    });
  };
  const changeIcon = function () {
    $('.navigation_mobile .arrow').removeClass('class_test');
    $('.navigation_mobile .arrow i').attr('class', 'arrow-plus');
    $('.navigation_mobile').removeClass('active');
    $('.navigation_mobile .menu-mobile-container').hide('slow');
  };
  const showMenu = function () {
    $('.group_navbtn .dropdown-toggle-navigation').on('click', function () {
      if ($(this).hasClass('active-dropdown')) {
        $(this).find('.cs-icon').attr('class', 'cs-icon icon-menu');
        $(this).removeClass('active-dropdown');
        $(this).parent().find('.navigation_dropdown_scroll').removeClass('hover-dropdown');
      } else {
        changeIconRight();
        $(this).find('.cs-icon').attr('class', 'cs-icon icon-close');
        $(this).addClass('active-dropdown');
        $(this).parent().find('.navigation_dropdown_scroll').addClass('hover-dropdown');
      }
    });
  };
  const showMegaMenu = function () {
    $('.navigation_mobile .arrow').on('click', function () {
      if ($(this).hasClass('class_test')) {
        $(this).removeClass('class_test');
        $(this).find('i').attr('class', 'arrow-plus');
        $(this).parent().removeClass('active');
        $(this).parent().find('.menu-mobile-container').hide('slow');
      } else {
        changeIcon();
        $(this).addClass('class_test');
        $(this).find('i').attr('class', 'arrow-minus');
        $(this).parent().addClass('active');
        $(this).parent().find('.menu-mobile-container').show('slow');
      }
    });
  };
  const showSubMenu = function () {
    $('.navigation_sub_mobile .arrow_sub_mobile').on('click', function () {
      if ($(this).hasClass('class_test')) {
        $(this).removeClass('class_test');
        $(this).find('i').attr('class', 'arrow-plus');
        $(this).parent().removeClass('active');
        $(this).parent().find('.sub-menu-mobile-container').hide('slow');
      } else {
        $(this).addClass('class_test');
        $(this).find('i').attr('class', 'arrow-minus');
        $(this).parent().addClass('active');
        $(this).parent().find('.sub-menu-mobile-container').first()
          .show('slow');
      }
    });
  };
  showMenu();
  showMegaMenu();
  showSubMenu();
}

function showItemMobile() {
  $('.item-dropdown-mobile .btn-group').on('click', '.dropdown-toggle', function () {
    $('.item-dropdown-mobile .dropdown-menu').css('display', 'none');

    if ($(this).hasClass('active_popup')) {
      $(this).removeClass('active_popup');
    } else {
      $('.item-dropdown-mobile .dropdown-toggle').removeClass('active_popup');
      $(this).addClass('active_popup');
      $('.item-dropdown-mobile').each(function () {
        if ($(this).find('.dropdown-toggle').hasClass('active_popup')) {
          $(this).find('.dropdown-menu').css('display', 'block');
        }
      });
    }
  });
}

function showPassword() {
  $('.form-password .cs-icon').on(clickEv, function () {
    if ($(this).hasClass('show-pass')) {
      $(this).parent().find('input').attr('type', 'password');
      $(this).removeClass('show-pass');
    } else {
      $(this).parent().find('input').attr('type', 'text');
      $(this).addClass('show-pass');
    }
  });
}

function sidebarBlog() {
  $('.sidebar-block .sidebar-title').on(clickEv, '.cs-icon', function () {
    if ($(this).hasClass('show-content')) {
      $(this).parents('.sidebar-block').find('.sidebar-content').show('slow');
      $(this).attr('class', 'cs-icon icon-minus');
    } else {
      $(this).parents('.sidebar-block').find('.sidebar-content').hide('slow');
      $(this).attr('class', 'show-content cs-icon icon-plus');
    }
  });
}

function tagFilterCollection() {
  const activeFilterMobile = function () {
    $('.filter-mobile .filter-icon').on(clickEv, function () {
      if ($(this).hasClass('active-filter')) {
        $(this).find('.cs-icon').attr('class', 'cs-icon icon-filter');
        $('.collection-leftsidebar').removeClass('active-sidebar');
      	$(this).removeClass('active-filter');
      } else {
        $(this).find('.cs-icon').attr('class', 'cs-icon icon-close');
        $('.collection-leftsidebar').addClass('active-sidebar');
        $(this).addClass('active-filter');
      }
    });
  };
  const clearFilterMobile = function () {
    $('.collection-leftsidebar .sidebarMobile-clear').on(clickEv, () => {
      $('#collection .collection-leftsidebar').removeClass('active-sidebar');
	  $('.filter-mobile .filter-icon .cs-icon').attr('class', 'cs-icon icon-filter');
	  $('.filter-mobile .filter-icon').removeClass('active-filter');
    });
  };
  const applyFilterMobile = function () {
    $('.sidebar-bottom .sidebarMobile-close').on(clickEv, () => {
      $('.collection-leftsidebar').removeClass('active-sidebar');
	  $('.filter-mobile .filter-icon .cs-icon').attr('class', 'cs-icon icon-filter');
	  $('.filter-mobile .filter-icon').removeClass('active-filter');
    });
  };

  activeFilterMobile();
  clearFilterMobile();
  applyFilterMobile();
}

function handleAnimate() {
  $('[data-animate]').each(function () {
    const $toAnimateElement = $(this);

    const toAnimateDelay = $(this).attr('data-delay');

    let toAnimateDelayTime = 0;

    if (toAnimateDelay) { toAnimateDelayTime = Number(toAnimateDelay); } else { toAnimateDelayTime = 200; }

    if (!$toAnimateElement.hasClass('animated')) {
      $toAnimateElement.addClass('not-animated');

      const elementAnimation = $toAnimateElement.attr('data-animate');

      $toAnimateElement.appear(() => {
        setTimeout(() => {
          $toAnimateElement.removeClass('not-animated').addClass(`${elementAnimation} animated`);
        }, toAnimateDelayTime);
      }, { accX: 0, accY: -100 }, 'easeInCubic');
    }
  });
}

function showWishListCompare() {
  $('a.wishlist').on('click', (e) => {
    e.preventDefault();
    $('#modalwishlist1').modal();
  });
  $('a.compare').on('click', (e) => {
    e.preventDefault();
    $('#modalCompare').modal();
  });
}

function pageLookbook() {
  $('.group-img-1').fb({
    transitionIn: 'elastic',
    transitionOut: 'elastic',
    maxHeight: 800,
    speedIn: 600,
    speedOut: 200,
    helpers: {
      overlay: {
        css: {
          background: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  });
  $('.group-img-2').fb({
    transitionIn: 'elastic',
    transitionOut: 'elastic',
    maxHeight: 800,
    speedIn: 600,
    speedOut: 200,
    helpers: {
      overlay: {
        css: {
          background: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  });
  $('.group-img-3').fb({
    transitionIn: 'elastic',
    transitionOut: 'elastic',
    maxHeight: 800,
    speedIn: 600,
    speedOut: 200,
    helpers: {
      overlay: {
        css: {
          background: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  });
  $('.group-img-4').fb({
    transitionIn: 'elastic',
    transitionOut: 'elastic',
    maxHeight: 800,
    speedIn: 600,
    speedOut: 200,
    helpers: {
      overlay: {
        css: {
          background: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  });
  $('.group-img-5').fb({
    transitionIn: 'elastic',
    transitionOut: 'elastic',
    maxHeight: 800,
    speedIn: 600,
    speedOut: 200,
    helpers: {
      overlay: {
        css: {
          background: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  });
  $('.group-img-6').fb({
    transitionIn: 'elastic',
    transitionOut: 'elastic',
    maxHeight: 800,
    speedIn: 600,
    speedOut: 200,
    helpers: {
      overlay: {
        css: {
          background: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  });
  $('.lookbook-item .item').owlCarousel({
    navigation: false,
    pagination: false,
    autoPlay: false,
    items: 1,
    slideSpeed: 200,
    paginationSpeed: 800,
    rewindSpeed: 1000,
    itemsDesktop: [1199, 1],
    itemsDesktopSmall: [991, 1],
    itemsTablet: [767, 1],
    itemsTabletSmall: [540, 1],
    itemsMobile: [360, 1],
  });
  $('.home-gallery-lookbook').fb({
    transitionIn: 'elastic',
    transitionOut: 'elastic',
    maxHeight: 800,
    speedIn: 600,
    speedOut: 200,
    helpers: {
      overlay: {
        css: {
          background: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  });
}

function handleGridList() {
  if ($('#goList').length) {
    $('#goList').on(clickEv, function (e) {
      $(this).parent().find('li').removeClass('active');
      $(this).addClass('active');
      $('.collection-items').addClass('listMode');
      $('.collection-items').removeClass('gridMode');
      $('.collection-items .row-left').addClass('col-md-5');
      $('.collection-items .row-right').addClass('col-md-7');
      $('.collection-items .product-item').removeClass('col-sm-3 col-sm-4');
      $('.grid-mode').addClass('hide');
      $('.list-mode').removeClass('hide');
    });
  }
  if ($('#goGrid').length) {
    $('#goGrid').on(clickEv, function (e) {
      $(this).parent().find('li').removeClass('active');
      $(this).addClass('active');
      $('.collection-items').removeClass('listMode');
      $('.collection-items').addClass('gridMode');
      $('.collection-items .row-left').removeClass('col-md-5');
      $('.collection-items .row-right').removeClass('col-md-7');

      $('.collection-items .product-item').addClass('col-sm-4');

      $('.grid-mode').removeClass('hide');
      $('.list-mode').addClass('hide');
    });
  }
}

function showTooltip() {
  $('[data-toggle="tooltip"]').tooltip();
}

$(window).on('ready', ($) => {
  sliderRevolution();

  handleGridList();

  //pageLookbook();

  showWishListCompare();

  handleDropdown();

  handleAnimate();

  tagFilterCollection();

  sidebarBlog();

  showPassword();

  showItemMobile();

  sliderProduct();

  sliderBlog();

  handleScrollTop();

  showTooltip();

  handleQuantity();

  toggleTagsFilter();

  updateScrollThumbsQS();

  showMenuMobile();
});


$(window).on('load', () => {
  ModalNewsletter();
});
