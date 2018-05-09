<?php

namespace Showcase\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ShowcaseProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'showcase');

        $this->publishes([
            __DIR__.'/../../config.php' => config_path('showcase.php'),  
            __DIR__.'/../../resources/assets/build' => public_path('vendor/showcase'),          
            __DIR__.'/../../resources/views' => resource_path('/views/vendor/showcase'),
        ], 'showcase');

        $this->publishes([
            __DIR__.'/../../resources/assets/build' => public_path('vendor/showcase'), 
        ], 'showcase-assets');

        Blade::directive('showcaseDisplay', function ($display) {
            return "<?php \$__env->startComponent(\"showcase::public.components.display.{$display}->component_view\", ['display' => {$display}]); ?><?php echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('showcaseTrophy', function ($expression) {
            list($trophy, $display) = substr_count($expression, ',') > 0
                ? explode(',', str_replace(' ', '', $expression))
                : [$expression, null];

            $showcaseStr = $display === null 
                ? "{$trophy}->component_view" 
                : "{$display}->force_trophy_default == true ? {$display}->default_trophy_component_view : {$trophy}->component_view";

            $displayStr = $display !== null ? "\$display" : '""';

            return "<?php \$__env->startComponent(\"showcase::public.components.trophy.\".($showcaseStr), ['trophy' => {$trophy}, 'display' => $displayStr]); ?><?php echo \$__env->renderComponent(); ?>";
        });

        if (count(\DB::select(\DB::raw('SHOW TABLES LIKE "' . config('showcase.table_prefix', 'showcase_').'displays"'))) > 0) {
            $displays = \Showcase\App\Display::with('trophies')->get();
            $trophies = \Showcase\App\Trophy::all();
            View::share('displays', $displays);
            View::share('trophies', $trophies);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
