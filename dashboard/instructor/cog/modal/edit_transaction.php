<div class="modal fade" id="edit-transaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-15">
            <div class="modal-header">
                <h5 class="modal-title-custom">Edit Transaction</h5>

            </div>
            <div class="modal-body">
                <div id="smessage"></div>
                <form id="cog-form" enctype='multipart/form-data' action="" method="POST">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-outline">
                                    <label class="col-form-label">Transaction ID</label>
                                    <input data-parsley-length="[4, 20]" type="text" name="transaction_id"
                                        id="edit_transaction_id" class="form-control"
                                        value="<?php echo input::get('transaction_id');?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <div class="form-outline">
                                    <label class="col-form-label">Class Code</label>
                                    <input type="text" name="class_code" class="form-control" id="edit_class_code"
                                        value="<?php echo input::get('class_code');?>" />
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-outline">
                                    <label class="col-form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control" id="edit_subject"
                                        value="<?php echo input::get('subject');?>" />
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-outline">
                                    <label class="col-form-label">School Year</label>
                                    <input type="text" name="school_year" class="form-control" id="edit_school_year" placeholder="1234-5678" maxlength="9" oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*)\./g, '$1');"
                                        value="<?php echo input::get('school_year');?>" />
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-outline">
                                    <label class="col-form-label">Semester</label>
                                    <select class="form-control" name="semester" id="edit_semester"
                                        value="<?php echo input::get('semester');?>">
                                        <option>1st Semester</option>
                                        <option>2nd Semester</option>
                                        <option>Summer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-outline">
                                    <label class="col-form-label">Term</label>
                                    <select class="form-control" id="edit_term" value="<?php echo input::get('ter');?>" name="ter">
                                        <option>Prelim</option>
                                        <option>Midterm</option>
                                        <option>Finals (graduating)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-outline">
                                    <label class="col-form-label">College</label>
                                    <select class="form-control" id="edit_college"
                                        value="<?php echo input::get('college');?>" name="college">
                                        <?php $view->CollegeLS1();?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <input type=hidden name="token" id="csrf_token" value="<?php echo Token::generate(); ?>">
                <button class="btn btn-outline-secondary mx-1" data-dismiss="modal">Close</button>
                <button type="submit" id="update-btn" class="btn btn-info">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="/coco-starterkit/vendor/jquery/dist/jquery.min.js"></script>
<script src="/coco-starterkit/resource/js/selectize.js"></script>
<script>
var $semester = $('#edit_semester').selectize();
var $college = $('#edit_college').selectize();
var $term = $('#edit_term').selectize();
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<script>
$(document).ready(function() {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.edit_T', function() {
            var id = $(this).data("id");
            console.log(id);
            $.ajax({
                type: 'POST',
                url: '/coco-starterkit/init/controllers/transaction_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#edit_transaction_id').val(response.transaction_id);
                    $('#edit_class_code').val(response.class_code);
                    $('#edit_subject').val(response.subject);
                    $('#edit_school_year').val(response.school_year);
                    $semester[0].selectize.setValue(response.semester);
                    $college[0].selectize.setValue(response.college_department);
                    $term[0].selectize.setValue(response.ter);
                }
            });
        })
    }

});
</script>


<script>
$("#cog-form").submit(function(e) {
    e.preventDefault();
    var a = $('#edit_transaction_id').val();
    var b = $('#edit_class_code').val();
    var c = $('#edit_subject').val();
    var d = $('#edit_semester').val();
    var e = $('#edit_school_year').val();
    var f = $('#edit_college').val();
    var g = $('#edit_term').val();
    var token = $('#csrf_token').val();
    if (a === '' || b === '' || c === '' || d === '' || e === '' || f === '') { // VERIFY DATA
        $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
    } else {

        $.ajax({
            type: 'POST',
            url: '/coco-starterkit/init/controllers/edit_transaction.php',
            data: {
                transaction_id: a,
                class_code: b,
                subject: c,
                semester: d,
                school_year: e,
                college: f,
                ter: g,
                token: token
            },
            success: function(response) {
                $("#smessage").html(response);
                $('#edit-transaction').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Update',
                    text: 'Record has been updated.',
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