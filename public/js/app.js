var _token = jQuery('meta[name="csrf-token"]').prop('content');

jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

	var hash = window.location.hash;

	if (hash == '#registration') {
		swal({
			title: "Спасибо за регистрацию",
			text: 'На ваш почтовый адрес отправлено письмо с кодом подтверждения.',
			type: 'success',
			showCancelButton: false,
			confirmButtonColor: "#414A52",
			confirmButtonText: 'Ок',
			confirmButtonClass: 'btn registration-btn',
		  //closeOnConfirm: true
		})
	} else if (hash == '#activasion') {
		swal({
			title: "Ваша почта подтверждена",
			text: 'Вы можете проголосовать за любого конкурсанта.',
			type: 'success',
			showCancelButton: false,
			confirmButtonColor: "#414A52",
			confirmButtonText: 'Ок',
			confirmButtonClass: 'btn registration-btn',
		  //closeOnConfirm: true
		})
	}

	var counterZero = '0';
    $('.stats-number').text(counterZero);

    $('.stats-number').waypoint(function() {
        $('.stats-number').each(function() {
            var $this = $(this);
            $({
                Counter: 0
            }).animate({
                Counter: $this.attr('data-stop')
            }, {
                duration: 1000,
                easing: 'swing',
                step: function(now) {
                    $this.text(Math.ceil(now));
                }
            });
        });
        this.destroy();
    }, {
        offset: '50%'
    });

    getTimeRemaining();
    var timeinterval = setInterval(getTimeRemaining,1000);

    $('body').on('click','.registration',function(){
    	$('#registration-modal').modal('show');
    })

     $('body').on('click','.voite',function(){
     	var id = $(this).data('id'),
     		name = $(this).data('name');
    	swal({
		  title: 'Вы хотите оставить голос?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#414A52',
		  cancelButtonColor: '#fff',
		  confirmButtonText: 'Да, Оставить голос',
		  cancelButtonText: 'Нет',
		  confirmButtonClass: 'btn registration-btn',
		  cancelButtonClass: 'btn cancel-btn',
		  buttonsStyling: false
		}).then(function () {
			jQuery.ajax({
	            type: "post",
	            url: '/set_voice',
	            data: {id: id},
	            success: function (data) {
	                if (data['response'] == 200) {
	                   swal({
						  title: "Спасибо вам за голос",
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: "#414A52",
						  confirmButtonText: 'Ок',
						  confirmButtonClass: 'btn registration-btn',
						  //closeOnConfirm: true
						}).then( function () {
						  location.reload();
						});
	                } else {
	                    swal({
						  title: "Внимание",
						  text: data['text'],
						  type: 'error',
						  showCancelButton: false,
						  confirmButtonColor: "#414A52",
						  confirmButtonText: 'Ок',
						  confirmButtonClass: 'btn registration-btn',
						  //closeOnConfirm: true
						}).then( function () {
						  location.reload();
						});
	                }
	            }
	        });
		})
    })
}); 

function getTimeRemaining(){
	var startDate = new Date("dec,21,2017,11:11:00");
	var t = Date.parse(startDate) - Date.parse(new Date());
	var seconds = Math.floor( (t/1000) % 60 );
	var minutes = Math.floor( (t/1000/60) % 60 );
	var hours = Math.floor( (t/(1000*60*60)) % 24 );
	var days = Math.floor( t/(1000*60*60*24) );

	jQuery('#clock-number #day').text(days);
	jQuery('#clock-number #hour').text(hours);
	jQuery('#clock-number #minute').text(minutes);
}
