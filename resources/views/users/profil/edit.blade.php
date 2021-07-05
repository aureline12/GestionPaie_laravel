@extends('base')

@section('title')
    Modifier Employés
@endsection

@section('col')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">USERS</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Modifier Votre Profil</span>

                </div>
                <!--end::Search Form-->

            </div>
            <!--end::Details-->

        </div>
    </div>
@endsection

@section('content')

    <!--begin::Container-->
    <div class="container">
        <!--begin::Profile Personal Information-->
        <div class="d-flex flex-row">

            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Informations Utilisateur</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Mettre à jour</span>
                        </div>
                        <!--begin::Form-->
                        <form class="form" action="/profil/update/{{$users->id}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success mr-2">Modifier</button>
                                <a href="/profile" class="btn btn-danger">Annuler</a>
                            </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body">

                        <input type="hidden" name="id" value="">

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
                            <div class="col-lg-9 col-xl-9">
                                <input type="file" name="profile" class="custom-file-input" id="inputGroupFile04"
                                    value="{{Auth::user()->profile }}">
                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                    <img class="img-circle" src="{{asset('/storage/images/'.Auth::user()->profile)}}" 
                                    width="70px" height="70px">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Noms</label>
                            <div class="col-lg-9 col-xl-9">
                                <input class="form-control form-control-lg form-control-solid" name="name"
                                    type="text" value="{{$users->name }}" />
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Telephone</label>
                            <div class="col-lg-9 col-xl-9">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="la la-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg form-control-solid"
                                        name="telephone" value="{{ $users->telephone }}" placeholder="Phone" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Email </label>
                            <div class="col-lg-9 col-xl-9">
                                <div class="input-group input-group-lg input-group-solid">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="la la-at"></i>
                                        </span>
                                    </div>
                                    <input type="email"
                                        class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                        name="email" value="{{ $users->email}}" required autocomplete="email" placeholder="Email (anna.krox@loop.com)" />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Body-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Personal Information-->
    </div>
    <!--end::Container-->

@endsection


@section('scripts')

@endsection
