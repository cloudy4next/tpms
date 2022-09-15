@section('js')
<script>
	$(document).ready(function(){

		var chat_id=0;
    var temp_chat_id=0;
		var user_name;
    var user_type;
		var existing_chat;
    var existing_msg;
		var all_contacts='';
		var msg;
		var online_status;
    var to_send_id=0;
    var to_send_type='';
    var scrolled=true;
    var lm_id=0;
    var lsm_id=0;
    var lc_time='';
    var ajax_run_check=true;
    var ajax_chat_check=true;
    var ajax_msg_check=true;
    var ajax_delete_check=true;
    $('.warning_msg').hide();
    var uploadAjax=null;
    var lf_load=0;

    function fetch_all_contacts(){
      $.ajax({
          url:"{{ route('superadmin.fetch.all.contacts') }}",
          method:"POST",
          data:{'_token' : "{{csrf_token()}}"},
          dataType:"json",
          success:function(data){
            //console.log(data);
            all_contacts=data;
            print_list(all_contacts);
            print_list_new(all_contacts);
          }
      });
    }

    function fetch_all_patients(){
      $.ajax({
          url:"{{ route('superadmin.fetch.all.patients') }}",
          method:"POST",
          data:{'_token' : "{{csrf_token()}}"},
          dataType:"json",
          success:function(data){
            //console.log(data);
            all_patients=data;
            print_patients(all_patients);
          }
      });
    }

    function print_list_new(arr){
      $('.user_list').html('');
      user_list_html='';
      if(arr && arr.length>0){
          user_list_html+='<h2 class="common-title">All Contacts</h2>';
          user_list_html+=`<ul class="iq-chat-ui nav flex-column nav-pills">`;
          $.each(arr, function(index, val) {
            if(val.status=="online")  online='text-success';
            else  online='text-light';
            if(val.profile_photo==''){
              profile="empty";
            }
            else{
              profile="{{asset('/')}}"+val.profile_photo;
            }  

              user_list_html+=`<li>
                                  <a data-dismiss="modal" href="#" class="side_link" id="`+val.chat_id+`" user_name="`+val.name+`" online_status="`+online+`" profile_photo="`+profile+`" to_id="`+val.id+`" to_type="`+val.type+`" fl="`+val.fl+`" profile_color="`+val.color+`">
                                      <div class="d-flex align-items-center">
                                          <div class="avatar mr-3">`;
              if(val.profile_photo==''){
                user_list_html+=`<div class="user-img `+val.color+`">`+val.fl+`</div>`;
              }
              else{
                profile="{{asset('/')}}"+val.profile_photo;
                user_list_html+=`<img src="`+profile+`" alt="chatuserimage" class="user-img avatar-50 rounded">`;
              }

              user_list_html+=`
                                              <span class="avatar-status"><i
                                                      class="ri-checkbox-blank-circle-fill `+online+`"></i></span>
                                          </div>
                                          <div class="chat-sidebar-name">
                                              <h6 class="mb-0">`+val.name+`</h6>
                                              <span style="text-transform: capitalize;">`+val.type+`</span>
                                          </div>
                                      </div>
                                  </a>
                                </li>`;
          });

          user_list_html+=`</ul>`;

      }
      //console.log(user_list_html);
      $('.user_list').html(user_list_html);
    }

    function print_patients(arr){
      $('.patients_list').html('');
      user_list_html='';
      if(arr && arr.length>0){
          user_list_html+='<h2 class="common-title">All Patients</h2>';
          user_list_html+=`<ul class="iq-chat-ui nav flex-column nav-pills">`;
          $.each(arr, function(index, val) {
            if(val.status=="online")  online='text-success';
            else  online='text-light';
            if(val.profile_photo==''){
              profile="empty";
            }
            else{
              profile="{{asset('/')}}"+val.profile_photo;
            }  

              user_list_html+=`<li>
                                  <a data-dismiss="modal" href="#" class="patient_link" client_name="`+val.name+`" client_id="`+val.id+`" client_photo="`+profile+`" client_color="`+val.color+`">
                                      <div class="d-flex align-items-center">
                                          <div class="avatar mr-3">`;
              if(val.profile_photo==''){
                user_list_html+=`<div class="user-img `+val.color+`">`+val.fl+`</div>`;
              }
              else{
                profile="{{asset('/')}}"+val.profile_photo;
                user_list_html+=`<img src="`+profile+`" alt="chatuserimage" class="user-img avatar-50 rounded">`;
              }

              user_list_html+=`
                                              <span class="avatar-status"><i
                                                      class="ri-checkbox-blank-circle-fill `+online+`"></i></span>
                                          </div>
                                          <div class="chat-sidebar-name">
                                              <h6 class="mb-0">`+val.name+`</h6>
                                          </div>
                                      </div>
                                  </a>
                                </li>`;
          });

          user_list_html+=`</ul>`;

      }
      //console.log(user_list_html);
      $('.patients_list').html(user_list_html);
    }

    function existing_chats(){
      if(ajax_chat_check==true){
        $.ajax({
            url:"{{ route('superadmin.existing.chats') }}",
            method:"POST",
            data:{
              '_token' : "{{csrf_token()}}",
              'lc_time':lc_time
            },
            beforeSend:function(){
              ajax_chat_check=false;
            },
            success:function(data){
                //console.log(data);
                lc_time=data.lc_time;
                ajax_chat_check=true;
                if(data.chats.length>0){
                  existing_chat=data.chats;
                }
                if(existing_chat.length>0){
                  existing_array=data;
                  if($('.search_side_user').val().length==0){
                    print_side(existing_chat);
                  }
                }
            }
        });
      }

    }

    function print_list(arr){
      user_list_html=`<h2 class="common-title d-flex justify-content-between">
              <div>All Contacts</div>
              <div>
                  <button type="button" class="btn p-0 text-white dropdown-toggle"
                      data-toggle="dropdown"><i class="ri-equalizer-line"></i></button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="#" id="admin_filter">Admin</a>
                      <a class="dropdown-item" href="#" id="staff_filter">Staff</a>
                      <a class="dropdown-item" href="#" id="client_filter">Client</a>
                      <a class="dropdown-item" href="#" id="all_filter">All Contacts</a>
                  </div>
              </div>
            </h2>`;
      if(arr && arr.length>0){
          user_list_html+=`
            
            <ul class="iq-chat-ui nav flex-column nav-pills">`;
          $.each(arr, function(index, val) {
            if(val.status=="online")  online='text-success';
            else  online='text-light';
            if(val.profile_photo==''){
              profile="empty";
            }
            else{
              profile="{{asset('/')}}"+val.profile_photo;
            }  
              user_list_html+=`
                            <li>
                                <a data-toggle="pill" href="#" class="side_link" id="`+val.chat_id+`" user_name="`+val.name+`" online_status="`+online+`" profile_photo="`+profile+`" to_id="`+val.id+`" to_type="`+val.type+`" fl="`+val.fl+`" profile_color="`+val.color+`">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar mr-3">`;

              if(val.profile_photo==''){
                user_list_html+=`<div class="user-img `+val.color+`">`+val.fl+`</div>`;
              }
              else{
                profile="{{asset('/')}}"+val.profile_photo;
                user_list_html+=`<img src="`+profile+`" alt="chatuserimage" class="avatar-50 rounded">`;
              }



              user_list_html+=`
                                            <span class="avatar-status"><i
                                                    class="ri-checkbox-blank-circle-fill `+online+`"></i></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">`+val.name+`</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                  `;
          });

          user_list_html+=`</ul>`;
      }
      $('.all_chat_box').html(user_list_html);
    }

    function print_side(arr){
      html='';
      html+=`<h2 class="common-title">Recent Chats</h2>
            <ul class="iq-chat-ui nav flex-column nav-pills">`;
      $.each(arr, function(index, val) {
        if(val.status=="online")  online='text-success';
        else  online='text-light';
        

        //console.log(profile);

        if(val.ur_count==0){
          ur_count='';
        }
        else{
          ur_count=`<div class="chat-msg-counter bg-primary text-white">`+val.ur_count+`</div>`;
        }

        if(val.profile==''){
          profile="empty";
        }
        else{
          profile="{{asset('/')}}"+val.profile;
        } 


        html+=`<li>
                <a data-toggle="pill" href="#chatbox" class="side_link" id="`+val.chat_id+`" user_name="`+val.name+`" online_status="`+online+`" profile_photo="`+profile+`" fl="`+val.fl+`" profile_color="`+val.color+`">
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-3">`;

        if(val.profile==''){
          html+=`<div class="user-img `+val.color+`">`+val.fl+`</div>`;
        }
        else{
          profile="{{asset('/')}}"+val.profile;
          html+=`<img src="`+profile+`" alt="chatuserimage" class="avatar-50 rounded">`;
        }



        html+=`
                            <span class="avatar-status"><i
                            class="ri-checkbox-blank-circle-fill `+online+`"></i></span>
                        </div>
                        <div class="chat-sidebar-name">
                            <h6 class="mb-0">`+val.name+`</h6>
                        </div>
                        <div class="chat-meta float-right text-center mt-2">`+ur_count+`
                            <span class="text-nowrap">`+val.time+`</span>
                        </div>
                    </div>
                </a>
            </li>`;

      });
      html+=`</ul>`;
      $('.recent_box').html(html);
    }

    function print_side_search(arr){
      $('.user_list').html('');
      user_list_html='';
      if(arr && arr.length>0){
          user_list_html+=`<h2 class="common-title">Search Results</h2>
                        <ul class="iq-chat-ui nav flex-column nav-pills">`;
          $.each(arr, function(index, val) {
            if(val.status=="online")  online='text-success';
            else  online='text-light';
            if(val.profile_photo==''){
              profile="empty";
            }
            else{
              profile="{{asset('/')}}"+val.profile_photo;
            }  
              user_list_html+=`
                            <li>
                                <a data-toggle="pill" href="#" class="side_link" id="`+val.chat_id+`" user_name="`+val.name+`" online_status="`+online+`" profile_photo="`+profile+`" to_id="`+val.id+`" to_type="`+val.type+`" fl="`+val.fl+`" profile_color="`+val.color+`">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar mr-3">`;
              if(val.profile_photo==''){
                user_list_html+=`<div class="user-img `+val.color+`">`+val.fl+`</div>`;
              }
              else{
                profile="{{asset('/')}}"+val.profile_photo;
                user_list_html+=`<img src="`+profile+`" alt="chatuserimage" class="avatar-50 rounded">`;
              }


              user_list_html+=`
                                            <span class="avatar-status"><i
                                                    class="ri-checkbox-blank-circle-fill `+online+`"></i></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">`+val.name+`</h6>
                                            <span style="text-transform: capitalize;">`+val.type+`</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                  `;
          });

          user_list_html+=`</ul>`;
      }
      $('.all_chat_box').html(user_list_html);
    }

    function existing_msgs(){
      if(ajax_run_check==true){
        $.ajax({
            url:"{{ route('superadmin.existing.msgs') }}",
            method:"POST",
            data:{
              '_token' : "{{csrf_token()}}",
              "id": chat_id,
              "lm_id":lm_id,
              "lf_load":lf_load
            },
            beforeSend:function(){
              ajax_run_check=false;
            },
            success:function(data){
                console.log(data);
                lm_id=data.lm_id;
                del_arr=data.del_msg;
                lf_load=data.lf_load;
                if(del_arr.length>0){
                  $.each(del_arr,function(i,v){
                    $('.chatnumber'+v).remove();
                  })
                }
                if(data.lsm_id!=0){
                  lsm_id=data.lsm_id;
                }
                existing_msg=data.msgs;
                ajax_run_check=true;
                print_msgs(existing_msg);
            }
        });
      }
    }

    function scroll_msgs(){
      if(lsm_id==0) return false;
      // console.log(lsm_id);
      $.ajax({
          url:"{{ route('superadmin.scroll.msgs') }}",
          method:"POST",
          data:{
            '_token' : "{{csrf_token()}}",
            "id": chat_id,
            "lsm_id":lsm_id
          },
          success:function(data){
              // console.log(data);
              lsm_id=data.lsm_id;
              scroll_msg=data.msgs;
              print_scroll_msgs(scroll_msg);
          }
      });
    }

    function print_msgs(arr){

      
      html=`<div id="sidebar-toggle" class="sidebar-toggle">
                <i class="ri-menu-3-line"></i>
            </div>
            <div class="avatar chat-user-profile m-0 mr-3">`;
      if(profile_photo=="empty"){
        html+=`<div class="user-img  `+profile_color+`">`+fl+`</div>`;
      }
      else{
        html+=`<img src="`+profile_photo+`" alt="chatuserimage" class="user-img avatar-50 rounded">`;
      }

      html+=`
                <span class="avatar-status"><i
                class="ri-checkbox-blank-circle-fill `+online_status+`"></i></span>
            </div>
            <h5 class="mb-0 user_name">`+user_name+`</h5>`;
      $('.top_user_box').html(html);
      
      if(arr.length==0){
        setTimeout(function(){
          existing_msgs();
        },5000);
        return false;
      }
    

      html='<div class="scroll_div"></div>';
      $.each(arr, function(index, val) {
        if(val.from_check=="sent"){
          from_class="";
          color="bg-dark";
        }
        else{
          from_class=" chat-left";
          color="bg-primary";
        }


        if(val.attach!=null){
          url="{{route('superadmin.chat.download.file',':id')}}";
          url=url.replace(':id',val.attach);
        }


        html+=`<div class="chat `+from_class+` chatnumber`+val.msg_id+`">
                <div class="chat-user">
                    `;
        if(val.profile==''){
          html+=`<div class="user-img `+val.color+`">`+fl+`</div>`;
        }
        else{
          profile="{{asset('/')}}"+val.profile;
          html+=`<img src="`+profile+`" alt="chatuserimage" class="user-img avatar-50 rounded">`;
        }


        html+=`
                    
                    <span class="chat-time mt-1">`+val.msg_time+`</span>
                </div>
                <div class="chat-detail">
                    <div class="chat-message text-left">`;

        if(val.attach!=null){
          if(val.type=="image"){
            if(val.msg != null && val.msg!=''){
                html+=`<p>`;
                html+=val.msg;
                html+=`</p><hr>`;
            }

            image_path="{{asset('assets/chat_files')}}/"+val.attach;
            html+=`
                <p><a href="`+image_path+`" data-lightbox="image-1"><img src="`+image_path+`" class="img-fluid" alt=""></a>
                </p>
                <a href="`+url+`" class="download-img"><i class="ri-download-2-line mr-2"></i><span
                                                                class="align-middle">Download</span></a>
            `;

          }
          else{

            if(val.msg != null && val.msg!=''){
                html+=`<p>`;
                html+=val.msg;
                html+=`</p><hr>`;
            }
            html+=`<a href="`+url+`" class="download-file">
                        <i class="ri-link-m mr-2 filename"></i><span class="filename">`+val.short_name+`</span>
                        <div class="mt-2 text-uppercase">`+val.ext+` File</div>
                    </a>
                   </p>
                   <a href="`+url+`" class="download-img"><i class="ri-download-2-line mr-2"></i><span class="align-middle">Download</span></a>
                   `;
          }
        }
        else if(val.hyperlink!=null){
          if(val.msg != null && val.msg!=''){
            html+=`<p>`;
            html+=val.msg;
            html+=`</p><hr>`;
          }

          if(val.c_profile==""){
            if(val.c_color==""){
              c_color=val.c_color;
            }
            else{
              c_color=color;
            }
            html+=`<div class="user-img `+c_color+` userimg">`+val.fl+`</div>`;
          }
          else{
            html+=`<p><img src="`+val.c_profile+`" alt="chatuserimage" class="user-img avatar-50 rounded userimg"></p>`;
          }

          html+=`
                  <p class="text-center font-weight-bold">`+val.c_name+`</p>
                  <hr class="my-2">
                  <a href="`+val.hyperlink+`" class="download-img p-0" target="_blank"><span
                      class="align-middle">View Profile</span></a>
          `;
        }
        else{
          html+=``+val.msg+``;
        }

        html+=`</div>
                <span class="dropdown chat-delete">
                    <i class="ri-more-2-line cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer pr-0" id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></i>
                    <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton02" style="">
                        <a class="dropdown-item delete_msg" href="JavaScript:void(0);" id="`+val.msg_id+`"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete chat</a>
                    </span>
                </span>
                </div>
            </div>`;
      });
      $('.chat-content').append(html);

      if(scrolled==true){
          var d = $('.chat-content');
          d.scrollTop(d.prop("scrollHeight")+10);
      }

      setTimeout(function(){
        existing_msgs();
      },2000);
    }

    function print_scroll_msgs(arr){
      
      html=`<div id="sidebar-toggle" class="sidebar-toggle">
                <i class="ri-menu-3-line"></i>
            </div>
            <div class="avatar chat-user-profile m-0 mr-3">`;
      if(profile_photo=="empty"){
        html+=`<div class="user-img  `+profile_color+`">`+fl+`</div>`;
      }
      else{
        html+=`<img src="`+profile_photo+`" alt="chatuserimage" class="user-img avatar-50 rounded">`;
      }

      html+=`
                <span class="avatar-status"><i
                class="ri-checkbox-blank-circle-fill `+online_status+`"></i></span>
            </div>
            <h5 class="mb-0 user_name">`+user_name+`</h5>`;
      $('.top_user_box').html(html);

      html='<div class="scroll_div"></div>';
      $.each(arr, function(index, val) {
        if(val.from_check=="sent"){
          from_class="";
          color="bg-dark";
        }
        else{
          from_class=" chat-left";
          color="bg-primary";
        }


        if(val.attach!=null){
          url="{{route('superadmin.chat.download.file',':id')}}";
          url=url.replace(':id',val.attach);
        }


        html+=`<div class="chat `+from_class+` chatnumber`+val.msg_id+`">
                <div class="chat-user">
                    `;
        if(val.profile==''){
          html+=`<div class="user-img `+val.color+`">`+fl+`</div>`;
        }
        else{
          profile="{{asset('/')}}"+val.profile;
          html+=`<img src="`+profile+`" alt="chatuserimage" class="user-img avatar-50 rounded">`;
        }


        html+=`
                    <span class="chat-time mt-1">`+val.msg_time+`</span>
                </div>
                <div class="chat-detail">
                    <div class="chat-message text-left">`;

        if(val.attach!=null){
          if(val.type=="image"){
            if(val.msg != null && val.msg!=''){
                html+=`<p>`;
                html+=val.msg;
                html+=`</p><hr>`;
            }

            image_path="{{asset('assets/chat_files')}}/"+val.attach;
            html+=`
                <p><a href="`+image_path+`" data-lightbox="image-1"><img src="`+image_path+`" class="img-fluid" alt=""></a>
                </p>
                <a href="`+url+`" class="download-img"><i class="ri-download-2-line mr-2"></i><span
                                                                class="align-middle">Download</span></a>
            `;
          }
          else{

            if(val.msg != null && val.msg!=''){
                html+=`<p>`;
                html+=val.msg;
                html+=`</p><hr>`;
            }
            html+=`<a href="`+url+`" class="download-file">
                        <i class="ri-link-m mr-2 filename"></i><span class="filename">`+val.short_name+`</span>
                        <div class="mt-2 text-uppercase">`+val.ext+` File</div>
                    </a>
                   </p>
                   <a href="`+url+`" class="download-img"><i class="ri-download-2-line mr-2"></i><span class="align-middle">Download</span></a>
                   `;
          }
        }
        else if(val.hyperlink!=null){
          if(val.msg != null && val.msg!=''){
            html+=`<p>`;
            html+=val.msg;
            html+=`</p><hr>`;
          }

          if(val.c_profile==""){
            if(val.c_color==""){
              c_color=val.c_color;
            }
            else{
              c_color=color;
            }
            html+=`<div class="user-img `+c_color+` userimg">`+val.fl+`</div>`;
          }
          else{
            html+=`<p><img src="`+val.c_profile+`" alt="chatuserimage" class="user-img avatar-50 rounded userimg"></p>`;
          }

          html+=`
                  <p class="text-center font-weight-bold">`+val.c_name+`</p>
                  <hr class="my-2">
                  <a href="`+val.hyperlink+`" class="download-img p-0" target="_blank"><span
                      class="align-middle">View Profile</span></a>
          `;
        }
        else{
          html+=``+val.msg+``;
        }

        html+=`</div>
                  <span class="dropdown chat-delete">
                      <i class="ri-more-2-line cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer pr-0" id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></i>
                      <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton02" style="">
                          <a class="dropdown-item delete_msg" href="JavaScript:void(0);" id="`+val.msg_id+`"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete chat</a>
                      </span>
                  </span>
                </div>
            </div>`;
      });
      $('.chat-content').prepend(html);
      sel=$('.scroll_div').eq(1);
      $('.chat-content').animate({scrollTop:sel.offset().top-480},0);
    }

    function send_msg(formData){
      if(ajax_msg_check==true){
        $.ajax({
            type:"POST",
            url:"{{ route('superadmin.send.msg') }}",
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
              ajax_msg_check=false;
            },
            success:function(data){
              //console.log(data);
              if(data.status=="success"){
                chat_id=data.chat_id;
                scrolled=true;
                $('.emojionearea-editor').html('');
                $('.preview-chat').hide();
                $('#attached_file').val(null);
                $('#hyper_link').val(null);
                $('#fileName').val("empty");
                ajax_msg_check=true;
                existing_msgs();
                existing_chats();
              }
            }
        });
      }
    }
    
    function update_read_status(){
    	$.ajax({
          url:"{{ route('superadmin.update.read.status') }}",
          method:"POST",
          data:{'_token' : "{{csrf_token()}}", "id": chat_id},
          success:function(data){
          	if(data=="success"){

            }
          }
      });
    }

    function delete_chat(){

      // console.log(chat_id);
    	$.ajax({
          url:"{{ route('superadmin.delete.chat') }}",
          method:"POST",
          data:{
            '_token' : "{{csrf_token()}}",
            "id": chat_id
          },
          success:function(data){
          	// console.log(data);
            $('#default-block').tab("show");
            $('#chatbox').removeClass('active');
            $('.delete_btn').prop('disabled',false);
          	chat_id=0;
            lc_time='';
          	existing_chats();
            fetch_all_contacts();
          }
      });
    }

    function find_all(arr,look) {
      result = [];
      look=look.toLowerCase();
      look=new RegExp(look);
      for (var i in arr) {
          user_n=arr[i]["name"].toLowerCase();
          user_t=arr[i]["type"].toLowerCase();
          if (user_n.match(look) || user_t.match(look)) {
              result.push(arr[i]);
          }
      }
      return result;
    }

    function find_patient(arr,look) {
      result = [];
      look=look.toLowerCase();
      look=new RegExp(look);
      for (var i in arr) {
          user_name=arr[i]["name"].toLowerCase();
          if (user_name.match(look)) {
              result.push(arr[i]);
          }
      }
      return result;
    }

    function send_patient(id,client_name,client_photo,client_color){
      $('#hyper_link').val(id);
      first_letter=client_name.substring(0,1).toUpperCase();
      if(client_photo=="empty"){
        html=`<div class="user-img2 d-block mx-auto `+client_color+`">`+first_letter+`</div>`;
      }
      else{
        html=`<img src="`+client_photo+`" class="img-fluid rounded-circle d-block mx-auto user_file_image">`;
      }

      $('.user_file_image_cont').html(html);
      $('.user_file_name').html(client_name);

      $('.preview-chat').show();
      $('.img_preview').hide();
      $('.file_preview').hide();
      $('.user_preview').show();
    }

    function replace_string(str){
      str=str.replaceAll(/\s/g,'');
      str=str.replaceAll('<br>','');
      str=str.replaceAll('<div>','');
      str=str.replaceAll('</div>','');

      return str;
    }

    function delete_msg(id){
      if(ajax_delete_check==true){
        $.ajax({
          url:"{{route('superadmin.chat.delete.msg')}}",
          method:"POST",
          data:{
            "_token":"{{csrf_token()}}",
            "msg_id":id
          },
          beforeSend:function(){
            ajax_delete_check=false;
          },
          success:function(data){
            if(data=="success"){
              ajax_delete_check=true;
            }
          }
        });
      }
    }

    existing_chats();
    fetch_all_contacts();
    fetch_all_patients();


    $('.search_new_user').keyup(function(){
        to_look=$(this).val();
        if(to_look!=''){
            all_array=find_all(all_contacts,to_look);
            print_list_new(all_array);
        }
        else{
            print_list_new(all_contacts);
        }
    });

    $('.search_patient').keyup(function(){
        to_look=$(this).val();
        if(to_look!=''){
            patient_array=find_patient(all_patients,to_look);
            print_patients(patient_array);
        }
        else{
            print_patients(all_patients);
        }
    });


    $('.search_side_user').keyup(function(){
        to_look=$(this).val();
        if(to_look!=''){
            searched_array=find_all(all_contacts,to_look);
            $('.all_chat_box').html('');
            $('.recent_box').html('');
            print_side_search(searched_array);
        }
        else{
          console.log(existing_chat);
            print_side(existing_chat);
            print_list(all_contacts);
        }
    });


    $(document).on('click','#admin_filter',function(){
      to_look='Admin';
      searched_array=find_all(all_contacts,to_look);
      print_list(searched_array);
    })

    $(document).on('click','#staff_filter',function(){
      to_look='Provider';
      searched_array=find_all(all_contacts,to_look);
      print_list(searched_array);
    })

    $(document).on('click','#client_filter',function(){
      to_look='Patient';
      searched_array=find_all(all_contacts,to_look);
      print_list(searched_array);
    })

    $(document).on('click','#all_filter',function(){
      print_list(all_contacts);
    })


    $(document).on('click','.side_link',function(){


    	$('#default-block').removeClass('active');
    	$('#chatbox').removeClass('fade').addClass('active');
    	chat_id=$(this).attr("id");
    	user_name=$(this).attr("user_name");
      online_status=$(this).attr("online_status");
      profile_color=$(this).attr("profile_color");
      profile_photo=$(this).attr("profile_photo");
    	fl=$(this).attr("fl");
      let url = "{{ route('superadmin.chat.history', ':id') }}";
      if(chat_id==0){

        to_send_id=$(this).attr("to_id");
        to_send_type=$(this).attr("to_type");
        url = url.replace(':id', to_send_id+'-'+to_send_type);
      }
      else{
        url = url.replace(':id', chat_id);
      }

      $('#attach_link').attr('href',url);

      if(chat_id!=0){
        if(chat_id!=temp_chat_id){
          $('.chat-content , .top_user_box').html('');
          temp_chat_id=chat_id;
          lm_id=0;
        }
      }
      else{
    	    $('.chat-content , .top_user_box').html('');
      }
    	existing_msgs();
      if(chat_id!=0){
    	 update_read_status();
      }
    });

    $(document).on('click','.patient_link',function(){

      client_name=$(this).attr("client_name");
      client_photo=$(this).attr("client_photo");
      client_color=$(this).attr("client_color");
      client_id=$(this).attr("client_id");
      send_patient(client_id,client_name,client_photo,client_color);
    });

    $(document).on('keydown','.msg_area',function(e){
      if(e.keyCode==13 && !e.altKey){
        e.preventDefault();
      }
    });

    $(".message").emojioneArea({
        pickerPosition: "top",
        tonesStyle: "bullet",
        saveEmojisAs:"unicode",
        autocompleteTones: false,
        autoComplete:false,
        events: {
          // Enter key as submit button --> working
          keyup: function (editor, event) {
            if(event.which==13 && event.altKey){
              editor.css('white-space','pre');
              document.execCommand('InsertHTML', true, '<br>');
            }
            else if (event.which == 13 && !event.altKey) {
              $('.send_btn').click();
              editor.focus();
            }
          }
        }
    });

    $(document).on('click','.send_new_btn',function(){
        to_send_id=$(this).closest('.user_div').find('.to_send_id').val();
        to_send_type=$(this).closest('.user_div').find('.to_send_type').val();
        chat_id=$(this).attr("chat-id");
    });

    $(document).on('submit','#upload_new_form',function(e){
      e.preventDefault();
      msg=$('.new_message .emojionearea-editor').html();
      noWhitespace = replace_string(msg);
      if(noWhitespace.length>0){
        $('#msg_new').val(msg);
        $('#chat_id_new').val(chat_id);
        $('#to_id_new').val(to_send_id);
        $('#to_type_new').val(to_send_type);
        var formData = new FormData(this);
        send_msg(formData);
        $('#message_modal').modal('hide');
        $('#start_chat_modal').modal('hide');
      }
    });

    $(document).on('submit','#upload_form',function(e){
      e.preventDefault();
    	msg=$('.message .emojionearea-editor').html();
      $('#msg').val(msg);
      $('#chat_id').val(chat_id);
      $('#to_id').val(to_send_id);
      $('#to_type').val(to_send_type);
      var formData = new FormData(this);
      if(formData.get('attached_file').name=='' && formData.get('hyper_link')==''){
        noWhitespace = replace_string(msg);
        if(noWhitespace.length>0){
          send_msg(formData);
        }
      }
      else{
        send_msg(formData);
      }
    });

    $(document).on('click','.delete_btn',function(){
    	delete_chat();
      $('.delete_btn').prop('disabled',true);
    });	

    $('.start_chat_btn').click(function(){
      print_list_new(all_contacts);
      $('.search_new_user').focus();
    });


    setInterval(function(){
        existing_chats();
        if(chat_id!=0){
          update_read_status();
        }
    }, 8000);

    $('#upload').click(function(){
      $('#attached_file').click();
    });

    $('#upload_new').click(function(){
      $('#attached_file_new').click();
    });

    $('#attached_file').change(function(e){
      var file_name = e.target.files[0].name;
      var file_size = e.target.files[0].size;
      var ext=file_name.split('.').pop();
      file_name = file_name.split('.').shift();
      if(ext=="jpg" || ext=="png" || ext=="jpeg" || ext=="gif"){
            var file = $("#attached_file").get(0).files[0];
            $('.preview-chat').show();
            $('.img_preview').show();
            $('.file_preview').hide();
            $('.user_preview').hide();
            var reader = new FileReader();
            reader.onload = function(){
                $(".img_preview_image").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
      }
      else{
          ext_name=ext.toUpperCase();
          fileName=file_name.substring(0, 12)+'.'+ext;
          $('.file_heading').text(fileName);
          $('.file_type').text(ext_name+' FILE');
          $('.preview-chat').show();
          $('.img_preview').hide();
          $('.file_preview').show();
          $('.user_preview').hide();
      }

      if(file_size>10485760){
        $('.progress .progress-bar').css("width",'100%');
        $('.progress .progress-bar').html('0%');
        $('.progress-bar').removeClass('bg-primary').addClass('bg-danger');
        $('.warning_msg').show();
        $('.send_btn').prop('disabled',true);
        return false;
      }
      else{
          $('.progress .progress-bar').css("width",'0%');
          $('.warning_msg').hide();
          $('.progress-bar').removeClass('bg-danger').addClass('bg-primary');
      }

      var fd = new FormData();    
      fd.append( 'file', $("#attached_file").get(0).files[0]);
      uploadAjax=$.ajax({
        headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
        xhr: function() {
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", function(evt) {
            $('.send_btn').prop('disabled',true);
            if (evt.lengthComputable) {
              var percentComplete = evt.loaded / evt.total;
              percentComplete = parseInt(percentComplete * 100);
              // console.log(percentComplete);
              $('.progress .progress-bar').css("width", percentComplete+'%', function() {
                return $(this).attr("aria-valuenow", percentComplete) + "%";
              })

              $('.progress .progress-bar').html(percentComplete+'%');

              if (percentComplete === 100) {
              }

            }
          }, false);

          return xhr;
        },
        url: "{{route('superadmin.chat.upload.file')}}",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        success: function(data) {
          // console.log(data);
          $('#fileName').val(data);
          $('#attached_file').val(null);
          $('.send_btn').prop("disabled",false);
        }
      });
    });

    $(document).on('click','#close_preview',function(){
      
      $('.preview-chat').hide();
      $('.img_preview').hide();
      $('.file_preview').hide();
      $('.user_preview').hide();
      $('#attached_file').val(null);
      $('#fileName').val("empty");
      $('#hyper_link').val('');
      $('.send_btn').prop('disabled',false);
      if(uploadAjax!=null){
        uploadAjax.abort();
      }
    });

    $(document).on('click','.delete_msg',function(){
      del_msg_id=$(this).attr("id");
      $('.chatnumber'+del_msg_id).remove();
      delete_msg(del_msg_id);
    })

    $('.chat-content').on('scroll', function(){

        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            scrolled=true;
        }
        else{
            scrolled=false;
        }

        if($(this).scrollTop()==0){
          scroll_msgs();
        }
    });
	});


</script>


@endsection