@extends('base')

@section('title')
    Caisse
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('col')
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title " style="border:none">Confirmez-vous l'ajout en caisse ?</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body" style="border:none;font-size:17px">
                        <p>Cette opération ne pourra plus être annulée  ! </p>
                    </div>
                    <div class="modal-footer" style="border:none">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button id="modal-confirm" type="button" class="btn btn-primary">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">CAISSE</h5>
                <!--end::Title-->



            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="#" class=""></a>
                <!--end::Button-->
                <!--begin::Button-->
                {{-- <button class="btn btn-primary font-weight-bold py-2 px-5 ml-2" >Ajouter un Montant</button> --}}
                <!--end::Button-->

            </div>
            <!--end::Toolbar-->
        </div>
    </div>
@endsection


@section('content')

    <div class="container">

        <div class="card p-4 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card__montant">
                        <span class="card__prime">Montant en caisse</span>
                        {{ floor($caisseTotal) }} FCFA
                    </div>
                </div>
                <div class="col-md-6">
                    <form id="form" action="/save-caisse" method="POST">
                        @csrf
                        <div class="form-group">
                            <h4>Entrer le montant a ajouter </h4>
                            <input type="number" value="{{ old('montant') }}" name="montant"
                                class="form-control @error('montant') is-invalid @enderror" required>
                            @error('montant')
                                <div class="invalid-feedback">
                                    Montant incorrect
                                </div>
                            @enderror
                        </div>
                        <div class="form-group" style="transform: translateY(-5px)">
                            <button id="btn-click" class="btn btn-theme" data-toggle="modal"
                    data-target="#exampleModal" >Ajouter un montant en caisse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--begin::Card-->
        <div class="card card-custom">


            <!--#######################################################################################------->

            <!---------------------------------ADD-------------------------------------------------->
            <!-- Modal -->
            

            <!--###########################################################################################################################-->

            

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table">
                        <thead>
                            <th>Montant(FCFA)</th>
                            <th>Ajouté le : </th>

                            <th></th>
                            <th></th>

                        </thead>
                        <tbody>
                            @foreach ($caisse as $row)
                                <tr>

                                    <td> {{ $row->montant }}</td>
                                    <td> {{ $row->created_at->format('l d M Y à H\hi') }}</td>
                                    <td></td>
                                    <td></td>
                                    {{-- <td><a href="edit-montant/{{ $row->id }}" class="btn btn-success"> EDIT</a></td> --}}
                                    {{-- <td><a href="edit-montant/{{ $row->id }}" class="btn btn-danger"> DELETE</a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--end::Container-->
@endsection

@section('scripts')

    <script src="assets/js/pages/custom/contacts/list-datatable.js"></script>
    <script>

$('.deletebtn').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Etes-vous sure?',
                text: 'Cet employé sera supprimé!',
                icon: 'warning',
                buttons: ["Annuler", "Supprimer!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        
        window.onload = ()=>{
            let modal_btn = document.getElementById('modal-confirm')
            let form      = document.getElementById('form')
            let submit_btn = document.getElementById('btn-submit')
            document.getElementById('btn-click').addEventListener('click',e=>e.preventDefault())
            modal_btn.addEventListener('click',()=>{
                form.submit()
            })
        }
    </script>
@endsection
