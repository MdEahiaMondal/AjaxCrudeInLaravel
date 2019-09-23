<div class="modal fade" id="DataForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitle"></h4>
            </div>
            <div class="modal-body">
                @if($errors->all())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                @endif
                <form id="studentForm" name="productForm" method="post" class="form-horizontal">
                    @csrf  {{method_field('POST')}}
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="religion" class="col-sm-2 control-label">Religion</label>
                        <div class="col-sm-12">
                            <select name="religion" id="religion" class="form-control form-control-sm">
                                <option class="form-control" value="islam">Islam</option>
                                <option class="form-control" value="hindu">Hindu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="religion" class="col-sm-2 control-label">Avatar</label>
                        <div class="col-sm-6">
                            <input type="file" name="avatar" id="avatar" onchange="preview_image(event)" >
                        </div>
                        
                        <div class="col-sm-6">
                            <img width="100" src="{{base_path('public/Avatar/')}}" id="output_image" class="studentImage" alt="image">
                        </div>
                    </div>


                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal" id="cancleButton" value="create">Cancle</button>
                        <button type="submit" class="btn btn-primary" id="submitButton" value="create"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>