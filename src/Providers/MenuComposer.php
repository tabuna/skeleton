<?php

namespace :vendor\:package_name\Providers;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;

class MenuComposer
{
    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     *
     */
    public function compose()
    {

        $this->dashboard->menu
            ->add('Main',
                ItemMenu::Label(':package_name')
                    ->Slug(':_package_name-menu')
                    ->Icon('icon-notebook')
                    ->Childs(true)
                    ->Active(':_package_name.*')
                    ->Permission('platform.:_package_name')
                    ->Sort(100)
            )
            ->add(':_package_name-menu',
                ItemMenu::Label(':package_name')
                    ->Slug(':_package_name-list')
                    ->Icon('icon-notebook')
                    ->Route('platform.:_package_name.list')
                    ->Title('Package list')
                    ->Permission('platform.:_package_name')
                    ->Sort(10)
            );
    }
}