<?php
namespace :vendor\:package_name\Http\Layouts;

use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class :package_nameListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'data';

    /**
     * @return array
     */
    public function columns() : array
    {
        return  [
		TD::set('title','Title')
			->render(function ($data) {
			    return Link::make($data->getContent('title'))
				->route('platform.:_package_name.edit', $data->id);
			}),
		TD::set('body', 'Text')
			->render(function ($data) {
			    return Str::limit($data->getContent('body'), 50);
			}),
        ];
    }
}
