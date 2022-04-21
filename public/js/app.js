// onClick button ajouter
$('#ajouter').off('click').on('click', function() {
    $.ajax({
        url: $(this).attr('data-url'),
        success: function(data) {
            if (data.status) {
                $('.modal-body').html(data.html);
                $('#exampleModal').modal('show');
                // action onClick bouton enregistrer
                $('#validate-form').off('click').on('click', function(ev) {
                    var url = $('#main-form').attr('action-url');
                    var datas = $('#main-form').serialize();

                    $.post(url, datas, function(res) {
                        if (res.status) {
                            swal('Success!', res.message, 'success');
                            $('#exampleModal').modal('hide');
                            refreshTable('#result-table');
                        } else {
                            swal('Erreur!', res.message, 'error');

                        }
                    });
                });
            } else {
                swal('Erreur!', data.message, 'error');

            }

        }
    });
});

// function Refresh Table
function refreshTable(tableId) {
    var refreshurl = $('#result-table').attr('data-url');
    $.post(refreshurl, function(res) {
        if (res.status) {
            $(tableId).find('tbody').empty();
            $(tableId).find('tbody').append(res.html);

        }
    });
}
// onClick Delete
$('.table tbody ').on('click', '#delete', function(e) {
    var url = $(this).attr('data-url');

    swal({
            title: "Est-vous sûr ?",
            text: "Voulez-vous continuer !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: 'green',
            confirmButtonText: 'Oui, confirmer !',
            cancelButtonText: "Non, annuler !",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(result) {
                        if (result.status) {
                            swal('Success!', result.message, 'success');
                            refreshTable('#result-table');
                        }
                    }
                });

            } else {
                swal("Annuler", "", "error");
            }
        });


});



// onClick button edit
$('.table tbody ').on('click', '#edit', function() {
    $.ajax({
        url: $(this).attr('data-url'),
        method: 'POST',
        success: function(res) {
            $('.modal-body').html(res.html);
            $('#exampleModal').modal('show');
            $('#validate-form').off('click').on('click', function(ev) {
                var url = $('#main-form').attr('action-url');
                var datas = $('#main-form').serialize();

                $.post(url, datas, function(res) {
                    if (res.status) {
                        swal('Success!', res.message, 'success');
                        $('#exampleModal').modal('hide');
                        refreshTable('#result-table');
                    } else {
                        swal('Erreur!', res.message, 'error');

                    }
                });
            });
        }
    });
});