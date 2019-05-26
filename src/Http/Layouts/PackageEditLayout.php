<?php
namespace :vendor\:package_name\Http\Layouts;

use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Press\Screen\Fields\Tags;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Field;
use Orchid\Screen\Builder;
use Orchid\Screen\Fields\UTM;

class PackageEditLayout extends Rows
{
    /**
     * @return array
     */
	public function fields(): array
    {
        $data_con='data.content.'.app()->getLocale();

        return [
            Input::make($data_con.'.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title('Package name')
                ->help('Package name help'),

            TinyMCE::make($data_con.'.body')
                    ->title('Package description')
                    ->help('Package description help')
                    ->theme('modern'),
        ];

    }

}