<div class="modal fade" id="deny-transaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
            <h4 class="modal-heading-custom">Faculty Report on <br>Completion Grades Within the Semester</h4>   
                <h5 class="modal-title-custom">Transaction Details</h5>
                <div id="smessage"></div>
            </div>
            <div class="modal-body">
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="page-title text-dark font-weight-medium">Transaction ID</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="transaction_id_3"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="page-title text-dark font-weight-medium">Class Code</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="class_code_3"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="page-title text-dark font-weight-medium">Subject</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="subject_3"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="page-title text-dark font-weight-medium">Semester</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="semester_3"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="page-title text-dark font-weight-medium">Term</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="ter_3"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="page-title text-dark font-weight-medium">School Year</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="school_year_3"></h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <h6 class="page-title text-dark font-weight-medium">Submitted By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="submitted_3"></h5>
                            <h5 class="page-date" id="submitteddate_3"></h5>

                        </div>
                    </div>
                    
                    <form class="mt-3">
                        <div class="form-group">
                        <h6 class="page-title text-dark font-weight-medium">Remarks</h6>
                            <textarea class="form-control" id="remarks" rows="3" placeholder=""></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary mx-1" data-dismiss="modal">Close</button>
                <button type="submit" id="update-btn" class="btn btn-info decline">Reject</button>

            </div>
        </div>
    </div>
</div>
<script src="/coco-starterkit/vendor/jquery/dist/jquery.min.js"></script>
<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<script>
$(document).ready(function() {
    load_data();
    var count = 0;

    function load_data() {
        $(document).on('click', '.deny_T', function() {
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: '/coco-starterkit/init/controllers/transaction_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#transaction_id_3').text(response.transaction_id);
                    $('#class_code_3').text(response.class_code);
                    $('#subject_3').text(response.subject);
                    $('#semester_3').text(response.semester);
                    $('#ter_3').text(response.ter);
                    $('#school_year_3').text(response.school_year);
                    $('#submitted_3').text(response.submittedBy);
                    $('#submitteddate_3').text(response.submitted_date);

                }
            });
        })
    }

});
</script>


<!-- UPDATE FORM -->
<script>
$(document).on('click', '.decline', function(e) {
    e.preventDefault();
    var a = $('#transaction_id_3').text();
    var b = $('#remarks').val();

    if (a === '', b === '') { // VERIFY DATA
        $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
    } else {
        $.ajax({
            type: 'POST',
            url: '/coco-starterkit/init/controllers/sra/cog/decline_transaction.php',
            data: {
                transaction_id: a,
                remarks: b
            },
            success: function(response) {
                $('#deny-transaction').modal('hide');
                $("#smessage").html(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Rejected',
                    text: 'Record has been rejected.',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            error: function(response) {
                console.log("Failed");
            }
        });
    }
});
</script>