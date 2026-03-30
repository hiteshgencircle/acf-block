{{--
  Category Badge Component

  Displays a category badge with the live dot signature element.

  @param string $category - Category name
  @param string $url - Category URL (optional)
  @param bool $showDot - Show the live dot (default: true)
--}}

@props([
    'category' => '',
    'url' => null,
    'showDot' => true
])

@if($url)
  <a
    href="{{ $url }}"
    class="blog-category-label inline-flex items-center gap-2 hover:opacity-75 transition-opacity"
  >
    @if($showDot)
      <span class="live-dot"></span>
    @endif
    {{ $category }}
  </a>
@else
  <span class="blog-category-label inline-flex items-center gap-2">
    @if($showDot)
      <span class="live-dot"></span>
    @endif
    {{ $category }}
  </span>
@endif
