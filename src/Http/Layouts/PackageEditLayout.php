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

class :package_nameEditLayout extends Rows
{
    /**
     * @return array
     */
	public function fields(): array
    {
        $contentLocale = 'data.content.'.app()->getLocale();

        return [
            Input::make($contentLocale.'.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(':package_name name')
                ->help(':package_name name help'),

            TinyMCE::make($contentLocale.'.body')
                    ->title(':package_name description')
                    ->help(':package_name description help')
                    ->theme('modern'),
        ];

    }

}