@extends ('layouts.dashboard')
@section('page_heading','New Switch')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-8">


                <form role="form" method="POST" action="/switches">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="disabledSelect">Unit ID</label>
                        <input type="hidden" name="unit" value="{{ $unit }}">
                        <input class="form-control" type="text" value="{{ $unit}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="disabledSelect">Type</label>
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input class="form-control" type="text" value="{{ $type_data['name']}}"
                               disabled>
                    </div>


                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control"
                               name="title"
                               value="{{ old('title') }}" required>

                        <p class="help-block">Switch 1 , Switch 2..etc</p>
                    </div>


                    <div class="form-group">
                        <label>Modbus #</label>
                        <input class="form-control"  type="number"
                               name="modbus" min="1" max="256"
                               value="{{ old('modbus') }}" required>

                        <p class="help-block">Modbus Value [1:256]</p>

                    </div>


                    @for($c = 1 ; $c <= $type_data['buttons'];$c++)

                        <div class="panel panel-info">
                            <div class="panel-heading">Button {{$c}}</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control"
                                           name="button_t{{$c}}"
                                           value="{{ old("button_t$c") }}" required>

                                    <p class="help-block">Light Button , Dimmer Controller ..etc</p>

                                </div>
                                <div class="form-group">
                                    <label>Register #</label>
                                    <input class="form-control"  type="number"
                                           name="button_r{{$c}}"
                                           min="0" max="65536"
                                           required
                                           value="{{ old("button_r$c") }}">

                                    <p class="help-block">Register Value [0:65536]</p>
                                </div>
                            </div>
                        </div>

                    @endfor



                    <button type="submit" class="btn btn-primary">Add New Switch</button>
                    <button type="reset" class="btn btn-default">Reset Form</button>

                </form>
            </div>
        </div>
    </div>
@stop