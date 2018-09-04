<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;

use App\Page;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$pages = Page::all();
    	return view('admin.page.index', [ 'pages' => $pages ]);
    }

    public function create()
    {
    	return view('admin.page.create');
    }

    public function store(PageRequest $request)
    {
    	$page = Page::where('title', '=', $request->input('title'))->get();
    	if( count($page) > 0) {
    		return back()->with('error_message', 'Page with this title already exists!')->withInput();
    	} else {
    		$pages = new Page;
    		$pages->title = $request->input('title');
    		$pages->content = $request->input('content');
    		$pages->save();

    		return redirect()->route('admin.page.create')->with('success_message', 'New page created!');
    	}
    }

    public function edit($id)
    {
    	$page = Page::findOrFail($id);
    	return view('admin.page.edit', [ 'page' => $page ]);
    }

    public function update($id, PageRequest $request)
    {
    	$page = Page::findOrFail($id);
    	$page->title = $request->input('title');
    	$page->content = $request->input('content');
    	$page->save();

    	return redirect()->route('admin.dashboard')->with('success_message', 'Page saved!');
    }

    public function show($id)
    {
    	$page = Page::find($id);

    	return view('admin.page.show', [ 'page' => $page ]);
    }

    public function destroy($id)
    {
    	$page = Page::findOrFail($id);
    	$page->delete();

    	return redirect()->route('admin.dashboard')->with('success_message', 'Page deleted');
    }
}
