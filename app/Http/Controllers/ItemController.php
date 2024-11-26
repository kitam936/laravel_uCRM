<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Message;
use Inertia\Inertia;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Item::select('id', 'name', 'price', 'is_selling')->get());
        return Inertia::render('Items/Index', [
            'items' => Item::select('id', 'name', 'price', 'is_selling')->get()
            ]);
    }

    public function index2()
    {
        // dd(Item::select('id', 'name', 'price', 'is_selling')->get());
        return Inertia::render('Items/Index', [
            'items' => Item::select('id', 'name', 'price', 'is_selling')->get()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Items/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        Item::create([
            'name' => $request->s_name,
            'memo' => $request->memo,
            'price' => $request->price,
        ]);


        // return Inertia::location(route('items.index'))
        return to_route('items.index')
        ->with([
            'message' => '商品が登録されました',
            'status' => 'info'])
        ;

    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return Inertia::render('Items/Show',['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit',['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name = $request->s_name;
        $item->memo = $request->memo;
        $item->price = $request->price;
        $item->is_selling = $request->is_selling;
        $item->save();

        return to_route('items.index')
        ->with([
            'message' => '商品情報が更新されました',
            'status' => 'info'])
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return to_route('items.index')
        ->with([
            'message' => '商品が削除されました',
            'status' => 'alert'])
        ;
    }
}
