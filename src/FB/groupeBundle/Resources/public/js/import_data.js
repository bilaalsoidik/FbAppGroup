    /**
     * 
     * @param {bigint} id_group l'Id du groupe dont on veut importer
     * @param {array} urls les adress qui mène aux actions d'importation
     * @returns {undefined}
     */
       function importerMembres(id_group,urls){
            $("#progress").show();
           var actionActive=false;
           var nombreMembre;
           var nomGroupe;
           if (typeof(FB) !=='undefined' && FB !== null ) {  
           FB.api(id_group+'?fields=members.fields(id),name&&access_token='+$.cookie('accessToken'), 
           function(reponse){
               if (!reponse || reponse.error) {
            console.log("Message d'erreur "+response.error.message);
                }else{
               nomGroupe=reponse.name;
               nombreMembre=reponse.members.data.length;
      $('<div/>',{
       html: '<br> Vous allez recuperer les membres du groupe :&nbsp;&nbsp; <b>'+nomGroupe+'  </b> &nbsp;&nbsp; vers votre base de données. Ce groupe contient <b>'+
             nombreMembre+' membres </b>. Le nombre d\'administrateur vous le saurez une fois les membres seront tous importés ',
          
          }).dialog({
      height: 350,
      width : 550,
      title:" Importation de membre de groupe",
      modal: true,
      close:function(){
         if(actionActive) $("#progress").show();
      },
      show: {
        effect: "clip",
        duration: 400
      },
      hide:{
          effect:"clip",
          duration: 600,
           
      },
      buttons: {
        " Démarer l'importation ": function() {
         var actionActive=true;
         
        },
        " Annuler ": function() {
          $( this ).dialog( "close" );
          
        }
      },open: function( event, ui ) {
          $("#progress").hide();
      }
    });
                } 
           });}         
      }

