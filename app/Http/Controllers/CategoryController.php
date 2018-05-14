<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

    	$search = $request->search;
        $criterion = $request->criterion;

        if ($search == '') {
        	$categories = DB::table('categories as c')
                ->select('c.id', 'c.parent_id', 'p.tag as parent_tag', 'c.tag', 'c.color', 'c.archived')
                ->leftJoin('categories as p', 'c.parent_id', '=', 'p.id')
                ->orderBy('parent_tag', 'ASC', 'c.tag', 'ASC')
                ->paginate(5);
        } else {
        	$categories = DB::table('categories as c')
                ->select('c.id', 'c.parent_id', 'p.tag as parent_tag', 'c.tag', 'c.color', 'c.archived')
                ->leftJoin('categories as p', 'c.parent_id', '=', 'p.id')
        		->where('c.'.$criterion, 'like', '%'.$search.'%')
                ->orderBy('parent_tag', 'ASC', 'c.tag', 'ASC')
                ->paginate(5);
        }

    	return [
            'pagination' => [
                'total' => $categories->total(),
                'current_page' => $categories->currentPage(),
                'per_page' => $categories->perPage(),
                'last_page' => $categories->lastPage(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastItem()
            ],
            'categories' => $categories
        ];
    }

    public function listParents(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

    	$categories = Category::select('id', 'tag')
            ->orderBy('tag', 'ASC')
            ->get();

    	return $categories;
    }

    public function store(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $category = new category();
        $category->tag = $request->tag;
        $category->color = $request->color;
        $category->parent_id = $request->parent_id;
        $category->archived = '0';
        $category->save();
    }

    public function update(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $category = Category::findOrFail($request->id);
        $category->tag = $request->tag;
        $category->color = $request->color;
        $category->parent_id = $request->parent_id;
        $category->archived = '0';
        $category->save();
    }

    public function desarchived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $category = Category::findOrFail($request->id);
        $category->archived = '0';
        $category->save();
    }

    public function archived(Request $request)
    {
        if ( ! $request->ajax() ) return redirect('/');

        $category = Category::findOrFail($request->id);
        $category->archived = '1';
        $category->save();
    }
}
