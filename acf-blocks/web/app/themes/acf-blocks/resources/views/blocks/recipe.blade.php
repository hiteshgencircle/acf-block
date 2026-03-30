
@unless ($block->preview)
  <div class="container">
    <div class="row">
      <div class="col text-center mb-4 fw-semibold">
        <h2>{{$fields["title"]}}</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">

        <div class="position-relative overflow-hidden rounded">

          <!-- Background image -->
          <img src="{{$fields["banner_group"]["image"]["url"]}}"
               class="w-100 object-fit-cover"
               style="height: 536px;"
               alt="Hero image">

          <!-- Dark overlay + centered content -->
          <div class="position-absolute top-0 start-0 w-100 h-100
               d-flex flex-column align-items-center
               justify-content-center text-center p-4"
               style="background: linear-gradient(
                     to bottom,
                     transparent 0%,
                     transparent 40%,
                     rgba(0,0,0,0.55) 70%,
                     rgba(0,0,0,0.85) 100%
                   );">


            @if($fields["banner_group"]["title"])
              <p class="text-white position-absolute end-27 text-end fs-5 fw-bold banner-text"
                 style="max-width: 260px; ">
                {{$fields["banner_group"]["title"]}}
              </p>
            @endif



            <div class="d-flex gap-3 flex-wrap justify-content-center end-27 position-absolute bottom-20">
              @if($fields["banner_group"]["link"])

                <a href="{{$fields["banner_group"]["link"]["url"]}}" class="btn px-4 card-btn">{{$fields["banner_group"]["link"]["title"]}}</a>
              @endif


            </div>

          </div>
        </div>

      </div>
      <div class="col-sm-8">
        @if($fields["post_object_field"])
        <div class="swiper workshops-swiper" id="mySwiper">
          <div class="swiper-wrapper">
            @foreach($fields["post_object_field"] as $pof)
              <!-- Slide 1 -->
              <div class="swiper-slide">
                <div class="card h-100">
                  @if($pof["image_url"])
                    <img src="{{$pof["image_url"]}}" alt="{{$pof["title"]}}" class="card-img-top"
                         style="height:268px; object-fit:cover;">
                  @endif
                  <div class="card-body d-flex flex-column" style="height: 268px;">
                    @if($pof["title"])
                      <h5 class="card-title">{{$pof["title"]}}</h5>
                    @endif
                    <p class="card-text">{{$pof["excerpt"]}}</p>
                      <div class="mt-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip0_1267_18507)">
                            <path d="M13.6281 2.16508L12.9805 3.28583L15.2247 4.58121L15.8724 3.46043C16.0508 3.14932 15.9446 2.75458 15.6347 2.57485L14.5139 1.92714C14.2039 1.74759 13.8079 1.85381 13.6281 2.16508Z" fill="#8DCF27"/>
                            <path d="M9.64479 2.91666C10.0544 2.91666 10.4546 2.95674 10.8501 3.01324V1.96493L11.6787 1.9586V0.602647C11.6787 0.269545 11.4092 0 11.0761 0H8.21983C7.88673 0 7.61719 0.269545 7.61719 0.602647V1.9586L8.4395 1.96493V3.01324C8.83499 2.95674 9.23515 2.91666 9.64479 2.91666Z" fill="#8DCF27"/>
                            <path d="M9.64692 3.61523C5.32008 3.61523 1.8125 7.12278 1.8125 11.4497C1.8125 15.7765 5.32008 19.2841 9.64692 19.2841C13.9738 19.2841 17.4813 15.7765 17.4813 11.4497C17.4813 7.12278 13.9738 3.61523 9.64692 3.61523ZM13.308 15.1318L8.74293 11.9714V7.50968H10.0603V11.2812L14.0578 14.0487L13.308 15.1318Z" fill="#8DCF27"/>
                          </g>
                          <defs>
                            <clipPath id="clip0_1267_18507">
                              <rect width="19.2847" height="19.2847" fill="white"/>
                            </clipPath>
                          </defs>
                        </svg>

                        <span>{{$pof["prep_time"]}}</span>
                      </div>
                      <div>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 1.40234C5.25164 1.40234 1.40234 5.25164 1.40234 10C1.40234 14.7484 5.25164 18.5977 10 18.5977C14.7484 18.5977 18.5977 14.7484 18.5977 10C18.5977 5.25164 14.7484 1.40234 10 1.40234ZM7.65086 13.7395V6.26052L14.1278 10L7.65086 13.7395Z" fill="#8DCF27"/>
                        </svg>
                        <span>{{$pof["episode_length"]}}</span>
                      </div>
                    <div class="d-flex justify-content-between
                         align-items-center pt-3 mt-auto w-100">
                      @if($pof["post_url"])

                        <a href="{{$pof["post_url"]}}" class="btn swiper-slide-btn w-100">לצפייה ופרקים נוספים</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            <!-- Repeat .swiper-slide for more cards -->

          </div>


        </div>
        @endif
      </div>
    </div>
  </div>

@endunless
