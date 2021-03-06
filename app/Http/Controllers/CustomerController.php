<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Traits\ViewTrait;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\CustomerTypeGroup;

class CustomerController extends Controller
{
    use ViewTrait;

    private $viewFolder = 'controllers.customer';
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->middleware('auth');
        $this->customer = $customer;
        $this->fixViewFolder($this->viewFolder);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = $this->customer->paginate(15);
        return view($this->viewFolder . 'index', [
            'customers'  => $customers,
            'types'      => CustomerType::all(),
            'paginate'   => $this->renderPaginate($customers)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = $request->input('customer');
        $customer_id = Customer::create([
            'name'  => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'cpf_cnpj' => $customer->cpf_cnpj,
            'type_id' => $customer->type_id,
        ])->id;

        return redirect()
            ->route('customer.edit', ['id' => $customer_id])
            ->with('status', ['success' => 'Venda fechada']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
