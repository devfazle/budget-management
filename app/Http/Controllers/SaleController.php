<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $firstSales = Sale::orderBy('id', 'desc')
            ->with('client.people', 'product')
            ->get()
            ->groupBy('invoice_number')
            ->map(function ($salesGroup) {
                $totalPrice = $salesGroup->sum('price');
                $firstSale = $salesGroup->first();
                $firstSale->invoice_number = $firstSale->invoice_number;
                $firstSale->total_price = $totalPrice;
                return $firstSale;
            });

        $formattedSales = $firstSales->values();
        return $this->sendResponse($formattedSales, 'User list fetched successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::get();
        $clients = Client::with('people')->get();
        $data = [
            'products' => $products,
            'clients' => $clients
        ];
        return $this->sendResponse($data, 'Product list fetched successfully!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'product_id' => 'required|integer',
        //     'unit' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'quantity' => 'required|integer',
        //     'client_id' => 'required|integer',
        //     'invoice_number' => 'required|string|max:255',
        //     'date' => 'required|date',
        // ]);
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors(),422);
        // }
        // $input = $request->all();
        // $input['password']=bcrypt($request->password);
        // $user = Sale::create($input);

        $invoice = $request->invoice;
        $date = $request->date;
        $client = $request->client;
        $sales = $request->sales;

        $allSales = [];

        foreach ($sales as $s) {
            unset($s['product_name']);
            $s += ['invoice_number' => $invoice, 'date' => $date, 'client_id' => $client];
            $allSales[] = $s;
        }

        Sale::insert($allSales);

        return $this->sendResponse($allSales, 'Sale created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $inv)
    {
        $saleInfo = Sale::where('invoice_number', $inv)->with('product','client.people')->get();
        $totalPrice = Sale::where('invoice_number', $inv)->sum('price');
        $data = [
            'saleinfo' => $saleInfo,
            'total_price' => $totalPrice
        ];

        return $this->sendResponse($data, 'Sale info fetched successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = Sale::find($id);
        return $this->sendResponse($users, 'Sale fetched successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'unit' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'client_id' => 'required|integer',
            'invoice_number' => 'required|string',
            'date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        $input = $request->all();
        if (!empty($request->password)) {
            $input['password'] = bcrypt($request->password);
        } else {
            unset($input['password']);
        }
        $user = Sale::find($id)->update($input);
        return $this->sendResponse($user, 'Sale updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = Sale::find($id)->delete();
        return $this->sendResponse($users, 'Sale deleted successfully!');
    }
}
