<?php
namespace :vendor\:package_name\Http\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Layouts;
use Orchid\Screen\Actions\Button;
use :vendor\:package_name\Models\:package_name;
use :vendor\:package_name\Http\Layouts\:package_nameListLayout;

class :package_nameList extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = ':package_name List';
    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'List all data in :package_name';
    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
        return [
            'data' => :package_name::filters()->defaultSort('slug', 'desc')->paginate(30)
        ];
    }
    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [
            Button::make('Add')->method('create'),
        ];
    }
    /**
     * Views
     *
     * @return array
     */
    public function layout() : array
    {
        return [
            :package_nameListLayout::class,
        ];
    }
    /**
     * @return null
     */
    public function create()
    {
        return redirect()->route('platform.:_package_name.create');
    }
}
