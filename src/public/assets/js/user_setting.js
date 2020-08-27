jQuery(document).ready(function () {
    /*
     $('#field_spokenLanguages').keyup(function(){
             var language = $('#field_spokenLanguages').val();
             var lastC = language.charAt(language.length-1);
             if(lastC == ';' || lastC == ',' || lastC == ' ' || lastC == '.'){
                 var newStr = language.substring(0, language.length - 1);
                 var lang = newStr+', ';
                 $('#field_spokenLanguages').val(lang);
             } 
     }); */
    $(".editConactM").click(function () {
        var idContactM = $(this).data('id');
        var nameContactM = $(this).data('name');
        var valueContactM = $(this).data('value');
        $(".input_contact").hide();
        $("#div_add_contact").hide();
        $(".data_contact").show();
        $(".data_contact_" + idContactM).hide();
        $(".input_contact_" + idContactM).show();
        $("#input_nameContact_" + idContactM).focus();
    });


    $(document).on("click", ".btn-submit-contact", function () {
        var idCM = $(this).data('idc');
        var nameCM = $("#input_nameContact_" + idCM).val();
        var valueCM = $("#input_valueContact_" + idCM).val();
        var dataNameCm = $(this).data('name');
        var dataValueCm = $(this).data('value');
        var op = $(this).data('op');
        var ctr = 0;



        if (op == "create") {
            if (nameCM != '' && valueCM != '') {
                $.ajax({
                    url: url1,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "nameContact": nameCM,
                        "valueContact": valueCM,
                        "idContact": idCM,
                        "opContact": op
                    },
                    success: function (data) {
                        if (typeof data.error != "undefined") {
                            $('.span_error_contact').empty().text(data.error).fadeIn(1000).delay(1500).fadeOut(1000);
                        }
                        if (typeof data.success != "undefined") {
                            $('.span_success_contact').empty().text(data.success).fadeIn(1000).delay(1500).fadeOut(1000);
                            $("#div_add_contact").hide();
                            $("#all_contact").append(data.html);
                            $("#div_iconpen_" + data.id).append('<i data-feather="edit-2" data-value="' + data.value + '" data-name="' + data.name + '" data-id="' + data.id + '" class="ml-56 i-pen editConactM" style = "color:#f2a365" ></i>');

                        }
                    }

                });

            } else {
                $('.span_error_contact').empty().text('Les deux champs doivent être remplis !').fadeIn(1000).delay(1500).fadeOut(1000);
            }
        }

        if (op == 'delete') {
            var msg = 'Voulez-vous poursuivre avec la suppression ?'
            ctr = 1;
        }


        if (op == 'update') {
            if (nameCM != dataNameCm || valueCM != dataValueCm) {
                if (nameCM == '' || valueCM == '') {
                    $('.span_error_contact').empty().text('Les deux champs doivent être remplis !').fadeIn(1000).delay(1500).fadeOut(1000);
                } else {
                    var msg = 'Voulez-vous poursuivre avec la modification ?'
                    ctr = 1;
                }
            } else {
                $("#input_nameContact_" + idCM).val(dataNameCm).hide();
                $("#input_valueContact_" + idCM).val(dataValueCm).hide();
                $("#delete_contact_" + idCM).hide();
                $("#update_contact_" + idCM).hide();
                $(".data_contact_" + idCM).show();
            }
        }

        if (ctr == 1) {
            if (confirm(msg)) {
                $.ajax({
                    url: url1,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "nameContact": nameCM,
                        "valueContact": valueCM,
                        "idContact": idCM,
                        "opContact": op

                    },
                    async: true,
                    success: function (data) {
                        if (typeof data.error != "undefined") {
                            $('.span_error_contact').empty().text(data.error).fadeIn(1000).delay(1500).fadeOut(1000);
                        }
                        if (typeof data.success != "undefined") {
                            $('.span_success_contact').empty().text(data.success).fadeIn(1000).delay(1500).fadeOut(1000);
                            if (op == 'delete') {
                                $("#hr_contactM_" + idCM).hide();
                                $("#div_contactM_" + idCM).hide();
                            }
                            if (op == 'update') {
                                $(".label_" + data.id).empty().text(data.name).show();
                                $(".p_" + data.id).empty().text(data.value).show();
                                $("#input_nameContact_" + data.id).val(data.name).hide();
                                $("#input_valueContact_" + data.id).val(data.value).hide();
                                $("#update_contact_" + idCM).data("name", data.name).data("value", data.value).hide();
                                $("#delete_contact_" + idCM).data("name", data.name).data("value", data.value).hide();
                            }
                        }
                    }

                });

            }
        }
    });

    $("#new_contact").click(function () {
        $("#div_add_contact").show();
    });

    function formatDate(value) {

        var dateEN = value;
        var tabEN = dateEN.split('-');
        tabEN.reverse();
        return tabEN.join('-');
    }

    $(window).click(function () {
        if ($("#div_result_skill").is(":visible")) {
            $("#div_result_skill").empty();
            $("#div_result_skill").hide();
        }
    });

    $(".edit-pg, .edit-pm").click(function () {
        var field = $(this).next('input').attr('id');
        var old_value = $(this).next().val();
        $('#div_passwords').hide();
        $('#span_' + field).empty();
        $('#field_' + field).val(old_value).show().focus();
        $('.span_error_' + field).empty();
        $('.span_error_' + field).fadeOut(1000);

    });

/*    $('.edit-pf').click(function () {
        $('#div_Frequence').show();
    });*/

    $('.checkbox_Frequence').change(function () {
        var field = $(this).attr('name');
        if ($(this).is(":checked")) {
            var value = true;
        } else {
            var value = false;
        }
        updateField(field, value)
    });


    $('#edit-pgpw').click(function () {
        $('.input_password').val('');
        $('#span_password').hide();
        $('#div_passwords').show();
    });

    $('#Modifier_pw').click(function () {
        $('.span_error_password').empty();
        var oldPw = $('#old_pw').val();
        var newPw = $('#new_pw').val();
        var newPwc = $('#new_pwc').val();
        var field = "password";
        if (oldPw == '' || newPw == '' || newPwc == '') {
            $('.span_error_password').text('Tous les champs doivent être remplis !');
            $('.span_error_password').fadeIn(1000);
        } else {
            if (newPw.length < 8) {
                $('.span_error_password').text('Le mot de passe doit contenir au mons 8 caractères !');
                $('.span_error_password').fadeIn(1000);
            } else {
                if (newPw != newPwc) {
                    $('.span_error_password').text('Les mots de passe ne sont pas identiques !');
                    $('.span_error_password').fadeIn(1000);
                } else {
                    $.ajax({
                        url: url1,
                        type: "POST",
                        dataType: "json",
                        data: {
                            "check": newPwc,
                            "oldPw": oldPw,
                            "field": field,
                            "value": newPw
                        },
                        async: true,
                        success: function (data) {
                            if (typeof data.erreur != "undefined") {
                                $('.span_error_' + field).text(data.erreur);
                                $('.span_error_' + field).fadeIn(1000);
                            } else {
                                if (typeof data.success != "undefined") {
                                    $('#div_passwords').fadeOut(1000);
                                    $('.span_error_' + field).fadeOut(1000);
                                    $('.span_success_' + field).text('Le mot de passe a été modifié !');
                                    $('.span_error_password').empty();
                                    $('#old_pw').val('');
                                    $('#new_pw').val('');
                                    $('#new_pwc').val('');
                                    $('.span_success_' + field).fadeIn(1000);
                                    $('.span_success_' + field).fadeOut(1000);
                                    $('#span_password').text('************');
                                    $('#span_password').fadeIn(1000);
                                }
                            }

                        }
                    });
                }
            }
        }
    });



    $(".field_hidden").focusout(function () {
        const id_user = $("#input-id").val();
        var field = $(this).attr('id').replace('field_', '');
        var value = $(this).val();
        var old_value = $('#' + field).val();
        //$('#' + field).val(value);
        //$(this).val('').fadeOut(1000);
        //$('#span_' + field).text(value).fadeIn(1000);
        if (value != old_value) {
            updateField(field, value);
        } else {
            cancelUpdate(field, value)
        }
    });

    function cancelUpdate(field, value) {
        if (field == 'birthDate') {
            value = formatDate(value);
        }
        $('.span_error_' + field).empty();
        $('.span_error_' + field).fadeOut(1000);
        $('#span_' + field).text(value);
        $('#field_' + field).val('').hide();
    }

    function updateField(field, value) {
        $.ajax({
            url: url1,
            type: "POST",
            dataType: "json",
            data: {
                "field": field,
                "value": value
            },
            async: true,
            success: function (data) {
                if (typeof data.erreur != "undefined") {
                    $('.span_error_' + field).text(data.erreur);
                    $('.span_error_' + field).fadeIn(1000);
                } else {
                    if (typeof data.success != "undefined") {
                        if (field == 'birthDate') {
                            val = formatDate(value);
                            $('#span_' + field).text(val);
                        } else {
                            $('#span_' + field).text(value);
                        }
                        $('.span_error_' + field).empty();
                        $('.span_error_' + field).fadeOut(1000);
                        $('#' + field).val(value);
                        $('#field_' + field).val('').hide();
                    }
                }


                //alert(data);
                //alert(data.erreur);
                // $('div#ajax-results').html(data.output);

            }
        });
    }
    $('#edit_skill').hide();

    $('#edit_skill_user').click(function () {

        $('#edit_skill').toggle();

    });
    $('#div_skills').show();


    $(document).on("click", "li.li_skill", function () {
        var skill = $(this).text();
        var ids = $(this).attr('id');
        $('#key_skill').val(skill);
        $('#div_result_skill').hide();
        $('#id_skill').val(ids);
    });

    $('#skill_ad').click(function () {

        var idSkill = '';
        if ($(this).attr('id') == 'skill_ad') {
            var nameSkill = $('#key_skill').val();
            var typeOp = 'ad';
            var level = $('#select_level_ad').val();
            idSkill = $('#id_skill').val();

        } else {

        }

        if (nameSkill == '' || level == '') {
            $('.span_error_skills').text("Aucun champ ne doit rester vide !");
            $('.span_error_skills').show();
        } else {
            $('.span_error_skills').empty();
            $('.span_error_skills').hide();

            $.ajax({
                url: url1,
                type: "POST",
                dataType: "json",
                data: {
                    "value": nameSkill,
                    "level": level,
                    "typeOp": typeOp,
                    "field": idSkill
                },
                async: true,
                success: function (data) {
                    if (typeof data.success != "undefined") {

                        $('.span_success_skills').empty();
                        $('.span_success_skills').append(data.success);
                        $('.span_success_skills').fadeIn(1000).delay(1000).fadeOut(1000).empty();
                    } else {
                        $('#div_result_skill').hide();
                        $('.span_success_skills').hide();
                    }
                }
            });
        }

    });




    $('#key_skill').keyup(function () {
        var skill = $('#key_skill').val();
        if (skill != '') {
            $.ajax({
                url: url2,
                type: "POST",
                dataType: "json",
                data: {
                    "value": skill
                },
                async: true,
                success: function (data) {
                    if (typeof data.success != "undefined") {
                        if (data.success != 'success') {
                            $('#div_result_skill').empty();
                            $('#div_result_skill').append(data.success);
                            $('#div_result_skill').show();
                        }
                    } else {
                        $('#div_result_skill').hide();
                    }
                }
            });
        } else {
            $('#div_result_skill').hide();
        }
    });


    $('.boutton_skill_delete, .boutton_skill_update').click(function () {

        if (confirm("êtes-vous sûr d'effectuer cette opération ?")) {
            var idUserSkill = $(this).next().val();
            var op = $(this).next().attr('id');
            var skill = $("#inputTxt_skill_" + idUserSkill).val();
            var level = $("#level_" + idUserSkill).val();
            var ctr = 0;
            if (op == "delete_skill") {
                ctr = 1;
            }
            if (op == "update_skill") {
                if (level != "" && skill != "") {
                    ctr = 1;
                }
            }

            if (ctr == 1) {
                $.ajax({
                    url: url1,
                    type: "POST",
                    dataType: "json",
                    data: {
                        "skill_name": skill,
                        "op": op,
                        "level_skil": level,
                        "idUserSkill": idUserSkill
                    },
                    async: true,
                    success: function (data) {
                        if (typeof data.success != "undefined") {
                            if (data.success != 'success') {
                                if (op == "delete_skill") {
                                    $(".tr_skill_" + idUserSkill).fadeOut(1000);
                                    $(".span_success_skills").empty();
                                    $(".span_success_skills").append(data.success);
                                    $(".span_success_skills").fadeIn(1000).delay(500).fadeOut(1000);
                                }
                                if (op == "update_skill") {
                                    $(".span_success_skills").empty();
                                    $(".span_success_skills").append(data.success);
                                    $(".span_success_skills").fadeIn(1000).delay(500).fadeOut(1000);
                                }
                            }
                        } else {

                        }
                    }
                });
            }
        }

    });



});