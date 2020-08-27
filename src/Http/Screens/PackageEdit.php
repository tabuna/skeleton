<?php
namespace :vendor\:package_name\Http\Screens;

use Orchid\Support\Facades\Alert;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use :vendor\:package_name\Models\:package_name;
use :vendor\:package_name\Http\Layouts\:package_nameEditLayout;


class :package_nameEdit extends Screen
{

    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'New :package_name';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Add new :package_name';

    /**
     * Edit or add setting
     *
     * @var boolean
     */
    public $edit=false;

    /**
     * Query data
     *
     * @param :package_name $:_package_name
     *
     * @return array
     */
    public function query(:package_name $:_package_name) : array
    {
        if ($:_package_name->exists) {
            $this->name = __(':package_name edit');
            $this->description = $:_package_name->getContent('title');
            $this->edit = true;
        }

        return [
            'data'   => $:_package_name,
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
            Link::make(__('Back to list'))->icon('icon-arrow-left-circle')->route('platform.:_package_name.list'),
            Button::make(__('Save'))->icon('icon-check')->method('save'),
            Button::make(__('Remove'))->icon('icon-close')->method('remove')->canSee($this->edit),
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
                'Edit:package_name' => [
                    :package_nameEditLayout::class
                ],
            ]),

        ];
    }

    /**
     * @param $request
     * @param :package_name $package
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($request, :package_name $:_package_name)
    {
        $req = $this->request->get('data');
        $:_package_name->fill($req);
        $:_package_name->setSlug($req['content'][app()->getLocale()]['title'],true);
        $:_package_name->save();
        Alert::info(__(':package_name was saved'));

        return redirect()->route('platform.:_package_name.list');
    }

    /**
     * @param :package_name $:_package_name
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(:package_name $:_package_name)
    {
        $:_package_name->delete();
        Alert::info(__(':package_name was removed'));
        return redirect()->route('platform.:_package_name.list');
    }
}
