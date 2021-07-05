
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
        <div class="row">
            <div class="col-md-7 card p-4 m-4">
                <span class="card__span">Profil de l'employé</span>
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
                        <label for="">nom/prenom</label>
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
                        <label for="">téléphone</label>
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
                        <label for="">cni</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->cni }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">date de naissance</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->date_naissance }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">poste</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->poste }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">grade</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->grade }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">departement</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->departement }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">sexe</label>
                        <div class="card__label form-group p-3">
                            {{ $employe->sexe }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3" style="text-align:right"><a href="#" class="btn" style="background-color: #316331;color:#fff">modifier le profil</a></div>
                </div>
            </div>
            <div class="col-md-4 card p-4 m-4">
                <div class="card__montant">
                    <span class="card__prime">total prime</span>
                    {{floor($totalPrimeCalculer)}} F
                </div>
                <div class="card__list">
                    <div class="card__items">
                        <span>Prime A</span>
                        <span>{{ floor($totalPrime['primeA']) }} F</span>
                    </div>
                    <div class="card__items">
                        <span>Prime B</span>
                        <span>{{ floor($totalPrime['primeB']) }} F</span>
                    </div>
                    <div class="card__items">
                        <span>Prime C</span>
                        <span>{{ floor($totalPrime['primeC']) }} F</span>
                    </div>
                </div>
                <form action="/decaisser/{{$employe->id}}" class="inline-block" style="border:none;outline:none;margin:0 auto; width:60%;" method="POST" >
                    @csrf
                    @method('POST')
                    <input type="submit" class="card__btn" value="Décaisser">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 card p-4 m-4">
                <div class="h2">Transactions Entrantes</div>
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
                                        <strong>Prime A</strong>
                                        <span>{{ floor($transaction->primeA) }} F</span>
                                    </div>
                                    <div class="card__items-recu">
                                        <strong>Prime B</strong>
                                        <span>{{ floor($transaction->primeB) }} F</span>
                                    </div>
                                    <div class="card__items-recu">
                                        <strong>Prime C</strong>
                                        <span>{{ floor($transaction->primeC) }} F</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endempty
            </div>
            <div class="col-md-5 card p-4 m-4">
                <div class="h2">Transactions Sortantes</div>
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
        
    </script>
@endsection
