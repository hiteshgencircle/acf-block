# Blog System Quick Start Guide

## 🚀 Quick Implementation

### 1. Compile Assets
```bash
cd acf-blocks/web/app/themes/acf-blocks
npm run build
# or for development
npm run dev
```

### 2. Create a Blog Archive Page

In WordPress admin, create a new page and select "Blog Archive" template, or use the included `blog.blade.php`.

### 3. Single Post Template

The `single-post.blade.php` template will automatically apply to all blog posts. It includes:
- Dynamic mood selection based on category
- Reading time calculation
- Related posts
- Author bio

---

## 📦 Components at a Glance

### Post Card
```blade
<x-post-card
  :title="$post->post_title"
  :category="get_the_category($post->ID)[0]->name ?? ''"
  :permalink="get_permalink($post)"
  mood="featured"
/>
```

### Post Header (Hero)
```blade
<x-post-header
  title="Your Title"
  category="Featured"
  mood="ink|teal|mint"
  size="large"
/>
```

### Blog Section
```blade
@include('partials.blog-section', [
  'posts' => $posts,
  'layout' => 'featured-grid'
])
```

### Newsletter CTA
```blade
@include('partials.newsletter-cta')
```

### Reading Progress Bar
```blade
<x-reading-progress />
```

---

## 🎨 Mood Guide

| Mood | Use Case | Background | Text |
|------|----------|------------|------|
| **ink** | Bold editorial, news | Dark (#0a1a14) | White |
| **teal** | Announcements, featured | Teal (#1D9E75) | White |
| **mint** | Technical, tutorials | Mint (#E8F5F0) | Dark |

---

## 🎯 Common Patterns

### Featured Post Grid
```blade
@include('partials.blog-section', [
  'posts' => $posts,
  'layout' => 'featured-grid',
  'heading' => 'Latest Articles'
])
```

### 3-Column Grid
```blade
@include('partials.blog-section', [
  'posts' => $posts,
  'layout' => 'grid-3'
])
```

### Category Archive
```blade
@php
  $category = get_queried_object();
  $posts = get_posts([
    'category' => $category->term_id,
    'posts_per_page' => 12
  ]);
@endphp

<x-post-header
  :title="$category->name"
  :category="'Category'"
  mood="teal"
/>

@include('partials.blog-section', ['posts' => $posts])
```

---

## 🎨 Custom Colors in Templates

Use CSS variables directly:
```blade
<div style="background-color: var(--color-paper);">
  <h2 style="color: var(--color-signal-teal);">Title</h2>
</div>
```

Or use the CSS classes:
```blade
<div class="post-header-mint">
  <span class="blog-category-label">Category</span>
  <h1 class="blog-headline">Title</h1>
  <p class="blog-meta">Author • Date</p>
</div>
```

---

## 🔧 Customization Examples

### Change Featured Post Count
Edit `blog-section.blade.php:51`:
```php
@foreach(array_slice($posts, 1, 2) as $post)
// Change 2 to desired count
```

### Add Custom Mood
Edit `app.css`:
```css
.post-header-custom {
  background-color: #your-color;
  color: white;
}
```

Then use:
```blade
<x-post-header mood="custom" ... />
```

### Custom Reading Time Calculation
Edit `single-post.blade.php:15`:
```php
$readingTime = ceil(str_word_count(strip_tags(get_the_content())) / 200);
// Adjust 200 (words per minute) as needed
```

---

## 📱 Responsive Behavior

All components are mobile-first and responsive:

- **Mobile (< 768px)**: Single column, smaller text
- **Tablet (768-1024px)**: 2 columns, medium text
- **Desktop (> 1024px)**: 3 columns, full typography

Test responsive behavior:
```bash
# Open in browser dev tools
# Toggle device toolbar (Cmd+Shift+M)
# Test at: 375px, 768px, 1024px, 1440px
```

---

## ✅ Checklist

- [ ] Run `npm run build` to compile Tailwind
- [ ] Create blog archive page in WordPress
- [ ] Test single post view with different categories
- [ ] Verify featured images display correctly
- [ ] Check responsive design on mobile
- [ ] Test all three mood variations
- [ ] Customize colors if needed
- [ ] Set up newsletter form action URL

---

## 🐛 Troubleshooting

**Styles not applying?**
```bash
npm run build
# Clear WordPress cache
# Hard refresh browser (Cmd+Shift+R)
```

**Components not found?**
- Ensure files are in `resources/views/components/`
- Check file naming: `post-card.blade.php` → `<x-post-card />`

**Images not showing?**
- Verify posts have featured images set
- Check image sizes are generated
- Run: `wp media regenerate --yes`

**Colors not matching?**
- Check CSS variables in `app.css`
- Verify Tailwind is compiling correctly
- Inspect element in browser dev tools

---

## 📚 Full Documentation

See `BLOG-STYLING-GUIDE.md` for complete documentation.
