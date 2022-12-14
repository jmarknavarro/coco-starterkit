<div class="modal fade " id="approve3-details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
            <h4 class="modal-heading-custom">Faculty Report on Change/Correction of Grades</h4>   
                <h5 class="modal-title-custom">Transaction Details</h5>

            </div>
            <div class="modal-body">
                <div id="smessage"></div>
                <div class="container mt-2">
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
                                            <h5 class="page-title text-dark" id="transaction_id_5"></h5>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Class Code</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="class_code_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Subject</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="subject_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Semester</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="semester_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">School Year</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="school_year_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Submitted By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="submittedby_5"></h5>
                                            <h5 class="page-date" id="submitteddate_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Recommended By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="recommended_5"></h5>
                                            <h5 class="page-date" id="recommendeddate_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Approved By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="approvedby_5"></h5>
                                            <h5 class="page-date" id="approveddate_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Approved for Encoding
                                            </h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="approvedforencd_5"></h5>
                                            <h5 class="page-date" id="approvedforencodedate_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Verified By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="verifiedby_5"></h5>
                                            <h5 class="page-date" id="verifieddate_5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Attested By</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="attestedby_5"></h5>
                                            <h5 class="page-date" id="attesteddate_5"></h5>
                                        </div>
                                    </div>
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
        $(document).on('click', '.approve_D', function() {
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: '/coco-starterkit/init/controllers/transaction_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#transaction_id_5').text(response.transaction_id);
                    $('#class_code_5').text(response.class_code);
                    $('#subject_5').text(response.subject);
                    $('#semester_5').text(response.semester);
                    $('#school_year_5').text(response.school_year);
                    $('#submittedby_5').text(response.submittedBy);
                    $('#submitteddate_5').text(response.submitted_date);
                    $('#recommended_5').text(response.recoBy);
                    $('#recommendeddate_5').text(response.recommended_date);
                    $('#verifiedby_5').text(response.verifiedBy);
                    $('#verifieddate_5').text(response.verified_date);
                    $('#approvedby_5').text(response.approvedBy);
                    $('#approveddate_5').text(response.approved_date);
                    $('#approvedforencd_5').text(response.approvedforencodingBy);
                    $('#approvedforencodedate_5').text(response.approvedenc_date);
                    $('#attestedby_5').text(response.attestedBy);
                    $('#attesteddate_5').text(response.attested_date);
                
                }
            });
        })
    }

});
</script>