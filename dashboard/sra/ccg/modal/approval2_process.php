<div class="modal fade" id="approve2-transaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                            <h6 class="page-title text-dark font-weight-medium">Recommended By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="recommended_2"></h5>
                            <h5 class="page-date" id="recommendeddate_2"></h5>
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

                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Approved for Encoding</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="approvedforencd_2"></h5>
                            <h5 class="page-date" id="approvedforencodedate_2"></h5>
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
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary mx-1" data-dismiss="modal">Close</button>
                <button type="submit" id="update-btn" class="btn btn-info approve_A">Approve</button>

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
        $(document).on('click', '.approve_T', function() {
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: '/coco-starterkit/init/controllers/transaction_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#transaction_id_2').text(response.transaction_id);
                    $('#class_code_2').text(response.class_code);
                    $('#subject_2').text(response.subject);
                    $('#semester_2').text(response.semester);
                    $('#school_year_2').text(response.school_year);
                    $('#submitted_2').text(response.submittedBy);
                    $('#submitteddate_2').text(response.submitted_date);
                    $('#recommended_2').text(response.recoBy);
                    $('#recommendeddate_2').text(response.recommended_date);
                    $('#verified_2').text(response.verifiedBy);
                    $('#verifieddate_2').text(response.verified_date);
                    $('#approved-2').text(response.approvedBy);
                    $('#approveddate_2').text(response.approved_date);
                    $('#approvedforencd_2').text(response.approvedforencodingBy);
                    $('#approvedforencodedate_2').text(response.approvedenc_date);
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
            url: '/coco-starterkit/init/controllers/sra/ccg/approve2_transaction.php',
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