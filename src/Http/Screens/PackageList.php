<?php
namespace :vendor\:package_name\Http\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Layouts;
use Orchid\Screen\Link;

use :vendor\:package_name\Models\Package;
use :vendor\:package_name\Http\Layouts\PackageListLayout;

class PackageList extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Package List';
    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'List all data in package';
    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
        $this->name = __('Package List');
        return [
            'data' => Package::filters()->defaultSort('slug', 'desc')->paginate(30)
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
            Link::name('Add')->method('create'),
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
            PackageListLayout::class,
        ];
    }
    /**
     * @return null
     */
    public function create()
    {
        return redirect()->route(':package_name.create');
    }
}