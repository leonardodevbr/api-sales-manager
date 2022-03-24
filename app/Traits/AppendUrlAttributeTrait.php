<?php


namespace App\Traits;

use Illuminate\Support\Str;

trait AppendUrlAttributeTrait
{
    public function initializeAppendUrlAttributeTrait()
    {
        $this->append('url');
    }

    public function getUrlAttribute()
    {
        $reflect = new \ReflectionClass($this);
        $modelName = strtolower($reflect->getShortName());

        switch ($modelName) {
            case 'article':
                if (request()->isJson()) {
                    return route("api.show.$modelName", $this->id);
                } else {
                    return route("show.$modelName", [$this->category->slug, $this->slug]);
                }
            default:
                if (request()->isJson()) {
                    return route("api.show.$modelName", $this->id);
                } else {
                    return route("show.$modelName", [$this->slug]);
                }
        }
    }
}
