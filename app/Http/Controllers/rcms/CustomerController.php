<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Deviation;
use App\Models\DeviationAuditTrail;
use App\Models\DeviationGrid;
use App\Models\DeviationHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\User;
use Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->customer_id = $request->input('customer_id');
        $customer->email = $request->input('email');
        $customer->customer_type = $request->input('customer_type');
        $customer->status = $request->input('status');
        $customer->customer_name = $request->input('customer_name');
        $customer->contact_no = $request->input('contact_no');
        $customer->industry = $request->input('industry');
        $customer->region = $request->input('region');
        $customer->remarks = $request->input('remarks');
        $customer->save();

        // You can add validation, error handling, and redirect to appropriate pages here
    }
}
