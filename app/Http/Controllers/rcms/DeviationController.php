<?php

namespace App\Http\Controllers\rcms;
use App\Models\DeviationCftsResponse;
use App\Models\RootCauseAnalysis;
use App\Http\Controllers\Controller;
use App\Models\Deviation;
use App\Models\Extension;
use App\Models\DeviationAuditTrail;
use App\Models\DeviationGrid;
use App\Models\DeviationHistory;
use App\Models\DeviationCft;
use Illuminate\Http\Request;
use App\Models\Capa;
use Carbon\Carbon;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\User;
use Helpers;
use PDF;
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

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();
        $deviation->status = 'Opened';
        $deviation->stage = 1;
    
        $deviation->save();
      
       
        $Cft = new DeviationCft();
        $Cft->deviation_id = $deviation->id;
        $Cft->Production_Review= $request->Production_Review;
        $Cft->Production_person= $request->Production_person;
        $Cft->Production_assessment= $request->Production_assessment;
        $Cft->Production_feedback= $request->Production_feedback;
        $Cft->production_on= $request->production_on;
        $Cft->Production_Review_Completed_By= $request->Production_Review_Completed_By;
          
        $Cft->Warehouse_review= $request->Warehouse_review;
        $Cft->Warehouse_notification= $request->Warehouse_notification;
        $Cft->Warehouse_assessment= $request->Warehouse_assessment;
        $Cft->Warehouse_feedback= $request->Warehouse_feedback;
        $Cft->Warehouse_Review_Completed_By= $request->Warehouse_Review_Completed_By;
        $Cft->Warehouse_Review_Completed_On= $request->Warehouse_Review_Completed_On;

        $Cft->Quality_review= $request->Quality_review;
        $Cft->Quality_Control_Person= $request->Quality_Control_Person;
        $Cft->Quality_Control_assessment= $request->Quality_Control_assessment;
        $Cft->Quality_Control_feedback= $request->Quality_Control_feedback;
        $Cft->Quality_Control_by= $request->Quality_Control_by;
        $Cft->Quality_Control_on= $request->Quality_Control_on;

        $Cft->Quality_Assurance_Review= $request->Quality_Assurance_Review;
        $Cft->QualityAssurance_person= $request->QualityAssurance_person;
        $Cft->QualityAssurance_assessment= $request->QualityAssurance_assessment;
        $Cft->QualityAssurance_feedback= $request->QualityAssurance_feedback;
        $Cft->QualityAssurance_by= $request->QualityAssurance_by;
        $Cft->QualityAssurance_on= $request->QualityAssurance_on;

        $Cft->Engineering_review= $request->Engineering_review;
        $Cft->Engineering_person= $request->Engineering_person;
        $Cft->Engineering_assessment= $request->Engineering_assessment;
        $Cft->Engineering_feedback= $request->Engineering_feedback;
        $Cft->Engineering_by= $request->Engineering_by;
        $Cft->Engineering_on= $request->Engineering_on;

        $Cft->Analytical_Development_review= $request->Analytical_Development_review;
        $Cft->Analytical_Development_person= $request->Analytical_Development_person;
        $Cft->Analytical_Development_assessment= $request->Analytical_Development_assessment;
        $Cft->Analytical_Development_feedback= $request->Analytical_Development_feedback;
        $Cft->Analytical_Development_by= $request->Analytical_Development_by;
        $Cft->Analytical_Development_on= $request->Analytical_Development_on;

        $Cft->Kilo_Lab_review= $request->Kilo_Lab_review;
        $Cft->Kilo_Lab_person= $request->Kilo_Lab_person;
        $Cft->Kilo_Lab_assessment= $request->Kilo_Lab_assessment;
        $Cft->Kilo_Lab_feedback= $request->Kilo_Lab_feedback;
        $Cft->Kilo_Lab_attachment_by= $request->Kilo_Lab_attachment_by;
        $Cft->Kilo_Lab_attachment_on= $request->Kilo_Lab_attachment_on;

        $Cft->Technology_transfer_review= $request->Technology_transfer_review;
        $Cft->Technology_transfer_person= $request->Technology_transfer_person;
        $Cft->Technology_transfer_assessment= $request->Technology_transfer_assessment;
        $Cft->Technology_transfer_feedback= $request->Technology_transfer_feedback;
        $Cft->Technology_transfer_by= $request->Technology_transfer_by;
        $Cft->Technology_transfer_on= $request->Technology_transfer_on;

        $Cft->Environment_Health_review= $request->Environment_Health_review;
        $Cft->Environment_Health_Safety_person= $request->Environment_Health_Safety_person;
        $Cft->Health_Safety_assessment= $request->Health_Safety_assessment;
        $Cft->Health_Safety_feedback= $request->Health_Safety_feedback;
        $Cft->Environment_Health_Safety_by= $request->Environment_Health_Safety_by;
        $Cft->Environment_Health_Safety_on= $request->Environment_Health_Safety_on;

        $Cft->Human_Resource_review= $request->Human_Resource_review;
        $Cft->Human_Resource_person= $request->Human_Resource_person;
        $Cft->Human_Resource_assessment= $request->Human_Resource_assessment;
        $Cft->Human_Resource_feedback= $request->Human_Resource_feedback;
        $Cft->Human_Resource_by= $request->Human_Resource_by;
        $Cft->Human_Resource_on= $request->Human_Resource_on;

        $Cft->Information_Technology_review= $request->Information_Technology_review;
        $Cft->Information_Technology_person= $request->Information_Technology_person;
        $Cft->Information_Technology_assessment= $request->Information_Technology_assessment;
        $Cft->Information_Technology_feedback= $request->Information_Technology_feedback;
        $Cft->Information_Technology_by= $request->Information_Technology_by;
        $Cft->Information_Technology_on= $request->Information_Technology_on;

        $Cft->Project_management_review= $request->Project_management_review;
        $Cft->Project_management_person= $request->Project_management_person;
        $Cft->Project_management_assessment= $request->Project_management_assessment;
        $Cft->Project_management_feedback= $request->Project_management_feedback;
        $Cft->Project_management_by= $request->Project_management_by;
        $Cft->Project_management_on= $request->Project_management_on;
     
        $Cft->Other1_review= $request->Other1_review;
        $Cft->Other1_person= $request->Other1_person;
        $Cft->Other1_Department_person= $request->Other1_Department_person;
        $Cft->Other1_assessment= $request->Other1_assessment;
        $Cft->Other1_feedback= $request->Other1_feedback;
        $Cft->Other1_by= $request->Other1_by;
        $Cft->Other1_on= $request->Other1_on;

        $Cft->Other2_review= $request->Other2_review;
        $Cft->Other2_person= $request->Other2_person;
        $Cft->Other2_Department_person= $request->Other2_Department_person;
        $Cft->Other2_Assessment= $request->Other2_Assessment;
        $Cft->Other2_feedback= $request->Other2_feedback;
        $Cft->Other2_by= $request->Other2_by;
        $Cft->Other2_on= $request->Other2_on;

        $Cft->Other3_review= $request->Other3_review;
        $Cft->Other3_person= $request->Other3_person;
        $Cft->Other3_Department_person= $request->Other3_Department_person;
        $Cft->Other3_Assessment= $request->Other3_Assessment;
        $Cft->Other3_feedback= $request->Other3_feedback;
        $Cft->Other3_by= $request->Other3_by;
        $Cft->Other3_on= $request->Other3_on;

        $Cft->Other4_review= $request->Other4_review;
        $Cft->Other4_person= $request->Other4_person;
        $Cft->Other4_Department_person= $request->Other4_Department_person;
        $Cft->Other4_Assessment= $request->Other4_Assessment;
        $Cft->Other4_feedback= $request->Other4_feedback;
        $Cft->Other4_by= $request->Other4_by;
        $Cft->Other4_on= $request->Other4_on;

        $Cft->Other5_review= $request->Other5_review;
        $Cft->Other5_person= $request->Other5_person;
        $Cft->Other5_Department_person= $request->Other5_Department_person;
        $Cft->Other5_Assessment= $request->Other5_Assessment;
        $Cft->Other5_feedback= $request->Other5_feedback;
        $Cft->Other5_by= $request->Other5_by;
        $Cft->Other5_on= $request->Other5_on;

        if (!empty($request->production_attachment)) {
            $files = [];
            if ($request->hasfile('production_attachment')) {
                foreach ($request->file('production_attachment') as $file) {
                    $name = $request->name . 'production_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->production_attachment = json_encode($files);
        }
        if (!empty($request->Warehouse_attachment)) {
            $files = [];
            if ($request->hasfile('Warehouse_attachment')) {
                foreach ($request->file('Warehouse_attachment') as $file) {
                    $name = $request->name . 'Warehouse_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Warehouse_attachment = json_encode($files);
        }
        if (!empty($request->Quality_Control_attachment)) {
            $files = [];
            if ($request->hasfile('Quality_Control_attachment')) {
                foreach ($request->file('Quality_Control_attachment') as $file) {
                    $name = $request->name . 'Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Quality_Control_attachment = json_encode($files);
        }
        if (!empty($request->Quality_Assurance_attachment)) {
            $files = [];
            if ($request->hasfile('Quality_Assurance_attachment')) {
                foreach ($request->file('Quality_Assurance_attachment') as $file) {
                    $name = $request->name . 'Quality_Assurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Quality_Assurance_attachment = json_encode($files);
        }
        if (!empty($request->Engineering_attachment)) {
            $files = [];
            if ($request->hasfile('Engineering_attachment')) {
                foreach ($request->file('Engineering_attachment') as $file) {
                    $name = $request->name . 'Engineering_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Engineering_attachment = json_encode($files);
        }
        if (!empty($request->Analytical_Development_attachment)) {
            $files = [];
            if ($request->hasfile('Analytical_Development_attachment')) {
                foreach ($request->file('Analytical_Development_attachment') as $file) {
                    $name = $request->name . 'Analytical_Development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Analytical_Development_attachment = json_encode($files);
        }
        if (!empty($request->Kilo_Lab_attachment)) {
            $files = [];
            if ($request->hasfile('Kilo_Lab_attachment')) {
                foreach ($request->file('Kilo_Lab_attachment') as $file) {
                    $name = $request->name . 'Kilo_Lab_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Kilo_Lab_attachment = json_encode($files);
        }
        if (!empty($request->Technology_transfer_attachment)) {
            $files = [];
            if ($request->hasfile('Technology_transfer_attachment')) {
                foreach ($request->file('Technology_transfer_attachment') as $file) {
                    $name = $request->name . 'Technology_transfer_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Technology_transfer_attachment = json_encode($files);
        }
        if (!empty($request->Environment_Health_Safety_attachment)) {
            $files = [];
            if ($request->hasfile('Environment_Health_Safety_attachment')) {
                foreach ($request->file('Environment_Health_Safety_attachment') as $file) {
                    $name = $request->name . 'Environment_Health_Safety_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Environment_Health_Safety_attachment = json_encode($files);
        }
        if (!empty($request->Human_Resource_attachment)) {
            $files = [];
            if ($request->hasfile('Human_Resource_attachment')) {
                foreach ($request->file('Human_Resource_attachment') as $file) {
                    $name = $request->name . 'Human_Resource_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Human_Resource_attachment = json_encode($files);
        }
        if (!empty($request->Information_Technology_attachment)) {
            $files = [];
            if ($request->hasfile('Information_Technology_attachment')) {
                foreach ($request->file('Information_Technology_attachment') as $file) {
                    $name = $request->name . 'Information_Technology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Information_Technology_attachment = json_encode($files);
        }
        if (!empty($request->Project_management_attachment)) {
            $files = [];
            if ($request->hasfile('Project_management_attachment')) {
                foreach ($request->file('Project_management_attachment') as $file) {
                    $name = $request->name . 'Project_management_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Project_management_attachment = json_encode($files);
        }
        if (!empty($request->Other1_attachment)) {
            $files = [];
            if ($request->hasfile('Other1_attachment')) {
                foreach ($request->file('Other1_attachment') as $file) {
                    $name = $request->name . 'Other1_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other1_attachment = json_encode($files);
        }
        if (!empty($request->Other2_attachment)) {
            $files = [];
            if ($request->hasfile('Other2_attachment')) {
                foreach ($request->file('Other2_attachment') as $file) {
                    $name = $request->name . 'Other2_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other2_attachment = json_encode($files);
        }
        if (!empty($request->Other3_attachment)) {
            $files = [];
            if ($request->hasfile('Other3_attachment')) {
                foreach ($request->file('Other3_attachment') as $file) {
                    $name = $request->name . 'Other3_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other3_attachment = json_encode($files);
        }
        if (!empty($request->Other4_attachment)) {
            $files = [];
            if ($request->hasfile('Other4_attachment')) {
                foreach ($request->file('Other4_attachment') as $file) {
                    $name = $request->name . 'Other4_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other4_attachment = json_encode($files);
        }
        if (!empty($request->Other5_attachment)) {
            $files = [];
            if ($request->hasfile('Other5_attachment')) {
                foreach ($request->file('Other5_attachment') as $file) {
                    $name = $request->name . 'Other5_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other5_attachment = json_encode($files);
        }
    

    $Cft->save();

    

   

    // $data3 = new DeviationGrid();
    // $data3->deviation_id = $deviation->id;
    // $data3->type = "Deviation";
    // if (!empty($request->ID_Number)) {
    //     $data3->ID_Number = serialize($request->ID_Number);
    // }
    // if (!empty($request->SystemName)) {
    //     $data3->SystemName = serialize($request->SystemName);
    // }

    // if (!empty($request->Instrument)) {
    //     $data3->Instrument = serialize($request->Instrument);
    // }
    // if (!empty($request->Equipment)) {
    //     $data3->Equipment = serialize($request->Equipment);
    // }
    // if (!empty($request->facility)) {
    //     $data3->facility = serialize($request->facility);
    // }
    
    // $data3->save();
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
        $data1 = DeviationCft::where('deviation_id', $id)->first();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        // $grid_data1 = DeviationGrid::where('deviation_id', $id)->where('type', "Deviation")->first();
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $pre = Deviation::all();
       $divisionName = DB::table('q_m_s_divisions')->where('id', $data->division_id)->value('name');

     return view('frontend.forms.deviation_view', compact('data', 'old_record', 'pre','data1', 'divisionName'));
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

        //CFT
        // $deviation->Production_Review= $request->Production_Review;
        // $deviation->Production_person= $request->Production_person;
         
        // $deviation->Production_assessment= $request->Production_assessment;
        // $deviation->Production_feedback= $request->Production_feedback;
        // $deviation->production_on= $request->production_on;

    
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

        // $Cft = new DeviationCft();
        $Cft = DeviationCft::withoutTrashed()->where('deviation_id', $id)->first();
        $Cft->Production_Review= $request->Production_Review;
        $Cft->Production_person= $request->Production_person;
        $Cft->Production_assessment= $request->Production_assessment;
        $Cft->Production_feedback= $request->Production_feedback;
        $Cft->production_on= $request->production_on;
        $Cft->Production_Review_Completed_By= $request->Production_Review_Completed_By;
          
        $Cft->Warehouse_review= $request->Warehouse_review;
        $Cft->Warehouse_notification= $request->Warehouse_notification;
        $Cft->Warehouse_assessment= $request->Warehouse_assessment;
        $Cft->Warehouse_feedback= $request->Warehouse_feedback;
        $Cft->Warehouse_Review_Completed_By= $request->Warehouse_Review_Completed_By;
        $Cft->Warehouse_Review_Completed_On= $request->Warehouse_Review_Completed_On;

        $Cft->Quality_review= $request->Quality_review;
        $Cft->Quality_Control_Person= $request->Quality_Control_Person;
        $Cft->Quality_Control_assessment= $request->Quality_Control_assessment;
        $Cft->Quality_Control_feedback= $request->Quality_Control_feedback;
        $Cft->Quality_Control_by= $request->Quality_Control_by;
        $Cft->Quality_Control_on= $request->Quality_Control_on;

        $Cft->Quality_Assurance_Review= $request->Quality_Assurance_Review;
        $Cft->QualityAssurance_person= $request->QualityAssurance_person;
        $Cft->QualityAssurance_assessment= $request->QualityAssurance_assessment;
        $Cft->QualityAssurance_feedback= $request->QualityAssurance_feedback;
        $Cft->QualityAssurance_by= $request->QualityAssurance_by;
        $Cft->QualityAssurance_on= $request->QualityAssurance_on;

        $Cft->Engineering_review= $request->Engineering_review;
        $Cft->Engineering_person= $request->Engineering_person;
        $Cft->Engineering_assessment= $request->Engineering_assessment;
        $Cft->Engineering_feedback= $request->Engineering_feedback;
        $Cft->Engineering_by= $request->Engineering_by;
        $Cft->Engineering_on= $request->Engineering_on;

        $Cft->Analytical_Development_review= $request->Analytical_Development_review;
        $Cft->Analytical_Development_person= $request->Analytical_Development_person;
        $Cft->Analytical_Development_assessment= $request->Analytical_Development_assessment;
        $Cft->Analytical_Development_feedback= $request->Analytical_Development_feedback;
        $Cft->Analytical_Development_by= $request->Analytical_Development_by;
        $Cft->Analytical_Development_on= $request->Analytical_Development_on;

        $Cft->Kilo_Lab_review= $request->Kilo_Lab_review;
        $Cft->Kilo_Lab_person= $request->Kilo_Lab_person;
        $Cft->Kilo_Lab_assessment= $request->Kilo_Lab_assessment;
        $Cft->Kilo_Lab_feedback= $request->Kilo_Lab_feedback;
        $Cft->Kilo_Lab_attachment_by= $request->Kilo_Lab_attachment_by;
        $Cft->Kilo_Lab_attachment_on= $request->Kilo_Lab_attachment_on;

        $Cft->Technology_transfer_review= $request->Technology_transfer_review;
        $Cft->Technology_transfer_person= $request->Technology_transfer_person;
        $Cft->Technology_transfer_assessment= $request->Technology_transfer_assessment;
        $Cft->Technology_transfer_feedback= $request->Technology_transfer_feedback;
        $Cft->Technology_transfer_by= $request->Technology_transfer_by;
        $Cft->Technology_transfer_on= $request->Technology_transfer_on;

        $Cft->Environment_Health_review= $request->Environment_Health_review;
        $Cft->Environment_Health_Safety_person= $request->Environment_Health_Safety_person;
        $Cft->Health_Safety_assessment= $request->Health_Safety_assessment;
        $Cft->Health_Safety_feedback= $request->Health_Safety_feedback;
        $Cft->Environment_Health_Safety_by= $request->Environment_Health_Safety_by;
        $Cft->Environment_Health_Safety_on= $request->Environment_Health_Safety_on;

        $Cft->Human_Resource_review= $request->Human_Resource_review;
        $Cft->Human_Resource_person= $request->Human_Resource_person;
        $Cft->Human_Resource_assessment= $request->Human_Resource_assessment;
        $Cft->Human_Resource_feedback= $request->Human_Resource_feedback;
        $Cft->Human_Resource_by= $request->Human_Resource_by;
        $Cft->Human_Resource_on= $request->Human_Resource_on;

        $Cft->Information_Technology_review= $request->Information_Technology_review;
        $Cft->Information_Technology_person= $request->Information_Technology_person;
        $Cft->Information_Technology_assessment= $request->Information_Technology_assessment;
        $Cft->Information_Technology_feedback= $request->Information_Technology_feedback;
        $Cft->Information_Technology_by= $request->Information_Technology_by;
        $Cft->Information_Technology_on= $request->Information_Technology_on;

        $Cft->Project_management_review= $request->Project_management_review;
        $Cft->Project_management_person= $request->Project_management_person;
        $Cft->Project_management_assessment= $request->Project_management_assessment;
        $Cft->Project_management_feedback= $request->Project_management_feedback;
        $Cft->Project_management_by= $request->Project_management_by;
        $Cft->Project_management_on= $request->Project_management_on;
     
        $Cft->Other1_review= $request->Other1_review;
        $Cft->Other1_person= $request->Other1_person;
        $Cft->Other1_Department_person= $request->Other1_Department_person;
        $Cft->Other1_assessment= $request->Other1_assessment;
        $Cft->Other1_feedback= $request->Other1_feedback;
        $Cft->Other1_by= $request->Other1_by;
        $Cft->Other1_on= $request->Other1_on;

        $Cft->Other2_review= $request->Other2_review;
        $Cft->Other2_person= $request->Other2_person;
        $Cft->Other2_Department_person= $request->Other2_Department_person;
        $Cft->Other2_Assessment= $request->Other2_Assessment;
        $Cft->Other2_feedback= $request->Other2_feedback;
        $Cft->Other2_by= $request->Other2_by;
        $Cft->Other2_on= $request->Other2_on;

        $Cft->Other3_review= $request->Other3_review;
        $Cft->Other3_person= $request->Other3_person;
        $Cft->Other3_Department_person= $request->Other3_Department_person;
        $Cft->Other3_Assessment= $request->Other3_Assessment;
        $Cft->Other3_feedback= $request->Other3_feedback;
        $Cft->Other3_by= $request->Other3_by;
        $Cft->Other3_on= $request->Other3_on;

        $Cft->Other4_review= $request->Other4_review;
        $Cft->Other4_person= $request->Other4_person;
        $Cft->Other4_Department_person= $request->Other4_Department_person;
        $Cft->Other4_Assessment= $request->Other4_Assessment;
        $Cft->Other4_feedback= $request->Other4_feedback;
        $Cft->Other4_by= $request->Other4_by;
        $Cft->Other4_on= $request->Other4_on;

        $Cft->Other5_review= $request->Other5_review;
        $Cft->Other5_person= $request->Other5_person;
        $Cft->Other5_Department_person= $request->Other5_Department_person;
        $Cft->Other5_Assessment= $request->Other5_Assessment;
        $Cft->Other5_feedback= $request->Other5_feedback;
        $Cft->Other5_by= $request->Other5_by;
        $Cft->Other5_on= $request->Other5_on;

        if (!empty($request->production_attachment)) {
            $files = [];
            if ($request->hasfile('production_attachment')) {
                foreach ($request->file('production_attachment') as $file) {
                    $name = $request->name . 'production_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->production_attachment = json_encode($files);
        }
        if (!empty($request->Warehouse_attachment)) {
            $files = [];
            if ($request->hasfile('Warehouse_attachment')) {
                foreach ($request->file('Warehouse_attachment') as $file) {
                    $name = $request->name . 'Warehouse_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Warehouse_attachment = json_encode($files);
        }
        if (!empty($request->Quality_Control_attachment)) {
            $files = [];
            if ($request->hasfile('Quality_Control_attachment')) {
                foreach ($request->file('Quality_Control_attachment') as $file) {
                    $name = $request->name . 'Quality_Control_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Quality_Control_attachment = json_encode($files);
        }
        if (!empty($request->Quality_Assurance_attachment)) {
            $files = [];
            if ($request->hasfile('Quality_Assurance_attachment')) {
                foreach ($request->file('Quality_Assurance_attachment') as $file) {
                    $name = $request->name . 'Quality_Assurance_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Quality_Assurance_attachment = json_encode($files);
        }
        if (!empty($request->Engineering_attachment)) {
            $files = [];
            if ($request->hasfile('Engineering_attachment')) {
                foreach ($request->file('Engineering_attachment') as $file) {
                    $name = $request->name . 'Engineering_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Engineering_attachment = json_encode($files);
        }
        if (!empty($request->Analytical_Development_attachment)) {
            $files = [];
            if ($request->hasfile('Analytical_Development_attachment')) {
                foreach ($request->file('Analytical_Development_attachment') as $file) {
                    $name = $request->name . 'Analytical_Development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Analytical_Development_attachment = json_encode($files);
        }
        if (!empty($request->Kilo_Lab_attachment)) {
            $files = [];
            if ($request->hasfile('Kilo_Lab_attachment')) {
                foreach ($request->file('Kilo_Lab_attachment') as $file) {
                    $name = $request->name . 'Kilo_Lab_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Kilo_Lab_attachment = json_encode($files);
        }
        if (!empty($request->Technology_transfer_attachment)) {
            $files = [];
            if ($request->hasfile('Technology_transfer_attachment')) {
                foreach ($request->file('Technology_transfer_attachment') as $file) {
                    $name = $request->name . 'Technology_transfer_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Technology_transfer_attachment = json_encode($files);
        }
        if (!empty($request->Environment_Health_Safety_attachment)) {
            $files = [];
            if ($request->hasfile('Environment_Health_Safety_attachment')) {
                foreach ($request->file('Environment_Health_Safety_attachment') as $file) {
                    $name = $request->name . 'Environment_Health_Safety_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Environment_Health_Safety_attachment = json_encode($files);
        }
        if (!empty($request->Human_Resource_attachment)) {
            $files = [];
            if ($request->hasfile('Human_Resource_attachment')) {
                foreach ($request->file('Human_Resource_attachment') as $file) {
                    $name = $request->name . 'Human_Resource_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Human_Resource_attachment = json_encode($files);
        }
        if (!empty($request->Information_Technology_attachment)) {
            $files = [];
            if ($request->hasfile('Information_Technology_attachment')) {
                foreach ($request->file('Information_Technology_attachment') as $file) {
                    $name = $request->name . 'Information_Technology_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Information_Technology_attachment = json_encode($files);
        }
        if (!empty($request->Project_management_attachment)) {
            $files = [];
            if ($request->hasfile('Project_management_attachment')) {
                foreach ($request->file('Project_management_attachment') as $file) {
                    $name = $request->name . 'Project_management_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Project_management_attachment = json_encode($files);
        }
        if (!empty($request->Other1_attachment)) {
            $files = [];
            if ($request->hasfile('Other1_attachment')) {
                foreach ($request->file('Other1_attachment') as $file) {
                    $name = $request->name . 'Other1_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other1_attachment = json_encode($files);
        }
        if (!empty($request->Other2_attachment)) {
            $files = [];
            if ($request->hasfile('Other2_attachment')) {
                foreach ($request->file('Other2_attachment') as $file) {
                    $name = $request->name . 'Other2_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other2_attachment = json_encode($files);
        }
        if (!empty($request->Other3_attachment)) {
            $files = [];
            if ($request->hasfile('Other3_attachment')) {
                foreach ($request->file('Other3_attachment') as $file) {
                    $name = $request->name . 'Other3_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other3_attachment = json_encode($files);
        }
        if (!empty($request->Other4_attachment)) {
            $files = [];
            if ($request->hasfile('Other4_attachment')) {
                foreach ($request->file('Other4_attachment') as $file) {
                    $name = $request->name . 'Other4_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other4_attachment = json_encode($files);
        }
        if (!empty($request->Other5_attachment)) {
            $files = [];
            if ($request->hasfile('Other5_attachment')) {
                foreach ($request->file('Other5_attachment') as $file) {
                    $name = $request->name . 'Other5_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $Cft->Other5_attachment = json_encode($files);
        }
    

    $Cft->save();

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
            $cftDetails = DeviationCftsResponse::withoutTrashed()->where(['status'=>'In-progress', 'deviation_id' => $id])->distinct('cft_user_id')->count();
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
                          
                            //   Mail::send(
                            //       'mail.view-mail',
                            //        ['data' => $deviation],
                            //     function ($message) use ($email) {
                            //         $message->to($email)
                            //             ->subject("Document is Submitted By ".Auth::user()->name);
                            //     }
                            //   );
                            }
                     } 
                  }
           
                $deviation->update();

                // $data3=DeviationGrid::where('deviation_id', $deviation->id)->where('type', "Deviation")->first();
                // if (!empty($request->ID_Number)) {
                //     $data3->ID_Number = serialize($request->ID_Number);
                // }
                // if (!empty($request->SystemName)) {
                //     $data3->SystemName = serialize($request->SystemName);
                // }
            
                // if (!empty($request->Instrument)) {
                //     $data3->Instrument = serialize($request->Instrument);
                // }
                // if (!empty($request->Equipment)) {
                //     $data3->Equipment = serialize($request->Equipment);
                // }
                // if (!empty($request->facility)) {
                //     $data3->facility = serialize($request->facility);
                // }
                // toastr()->success('Document Sent');
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
                        // Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("Plan Approved By ".Auth::user()->name);
                        //     }
                        // );
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

                // Code for the CFT required 
                $stage = new DeviationCftsResponse();
                $stage->deviation_id = $id;
                $stage->cft_user_id = Auth::user()->id;
                $stage->status = "CFT Required";
                // $stage->cft_stage = ;
                $stage->comment = $request->comment;
                $stage->is_required = 1;
                $stage->save();

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
                        // Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("Plan Approved By ".Auth::user()->name);
                        //     }
                        // );
                    }
                  } 
                }
                $deviation->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 4) {
                
                $IsCFTRequired = DeviationCftsResponse::withoutTrashed()->where(['is_required'=>1, 'deviation_id' => $id])->latest()->first();
                $cftUsers = DB::table('deviationcfts')->where(['deviation_id' => $id])->first();
                // dd('wjh');

                // dd($cftUsers);
                            // Define the column names
                            $columns = ['Production_person', 'Warehouse_notification', 'Quality_Control_Person', 'QualityAssurance_person', 'Engineering_person', 'Analytical_Development_person', 'Kilo_Lab_person', 'Technology_transfer_person', 'Environment_Health_Safety_person', 'Human_Resource_person', 'Information_Technology_person', 'Project_management_person'];
                            // $columns2 = ['Production_review', 'Warehouse_review', 'Quality_Control_review', 'QualityAssurance_review', 'Engineering_review', 'Analytical_Development_review', 'Kilo_Lab_review', 'Technology_transfer_review', 'Environment_Health_Safety_review', 'Human_Resource_review', 'Information_Technology_review', 'Project_management_review'];

                            // Initialize an array to store the values
                            $valuesArray = [];

                            // Iterate over the columns and retrieve the values
                            foreach ($columns as $column) {
                                $value = $cftUsers->$column;
                                // Check if the value is not null and not equal to 0
                                if ($value != null && $value != 0) {
                                    $valuesArray[] = $value;
                                }
                            }
                            // dd($valuesArray, count(array_unique($valuesArray)), ($cftDetails+1));
                if($IsCFTRequired){
                    if(count(array_unique($valuesArray)) == ($cftDetails+1)){
                        $stage = new DeviationCftsResponse();
                        $stage->deviation_id = $id;
                        $stage->cft_user_id = Auth::user()->id;
                        $stage->status = "Completed";
                        // $stage->cft_stage = ;
                        $stage->comment = $request->comment;
                        $stage->save();
                    }
                    else{
                        $stage = new DeviationCftsResponse();
                        $stage->deviation_id = $id;
                        $stage->cft_user_id = Auth::user()->id;
                        $stage->status = "In-progress";
                        // $stage->cft_stage = ;
                        $stage->comment = $request->comment;
                        $stage->save();
                    }
                }
                
                $checkCFTCount = DeviationCftsResponse::withoutTrashed()->where(['status'=>'Completed', 'deviation_id' => $id])->count();
                // dd(count(array_unique($valuesArray)), $checkCFTCount);

                if(!$IsCFTRequired || $checkCFTCount){
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
                            // Mail::send(
                            //     'mail.view-mail',
                            //     ['data' => $deviation],
                            //     function ($message) use ($email) {
                            //         $message->to($email)
                            //             ->subject("Plan Approved By ".Auth::user()->name);
                            //     }
                            // );
                        }
                      } 
                    }
                    $deviation->update();
                }
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
                        // Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("Plan Approved By ".Auth::user()->name);
                        //     }
                        // );
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
                        // Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("Plan Approved By ".Auth::user()->name);
                        //     }
                        // );
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
                    
                    // Mail::send(
                    //     'mail.view-mail',
                    //     ['data' => $deviation],
                    //     function ($message) use ($email) {
                    //         $message->to($email)
                    //             ->subject("Cancelled By ".Auth::user()->name);
                    //     }
                    //  );
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

    public function deviationIsCFTRequired(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
            $deviation->stage = "5";
                    $deviation->status = "QA Final Review";
                    $deviation->CFT_Review_Complete_By = Auth::user()->name;
                    $deviation->CFT_Review_Complete_On = Carbon::now()->format('d-M-Y');
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
                            $history->stage = 'Send to HOD';
                            foreach ($list as $u) {
                                if($u->q_m_s_divisions_id == $deviation->division_id){
                                $email = Helpers::getInitiatorEmail($u->user_id);
                                if ($email !== null) {
                                   
                                    // Mail::send(
                                    //     'mail.view-mail',
                                    //     ['data' => $deviation],
                                    //     function ($message) use ($email) {
                                    //         $message->to($email)
                                    //             ->subject("More Info Required ".Auth::user()->name);
                                    //     }
                                    // );
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
                    $history->status = $deviation->status;
                    $history->save();

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function cftReview(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
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
                                   
                                    // Mail::send(
                                    //     'mail.view-mail',
                                    //     ['data' => $deviation],
                                    //     function ($message) use ($email) {
                                    //         $message->to($email)
                                    //             ->subject("More Info Required ".Auth::user()->name);
                                    //     }
                                    // );
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
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function sendToHod(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
            $cftResponse = DeviationCftsResponse::withoutTrashed()->where(['deviation_id' => $id])->get();

                // Soft delete all records
                $cftResponse->each(function ($response) {
                    $response->delete();
                });
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
                                   
                                    // Mail::send(
                                    //     'mail.view-mail',
                                    //     ['data' => $deviation],
                                    //     function ($message) use ($email) {
                                    //         $message->to($email)
                                    //             ->subject("More Info Required ".Auth::user()->name);
                                    //     }
                                    // );
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
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    
    public function sendToQA(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
            $cftResponse = DeviationCftsResponse::withoutTrashed()->where(['deviation_id' => $id])->get();

                // Soft delete all records
                $cftResponse->each(function ($response) {
                    $response->delete();
                });

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
                                   
                                    // Mail::send(
                                    //     'mail.view-mail',
                                    //     ['data' => $deviation],
                                    //     function ($message) use ($email) {
                                    //         $message->to($email)
                                    //             ->subject("More Info Required ".Auth::user()->name);
                                    //     }
                                    // );
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
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function sendToInitiator(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $deviation = Deviation::find($id);
            $lastDocument = Deviation::find($id);
            $list = Helpers::getInitiatorUserList();
            $cftResponse = DeviationCftsResponse::withoutTrashed()->where(['deviation_id' => $id])->get();

                // Soft delete all records
                $cftResponse->each(function ($response) {
                    $response->delete();
                });


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
                           
                            // Mail::send(
                            //     'mail.view-mail',
                            //     ['data' => $deviation],
                            //     function ($message) use ($email) {
                            //         $message->to($email)
                            //             ->subject("More Info Required ".Auth::user()->name);
                            //     }
                            // );
                          }
                        } 
                    }
                    $history->save();

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
                        //  Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("Document is Send By ".Auth::user()->name);
                        //     }
                        // );
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
                    //  Mail::send(
                    //     'mail.view-mail',
                    //     ['data' => $deviation],
                    //     function ($message) use ($email) {
                    //         $message->to($email)
                    //             ->subject("Document is Send By ".Auth::user()->name);
                    //     }
                    // );
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
                       
                        // Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("More Info Required ".Auth::user()->name);
                        //     }
                        // );
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
                       
                        // Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("More Info Required ".Auth::user()->name);
                        //     }
                        // );
                      }
                    } 
                }
                $history->save();

                toastr()->success('Document Sent');
                return back();
            }
            if ($deviation->stage == 4) {

                $cftResponse = DeviationCftsResponse::withoutTrashed()->where(['deviation_id' => $id])->get();

                // Soft delete all records
                $cftResponse->each(function ($response) {
                    $response->delete();
                });

                    $stage = new DeviationCftsResponse();
                    $stage->deviation_id = $id;
                    $stage->cft_user_id = Auth::user()->id;
                    $stage->status = "More Info Required";
                    // $stage->cft_stage = ;
                    $stage->comment = $request->comment;
                    $stage->save();

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
                       
                        // Mail::send(
                        //     'mail.view-mail',
                        //     ['data' => $deviation],
                        //     function ($message) use ($email) {
                        //         $message->to($email)
                        //             ->subject("More Info Required ".Auth::user()->name);
                        //     }
                        // );
                      }
                    } 
                }
                $history->save();
                toastr()->success('Document Sent');
                return back();
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
                               
                                // Mail::send(
                                //     'mail.view-mail',
                                //     ['data' => $deviation],
                                //     function ($message) use ($email) {
                                //         $message->to($email)
                                //             ->subject("More Info Required ".Auth::user()->name);
                                //     }
                                // );
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
            $Extensionchild = Deviation::find($id);
            $Extensionchild->Extensionchild = $record_number;
            $Extensionchild->save();
            return view('frontend.forms.extension', compact('parent_id', 'parent_name', 'record_number', 'parent_due_date'));
        }
        $old_record = Deviation::select('id', 'division_id', 'record')->get();
        if ($request->child_type == "capa") {
            $parent_name = "CAPA";
            $Capachild = Deviation::find($id);
            $Capachild->Capachild = $record_number;
            $Capachild->save();
            return view('frontend.forms.capa', compact('parent_id','parent_type',  'record_number', 'due_date', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record','old_record','cft'));
        } else {
            $parent_name = "Root";
            $Rootchild = Deviation::find($id);
            $Rootchild->Rootchild = $record_number;
            $Rootchild->save();
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
    public static function singleReport($id)
    {
        $data = Deviation::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.forms.singleReportdeviation', compact('data'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('Deviation' . $id . '.pdf');
        }
    }
    public static function parentchildReport($id)
    {
        $data = Deviation::find($id);
       
        $Capachild = $data->Capachild;
        $Rootchild = $data->Rootchild;
        $Extensionchild = $data->Extensionchild;
         $data1 = Capa::where('record', $Capachild)->first();
         $data2 = RootCauseAnalysis::where('record', $Rootchild)->first();
          
         $data3 = Extension::where('record', $Extensionchild)->first();
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.forms.deviationparentchildReport', compact('data','data1','data2','data3'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('Deviation' . $id . '.pdf');
        }
    }

}
