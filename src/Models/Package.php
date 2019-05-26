<?php

namespace :vendor\:package_name\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Orchid\Attachment\Attachable;
use Orchid\Screen\AsMultiSource;


class Package extends Model
{
    use AsMultiSource,  Attachable;

	protected $table = 'packages';


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
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

}
