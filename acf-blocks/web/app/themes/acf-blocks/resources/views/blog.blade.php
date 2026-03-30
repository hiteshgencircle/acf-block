{{--
  Template Name: Blog Archive

  This template displays a blog archive with featured posts.
--}}

@extends('layouts.app')

@section('content')
  {{-- Hero Section with Teal Mood --}}
  <x-post-header
    title="Blog & Insights"
    category="Latest Updates"
    mood="teal"
    size="large"
  />

  {{-- Main Blog Section --}}
  @php
    $posts = get_posts([
      'post_type' => 'post',
      'posts_per_page' => 10,
      'orderby' => 'date',
      'order' => 'DESC'
    ]);
  @endphp

  @include('partials.blog-section', [
    'posts' => $posts,
    'layout' => 'featured-grid',
    'showFeatured' => true
  ])

  {{-- CTA Section --}}
  <section class="py-16 lg:py-24" style="background-color: var(--color-paper);">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center">
        <p class="blog-category-label mb-4">Stay Updated</p>
        <h2 class="blog-headline text-2xl md:text-3xl mb-6">
          Get the latest posts delivered to your inbox
        </h2>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
          <input
            type="email"
            placeholder="Enter your email"
            class="flex-1 px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-[var(--color-signal-teal)] focus:outline-none transition-colors"
          >
          <button type="submit" class="btn-cta whitespace-nowrap">
            Subscribe
          </button>
        </form>
      </div>
    </div>
  </section>
@endsection
