<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Capa;
use App\Models\CC;
use App\Models\EffectivenessCheck;
use App\Models\Extension;
use App\Models\InternalAudit;
use App\Models\ManagementReview;
use App\Models\RiskManagement;
use App\Models\LabIncident;
use App\Models\Auditee;
use App\Models\AuditProgram;
use App\Models\RootCauseAnalysis;
use App\Models\Observation;
use App\Models\QMSDivision;
use App\Models\User;
use App\Models\Deviation;
use Carbon\Carbon;
use Helpers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class DesktopController extends Controller
{
    public function rcms_desktop()
    {
        $table = [];
        $change_control = CC::orderByDesc('id')->get();
        $action_item = ActionItem::orderByDesc('id')->get();
        $extention = Extension::orderByDesc('id')->get();
        $effectiveness_check = EffectivenessCheck::orderByDesc('id')->get();
        $internal_audit = InternalAudit::orderByDesc('id')->get();
        $capa = Capa::orderByDesc('id')->get();
        $risk_management = RiskManagement::orderByDesc('id')->get();
        $management_review = ManagementReview::orderByDesc('id')->get();
        $labincident = LabIncident::orderByDesc('id')->get();
        $external_audit = Auditee::orderByDesc('id')->get();
        $audit_pragram = AuditProgram::orderByDesc('id')->get();
        $root_cause_analysis = RootCauseAnalysis::orderByDesc('id')->get();
        $observation = Observation::orderByDesc('id')->get();
        $Deviation = Deviation::orderByDesc('id')->get();


        foreach ($change_control as $data) {

            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Change-Control";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }

        foreach ($action_item as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Action-item";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($extention as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Extention";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($effectiveness_check as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Effectiveness-check";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($internal_audit as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Internal-Audit";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($capa as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Capa";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($risk_management as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Risk-Assesment";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($management_review as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Management-Review";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($labincident as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Lab-Incident";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($external_audit as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "External-Audit";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($audit_pragram as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Audit-Program";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($root_cause_analysis as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Root-Cause-Analysis";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($observation as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Observation";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($Deviation as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Deviation";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }

        //   return $table;

        return view('frontend.rcms.desktop', compact(
            'observation',
            'root_cause_analysis',
            'audit_pragram',
            'external_audit',
            'management_review',
            'labincident',
            'risk_management',
            'capa',
            'internal_audit',
            'effectiveness_check',
            'extention',
            'action_item',
            'observation',
            'change_control',
            'Deviation'
        ));
    }


    public function dashboard_search(Request $request)
    {
        // return $request;

        if ($request->form == "internal_audit") {
            $data = InternalAudit::where('status', $request->stage)->get();
            return $data;
            return view('frontend.rcms.desktop', compact('data'));
        }
    }
    public function fetchChartData(Request $request)
    {
        $allDivisionCodes = QMSDivision::Where('q_m_s_divisions.status',1)
        ->pluck('name')->toArray();
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Deviation') {
            $internalAuditData = QMSDivision::Join('deviations', 'deviations.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        }else {
            $internalAuditData = [];
        }
        // $chartData = [];
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }

    public function fetchChartDataDepartment(Request $request)
    {
        $allDivisionCodes=['CQA','QAB','CQC','MANU','PSG','CS','ITG','MM','CL','TT','QA','QM','IA','ACC','LOG','SM','BA'];
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('internal_audits.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('auditees.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('extensions.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('capas.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('audit_programs.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('lab_incidents.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('risk_management.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('root_cause_analyses.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('management_reviews.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('c_c_s.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('action_items.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('effectiveness_checks.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('documents.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('observations.Initiator_Group as division_code')
                ->get();
        } else if ($request->value == 'Deviation') {
            $internalAuditData = QMSDivision::Join('deviations', 'deviations.division_id', '=', 'q_m_s_divisions.id')
                ->select('deviations.Initiator_Group as division_code')
                ->get();
        }else {
            $internalAuditData = [];
        }
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }
    public function fetchChartDataDepartmentReleted(Request $request)
    {
        $allDivisionCodes=['Facility','Equipment/Instrument','Documentationerror','STP/ADS_instruction','Packaging&Labelling','Material_System','Laboratory_Instrument/System',' Utility_System','Computer_System','Document','Data integrity','Anyother(specify)'    ];
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('internal_audits.audit_type as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('auditees.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('extensions.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('capas.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('audit_programs.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('lab_incidents.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('risk_management.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('root_cause_analyses.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('management_reviews.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('c_c_s.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('action_items.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('effectiveness_checks.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('documents.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('observations.audit_type as division_code')
                ->get();
        } else if ($request->value == 'Deviation') {
            $internalAuditData = QMSDivision::Join('deviations', 'deviations.division_id', '=', 'q_m_s_divisions.id')
                ->select('deviations.audit_type as division_code')
                ->get();
        }else {
            $internalAuditData = [];
        }
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }
    public function fetchChartDataInitialDeviationCategory(Request $request)
    {
        $allDivisionCodes=['minor','major','critical'];
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('internal_audits.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('auditees.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('extensions.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('capas.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('audit_programs.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('lab_incidents.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('risk_management.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('root_cause_analyses.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('management_reviews.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('c_c_s.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('action_items.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('effectiveness_checks.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('documents.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('observations.Deviation_category as division_code')
                ->get();
        } else if ($request->value == 'Deviation') {
            $internalAuditData = QMSDivision::Join('deviations', 'deviations.division_id', '=', 'q_m_s_divisions.id')
                ->select('deviations.Deviation_category as division_code')
                ->get();
        }else {
            $internalAuditData = [];
        }
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }
    public function fetchChartDataPostCategorizationOfDeviation(Request $request)
    {
        $allDivisionCodes=['yes','no'];
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('internal_audits.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('auditees.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('extensions.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('capas.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('audit_programs.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('lab_incidents.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('risk_management.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('root_cause_analyses.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('management_reviews.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('c_c_s.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('action_items.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('effectiveness_checks.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('documents.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('observations.Post_Categorization as division_code')
                ->get();
        } else if ($request->value == 'Deviation') {
            $internalAuditData = QMSDivision::Join('deviations', 'deviations.division_id', '=', 'q_m_s_divisions.id')
                ->select('deviations.Post_Categorization as division_code')
                ->get();
        }else {
            $internalAuditData = [];
        }
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }
    public function fetchChartDataCapa(Request $request)
    {
        $allDivisionCodes=['yes','no'];
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('internal_audits.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('auditees.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('extensions.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('capas.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('audit_programs.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('lab_incidents.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('risk_management.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('root_cause_analyses.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('management_reviews.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('c_c_s.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('action_items.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('effectiveness_checks.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('documents.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('observations.CAPA_Rquired as division_code')
                ->get();
        } else if ($request->value == 'Deviation') {
            $internalAuditData = QMSDivision::Join('deviations', 'deviations.division_id', '=', 'q_m_s_divisions.id')
                ->select('deviations.CAPA_Rquired as division_code')
                ->get();
        }else {
            $internalAuditData = [];
        }
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }
    public function fatchStatuswise(Request $request)
    {
        $allDivisionCodes=['Opened','HOD Review','QA Initial Review','CFT Review','QA Final Review','Approval','Closed - Done'];
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('internal_audits.status as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('auditees.status as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('extensions.status as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('capas.status as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('audit_programs.status as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('lab_incidents.status as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('risk_management.status as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('root_cause_analyses.status as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('management_reviews.status as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('c_c_s.status as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('action_items.status as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('effectiveness_checks.status as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('documents.status as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('observations.status as division_code')
                ->get();
        } else if ($request->value == 'Deviation') {
            $internalAuditData = QMSDivision::Join('deviations', 'deviations.division_id', '=', 'q_m_s_divisions.id')
                ->select('deviations.status as division_code')
                ->get();
        }else {
            $internalAuditData = [];
        }
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }
}
