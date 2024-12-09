<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Item;
use Inertia\Inertia;
use App\Models\Order;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(Order::paginate(50));
        $customers = Purchase::searchPurchases($request->search)
        ->paginate(50)
        ->withQueryString();

        $orders = Order::groupBy('id')
        ->selectRaw('id, sum(subtotal) as total,
        customer_name, status, created_at')
        ->paginate(50)
        ->withQueryString();

        // dd($orders,$customers);
        return Inertia::render('Purchases/Index',[
            'orders' => $orders,
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::select('id','name','kana',)->get();
        $items = Item::select('id','name','price')->where('is_selling',true)->get();

        return Inertia::render('Purchases/Create',['customers' => $customers,'items'=>$items]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();
        try{
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
            ]);

            foreach($request->items as $item){
                $purchase->items()->attach($purchase->id,[
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            }
            DB::commit();
            return to_route('dashboard')
            ->with([
                'message' => '購入が完了しました。',
                'status' => 'info'
            ]);

        }catch(\Exception $e){
            DB::rollBack();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $items = Order::where('id',$purchase->id)->get();

        $order = Order::groupBy('id')
        ->where('id',$purchase->id)
        ->selectRaw('id, sum(subtotal) as total,
        customer_name, status, created_at')->get();

        // dd($items, $order);
        return Inertia::render('Purchases/Show',[
            'items' => $items,
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
