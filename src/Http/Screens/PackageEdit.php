<?php
namespace :vendor\:package_name\Http\Screens;

use Orchid\Support\Facades\Alert;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

use :vendor\:package_name\Models\Package;
use :vendor\:package_name\Http\Layouts\PackageEditLayout;


class PackageEdit extends Screen
{

    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Package edit';
    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Package edit description';
    /**
     * Edit or add setting
     *
     * @var boolean
     */
    public $edit=true;
    /**
     * Query data
     *
     * @param Package $package
     *
     * @return array
     */
    public function query($package = null) : array
    {
        if (is_null($package)) {
            $package = new Package();
            $this->name = __('New package');
            $this->description = __('Add new package');
            $this->edit = false;
        } else {
            $this->name = __('Package edit');
            $this->description = $package->options['title'];
            $this->edit = true;
        }

        return [
            'data'   => $package,
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
            Link::name(__('Back to list'))->icon('icon-arrow-left-circle')->link(route(':package_name')),
            Link::name(__('Save'))->icon('icon-check')->method('save'),
            Link::name(__('Remove'))->icon('icon-close')->method('remove')->canSee($this->edit),
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

            Layout::columns([
                'EditPackage' => [
                    PackageEditLayout::class
                ],
            ]),

        ];
    }
    /**
     * @param $request
     * @param Package $package
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, Package $package)
    {

        $package = is_null($package) ? new Package() : $package;
        $req = $this->request->get('data');
        $package->fill($req);
        $package->slug = is_null($package->slug) ? $package->makeSlug($req['content'][app()->getLocale()]['title']) : $package->slug;
        $package->save();

        Alert::info(__('Package was saved'));
        return redirect()->route(':package_name');
    }
    /**
     * @param Package $package
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function remove(Package $package)
    {
        $package->delete();
        Alert::info(__('Package was removed'));
        return redirect()->route(':package_name');
    }
}
