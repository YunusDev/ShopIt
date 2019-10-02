@extends('admin.layouts.app')


@section('styles')

    <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('admin/bootstrap-tagsinput.css')}}">


@endsection

@section('content')

    <section class="content" >

        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger col-lg-6">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="post" action="{{route('product.store')}}" role="form" class="col-lg-10 col-lg-offset-1 card" enctype="multipart/form-data" style="padding: 20px">

                            @csrf

                            <h4 class="text-center pb-3">Create Product</h4>

                            <div class="row">

                                <div class="form-group col-lg-6">
                                    <input type="text" value="{{old('name')}}"  class="form-control" placeholder="Name" name="name" multiple>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="number" value="{{old('price')}}"  class="form-control" placeholder="Price" name="price">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <input type="number" value="{{old('quantity')}}"  class="form-control" placeholder="Quantity" name="quantity">
                                </div>
                                <div class="form-group col-lg-6">
                                    <select  name="admin_id" class="form-control" >
                                        <option selected ="true" disabled>Select an Author</option>

                                        @foreach($admins as $admin)

                                            <option  value="{{$admin->id}}" >{{$admin->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    {{--<label for="image">File input</label>--}}
                                    <input type="file" id="image" class="form-control" name="image">
                                </div>
                                <div class="form-group col-lg-6">
                                    {{--<label>Select Category</label>--}}
                                    <select  name="category_id" class="form-control">
                                        <option selected disabled>Select a Category</option>
                                        @foreach($categories as $category)

                                            <option  value="{{$category->id}}" >{{$category->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input-group control-group increment" >
                                <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                            </div>
                            <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="form-check" style="margin-top: 10px; margin-bottom: 10px">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" name="status" for="exampleCheck2" style="font-style: 13px; font-weight: bolder">Status </label>
                                </div>
                            </div>

                            {{--<div class="col-lg-12 form-group">--}}
                                <input  type="text" name="specs" placeholder="Add Key Specs" value="Amsterdam,Washington" data-role="tagsinput"/>

                            {{--</div>--}}

                            <div class="form-group" style="margin-top: 15px">
                                <textarea class="form-control" placeholder="Brief Description" name="brief"></textarea>
                            </div>


                            <div class="box">
                                <div class="box-body pad">
                                        <textarea value="{{old('description')}}" name="description"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"id="editor1">{{old('body')}}</textarea>
                                </div>
                            </div>

                            <div class="card-footer pull-right" style="padding-top: 50px">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                {{--<input type="submit" class="btn btn-primary">--}}
                                <button type="submit" class="btn btn-primary">Create product</button>
                            </div>
                            
                        </form>


                    </div>

                </div>

            </div>
        </div>

    </section>


@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });
        });
    </script>

    <script src="{{asset('admin/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/bootstrap-tagsinput.min.js')}}"></script>
    <script>

        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5();
        });
    </script>


@endsection