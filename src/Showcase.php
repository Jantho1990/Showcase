<?php

namespace Showcase;

use Illuminate\Support\Facades\Storage;

class Showcase
{
    /**
     * Get a display.
     *
     * @param  string  $name
     * @return  \Showcase\App\Display
     */
    public static function display($display)
    {
        if (!is_string($display)) {
            $display = \Showcase\App\Display::where('id', $display)->first();
        } else {
            $display = \Showcase\App\Display::where('name', $display)->first();
        }
        
        if ($display === null) {
            return '';
        }
        
        return $display;
    }

    /**
     * Check to see if a template file exists.
     * 
     * Check to see if a template file exists, either in the vendor path or the 
     * published user path.
     * 
     * @param  string  $file
     * @param  string  $type
     * @return  boolean
     */
    public static function templateFileExists($file, $type)
    {
        if ($type !== 'display' && $type !== 'trophy') {
            throw new \Exception("Invalid type ($type).");
        }
        return file_exists(base_path() . "/resources/views/vendor/showcase/public/components/$type/$file.blade.php")
            ?: file_exists(__DIR__."/resources/views/public/components/$type/$file.blade.php");
    }

    /**
     * Get all view filenames.
     *
     * @param string $type The type of view file being requested.
     * 
     * @return array
     */
    public static function getViewFilenames($type)
    {
        $sources = [
            base_path() . "/resources/views/vendor/showcase/public/components/$type/",
            __DIR__ . "/resources/views/public/components/$type/"
        ];

        $filenames = [];

        foreach ($sources as $source) {
            $filenames = array_merge($filenames, self::files($source));
        }

        return $filenames;
    }

    public static function files($directory)
    {
        $glob = glob($directory.DIRECTORY_SEPARATOR.'*');
        if ($glob === false) {
            return [];
        }
        // To get the appropriate files, we'll simply glob the directory and filter
        // out any "files" that are not truly files so we do not end up with any
        // directories in our list, but only true files within the directory.
        return array_filter($glob, function ($file) {
            return filetype($file) == 'file';
        });
    }
}