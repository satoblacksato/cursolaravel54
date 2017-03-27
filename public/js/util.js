$('.alert').delay(5000).slideUp(350);

$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
});


$(function(){
	$('.file').fileinput();
	$('#description').trumbowyg();
    
    $("a>button").on('click',function(e){
    	try{
    			var _this=$(this);
    			var _category=_this.data('category');
    			var errores="";



					swal({
					  title: "Esta seguro que desea realizar este proceso?",
					  text: "",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonClass: "btn-danger",
					  confirmButtonText: "SI",
					  cancelButtonText: "NO",
					  closeOnConfirm: false
					},
					function(){
					  $.ajax({
						  method: "POST",
						  url: "/suscription-category",
						  data: { category: _category }
						})
						  .done(function( msg ) {
								swal("Aceptaci\u00F3n!", msg.data, "success");
						  		if(msg.action=='add'){
						  			_this.html('suscribirse');
						  			_this.attr('class','btn btn-info btn-xs');
						  		}else{
									_this.html('quitar suscripci&oacute;n');
						  			_this.attr('class','btn btn-danger btn-xs');
						  		}
						  }).fail(function( objectError, textStatus ) {
						  		if( objectError.status === 422 ) {
								        errors = objectError.responseJSON;
								        $.each( errors, function( key, value ) {
								            errores += value[0]+"\n";
								        });

								        if(errores.trim()!=""){
								        		alert(errores);
								        }
								}else{
									alert("Error de procesamiento "+objectError.status+ "\n"+objectError.statusText);
								}


							});

					});


    			return false;
    	}catch(ex){
    		console.log(ex);
    	}
    });
	
});


