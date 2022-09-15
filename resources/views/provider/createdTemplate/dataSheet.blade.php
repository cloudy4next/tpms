<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datasheet</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard//')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/template/tem30/')}}/css/custom-30.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/') }}/toastr/build/toastr.min.css">
    <style>
      .logo_img{
        width: 100px;
        height: 100px;
      }
    </style>
</head>

<body>
<div class="treatment-plan">
        <div class="content">
            <div class="flex-div">
                <div class="col-item">
                    <div class="logo"><a href="#">
                            @if (file_exists($logo->logo) && !empty($logo->logo))
                                <img src="{{asset($logo->logo)}}"
                                     alt="" class="logo_img">
                            @endif

                        </a></div>
                </div>
                <div class="col-item">
                    <div class="info-details">
                        <ul>
                            <li><span>Mail:</span>{{$name_location->address}}. {{$name_location->city}}
                                , {{$name_location->state}} {{$name_location->zip}}
                            </li>
                            <li><a href="mailto:{{$name_location->email}}"> <span>Email:</span>{{$name_location->email}}</a>
                            </li>
                            <li><span>Phone:</span> {{$name_location->phone_one}}</li>
                            {{--                        <li><a href="fax:+18183695800"><span>Fax:</span>818.369.5800</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            <form method="POST" id="form_30">
                @csrf
              <div class="page-title">
                    <h1>Datasheet</h1>
                </div>
              <div class="data-sheet">
                <section class="section_1">
                  <table border="1" cellpadding="10">
                    <tr>
                      <td>
                        <table>
                          <tr>
                            <td><label for="cname">Client:</label>
                              <input type="hidden" name="sessionid" class="session_id" value="{{$session_id}}">

                              <input value="{{$data->clname}}" type="text" id="cname" name="clname">
                            </td>
                            <td><label for="sname">Staff Name:</label>
                              <input value="{{$data->stname}}" type="text" id="sname" name="stname"></td>
                          </tr>
                        </table>
                      </td>
                      <td>
                        <table>
                          <tr>
                            <td colspan="2"><label>Session Date:</label>
                              <input value="{{$data->sdate}}" type="date" name="sdate"><br>
                              <br>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <div> <label>Start:</label>
                                <input value="{{\Carbon\Carbon::parse($data->sttime)->format('H:i:s')}}" type="time" style="width:200px;" name="sttime">
                              </div>
                              <div>
                                <label>End:</label>
                                <input value="{{\Carbon\Carbon::parse($data->etime)->format('H:i:s')}}" type="time" style="width:200px;" name="etime">

                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          <select name="select1" id="cars">
                            <option value="Behavior Tracking" {{$data->select1 == 'Behavior Tracking' ? 'selected' : ''}}>Behavior Tracking</option>
                            <option value="Encopresis" {{$data->select1 == 'Encopresis' ? 'selected' : ''}} >Encopresis</option>
                            <option value="Elopement" {{$data->select1 == 'Elopement' ? 'selected' : ''}} > Elopement </option>
                            <option value="SIB" {{$data->select1 == 'SIB' ? 'selected' : ''}}> SIB </option>
                            <option value="Inappropriate Attention Seeking" {{$data->select1 == 'Inappropriate Attention Seeking' ? 'selected' : ''}} > Inappropriate Attention Seeking </option>
                          </select>
                          <select name="select2" id="cars">
                            <option value="Replacement Behavior" {{$data->select2 == 'Replacement Behavior' ? 'selected' : ''}}>Replacement Behavior</option>
                            <option value="tolerate denied access" {{$data->select2 == 'tolerate denied access' ? 'selected' : ''}} >tolerate denied access</option>
                            <option value="wait" {{$data->select2 == 'wait' ? 'selected' : ''}} > wait</option>
                            <option value="sustain attendance" {{$data->select2 == 'sustain attendance' ? 'selected' : ''}} >sustain attendance</option>
                            <option value="mand more time" {{$data->select2 == 'mand more time' ? 'selected' : ''}} >mand more time</option>
                            <option value="mand for help" {{$data->select2 == 'mand for help' ? 'selected' : ''}} >mand for help</option>
                            <option value="mand for break" {{$data->select2 == 'mand for break' ? 'selected' : ''}} >mand for break</option>
                            <option value="mand for attention" {{$data->select2 == 'mand for attention' ? 'selected' : ''}}>mand for attention</option>
                            <option value="appropriate mand" {{$data->select2 == 'appropriate mand' ? 'selected' : ''}} >appropriate mand</option>
                            <option value="other" {{$data->select2 == 'other' ? 'selected' : ''}} > other</option>
                          </select>
                      </td>
                      <td>
                        <table>
                          <tbody>
                            <tr>
                              <td>Hr 1</td>
                              <td>Hr 2</td>
                              <td>Hr 3</td>
                              <td>Total</td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table cellpadding="0">
                          <tbody>
                            <tr>
                              <td colspan="3"><input value="{{$data->hour1}}" type="text" name="hour1"></td>
                              <td><input value="{{$data->hr1_1}}" type="text" name="hr1_1"></td>
                              <td><input value="{{$data->hr2_1}}" type="text" name="hr2_1"></td>
                              <td><input value="{{$data->hr3_1}}" type="text" name="hr3_1"></td>
                              <td><input value="{{$data->total_1}}" type="text" name="total_1"></td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table cellpadding="0">
                          <tbody>
                            <tr>
                              <td colspan="3"><input value="{{$data->hour2}}" type="text" name="hour2"></td>
                              <td><input value="{{$data->hr1_2}}" type="text" name="hr1_2"></td>
                              <td><input value="{{$data->hr2_2}}" type="text" name="hr2_2"></td>
                              <td><input value="{{$data->hr3_2}}" type="text" name="hr3_2"></td>
                              <td><input value="{{$data->total_2}}" type="text" name="total_2"></td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table cellpadding="0">
                          <tbody>
                            <tr>
                              <td colspan="3"><input value="{{$data->hour3}}" type="text" name="hour3"></td>
                              <td><input value="{{$data->hr1_3}}" type="text" name="hr1_3"></td>
                              <td><input value="{{$data->hr2_3}}" type="text" name="hr2_3"></td>
                              <td><input value="{{$data->hr3_3}}" type="text" name="hr3_3"></td>
                              <td><input value="{{$data->total_3}}" type="text" name="total_3"></td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </section>
                <br>
                <section class="section_2">
                  <div class="myrow row1">
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro1}}" type="text" name="pro1"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar1}}" type="text" name="tar1"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b1_1}}" type="text" style="width:30px; height:30px;" name="b1_1"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b1_2}}" type="text" style="width:30px; height:30px;" name="b1_2"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b1_3}}" type="text" style="width:30px; height:30px;" name="b1_3"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b1_4}}" type="text" style="width:30px; height:30px;" name="b1_4"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b1_5}}" type="text" style="width:30px; height:30px;" name="b1_5"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b1_6}}" type="text" style="width:30px; height:30px;" name="b1_6"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b1_7}}" type="text" style="width:30px; height:30px;" name="b1_7"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b1_8}}" type="text" style="width:30px; height:30px;" name="b1_8"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b1_9}}" type="text" style="width:30px; height:30px;" name="b1_9"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b1_10}}" type="text" style="width:30px; height:30px;" name="b1_10"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b1_11}}" type="text" style="width:30px; height:30px;" name="b1_11"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b1_12}}" type="text" style="width:30px; height:30px;" name="b1_12"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b1_13}}" type="text" style="width:30px; height:30px;" name="b1_13"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b1_14}}" type="text" style="width:30px; height:30px;" name="b1_14"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b1_15}}" type="text" style="width:30px; height:30px;" name="b1_15"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b1_t}}" type="text" name="b1_t">
                                /
                                <input value="{{$data->b1_ot}}" type="text" name="b1_ot"> =</label> <input value="{{$data->b1_s}}" type="text" name="b1_s"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php
                        $data=$data2;
                    ?>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro2}}" type="text" name="pro2"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar2}}" type="text" name="tar2"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b2_1}}" name="b2_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b2_2}}" name="b2_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b2_3}}" name="b2_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b2_4}}" name="b2_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b2_5}}" name="b2_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b2_6}}" name="b2_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b2_7}}" name="b2_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b2_8}}" name="b2_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b2_9}}" name="b2_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b2_10}}" name="b2_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b2_11}}" name="b2_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b2_12}}" name="b2_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b2_13}}" name="b2_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b2_14}}" name="b2_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b2_15}}" name="b2_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b2_t}}" type="text" name="b2_t">
                                /
                                <input value="{{$data->b2_ot}}" type="text" name="b2_ot"> =</label> <input value="{{$data->b2_s}}" type="text" name="b2_s"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro3}}" type="text" name="pro3"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar3}}" type="text" name="tar3"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b3_1}}" name="b3_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b3_2}}" name="b3_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b3_3}}" name="b3_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b3_4}}" name="b3_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b3_5}}" name="b3_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b3_6}}" name="b3_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b3_7}}" name="b3_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b3_8}}" name="b3_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b3_9}}" name="b3_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b3_10}}" name="b3_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b3_11}}" name="b3_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b3_12}}" name="b3_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b3_13}}" name="b3_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b3_14}}" name="b3_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b3_15}}" name="b3_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b3_t}}" name="b3_t" type="text">
                                /
                                <input value="{{$data->b3_ot}}" name="b3_ot" type="text"> =</label> <input value="{{$data->b3_s}}" name="b3_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>
                  <?php
                        $data=$data3;
                    ?>
                  <div class="myrow row2">
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro4}}" type="text" name="pro4"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar4}}" type="text" name="tar4"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b4_1}}" name="b4_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b4_2}}" name="b4_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b4_3}}" name="b4_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b4_4}}" name="b4_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b4_5}}" name="b4_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b4_6}}" name="b4_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b4_7}}" name="b4_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b4_8}}" name="b4_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b4_9}}" name="b4_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b4_10}}" name="b4_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b4_11}}" name="b4_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b4_12}}" name="b4_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b4_13}}" name="b4_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b4_14}}" name="b4_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b4_15}}" name="b4_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b4_t}}" name="b4_t" type="text">
                                /
                                <input value="{{$data->b4_ot}}" name="b4_ot" type="text"> =</label> <input value="{{$data->b4_s}}" name="b4_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro5}}" type="text" name="pro5"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar5}}" type="text" name="tar5"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b5_1}}" name="b5_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b5_2}}" name="b5_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b5_3}}" name="b5_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b5_4}}" name="b5_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b5_5}}" name="b5_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b5_6}}" name="b5_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b5_7}}" name="b5_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b5_8}}" name="b5_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b5_9}}" name="b5_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b5_10}}" name="b5_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b5_11}}" name="b5_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b5_12}}" name="b5_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b5_13}}" name="b5_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b5_14}}" name="b5_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b5_15}}" name="b5_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b5_t}}" name="b5_t" type="text">
                                /
                                <input value="{{$data->b5_ot}}" name="b5_ot" type="text"> =</label> <input value="{{$data->b5_s}}" name="b5_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php
                        $data=$data4;
                    ?>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro6}}" type="text" name="pro6"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar6}}" type="text" name="tar6"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b6_1}}" name="b6_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b6_2}}" name="b6_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b6_3}}" name="b6_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b6_4}}" name="b6_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b6_5}}" name="b6_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b6_6}}" name="b6_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b6_7}}" name="b6_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b6_8}}" name="b6_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b6_9}}" name="b6_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b6_10}}" name="b6_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b6_11}}" name="b6_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b6_12}}" name="b6_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b6_13}}" name="b6_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b6_14}}" name="b6_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b6_15}}" name="b6_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b6_t}}" name="b6_t" type="text">
                                /
                                <input value="{{$data->b6_ot}}" name="b6_ot" type="text"> =</label> <input value="{{$data->b6_s}}" name="b6_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>
                  <div class="myrow row3">
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro7}}" type="text" name="pro7"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar7}}" type="text" name="tar7"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b7_1}}" name="b7_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b7_2}}" name="b7_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b7_3}}" name="b7_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b7_4}}" name="b7_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b7_5}}" name="b7_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b7_6}}" name="b7_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b7_7}}" name="b7_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b7_8}}" name="b7_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b7_9}}" name="b7_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b7_10}}" name="b7_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b7_11}}" name="b7_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b7_12}}" name="b7_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b7_13}}" name="b7_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b7_14}}" name="b7_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b7_15}}" name="b7_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px>10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b7_t}}" name="b7_t" type="text">
                                /
                                <input value="{{$data->b7_ot}}" name="b7_ot" type="text"></label> <input value="{{$data->b7_s}}" name="b7_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php
                        $data=$data5;
                    ?>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro8}}" type="text" name="pro8"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar8}}" type="text" name="tar8"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b8_1}}" name="b8_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b8_2}}" name="b8_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b8_3}}" name="b8_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b8_4}}" name="b8_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b8_5}}" name="b8_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b8_6}}" name="b8_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b8_7}}" name="b8_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b8_8}}" name="b8_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b8_9}}" name="b8_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b8_10}}" name="b8_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b8_11}}" name="b8_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b8_12}}" name="b8_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b8_13}}" name="b8_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b8_14}}" name="b8_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b8_15}}" name="b8_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b8_t}}" name="b8_t" type="text">
                                /
                                <input value="{{$data->b8_ot}}" name="b8_ot" type="text"> =</label> <input value="{{$data->b8_s}}" name="b8_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro9}}" type="text" name="pro9"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar9}}" type="text" name="tar9"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b9_1}}" name="b9_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b9_2}}" name="b9_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b9_3}}" name="b9_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b9_4}}" name="b9_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b9_5}}" name="b9_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b9_6}}" name="b9_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b9_7}}" name="b9_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b9_8}}" name="b9_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b9_9}}" name="b9_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b9_10}}" name="b9_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b9_11}}" name="b9_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b9_12}}" name="b9_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b9_13}}" name="b9_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b9_14}}" name="b9_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b9_15}}" name="b9_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b9_t}}" name="b9_t" type="text">
                                /
                                <input value="{{$data->b9_ot}}" name="b9_ot" type="text"> =</label> <input value="{{$data->b9_s}}" name="b9_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </section>
                <?php

                    $data=$data6;
                ?>
                <div class="section_3">
                  <div class="textareas">
                    <h2>Session Notes</h2>
                    <textarea placeholder="Describe yourself here..." name="session_note">{{$data->session_note}}</textarea>
                  </div>
                </div>
                <br>

                <section class="section_2 common">
                  <div class="myrow row1">
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro10}}" type="text" name="pro10"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar10}}" type="text" name="tar10"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b10_1}}" name="b10_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b10_2}}" name="b10_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b10_3}}" name="b10_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b10_4}}" name="b10_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b10_5}}" name="b10_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b10_6}}" name="b10_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b10_7}}" name="b10_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b10_8}}" name="b10_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b10_9}}" name="b10_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b10_10}}" name="b10_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b10_11}}" name="b10_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b10_12}}" name="b10_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b10_13}}" name="b10_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b10_14}}" name="b10_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b10_15}}" name="b10_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b10_t}}" name="b10_t" type="text">
                                /
                                <input value="{{$data->b10_ot}}" name="b10_ot" type="text"> =</label> <input value="{{$data->b10_s}}" name="b10_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro11}}" type="text" name="pro11"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar11}}" type="text" name="tar11"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b11_1}}" name="b11_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b11_2}}" name="b11_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b11_3}}" name="b11_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b11_4}}" name="b11_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b11_5}}" name="b11_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b11_6}}" name="b11_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b11_7}}" name="b11_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b11_8}}" name="b11_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b11_9}}" name="b11_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b11_10}}" name="b11_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b11_11}}" name="b11_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b11_12}}" name="b11_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b11_13}}" name="b11_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b11_14}}" name="b11_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b11_15}}" name="b11_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b11_t}}" name="b11_t" type="text">
                                /
                                <input value="{{$data->b11_ot}}" name="b11_ot" type="text"> =</label> <input value="{{$data->b11_s}}" name="b11_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php
                        $data=$data7;
                    ?>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro12}}" type="text" name="pro12"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar12}}" type="text" name="tar12"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b12_1}}" name="b12_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b12_2}}" name="b12_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b12_3}}" name="b12_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b12_4}}" name="b12_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b12_5}}" name="b12_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b12_6}}" name="b12_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b12_7}}" name="b12_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b12_8}}" name="b12_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b12_9}}" name="b12_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b12_10}}" name="b12_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b12_11}}" name="b12_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b12_12}}" name="b12_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b12_13}}" name="b12_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b12_14}}" name="b12_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b12_15}}" name="b12_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b12_t}}" name="b12_t" type="text">
                                /
                                <input value="{{$data->b12_ot}}" name="b12_ot" type="text"> =</label> <input value="{{$data->b12_s}}" name="b12_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>
                  <div class="myrow row2">
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro13}}" type="text" name="pro13"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar13}}" type="text" name="tar13"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b13_1}}" name="b13_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b13_2}}" name="b13_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b13_3}}" name="b13_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b13_4}}" name="b13_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b13_5}}" name="b13_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b13_6}}" name="b13_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b13_7}}" name="b13_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b13_8}}" name="b13_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b13_9}}" name="b13_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b13_10}}" name="b13_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b13_11}}" name="b13_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b13_12}}" name="b13_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b13_13}}" name="b13_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b13_14}}" name="b13_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b13_15}}" name="b13_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b13_t}}" name="b13_t" type="text">
                                /
                                <input value="{{$data->b13_ot}}" name="b13_ot" type="text"> =</label> <input value="{{$data->b13_s}}" name="b13_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php
                        $data=$data8;
                    ?>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro14}}" type="text" name="pro14"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar14}}" type="text" name="tar14"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b14_1}}" name="b14_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b14_2}}" name="b14_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b14_3}}" name="b14_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b14_4}}" name="b14_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b14_5}}" name="b14_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b14_6}}" name="b14_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b14_7}}" name="b14_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b14_8}}" name="b14_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b14_9}}" name="b14_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b14_10}}" name="b14_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b14_11}}" name="b14_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b14_12}}" name="b14_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b14_13}}" name="b14_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b14_14}}" name="b14_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b14_15}}" name="b14_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b14_t}}" name="b14_t" type="text">
                                /
                                <input value="{{$data->b14_ot}}" name="b14_ot" type="text"> =</label> <input value="{{$data->b14_s}}" name="b14_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro15}}" type="text" name="pro15"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar15}}" type="text" name="tar15"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b15_1}}" name="b15_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b15_2}}" name="b15_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b15_3}}" name="b15_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b15_4}}" name="b15_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b15_5}}" name="b15_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b15_6}}" name="b15_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b15_7}}" name="b15_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b15_8}}" name="b15_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b15_9}}" name="b15_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b15_10}}" name="b15_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b15_11}}" name="b15_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b15_12}}" name="b15_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b15_13}}" name="b15_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b15_14}}" name="b15_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b15_15}}" name="b15_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b15_t}}" name="b15_t" type="text">
                                /
                                <input value="{{$data->b15_ot}}" name="b15_ot" type="text"> =</label> <input value="{{$data->b15_s}}" name="b15_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>
                  <?php
                        $data=$data9;
                    ?>
                  <div class="myrow row3">
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro16}}" type="text" name="pro16"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->pro16}}" type="text" name="pro16"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b16_1}}" name="b16_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b16_2}}" name="b16_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b16_3}}" name="b16_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b16_4}}" name="b16_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b16_5}}" name="b16_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b16_6}}" name="b16_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b16_7}}" name="b16_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b16_8}}" name="b16_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b16_9}}" name="b16_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b16_10}}" name="b16_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b16_11}}" name="b16_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b16_12}}" name="b16_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b16_13}}" name="b16_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b16_14}}" name="b16_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b16_15}}" name="b16_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b16_t}}" name="b16_t" type="text">
                                /
                                <input value="{{$data->b16_ot}}" name="b16_ot" type="text"> =</label> <input value="{{$data->b16_s}}" name="b16_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro17}}" type="text" name="pro17"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar17}}" type="text" name="tar17"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b17_1}}" name="b17_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b17_2}}" name="b17_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b17_3}}" name="b17_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b17_4}}" name="b17_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b17_5}}" name="b17_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b17_6}}" name="b17_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b17_7}}" name="b17_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b17_8}}" name="b17_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b17_9}}" name="b17_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b17_10}}" name="b17_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b17_11}}" name="b17_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b17_12}}" name="b17_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b17_13}}" name="b17_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b17_14}}" name="b17_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b17_15}}" name="b17_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b17_t}}" name="b17_t" type="text">
                                /
                                <input value="{{$data->b17_ot}}" name="b17_ot" type="text"> =</label> <input value="{{$data->b17_s}}" name="b17_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php
                        $data=$data10;
                        $data1=$data10;
                        $data3=$data12;
                    ?>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="5"> <label>Program:</label> <input value="{{$data->pro18}}" type="text" name="pro18"></th>
                          </tr>
                          <tr>
                            <th colspan="5"> <label>Target:</label> <input value="{{$data->tar18}}" type="text" name="tar18"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> <span><input value="{{$data->b18_1}}" name="b18_1" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 1
                            </td>
                            <td> <span><input value="{{$data->b18_2}}" name="b18_2" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 2
                            </td>
                            <td> <span><input value="{{$data->b18_3}}" name="b18_3" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 3
                            </td>
                            <td> <span><input value="{{$data->b18_4}}" name="b18_4" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 4
                            </td>
                            <td> <span><input value="{{$data->b18_5}}" name="b18_5" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 5
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b18_6}}" name="b18_6" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 6
                            </td>
                            <td> <span><input value="{{$data->b18_7}}" name="b18_7" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 7
                            </td>
                            <td> <span><input value="{{$data->b18_8}}" name="b18_8" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 8
                            </td>
                            <td> <span><input value="{{$data->b18_9}}" name="b18_9" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span> 9
                            </td>
                            <td> <span><input value="{{$data->b18_10}}" name="b18_10" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              10
                            </td>
                          </tr>
                          <tr>
                            <td> <span><input value="{{$data->b18_11}}" name="b18_11" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              11
                            </td>
                            <td> <span><input value="{{$data->b18_12}}" name="b18_12" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              12
                            </td>
                            <td> <span><input value="{{$data->b18_13}}" name="b18_13" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              13
                            </td>
                            <td> <span><input value="{{$data->b18_14}}" name="b18_14" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              14
                            </td>
                            <td> <span><input value="{{$data->b18_15}}" name="b18_15" type="text" style="width:30px; height:30px;"></span> <span class="plus">+</span>
                              15
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:5px 0px 5px 10px; font-size:18px;" colspan="5"> <label>Total: <input value="{{$data->b18_t}}" name="b18_t" type="text">
                                /
                                <input value="{{$data->b18_ot}}" name="b18_ot" type="text"> =</label> <input value="{{$data->b18_s}}" name="b18_s" type="text"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </section><br>
                <section class="section_4">
                  <div class="myrow">
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="2"><label>Task Analysis:</label> <input value="{{$data->task1}}" type="text" name="task1"></th>
                          </tr>
                          <tr>
                            <td>1) <input value="{{$data->task1_1}}" type="text" name="task1_1"></td>
                            <td><input value="{{$data->v1_1}}" type="text" name="v1_1"></td>
                          </tr>
                          <tr>
                            <td>2) <input value="{{$data->task1_2}}" type="text" name="task1_2"></td>
                            <td><input value="{{$data->v1_2}}" type="text" name="v1_2"></td>
                          </tr>
                          <tr>
                            <td>3) <input value="{{$data->task1_3}}" type="text" name="task1_3"></td>
                            <td><input value="{{$data->v1_3}}" type="text" name="v1_3"></td>
                          </tr>
                          <tr>
                            <td>4) <input value="{{$data->task1_4}}" type="text" name="task1_4"></td>
                            <td><input value="{{$data->v1_4}}" type="text" name="v1_4"></td>
                          </tr>
                          <tr>
                            <td>5) <input value="{{$data->task1_5}}" type="text" name="task1_5"></td>
                            <td><input value="{{$data->v1_5}}" type="text" name="v1_5"></td>
                          </tr>
                          <tr>
                            <td>6) <input value="{{$data->task1_6}}" type="text" name="task1_6"></td>
                            <td><input value="{{$data->v1_6}}" type="text" name="v1_6"></td>
                          </tr>
                          <tr>
                            <td>7) <input value="{{$data->task1_7}}" type="text" name="task1_7"></td>
                            <td><input value="{{$data->v1_7}}" type="text" name="v1_7"> </td>
                          </tr>
                          <tr>
                            <td>8)<input value="{{$data->task1_8}}" type="text" name="task1_8"></td>
                            <td><input value="{{$data->v1_8}}" type="text" name="v1_8"></td>
                          </tr>
                          <tr>
                            <td>9) <input value="{{$data->task1_9}}" type="text" name="task1_9"></td>
                            <td><input value="{{$data->v1_9}}" type="text" name="v1_9"></td>
                          </tr>
                          <tr>
                            <td>10) <input value="{{$data->task1_10}}" type="text" name="task1_10"></td>
                            <td><input value="{{$data->v1_10}}" type="text" name="v1_10"></td>
                          </tr>
                          <tr>
                            <?php $data=$data12;?>
                            <td colspan="2"> <label>Total:</label> <input value="{{$data3->task1_t}}" type="text" name="task1_t"> </td>
                            <?php $data=$data11;?>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="2"><label>Task Analysis:</label> <input value="{{$data1->task2}}" type="text" name="task2"></th>
                          </tr>
                          <tr>
                            <td>1) <input value="{{$data->task2_1}}" type="text" name="task2_1"></td>
                            <td><input value="{{$data->v2_1}}" type="text" name="v2_1"></td>
                          </tr>
                          <tr>
                            <td>2) <input value="{{$data->task2_2}}" type="text" name="task2_2"></td>
                            <td><input value="{{$data->v2_2}}" type="text" name="v2_2"></td>
                          </tr>
                          <tr>
                            <td>3) <input value="{{$data->task2_3}}" type="text" name="task2_3"></td>
                            <td><input value="{{$data->v2_3}}" type="text" name="v2_3"></td>
                          </tr>
                          <tr>
                            <td>4) <input value="{{$data->task2_4}}" type="text" name="task2_4"></td>
                            <td><input value="{{$data->v2_4}}" type="text" name="v2_4"></td>
                          </tr>
                          <tr>
                            <td>5) <input value="{{$data->task2_5}}" type="text" name="task2_5"></td>
                            <td><input value="{{$data->v2_5}}" type="text" name="v2_5"></td>
                          </tr>
                          <tr>
                            <td>6) <input value="{{$data->task2_6}}" type="text" name="task2_6"></td>
                            <td><input value="{{$data->v2_6}}" type="text" name="v2_6"></td>
                          </tr>
                          <tr>
                            <td>7) <input value="{{$data->task2_7}}" type="text" name="task2_7"></td>
                            <td><input value="{{$data->v2_7}}" type="text" name="v2_7"></td>
                          </tr>
                          <tr>
                            <td>8)<input value="{{$data->task2_8}}" type="text" name="task2_8"></td>
                            <td><input value="{{$data->v2_8}}" type="text" name="v2_8"></td>
                          </tr>
                          <tr>
                            <td>9) <input value="{{$data->task2_9}}" type="text" name="task2_9"></td>
                            <td><input value="{{$data->v2_9}}" type="text" name="v2_9"></td>
                          </tr>
                          <tr>
                            <td>10) <input value="{{$data->task2_10}}" type="text" name="task2_10"></td>
                            <td><input value="{{$data->v2_10}}" type="text" name="v2_10"></td>
                          </tr>
                          <tr>
                            <?php $data=$data12;?>
                            <td colspan="2"> <label>Total:</label> <input value="{{$data3->task2_t}}" type="text" name="task2_t"> </td>
                            <?php $data=$data11;?>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <div class="col-item">
                      <table cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th colspan="2"><label>Task Analysis:</label> <input value="{{$data1->task3}}" type="text" name="task3"></th>
                          </tr>
                          <tr>
                            <td>1) <input value="{{$data->task3_1}}" type="text" name="task3_1"></td>
                            <td><input value="{{$data->v3_1}}" type="text" name="v3_1"></td>
                          </tr>
                          <tr>
                            <td>2) <input value="{{$data->task3_2}}" type="text" name="task3_2"></td>
                            <td><input value="{{$data->v3_2}}" type="text" name="v3_2"></td>
                          </tr>
                          <tr>
                            <td>3) <input value="{{$data->task3_3}}" type="text" name="task3_3"></td>
                            <td><input value="{{$data->v3_3}}" type="text" name="v3_3"></td>
                          </tr>
                          <tr>
                            <td>4) <input value="{{$data->task3_4}}" type="text" name="task3_4"></td>
                            <td><input value="{{$data->v3_4}}" type="text" name="v3_4"></td>
                          </tr>
                          <tr>
                            <td>5) <input value="{{$data->task3_5}}" type="text" name="task3_5"></td>
                            <td><input value="{{$data->v3_5}}" type="text" name="v3_5"></td>
                          </tr>
                          <tr>
                            <td>6) <input value="{{$data->task3_6}}" type="text" name="task3_6"></td>
                            <td><input value="{{$data->v3_6}}" type="text" name="v3_6"></td>
                          </tr>
                          <tr>
                            <td>7) <input value="{{$data->task3_7}}" type="text" name="task3_7"></td>
                            <td><input value="{{$data->v3_7}}" type="text" name="v3_7"></td>
                          </tr>
                          <tr>
                            <td>8)<input value="{{$data->task3_8}}" type="text" name="task3_8"></td>
                            <td><input value="{{$data->v3_8}}" type="text" name="v3_8"></td>
                          </tr>
                          <tr>
                            <td>9) <input value="{{$data->task3_9}}" type="text" name="task3_9"></td>
                            <td><input value="{{$data->v3_9}}" type="text" name="v3_9"></td>
                          </tr>
                          <tr>
                            <td>10) <input value="{{$data->task3_10}}" type="text" name="task3_10"></td>
                            <td><input value="{{$data->v3_10}}" type="text" name="v3_10"></td>
                          </tr>
                          <tr>
                            <?php $data=$data12;?>
                            <td colspan="2"> <label>Total:</label> <input value="{{$data3->task3_t}}" type="text" name="task3_t"> </td>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </section>
                <br>
                <section class="section_5">
                  <table cellpadding="0" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Antecedent</th>
                        <th>Behavior</th>
                        <th>Consequence</th>
                        <th>Function</th>
                        <th>Frequency</th>
                      </tr>
                      <tr>
                        <td><input value="{{$data->ant1}}" type="text" name="ant1"></td>
                        <td><input value="{{$data->beh1}}" type="text" name="beh1"></td>
                        <td><input value="{{$data->con1}}" type="text" name="con1"></td>
                        <td><input value="{{$data->fun1}}" type="text" name="fun1"></td>
                        <td><input value="{{$data->fre1}}" type="text" name="fre1"></td>
                      </tr>
                      <tr>
                        <td><input value="{{$data->ant2}}" type="text" name="ant2"></td>
                        <td><input value="{{$data->beh2}}" type="text" name="beh2"></td>
                        <td><input value="{{$data->con2}}" type="text" name="con2"></td>
                        <td><input value="{{$data->fun2}}" type="text" name="fun2"></td>
                        <td><input value="{{$data->fre2}}" type="text" name="fre2"></td>
                      </tr>
                      <tr>
                        <td><input value="{{$data->ant3}}" type="text" name="ant3"></td>
                        <td><input value="{{$data->beh3}}" type="text" name="beh3"></td>
                        <td><input value="{{$data->con3}}" type="text" name="con3"></td>
                        <td><input value="{{$data->fun3}}" type="text" name="fun3"></td>
                        <td><input value="{{$data->fre3}}" type="text" name="fre3"></td>
                      </tr>
                    </thead>
                  </table>
                </section>
              </div>
              
              <div class="section_bottom">
                <div class="button-row flex-div">
                  <div class="save-prog"><button type="submit"><span class="cloud-icon"><i class="fas fa-cloud"></i></span>
                      Save</button></div>
                  <div class="print"><button type="button" class="pdf_btn"><span class="print-icon"><i
                          class="fas fa-print"></i></span>Print</button>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="signatureModal" data-backdrop="static">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4>Add signature</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#drawsig">Draw</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#uploadsig">Upload</a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="drawsig">
                          <div class="myrow mb-2">
                            <div class="col-md-12">
                              <canvas id="sig-canvas" height="120" style="width: 100%;"></canvas>
                            </div>
                            <input type="hidden" class="form-control-file sing_draw"
                            name="sing_draw">
                          </div>
                          <button type="button" class="btn btn-danger p-2" id="sig-clearBtn">Clear</button>
                        </div>
                        <div class="tab-pane fade" id="uploadsig">
                          <label>Upload File</label>
                          <input type="file" class="form-control-file" name="updload_sign">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add
                      Signature
                      </button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- signature modal caregiver -->
              <div class="modal fade" id="signatureModal2" data-backdrop="static">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4>Add signature</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#drawsig2">Draw</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#uploadsig2">Upload</a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="drawsig2">
                          <div class="myrow mb-2">
                            <div class="col-md-12">
                              <canvas id="sig-canvas2" height="120" style="width: 100%;"></canvas>
                            </div>
                            <input type="hidden" class="form-control-file sing_draw2"
                            name="sing_draw2">
                          </div>
                          <button type="button" class="btn btn-danger p-2" id="sig-clearBtn2">Clear</button>
                        </div>
                        <div class="tab-pane fade" id="uploadsig2">
                          <label>Upload File</label>
                          <input type="file" class="form-control-file" name="updload_sign2">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add
                      Signature
                      </button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>


            </form>
            <div class="footer-section">
                <div class="flex-div">
                    <div class="col-item">
                        <p><strong>{{$name_location->facility_name}}</strong> {{$name_location->address}}. {{$name_location->city}}
                                , {{$name_location->state}} {{$name_location->zip}}
                        </p>
                    </div>
                    <div class="col-item">
                        <p><a href="tel:{{$name_location->phone_one}}">Phone: {{$name_location->phone_one}},</a> &nbsp;<a
                                href="mailto:{{$name_location->email}}"> <span>Email:</span>
                                {{$name_location->email}},</a>&nbsp;<a href="{{$name_location->email}}">{{$name_location->email}}</a></p>
                    </div>
                </div>
            </div>
            <form class="pdf_form" action="{{ route('provider.print.form.30')}}" target="_blank" method="POST">
            @csrf
                <input type="hidden" name="session_id" class="session_id" value="{{$session_id}}">
            </form>
        </div>
    </div>
<!-- Jq Files -->
<script src="{{asset('assets/dashboard//')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard//')}}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/build/toastr.min.js"></script>
<script src="{{ asset('assets/') }}/toastr/toastr.init.js"></script>
<script>
    $(document).ready(function () {
      
      $(document).on('click','.pdf_btn',function(){
            $('.pdf_form').submit();
        })
        $(document).on('submit', '#form_30', function (e) {
            e.preventDefault();
            let canvas2 = document.getElementById('sig-canvas');
            let canvas3 = document.getElementById('sig-canvas2');
            let dataURL2 = canvas2.toDataURL();
            let dataURL3 = canvas3.toDataURL();

            let sing_draw = $('.sing_draw').val(dataURL2);
            let sing_draw2 = $('.sing_draw2').val(dataURL3);

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{route('provider.30.form.submit')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    console.log(data)
     
                    toastr["success"]("Form Successfully Created", 'SUCCESS!');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        })
    })
</script>

@include('provider.include.forms_js_include')
</body>

</html>
