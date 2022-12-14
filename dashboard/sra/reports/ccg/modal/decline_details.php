<div class="modal fade " id="decline-details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
            <h4 class="modal-heading-custom">Faculty Report on <br>Completion Grades Within the Semester</h4>   
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
                                            <h5 class="page-title text-dark" id="transaction_id_6"></h5>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Class Code</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="class_code_6"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Subject</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="subject_6"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Semester</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="semester_6"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Term</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="ter_6"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">School Year</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="school_year_6"></h5>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Submitted By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="submitted_6"></h5>
                                            <h5 class="page-date" id="submitteddate_6"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Rejected By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="rejected_6"></h5>
                                            <h5 class="page-date" id="rejecteddate_6"></h5>
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
                                    <h5 class="page-title text-dark" id="remarks1"></h5>
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
        $(document).on('click', '.decline_D', function() {
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: '/coco/init/controllers/transaction_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#transaction_id_6').text(response.transaction_id);
                    $('#class_code_6').text(response.class_code);
                    $('#subject_6').text(response.subject);
                    $('#semester_6').text(response.semester);
                    $('#ter_6').text(response.ter);
                    $('#school_year_6').text(response.school_year);
                    $('#submitted_6').text(response.submittedBy);
                    $('#rejected_6').text(response.rejectedBy);
                    $('#submitteddate_6').text(response.submitted_date);
                    $('#rejecteddate_6').text(response.rejected_date);
                    $('#remarks1').text(response.remarks);
                }
            });
        })
    }

});
</script>