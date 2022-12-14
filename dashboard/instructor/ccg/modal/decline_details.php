<div class="modal fade " id="decline-details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
            <h4 class="modal-heading-custom">Faculty Report on Change/Correction of Grades</h4>   
                <h5 class="modal-title-custom">Transaction Details</h5>

            </div>
            <div class="modal-body">
                <div id="smessage"></div>
                <div class="container mt-2 mb-3">
                    <div class="row modal-content-center">
                        <div class="col-sm-12 col-md-12 ">
                            <div class="row mb-2">
                                <div class="col-12 ">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Transaction
                                                ID</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="transaction_id_2"></h5>
                                            </h5>
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
                                    <div class="row">
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
                                            <h6 class="page-title text-dark font-weight-medium">Rejected By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="rejected_2"></h5>
                                            <h5 class="page-date" id="rejecteddate_2"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="tl-hr">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 class="page-title text-dark font-weight-medium">Remarks</h5>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="page-title text-dark" id="remarks"></h5>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info mx-1" data-dismiss="modal">Close</button>
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
        $(document).on('click', '.decline_D', function() {
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
                    $('#rejected_2').text(response.rejectedBy);
                    $('#rejecteddate_2').text(response.rejected_date);
                    $('#remarks').text(response.remarks);
                }
            });
        })
    }

});
</script>