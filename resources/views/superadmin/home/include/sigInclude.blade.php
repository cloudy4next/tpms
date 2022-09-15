
@section('js')
<script>

	function fetch_providers(){
		$('.loading2').show();
	    $.ajax({
	        type: "POST",
	        url: "{{ route('superadmin.signature.get.all.payor') }}",
	        data: {
	            '_token': "{{ csrf_token() }}"
	        },
	        success: function (data) {
	            // console.log(data)
	            $('#sig_provider_id').empty();
	            data.forEach((prv) => {
	                $('#sig_provider_id').append(
	                    `<option value="${prv.id}">${prv.full_name}</option>`
	                )
	            });
	            $("#sig_provider_id").multiselect('rebuild');
	            $('.loading2').hide();
	        }
	    });
	}


	function fetch_data(provider_id,date_range){
		$('.loading2').show();
	    $.ajax({
	        type: "POST",
	        url: "{{ route('superadmin.signature.fetch.data') }}",
	        data: {
	            '_token': "{{ csrf_token() }}",
	            'provider_id':provider_id,
	            'date_range':date_range,
	        },
	        success: function (data) {
	            // console.log(data);
	            $('#table_box').html(data.view);
                $('.c_table').tablesorter();
	            $('.loading2').hide();
	        }
	    });
	}

	$(document).ready(function(){
		fetch_providers();


		$(document).on('click','#get_data_btn',function(){
			var date_range=$('#sig_date_range').val();
			var provider_id=$('#sig_provider_id').val();
			if(provider_id=='' || provider_id==null){
				toastr["error"]("Please select staff.","ALERT!");
			}
			else if(date_range=='' || date_range==null){
				toastr["error"]("Please select date range.","ALERT!");
			}
			else{
				fetch_data(provider_id,date_range);
			}
		})


	})



	var timeStamp= moment().format('MMDYYYYhmmss');
        var file_name="SignatureNotUpload_";
        file_name=file_name+timeStamp;
        $('#download_csv').click(function(){
            $('#export_table').tableExport({
                type:'csv',
                fileName:file_name
            });
        });

        // $('#download_pdf').click(function(){
        //     $('#export_table').tableExport({
        //         type:'pdf',
        //         fileName:file_name,
        //         jspdf: {
        //             orientation: "P",
        //             autotable: {
        //                 headerStyles: {
        //                     fillColor: [32,122,199],
        //                     textColor: 255,
        //                     fontStyle: 'bold',
        //                     halign: 'inherit',
        //                     valign: 'middle',
        //                 },
        //                 styles: {
        //                 	rowHeight: 30
        //                 }
        //             }

        //         }
        //     });
        // });

</script>

<script src="{{ asset('assets/dashboard/') }}/vendor/jspdf/jspdf.min.js"></script>
<script src="{{ asset('assets/dashboard/') }}/vendor/jspdf/jspdf.autotable.min.js"></script>
<script>
  window.jsPDF = window.jspdf.jsPDF;
  var doc = new jsPDF()

  $(document).on('click','#download_pdf',function(){
		$('.loading2').show();
	  	generate();
  });

function generate() {
      var doc = new jsPDF('l', 'mm', [297, 210]);

  doc.autoTable({
    html: '#export_table',
    // includeHiddenHtml:true,
    theme:"grid",
    headStyles:{
    	fillColor:'#089BAB',
    	lineColor:'#089BAB',
    },
    orientation:"L",
    bodyStyles: {minCellHeight: 13},
    didDrawCell: function(data) {
      if (data.section === 'body' && data.column.index === 5) {
         var td = data.cell.raw;
         var img = td.getElementsByTagName('img')[0];
         if(img){
         	// console.log(img.src);
         	// var base64Img='data:image/png;base64,'+img.src;
         	// console.log(base64Img)
	         // var dim = data.cell.height - data.cell.padding('vertical');
	         // var textPos = data.cell.textPos;
	         doc.addImage(img.src, 'PNG', data.cell.x + 2, data.cell.y + 2, 20,10)
         }
      }
      if (data.section === 'body' && data.column.index === 6) {
         var td = data.cell.raw;
         var img = td.getElementsByTagName('img')[0];
         if(img){
         	// console.log(img.src);
         	// var base64Img='data:image/png;base64,'+img.src;
         	// console.log(base64Img)
	         // var dim = data.cell.height - data.cell.padding('vertical');
	         // var textPos = data.cell.textPos;
	         doc.addImage(img.src, 'PNG', data.cell.x + 2, data.cell.y + 2, 20,10)
         }
      }
    }
  });

	$('.loading2').hide();
	var timeStamp= moment().format('MMDYYYYhmmss');
        var file_name="SignatureNotUpload_";
        file_name=file_name+timeStamp;
      doc.save(file_name+'.pdf');
    }




</script>



@endsection