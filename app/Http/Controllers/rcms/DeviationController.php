<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use App\Models\DeviationGrid;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RecordNumber;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class DeviationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deviation = Deviation::all();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        return response()->view('frontend.forms.deviation_new', compact("deviation", "record_number", "due_date")); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return  response()->redirect()->back()->withInput();
        }

        $deviation = new Deviation();
        $deviation->form_type = "Deviation";
        //$deviation->record = ((RecordNumber::first()->value('counter')) + 1);
        $deviation->initiator_id = Auth::user()->id;
        # -------------new-----------
        $deviation->record_number = $request->record_number;
        $deviation->division_id = $request->division_id;
        //$deviation->text = $request->text;
        $deviation->assign_to = $request->assign_to;
        $deviation->due_date = $request->due_date;
        $deviation->intiation_date = $request->intiation_date;
        $deviation->Initiator_Group = $request->Initiator_Group;
        $deviation->due_date = $request->due_date;
        //$deviation->initiator_Group= $request->initiator_Group;
        $deviation->initiator_group_code= $request->initiator_group_code;
        $deviation->short_description = $request->short_description;
        $deviation->Deviation_reported_date = $request->Deviation_reported_date;
        $deviation->Observed_by = $request->Observed_by;
        $deviation->audit_type = $request->audit_type;
        $deviation->Name_of_Product = $request->Name_of_Product;
        $deviation->Description_Deviation = $request->Description_Deviation;
        $deviation->Immediate_action = $request->Immediate_action;
        $deviation->Preliminary_impact = $request->Preliminary_impact;
        $deviation->Product_Details_Required = $request->Product_Details_Required;
        $deviation->HOD_Remarks = $request->HOD_Remarks;
        $deviation->Deviation_category = $request->Deviation_category;
        $deviation->Justification_for_categorization = $request->Justification_for_categorization;
        $deviation->Investigation_required= $request->Investigation_required;
        $deviation->Investigation_Details= $request->Investigation_Details;
        $deviation->Customer_notification_required= $request->Customer_notification_required;
        $deviation->customers= $request->customers;
 
        $deviation->QAInitialRemark= $request->QAInitialRemark;
        $deviation->Investigation_Summary= $request->Investigation_Summary;
        $deviation->Impact_assessment= $request->Impact_assessment;
        $deviation->Root_cause = $request->Root_cause;
        // $deviation->due_date_extension = $request->due_date_extension; 
        $deviation->CAPA_Rquired= $request->CAPA_Rquired;
        $deviation->capa_type= $request->capa_type;
        $deviation->CAPA_Description= $request->CAPA_Description;
        $deviation->QA_Feedbacks = $request->QA_Feedbacks;
        $deviation->Closure_Comments= $request->Closure_Comments;
        $deviation->Disposition_Batch = $request->Disposition_Batch;

        if (!empty($request->Audit_file)) {
            $files = [];
            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->Audit_file = json_encode($files);
        
      
         
        if (!empty($request->Initial_attachment)) {
            $files = [];
            if ($request->hasfile('Initial_attachment')) {
                foreach ($request->file('Initial_attachment') as $file) {
                    $name = $request->name . 'Initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->Initial_attachment = json_encode($files);
        }
        if (!empty($request->QA_attachment)) {
            $files = [];
            if ($request->hasfile('QA_attachment')) {
                foreach ($request->file('QA_attachment') as $file) {
                    $name = $request->name . 'QA_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->QA_attachment = json_encode($files);
        }
        if (!empty($request->Investigation_attachment)) {
            $files = [];
            if ($request->hasfile('Investigation_attachment')) {
                foreach ($request->file('Investigation_attachment') as $file) {
                    $name = $request->name . 'Investigation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->Investigation_attachment = json_encode($files);
        }
        if (!empty($request->Capa_attachment)) {
            $files = [];
            if ($request->hasfile('Capa_attachment')) {
                foreach ($request->file('Capa_attachment') as $file) {
                    $name = $request->name . 'Capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->Capa_attachment = json_encode($files);
        }
    }

    $deviation->save();

    $data3 = new DeviationGrid();
    $data3->ID_Number = $deviation->id;
    $data3->type = "Deviation";
    if (!empty($request->ID_Number)) {
        $data3->ID_Number = serialize($request->ID_Number);
    }
    if (!empty($request->SystemName)) {
        $data3->SystemName = serialize($request->SystemName);
    }

    if (!empty($request->Instrument)) {
        $data3->Instrument = serialize($request->Instrument);
    }
    if (!empty($request->Equipment)) {
        $data3->Equipment = serialize($request->Equipment);
    }
    if (!empty($request->facility)) {
        $data3->facility = serialize($request->facility);
    }
    
    $data3->save();
    $data4 = new DeviationGrid();
    $data4->Number = $deviation->id;
    $data4->type = "Deviation";
    if (!empty($request->Number)) {
        $data4->Number = serialize($request->Number);
    }
    if (!empty($request->ReferenceDocumentName)) {
        $data4->ReferenceDocumentName = serialize($request->ReferenceDocumentName);
    }
    $data4->save();

    $data5 = new DeviationGrid();
    $data5->nameofproduct = $deviation->id;
    $data5->type = "Deviation";
    if (!empty($request->nameofproduct)) {
        $data5->nameofproduct = serialize($request->nameofproduct);
    }
    if (!empty($request->ExpiryDate)) {
        $data5->ExpiryDate = serialize($request->ExpiryDate);
    }
     $data5->save();
        
     toastr()->success("Record is Create Successfully");
     return response()->redirect('rcms/qms-dashboard');
    //  return response()->redirect(url('rcms/qms-dashboard'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        $data = Deviation::find($id);
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');

        return response()->view('frontend.deviation_new.view', compact('data', 'old_record'));
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
