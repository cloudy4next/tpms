@extends('layouts.client')
@section('client')
    <div class="loading2">
        <div class="table-loading"></div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h5 class="mb-2">
                <a href="{{route('client.myinfo')}}" title="Back To Client"><i
                        class="ri-arrow-left-circle-line text-primary"></i> </a>
                <a href="{{route('client.myinfo')}}"
                   class="cmn_a">{{$client_id->client_first_name}} {{$client_id->client_middle}} {{$client_id->client_last_name}}</a>
                | <small>
                    <span
                        class=" font-weight-bold text-orange">DOB:</span> {{\Carbon\Carbon::parse($client_id->client_dob)->format('m/d/Y')}}
                    |
                    <span class=" font-weight-bold text-orange">Phone:</span> {{$client_id->phone_number}} |
                    <span class=" font-weight-bold text-orange">Address:</span>
                    {{$client_id->client_street}} {{$client_id->client_city}} {{$client_id->client_state}} {{$client_id->client_zip}}


                </small>
            </h5>
            <div class="d-lg-flex">
                <div class="client_menu mr-2">
                    <ul class="nav flex-column setting_menu">
                        <li class="nav-item border-0"><img src="{{asset('assets/dashboard/')}}/images/user/01.jpg"
                                                           class="img-fluid d-block mx-auto" alt=""></li>
                        <li class="nav-item"><a class="nav-link active"
                                                href="{{route('client.myinfo')}}">Patient
                                Info</a></li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.myauthorization')}}">Ins/Authorization</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                                href="{{route('client.mydocuments')}}">Documents</a>
                        </li>
                    </ul>
                </div>
                <div class="all_content flex-fill">
                    <form action="{{route('client.myinfo.update')}}" method="post"
                          enctype="multipart/form-data" autocomplete="off" id="client_info_save_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check mb-2">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="1"
                                               {{$client_id->is_active_client == 1 ? 'checked' : ''}} name="is_active_client">Active
                                        Patient
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6 class="font-weight-bold">Name</h6>
                                <div class="row no-gutters">
                                    <div class="col-md-4 col-xl mb-2 pr-2">
                                        <label>First Name<span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control client_name form-control-sm{{ $errors->has('client_first_name') ? ' is-invalid' : '' }}"
                                               name="client_first_name" value="{{$client_id->client_first_name}}"
                                               required>
                                        <input type="hidden" class="form-control form-control-sm" id="f_name"
                                               name="client_edit_id" value="{{$client_id->id}}">
                                        @if ($errors->has('client_first_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-xl mb-2 pr-2">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control form-control-sm" name="client_middle"
                                               value="{{$client_id->client_middle}}">
                                    </div>
                                    <div class="col-md-4 col-xl mb-2 pr-2">
                                        <label>Last Name<span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control last_name form-control-sm {{ $errors->has('client_last_name') ? ' is-invalid' : '' }}"
                                               name="client_last_name" value="{{$client_id->client_last_name}}"
                                               required>
                                        @if ($errors->has('client_last_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_last_name') }}</strong>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-xl mb-2 pr-2">
                                        <label>Date of Birth<span class="text-danger">*</span></label>
                                        <input type="date"
                                               class="form-control cl_dob form-control-sm {{ $errors->has('client_dob') ? ' is-invalid' : '' }}"
                                               name="client_dob" value="{{$client_id->client_dob}}" required>
                                        @if ($errors->has('client_dob'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_dob') }}</strong>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-xl mb-2 pr-2">
                                        <label>Gender<span class="text-danger">*</span></label>
                                        <select
                                            class="form-control form-control-sm {{ $errors->has('client_gender') ? ' is-invalid' : '' }}"
                                            name="client_gender" required>
                                            <option
                                                value="Male" {{$client_id->client_gender == "Male" ? 'selected' : ''}}>
                                                Male
                                            </option>
                                            <option
                                                value="Female" {{$client_id->client_gender == "Female" ? 'selected' : ''}}>
                                                Female
                                            </option>
                                        </select>
                                        @if ($errors->has('client_gender'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_gender') }}</strong>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-xl mb-2">
                                        <label class="font-weight-bold">Relationship<i class="ri-question-line"
                                                                                       title="The default office location where this client will typically be seen."></i><span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="form-control client_ref form-control-sm client_rel {{ $errors->has('relationship') ? ' is-invalid' : '' }}"
                                            name="relationship" required disabled>
                                            <option value=""></option>
                                            <option
                                                value="Self" {{$client_info->relationship == 'Self' ? 'selected' : ''}}>
                                                Self
                                            </option>
                                            <option
                                                value="Spouse" {{$client_info->relationship == 'Spouse' ? 'selected' : ''}}>
                                                Spouse
                                            </option>
                                            <option
                                                value="Other" {{$client_info->relationship == 'Other' ? 'selected' : ''}}>
                                                Other
                                            </option>
                                            <option
                                                value="Child" {{$client_info->relationship == 'Child' ? 'selected' : ''}}>
                                                Child
                                            </option>
                                            <option
                                                value="Grandfather Or Grandmother" {{$client_info->relationship == 'Grandfather Or Grandmother' ? 'selected' : ''}}>
                                                Grandfather Or Grandmother
                                            </option>
                                            <option
                                                value="Grandson Or Granddaughter" {{$client_info->relationship == 'Grandson Or Granddaughter' ? 'selected' : ''}}>
                                                Grandson Or Granddaughter
                                            </option>
                                            <option
                                                value="Nephew Or Niece" {{$client_info->relationship == 'Nephew Or Niece' ? 'selected' : ''}}>
                                                Nephew Or Niece
                                            </option>
                                            <option
                                                value="Adopted Child" {{$client_info->relationship == 'Adopted Child' ? 'selected' : ''}}>
                                                Adopted Child
                                            </option>
                                            <option
                                                value="Foster Child" {{$client_info->relationship == 'Foster Child' ? 'selected' : ''}}>
                                                Foster Child
                                            </option>
                                            <option
                                                value="Stepson" {{$client_info->relationship == 'Stepson' ? 'selected' : ''}}>
                                                Stepson
                                            </option>
                                            <option
                                                value="Ward" {{$client_info->relationship == 'Ward' ? 'selected' : ''}}>
                                                Ward
                                            </option>
                                            <option
                                                value="Stepdaughter" {{$client_info->relationship == 'Stepdaughter' ? 'selected' : ''}}>
                                                Stepdaughter
                                            </option>
                                        </select>
                                        @if ($errors->has('relationship'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('relationship') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @include('client.info.include.addressSection')
                            @include('client.info.include.phonesection')
                            @include('client.info.include.emailsection')

                            <div class="col-md-12 mt-2">
                                <h6 class="font-weight-bold">About Patient</h6>
                                <div class="row no-gutters">
                                    <div class="col-md-3 col-xl mb-2 pr-2">
                                        <label>Race & Ethnicity Details</label>
                                        <div class="ui-widget">
                                            <select class="form-control form-control-sm" name="race_ethnicity"
                                                    placeholder="Search">
                                                <option value="0"></option>
                                                <option
                                                    value="1" {{$client_info->race_ethnicity == 1 ? 'selected' : ''}}>
                                                    American Indian or Alaska Native
                                                </option>
                                                <option
                                                    value="2" {{$client_info->race_ethnicity == 2 ? 'selected' : ''}}>
                                                    Asian
                                                </option>
                                                <option
                                                    value="3" {{$client_info->race_ethnicity == 3 ? 'selected' : ''}}>
                                                    Black or African American
                                                </option>
                                                <option
                                                    value="4" {{$client_info->race_ethnicity == 4 ? 'selected' : ''}}>
                                                    Hispanic or Latinx
                                                </option>
                                                <option
                                                    value="5" {{$client_info->race_ethnicity == 5 ? 'selected' : ''}}>
                                                    Middle Eastern or North African
                                                </option>
                                                <option
                                                    value="6" {{$client_info->race_ethnicity == 6 ? 'selected' : ''}}>
                                                    Native Hawaiian or Other Pacific Islander
                                                </option>
                                                <option
                                                    value="7" {{$client_info->race_ethnicity == 7 ? 'selected' : ''}}>
                                                    White
                                                </option>
                                                <option
                                                    value="8" {{$client_info->race_ethnicity == 8 ? 'selected' : ''}}>
                                                    Race or ethnicity not listed
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xl mb-2 pr-2">
                                        <label>Preferred Language</label>
                                        <div class="ui-widget">
                                            <select class="form-control form-control-sm" name="preferred_language"
                                                    placeholder="Search">
                                                <option value=""></option>
                                                <option
                                                    value="afr" {{$client_info->preferred_language =="afr" ? 'selected' : ''}}>
                                                    Afrikaans
                                                </option>
                                                <option
                                                    value="sqi" {{$client_info->preferred_language =="sqi" ? 'selected' : ''}}>
                                                    Albanian
                                                </option>
                                                <option
                                                    value="ase" {{$client_info->preferred_language =="ase" ? 'selected' : ''}}>
                                                    American Sign Language
                                                </option>
                                                <option
                                                    value="ara" {{$client_info->preferred_language =="ara" ? 'selected' : ''}}>
                                                    Arabic
                                                </option>
                                                <option
                                                    value="hye" {{$client_info->preferred_language =="hye" ? 'selected' : ''}}>
                                                    Armenian
                                                </option>
                                                <option
                                                    value="eus" {{$client_info->preferred_language =="eus" ? 'selected' : ''}}>
                                                    Basque
                                                </option>
                                                <option
                                                    value="ben" {{$client_info->preferred_language =="ben" ? 'selected' : ''}}>
                                                    Bengali
                                                </option>
                                                <option
                                                    value="bul" {{$client_info->preferred_language =="bul" ? 'selected' : ''}}>
                                                    Bulgarian
                                                </option>
                                                <option
                                                    value="cat" {{$client_info->preferred_language =="cat" ? 'selected' : ''}}>
                                                    Catalan
                                                </option>
                                                <option
                                                    value="khm" {{$client_info->preferred_language =="khm" ? 'selected' : ''}}>
                                                    Central Khmer
                                                </option>
                                                <option
                                                    value="zho" {{$client_info->preferred_language =="zho" ? 'selected' : ''}}>
                                                    Chinese
                                                </option>
                                                <option
                                                    value="hrv" {{$client_info->preferred_language =="hrv" ? 'selected' : ''}}>
                                                    Croatian
                                                </option>
                                                <option
                                                    value="ces" {{$client_info->preferred_language =="ces" ? 'selected' : ''}}>
                                                    Czech
                                                </option>
                                                <option
                                                    value="dan" {{$client_info->preferred_language =="dan" ? 'selected' : ''}}>
                                                    Danish
                                                </option>
                                                <option
                                                    value="nld" {{$client_info->preferred_language =="nld" ? 'selected' : ''}}>
                                                    Dutch
                                                </option>
                                                <option
                                                    value="eng" {{$client_info->preferred_language =="eng" ? 'selected' : ''}}>
                                                    English
                                                </option>
                                                <option
                                                    value="est" {{$client_info->preferred_language =="est" ? 'selected' : ''}}>
                                                    Estonian
                                                </option>
                                                <option
                                                    value="fij" {{$client_info->preferred_language =="fij" ? 'selected' : ''}}>
                                                    Fijian
                                                </option>
                                                <option
                                                    value="fin" {{$client_info->preferred_language =="fin" ? 'selected' : ''}}>
                                                    Finnish
                                                </option>
                                                <option
                                                    value="fra" {{$client_info->preferred_language =="fra" ? 'selected' : ''}}>
                                                    French
                                                </option>
                                                <option
                                                    value="kat" {{$client_info->preferred_language =="kat" ? 'selected' : ''}}>
                                                    Georgian
                                                </option>
                                                <option
                                                    value="deu" {{$client_info->preferred_language =="deu" ? 'selected' : ''}}>
                                                    German
                                                </option>
                                                <option
                                                    value="guj" {{$client_info->preferred_language =="guj" ? 'selected' : ''}}>
                                                    Gujarati
                                                </option>
                                                <option
                                                    value="heb" {{$client_info->preferred_language =="heb" ? 'selected' : ''}}>
                                                    Hebrew
                                                </option>
                                                <option
                                                    value="hin" {{$client_info->preferred_language =="hin" ? 'selected' : ''}}>
                                                    Hindi
                                                </option>
                                                <option
                                                    value="hun" {{$client_info->preferred_language =="hun" ? 'selected' : ''}}>
                                                    Hungarian
                                                </option>
                                                <option
                                                    value="isl" {{$client_info->preferred_language =="isl" ? 'selected' : ''}}>
                                                    Icelandic
                                                </option>
                                                <option
                                                    value="ind" {{$client_info->preferred_language =="ind" ? 'selected' : ''}}>
                                                    Indonesian
                                                </option>
                                                <option
                                                    value="gle" {{$client_info->preferred_language =="gle" ? 'selected' : ''}}>
                                                    Irish
                                                </option>
                                                <option
                                                    value="ita" {{$client_info->preferred_language =="ita" ? 'selected' : ''}}>
                                                    Italian
                                                </option>
                                                <option
                                                    value="jpn" {{$client_info->preferred_language =="jpn" ? 'selected' : ''}}>
                                                    Japanese
                                                </option>
                                                <option
                                                    value="kor" {{$client_info->preferred_language =="kor" ? 'selected' : ''}}>
                                                    Korean
                                                </option>
                                                <option
                                                    value="lat" {{$client_info->preferred_language =="lat" ? 'selected' : ''}}>
                                                    Latin
                                                </option>
                                                <option
                                                    value="lav" {{$client_info->preferred_language =="lav" ? 'selected' : ''}}>
                                                    Latvian
                                                </option>
                                                <option
                                                    value="lit" {{$client_info->preferred_language =="lit" ? 'selected' : ''}}>
                                                    Lithuanian
                                                </option>
                                                <option
                                                    value="mkd" {{$client_info->preferred_language =="mkd" ? 'selected' : ''}}>
                                                    Macedonian
                                                </option>
                                                <option
                                                    value="msa" {{$client_info->preferred_language =="msa" ? 'selected' : ''}}>
                                                    Malay
                                                </option>
                                                <option
                                                    value="mal" {{$client_info->preferred_language =="mal" ? 'selected' : ''}}>
                                                    Malayalam
                                                </option>
                                                <option
                                                    value="mlt" {{$client_info->preferred_language =="mlt" ? 'selected' : ''}}>
                                                    Maltese
                                                </option>
                                                <option
                                                    value="mri" {{$client_info->preferred_language =="mri" ? 'selected' : ''}}>
                                                    Maori
                                                </option>
                                                <option
                                                    value="mar" {{$client_info->preferred_language =="mar" ? 'selected' : ''}}>
                                                    Marathi
                                                </option>
                                                <option
                                                    value="ell" {{$client_info->preferred_language =="ell" ? 'selected' : ''}}>
                                                    Modern Greek (1453-)
                                                </option>
                                                <option
                                                    value="mon" {{$client_info->preferred_language =="mon" ? 'selected' : ''}}>
                                                    Mongolian
                                                </option>
                                                <option
                                                    value="nep" {{$client_info->preferred_language =="nep" ? 'selected' : ''}}>
                                                    Nepali
                                                </option>
                                                <option
                                                    value="nor" {{$client_info->preferred_language =="nor" ? 'selected' : ''}}>
                                                    Norwegian
                                                </option>
                                                <option
                                                    value="pan" {{$client_info->preferred_language =="pan" ? 'selected' : ''}}>
                                                    Panjabi
                                                </option>
                                                <option
                                                    value="fas" {{$client_info->preferred_language =="fas" ? 'selected' : ''}}>
                                                    Persian
                                                </option>
                                                <option
                                                    value="pol" {{$client_info->preferred_language =="pol" ? 'selected' : ''}}>
                                                    Polish
                                                </option>
                                                <option
                                                    value="por" {{$client_info->preferred_language =="por" ? 'selected' : ''}}>
                                                    Portuguese
                                                </option>
                                                <option
                                                    value="que" {{$client_info->preferred_language =="que" ? 'selected' : ''}}>
                                                    Quechua
                                                </option>
                                                <option
                                                    value="ron" {{$client_info->preferred_language =="ron" ? 'selected' : ''}}>
                                                    Romanian
                                                </option>
                                                <option
                                                    value="rus" {{$client_info->preferred_language =="rus" ? 'selected' : ''}}>
                                                    Russian
                                                </option>
                                                <option
                                                    value="smo" {{$client_info->preferred_language =="smo" ? 'selected' : ''}}>
                                                    Samoan
                                                </option>
                                                <option
                                                    value="srp" {{$client_info->preferred_language =="srp" ? 'selected' : ''}}>
                                                    Serbian
                                                </option>
                                                <option
                                                    value="slk" {{$client_info->preferred_language =="slk" ? 'selected' : ''}}>
                                                    Slovak
                                                </option>
                                                <option
                                                    value="slv" {{$client_info->preferred_language =="slv" ? 'selected' : ''}}>
                                                    Slovenian
                                                </option>
                                                <option
                                                    value="spa" {{$client_info->preferred_language =="spa" ? 'selected' : ''}}>
                                                    Spanish
                                                </option>
                                                <option
                                                    value="swa" {{$client_info->preferred_language =="swa" ? 'selected' : ''}}>
                                                    Swahili
                                                </option>
                                                <option
                                                    value="swe" {{$client_info->preferred_language =="swe" ? 'selected' : ''}}>
                                                    Swedish
                                                </option>
                                                <option
                                                    value="tam" {{$client_info->preferred_language =="tam" ? 'selected' : ''}}>
                                                    Tamil
                                                </option>
                                                <option
                                                    value="tat" {{$client_info->preferred_language =="tat" ? 'selected' : ''}}>
                                                    Tatar
                                                </option>
                                                <option
                                                    value="tel" {{$client_info->preferred_language =="tel" ? 'selected' : ''}}>
                                                    Telugu
                                                </option>
                                                <option
                                                    value="tha" {{$client_info->preferred_language =="tha" ? 'selected' : ''}}>
                                                    Thai
                                                </option>
                                                <option
                                                    value="bod" {{$client_info->preferred_language =="bod" ? 'selected' : ''}}>
                                                    Tibetan
                                                </option>
                                                <option
                                                    value="ton" {{$client_info->preferred_language =="ton" ? 'selected' : ''}}>
                                                    Tonga (Tonga Islands)
                                                </option>
                                                <option
                                                    value="tur" {{$client_info->preferred_language =="tur" ? 'selected' : ''}}>
                                                    Turkish
                                                </option>
                                                <option
                                                    value="ukr" {{$client_info->preferred_language =="ukr" ? 'selected' : ''}}>
                                                    Ukrainian
                                                </option>
                                                <option
                                                    value="urd" {{$client_info->preferred_language =="urd" ? 'selected' : ''}}>
                                                    Urdu
                                                </option>
                                                <option
                                                    value="uzb" {{$client_info->preferred_language =="uzb" ? 'selected' : ''}}>
                                                    Uzbek
                                                </option>
                                                <option
                                                    value="vie" {{$client_info->preferred_language =="vie" ? 'selected' : ''}}>
                                                    Vietnamese
                                                </option>
                                                <option
                                                    value="cym" {{$client_info->preferred_language =="cym" ? 'selected' : ''}}>
                                                    Welsh
                                                </option>
                                                <option
                                                    value="xho" {{$client_info->preferred_language =="xho" ? 'selected' : ''}}>
                                                    Xhosa
                                                </option>
                                                <option
                                                    value="yid" {{$client_info->preferred_language =="yid" ? 'selected' : ''}}>
                                                    Yiddish
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xl mb-2 pr-2">
                                        <label>Date First Seen</label>
                                        <input type="date" class="form-control form-control-sm"
                                               name="client_date_first_seen"
                                               value="{{$client_info->client_date_first_seen}}" disabled>
                                    </div>
                                    <div class="col-md-3 col-xl mb-2 pr-2">
                                        <label>Referred By</label>
                                        <select class="form-control form-control-sm" name="client_reffered_by" disabled>
                                            <option value="0"></option>
                                            @foreach($ren_providers as $ren_prov)
                                                <option
                                                    value="{{$ren_prov->id}}" {{$client_info->client_reffered_by == $ren_prov->id ? 'selected' : ''}}>{{$ren_prov->provider_name}} {{$ren_prov->provider_last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-xl mb-2">
                                        <label>Assignment</label>
                                        <select class="form-control form-control-sm" name="asignment" disabled>
                                            <option value="Yes" {{$client_info->asignment == 'Yes' ? 'selected' : ''}}>
                                                Yes
                                            </option>
                                            <option value="No" {{$client_info->asignment == 'No' ? 'selected' : ''}}>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @include('client.info.include.guarantar_info_section')
                            <div class="col-md-3 mb-2">
                                <label>Patient Notes</label>
                                <textarea class="form-control form-control-sm" rows="2"
                                          name="client_notes">{!! $client_info->client_notes !!}</textarea>
                            </div>
                            <div class="col-md-2 text-center align-self-center">
                                <input type="file" class="form-control-file d-none" name="signature_image" id="fileup">
                                <label for="fileup">
                                    <svg viewBox="0 0 20 17" class="fileupsvg">
                                        <path
                                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                    </svg>
                                    <span>Upload Signature</span>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <div class="preview-sig">
                                    <button type="button" class="close" aria-label="Close" id="delete_sing"
                                            data-id="{{$client_info->client_id}}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <img src="{{$client_info->signature_image}}" id="wizardPicturePreview"
                                         class="img-fluid dyn_img" style="width: 70px;">

                                    {{--                                    <img src="{{asset('assets/dashboard/')}}/images/client/contact.png" id="wizardPicturePreview" class="img-fluid" style="height: 100px;width: 100%" alt="">--}}
                                </div>
                            </div>
                            <div class="col-md-12 button-demo">
                                <button class="btn btn-sm btn-primary ladda-button" data-style="expand-right"
                                        id="info_save_btn">Save Patient
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/dashboard/')}}/custom/clieninfo.js"></script>
    <script>
        $(document).ready(function () {
// Prepare the preview for profile picture
            $("#fileup").change(function () {
                $('#wizardPicturePreview').attr('src', '');
                readURL(this);
            });


            $('#delete_sing').click(function () {
                $('.loading2').show();
                let client_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{route('client.mysing.delete')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'client_id': client_id
                    },
                    success: function (data) {

                        let root = "{{asset('assets/dashboard/')}}/images/client/contact.png";

                        if (data = 'done') {
                            $('.dyn_img').attr('src', root);
                        }

                        $('.loading2').hide();
                    }
                });
            })

        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

    <script>
        $('.loading2').hide();
        $(document).ready(function () {


            $('#info_save_btn').click(function (e) {
                e.preventDefault();
                var client_name = $('.client_name').val();
                var last_name = $('.last_name').val();
                var cl_dob = $('.cl_dob').val();
                var client_ref = $('.client_ref').val();

                var street = $('.street').val();
                var city = $('.city').val();
                var state = $('.state').val();
                var zip = $('.zip').val();

                if (client_name == "" || client_name == null) {
                    toastr["error"]("Please Enter Client First Name", 'ALERT!');
                } else if (last_name == "" || last_name == null) {
                    toastr["error"]("Please Enter Client Last Name", 'ALERT!');
                } else if (cl_dob == "" || cl_dob == null) {
                    toastr["error"]("Please Enter Client DOB", 'ALERT!');
                } else if (client_ref == "" || client_ref == null) {
                    toastr["error"]("Please Enter Client Relation", 'ALERT!');
                } else if (street == "" || street == null) {
                    toastr["error"]("Please Enter Street", 'ALERT!');
                } else if (city == "" || city == null) {
                    toastr["error"]("Please Enter City", 'ALERT!');
                } else if (state == 0 || state == null) {
                    toastr["error"]("Please Enter State", 'ALERT!');
                } else if (zip == "" || zip == null) {
                    toastr["error"]("Please Enter Zip", 'ALERT!');
                } else {
                    $('#client_info_save_form').submit();
                }

            })


            $('.client_rel').change(function () {
                if ($(this).val() == "Self") {
                    $('.is_gran').prop('checked', false);
                    $('.is_gran').prop('disabled', true);
                    $('.client_gran_info').hide();
                } else {
                    $('.is_gran').prop('disabled', false);
                }
            });


            var is_rel = $('.client_rel').val();


            if (is_rel == "Self") {
                $('.is_gran').prop('checked', false);
                $('.is_gran').prop('disabled', true);
            } else if (is_rel == null || is_rel == "") {
                $('.is_gran').prop('checked', false);
                $('.is_gran').prop('disabled', true);
            }


            $('.existsphonedelete').click(function () {
                var phonid = $(this).data('id');
                $(this).closest('.removeexistphondiv').remove();
                $.ajax({
                    type: "POST",
                    url: "{{route('clint.delete.exist.myinfo.phone')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'phonid': phonid
                    },
                    success: function (data) {

                    }
                });
            })


            $('.deleteexistsemail').click(function () {
                var emailid = $(this).data('id');
                $(this).closest('.existsemailsection').remove();
                $.ajax({
                    type: "POST",
                    url: "{{route('client.delete.exist.myinfo.email')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'emailid': emailid
                    },
                    success: function (data) {

                    }
                });
            })


            $('.deleteexistsaddress').click(function () {
                var addressid = $(this).data('id');
                $(this).closest('.existsaddresssection').remove();
                $.ajax({
                    type: "POST",
                    url: "{{route('client.delete.exist.myinfo.address')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'addressid': addressid
                    },
                    success: function (data) {

                    }
                });
            })


        })
    </script>

    <script>
        $('#showg').hide();
        $('#checkg').click(function (event) {
            $('#showg').toggle("slow");
        });

        var g_val = $('#checkg').val();

        if ($('#checkg').prop('checked')) {
            $('#showg').toggle("slow");
        } else {
            $('#showg').hide();
        }


        $('#save_client_address').click(function () {
            var street = $('.street').val();
            var city = $('.city').val();
            var state = $('.state').val();
            var zip = $('.zip').val();
            console.log(state)

            if (street) {
                $('.gstreet').val(street);
            }

            if (city) {
                $('.g_city').val(city);
            }

            if (state) {
                // $('.g_state').val(state);
                // $('.g_state option[value=AL]').attr('selected','selected');
                $(".g_state").val(state).change();
            }

            if (zip) {
                $('.g_zip').val(zip);
            }
        })


    </script>
@endsection
