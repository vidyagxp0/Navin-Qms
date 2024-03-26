@extends('frontend.layout.main')
@section('container')
    <div id="audit-inner">
        <div class="container-fluid">
            <div class="audit-inner-container">

                
                <style>
                        header .head {
                                font-weight: bold;
                                text-align: center;
                                font-size: 1.2rem;
                            }

                            @page {
                                size: A4;
                                margin-top: 160px;
                                margin-bottom: 60px;
                            }

                            header {
                                /* position: fixed; */
                                top: -140px;
                                left: 0;
                                width: 100%;
                                display: block;
                            }
                            .heading{
                                        border: 1px solid black;
                                    padding: 10px;
                                    margin-bottom: 10px;
                                    margin-top: 10px;
                                    background: #E8A936;
                                    }
                            footer {
                        
                                                bottom: -40px;
                                                left: 0;
                                                width: 100%;
                                    } 
                </style>
                    <header>
                        <table>
                            <tr>
                                <td class="w-70 head">
                                Audit Trail
                                </td>
                                <td class="w-30">
                                    <div class="logo">
                                        <img src="https://development.vidyagxp.com/public/user/images/logo.png" alt="" class="w-100">
                                    </div>
                                </td>
                            </tr>
                        </table>
                     
                        <table>
                            <div class="heading">
                                <div style="margin-bottom: 5px;  font-weight: bold;"> ID :000{{$doc->record}}</</div>
                                <div style="margin-bottom: 5px;  font-weight: bold;"> Originator :{{ Auth::user()->name }}</div>
                                <div style="margin-bottom: 5px; font-weight: bold;">Short Description : {{$doc->short_description}}</div>
                                <div style="margin-bottom: 5px;  font-weight: bold;">Due Date Status :  {{$doc->due_date}}</div>
                    
                            </div>
                        
                        </table>
                        
                    </header>
                    @foreach($detail_data as $temp)
                        <div class="inner-block audit-main">
                            <div class="info-list">
                                <div class="list-item">
                                    <div class="head">Changed From</div>
                                    <div>:</div>
                                    <div>{{empty( $temp->origin_state) ? 'Not Applicable' : $temp->origin_state }}</div>
                                </div>
                                <div class="list-item">
                                    <div class="head">Changed To</div>
                                    <div>:</div>
                                    <div>{{ empty($temp->user_role) ? 'Not Applicable' : $temp->user_role }}</div>
                                </div>
                                @if($temp->comment)
                                <div class="list-item">
                                    <div class="head">Comments</div>
                                    <div>:</div>
                                    <div>{{ $temp->comment }}</div>
                                </div>
                                @endif
                                <div class="list-item">
                                    <div class="head">Data Field Name</div>
                                    <div>:</div>
                                    {{-- <div>{{ Helpers::getdateFormat1($temp->created_at) }}</div> --}}
                                    <div>{{empty( $temp->activity_type) ? 'Not Applicable' : $temp->activity_type }}</div>
                                </div>
                                    <div class="list-item">
                                        <div class="head">Changed From</div>
                                        <div>:</div>
                                        <div>{{ $temp->origin_state }}</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="head">Changed To</div>
                                        <div>:</div>
                                        <div>{{ empty($temp->user_role) ? 'Not Applicable' : $temp->user_role }}</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="head">Change Type</div>
                                        <div>:</div>
                                        <div>{{ empty($temp->action_name) ? 'Not Applicable' : $temp->action_name }}</div>
                                    </div>
                                    
                                    @if($temp->comment)
                                    <div class="list-item">
                                        <div class="head">Comments</div>
                                        <div>:</div>
                                        <div>{{ $temp->comment }}</div>
                                    </div>
                                    @endif
                                    <div class="list-item">
                                        <div class="head">Action Name</div>
                                        <div>:</div>
                                        <div>{{ empty($temp->action_name) ? 'Not Applicable' : $temp->action_name }}</div>
                                    </div>
                                    
                                    <div class="list-item">
                                        <div class="head">Peformed By</div>
                                        <div>:</div>
                                        <div>{{ empty($temp->user_name) ? 'Not Applicable' : $temp->user_name }}</div>

                                    </div>
                                    <div class="list-item">
                                        <div class="head">Performed On</div>
                                        <div>:</div>
                                        <div>
                                            {{ empty($temp->created_at) ? 'Not Applicable' : Helpers::getdateFormat1($temp->created_at) }}
                                        </div>
                                    </div>
                                    
                                    @if($temp->comment)
                                        <div class="list-item">
                                            <div class="head">Comments </div>
                                            <div>:</div>
                                            <div>{{ $temp->comment }}</div>
                                        </div>
                                    @endif 


                                {{-- @if($temp->activity_type == "Responsibility" ||$temp->activity_type == "Abbreviation" ||$temp->activity_type == "Defination" ||$temp->activity_type == "Materials and Equipments" ||$temp->activity_type == "Reporting" )
                                @if(!empty($temp->previous)) --}}
                                {{-- <div class="list-item">
                                    <div class="head">Changed From</div>
                                    <div>:</div>
                                    @foreach (unserialize($temp->previous) as $data)
                                    @if($data)
                                    <div>{{ $data }}</div>
                                    @else
                                    <div>NULL</div>
                                    @endif
                                    @endforeach

                                </div> --}}
                                {{-- @else --}}
                                {{-- <div class="list-item">
                                    <div class="head">Changed From</div>
                                    <div>:</div>
                                    <div>NULL</div>
                                </div> --}}
                                {{-- @endif --}}
                                {{-- @if($temp->current != $temp->previous)
                                {{-- <div class="list-item">
                                    <div class="head">Changed To</div>
                                    <div>:</div>
                                    @foreach (unserialize($temp->current) as $data)
                                    <div>{{ $data }}</div>
                                    @endforeach

                                </div>
                                @endif --}}
                                {{-- @else --}}
                                {{-- @if(!empty($temp->previous)) --}}
                                {{-- <div class="list-item">
                                    <div class="head">Changed From</div>
                                    <div>:</div>
                                    <div>{{ $temp->previous }}</div>
                                </div> --}}
                                {{-- @else --}}
                                {{-- <div class="list-item">
                                    <div class="head">Changed From</div>
                                    <div>:</div>
                                    <div>NULL</div>
                                </div> --}}
                                {{-- @endif --}}
                                {{-- @if($temp->current != $temp->previous) --}}
                                {{-- <div class="list-item">
                                    <div class="head">Changed To</div>
                                    <div>:</div>
                                    <div>{{ $temp->current }}</div>
                                </div> --}}
                                {{-- @endif
                                @endif --}}
                                {{-- @if($temp->current != $temp->previous)
                                @if($temp->activity_type == "Activity Log" )

                            
                                        <div class="list-item">
                                        <div class="head">{{$temp->stage}} By</div>
                                        <div>:</div>
                                        <div> {{$temp->current}}</div>
                                        </div>  
                                        <div class="list-item">
                                        <div class="head">{{$temp->stage}} On</div>
                                        <div>:</div>
                                        <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                        </div> 
                                        {{-- @elseif($temp->origin_state =="In Progress") 
                                        
                                        <div class="list-item">
                                        <div class="head">{{$temp->stage}} By</div>
                                        <div>:</div>
                                        <div> {{$temp->current}}</div>
                                        </div>  
                                        <div class="list-item">
                                        <div class="head">Submited On</div>
                                        <div>:</div>
                                        <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                        </div> 
                                        @elseif($temp->origin_state =="Pending HOD Approval") 
                                        <div class="list-item">
                                        <div class="head">Plan Approved By</div>
                                        <div>:</div>
                                        <div> {{$temp->current}}</div>
                                        </div>  
                                        <div class="list-item">
                                        <div class="head">Plan Approved On</div>
                                        <div>:</div>
                                        <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                        </div> 
                                        @elseif($temp->origin_state =="Residual Risk Evaluation") 
                                        <div class="list-item">
                                        <div class="head">Risk Analysis Completed By</div>
                                        <div>:</div>
                                        <div> {{$temp->current}}</div>
                                        </div>  
                                        <div class="list-item">
                                        <div class="head">Risk Analysis Completed By</div>
                                        <div>:</div>
                                        <div> {{Helpers::getdateFormat1($temp->created_at)}}</div>
                                        </div> 
                                        

                                        @endif --}}


                                {{-- @else  --}}


                                {{-- <div class="list-item">
                                    <div class="head">Origin state</div>
                                    <div>:</div>
                                    <div>{{ $temp->origin_state }}</div>
                                </div> --}}
                                {{-- @endif
                                @endif --}}
                            </div>
                        
                        </div>
                    @endforeach
                      

            </div>
        </div>
      
    </div>
    
    
@endsection
