<div class="modal fade" id="imageAjaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Add New Record</h4>
            </div>
            <div class="modal-body">

                <span id="form_result"></span>

                <form id="ProfileForm" name="ProfileForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="row_id" id="row_id">

                    <div class="form-group">
                        <label for="first_name" class="col-sm-6 control-label">First Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="col-sm-6 control-label">Last Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6">Select Profile Image</label>
                        <div class="col-sm-12">
                            <input type="file" name="profile_image" id="profile_image">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" name="action_button" value="Add" id="action_button" >Add</button>
                        {{--<button type="submit" class="btn btn-primary" id="UpdateBtn"></button>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
