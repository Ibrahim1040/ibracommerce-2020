@extends('layouts.dashboard')
@section('import_style')
    <link href="{{asset('assets/admin/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('style')
    <style>
        td{
            font-weight: bold;
            font-size: 14px;
        }
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
                    <div class="box-title">
                        <button id="btn_add" name="btn_add" class="btn btn-primary bold"><i class="fa fa-plus"></i> Nouvelle sous sous-catégorie</button>
                    </div>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Catégorie</th>
                            <th>Sous Catégorie</th>
                            <th>Sous sous-catégorie</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($childcategory as $product)
                            <tr id="product{{$product->id}}">
                                <td>{{$product->id}}</td>
                                <td>{{$product->subcategory->category->name}}</td>
                                <td>{{$product->subcategory->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>
                                    <button class="btn btn-primary btn-detail open_modal bold uppercase" value="{{$product->id}}"><i class="fa fa-edit"></i>Modifier</button>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button2"
                                            data-toggle="modal" data-target="#DelModal2"
                                            data-id="{{ $product->id }}">
                                        <i class='fa fa-trash'></i> Supprimer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 40%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"><i class="fa fa-indent"></i> sous sous-catégorie</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Sous Catégorie : </label>
                            <div class="col-sm-9">
                                <select class="form-control select2 bold" name="subcategory_id" id="subcategory_id" required style="width: 100%;">
                                    <option class="bold" value="">Sélectionnez</option>
                                    @foreach($subcategory as $cat)
                                        <option class="bold" value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Sous sous-catégorie : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="name" name="name" placeholder="Nom Categorie" value="">
                                    <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Enregistrer</button>
                    <input type="hidden" id="product_id" name="product_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for DELETE -->
    <div class="modal fade" id="DelModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i> Confirmation !</h4>
                </div>

                <div class="modal-body">
                    <strong>Etes-vous sûr de vouloir supprimer cette sous sous-catégorie ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('subsubcategory-delete') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="confirm_id2" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i>Oui,je suis sure !</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('import_scripts')
    <script src="{{asset('assets/admin/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
@section('scripts')

    <script>

        var url = '{{ url('/admin/manage-childcategory') }}';
        //afficher le formulaire modal pour l'édition du produit
        $(document).on('click','.open_modal',function(){
            var product_id = $(this).val();

            $.get(url + '/' + product_id, function (data) {
                //données de réussite
                console.log(data);
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $("#subcategory_id").select2().val(data.subcategory_id).trigger("change");
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            })
        });
        //afficher le formulaire modal pour créer un nouveau produit
        $('#btn_add').click(function(){
            $('#btn-save').val("add");
            $('#frmProducts').trigger("reset");
            $('#myModal').modal('show');
        });
        //créer un nouveau produit / mettre à jour un produit existant
        $("#btn-save").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            e.preventDefault();
            var formData = {
                name: $('#name').val(),
                subcategory_id: $('#subcategory_id').val()
            };
            //utilisé pour déterminer le verbe http à utiliser [add = POST], [update = PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var product_id = $('#product_id').val();;
            var my_url = url;
            if (state == "update"){
                type = "PUT"; //for updating existing resource
                my_url += '/' + product_id;
            }
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.categoryName + '</td><td>' + data.subcategoryName + '</td><td>' + data.name + '</td>';
                    product += '<td><button class="btn btn-primary btn-detail open_modal bold uppercase" value="' + data.id + '"><i class="fa fa-edit"></i> EDIT category</button></td></tr>';

                    if (state == "add"){ //if user added a new record
                        $('#products-list').append(product);
                    }else{ //if user updated an existing record
                        $("#product" + product_id).replaceWith( product );
                    }
                    $('#frmProducts').trigger("reset");
                    $('#myModal').modal('hide')
                },
                error: function(data)
                {
                    $.each( data.responseJSON.errors, function( key, value ) {
                        toastr.error( value);
                    });
                }
            }).done(function() {
                toastr.success('Sous sous-Catégorie sauvegardée.');
            });
        });
        $(function () {
            $('.select2').select2();
        });
    </script>
     <script>
        $(document).ready(function (e) {
            $(document).on("click", '.delete_button2', function (e) {
                var id = $(this).data('id');
                $(".confirm_id2").val(id);
            });
        });
    </script>
@endsection