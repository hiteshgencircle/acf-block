{{--
  Newsletter CTA Partial

  A reusable newsletter signup section with customizable content.

  @param string $heading - CTA heading (optional)
  @param string $description - CTA description (optional)
  @param string $category - Category label (optional)
  @param string $buttonText - Submit button text (default: 'Subscribe')
  @param string $placeholder - Input placeholder (default: 'Enter your email')
  @param string $actionUrl - Form action URL (optional)
--}}

@props([
    'heading' => 'Get the latest posts delivered to your inbox',
    'description' => '',
    'category' => 'Stay Updated',
    'buttonText' => 'Subscribe',
    'placeholder' => 'Enter your email',
    'actionUrl' => null
])

<section class="py-16 lg:py-24" style="background-color: var(--color-paper);">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto text-center">

      @if($category)
        <p class="blog-category-label mb-4">{{ $category }}</p>
      @endif

      @if($heading)
        <h2 class="blog-headline text-2xl md:text-3xl mb-6">
          {{ $heading }}
        </h2>
      @endif

      @if($description)
        <p class="text-gray-600 mb-8 text-lg">
          {{ $description }}
        </p>
      @endif

      <form
        @if($actionUrl) action="{{ $actionUrl }}" @endif
        method="POST"
        class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto"
      >
        @csrf

        <input
          type="email"
          name="email"
          placeholder="{{ $placeholder }}"
          required
          class="flex-1 px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[var(--color-signal-teal)] focus:outline-none transition-colors"
        >

        <button type="submit" class="btn-cta whitespace-nowrap">
          {{ $buttonText }}
        </button>
      </form>

    </div>
  </div>
</section>
