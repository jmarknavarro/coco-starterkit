<div class="modal fade " id="approve-details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                    <div class="row ">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Transaction ID</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="transaction_id_4"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Class Code</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="class_code_4"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Subject</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="subject_4"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Semester</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="semester_4"></h5>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">School Year</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="school_year_4"></h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Submitted By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="submittedby_4"></h5>
                            <h5 class="page-date" id="submitteddate_4"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h6 class="page-title text-dark font-weight-medium">Verified By</h6>
                        </div>
                        <div class="col-md-7">
                            <h5 class="page-title text-dark" id="verifiedby_4"></h5>
                            <h5 class="page-date" id="verifieddate_4"></h5>
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
                    $('#transaction_id_4').text(response.transaction_id);
                    $('#class_code_4').text(response.class_code);
                    $('#subject_4').text(response.subject);
                    $('#semester_4').text(response.semester);
                    $('#school_year_4').text(response.school_year);
                    $('#submittedby_4').text(response.submittedBy);
                    $('#submitteddate_4').text(response.submitted_date);
                    $('#recommended_4').text(response.recoBy);
                    $('#recommendeddate_4').text(response.recommended_date);
                    $('#verifiedby_4').text(response.verifiedBy);
                    $('#verifieddate_4').text(response.verified_date);
                }
            });
        })
    }

});
</script>