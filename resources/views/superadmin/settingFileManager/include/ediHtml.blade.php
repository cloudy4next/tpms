<h2 class="common-title">EDI FILE</h2>
<div class="table-responsive">
    <table class="table table-sm table-bordered c_table">
        <thead>
        <tr>
            <th class="checkbox"><input type="checkbox" class="check_all"></th>
            <th>File Name</th>
            <th>Received Date</th>
            <th>Processed Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $rec)
            @php
                $fileName=array('','','');
                $fileName=explode('/',$rec->file_name);
                $userName=$fileName[1];
                $fileName=$fileName[2];
            @endphp

            <tr>
                <td><input type="checkbox" class="in_check" id="{{$rec->id}}"></td>
                {{-- <td>{{$rec->sl_no}}</td> --}}
                <td>{{$fileName}}</td>
                <td>
                    @if($rec->receive_date!=null)
                        {{\Carbon\Carbon::parse($rec->receive_date)->format('m/d/Y')}}
                    @endif
                </td>
                <td>
                    @if($rec->process_date!=null)
                        {{\Carbon\Carbon::parse($rec->process_date)->format('m/d/Y')}}
                    @endif
                </td>
                @php
                    if(substr($fileName, -4)==".zip"){
                        $check="zip";
                    }
                    else{
                        $check="txt";
                    }

                @endphp
                <td>
                    @if($check=="txt")
                        <a href="{{route('open.sftp.txt',['user'=>$userName,'name'=>$fileName])}}" target="_blank"><i class="fa fa-eye text-primary"></i></a>
                    @else
                        <a href="" data-toggle="modal" data-target="#export{{$rec->id}}"><i class="fa fa-eye text-primary"></i></a>
                    @endif
                    <div class="modal fade password_modal" id="export{{$rec->id}}" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Export Report</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <form action="{{route('open.sftp.file')}}" method="POST" id="enc_form{{$rec->id}}">
                                    @csrf
                                    <div class="modal-body">
                                        <h6>You can encrypt your file with password to prevent
                                        unauthorized access to your data.</h6>
                                        <!-- Export with additional fields -->
                                        <!-- Export with password -->
                                        <div class="encryption">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input exportWithPassword{{$rec->id}}" id="exportWithPassword" value="1" name="pass_check">Encrypt with password<i
                                                    class="ri-question-line" title="This password isn't saved anywhere. Hence the file can't be recovered if the password is forgotten. The password is case sensitive"></i>
                                                </label>
                                            </div>
                                            <div class="row mt-2 pw">
                                                <div class="col-md">
                                                    <input type="hidden" name="zip_name" value="{{$rec->file_name}}">
                                                    <input type="password" name="password"
                                                    class="form-control pass pass{{$rec->id}}" placeholder="Enter password to encrypt with">
                                                    <div class="invalid-feedback">Enter Password</div>
                                                </div>
                                                <div class="col-md">
                                                    <input type="password" name="confirm_password"
                                                    class="form-control c_pass c_pass{{$rec->id}}" placeholder="Confirmed password">
                                                    <div class="invalid-feedback">Enter Confirm
                                                        Password
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="continue" file-id="{{$rec->id}}">Continue</button>
                                        <button type="button" class="btn btn-danger"
                                        data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex">
    <div class="align-self-end mr-2">
        <select class="form-control form-control-sm">
            <option>Reviewed</option>
            <option>Unreviewed</option>
            <option>Process ERA</option>
        </select>
    </div>
    <div class="align-self-end mr-2">
        <button type="button" class="btn btn-sm btn-primary">OK</button>
    </div>
</div>
<br>
{{$data->links()}}