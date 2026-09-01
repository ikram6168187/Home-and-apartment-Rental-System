<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Services Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('services.index');
    }


    /*
    |--------------------------------------------------------------------------
    | Show Service Request Form
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        $serviceType = $request->query('service');

        $properties = Property::all();

        return view('services.request', compact(
            'serviceType',
            'properties'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Store Service Request
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|in:home_maintenance,property_inspection,digital_rental_agreement,moving_relocation,photography_virtual_tour',

            'property_id' => 'nullable|exists:properties,id',

            'request_details' => 'required|string|min:10|max:2000',

            'preferred_date' => 'nullable|date|after_or_equal:today',
        ]);


        ServiceRequest::create([
            'user_id' => Auth::id(),

            'service_type' => $request->service_type,

            'property_id' => $request->property_id,

            'request_details' => $request->request_details,

            'preferred_date' => $request->preferred_date,

            'status' => 'pending',
        ]);


        return redirect()
            ->route('services.index')
            ->with(
                'success',
                'Your service request has been submitted successfully!'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | My Service Requests
    |--------------------------------------------------------------------------
    */

    public function myRequests()
    {
        $requests = ServiceRequest::with('property')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('services.my-requests', compact('requests'));
    }


    /*
    |--------------------------------------------------------------------------
    | Cancel Service Request
    |--------------------------------------------------------------------------
    */

    public function cancel($id)
    {
        $serviceRequest = ServiceRequest::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Sirf pending request cancel ho sakti hai
        if ($serviceRequest->status === 'pending') {

            $serviceRequest->update([
                'status' => 'cancelled'
            ]);

            return back()->with(
                'success',
                'Service request cancelled successfully.'
            );
        }

        return back()->with(
            'error',
            'Only pending requests can be cancelled.'
        );
    }
}