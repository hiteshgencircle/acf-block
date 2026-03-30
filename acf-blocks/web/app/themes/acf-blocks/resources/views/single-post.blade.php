{{--
  Single Post Template

  Displays a single blog post with the appropriate mood header.
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @php
      // Determine mood based on category or post meta
      $categories = get_the_category();
      $primaryCategory = $categories[0]->name ?? '';

      // Example mood logic:
      // - 'Announcements' or 'Featured' → teal
      // - 'Lab Notes' or 'Technical' → mint
      // - Default (Editorial, News, etc.) → ink

      $mood = 'ink'; // Default bold editorial style

      if (in_array($primaryCategory, ['Announcements', 'Featured'])) {
        $mood = 'teal';
      } elseif (in_array($primaryCategory, ['Lab Notes', 'Technical', 'Tutorials'])) {
        $mood = 'mint';
      }

      $readingTime = ceil(str_word_count(strip_tags(get_the_content())) / 200);
    @endphp

    {{-- Post Header with Dynamic Mood --}}
    <x-post-header
      :title="get_the_title()"
      :category="$primaryCategory"
      :author="get_the_author()"
      :date="get_the_date('F j, Y')"
      :readTime="$readingTime . ' min'"
      :mood="$mood"
      size="large"
    />

    {{-- Featured Image --}}
    @if(has_post_thumbnail())
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20">
        <div class="max-w-5xl mx-auto">
          <img
            src="{{ get_the_post_thumbnail_url(get_the_ID(), 'full') }}"
            alt="{{ get_the_title() }}"
            class="w-full h-auto rounded-lg shadow-2xl"
          >
        </div>
      </div>
    @endif

    {{-- Post Content --}}
    <article class="py-16 lg:py-24" style="background-color: var(--color-paper);">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

          {{-- Article Body --}}
          <div class="prose prose-lg max-w-none
            prose-headings:font-medium
            prose-h2:text-2xl prose-h2:mt-12 prose-h2:mb-6
            prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-4
            prose-p:leading-relaxed prose-p:mb-6
            prose-a:text-[var(--color-signal-teal)] prose-a:no-underline hover:prose-a:border-b-2 hover:prose-a:border-[var(--color-signal-teal)]
            prose-strong:font-semibold
            prose-code:bg-gray-100 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-sm
            prose-pre:bg-gray-900 prose-pre:text-gray-100
            prose-img:rounded-lg prose-img:shadow-lg
            prose-blockquote:border-l-4 prose-blockquote:border-[var(--color-signal-teal)] prose-blockquote:pl-6 prose-blockquote:italic
          ">
            {!! get_the_content() !!}
          </div>

          {{-- Tags --}}
          @php
            $tags = get_the_tags();
          @endphp

          @if($tags)
            <div class="mt-12 pt-8 border-t border-gray-200">
              <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                  <a
                    href="{{ get_tag_link($tag) }}"
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white border-2 border-gray-200 hover:border-[var(--color-signal-teal)] transition-colors"
                  >
                    {{ $tag->name }}
                  </a>
                @endforeach
              </div>
            </div>
          @endif

          {{-- Author Bio --}}
          <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex gap-6 items-start">
              <div class="flex-shrink-0">
                {{ get_avatar(get_the_author_meta('ID'), 80, '', '', ['class' => 'rounded-full']) }}
              </div>
              <div>
                <h3 class="font-medium text-lg mb-2">{{ get_the_author() }}</h3>
                <p class="text-gray-600 leading-relaxed">
                  {{ get_the_author_meta('description') ?: 'Content creator and technical writer.' }}
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </article>

    {{-- Related Posts --}}
    @php
      $relatedPosts = get_posts([
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => [get_the_ID()],
        'category__in' => wp_get_post_categories(get_the_ID()),
        'orderby' => 'rand'
      ]);
    @endphp

    @if(!empty($relatedPosts))
      @include('partials.blog-section', [
        'posts' => $relatedPosts,
        'heading' => 'Related Articles',
        'subheading' => 'Keep Reading',
        'layout' => 'grid-3'
      ])
    @endif

  @endwhile
@endsection
