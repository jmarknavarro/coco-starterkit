<div class="modal fade " id="approve-details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
                <h4 class="modal-heading-custom">Faculty Report on <br>Completion of Grades (Previous Semester)</h4>
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
                                            <h5 class="page-title text-dark" id="transaction_id2"></h5>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Class Code</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="class_code2"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Subject</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="subject2"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">Semester</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="semester2"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="page-title text-dark font-weight-medium">School Year</h6>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="page-title text-dark" id="school_year2"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="tl-hr">
                            <h4 class="text-dark font-weight-medium">Transaction Status</h4>
                            <div class="status_tracker_cogp">
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
        $(document).on('click', '.approve_D', function() {
            var id = $(this).data("id");
            $.ajax({
                type: 'POST',
                url: '/coco/init/controllers/transaction_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#transaction_id2').text(response.transaction_id);
                    $('#class_code2').text(response.class_code);
                    $('#subject2').text(response.subject);
                    $('#semester2').text(response.semester);
                    $('#school_year2').text(response.school_year);
                    $.ajax({
                        type: 'POST',
                        url: '/coco/init/controllers/instructor/cogp/status_tracker.php',
                        data: {
                            'action': document.getElementById('transaction_id2')
                                .innerHTML
                        },
                        success: function(data) {
                            $('.status_tracker_cogp').html(data);
                            $('#submitted2').text(response.submittedBy);
                            $('#submitteddate2').text(response.submitted_date);
                            $('#recommended2').text(response.recoBy);
                            $('#recommendeddate2').text(response.recommended_date);
                            $('#verified2').text(response.verifiedBy);
                            $('#verifieddate2').text(response.verified_date);
                            $('#approved2').text(response.approvedBy);
                            $('#approveddate2').text(response.approved_date);
                            $('#attested2').text(response.attestedBy);
                            $('#attesteddate2').text(response.attested_date);

                        }
                    });
                }
            });
        })
    }

});
</script>