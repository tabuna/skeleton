<?php
namespace :vendor\:package_name\Http\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class :package_nameListLayout extends Table
{
    /**
     * @var string
     */
    public $data = 'data';

    /**
     * @return array
     */
    public function fields() : array
    {
        return  [
		TD::set('input','Title')
			->render(function ($data) {
			    return Link::make($data->title)
				->route('platform.:_package_name.edit', $data->id);
			}),
		TD::set('body', 'Text')
			->render(function ($data) {
			    return str_limit($data->getContent('body'), 50);
			}),
        ];
    }
}
