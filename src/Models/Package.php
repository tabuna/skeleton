<?php

namespace :vendor\:package_name\Models;

use Illuminate\Support\Str;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsMultiSource;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;

class :package_name extends Model
{
    use Filterable, AsMultiSource,  Attachable;

	protected $table = ':_package_names';

	protected $fillable = [
        'slug',
		'content',
		'options',
    ];

	/**
     * @var array
     */
    protected $casts = [
        'content' => 'array',
        'options' => 'array',
    ];

    /**
     * @param $title
     *
     * @return string
     */
    public function makeSlug($title) : string
    {
        $slug = Str::slug($title);
        $count = static::whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$'")
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * @param $title
     *
     * @return string
     */
    public function setSlug($title, $changeIfNotNull = false) : string
    {
        if (is_null($this->slug) || $changeIfNotNull) {
            $this->slug = $this->makeSlug($title);
        }

        return $this->slug;
    }

}
