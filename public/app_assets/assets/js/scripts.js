(function (window, undefined) {
  'use strict';

    function modal(id, action) {
        $('#'+id).modal(action)
    }

    function printDiv(printForm) {
        var printContents = document.getElementById(printForm).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        document.body.style.marginTop = "10px";
        window.print();
        document.body.innerHTML = originalContents;
    }

    function back(location) {
        setTimeout(() => {
            window.location.href = location
        }, 3000)
    }

    let _token = $('#_token').val()

// add supervisor
    let add_supervisor = $('#add_supervisor')
    add_supervisor.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: add_supervisor.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){

                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

    // add permission
    let add_permission = $('#addPermissionForm')
    add_permission.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: add_permission.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){

                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

    // assign permission to role
    let assign_permission = $('#assignPermission')
    assign_permission.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: assign_permission.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){

                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

    // edit permission
    let edit_permission = $('#editPermission')
    edit_permission.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: edit_permission.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){

                    toastAlert('success', res.message)
                    redirect('/permissions')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


    // edit role
    let edit_role = $('#editRole')
    edit_role.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: edit_role.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){

                    toastAlert('success', res.message)
                    redirect('/roles')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// add role
    let add_role = $('#addRoleForm')
    add_role.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: add_role.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){

                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

    // assign role
    let assign_role = $('#assign_role')
    assign_role.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator()
        $.ajax({
            url: assign_role.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){

                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


// supervisor upload file
    let supervisor_upload = $('#supervisor_upload')
    supervisor_upload.submit(function (e) {
        e.preventDefault()
        // $('.loading-spinner').show();
        showLoadingIndicator();
        $.ajax({
            url: supervisor_upload.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    // $('.loading-spinner').hide();
                    toastAlert('success', res.message)
                    redirect('/supervisor-all_thesis')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();

                // Handle the error response
                toastAlert('error', 'File uploading failed. Please check and upload it again');
            }
        })

    })


    // admin upload file
    let admins_upload = $('#admins_upload')
    admins_upload.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        // $('.loading-spinner').show();
        $.ajax({
            url: admins_upload.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    // $('.loading-spinner').hide();
                    toastAlert('success', res.message)
                    redirect('/all-thesis')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();

                // Handle the error response
                toastAlert('error', 'File uploading failed. Please check and upload it again');
            }
        })

    })

// add external accessor
    let add_accessor = $('#add_accessor')
    add_accessor.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: add_accessor.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


// add student
    let add_student = $('#add_student')
    add_student.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: add_student.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// add thesis
    let add_thesis = $('#add_thesis')
    add_thesis.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: add_thesis.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


// update accessor
    let update_accessor = $('#update_accessor')
    update_accessor.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: update_accessor.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/external-accessors')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// update thesis
    let update_thesis = $('#update_thesis')
    update_thesis.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: update_thesis.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/all-thesis')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

    // update profile
    let update_profile = $('#update_profile')
    update_profile.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: update_profile.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/update-profile')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// update profile supervisor
    let supervisor_update_profile = $('#supervisor_update_profile')
    supervisor_update_profile.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: supervisor_update_profile.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/supervisor-update-profile')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


    // update password user
    let user_update_password = $('#user_update_password')
    user_update_password.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: user_update_password.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    refresh()
                }
                else if (res.status === 503){
                    toastAlert('error', res.message)
                }
                else if (res.status === 600){
                    toastAlert('error', res.message)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


// update password supervisor
    let supervisor_update_password = $('#supervisor_update_password')
    supervisor_update_password.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: supervisor_update_password.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    redirect('/supervisor-dashboard')
                }
                else if (res.status === 503){
                    toastAlert('error', res.message)
                }
                else if (res.status === 600){
                    toastAlert('error', res.message)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


let supervisor_update_password_profile = $('#supervisor_update_password_profile')
    supervisor_update_password_profile.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: supervisor_update_password_profile.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    refresh()
                }
                else if (res.status === 503){
                    toastAlert('error', res.message)
                }
                else if (res.status === 600){
                    toastAlert('error', res.message)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// update student
    let update_student = $('#update_student')
    update_student.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: update_student.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/all-students')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// update supervisor
    let update_supervisor = $('#update_supervisor')
    update_supervisor.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: update_supervisor.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/all-supervisors')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


// assign accessor
    let assign_accessor = $('#assign_accessor')
    assign_accessor.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: assign_accessor.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/all-thesis')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                // Handle the error response
                toastAlert('error', errorMsg);
            }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// save marks
    let save_marks = $('#save_marks')
    save_marks.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: save_marks.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    refresh()
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


// create admin
    let create_admin = $('#create_admin')
    create_admin.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: create_admin.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 200){
                    toastAlert('success', res.message)
                    redirect('/all-admins')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })


// update admin users
    let update_admin_users = $('#update_admin_users')
    update_admin_users.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: update_admin_users.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    redirect('/all-admins')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// update password

    //update_admin_password
    let update_password = $('#update_password')
    update_password.submit(function (e) {
        e.preventDefault()
        showLoadingIndicator();
        $.ajax({
            url: update_password.attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (res){
                if (res.status === 201){
                    toastAlert('success', res.message)
                    refresh()
                }
                else if (res.status === 503){
                    toastAlert('error', res.message)
                }
                else if (res.status === 600){
                    toastAlert('error', res.message)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Hide the loading spinner on error as well
                // $('.loading-spinner').hide();
                if (jqXHR.status === 422) {
                    // Extract the error messages
                    let errors = jqXHR.responseJSON.errors;
                    let errorMsg = 'Validation Error(s):\n';
                    for (let field in errors) {
                        errors[field].forEach(function (error) {
                            errorMsg += error + '\n';
                        });
                    }
                    // Handle the error response
                    toastAlert('error', errorMsg);
                }
                else {
                    toastAlert('error', 'An error occurred. Please try again.');
                }
            }
        })

    })

// delete
    function deleteAlert(id, url) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'delete',
                    dataType: 'json',
                    data: {id: id, _token: _token},
                    success: function (res) {
                        if (res.status === 200) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                res.message,
                                'success'
                            )
                            refresh()
                        }
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your record is safe :)',
                    'error'
                )
            }
        })
    }
    function showLoadingIndicator() {
        Swal.fire({
            title: 'Loading...',
            text: 'Please wait......',
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }
    function toastAlert(status, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: status,
            title: message
        })
    }

    function refresh() {
        setTimeout(() => location.reload(), 3000)
    }

    function redirect(location) {
        setTimeout(() => window.location.href = location, 3000)
    }

})(window);
