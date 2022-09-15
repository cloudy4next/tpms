@extends('layouts.client')
@section('client')
    <style>
        .profile_img {
            width: 100px;
            height: 100px;
            margin: 40px 50px;
        }

        .user-color-photo{
            color: #fff;
            text-align: center;
            height: 100px;
            width: 100px;
            line-height: 100px;
            border-radius: 50%;
            margin: 40px 50px;
            font-size: 40px;
        }

    </style>
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="d-lg-flex">
                <!-- menu -->
                <div class="setting_menu chat_profile">
                    <p>
                        @if($user->profile_photo==null)
                            <div class="profile_img user-color-photo {{$user->profile_color}}">{{$fl}}</div>
                        @else
                            <img class="profile_img img-fluid rounded-circle" src="{{asset('/').$user->profile_photo}}">
                        @endif
                    </p>
                    <h4 class="common-title text-center">{{$name}}</h4>

                </div>
                <!-- content -->
                <div class="all_content flex-fill">
                    <h2 class="common-title">Messenger Files</h2>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered c_table">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>File Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                ?>
                                @foreach($data as $rec)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$rec->attachment}}</td>
                                    <?php
                                        if($rec->status==1){
                                            $status="Available";
                                        }
                                        else{
                                            $status="Unavailable";
                                        }
                                    ?>
                                    <td>{{$status}}</td>
                                    <td>
                                        <a href="{{route('client.chat.download.file',$rec->attachment)}}"><i class="ri-download-2-line"></i></a>
                                    </td>
                                </tr>
                                <?php
                                    $i++;
                                ?>
                                @endforeach
                            </tbody>        
                        </table>
                    </div>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection