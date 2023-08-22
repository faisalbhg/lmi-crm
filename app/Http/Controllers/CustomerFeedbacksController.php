<?php

namespace App\Http\Controllers;

use App\Models\CustomerFeedbacks;
use App\Http\Requests\StoreCustomerFeedbacksRequest;
use App\Http\Requests\UpdateCustomerFeedbacksRequest;

class CustomerFeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerFeedbacksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerFeedbacks $customerFeedbacks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerFeedbacks $customerFeedbacks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerFeedbacksRequest $request, CustomerFeedbacks $customerFeedbacks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerFeedbacks $customerFeedbacks)
    {
        //
    }
}
