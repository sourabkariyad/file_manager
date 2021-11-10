
$(document).on("keyup", '.search', function(e){
	keyword = $(this).val();
	$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
	$.ajax({
		type: "POST",
		url: '/search', 
		data: { name: keyword}
	}).done(function(response) {
			count = 0;
			if(response){
			$.each(response, function(index) {
				count = index+1;
            		table_data = '<tr>'+
	                                    '<td>'+count+'</td>'+
	                                    '<td>'+response[index].name+'</td>'+
	                                    '<td><a style="color:black" href="">delete</a></td>'+
	                                '</tr>';
        	});
			$("#table-body").html(table_data);
		}
	})
});