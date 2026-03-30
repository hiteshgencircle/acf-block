{{--
  Post Header Component

  Displays a full-width post header with three mood variations.

  @param string $title - Post title
  @param string $category - Post category
  @param string $author - Post author name (optional)
  @param string $date - Post date (optional)
  @param string $readTime - Reading time estimate (optional)
  @param string $mood - Header mood: 'ink', 'teal', 'mint' (default: 'ink')
  @param string $size - Header size: 'large', 'medium', 'small' (default: 'large')

  Usage:
  - 'ink' mood: For bold editorial pieces (dark background)
  - 'teal' mood: For announcements and featured posts (full teal)
  - 'mint' mood: For lighter technical content like lab notes (mint background)
--}}

@props([
    'title' => '',
    'category' => '',
    'author' => '',
    'date' => '',
    'readTime' => '',
    'mood' => 'ink',
    'size' => 'large'
])

@php
  $moodClass = match($mood) {
    'ink' => 'post-header-ink',
    'teal' => 'post-header-teal',
    'mint' => 'post-header-mint',
    default => 'post-header-ink'
  };

  $paddingClass = match($size) {
    'large' => 'py-20 lg:py-32',
    'medium' => 'py-16 lg:py-24',
    'small' => 'py-12 lg:py-16',
    default => 'py-20 lg:py-32'
  };

  $headlineSize = match($size) {
    'large' => 'text-3xl md:text-4xl lg:text-5xl',
    'medium' => 'text-2xl md:text-3xl lg:text-4xl',
    'small' => 'text-xl md:text-2xl lg:text-3xl',
    default => 'text-3xl md:text-4xl lg:text-5xl'
  };
@endphp

<header class="{{ $moodClass }} {{ $paddingClass }} relative overflow-hidden">
  {{-- Subtle pattern overlay for depth (optional) --}}
  <div class="absolute inset-0 opacity-5 pointer-events-none">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, currentColor 1px, transparent 0); background-size: 32px 32px;"></div>
  </div>

  <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="max-w-4xl">
      {{-- Category Label --}}
      @if($category)
        <div class="mb-4 lg:mb-6">
          <span class="blog-category-label inline-flex items-center gap-2">
            <span class="live-dot"></span>
            {{ $category }}
          </span>
        </div>
      @endif

      {{-- Post Title --}}
      <h1 class="blog-headline {{ $headlineSize }} mb-6 lg:mb-8 font-medium leading-tight">
        {{ $title }}
      </h1>

      {{-- Post Meta --}}
      @if($author || $date || $readTime)
        <div class="flex flex-wrap items-center gap-4 lg:gap-6 text-sm opacity-90">
          @if($author)
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
              </svg>
              <span class="font-medium">{{ $author }}</span>
            </div>
          @endif

          @if($date)
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
              </svg>
              <span>{{ $date }}</span>
            </div>
          @endif

          @if($readTime)
            <div class="flex items-center gap-2">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
              </svg>
              <span>{{ $readTime }} read</span>
            </div>
          @endif
        </div>
      @endif
    </div>
  </div>
</header>
