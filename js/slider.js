$(document).ready(function(){
// let options = {
//     slidesToShow: 4,
//     slidesToScroll: 1,
//     autoplay: true,
//     autoplaySpeed: 3000,
//     infinite: true,
//     responsive: [
//       {
//         breakpoint: 800,
//         settings: {
//           slidesToShow: 2
//         }
//       },
//       {
//         breakpoint: 580,
//         settings: {
//           slidesToShow: 1
//         }
//       }
//     ]
//   };
  
//   $(".carousel99").slick(options);
  $('.carousel99').slick({
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 3,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });

  $("button.slick-prev").html("");
  $("button.slick-next").html("");
});