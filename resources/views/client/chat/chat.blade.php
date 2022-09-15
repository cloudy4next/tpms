@extends('layouts.client')

@section('client')
<style>
    
    .modal-body
    {
       min-height: 400px;
       overflow: scroll;
       overflow-x: hidden;
    }

    .send_new_btn{
        float: right;
        margin-right: 20px;
        margin-top: 10px;
    }

    .emojionearea {
        position: absolute;
        bottom: 0;
    }
    .emojionearea > .emojionearea-editor {
        min-height: 30px !important;
        width: 100%;
    }

    .emojioneemoji {
        width: 20px !important;
        height: 20px !important; 
    }

    .chat-message a {
        color: #FFBD59;
    }

    .chat-content {
        height: 480px;
        overflow-y: scroll;
    }

    .chat-footer{
        min-height: 50px;
    }

</style>
<div class="iq-card">
    <div class="iq-card-body">
        <div class="row">
            <div class="col-lg-3 chat-data-left scroller">
                <div class="chat-sidebar-channel scroller pl-3">
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm search_user search_side_user"
                                placeholder="Search Here..">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="button"><i
                                        class="ri-search-line py-0"></i></button>
                                <button class="btn p-0 text-primary ml-2 start_chat_btn" type="button"
                                    data-target="#start_chat_modal" data-toggle="modal"
                                    style="font-size: 16px;"><i class="las la-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="chat_sidebox">
                        <div class="recent_box"></div>
                        <div class="all_chat_box"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 chat-data p-0 chat-data-right">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="default-block" role="tabpanel">
                        <div class="chat-start">
                            <span class="iq-start-icon text-primary"><i
                            class="ri-message-3-line"></i></span>
                            <button id="chat-start" class="btn bg-primary mt-3 start_chat_btn" data-target="#start_chat_modal" data-toggle="modal">Start
                            Conversation!</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="chatbox" role="tabpanel">
                        <div class="chat-head">
                            <header
                                class="d-flex justify-content-between align-items-center pt-0  pl-3 pr-3 pb-1">
                                <div class="d-flex align-items-center top_user_box">
                                    
                                </div>
                                <div class="chat-header-icons d-flex">
                                    {{-- <a href="#" class="chat-icon-phone">
                                        <i class="ri-phone-line"></i>
                                    </a>
                                    <a href="#" class="chat-icon-video">
                                        <i class="ri-vidicon-line"></i>
                                    </a> --}}
                                    <a href="#" class="chat-icon-phone" title="Attachment History" id="attach_link" target="_blank">
                                        <i class="ri-attachment-line"></i>
                                    </a>
                                    {{-- <a href="#" class="chat-icon-delete iq-bg-primary delete_btn">
                                        <i class="ri-delete-bin-line"></i>
                                    </a> --}}
                                    {{-- <span class="dropdown">
                                        <i class="ri-more-2-line cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer"
                                        id="dropdownMenuButton01" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" role="menu"></i>
                                        <span class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdownMenuButton01">
                                            <a class="dropdown-item" href="JavaScript:void(0);"><i
                                                class="fa fa-thumb-tack" aria-hidden="true"></i> Pin
                                            to top</a>
                                            <a class="dropdown-item delete_btn" href="JavaScript:void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            chat</a>
                                            <a class="dropdown-item" href="JavaScript:void(0);"><i
                                            class="fa fa-ban" aria-hidden="true"></i> Block</a>
                                        </span>
                                    </span> --}}
                                </div>
                            </header>
                        </div>
                        <div class="chat-content scroller">
                            
                        </div>
                        <div class="chat-footer p-3 bg-white">
                            <div class="border border-primary p-3 preview-chat" style="display:none;">
                                <div class="overflow-hidden">
                                    <button type="button" class="close" aria-label="Close" id="close_preview">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="preview-container">

                                    <!-- for image -->
                                    <div class="for-img img_preview" style="display: none;">
                                        <div class="row">
                                            <div class="col">
                                                <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg"
                                                class="img-fluid d-block mx-auto img-thumbnail img_preview_image"
                                                alt="img">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- for file -->
                                    <div class="for-file file_preview" style="display: none;">
                                        <h4 class="font-weight-bolder file_heading"><i class="fa fa-paperclip pr-1"></i></h4>
                                        <p class="file_type">PDF Type</p>
                                    </div>
                                    <!-- for user -->
                                    <div class="for-user user_preview mx-3" style="display: none;">
                                        <p class="user_file_image_cont">
                                            
                                        </p>
                                        <p class="font-weight-bold" style="font-size:18px;"><a href="#" class="user_file_name"></a></p>
                                    </div>
                                    <div class="form-group">
                                        <div class="progress" style="height: 15px;">
                                            <div class="progress-bar text-white progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    <div class="text-danger warning_msg"><p>File larger than 10MB</p></div>
                                </div>
                            </div>
                            <form class="d-flex align-items-center" action="{{ route('client.send.msg') }}" id="upload_form" enctype="multipart/form-data">
                                @csrf
                                <div class="chat-attagement d-flex">
                                        <a href="#" id="upload">
                                            <i class="fa fa-paperclip pr-3" aria-hidden="true"></i>
                                        </a>
                                    <input type="file" name="attached_file" id="attached_file" style="display:none;">
                                    <input type="hidden" value="" id="msg" name="msg">
                                    <input type="hidden" id="fileName" name="f_name" value="empty">
                                    <input type="hidden" value="" name="chat_id" id="chat_id">
                                    <input type="hidden" value="" name="to_id" id="to_id">
                                    <input type="hidden" value="" name="to_type" id="to_type">
                                    <input type="hidden" value="" name="hyper_link" id="hyper_link">
                                </div>
                                <textarea type="text" class="form-control mr-3 msg_area message"
                                placeholder="Type your message"></textarea>
                                <button type="submit" class="btn btn-primary d-flex align-items-center p-2 send_btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i><span class="d-none d-lg-block ml-1">Send</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="start_chat_modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-white">
                <input type="search" class="form-control search_new_user mt-2" placeholder="Search User (You can search by user name or user type to categorize)">
            </div>
            <div class="modal-body">
               <div class="chat-data-left scroller">
                    <div class="chat-sidebar-channel scroller pl-3">
                        <div class="user_list"></div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="attach_patient_modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-white">
                <input type="search" class="form-control search_patient mt-2" placeholder="Search Patient...">
            </div>
            <div class="modal-body">
               <div class="chat-data-left scroller">
                    <div class="chat-sidebar-channel scroller pl-3">
                        <div class="patients_list"></div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="message_modal">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body message_div form-control">
        <form action="" method="POST" id="upload_new_form" enctype="multipart/form-data">
            @csrf
            <textarea class="new_message" placeholder="Type something..."></textarea>
            <input type="file" name="attached_file" id="attached_file_new" style="display: none;">
            <input type="hidden" value="" name="msg" id="msg_new">
            <input type="hidden" value="" name="chat_id" id="chat_id_new">
            <input type="hidden" value="" name="to_id" id="to_id_new">
            <input type="hidden" value="" name="to_type" id="to_type_new">
            <button type="button" class="btn btn-primary d-flex align-items-center p-2" id="upload_new"><i class="fa fa-paperclip pr-1" aria-hidden="true"></i>Attach File</button>
            <button type="submit" class="btn btn-primary d-flex align-items-center p-2 send_button1"><i class="fa fa-paper-plane-o pr-1" aria-hidden="true"></i>Send</button>
        </form>
      </div>
    </div>
  </div>
</div>




@endsection
@include('client.chat.include.chat_js')