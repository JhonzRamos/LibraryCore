<?php
namespace Laraveldaily\Quickadmin\Builders;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Cache\QuickCache;
use Laraveldaily\Quickadmin\Models\Files;
use Laraveldaily\Quickadmin\Models\Menu;
use Laraveldaily\Quickadmin\Models\ProjectMenus;
use Laraveldaily\Quickadmin\Models\Projects;

class SidebarBuilder
{
    // Template
    private $template;
    // Global names
    private $name;

    /**
     * Build our controller file
     */
    public function build()
    {

        $this->template      = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'sidebar';
        $template = (string)$this->loadTemplate();

        $template = $this->buildParts($template);

        $this->publish($template);
    }



    /**
     *  Load controller template
     */
    private function loadTemplate()
    {
        return file_get_contents($this->template);
    }

    /**
     * Build controller template parts
     *
     * @param $template
     *
     * @return mixed
     */
    private function buildParts($template)
    {
        $template = str_replace([
            '$MENUS$'
        ], [
            $this->compactBuilder(),

        ], $template);

        return $template;
    }

    /**
     * Build compact for create form
     * @return mixed|string
     */
    public function compactBuilder()
    {
        $compact = '';

        $active = Projects::where('active', 1)->first();
        $menus1 = ProjectMenus::where('project_id',$active->id)->pluck('menu_id');

        $menus = Menu::with('children')->where('menu_type', '!=', 0)->orderBy('position')->whereIn('id',$menus1)->get();


        foreach($menus as $menu){
            if($menu->menu_type != 2 && is_null($menu->parent_id)){
                $compact .='@can(\''.strtolower(Str::camel($menu->name)).'_access\')'. "\r\n";
                $compact .='                <li class="treeview @if(Request::segment(2) == \''.strtolower(Str::camel($menu->name)).'\' ) active menu-open @endif"  >'. "\r\n";
                $compact .='                    <a href="{{ route(\'admin.'.strtolower($menu->name).'.index\') }}">'. "\r\n";
                $compact .='                        <i class="fa '.$menu->icon.'"></i>'. "\r\n";
                $compact .='                        <span class="title">'.$menu->title .'</span>'. "\r\n";
                $compact .='                    </a>'. "\r\n";
                $compact .='                </li>'. "\r\n";
                $compact .='            @endcan'. "\r\n";
            }else{
                if(!is_null($menu->children()->first()) && is_null($menu->parent_id)){
                    $compact .='@can(\''.strtolower(Str::camel($menu->name)).'_access\')'. "\r\n";
                    $compact .='                <li class="treeview">'. "\r\n";
                    $compact .='                    <a href="#">'. "\r\n";
                    $compact .='                        <i class="fa '.$menu->icon.'"></i>'. "\r\n";
                    $compact .='                        <span class="title">'.$menu->title.'</span>'. "\r\n";
                    $compact .='                        <span class="pull-right-container">'. "\r\n";
                    $compact .='                            <i class="fa fa-angle-left pull-right"></i>'. "\r\n";
                    $compact .='                        </span>'. "\r\n";
                    $compact .='                    </a>'. "\r\n";
                    $compact .='                    <ul class="treeview-menu">'. "\r\n";
                    foreach($menu['children'] as $child){
                        $compact .='                    @can(\''.strtolower(Str::camel($child->name)).'_access\')'. "\r\n";
                        $compact .='                        <li class="@if(Request::segment(2) == \''.strtolower(Str::camel($child->name)).'\' ) active active-sub @endif">'. "\r\n";
                        $compact .='                            <a href="{{ route(\'admin.'.strtolower($child->name).'.index\') }}">'. "\r\n";
                        $compact .='                                <i class="fa '.$child->icon.'"></i>'. "\r\n";
                        $compact .='                                <span class="title">'.$child->title.'</span>'. "\r\n";
                        $compact .='                            </a>'. "\r\n";
                        $compact .='                        </li>'. "\r\n";
                        $compact .='                    @endcan'. "\r\n";
                    }
                    $compact .='                    </ul>'. "\r\n";
                    $compact .='                </li>'. "\r\n";
                    $compact .='            @endcan'. "\r\n";
                }
            }
        }


            return $compact;

    }


    /**
     *  Publish file into it's place
     */
    private function publish($template)
    {

        file_put_contents( public_path('temp').DIRECTORY_SEPARATOR .'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'partials'.DIRECTORY_SEPARATOR. 'sidebar.blade.php', $template);

    }



}
