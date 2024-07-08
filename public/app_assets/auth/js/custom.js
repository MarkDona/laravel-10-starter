function showModal(modal_id) {
    $(modal_id).modal('show');
}


function sendRequestForNumber() {
    showModal('#requestNumberModal')

    $('#requestForNumberForm').submit(function (e) {
        e.preventDefault();
        var formdata = new FormData(this)
        var url = $(this).attr('action')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                // console.log(res)
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error');
                    })
                } else {
                    toastAlert('success', 'Number Request successful', 'Hurray')
                    refresh()
                }

            }
        });
    });
}


function customerAllNumberRequest(id) {
    showModal('#allPhoneNumberRequest')
    let lists = $('#lists')

    if ($.fn.DataTable.isDataTable(lists)) {
        lists.DataTable().destroy();
    }
    $('#lists tbody').empty();
    lists.DataTable({
        ajax: '/numbers/request/' + id,
        processing: true,
        order: ['0', 'asc'],
        lengthMenu: [
            [10, 25, 50, 100, 250, 500, -1],
            [10, 25, 50, 100, 250, 500, 'All'],
        ],
        columns: [
            {'data': 'number'},
            {'data': 'notes'},
            {
                'data': null,
                render: function(data) {
                    let status = ''
                    if (data.status_id === 'Awaiting Payment') {
                        status = data.status_id + ' | <a href="numbers/buy">Buy now</a>'
                    } else {
                        status = data.status_id
                    }
                    return status
                }
            }
        ]
    })
}


function updatePhoneNumberRequestStatus(id) {
    showModal('#updatePhoneRequestStatusModal')

    $('#updateRequestStatusForm').submit(function (e) {
        e.preventDefault();
        var formdata = new FormData(this)
        formdata.append('_method', 'PUT')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: '/adminsm/phone-numbers/requests/' + id,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                toastAlert('success', 'Request status successfully updated', 'Hurray')
                refresh()
            }
        });
    });
}


function getPlanFeatures(id) {
    showModal('#planFeaturesModal')

    $.ajax({
        type: "get",
        url: '/plan_features/' + id,
        dataType: "json",
        success: function (data) {
            console.log(data);
            let total = JSON.parse(data.options)
            $('#sms_credit').html(numberWithCommas(total.sms_max))
            $('#plan_name').html(data.name)
            $('#plan_price').html(data.currency.code + ' ' +data.price)
        }
    });
}


function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function toastAlert(option, message, title = 'Hurray') {
    toastr[option](message, title)

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}


function refresh() {
    setTimeout(() => {
        location.reload()
    }, 3000);
}

function redirect(path) {
    setTimeout(() => {
        location.replace(path)
    }, 3000);
}



// Administrator Login as customer
$('#loginAsOwnerForm').submit(function (e) {
    e.preventDefault();
    let formdata =  new FormData(this)
    let id = $('#user_id').val()

    $.ajax({
        type: "POST",
        url: '/adminsm/login_as_owner/' + id,
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,
        success: function (res) {
            console.log(res);
            toastAlert('success', 'You have successfully switched to customer account', 'Hurray')
            location.href="/dashboard/"
        }
    });
});


// agent send onboard request
function sendOnboardRequest() {
    showModal('#sendOnboardRequestModal')
    $('#onboardCustomerForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        let url = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error');
                    })
                } else {
                    $('#onboard_customer_btn').attr('disabled', true);
                    toastAlert('success', 'Request successful', 'Hurray')
                    refresh()
                }
            }
        });
    });
}


$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: '/adminsm/onboard/plan/get-plan-list',
        dataType: "json",
        success: function (res) {
            console.log(res);
            $.each(res, function (key, value) {
                $('#plan_bought').append(`<option value="${value.uid}">${value.name + ' - (GHS ' + value.price + ')'}</option>`)
            });
        }
    });
});


$('#plan_bought').change(function () {
    let plan_uid = $(this).val()

    $.ajax({
        type: "GET",
        url: "/adminsm/onboard/plan/" + plan_uid,
        dataType: "json",
        success: function (res) {
            console.log(res)
            let options = JSON.parse(res.options)
            let name = res.name
            let price = res.price
            let sms_max = options.sms_max
            $('#plan_name').val(name)
            $('#sms_max').val(sms_max)
            $('#plan_price').val('GHS ' + price)
            $('#price').val(price)
        }
    });
})



// update onboard Status
function updateOnboardStatus(id) {
    showModal('#updateOnboardStatusModal')

    $('#updateOnboardStatusForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        formdata.append('_method', 'PUT')

        $.ajax({
            type: "POST",
            url: '/adminsm/onboard/' + id + '/update_status',
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res);
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#update_onboard_status_btn')
                    toastAlert('success', 'Status successfully updated');
                    refresh()
                }
            }
        });
    });
}


// view commision
function viewCommission() {
    showModal('#viewCommissionModal')
}


// agent send withdrawal request
function sendWithdrawalRequest() {
    $('#viewCommissionModal').modal('hide')
    showModal('#sendWithdrawalRequestModal')

    $('#sendWithdrawalRequestForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        let url = $(this).attr('action')

        $.ajax({
            type: "post",
            url: url,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#withdrawal_request_btn')
                    toastAlert('success', 'Request successfully sent');
                    redirect('/adminsm/dashboard')
                }
            }
        });
    });
}



function disabledBtn(button_id) {
    $(button_id).attr('disabled', true)
}



function updateWithdrawalRequest(id) {
    showModal('#updateWithdrawalRequestModal')

    $.get('/adminsm/onboard/withdrawal-request/' + id, function (data) {
        console.log(data);
        let agent_name = data.agent.first_name + ' ' + data.agent.last_name
        $('#agent').val(agent_name)
        $('#amount_paid').val(data.amount)
        $('#agent_id').val(data.agent.id)
    });

    $('#updateWithdrawalRequestForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        formdata.append('_method', 'PUT')

        $.ajax({
            type: "POST",
            url: '/adminsm/onboard/withdrawal-request/' + id + '/update_status',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#update_withdrawal_request_btn')
                    toastAlert('success', 'Request successfully sent');
                    refresh()
                }
            }
        });
    });
}



// add new ticket
function addNewTicket() {
    showModal('#addNewTicketModal')

    $('#addNewTicketForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        let url = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    toastAlert('success', 'Ticket successfully added,  our support team will be in-touch shortly');
                    refresh()
                }
            }
        });
    });
}



// view  onboard details
function viewMoreOnboardDetails(id) {
    showModal('#viewOnboardDetails')

    $.get('/adminsm/onboard/' + id + '/get-list', function (data) {
        console.log(data.data);
        $('#dcustomer_name').text(data.data.customer_name)
        $('#agent').text(data.data.agent.first_name + ' ' + data.data.agent.last_name)
        $('#dplan_name').text(data.data.plan_name)
        $('#dplan_price').text(data.data.plan_price)
        $('#dcustomer_email').text(data.data.customer_email)
        $('#dcustomer_phone').text(data.data.customer_phone)
        $('#dnotes').text(data.data.notes)
    });
}



// delete data with sweetalert
function sweetAlertDelete(id, url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            var data = {
                "_token": $('input[name=_token]').val(),
                "id": id
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + id,
                method: "DELETE",
                data: data,
                dataType: 'JSON',
                success: function (response) {
                    Swal.fire({
                        type: "success",
                        title: 'Deleted!',
                        text: response.status,
                        confirmButtonClass: 'btn btn-success',
                    }).then((result) => {
                        location.reload();
                    })
                }
            });

        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text: 'Good Choice ðŸ˜ Your data is safe :)',
                type: 'error',
                confirmButtonClass: 'btn btn-success',
            })
        }
    })
}



// add comments to a ticket
function addTicketCommet(ticket_id) {
    showModal('#replyTicketModal')

    $('#reply_ticket_form').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this);
        formdata.append('_method', 'PUT')

        $.ajax({
            type: "post",
            url: '/adminsm/ticket/' + ticket_id + '/update',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    toastAlert('success', 'Ticket successfully updated');
                    refresh()
                }
            }
        });
    });
}



// view customer agents
function viewAgentCustomers(agent_id) {
    alert(agent_id)
}


// upgrade customer account to agent
function upgradeCustomerAccount(customer_id) {
    showModal('#upgradeCustomerAccount')

    $('#upgradeAccountForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        formdata.append('_method', 'PUT')
        let url = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            contentType: false,
            processData: false,
            cache: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    toastAlert('success', 'Account Ugrade successfull');
                    refresh()
                }
            }
        });
    });
}


function successUpgrade() {
    if ($('#upgrade_text').val() === 'UPGRADE') {
        $('#submitUpgrageBtn').attr('disabled', false)
    } else {
        $('#submitUpgrageBtn').attr('disabled', true)
    }
}


// edit coverage country prices
$('#editCoverageCountryForm').submit(function (e) {
    e.preventDefault();
    let formdata = new FormData(this)
    let url = $(this).attr('action')
    formdata.append('_method', 'PUT')

    $.ajax({
        type: "POST",
        url: url,
        data: formdata,
        contentType: false,
        processData: false,
        cache: false,
        success: function (res) {
            if (res.error) {
                $.each(res.error, function (key, value) {
                    toastAlert('error', value[0], 'Error')
                })
            } else {
                disabledBtn('#editCoverageCountryBtn')
                toastAlert('success', 'Country info successfully updated.');
                refresh()
            }
        }
    });
});



// agent onboard request
function sendAgentOnboardRequest() {
    showModal('#sendAgentOnboardRequestModal')

    $('#onboardAgentForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        let url = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#onboard_agent_btn')
                    toastAlert('success', 'Request successfully saved.');
                    refresh()
                }
            }
        });
    });
}



// view agent onboard Details
function viewMoreAgentOnboardDetails(agent_id) {
    showModal('#viewAgentOnboardDetails')

    $.get('/adminsm/marketer/' + agent_id, function (data) {
        console.log(data.data);
        $('#dagent_name').text(data.data.agent_name)
        $('#dagent_email').text(data.data.agent_email)
        $('#dagent_phone').text(data.data.agent_phone)
        $('#dnotes').text(data.data.notes)
        $('#dstatus').text(data.data.status)
    });
}



// update agent onboard status
function updateAgentOnboardStatus(agent_id) {
    showModal('#updateAgentOnboardStatusModal')

    $('#updateAgentOnboardStatusForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        formdata.append('_method', 'PUT')

        $.ajax({
            type: "post",
            url: '/adminsm/marketer/' + agent_id + '/upate_status',
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#update_agent_onboard_status_btn')
                    toastAlert('success', 'Request successfully updated.');
                    refresh()
                }
            }
        });
    });
}



// markter view commission earned
function marketerCommissionNotification() {
    showModal('#marketeViewCommissionModal')
}


// marketer commission withdrawal request
function marketerSendWithdrawalRequest() {
    $('#marketeViewCommissionModal').modal('hide')
    showModal('#marketerSendWithdrawalRequestModal')


    $('#marketerSendWithdrawalRequestForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        let url = $(this).attr('action')

        $.ajax({
            type: "post",
            url: url,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#withdrawal_request_btn')
                    toastAlert('success', 'Withdrawal Request successfully sent');
                    redirect('/adminsm/dashboard')
                }
            }
        });
    });
}



// update marketer commission withdrawal request
function updateMarketerWithdrawalRequest(id) {
    showModal('#updateMarketerWithdrawalRequestModal');

    $.get('/adminsm/marketer/withdrawal-request/' + id, function (data) {
        console.log(data);
        let marketer_name = data.marketer.first_name + ' ' + data.marketer.last_name
        $('#marketer').val(marketer_name)
        $('#amount_paid').val(data.amount)
        $('#marketer_id').val(data.marketer.id)
    });

    $('#updateMarketerWithdrawalRequestForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        formdata.append('_method', 'PUT')

        $.ajax({
            type: "POST",
            url: '/adminsm/marketer/withdrawal-request/' + id + '/update_status',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#update_marketer_withdrawal_request_btn')
                    toastAlert('success', 'Request successfully updated');
                    refresh()
                }
            }
        });
    });
}



// log user into the email application
$('#emailLoginForm').submit(function (e) {
    e.preventDefault();
    let formdata = new FormData(this);
    let url = $(this).attr('action')

    $.ajax({
        type: "post",
        url: url,
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            console.log(res);
            // if (res) {
            //     location.href ="http://bulkemail2.net/"
            // }
            // refresh()
        }
    });
});



// send sms to customer
function sendCustomerMessage(customer_id) {
    showModal('#sendCustomerMessageModal')

    $('#sendCustomerMessageForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        let url = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                // console.log(res);
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#customer_message_btn')
                    toastAlert('success', 'Message successfully sent.');
                    refresh()
                }
            }
        });
    });
}




// create new uml app
function createNewUMLApp(customer_id) {
    showModal('#createNewUmlAppModal')

    $('#createUmlAppForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        let url = $(this).attr('action')

        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#createUmlAppBtn')
                    toastAlert('success', 'UML App created successfully.');
                    refresh()
                }
            }
        });
    });
}



// edit uml app
function editUmlApp(app_id)  {
    showModal('#editNewUmlAppModal')

    $.get('/uml-apps/' + app_id + '/edit', function (data) {
        // console.log(data);
        $('#eapp_name').val(data.app_name)
        $('#erequest_url').val(data.request_url)

        $('#erequest_method').filter(function () {
            return $(this).val() === $('#erequest_method').val(data.http_method)
        }).attr('selected', true)
    });

    // $.get('/uml-apps/' + app_id + '/phone-number', function (result) {
    //     console.log(result);
    //     // $('#eapp_name').val(data.app_name)
    //     // $('#erequest_url').val(data.request_url)
    // });


    $('#editUmlAppForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        formdata.append('_method', 'PUT')

        $.ajax({
            type: "POST",
            url: '/uml-apps/' + app_id,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#editUmlAppBtn')
                    toastAlert('success', 'UML App successfully updated');
                    refresh()
                }
            }
        });
    });
}



// assign uml app to a number
function assignUmlApp(id) {
    showModal('#assignNewUmlAppModal')

    $.get('/numbers/' + id, function (data) {
        console.log(data);
        $('#anumber').val('+' + data.number)

        $('#eapp_id').filter(function () {
            return $(this).val() === $('#eapp_id').val(data.app_id)
        }).attr('selected', true)
    });


    $('#assignUmlAppForm').submit(function (e) {
        e.preventDefault();
        let formdata = new FormData(this)
        formdata.append('_method', 'PUT')

        $.ajax({
            type: "POST",
            url: '/numbers/' + id + '/assignapp',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.error) {
                    $.each(res.error, function (key, value) {
                        toastAlert('error', value[0], 'Error')
                    })
                } else {
                    disabledBtn('#assignUmlAppBtn')
                    toastAlert('success', 'UML App successfully assigned.');
                    refresh()
                }
            }
        });
    });
}
