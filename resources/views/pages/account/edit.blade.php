{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Edit Akun
                    <div class="text-muted pt-2 font-size-sm">Edit Akun</div>
                </h3>
            </div>
        </div>
        <div class="card-body flex-wrap border-0 pt-6 pb-0">
            <form class="form" id="form">
                <input type="text" value="{{$user->id}}" name="id" style="display: none">
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Nama *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="name_field" class="form-control" name="name" placeholder="Masukkan nama" value="{{$user->name}}"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Username *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" id="username_field" class="form-control" name="username" placeholder="Masukkan username" value="{{$user->username}}"/>
                    </div>
                </div>


                <div class="form-group row" id="passwordContainer" style="display: none">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Password *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="password" id="password_field" class="form-control" name="password" placeholder="Masukkan password"/>
                    </div>
                </div>

                <div class="form-group row" id="passwordConfirmationContainer" style="display: none">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Konfirmasi Password *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="password" id="password_confirmation_field" class="form-control" name="password_confirmation" placeholder="Masukkan password kembali"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Status *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12 pt-3">
                        <div class="form-check radio-inline">
                            <label class="radio radio-outline">
                                <input type="radio" name="status" value="true" {{$user->status ? 'checked="checked"' : ""}}/>
                                <span></span>
                                Aktif
                            </label>
                            <label class="radio radio-outline">
                                <input type="radio" name="status" value="false" {{!$user->status ? 'checked="checked"' : ""}}/>
                                <span></span>
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9 ml-lg-auto mb-3">
                        <button type="button" id="btnSubmit" class="btn btn-primary font-weight-bold mr-2">Simpan
                        </button>
                        <button class="btn btn-primary" type="button" id="btnRubahPassword">Rubah Password</button>
                        <button class="btn btn-danger" type="button" id="btnBatalkanRubahPassword" style="display: none">Batalkan Rubah Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section("scripts")
    <script type="text/javascript">
        const form = document.getElementById('form');
        const passwordValidaton = {
            validators: {
                notEmpty: {
                    message: 'Password harus di isi'
                },
                checkStrength: {
                    message: 'Password minimal 8 karakter',
                    callback: function (input) {
                        return input.value.length >= 8;
                    },
                },
                checkUppercase: {
                    message: 'Password harus kombinasi huruf besar dan kecil',
                    callback: function (input) {
                        return input.value != input.value.toLowerCase();
                    },
                },
                checkLowercase: {
                    message: 'Password harus kombinasi huruf besar dan kecil',
                    callback: function (input) {
                        return input.value != input.value.toUpperCase();
                    },
                },
                checkDigit: {
                    message: 'Password harus mengandung angka',
                    callback: function (input) {
                        return input.value.search(/[0-9]/) >= 0;
                    },
                },
            }
        };
        const passwordConfirmationValidation = {
            validators: {
                identical: {
                    compare: function () {
                        return form.querySelector('[name="password"]').value;
                    },
                    message: 'Konfirmasi password tidak sama dengan password'
                }
            }
        };

        $(document).ready(function () {
            let nameField = $("#name_field");
            let usernameField = $("#username_field");
            let passwordField = $("#password_field");
            let passwordConfirmationField = $("#password_confirmation_field");

            let passwordContainer = $("#passwordContainer");
            let passwordConfirmationContainer = $("#passwordConfirmationContainer");
            let btnRubahPassword = $("#btnRubahPassword");
            let btnBatalkanRubahPassword = $("#btnBatalkanRubahPassword");

            const fv = FormValidation.formValidation(
                form,
                {
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: 'Nama harus di isi'
                                },
                            }
                        },

                        username: {
                            validators: {
                                notEmpty: {
                                    message: 'Nama harus di isi'
                                },
                            }
                        },
                        radios: {
                            validators: {
                                choice: {
                                    min: 1,
                                    message: 'Please kindly check this'
                                }
                            }
                        },
                    },

                    plugins: { //Learn more: https://formvalidation.io/guide/plugins
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        // Validate fields when clicking the Submit button
                        alias: new FormValidation.plugins.Alias({
                            required: 'notEmpty',
                            checkStrength: 'callback',
                            checkUppercase: 'callback',
                            checkLowercase: 'callback',
                            checkDigit: 'callback',
                        }),
                    }
                }
            );

            // Revalidate the confirmation password when changing the password
            form.querySelector('[name="password"]').addEventListener('input', function () {
                fv.revalidateField('password_confirmation');
            });

            $('#btnSubmit').click(function () {
                fv.validate().then(function (status) {
                    if (status === "Valid") {
                        Swal.fire({
                            title: 'Apa anda yakin?',
                            text: "Anda akan memperbarui akun!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                ajaxPost();
                            }
                        })
                    }
                });
            });

            function ajaxPost(){
                $.ajax({
                    url: '{{route("Account.update",['Account' => $user])}}',
                    type: 'PUT',
                    data: $("#form").serialize(),
                    dataType: 'JSON',
                    beforeSend : function () {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'danger',
                            message: 'Tunggu sebentar...'
                        });
                    },
                    success: function (result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Akun berhasil di perbarui',
                            onClose: () => {
                                window.location.href = result.redirect;
                            }
                        })
                    },
                    error : function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ada sesuatu yang salah'
                        })

                        let obj = JSON.parse(xhr.responseText);
                        if (typeof obj.errors !== 'undefined') {
                            setError(obj.errors);
                        }
                    },
                    complete: function(){
                        KTApp.unblockPage();
                    }
                });
            }

            function setError(data){
                if (typeof data.name !== 'undefined') {
                    $.each( data.name, function( key, value ) {
                        nameField.next(".fv-plugins-message-container").append(`
                         <div data-field="name" data-validator="notEmpty" class="fv-help-block">${value}</div>`);
                    });
                }

                if (typeof data.username !== 'undefined') {
                    $.each( data.username, function( key, value ) {
                        usernameField.next(".fv-plugins-message-container").append(`
                         <div data-field="username" data-validator="notEmpty" class="fv-help-block">${value}</div>`);
                    });
                }

                if (typeof data.password !== 'undefined') {
                    $.each( data.password, function( key, value ) {
                        passwordField.next(".fv-plugins-message-container").append(`
                         <div data-field="password" data-validator="notEmpty" class="fv-help-block">${value}</div>`);
                    });
                }

                if (typeof data.password_confirmation !== 'undefined') {
                    $.each( data.password_confirmation, function( key, value ) {
                        passwordConfirmationField.next(".fv-plugins-message-container").append(`
                         <div data-field="password_confirmation" data-validator="notEmpty" class="fv-help-block">${value}</div>`);
                    });
                }

            }

            btnRubahPassword.click(function (){
                fv.addField('password', passwordValidaton).addField('password_confirmation', passwordConfirmationValidation);
                passwordContainer.show();
                passwordField.val(null);
                passwordConfirmationField.val(null);
                passwordConfirmationContainer.show();
                btnRubahPassword.hide();
                btnBatalkanRubahPassword.show();
            });

            btnBatalkanRubahPassword.click(function (){
                fv.removeField('password').removeField('password_confirmation');
                passwordContainer.hide();
                passwordConfirmationContainer.hide();
                btnRubahPassword.show();
                btnBatalkanRubahPassword.hide();
            });
        });
    </script>
@endsection
