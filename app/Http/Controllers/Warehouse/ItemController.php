<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemCategory;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = Item::latest()->paginate(5);
        $items = Item::with('itemCategories')->latest()->paginate(5);

        return view('warehouse.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemCategory = ItemCategory::all();
        $selectedID = null;

        return view('warehouse.items.create', compact('itemCategory','selectedID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:150',
            'quantity' => 'required|integer',
            'item_categories_id' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if($request->file('image')){
            $fileName = $request->file('image');

            $validatedData['image'] = $fileName->store('item-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        $item = Item::create($validatedData);
   
        return redirect('/items')->with('success', 'New item has been successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $itemCategory = ItemCategory::all();
        $selectedID = null;

        return view('warehouse.items.edit', compact('item','itemCategory','selectedID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:150',
            'quantity' => 'required|integer',
            'item_categories_id' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if($request->file('image')){
            $fileName = $request->file('image');

            $validatedData['image'] = $fileName->store('item-images');

            // Delete old image
            $item = Item::find($id);
            $oldImageName = $item->image;

            if($oldImageName){
                $oldImagePath = storage_path('app/public/'.$oldImageName);
                unlink($oldImagePath);
            }
        }

        $validatedData['user_id'] = auth()->user()->id;

        Item::whereId($id)->update($validatedData);

        return redirect('/items')->with('success', 'Item has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect('/items')->with('success', 'Item has been successfully deleted');
    }
}
