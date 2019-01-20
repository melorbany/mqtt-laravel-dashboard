@extends ('layouts.dashboard')
@section('page_heading','New Component')

@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-8">


                <form role="form" method="POST" action="/components">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="disabledSelect">Unit ID</label>
                        <input type="hidden" name="unit" value="{{ $unit }}">
                        <input class="form-control" type="text" value="{{ $unit}}" disabled>
                    </div>


                    <div class="form-group">
                        <label for="disabledSelect">Type</label>
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input class="form-control" id="disabledInput" type="text" value="{{ $type_data['name']}}"
                               disabled>
                    </div>


                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control"
                               name="title"
                               value="{{ old('title') }}" required>

                        <p class="help-block">{{$type_data['name']}} 1 , Main {{$type_data['name']}} ..etc</p>
                    </div>


                    @if($type_data['resource_type'] == 'output')

                        @if($type_data['resource_count']==1)
                            <div class="form-group">
                                <label>Output #</label>
                                <select class="form-control" name="output1" value="{{ old('output1') }}" required>
                                    <option disabled value="" selected>Select Output</option>
                                    @for($i=1 ; $i <= 12 ; $i++)
                                        <option value={{$i}}>{{$i}}</option>
                                    @endfor
                                </select>
                                <p class="help-block">Output Value [1:12]</p>

                            </div>

                        @else

                            @for($c = 1 ; $c <= $type_data['resource_count'];$c++)
                                <div class="form-group">
                                    <label>Output {{$c}}</label>
                                    <select class="form-control" name="output{{$c}}" value="{{ old("output$c") }}" required>
                                        <option disabled value="" selected>Select Output</option>
                                        @for($i=1 ; $i <= 12 ; $i++)
                                            <option value={{$i}}>{{$i}}</option>
                                        @endfor
                                    </select>

                                    <p class="help-block">Output Value [1:12]</p>

                                </div>

                            @endfor
                        @endif

                    @elseif($type_data['resource_type'] == 'input')

                        <div class="form-group">
                            <label>Input #</label>
                            <select class="form-control" name="input" value="{{ old('input') }}" required>
                                <option disabled value="" selected>Select Input</option>
                                @for($i=1 ; $i <= 8 ; $i++)
                                    <option value={{$i}}>{{$i}}</option>
                                @endfor
                            </select>

                            <p class="help-block">Input Value [1:8]</p>

                        </div>

                    @elseif($type_data['resource_type'] == 'modbus')

                        <div class="form-group">
                            <label>Modbus #</label>
                            <input class="form-control" type="number"
                                   name="modbus" min="1" max="256"
                                   value="{{ old('modbus') }}" required>

                            <p class="help-block">Modbus Value [1:256]</p>

                        </div>


                    @endif



                    @if(isset($switches_data) && count($switches_data)>0)
                        <div class="form-group">
                            <label>Switch Button</label>

                            <select class="form-control selectpicker" name="button"
                                    value="{{ old('button') }}" required>

                                <option disabled value="" selected>Select Switch Button</option>



                                @foreach($switches_data as $switch_data)

                                    @foreach($switch_data['buttons'] as $button)

                                        <option value={{$button->id}}
                                         @if(isset($button->component_id)) disabled @endif>
                                            {{$switch_data['title']}} - {{$button->title}}</option>

                                    @endforeach

                                @endforeach

                            </select>
                        </div>


                    @endif


                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"
                                  rows="3"
                                  name="description"
                                  value="{{ old('description') }}"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">Add New Component</button>
                    <button type="reset" class="btn btn-default">Reset Form</button>

                </form>
            </div>
        </div>
    </div>
@stop