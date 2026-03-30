{{--
  Blog Section Partial

  Displays a grid of blog posts with optional section heading.

  @param array $posts - Array of post objects
  @param string $heading - Section heading (optional)
  @param string $subheading - Section subheading (optional)
  @param string $layout - Grid layout: 'grid-3', 'grid-2', 'featured-grid' (default: 'grid-3')
  @param bool $showFeatured - Highlight first post as featured (default: false)
--}}

@props([
    'posts' => [],
    'heading' => '',
    'subheading' => '',
    'layout' => 'grid-3',
    'showFeatured' => false
])

@php
  $gridClass = match($layout) {
    'grid-3' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8',
    'grid-2' => 'grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12',
    'featured-grid' => 'grid grid-cols-1 lg:grid-cols-12 gap-8',
    default => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8'
  };
@endphp

<section class="blog-section py-16 lg:py-24" style="background-color: var(--color-paper);">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Section Header --}}
    @if($heading || $subheading)
      <div class="max-w-3xl mb-12 lg:mb-16">
        @if($subheading)
          <p class="blog-category-label mb-3">{{ $subheading }}</p>
        @endif

        @if($heading)
          <h2 class="blog-headline text-3xl md:text-4xl lg:text-5xl mb-4">
            {{ $heading }}
          </h2>
        @endif
      </div>
    @endif

    {{-- Posts Grid --}}
    @if($layout === 'featured-grid' && count($posts) > 0)
      {{-- Featured Grid Layout: Large first post + smaller posts --}}
      <div class="{{ $gridClass }}">
        {{-- Featured Post (spans full width on mobile, 7 cols on desktop) --}}
        <div class="lg:col-span-7">
          @php $featured = $posts[0]; @endphp
          <x-post-card
            :title="$featured->post_title"
            :category="get_the_category($featured->ID)[0]->name ?? ''"
            :excerpt="wp_trim_words($featured->post_excerpt ?: $featured->post_content, 30)"
            :author="get_the_author_meta('display_name', $featured->post_author)"
            :date="get_the_date('M j, Y', $featured)"
            :permalink="get_permalink($featured)"
            :image="get_the_post_thumbnail_url($featured, 'large')"
            mood="featured"
            class="h-full"
          />
        </div>

        {{-- Sidebar Posts (5 cols on desktop) --}}
        <div class="lg:col-span-5 flex flex-col gap-8">
          @foreach(array_slice($posts, 1, 2) as $post)
            <x-post-card
              :title="$post->post_title"
              :category="get_the_category($post->ID)[0]->name ?? ''"
              :excerpt="wp_trim_words($post->post_excerpt ?: $post->post_content, 20)"
              :author="get_the_author_meta('display_name', $post->post_author)"
              :date="get_the_date('M j, Y', $post)"
              :permalink="get_permalink($post)"
              :image="get_the_post_thumbnail_url($post, 'medium')"
            />
          @endforeach
        </div>
      </div>

      {{-- Remaining Posts in Standard Grid --}}
      @if(count($posts) > 3)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
          @foreach(array_slice($posts, 3) as $post)
            <x-post-card
              :title="$post->post_title"
              :category="get_the_category($post->ID)[0]->name ?? ''"
              :excerpt="wp_trim_words($post->post_excerpt ?: $post->post_content, 20)"
              :author="get_the_author_meta('display_name', $post->post_author)"
              :date="get_the_date('M j, Y', $post)"
              :permalink="get_permalink($post)"
              :image="get_the_post_thumbnail_url($post, 'medium')"
              :mood="$showFeatured && $loop->first ? 'featured' : 'default'"
            />
          @endforeach
        </div>
      @endif

    @else
      {{-- Standard Grid Layout --}}
      <div class="{{ $gridClass }}">
        @foreach($posts as $post)
          <x-post-card
            :title="$post->post_title"
            :category="get_the_category($post->ID)[0]->name ?? ''"
            :excerpt="wp_trim_words($post->post_excerpt ?: $post->post_content, 25)"
            :author="get_the_author_meta('display_name', $post->post_author)"
            :date="get_the_date('M j, Y', $post)"
            :permalink="get_permalink($post)"
            :image="get_the_post_thumbnail_url($post, 'large')"
            :mood="$showFeatured && $loop->first ? 'featured' : 'default'"
          />
        @endforeach
      </div>
    @endif

    {{-- Empty State --}}
    @if(empty($posts))
      <div class="text-center py-16">
        <p class="text-gray-500 text-lg">No posts found.</p>
      </div>
    @endif

  </div>
</section>
