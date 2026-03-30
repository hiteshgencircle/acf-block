<?php

namespace App\PostTypes;

class Recipe
{
    public static function register(){

        register_post_type(RECIPE_POST_TYPE, self::args());
    }
    public static function args(){
        return [
            'labels'              => self::labels(),
            'public'              => true,
            'show_in_rest'        => false,          // Gutenberg + REST API
            'has_archive'         => 'recipes',     // /recipes/ archive slug
            'rewrite'             => ['slug' => RECIPE_POST_TYPE],
            'menu_icon'           => 'dashicons-food',
            'supports'            => [
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'custom-fields',
            ],
            'show_in_nav_menus'   => true,
            'menu_position'       => 5,
        ];
    }
    private static function labels(): array
    {
        return [
            'name'                  => __('Recipes', 'sage'),
            'singular_name'         => __('Recipe', 'sage'),
            'add_new'               => __('Add New', 'sage'),
            'add_new_item'          => __('Add New Recipe', 'sage'),
            'edit_item'             => __('Edit Recipe', 'sage'),
            'new_item'              => __('New Recipe', 'sage'),
            'view_item'             => __('View Recipe', 'sage'),
            'view_items'            => __('View Recipes', 'sage'),
            'search_items'          => __('Search Recipes', 'sage'),
            'not_found'             => __('No recipes found.', 'sage'),
            'not_found_in_trash'    => __('No recipes found in Trash.', 'sage'),
            'all_items'             => __('All Recipes', 'sage'),
            'menu_name'             => __('Recipes', 'sage'),
            'name_admin_bar'        => __('Recipe', 'sage'),
        ];
    }
}
