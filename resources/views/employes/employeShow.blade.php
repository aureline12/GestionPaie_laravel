
@extends('base')

@section('col')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <h3 class="pl-4">Profil | {{ $employe->noms_prenoms }}</h3>
    </div>
@endsection

@section('banner')
    <img style="width: 100%; height: 100%;" src="{{ asset('images/banner.jpg') }}" alt="">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endsection

@section('content')

    <!--begin::Container-->
    <div class="container">

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title " style="border:none">Confirmer le  paiement  ?</h4>
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
        <div class="row">
            <div class="col-md-7 card p-4 m-4">
                <div class="card__profil">
                    @if (!empty($employe->profile))
                        <img src="{{ asset('uploads/employes/' . $employe->profile) }}"
                        class="card__img" alt="" />
                    @else
                        <img src="{{ asset('uploads/employes/user_100.png') }}"
                        class="card__img" alt="" />
                    @endif
                </div>
                <hr>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label for="">Nom/Prenom</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->noms_prenoms }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Matricule</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->matricule }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Téléphone</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->telephone }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Email</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->email }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Ville</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->ville }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Adresse</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->addresse }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">CNI</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->cni }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Date de Naissance</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->date_naissance }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Unité</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->unite}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Grade</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->grade }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Secteur</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->secteur }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Sexe</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->sexe }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3" style="text-align:right"><a href="#" class="btn" style="background-color: #316331;color:#fff">Modifier le profil</a></div>
                </div>
            </div>
            <div class="col-md-4 card p-4 m-4">
                <div class="card__montant">
                    <span class="card__prime">Total Prime</span>
                    {{floor($totalPrimeCalculer)}} F
                </div>
                <div class="card__list">
                    <div class="card__items">
                        <span>Prime CAC</span>
                        <span>{{ floor($totalPrime['primeCAC']) }} F</span>
                    </div>
                    <div class="card__items">
                        <span>Prime REMISE</span>
                        <span>{{ floor($totalPrime['primeRemise']) }} F</span>
                    </div>
                    <div class="card__items">
                        <span>Prime TEL</span>
                        <span>{{ floor($totalPrime['primeTEL']) }} F</span>
                    </div>
                </div>
                <form id='form' action="/decaisser/{{$employe->id}}" class="inline-block" style="border:none;outline:none;margin:0 auto; width:60%;" method="POST" >
                    @csrf
                    @method('POST')
                    <input style="cursor: pointer !important" id="btn-submit" data-toggle="modal"
                    data-target="#exampleModal" class="card__btn" value="Décaisser">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 card p-4 m-4">
                <div class="h2">Historique des primes</div>
                <hr>
                @empty($transactoinInt[0])
                    <div class="card__transaction_noting">
                        Aucune transaction
                    </div>
                @else
                    @foreach ($transactoinInt as $transaction)
                        <div class="card__transaction">
                            <div class="card__date">{{$transaction->created_at->format('d M Y')}} <em style="font-size: 14px;font-weight:lighter">( de la caisse {{ $transaction->montant }}F )</em></div>
                            <div class="card__recu">
                                <div class="card__prix">montant total recu {{ $transaction->totalPrimes }} FCFA</div>
                                <div class="card__list-recu">
                                    <div class="card__items-recu">
                                        <strong>Prime CAC</strong>
                                        <span>{{ floor($transaction->primeCAC) }} F</span>
                                    </div>
                                    <div class="card__items-recu">
                                        <strong>Prime REMISE</strong>
                                        <span>{{ floor($transaction->primeRemise) }} F</span>
                                    </div>
                                    <div class="card__items-recu">
                                        <strong>Prime TEL</strong>
                                        <span>{{ floor($transaction->primeTEL) }} F</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endempty
            </div>
            <div class="col-md-5 card p-4 m-4">
                <div class="h2">Historique des paiements</div>
                <hr>
                @empty($transactoinOut[0])
                    <div class="card__transaction_noting out">
                        Aucune transaction
                    </div>
                @else
                    @foreach ($transactoinOut as $transaction)
                        <div class="card__transaction out">
                            <div class="card__date">{{ $transaction->created_at->format('d M Y') }}</div>
                            <div class="card__recu">
                                <div class="card__prix">montant total rétirer {{ floor($transaction->montant) }} FCFA</div>
                            </div>
                        </div>
                    @endforeach
                @endempty
            </div>
        </div>
    </div>
    <!--end::Container-->

@endsection

@section('scripts')
    <script>
        window.onload = ()=>{
            let modal_btn = document.getElementById('modal-confirm')
            let form      = document.getElementById('form')
            let submit_btn = document.getElementById('btn-submit')
            modal_btn.addEventListener('click',()=>{
                form.submit()
            })
        }
    </script>
@endsection
