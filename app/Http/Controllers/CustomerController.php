<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        // dd(Customer::select('id', 'name', 'kana', 'tel')->get());
        $customers = Customer::searchCustomers($request->search)
        ->select('id', 'name', 'kana', 'tel')
        ->paginate(50)
        ->withQueryString();
        // dd($customers);
        return Inertia::render('Customers/Index',['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        // Customer::create([
        //     'name' => $request->name,
        //     'kana' => $request->kana,
        //     'tel' => $request->tel,
        //     'email' => $request->email,
        //     'postcode' => $request->postcode,
        //     'address' => $request->address,
        //     'birthday' => $request->birthday,
        //     'gender' => $request->gender,
        //     'memo' => $request->memo,
        //     ]);
        $customers = new Customer;
        $customers->name = $request->name;
        $customers->kana = $request->kana;
        $customers->tel = $request->tel;
        $customers->email = $request->email;
        $customers->postcode = $request->postcode;
        $customers->address = $request->address;
        $customers->birthday = $request->birthday;
        $customers->gender = $request->gender;
        $customers->memo = $request->memo;
        $customers->save();

        return to_route('customers.index')
        ->with([
        'message' => '登録しました。',
        'status' => 'info'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return Inertia::render('Customers/Show',['customer' => $customer]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit',['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        // dd($customer,$request);
        $customer->name = $request->name;
        $customer->kana = $request->kana;
        $customer->tel = $request->tel;
        $customer->email = $request->email;
        $customer->postcode = $request->postcode;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;
        $customer->gender = $request->gender;
        $customer->memo = $request->memo;
        $customer->save();

        return to_route('customers.index')
        ->with([
            'message' => '顧客情報が更新されました',
            'status' => 'info'])
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return to_route('customers.index')
        ->with([
            'message' => '顧客情報が削除されました',
            'status' => 'alert'])
        ;
    }
}
