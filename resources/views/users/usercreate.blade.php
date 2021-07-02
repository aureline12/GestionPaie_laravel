@extends('base')

@section('title')
    Ajouter Utilisateur
@endsection

@section('css')

    <!--begin::Page Custom Styles(used by this page)-->
    <link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
@endsection

@section('col')

    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <!--begin::Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Nouvel Utilisateur</h5>
        <!--end::Title-->
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Search Form-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Entrer les informations d'un utilisateur et
                Enregistrer</span>
        </div>
        <!--end::Search Form-->
    </div>

@endsection

@section('content')

    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <!--begin::Body-->
            <div class="card-body p-0">
                <!--begin::Wizard-->
                <div class="wizard wizard-1" id="kt_contact_add" data-wizard-state="step-first"
                    data-wizard-clickable="true">

                    <!--begin::Wizard Body-->
                    <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                        <div class="col-xl-12 col-xxl-7">
                            <!--begin::Form Wizard Form-->
                            <form class="form" id="kt_contact_add_form" action="{{ route('register') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!--begin::Form Wizard Step 1-->
                                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                    <h3 class="mb-10 font-weight-bold text-dark">Ajouter un Utilisateur</h3>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="image-input image-input-outline" id="kt_contact_add_avatar">
                                                        <div class="image-input-wrapper"
                                                            style="background-image: url(assets/media/users/100_2.jpg)">
                                                        </div>
                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip" title=""
                                                            data-original-title="Change avatar">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="profile" accept=".png, .jpg, .jpeg" />
                                                            <input type="hidden" name="profile_avatar_remove" />
                                                        </label>
                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="cancel" data-toggle="tooltip"
                                                            title="Cancel avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                           
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Noms</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input placeholder="Entrer le nom et le prenom de l'utilisateur" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                                        name="name" type="text" value="{{old('name')}}" />
                                                    @error('name') 
                                                        <div class="invalid-feedback" style="background-color:#fff">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @enderror
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
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                                            name="email" value="{{old('email')}}" placeholder="Email (anna.krox@loop.com)" />
                                                            @error('email') 
                                                                <div class="invalid-feedback" style="background-color:#fff">
                                                                    {{ $errors->first('email') }}
                                                                </div>
                                                            @enderror
                                                    </div>
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
                                                        <input type="number"
                                                            class="form-control form-control-lg form-control-solid @error('telephone') is-invalid @enderror"
                                                            name="telephone" value="{{old('telephone')}}" placeholder="Entrer le numéro de téléphone" />
                                                        @error('telephone') 
                                                            <div class="invalid-feedback" style="background-color:#fff">
                                                                {{ $errors->first('telephone') }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Password</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input type="password" placeholder="Entrer le mot de passe de l'utilisateur" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                                        name="password"  />
                                                    @error('password') 
                                                        <div class="invalid-feedback" style="background-color:#fff">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Confirm-password</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input placeholder="Confirmer le mot de passe de l'utilisateur" class="form-control form-control-lg form-control-solid @error('cpassword') is-invalid @enderror"
                                                    name="password_confirmation" required autocomplete="new-password"" type="password"  />
                                                    @error('password_confirmation') 
                                                        <div class="invalid-feedback" style="background-color:#fff">
                                                            {{ $errors->first('password_confirmation') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Role</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <select name="role" placeholder="Choisir un role"
                                                        class="form-control form-control-lg form-control-solid @error('role') is-invalid @enderror">
                                                        <option >choisir un role</option>
                                                        <option value="super admin">super admin</option>
                                                        <option value="admin">admin</option>
                                                        <option value="none">none</option>
                                                    </select>
                                                    @error('role') 
                                                        <div class="invalid-feedback" style="background-color:#fff">
                                                            {{ $errors->first('role') }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--end::Form Wizard Step 1-->
                                <!--begin::Wizard Actions-->
                                <div class="modal-footer">
                                    <div>
                                        <button type="submit"
                                            class="btn btn-success font-weight-bolder text-uppercase px-9 py-4">Enregistrer</button>
                                        <a href="/users"
                                            class="btn btn-danger font-weight-bolder text-uppercase px-9 py-4">Annuler</a>
                                    </div>

                                </div>
                                <!--end::Wizard Actions-->
                            </form>
                            <!--end::Form Wizard Form-->
                        </div>
                    </div>
                    <!--end::Wizard Body-->
                </div>
                <!--end::Wizard-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->

@endsection

@section('scripts')
    <script>
        let fieldsDisabled = document.querySelector('input.disabled')
        fieldsDisabled.addEventListener('keydown',e=>e.preventDefault())
    </script>

    <script src="assets/js/pages/custom/contacts/add-contact.js"></script>

@endsection
