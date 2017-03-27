<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Category;

class DataComposer{

	  public function compose(View $view)
    {
    	$allCategories=Category::all();
    	$view->with(['allCategories'=>$allCategories]);
    }

}