@extends('layouts.dashboard')
@section('page_heading',$unit->title)

@section('section')
    <div class="col-sm-12">
        <div class="row">

            <div class="col-sm-12">
                <p>

                <div class="btn-group" role="group">
                    <form role="form" method="POST" action="/units/{{$unit->id}}/program">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Program Unit Controller</button>
                    </form>

                </div>


                <div class="btn-group" role="group">
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="true"> Add Component <span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($component_types as $type => $data)
                            <li><a href="/components/create?unit={{$unit->id}}&type={{$type}}">{{$data['name']}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>


                <div class="btn-group" role="group">
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="true"> Add Switch <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($switch_types as $type => $data)
                            <li><a href="/switches/create?unit={{$unit->id}}&type={{$type}}">{{$data['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>


                {{--<a href="/components/create?unit={{$unit->id}}" type="button" class="btn btn-primary">Add Component</a>--}}
                </p>

                <div class="marg"></div>


                @if(isset($components) && count($components)>0)

                    <div class="panel panel-info">
                        <div class="panel-heading">Components</div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="20%">ID</th>
                                    <th width="30%">Title</th>
                                    <th width="10%">Type</th>
                                    <th width="20%">Admin</th>
                                    <th width="20%">Date</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($components as $component)
                                    <tr>
                                        <td>{{$component->id}}</td>
                                        <td>{{$component->title}}</td>
                                        <td>{{$component->type}}</td>
                                        <td>{{$component->user_id}}</td>
                                        <td>{{date("d M Y", strtotime($component->updated_at))}}</td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                @endif




                @if(isset($switches) && count($switches)>0)

                    <div class="panel panel-info">
                        <div class="panel-heading">Switches</div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="20%">ID</th>
                                    <th width="30%">Title</th>
                                    <th width="10%">Type</th>
                                    <th width="20%">Admin</th>
                                    <th width="20%">Date</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($switches as $switch)
                                    <tr>
                                        <td>{{$switch->id}}</td>
                                        <td>{{$switch->title}}</td>
                                        <td>{{$switch->type}}</td>
                                        <td>{{$switch->user_id}}</td>
                                        <td>{{date("d M Y", strtotime($unit->updated_at))}}</td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                @endif


            </div>
        </div>
    </div>
@stop