<div class="modal fade" id="approve-transaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
            <h4 class="modal-heading-custom">Faculty Report on Change/Correction of Grades</h4>   
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
                            <h5 class="page-title text-dark" id="transaction_id"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Class Code</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="class_code"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Subject</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="subject"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Semester</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="semester"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">School Year</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="school_year"></h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Submitted By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="submitted"></h5>
                            <h5 class="page-date" id="submitteddate"></h5>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Recommended By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="recommended"></h5>
                            <h5 class="page-date" id="recommendeddate"></h5>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Approved By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="approved"></h5>
                            <h5 class="page-date" id="approveddate"></h5>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Approved for Encoding</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="approvedforencd"></h5>
                            <h5 class="page-date" id="approvedforencodedate"></h5>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <input type=hidden name="tid" id="tid">
                <button class="btn btn-outline-secondary mx-1" data-dismiss="modal">Close</button>
                <button type="submit" id="update-btn" class="btn btn-info approve">Approve</button>

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
                    $('#transaction_id').text(response.transaction_id);
                    $('#class_code').text(response.class_code);
                    $('#subject').text(response.subject);
                    $('#semester').text(response.semester);
                    $('#school_year').text(response.school_year);
                    $('#submitted').text(response.submittedBy);
                    $('#submitteddate').text(response.submitted_date);
                    $('#recommended').text(response.recoBy);
                    $('#recommendeddate').text(response.recommended_date);
                    $('#approved').text(response.approvedBy);
                    $('#approveddate').text(response.approved_date);
                    $('#approvedforencd').text(response.approvedforencodingBy);
                    $('#approvedforencodedate').text(response.approvedenc_date);

                }
            });
        })
    }

});
</script>


<script>
$(document).on('click', '.approve', function(e) {
    e.preventDefault();
    var a = $('#transaction_id').text();
    if (a === '') { 
        $('#smessage').html('<div class="alert alert-danger"> Invalid Request</div>');
    } else {
        $.ajax({
            type: 'POST',
            url: '/coco/init/controllers/sra/ccg/approve_transaction.php',
            data: {
                transaction_id: a,
            },
            success: function(response) {
                $('#approve-transaction').modal('hide');
                $("#smessage").html(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Verified',
                    text: 'Record has been verified.',
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