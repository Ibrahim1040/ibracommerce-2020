@extends('layouts.dashboard')
@section('import_style')
    <link href="{{asset('assets/admin/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection
@section('style')
    <style>
        .select2-selection,.select2-results{
            font-weight: bold !important;
        }
    </style>
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> {{ $page_title }}</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-12">

                            {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Catégorie </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <select class="form-control select2 bold" name="category_id" id="category_id" required style="width: 100%;">
                                                <option class="bold" value="">Sélectionnez une catégorie</option>
                                                @foreach($category as $cat)
                                                <option class="bold" value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-addon"><strong><i class="fa fa-indent"></i></strong></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Sous-Catégorie  </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <select class="form-control select2 bold" name="subcategory_id" id="subcategory_id" required style="width: 100%;">
                                                <option class="bold" value="">Sélectionnez une catégorie</option>
                                            </select>
                                            <span class="input-group-addon"><strong><i class="fa fa-list"></i></strong></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Sous sous-Catégorie  </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <select class="form-control select2 bold" name="childcategory_id" id="childcategory_id" style="width: 100%;">
                                                <option class="bold" value="">Sélectionnez une catégorie</option>
                                            </select>
                                            <span class="input-group-addon"><strong><i class="fa fa-list"></i></strong></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Nom </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input name="name" class="form-control bold" value="{{ old('name') }}" placeholder="Nom du produit" required/>
                                            <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;"> N° SKU</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input name="sku" class="form-control bold" value="{{ strtoupper(\Illuminate\Support\Str::random(11)) }}" placeholder="Numéro sku du produit " readonly/>
                                            <span class="input-group-addon"><strong><i class="fa fa-sort-amount-asc"></i></strong></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Image</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="file" name="image" required class="form-control" accept="image/*">
                                            <span class="input-group-addon"><strong><i class="fa fa-file-photo-o"></i></strong></span>
                                        </div>
                                        <code>Image Type of PNG,JPG,JPEG - Resize (780X1000)px</code>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Galerie Images </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="file" name="gallery_image[]" id="images" required onchange="preview_images();" multiple class="form-control" accept="image/*">
                                            <span class="input-group-addon"><strong><i class="fa fa-file-photo-o"></i></strong></span>
                                        </div>
                                        <code>Image Type of PNG,JPG,JPEG - Resize (780X1000)px - Images multiple autorisées</code>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Image Produit </strong></label>
                                    <div class="col-md-12">
                                        <div id="image_preview"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Prix Actuel</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input name="current_price" class="form-control bold" value="{{ old('current_price') }}" placeholder="Prix du produit" required/>
                                            <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Ancien Prix</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input name="old_price" class="form-control bold" value="{{ old('old_price') }}" placeholder="Ancien prix produit"/>
                                            <span class="input-group-addon"><strong>{{ $basic->currency }}</strong></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Qté En Stock</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input name="stock" class="form-control bold" value="{{ old('stock') }}" placeholder="Stock Produit" required/>
                                            <span class="input-group-addon"><strong>Items</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div id="wrapper">
                                    <div id="dynamicInput">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">SpecificationS Produit</strong></label>
                                            <div class="col-md-10">
                                                <input name="specification[]" required class="form-control bold" type="text" placeholder="Specification Produit">
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" id="add-form" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Autre </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Description Produit </strong></label>
                                    <div class="col-md-12">
                                        <textarea name="description" id="area1" rows="5" class="form-control" required placeholder="Description Produit">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Produit  Buy / Return Policy </strong></label>
                                    <div class="col-md-12">
                                        <textarea name="policy" id="area2" rows="5" class="form-control" required placeholder="Produit  Buy / Return Policy">{{ old('policy') }}</textarea>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Produit Tags </strong></label>
                                    <div class="col-md-12">
                                        <textarea name="tags" rows="3" class="form-control" required placeholder="Produit Tags e.g (mobile, smartphone, samsung)">{{ old('tags') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Statut Produit</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" checked data-onstyle="success" data-offstyle="danger" data-on="Active" data-off="Deactive" data-width="100%" data-size="large" type="checkbox" name="status">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();nicEditors.findEditor('area2').saveContent();" class="btn btn-primary btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Ajouter Produit </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div><!-- row -->
                </div>
            </div>
        </div>
    </div><!---ROW-->


@endsection
@section('import_scripts')
    <script src="{{asset('assets/admin/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
@endsection
@section('scripts')
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true}).panelInstance('area1');
            new nicEditor({fullPanel : true}).panelInstance('area2');
        });
    </script>
    <script>
        $(function () {
            $('.select2').select2();
        });
        $('#category_id').on('change',function (e) {
            var category_id = e.target.value;
            var url = '{{ url('/') }}';
            $.get(url + '/subcategory-get?category_id=' + category_id,function (data) {
                $('#subcategory_id').empty();
                $('#subcategory_id').append('<option class="bold" value="">Select One</option>');
                $.each(data,function (index,subcatObj) {
                    $('#subcategory_id').append('<option class="bold" value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
                })
            })
        });
        $('#subcategory_id').on('change',function (e) {
            var subcategory_id = e.target.value;
            var url = '{{ url('/') }}';
            $.get(url + '/childcategory-get?subcategory_id=' + subcategory_id,function (data) {
                $('#childcategory_id').empty();
                $('#childcategory_id').append('<option class="bold" value="">Select One</option>');
                $.each(data,function (index,subcatObj) {
                    $('#childcategory_id').append('<option class="bold" value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
                })
            })
        });
    </script>
    <script>
        function preview_images()
        {
            document.getElementById("image_preview").innerHTML = "";
            var total_file=document.getElementById("images").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
            }
        }
    </script>
    <script>

        var wrapper = $("#wrapper");
        var addForm = $("#add-form");
        var index = 0;


        var getForm = function(index, action) {
            return $("<div class='form-group'><div class='col-sm-10'><input name='specification[]' value='' class='form-control bold' type='text' placeholder='Produit  Specification'></div><a href='#' class='remove btn btn-danger'><i class='fa fa-times'></i> Remove Field</a></div>");
        };

        addForm.on("click", function() {
            var form = getForm(++index);
            form.find(".remove").on("click", function() {
                $(this).parent().remove();
            });
            wrapper.append(form);
        });

    </script>

@endsection

