/*customer-slider*/
    var owl = $('.farmers-slide');
    owl.owlCarousel({
        autoplay:true,       
        autoplayTimeout:4000,
        margin:15,
        items:8,
        loop:false,
        dots:false,
        nav:true,
        responsive : {
        0 : {
            
            items:2
        },
        
        768 : {
            
            items:4
        },
        991 : {
            
          items:6
      },
        1200 : {
            items:8
        }
    }
    });

    $('.btn-large').click(function () {
        if ($(this).parent('.homeBannerContent').hasClass('open')) {
            $(this).parent('.homeBannerContent').removeClass('open');
        } else {
            $('.homeBannerContent').removeClass('open');
            $(this).parent('.homeBannerContent').addClass('open');
        }
    });


