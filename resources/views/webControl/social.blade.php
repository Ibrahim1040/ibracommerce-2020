@extends('layouts.dashboard')

@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <div class="box-title">
                        <button id="btn_add" name="btn_add" class="btn btn-primary bold"><i class="fa fa-plus"></i> Ajouter un nouveau réseau social</button>
                    </div>
                    <!-- Boîte à outils -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. outils -->
                </div>
                <!-- Permet d'afficher la liste des réseaux sociaux présent dans la base de données  -->
                <div class="box-body pad">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Icône</th>
                            <th>Lien</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="products-list" name="products-list">
                        @foreach ($social as $product)
                            <tr id="product{{$product->id}}">
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td style="font-size: 22px;">{!! $product->code !!}</td>
                                <td>{{$product->link}}</td>
                                <td>
                                    <button class="btn btn-primary btn-detail open_modal bold uppercase" value="{{$product->id}}"><i class="fa fa-edit"></i>Afficher</button>
                                    <button type="button" class="btn btn-danger bold uppercase delete_button" data-toggle="modal" data-target="#DelModal" data-id="{{$product->id}}"> <i class='fa fa-trash'></i> Supprimer</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    
    <!--  Modal qui affiche le formulaire pour ajouter un nouveau réseau social -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i>Gérer les réseaux sociaux</h4>
                </div>
                <div class="modal-body">
                    <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Nom : </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error bold " id="name" name="name" placeholder="Nom du réseau social" value="">
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Code d'icône : </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error bold " id="code" name="code" placeholder="Code fontawesome du réseau social" value="">
                                <code>visite le site Fontawesome : http://fontawesome.io/icons/</code>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label bold uppercase">Lien : </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error bold " id="link" name="link" placeholder="Lien du réseau social" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary bold uppercase" id="btn-save" value="add"><i class="fa fa-send"></i> Enregistrer le réseau social</button>
                    <input type="hidden" id="product_id" name="product_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Modal pour supprimer un réseau social-->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Supprimer !</h4>
                </div>

                <div class="modal-body">
                    <strong>Etes-vous sûr que vous voulez supprimer ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" class="form-inline">
                        <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> FERMER</button>
                        <button type="button" class="btn btn-danger deleteButton"><i class="fa fa-trash"></i> SUPPRIMER</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $(document).ready(function () {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $("#delete_id").val(id);
            });
        });
        var url = '{{ url('/admin/manage-social') }}';

        //afficher le formulaire modal pour l'édition du reseau

        $(document).on('click','.open_modal',function(){
            var product_id = $(this).val();

            $.get(url + '/' + product_id, function (data) {
                //données de réussite
                console.log(data);
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $('#code').val(data.code);
                $('#link').val(data.link);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            })
        });
        //afficher le formulaire modal pour créer un nouveau réseau social
        $('#btn_add').click(function(){
            $('#btn-save').val("add");
            $('#frmProducts').trigger("reset");
            $('#myModal').modal('show');
        });
        //créer un nouveau réseau social / mettre à jour un réseau social existant
        $("#btn-save").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            e.preventDefault();
            var formData = {
                name: $('#name').val(),
                code: $('#code').val(),
                link: $('#link').val(),
            }
            //utilisé pour déterminer le verbe http à utiliser [add = POST], [update = PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //pour créer une nouvelle ressource
            var product_id = $('#product_id').val();;
            var my_url = url;
            if (state == "update"){
                type = "PUT"; //pour mettre à jour la ressource existante
                my_url += '/' + product_id;
            }
            console.log(formData);
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td style="font-size: 22px;">' + data.code + '</td><td>' + data.link + '</td>';
                    product += '<td><button class="btn btn-primary btn-detail open_modal bold uppercase" value="' + data.id + '"><i class="fa fa-edit"></i>AFFICHER</button>';
                    product += '<button type="button" class="btn btn-danger bold uppercase delete_button" data-toggle="modal" data-target="#DelModal" data-id='+ data.id +'> <i class="fa fa-trash"></i>SUPPRIMER</button></td></tr>';

                    if (state == "add"){ //si l'utilisateur a ajouté un nouvel enregistrement
                        $('#products-list').append(product);
                    }else{ //si l'utilisateur a mis à jour un enregistrement existant
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
                toastr.success('Enregistrement du réseau social réussi.');
            });
        });
        //supprimer le réseau social et le retirer de la liste
        $(document).ready(function () {
            $(document).on('click','.deleteButton',function(e){

                var product_id = document.getElementById("delete_id").value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                $.ajax({
                    type: "DELETE",
                    url: url + '/' + product_id,
                    success: function (data) {
                        $('#DelModal').modal('hide');
                        $("#product" + product_id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                }).done(function() {
                    toastr.success('Réseau social supprimé avec succès.');
                });
            });
        });
    </script>

@endsection