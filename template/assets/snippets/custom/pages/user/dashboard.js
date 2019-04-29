function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img')
                .attr('src', e.target.result);
                $("#upload-actions").show();
              
                
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function(){
    activateMenu('dashboard');

$("#img").on("click",function(){
    $("#imgReal").trigger('click');
});

    
    $("#saveimg").on("click",function(){
      
        var file = document.getElementById("imgReal").files[0];
      
        var formData = new FormData();
        formData.append('file',file);
        if (typeof FILESIZE !=='undefined' && FILESIZE!=null){
            if (file.size>FILESIZE){
                bootbox.alert('File is too big!');
                return false;
            }
        }
        var l = Ladda.create(this);
        l.start();
        $.ajax({
            url: 'API/upload_avatar.php', // point to server-side PHP script
            dataType: 'json', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success: function(data){
                if (data.error==1){
                    bootbox.alert(data.message);
                }

                if (data.error==0){
                    bootbox.alert('Picture has been changed');
                    $("#upload-actions").hide();
                    $("#avatarSmall").attr("src",data.path);
                }
           
            }
           
           
            
    }).done(function(){
        l.stop();
    });
    
});




/*END COMMON */
    /* SOCIAL MEDIA FORM */
    $('#socialform').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            facebookvalue: {
               
                url:true
            },
           twittervalue:{
               url:true
           },
            linkedinvalue: {
                url: true
            }
        },
    
      
    
        invalidHandler: function (event, validator) { //display error alert on form submit   
           
            
        },
    
        highlight: function (element) { // hightlight error inputs
            
            console.log(element);
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },
    
        success: function (label) {
        // alert('removed');
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },
    
        errorPlacement: function (error, element) {
            //error.insertAfter(element.closest('.input-icon'));
            error.insertAfter(element.closest('.form-control'));
        },
    
        submitHandler: function (form) {
            //form.submit();
            submitSocialMediaForm();
            
        }
    })
    
    function submitSocialMediaForm(){
        var l = Ladda.create(document.querySelector('#saveSocial'));
        l.start();
        var linkedin = $("#linkedinvalue").val();
        var facebook = $("#facebookvalue").val();
        var twitter = $("#twittervalue").val();
        $.post('API/update_candidate_info.php',{
            'facebook':facebook,
            'twitter':twitter,
            'linkedin':linkedin
        },
            function(data){
                if (data==1){
                    bootbox.alert('Information has been changed');
                    $("#facebooklink").attr("href",facebook);
                    $("#facebooklink").text(facebook);
                    $("#twitterlink").attr("href",twitter);
                    $("#twitterlink").text(twitter);
                    $("#linkedinlink").attr("href",linkedin);
                    $("#linkedinlink").text(linkedin);
                    $("#portlet-config_social_media ").modal('toggle');

                }else{
                    bootbox.alert('OOPS! Something went wrong!');
                }

            }
        ).always(function(){
            l.stop();
        });


        return false;
    }

    
    $('#socialform input').keypress(function (e) {
        if (e.which == 13) {
            if ($('#socialform').validate().form()) {
               $('#socialform').submit();
            }
            return false;
        }
    });
    $("#saveSocial").on('click',function(){
        $('#socialform').submit();
    }

    
);

/*  END OF SM FORM */

/*EDUCATION SECTION  */
var nt = $("#nationalityEdit").val();

$("#nationalityEdit").select2({
    placeholder:'Select nationality'
}).val(nt).trigger('change');


var ctCode = $("#countryCode").val();
$("#countryCode").select2({
    placeholder:'Select code'
}).val(ctCode).trigger('change');

var countr = $("#countryEdit").val();
$("#countryEdit").select2({
    placeholder:'Choose the country'
}).val(countr).trigger('change');


$("#dateofBirthEdit").datepicker({ dateFormat: 'yyyy-mm-dd' })


$('#personalinfo').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        nationalityEdit:{
            required:true
        },
        emailEdit:{
            email:true,
            required:true
        },
        countryCode:{
            required:true
        },
        phone:{
            required:true,
           // phoneUs:true,
           number:true,
            minlength:8
        },
        addressEdit:{
            required:true
        },
        cityEdit:{
            required:true
        },
        countryEdit:{
            required:true
        },
        dateofBirthEdit:{
            required:true
        },
        educationChange:{
            required:true
        },
        editGender:{
            required:true
        }
      
    },

  

    invalidHandler: function (event, validator) { //display error alert on form submit   
       
        
    },

    highlight: function (element) { // hightlight error inputs
       
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    success: function (label) {
    // alert('removed');
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function (error, element) {
        //error.insertAfter(element.closest('.input-icon'));
        error.insertAfter(element.closest('.form-control'));
    },

    submitHandler: function (form) {
        //form.submit();
        submitPersonalInfo();
        
    }
})

function submitPersonalInfo(){
    var l = Ladda.create(document.querySelector('#savePersonal'));
    l.start();
    var email = $("#email").val();
    var nationality = $("#nationalityEdit").val();
    var countryCode = $("#countryCode").val();
    var phone = $("#phone").val();
    var address = $("#addressEdit").val();
    var city = $("#cityEdit").val();
    var country = $("#countryEdit").val();
    var dateofBirth = $("#dateofBirthEdit").val();
    var gender = $("#editGender").val();
    var education = $("#educationChange").val();
    $.post('API/update_candidate_info.php',{
       email:email,
       nationality:nationality,
       code:countryCode,
       phone:phone,
       address:address,
       city:city,
       country:country,
       date_of_birth:dateofBirth,
       gender:gender,
       education:education
    },
        function(data){
            if (data==1){
                bootbox.alert('Information has been changed');
                $(".email-v").text(email);
                $(".nationality-v").text(nationality);
                $(".full-phone-v").text(countryCode+phone);
                $(".address-v").text(address);
                $(".city-v").text(city);
                //console.log(updateValueFromSelect("#countryEdit"));
                $(".county-v").text(updateValueFromSelect("#countryEdit"));
                $(".gender-v").text( updateValueFromSelect("#editGender"));
                $(".education-v").text(education);
                $("#portlet-config_personal_info ").modal('toggle');

            }else{
                bootbox.alert('OOPS! Something went wrong!');
            }

        }
    ).always(function(){
        l.stop();
    });


    return false;
}


$('#personalinfo input').keypress(function (e) {
    if (e.which == 13) {
        if ($('#personalinfo').validate().form()) {
           $('#personalinfo').submit();
        }
        return false;
    }
});
$("#savePersonal").on('click',function(){
    $('#personalinfo').submit();
}


);

/* PROFESSIONAL INFO */


setSelect2Value("#selaryExpCur",'Select currency');
setSelect2Value("#industryList",'Select Industry');
setSelect2Value("#preferredCountry",'Select Country');
setSelect2Value("#totalExperience",'Total Experience');
$("#skills").select2({
    tags: []
});

$('#professionalinfo').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        salaryExpCur:{
            required:true
        },
        salary:{
            required:true,
            number:true
        },
        industryList:{
            required:true
        },
        preferredCountry:{
            required:true
        },
        prefferedCity:{
            required:true
        },
        skills:{
            required:true
        },
        totalExperience:{
            required:true
        }
      
    },

  

    invalidHandler: function (event, validator) { //display error alert on form submit   
       
        
    },

    highlight: function (element) { // hightlight error inputs
       
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    success: function (label) {
    // alert('removed');
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function (error, element) {
        //error.insertAfter(element.closest('.input-icon'));
        error.insertAfter(element.closest('.form-control'));
    },

    submitHandler: function (form) {
        //form.submit();
        submitProfessionalInfo();
        
    }
})

function submitProfessionalInfo(){
    var l = Ladda.create(document.querySelector('#saveProfessional'));
    l.start();
    var skills = $("#skills").val();
    var disignation = $("#designation").val();
    var currency_expectation = $("#selaryExpCur").val();
    var salaryExpectation = $("#salary").val();
    var industry = $("#industryList").val();
    var currentCompany = $("#currentCompany").val();
    var preferredCountry = $("#preferredCountry").val();
    var prefferedCity = $("#prefferedCity").val();
    var totalExperience = $("#totalExperience").val();

    $.post('API/update_candidate_info.php',{
       skills:skills,
       disignation:disignation,
       currency_expectation:currency_expectation,
       salary_expectation: salaryExpectation,
       industry:industry,
       current_company:currentCompany,
       preferred_country:preferredCountry,
       preferred_city:prefferedCity,
       experience:totalExperience
    },
        function(data){
            if (data==1){
                bootbox.alert('Information has been changed');
                $(".designation-v").text(disignation);
                $(".company-v").text(currentCompany);
               
                $(".industry-v").text(updateValueFromSelect("#industryList"));
                $(".salary-v").text(salaryExpectation+" "+currency_expectation);
               
             //  var pr = updateValueFromSelect("#preferredCountry ");
               var v = preferredCountry;
               var pr = $("#preferredCountry option[value='"+preferredCountry+"']").text();
                $(".preferredLocation-v").text(prefferedCity+", "+pr);
                $(".skills-v").text(skills);
                $("#portlet-config_professional_info ").modal('toggle');

            }else{
                bootbox.alert('OOPS! Something went wrong!');
            }

        }
    ).always(function(){
        l.stop();
    });


    return false;
}


$('#professionalinfo input').keypress(function (e) {
    if (e.which == 13) {
        if ($('#professionalinfo').validate().form()) {
           $('#professionalinfo').submit();
        }
        return false;
    }
});
$("#saveProfessional").on('click',function(){
    $('#professionalinfo').submit();
}


);


/*WORK EXPERIENCE */
$("#from, #to").datepicker({ dateFormat: 'yyyy-mm-dd' });

$('#works').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        work_designation:{
            required:true
        },
        resp:{
            required:true
        },
        work_company_name:{
            required:true
        },
        from:{
            required:true
        },
        to:{
            required:true
        }
      
    },

  

    invalidHandler: function (event, validator) { //display error alert on form submit   
       
        
    },

    highlight: function (element) { // hightlight error inputs
       
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    success: function (label) {
    // alert('removed');
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function (error, element) {
        //error.insertAfter(element.closest('.input-icon'));
        error.insertAfter(element.closest('.form-control'));
    },

    submitHandler: function (form) {
        //form.submit();
       submitWorks();
        
    }
})

function submitWorks(){
    var l = Ladda.create(document.querySelector('#saveWorkExperience'));
    l.start();
 
        var work = $("#work_company_name").val();
        var key = $("#resp").val();
        var designition = $("#work_designation").val();
        var from = $("#from").val();
        var to = $("#to").val();
        var id = $("#works_id").val();
        var dataR = {
            work:work,
            key:key,
            designition:designition,
            from:from,
            to:to,
            company:work,
            id:id
        }
        $.post("API/submit_work_experience.php",dataR,function(data){
            if (data!=0){
                if (id === ""){
                bootbox.alert('Work experience has been added!');
                $("#portlet-config_work_experience ").modal('toggle');
                cleanOnModal("#portlet-config_work_experience");
                dataR.id = data;
                drawWorkExperienceTableRow(dataR);
                }else{
                    bootbox.alert('Information has been updated');
                    $("#portlet-config_work_experience ").modal('toggle');
                    $("#w_exp tbody tr[data-idrow='"+id+"'] td.designition").text(designition);
                    $("#w_exp tbody tr[data-idrow='"+id+"'] td.company").text(work);
                    $("#w_exp tbody tr[data-idrow='"+id+"'] td.period").text(from+" - "+to);
                    $("#w_exp tbody tr[data-idrow='"+id+"'] td.resp").text(key);
                }
            }else{
                bootbox.alert('OOPS! Something went wrong!');

            }

        }).always(function(){
            l.stop();
        });

}

$('#works input, #works textarea').keypress(function (e) {
    if (e.which == 13) {
        if ($('#works').validate().form()) {
           $('#works').submit();
        }
        return false;
    }
});
$("#saveWorkExperience").on('click',function(){
    $('#works').submit();
});


/*$(".edit-work").live(function(){
    alert('hello');
});*/
$(document).on('click',".edit-work", function(){
    $("#portlet-config_work_experience ").modal('show');
    var info=getInfoForModal(this)  ;
    
    var id = $(this).data().id;
    var to = $(this).data().to;
    var from = $(this).data().from;
    $("#work_designation").val(info[0]);
    $("#resp").val(info[3]);
    $("#work_company_name").val(info[1]);
    $("#from").val(from);
    $("#to").val(to);
    $("#works_id").val(id*1);
    
});

$("a[href='#portlet-config_work_experience']").on('click',function(){
     cleanOnModal("#portlet-config_work_experience");
     $("#works_id").val(null);
     $("#works").validate().resetForm();
})


/* EDUCATION */

$("#to_education, #from_education").select2({
    placeholder:"choose year"
});

$("#education_qualification").select2({
    placeholder:"choose qualification"
});

$("#education_degree").select2({
    placeholder:"choose degree"
});

$("#education").validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        education_name:{
            required:true
        },
        education_qualification:{
            required:true
        },
        education_name:{
            required:true
        },
        education_degree:{
            required:true
        },
        education_spec:{
            required:true
        },
        from_education:{
            required:true,
        },

        to_education:{
            required:true
        }
      
    },

  

    invalidHandler: function (event, validator) { //display error alert on form submit   
       
        
    },

    highlight: function (element) { // hightlight error inputs
       
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    success: function (label) {
    // alert('removed');
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function (error, element) {
        //error.insertAfter(element.closest('.input-icon'));
        error.insertAfter(element.closest('.form-control'));
    },

    submitHandler: function (form) {
        //form.submit();
       submitEducation();
        
    }
})

function submitEducation(){
    var l = Ladda.create(document.querySelector('#saveEducation'));
    l.start();
   
       
        var id = $("#education_id").val();
        var from = $("#from_education").val();
        var to = $("#to_education").val();
        var university = $("#education_name").val();
        var specialization = $("#education_spec").val();
        var qualification = $("#education_qualification").val();
        var degree = $("#education_degree").val();
        if (typeof specList ==='undefined'){
            specList = [];
        }

        var dataR = {
            from:from,
            to:to,
            university:university,
            specialization:specialization,
            qualification:qualification,
            degree:degree,
            id:id
        }
        $.post("API/submit_education.php",dataR,function(data){
            if (data!=0){
                if (id === ""){
                bootbox.alert('Education has been added!');
                $("#portlet-config_education ").modal('toggle');
                cleanOnModal("#portlet-config_education");
                dataR.id = data;
                drawEducationRow(dataR);
                }else{
                   bootbox.alert('Information has been updated');
                    $("#portlet-config_education ").modal('toggle');
                    $("#education_table tbody tr[data-idrow='"+id+"'] td.insitution_name").text(university);
                    $("#education_table tbody tr[data-idrow='"+id+"'] td.degree").text(specList[degree]);
                    $("#education_table tbody tr[data-idrow='"+id+"'] td.period").text(from+" - "+to);
                   
                }
            }else{
                bootbox.alert('OOPS! Something went wrong!');

            }

        }).always(function(){
            l.stop();
        });
}

$('#education input').keypress(function (e) {
    if (e.which == 13) {
        if ($('#education').validate().form()) {
           $('#education').submit();
        }
        return false;
    }
});
$("#saveEducation").on('click',function(){
    $('#education').submit();
});

$("a[href='#portlet-config_education']").on('click',function(){
    cleanOnModal("#portlet-config_education");
    $("#education").validate().resetForm();
    $("#education_id").val(null);
    $("#education_qualification").select2().val('').trigger('change');
    $("#education_degree").select2().val('').trigger('change');
    $("#from_education").select2().val('').trigger('change');
    $("#to_education").select2().val('').trigger('change');

})

$(document).on('click',".edit-education", function(){
    $("#portlet-config_education ").modal('show');
    var info=getInfoForModal(this)  ;
    
    var id = $(this).data().id;
    var to = $(this).data().to;
    var from = $(this).data().from;
   var qualification = $(this).data().qualification;
   var degree = $(this).data().degree;
   var specialization = $(this).data().specialization;
     $("#education_id").val(id*1);
    $("#education_name").val(info[0]);
    $("#education_qualification").select2().val(qualification).trigger('change');
    $("#education_degree").select2().val(degree).trigger('change');
    $("#education_spec").val(specialization);
    $("#from_education").select2().val(from).trigger('change');
    $("#to_education").select2().val(to).trigger('change');
    
});
});



function drawWorkExperienceTableRow (data){
   
    var row = "<tr data-idrow='"+data.id+"'><td class='designition'>"+data.designition+"</td><td class='company'>"+data.company+"</td><td class='period'>"+data.from+" - "+data.to+"</td><td class='resp'>"+data.key+"</td>";
    row+="<td><button class='btn btn-icon-only btn-danger delete-work' onClick='deleteW("+data.id+")' data-id="+data.id+"><i class='fa fa-trash'></i></button>";
    row+="<button  class='btn btn-icon-only default edit-work' data-from='"+data.from+"' data-to='"+data.to+"'  data-id="+data.id+"><i class='fa fa-edit'></i></button></td></tr>"
    $("#w_exp tbody").append(row);
}

function drawEducationRow(data){
    var degree = data.degree;
    if (typeof specList!=='undefined'){
        degree = specList[data.degree]
    }
    var row = "<tr data-idrow='"+data.id+"'><td class='insitution_name'>"+data.university+"</td>";
    row+="<td class='degree'>"+degree+"</td>";
    row+="<td class='period'>"+data.from+" - "+data.to+"</td>"
    row+="<td><button class='btn btn-icon-only btn-danger delete-education' onClick='deleteE("+data.id+")' data-id="+data.id+"><i class='fa fa-trash'></i></button>";
    row+="<button  class='btn btn-icon-only default edit-education' data-specialization = '"+data.specialization+"' data-degree='"+data.degree+"' data-qualification='"+data.qualification+"' data-from='"+data.from+"' data-to='"+data.to+"'  data-id="+data.id+"><i class='fa fa-edit'></i></button></td></tr>"
    $("#education_table tbody").append(row);
}

function deleteExperienceRow(id){
    $("#w_exp tbody td button[data-id="+id+"]").closest("tr").remove();
}
function deleteW(id){
    bootbox.confirm('Do you want to delete work experience?', function(r){
        if (r){
            $.post('API/delete_work_experience.php',{id:id}, function(data){
                    if (data){
                        deleteExperienceRow(id);
                    }else{
                        bootbox.alert('OOPS! Something went wrong');
                    }
            })
           
        }
    })
}

function deleteEducationRow(id){
    $("#education_table tbody td button[data-id="+id+"]").closest("tr").remove();
}
function deleteE(id){
    bootbox.confirm('Do you want to delete education?', function(r){
        if (r){
            $.post('API/delete_education.php',{id:id}, function(data){
                    if (data){
                        deleteEducationRow(id);
                    }else{
                        bootbox.alert('OOPS! Something went wrong');
                    }
            })
           
        }
    })
}



