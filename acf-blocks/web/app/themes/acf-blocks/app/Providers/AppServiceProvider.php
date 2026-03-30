<?php
namespace App\Providers;

use App\PostTypes\Recipe;
use \Roots\Acorn\Sage\SageServiceProvider;

class AppServiceProvider extends SageServiceProvider{
    public function register(){}
    public function boot(){
        add_action('init', [Recipe::class, 'register']);

        add_action("init", fn () => flush_rewrite_rules(), 99);
    }
}
