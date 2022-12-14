<div class="modal fade" id="approve2-transaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
            <h4 class="modal-heading-custom">Faculty Report on <br>Completion Grades Within the Semester</h4>   
                <h5 class="modal-title-custom">Transaction Details</h5>

            </div>
            <div class="modal-body">
                <div id="smessage"></div>
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Transaction ID</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="transaction_id_2"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Class Code</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="class_code_2"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Subject</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="subject_2"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Semester</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="semester_2"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Term</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="ter_2"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">School Year</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="school_year_2"></h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Submitted By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="submitted_2"></h5>
                            <h5 class="page-date" id="submitteddate_2"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Verified By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="verified_2"></h5>
                            <h5 class="page-date" id="verifieddate_2"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Approved By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="approved-2"></h5>
                            <h5 class="page-date" id="approveddate_2"></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary mx-1" data-dismiss="modal">Close</button>
                <button type="submit" id="update-btn" class="btn btn-info approve_A">Approve</button>

            </div>
        </div>
    </div>
</div>
<script src="/coco/vendor/jquery/dist/jquery.min.js"></script>
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
        $(document).on('click', '.approve_T', function() {
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: '/coco/init/controllers/transaction_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#transaction_id_2').text(response.transaction_id);
                    $('#class_code_2').text(response.class_code);
                    $('#subject_2').text(response.subject);
                    $('#semester_2').text(response.semester);
                    $('#ter_2').text(response.ter);
                    $('#school_year_2').text(response.school_year);
                    $('#submitted_2').text(response.submittedBy);
                    $('#verified_2').text(response.verifiedBy);
                    $('#approved-2').text(response.approvedBy);
                    $('#submitteddate_2').text(response.submitted_date);
                    $('#verifieddate_2').text(response.verified_date);
                    $('#approveddate_2').text(response.approved_date);

                }
            });
        })
    }

});
</script>

<script>
$(document).on('click', '.approve_A', function(e) {
    e.preventDefault();
    var a = $('#transaction_id_2').text();
    if (a === '') { // VERIFY DATA
        $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
    } else {
        console.log(a);
        $.ajax({
            type: 'POST',
            url: '/coco/init/controllers/sra/cog/approve2_transaction.php',
            data: {
                transaction_id: a,
            },
            success: function(response) {
                $('#approve2-transaction').modal('hide');
                $("#smessage").html(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Approved',
                    text: 'Record has been approved.',
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