@extends ('layouts.dashboard')
@section('page_heading','New Unit')

@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-lg-8">
        <form role="form" method="POST" action="/units">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Building</label>
                <select class="form-control" name="building"  value="{{ old('building') }}" required>
                    <option disabled value="" selected>Select Building</option>
                    @foreach($buildings as $building)
                        <option value={{$building->id}}>{{$building->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Unit ID</label>
                <input class="form-control"
                       name="id"
                       minlength="1"
                       value="{{ old('id') }}"  required>

                <p class="help-block">Unit ID from device.</p>
            </div>

            <div class="form-group">
                <label>Title</label>
                <input class="form-control"
                       name="title"
                       value="{{ old('title') }}" required>

                <p class="help-block">Living Room , Reception , Kids Room ..etc</p>
            </div>

            <div class="form-group">
                <label>Description</label>

                <input class="form-control"
                       name="description"
                       value="{{ old('description') }}" >

                <p class="help-block">1st Floor , Second Floor , Basement ,  ..etc</p>

            </div>


            <button type="submit" class="btn btn-primary">Add New Unit</button>
            <button type="reset" class="btn btn-default">Reset Form</button>

        </form>
    </div>
</div>
</div>
@stop