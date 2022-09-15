<?php
    if(\Auth::user()->is_up_admin==1){
        $admin_id=\Auth::user()->id;
    }
    else{
        $admin_id=\Auth::user()->up_admin_id;
    }

?>

<style>
    .sig_table{
        line-height: 50px;
    }
</style>

<table class="table table-sm table-bordered c_table sig_table" id="export_table">
    <thead>
    <tr>
        <th width="8%"> DOS</th>
        <th width="15%"> Provider Name</th>
        <th width="15%"> Patient Name</th>
        <th width="10%"> Session Time</th>
        <th width="20%"> Service & Hrs.</th>
        {{-- <th width="10%" data-tableexport-display="none"> Pro. Sign.</th>
        <th width="10%" data-tableexport-display="none"> Pat. Sign.</th> --}}
        <th width="" data-tableexport-display="none">Patient Signature </th>
        <th width="" data-tableexport-display="none">Provider Signature </th>
        <th style="display: none;" data-tableexport-display="always">
            Patient Signature
        </th>
        <th style="display: none;" data-tableexport-display="always">
            Provider Signature
        </th>
    </tr>
    </thead>
    <tbody>
        @foreach($query_exe as $q)
            @php
                $provider=\App\Models\Employee::select('full_name')->where('id',$q->provider_id)->first();
                $client=\App\Models\Client::select('client_full_name')->where('id',$q->client_id)->first();
                $auth = \App\Models\Client_authorization_activity::select('id', 'activity_name')->where('id', $q->authorization_activity_id)->first();
                $hours = $q->time_duration / 60;
            @endphp
            <tr>
                <td data-id="{{$q->id}}">
                    {{\Carbon\Carbon::parse($q->schedule_date)->format('m/d/Y')}}    
                </td>
                <td>
                    @if($provider)
                        {{$provider->full_name}}
                    @endif    
                </td>

                <td>
                    @if($client)
                        {{$client->client_full_name}}
                    @elseif($q->billable==2)
                        Non-Billable Client
                    @endif   
                </td>
                <td>  
                   {{\Carbon\Carbon::parse($q->from_time)->format('g:i a').' to '.\Carbon\Carbon::parse($q->to_time)->format('g:i a')}} 
                </td>
                <td>
                    @if ($auth)
                        {{$auth->activity_name}}
                        @if ($hours >= 1)
                            ({{number_format($hours,2)}} Hr)
                        @else
                            ({{number_format($hours,2)}} Hrs)
                        @endif
                    @elseif($q->billable==2)
                        NONCLI01323_AUTH249
                        @if ($hours >= 1)
                            ({{number_format($hours,2)}} Hr)
                        @else
                            ({{number_format($hours,2)}} Hrs)
                        @endif
                    @endif
                </td>
                {{-- <td data-tableexport-display="none">
                    @php
                        $pat_sign=\App\Models\Appoinment_signature::select('signature')->where('session_id',$q->id)->where('user_type',1)->first();
                    @endphp
                    @if($pat_sign)
                        <a href="#viewPatientSignature" data-toggle="modal" data-img="{{$pat_sign->signature}}"><i class="ri-eye-line text-success"></i></a>
                    @else
                        <a href="javascript:void(0);" disabled><i class="ri-eye-line text-light"></i></a>
                    @endif
                    
                </td>
                <td data-tableexport-display="none">
                    @php
                        $pro_sign=\App\Models\Appoinment_signature::select('signature')->where('session_id',$q->id)->where('user_type',2)->first();
                    @endphp
                    @if($pro_sign)
                        <a href="#viewProviderSignature" data-toggle="modal" data-img="{{$pro_sign->signature}}"><i class="ri-eye-line text-success"></i></a>
                    @else
                        <a href="javascript:void(0);" disabled><i class="ri-eye-line text-light"></i></a>
                    @endif
                    
                </td> --}}
                <td data-tableexport-display="none">
                    @php
                        $img=\App\Models\Appoinment_signature::select('signature')->where('session_id',$q->id)->where('user_type',1)->where('admin_id',$admin_id)->first();
                    @endphp

                    @if($img)
                        <img src="{{asset('/').$img->signature}}" height="60px">
                    @endif
                </td>

                <td data-tableexport-display="none">
                    @php
                        $img=\App\Models\Appoinment_signature::select('signature')->where('session_id',$q->id)->where('user_type',2)->where('admin_id',$admin_id)->first();
                    @endphp

                    @if($img)
                        <img src="{{asset('/').$img->signature}}" height="60px">
                    @endif
                </td>
                <td style="display: none;" data-tableexport-display="always">
                    @php
                        $img=\App\Models\Appoinment_signature::select('signature')->where('session_id',$q->id)->where('user_type',1)->where('admin_id',$admin_id)->first();
                    @endphp

                    @if($img)
                        Available
                    @else
                        Not Available
                    @endif
                </td>
                <td style="display: none;" data-tableexport-display="always">
                    @php
                        $img=\App\Models\Appoinment_signature::select('signature')->where('session_id',$q->id)->where('user_type',2)->where('admin_id',$admin_id)->first();
                    @endphp

                    @if($img)
                        Available
                    @else
                        Not Available
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>