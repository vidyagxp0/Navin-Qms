<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
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


class DeviationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deviation()
    {    
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        $record_number = (RecordNumber::first()->value('counter')) + 1;
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $pre = Deviation::all();
        return response()->view('frontend.forms.deviation_new', compact('record_number', 'formattedDate', 'due_date','old_record', 'pre')); 
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
        $deviation->record = ((RecordNumber::first()->value('counter')) + 1);
        $deviation->initiator_id = Auth::user()->id;
        # -------------new-----------
      //  $deviation->record_number = $request->record_number;
        $deviation->division_id = $request->division_id;
        $deviation->assign_to = $request->assign_to;
        $deviation->due_date = $request->due_date;
        $deviation->intiation_date = $request->intiation_date;
        $deviation->Initiator_Group = $request->Initiator_Group;
        $deviation->due_date = $request->due_date;
        $deviation->initiator_group_code= $request->initiator_group_code;
        $deviation->short_description = $request->short_description;
        $deviation->Deviation_date = $request->Deviation_date;
        $deviation->Deviation_reported_date = $request->Deviation_reported_date;
        $deviation->Facility = implode(',', $request->Facility); 
       // $deviation->Observed_by = $request->Observed_by;
        $deviation->audit_type = $request->audit_type;
        $deviation->short_description_required = $request->short_description_required;
        $deviation->nature_of_repeat = $request->nature_of_repeat;
        $deviation->others = $request->others;
        
        $deviation->Product_Batch = $request->Product_Batch;
        
        $deviation->Description_Deviation = implode(',', $request->Description_Deviation); 
      
        
        $deviation->Immediate_Action = implode(',', $request->Immediate_Action);
        $deviation->Preliminary_Impact =implode(',', $request->Preliminary_Impact) ;
        $deviation->Product_Details_Required = $request->Product_Details_Required;
       
        $deviation->HOD_Remarks = $request->HOD_Remarks;
        $deviation->Deviation_category = $request->Deviation_category;
        $deviation->Justification_for_categorization = $request->Justification_for_categorization;
        $deviation->Investigation_required= $request->Investigation_required;
        

        $deviation->Investigation_Details= $request->Investigation_Details;
        $deviation->Customer_notification= $request->Customer_notification;
        $deviation->customers= $request->customers;
        $deviation->QAInitialRemark= $request->QAInitialRemark;
        //CFT
        $deviation->Production_Review= $request->Production_Review;
        $deviation->Production_person= $request->Production_person;
        
        $deviation->Production_assessment= $request->Production_assessment;
        $deviation->Production_feedback= $request->Production_feedback;
        $deviation->production_on= $request->production_on;

        $deviation->Investigation_Summary= $request->Investigation_Summary;
        $deviation->Impact_assessment= $request->Impact_assessment;
        $deviation->Root_cause = $request->Root_cause;
        // $deviation->due_date_extension = $request->due_date_extension; 
        $deviation->CAPA_Rquired= $request->CAPA_Rquired;
        $deviation->capa_type= $request->capa_type;
        $deviation->CAPA_Description= $request->CAPA_Description;
        $deviation->Post_Categorization= $request->Post_Categorization;
        $deviation->Investigation_Of_Review= $request->Investigation_Of_Review;
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

        if (!empty($request->QA_attachments)) {
            $files = [];
            if ($request->hasfile('QA_attachments')) {
                foreach ($request->file('QA_attachments') as $file) {
                    $name = $request->name . 'QA_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->QA_attachments = json_encode($files);
        }

        if (!empty($request->closure_attachment)) {
            $files = [];
            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->closure_attachment = json_encode($files);
        }
        if (!empty($request->production_attachment)) {
            $files = [];
            if ($request->hasfile('production_attachment')) {
                foreach ($request->file('production_attachment') as $file) {
                    $name = $request->name . 'production_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->production_attachment = json_encode($files);
        }
    }
    $record = RecordNumber::first();
    $record->counter = ((RecordNumber::first()->value('counter')) + 1);
    $record->update();
    $deviation->status = 'Opened';
    $deviation->stage = 1;


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
        //  return response()->redirect(url('rcms/qms-dashboard'));
    toastr()->success("Record is created Successfully");
    return redirect(url('rcms/qms-dashboard'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function devshow($id)
    {
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        $data = Deviation::find($id);
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $pre = Deviation::all();
       
        return view('frontend.forms.deviation_view', compact('data', 'old_record', 'pre'));
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
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $lastDeviation = deviation::find($id);
        $deviation = deviation::find($id);
        //$deviation->parent_id = $request->parent_id;
        //$deviation->parent_type = $request->parent_type;
        //$deviation->division_id = $request->division_id;
        //$deviation->text = $request->text;
        $deviation->assign_to = $request->assign_to;
        $deviation->due_date = $request->due_date;
        //$deviation->intiation_date = $request->intiation_date;
        $deviation->Initiator_Group = $request->Initiator_Group;
        $deviation->due_date = $request->due_date;
        
        //$deviation->initiator_Group= $request->initiator_Group;
        $deviation->initiator_group_code= $request->initiator_group_code;
        $deviation->short_description = $request->short_description;
        $deviation->Deviation_reported_date = $request->Deviation_reported_date;
        $deviation->Deviation_date = $request->Deviation_date;
        $deviation->audit_type = $request->audit_type;
        $deviation->short_description_required = $request->short_description_required;
        $deviation->nature_of_repeat = $request->nature_of_repeat;
        $deviation->others = $request->others;
        $deviation->Product_Batch = $request->Product_Batch;
        
        $deviation->Description_Deviation = implode(',', $request->Description_Deviation);
        //$deviation->Facility = implode(',', $request->Facility);  
      
        
        $deviation->Immediate_Action = implode(',', $request->Immediate_Action);
        $deviation->Preliminary_Impact =implode(',', $request->Preliminary_Impact) ;
        $deviation->Product_Details_Required = $request->Product_Details_Required;
       
        $deviation->HOD_Remarks = $request->HOD_Remarks;
        $deviation->Deviation_category = $request->Deviation_category;
        $deviation->Justification_for_categorization = $request->Justification_for_categorization;
        $deviation->Investigation_required= $request->Investigation_required;
        

        $deviation->Investigation_Details= $request->Investigation_Details;
        $deviation->Customer_notification= $request->Customer_notification;
        $deviation->customers= $request->customers;
    
        $deviation->QAInitialRemark= $request->QAInitialRemark;
        $deviation->Investigation_Summary= $request->Investigation_Summary;
        $deviation->Impact_assessment= $request->Impact_assessment;
        $deviation->Root_cause = $request->Root_cause; 
        $deviation->CAPA_Rquired= $request->CAPA_Rquired;
        $deviation->capa_type= $request->capa_type;
        $deviation->CAPA_Description= $request->CAPA_Description;
        $deviation->Post_Categorization= $request->Post_Categorization;
        $deviation->Investigation_Of_Review= $request->Investigation_Of_Review;
        $deviation->QA_Feedbacks = $request->QA_Feedbacks;
        $deviation->Closure_Comments= $request->Closure_Comments;
        $deviation->Disposition_Batch = $request->Disposition_Batch;
        //dd($deviation);
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
        
        if (!empty($request->QA_attachments)) {
            $files = [];
            if ($request->hasfile('QA_attachments')) {
                foreach ($request->file('QA_attachments') as $file) {
                    $name = $request->name . 'QA_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->QA_attachments = json_encode($files);
        }

        if (!empty($request->closure_attachment)) {
            $files = [];
            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $deviation->closure_attachment = json_encode($files);
        }
    }
    $deviation->update();
    toastr()->success('Record is Update Successfully');

    return back();
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

    public function deviation_send_stage(Request $request, $id)
    {


        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            if ($deviation->stage == 1) {
                $deviation->stage = "2";
                $deviation->status = "HOD Review";
                $deviation->submit_by = Auth::user()->name;
                $deviation->submit_on = Carbon::now()->format('d-M-Y');
                $deviation->submit_comment = $request->comment;   
                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id; 
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $deviation->submit_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'Plan Proposed';
                    $history->save();

                    $list = Helpers::getHodUserList();
                    foreach ($list as $u) {
                        if($u->q_m_s_divisions_id == $deviation->division_id){
                            $email = Helpers::getInitiatorEmail($u->user_id);
                             if ($email !== null) {
                          
                              Mail::send(
                                  'mail.view-mail',
                                   ['data' => $deviation],
                                function ($message) use ($email) {
                                    $message->to($email)
                                        ->subject("Document is Submitted By ".Auth::user()->name);
                                }
                              );
                            }
                     } 
                  }
           
                $deviation->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 2) {
                $deviation->stage = "3";
                $deviation->status = "QA Initial Review";
                $deviation->HOD_Review_Complete_By = Auth::user()->name;
                $deviation->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $deviation->HOD_Review_Comments = $request->comment;
                  
                $history = new DeviationAuditTrail();
                $history->deviation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $deviation->HOD_Review_Complete_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = 'Plan Approved';
                $history->save();
                
                $list = Helpers::getQAUserList();
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("Plan Approved By ".Auth::user()->name);
                            }
                        );
                    }
                  } 
                }
                
                $deviation->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 3) {
                $deviation->stage = "4";
                $deviation->status = "CFT Review";
                $deviation->QA_Initial_Review_Complete_By = Auth::user()->name;
                $deviation->QA_Initial_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $deviation->QA_Initial_Review_Comments = $request->comment;
                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $deviation->QA_Initial_Review_Complete_By;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'Completed';
                    $history->save();
                    $list = Helpers::getQAUserList();
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("Plan Approved By ".Auth::user()->name);
                            }
                        );
                    }
                  } 
                }
                $deviation->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 4) {
                $deviation->stage = "5";
                $deviation->status = "QA Final Review";
                $deviation->CFT_Review_Complete_By = Auth::user()->name;
                $deviation->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');  
                $deviation->CFT_Review_Comments = $request->comment;
               
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $deviation->CFT_Review_Complete_By;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'Complete';
                        $history->save();
                        $list = Helpers::getQAUserList();
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("Plan Approved By ".Auth::user()->name);
                            }
                        );
                    }
                  } 
                }
                $deviation->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($deviation->stage == 5) {
                $deviation->stage = "6";
                $deviation->status = "QA Head/Manager Designee Approval";
                $deviation->QA_Final_Review_Complete_By = Auth::user()->name;
                $deviation->QA_Final_Review_Complete_On = Carbon::now()->format('d-M-Y');
                $deviation->QA_Final_Review_Comments = $request->comment;
                
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $deviation->QA_Final_Review_Complete_By;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'Approved';
                        $history->save();
                        $list = Helpers::getQAUserList();
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("Plan Approved By ".Auth::user()->name);
                            }
                        );
                    }
                  } 
                }
                $deviation->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 6) {
                $deviation->stage = "7";
                $deviation->status = "Closed - Done";
                $deviation->Approved_By = Auth::user()->name;
                $deviation->Approved_On = Carbon::now()->format('d-M-Y');  
                $deviation->Approved_Comments = $request->comment;

                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $deviation->Approved_By;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'Completed';
                        $history->save();
                        $list = Helpers::getQAUserList();
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("Plan Approved By ".Auth::user()->name);
                            }
                        );
                    }
                  } 
                }
                $deviation->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function deviationCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);


            $deviation->stage = "0";
            $deviation->status = "Closed-Cancelled";
            $deviation->cancelled_by = Auth::user()->name;
            $deviation->cancelled_on = Carbon::now()->format('d-M-Y');
                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous ="";
                    $history->current = $deviation->cancelled_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $deviation->status;
                    $history->stage = 'Cancelled';
                    $history->save();
            $deviation->update();
            $history = new DeviationHistory();
            $history->type = "Deviation";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $deviation->stage;
            $history->status = $deviation->status;
            $history->save();

            $list = Helpers::getInitiatorUserList();
            foreach ($list as $u) {
                if($u->q_m_s_divisions_id == $deviation->division_id){
                  $email = Helpers::getInitiatorEmail($u->user_id);
                  if ($email !== null) {
                    
                    Mail::send(
                        'mail.view-mail',
                        ['data' => $deviation],
                        function ($message) use ($email) {
                            $message->to($email)
                                ->subject("Cancelled By ".Auth::user()->name);
                        }
                     );
                  }
                } 
            }

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
  
    public function deviation_qa_more_info(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);

            if($deviation->stage == 2){
                $deviation->stage = "2";
                $deviation->status = "Opened";
                $deviation->qa_more_info_required_by = Auth::user()->name;
                $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous ="";
                        $history->current = $deviation->qa_more_info_required_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'HOD Review';
                        $history->save();
                $deviation->update();
                $history = new DeviationHistory();
                $history->type = "Deviation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $deviation->stage;
                $history->status = $deviation->status;
                $history->save();
                $list = Helpers::getHodUserList();
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                     $email = Helpers::getInitiatorEmail($u->user_id);
                     if ($email !== null) {
                         Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("Document is Send By ".Auth::user()->name);
                            }
                        );
                      }
                    } 
                }
                toastr()->success('Document Sent');
                return back();
              }
          if($deviation->stage == 3){
            $deviation->stage = "2";
            $deviation->status = "HOD Review";
            $deviation->qa_more_info_required_by = Auth::user()->name;
            $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous ="";
                    $history->current = $deviation->qa_more_info_required_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'More Info Required';
                    $history->save();
            $deviation->update();
            $history = new DeviationHistory();
            $history->type = "Deviation";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $deviation->stage;
            $history->status = $deviation->status;
            $history->save();
            $list = Helpers::getHodUserList();
            foreach ($list as $u) {
                if($u->q_m_s_divisions_id == $deviation->division_id){
                 $email = Helpers::getInitiatorEmail($u->user_id);
                 if ($email !== null) {
                     Mail::send(
                        'mail.view-mail',
                        ['data' => $deviation],
                        function ($message) use ($email) {
                            $message->to($email)
                                ->subject("Document is Send By ".Auth::user()->name);
                        }
                    );
                  }
                } 
            }
            toastr()->success('Document Sent');
            return back();
          }
            
        if($deviation->stage == 4){
        $deviation->stage = "3";
        $deviation->status = "QA Initial Review";
        $deviation->qa_more_info_required_by = Auth::user()->name;
        $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                    $history = new DeviationAuditTrail();
                    $history->deviation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $deviation->qa_more_info_required_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->stage = 'More Info Required';
                    $history->save();   
        $deviation->update();
        $history = new DeviationHistory();
        $history->type = "Deviation";
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->stage_id = $deviation->stage;
        $history->status = $deviation->status;
        $history->save();
        toastr()->success('Document Sent');
        return back();
        }
        } 
        else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function deviation_reject(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
            if ($deviation->stage == 2) {
                $deviation->stage = "1";
                $deviation->status = "Opened";
                $deviation->rejected_by = Auth::user()->name;
                $deviation->rejected_on = Carbon::now()->format('d-M-Y');
                $deviation->update();
                $history = new DeviationHistory();
                $history->type = "Deviation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $deviation->stage;
                $history->status = "Opened";
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                       
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("More Info Required ".Auth::user()->name);
                            }
                        );
                      }
                    } 
                }
                $history->save();

                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 3) {
                $deviation->stage = "2";
                $deviation->status = "HOD Review";
                $deviation->qa_more_info_required_by = Auth::user()->name;
                $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $deviation->qa_more_info_required_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'More Info Required';
                        $history->save();   
                $deviation->update();
                $history = new DeviationHistory();
                $history->type = "Deviation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $deviation->stage;
                $history->status = "More Info Required";
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                       
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("More Info Required ".Auth::user()->name);
                            }
                        );
                      }
                    } 
                }
                $history->save();

                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 4) {
                $deviation->stage = "3";
                $deviation->status = "QA Initial Review";
                $deviation->qa_more_info_required_by = Auth::user()->name;
                $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $deviation->qa_more_info_required_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'More Info Required';
                        $history->save();   
                $deviation->update();
                $history = new DeviationHistory();
                $history->type = "Deviation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $deviation->stage;
                $history->status = "More Info Required";
                foreach ($list as $u) {
                    if($u->q_m_s_divisions_id == $deviation->division_id){
                    $email = Helpers::getInitiatorEmail($u->user_id);
                    if ($email !== null) {
                       
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $deviation],
                            function ($message) use ($email) {
                                $message->to($email)
                                    ->subject("More Info Required ".Auth::user()->name);
                            }
                        );
                      }
                    } 
                }
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 5) {
                if($deviation->status == "Send to Initiator"){
                    $deviation->stage = "1";
                    $deviation->status = "Opened";
                    $deviation->qa_more_info_required_by = Auth::user()->name;
                    $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->previous = "";
                            $history->current = $deviation->qa_more_info_required_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'Send to Initiator';
                            $history->save();   
                    $deviation->update();
                    $history = new DeviationHistory();
                    $history->type = "Deviation";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $deviation->stage;
                    $history->status = "Send to Initiator";
                    foreach ($list as $u) {
                        if($u->q_m_s_divisions_id == $deviation->division_id){
                        $email = Helpers::getInitiatorEmail($u->user_id);
                        if ($email !== null) {
                           
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $deviation],
                                function ($message) use ($email) {
                                    $message->to($email)
                                        ->subject("More Info Required ".Auth::user()->name);
                                }
                            );
                          }
                        } 
                    }
                    $history->save();
                    toastr()->success('Document Sent');
                    return back();
                }
                elseif($deviation->status == "Send to HOD"){
                    $deviation->stage = "2";
                    $deviation->status = "HOD Review";
                    $deviation->qa_more_info_required_by = Auth::user()->name;
                    $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->previous = "";
                            $history->current = $deviation->qa_more_info_required_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'Send to HOD';
                            foreach ($list as $u) {
                                if($u->q_m_s_divisions_id == $deviation->division_id){
                                $email = Helpers::getInitiatorEmail($u->user_id);
                                if ($email !== null) {
                                   
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $deviation],
                                        function ($message) use ($email) {
                                            $message->to($email)
                                                ->subject("More Info Required ".Auth::user()->name);
                                        }
                                    );
                                  }
                                } 
                            }
                            $history->save();   
                    $deviation->update();
                    $history = new DeviationHistory();
                    $history->type = "Deviation";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $deviation->stage;
                    $history->status = "Send to HOD";
                    $history->save();
                    toastr()->success('Document Sent');
                    return back();
                }
                else{
                    $deviation->stage = "3";
                    $deviation->status = "QA Initial Review";
                    $deviation->qa_more_info_required_by = Auth::user()->name;
                    $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                            $history = new DeviationAuditTrail();
                            $history->deviation_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->previous = "";
                            $history->current = $deviation->qa_more_info_required_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = 'Send to QA Initial Review';
                            foreach ($list as $u) {
                                if($u->q_m_s_divisions_id == $deviation->division_id){
                                $email = Helpers::getInitiatorEmail($u->user_id);
                                if ($email !== null) {
                                   
                                    Mail::send(
                                        'mail.view-mail',
                                        ['data' => $deviation],
                                        function ($message) use ($email) {
                                            $message->to($email)
                                                ->subject("More Info Required ".Auth::user()->name);
                                        }
                                    );
                                  }
                                } 
                            }
                            $history->save();   
                    $deviation->update();
                    $history = new DeviationHistory();
                    $history->type = "Deviation";
                    $history->doc_id = $id;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->stage_id = $deviation->stage;
                    $history->status = "Send to QA Initial Review";
                    $history->save();
                    toastr()->success('Document Sent');
                    return back();
                }
                
            }
            if ($deviation->stage == 6) {
                $deviation->stage = "5";
                $deviation->status = "QA Final Review";
                $deviation->qa_more_info_required_by = Auth::user()->name;
                $deviation->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                        $history = new DeviationAuditTrail();
                        $history->deviation_id = $id;
                        $history->activity_type = 'Activity Log';
                        $history->previous = "";
                        $history->current = $deviation->qa_more_info_required_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->stage = 'More Info Required';
                        foreach ($list as $u) {
                            if($u->q_m_s_divisions_id == $deviation->division_id){
                            $email = Helpers::getInitiatorEmail($u->user_id);
                            if ($email !== null) {
                               
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $deviation],
                                    function ($message) use ($email) {
                                        $message->to($email)
                                            ->subject("More Info Required ".Auth::user()->name);
                                    }
                                );
                              }
                            } 
                        }
                        $history->save();   
                $deviation->update();
                $history = new DeviationHistory();
                $history->type = "Deviation";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $deviation->stage;
                $history->status = "More Info Required";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function deviation_child_1(Request $request, $id)
    {
        $cft =[];
        $parent_id = $id;
        $parent_type = "Audit_Program";
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date= $formattedDate->format('d-M-Y');
        $parent_record = Deviation::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = Deviation::where('id', $id)->value('division_id');
        $parent_initiator_id = Deviation::where('id', $id)->value('initiator_id');
        $parent_intiation_date = Deviation::where('id', $id)->value('intiation_date');
        $parent_short_description = Deviation::where('id', $id)->value('short_description');
        $hod = User::where('role', 4)->get();
        if ($request->child_type == "extension") {
            $parent_due_date = "";
            $parent_id = $id;
            $parent_name = $request->parent_name;
            if ($request->due_date) {
                $parent_due_date = $request->due_date;
            }

            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            return view('frontend.forms.extension', compact('parent_id', 'parent_name', 'record_number', 'parent_due_date'));
        }
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        if ($request->child_type == "capa") {
            $parent_name = "CAPA";

            return view('frontend.forms.capa', compact('parent_id','parent_type',  'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record',));
        } else {
            return view('frontend.forms.root-cause-analysis', compact('parent_id','parent_type',  'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record',));
        }
    }

    public function DeviationAuditTrial($id)
    {
        $audit = DeviationAuditTrail::where('deviation_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $today = Carbon::now()->format('d-m-y');
        $document = Deviation::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');


        // return $audit;

        return view('frontend.forms.deviation_audit', compact('audit', 'document', 'today'));
    }

}
