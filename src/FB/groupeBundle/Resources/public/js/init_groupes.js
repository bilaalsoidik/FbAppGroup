/**
 * @param {string} urlFormAjoutGP l'url qui permet 
 * de recuperer le formulaire lors d'un ajout d'un groupe
 * @function InialiserRechGroupe il permet d'initialiser les groupe et la recherche
 */
function InialiserRechGroupe(urlFormAjoutGP){
      //Recuperation de la liste des groupes à partir de facebook
FB.api('me?fields=groups.fields(name,id,icon,email,privacy,description)&&access_token='+$.cookie('accessToken'),function(reponse){ 
      if (!reponse || reponse.error) {
       console.log("Message d'erreur "+reponse.error.message);}
        //On normalise les données pour que l'autocompleteur les reconnaisse car il a besoin de label et de value
var listGroupes=$.map(reponse.groups.data, function(groupe) {
                return {
                label         : groupe.name,//Nom du groupe
                value         : groupe.id,  //Id du groupe
                icone         : groupe.icon,
                email         : groupe.email,
                privacy       : groupe.privacy,
                description   : groupe.description  };});
                                   
     initAutoComlete(listGroupes,urlFormAjoutGP); });}
    
    function initAutoComlete(listGroupes,urlFormAjoutGP){
    var actionEnrg=false;
        $("#rechgroup").autocomplete({
      minLength: 1,
      source   : listGroupes ,
      focus    : function(event,ui){
      $("#rechgroup").val( ui.item .label);
        return false; 
      },
      select   : function (event, ui){
      $("#progress").show();
      var GroupeChoisit=ui.item;
      
      $("#dialog").load(urlFormAjoutGP,function(){
                  $("#fb_groupebundle_groupe_id").val( GroupeChoisit.value);
                  $("#fb_groupebundle_groupe_nom").val( GroupeChoisit.label);
                  $("#fb_groupebundle_groupe_email").val( GroupeChoisit.email);
                  $("#fb_groupebundle_groupe_type").val( GroupeChoisit.privacy);
                  $("#fb_groupebundle_groupe_description").val( GroupeChoisit.description);
                  $(".boutton").button();
                  $("#progress").hide();
      $(this).dialog({
      height   : 500,
      width    : 550,
      title:   " Enregistrement de groupe",
      modal:    true,
      close:function(){
          if(actionEnrg)$("#progress").show();
      },
      show:    {
               effect: "clip",
               duration: 400   },
      hide:    {
               effect:"clip",
               duration: 600  },
      buttons: {
               " Enregistrer ": function() {
               $( "form" ).submit();
               actionEnrg=true;
               $( this ).dialog( "close" );
               },
               " Annuler ": function() {
               $( this ).dialog( "close" );
                 } } });    });
      return false;
               }})
      .data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $("<li>")
      .append("<a><div><img src='"+item.icone+"' style=' height: 35px;width: 35px; top: 16px ;float: left; right 10px'/>"+
              "<div style=' padding-left:56px;  position: relative; '> "+ item.label +" </div> "+
              "<div style=' padding-left:56px;  position: relative;  '> Id  groupe : "+ item.value +" </div></div></a>")
      .appendTo(ul); };       };


