<?php
namespace :vendor\:package_name\Http\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PackageListLayout extends Table
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
                ->link(':package_name.edit','id','title'),
			TD::set('body', 'Text')
                ->render(function ($package) {
                    return str_limit($package->getContent('body'), 50);
                }),
        ];
    }
}