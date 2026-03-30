# Blog Styling System Documentation

## Overview

This blog styling system implements your brand design system with three distinct post header moods, consistent typography hierarchy, and reusable Blade components for Sage 10+.

## Color System

The following custom colors are defined in `resources/css/app.css`:

```css
--color-ink: #0a1a14           /* Dark hero backgrounds only */
--color-signal-teal: #1D9E75   /* Active color - CTAs, hover states */
--color-paper: #F7F6F2         /* Warm page background */
--color-mint: #E8F5F0          /* Light background for technical content */
--color-teal-muted: #147a5c    /* Muted teal for meta text */
--color-teal-light: #d4f1e8    /* Light teal accent */
```

### Color Usage Rules

- **Ink** (#0a1a14): Reserved for dark hero backgrounds only, NOT body text
- **Signal Teal** (#1D9E75): The active color for CTAs, the live dot, hover underlines, and active nav states
- **Paper** (#F7F6F2): Page background to keep things warm rather than stark white
- **Mint** (#E8F5F0): For lighter sections and technical content backgrounds

## Components

### 1. Post Card Component

**Location**: `resources/views/components/post-card.blade.php`

A responsive card component for displaying blog posts in grids.

**Usage**:
```blade
<x-post-card
  title="Your Post Title"
  category="Announcements"
  excerpt="A brief excerpt of the post..."
  author="John Doe"
  date="March 26, 2024"
  permalink="{{ get_permalink($post) }}"
  image="{{ get_the_post_thumbnail_url($post) }}"
  mood="featured"
/>
```

**Props**:
- `title` (string): Post title
- `category` (string): Post category
- `excerpt` (string): Post excerpt
- `author` (string): Author name
- `date` (string): Formatted date
- `permalink` (string): Post URL
- `image` (string, optional): Featured image URL
- `mood` (string): 'default' or 'featured'

**Features**:
- Hover effects with scale animation on images
- Featured badge with live dot for featured posts
- Category label in signal teal
- Responsive typography
- Icon-enhanced meta information

---

### 2. Post Header Component

**Location**: `resources/views/components/post-header.blade.php`

Full-width hero header with three distinct moods for different content types.

**Usage**:
```blade
<x-post-header
  title="Bold Editorial Piece"
  category="Featured"
  author="Jane Smith"
  date="March 26, 2024"
  readTime="5 min"
  mood="ink"
  size="large"
/>
```

**Props**:
- `title` (string): Post title
- `category` (string): Post category
- `author` (string, optional): Author name
- `date` (string, optional): Formatted date
- `readTime` (string, optional): Reading time estimate
- `mood` (string): 'ink', 'teal', or 'mint'
- `size` (string): 'large', 'medium', or 'small'

**Mood Variations**:

1. **Ink** (`mood="ink"`):
   - For bold editorial pieces
   - Dark background (#0a1a14) with white text
   - Category label in signal teal

2. **Teal** (`mood="teal"`):
   - For announcements and featured posts
   - Full teal background (#1D9E75) with white text
   - Category label in white with slight opacity

3. **Mint** (`mood="mint"`):
   - For lighter technical content like lab notes
   - Mint background (#E8F5F0) with ink text
   - Category label in signal teal

**Size Variations**:
- `large`: py-20 lg:py-32, text-3xl to text-5xl
- `medium`: py-16 lg:py-24, text-2xl to text-4xl
- `small`: py-12 lg:py-16, text-xl to text-3xl

---

### 3. Blog Section Partial

**Location**: `resources/views/partials/blog-section.blade.php`

Displays a grid of blog posts with multiple layout options.

**Usage**:
```blade
@include('partials.blog-section', [
  'posts' => $posts,
  'heading' => 'Latest Articles',
  'subheading' => 'Blog',
  'layout' => 'featured-grid',
  'showFeatured' => true
])
```

**Props**:
- `posts` (array): Array of WP_Post objects
- `heading` (string, optional): Section heading
- `subheading` (string, optional): Section subheading
- `layout` (string): 'grid-3', 'grid-2', or 'featured-grid'
- `showFeatured` (bool): Highlight first post as featured

**Layout Options**:

1. **grid-3**: 3-column grid on desktop (responsive)
2. **grid-2**: 2-column grid with larger cards
3. **featured-grid**: Large featured post + smaller sidebar posts

---

## Typography Classes

### Category Labels
```html
<span class="blog-category-label">Category Name</span>
```
- Small-caps styling
- Signal teal color
- Increased letter-spacing (0.08em)

### Headlines
```html
<h2 class="blog-headline">Your Headline</h2>
```
- 22–28px (responsive)
- Font weight: 500
- Tight leading

### Meta Information
```html
<span class="blog-meta">Author • Date</span>
```
- Smaller text size
- Muted teal color

---

## Utility Classes

### Interactive Links
```html
<a href="#" class="link-hover">Link Text</a>
```
- Transparent bottom border
- Signal teal border on hover
- Smooth transition

### CTA Buttons
```html
<button class="btn-cta">Subscribe</button>
```
- Signal teal background
- White text
- Slight lift on hover
- Rounded corners

### Live Dot Accent
```html
<span class="live-dot"></span>
```
- Small circular dot in signal teal
- Signature brand element

---

## Example Templates

### Blog Archive Template

**Location**: `resources/views/blog.blade.php`

Full-featured blog archive with:
- Teal mood hero header
- Featured grid layout
- Newsletter signup CTA
- Paper background

### Single Post Template

**Location**: `resources/views/single-post.blade.php`

Single post view with:
- Dynamic mood based on category
- Featured image with negative margin overlap
- Prose styling for content
- Author bio
- Related posts section

**Category-Based Mood Logic**:
```php
// Announcements/Featured → teal mood
// Lab Notes/Technical → mint mood
// Default (Editorial) → ink mood
```

---

## Responsive Breakpoints

The system uses Tailwind's default breakpoints:

- **Mobile**: < 768px (sm)
- **Tablet**: 768px - 1024px (md)
- **Desktop**: > 1024px (lg)

All components are fully responsive with mobile-first design.

---

## WordPress Integration

### Getting Posts
```php
$posts = get_posts([
  'post_type' => 'post',
  'posts_per_page' => 10,
  'orderby' => 'date',
  'order' => 'DESC'
]);
```

### Post Data Access
```php
// In templates:
get_the_category($post->ID)[0]->name    // Category
get_the_author_meta('display_name')      // Author
get_the_date('M j, Y', $post)            // Date
get_permalink($post)                      // URL
get_the_post_thumbnail_url($post)        // Image
```

---

## Best Practices

1. **Mood Selection**:
   - Use **ink** for important editorial content and in-depth articles
   - Use **teal** for announcements, product launches, and featured posts
   - Use **mint** for technical tutorials, lab notes, and lighter content

2. **Typography Hierarchy**:
   - Always include category label above headlines
   - Keep headlines concise and impactful
   - Include relevant meta (author, date, read time)

3. **Featured Posts**:
   - Use `featured-grid` layout to highlight important posts
   - Add featured badge with live dot for visual distinction
   - Place most recent or important content first

4. **Accessibility**:
   - All interactive elements have proper focus states
   - Color contrast meets WCAG AA standards
   - Semantic HTML structure maintained

5. **Performance**:
   - Use appropriate image sizes (medium/large)
   - Implement lazy loading for images
   - Keep excerpt word counts reasonable (20-30 words)

---

## Customization

### Adding New Mood Variations

Edit `resources/css/app.css`:

```css
.post-header-custom {
  background-color: var(--your-color);
  color: white;
}

.post-header-custom .blog-category-label {
  color: var(--color-signal-teal);
}
```

### Custom Grid Layouts

Edit `resources/views/partials/blog-section.blade.php` and add new layout option:

```php
$gridClass = match($layout) {
  'grid-4' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6',
  // ... existing layouts
};
```

---

## File Structure

```
resources/
├── css/
│   └── app.css                          # Custom colors & typography
├── views/
    ├── components/
    │   ├── post-card.blade.php          # Post card component
    │   └── post-header.blade.php        # Post header component
    ├── partials/
    │   └── blog-section.blade.php       # Blog section partial
    ├── blog.blade.php                   # Blog archive template
    └── single-post.blade.php            # Single post template
```

---

## Support

For issues or questions:
1. Check component prop types and required values
2. Verify WordPress functions are available in context
3. Ensure Tailwind is compiled (`npm run build`)
4. Check browser console for JavaScript errors
