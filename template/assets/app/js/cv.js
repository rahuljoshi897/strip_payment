$(document).ready(function(){
    activateMenu('cv');
   
});


  
   Dropzone.options.mDropzoneOne = {
      maxFiles:1,
      maxFilesize: 2, // MB
      acceptedFiles:".pdf, .docx, .doc",
      success: function(file, response){
          
          var response =JSON.parse(response);

          if (response.error ==0){
              $(".dz-processing").removeClass("dz-processing").addClass("dz-success");
              $("#myCVLink").attr("href",response.path);
              $("#full_div").show();
             
              
          }
          else{
              $(".data-dz-errormessage").html(response.message);
          }
      }
     
  };