
@unless ($block->preview)
  <section class="workshops-section">
    <h1 class="section-title">{{$fields["title"]}}</h1>

    <div class="workshops-container">

      @php
        $background_style = "";
        if($fields["banner_group"]["image"]){
            $background_style = 'style="background-image: url('.$fields["banner_group"]["image"]["url"].'); "';
        }
      @endphp
      <div class="banner-card" {!! $background_style !!}>
        <div class="banner-card-content">
          @if($fields["banner_group"]["title"])
            <h2>{{$fields["banner_group"]["title"]}}</h2>
          @endif

          @if($fields["banner_group"]["link"])

            <a href="{{$fields["banner_group"]["link"]["url"]}}" class="banner-btn">{{$fields["banner_group"]["link"]["title"]}}</a>
          @endif
        </div>
      </div>


      @if($fields["post_object_field"])
        <!-- Swiper Slider Area -->
        <div class="slider-area">
          <div class="swiper workshops-swiper">
            <div class="swiper-wrapper">
              @foreach($fields["post_object_field"] as $pof)
                <!-- Slide 1 -->
                <div class="swiper-slide">
                <div class="workshop-card">
                  @if($pof["image_url"])
                    <img src="{{$pof["image_url"]}}" alt="{{$pof["title"]}}" class="workshop-card-img">
                  @endif

                  <div class="workshop-card-body">
                    @if($pof["title"])
                      <h3 class="workshop-card-title">{{$pof["title"]}}</h3>
                    @endif
                    <p class="workshop-card-desc">{{$pof["excerpt"]}}</p>
                    <div class="workshop-meta">
                      <div class="meta-item">
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
                      <div class="meta-item">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 1.40234C5.25164 1.40234 1.40234 5.25164 1.40234 10C1.40234 14.7484 5.25164 18.5977 10 18.5977C14.7484 18.5977 18.5977 14.7484 18.5977 10C18.5977 5.25164 14.7484 1.40234 10 1.40234ZM7.65086 13.7395V6.26052L14.1278 10L7.65086 13.7395Z" fill="#8DCF27"/>
                        </svg>
                        <span>{{$pof["episode_length"]}}</span>
                      </div>
                    </div>
                      @if($pof["post_url"])

                        <a href="{{$pof["post_url"]}}" class="workshop-card-btn">לצפייה ופרקים נוספים</a>
                      @endif
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <!-- Static Banner Card -->
      @endif


    </div>
  </section>
@endunless
