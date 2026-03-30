{{--
  Post Card Component

  @param string $title - Post title
  @param string $category - Post category
  @param string $excerpt - Post excerpt
  @param string $author - Post author name
  @param string $date - Post date
  @param string $permalink - Post URL
  @param string $image - Featured image URL (optional)
  @param string $mood - Card mood: 'default', 'featured' (default: 'default')
--}}

@props([
    'title' => '',
    'category' => '',
    'excerpt' => '',
    'author' => '',
    'date' => '',
    'permalink' => '#',
    'image' => null,
    'mood' => 'default'
])

@php
  $cardClass = 'post-card group bg-white rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl';
  $isFeatured = $mood === 'featured';
@endphp

<article {{ $attributes->merge(['class' => $cardClass]) }}>
  @if($image)
    <div class="post-card-image relative overflow-hidden aspect-[16/9]">
      <a href="{{ $permalink }}" class="block h-full">
        <img
          src="{{ $image }}"
          alt="{{ $title }}"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
        >
      </a>

      @if($isFeatured)
        <div class="absolute top-4 right-4">
          <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-white/95 backdrop-blur-sm">
            <span class="live-dot"></span>
            Featured
          </span>
        </div>
      @endif
    </div>
  @endif

  <div class="{{ $image ? 'p-6' : 'p-8' }}">
    {{-- Category Label --}}
    @if($category)
      <div class="mb-3">
        <span class="blog-category-label">{{ $category }}</span>
      </div>
    @endif

    {{-- Post Title --}}
    <h3 class="mb-3">
      <a
        href="{{ $permalink }}"
        class="blog-headline link-hover inline-block"
      >
        {{ $title }}
      </a>
    </h3>

    {{-- Post Excerpt --}}
    @if($excerpt)
      <p class="text-gray-700 leading-relaxed mb-4 line-clamp-3">
        {{ $excerpt }}
      </p>
    @endif

    {{-- Post Meta --}}
    <div class="flex items-center gap-4 blog-meta">
      @if($author)
        <span class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
          </svg>
          {{ $author }}
        </span>
      @endif

      @if($date)
        <span class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
          </svg>
          {{ $date }}
        </span>
      @endif
    </div>
  </div>
</article>
