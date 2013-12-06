<?php

/* FBgroupeBundle:FbGroupeViews:InitGroup.html.twig */
class __TwigTemplate_8a84b56a080468fb39b10000ffd63c6761f7163111ff6ab7b2a110980f9f44f5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("FBgroupeBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'scripts_declaration' => array($this, 'block_scripts_declaration'),
            'autresMenus' => array($this, 'block_autresMenus'),
            'connect' => array($this, 'block_connect'),
            'content' => array($this, 'block_content'),
            'flash' => array($this, 'block_flash'),
            'scripts2' => array($this, 'block_scripts2'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FBgroupeBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo "Initialisation de Groupe";
    }

    // line 4
    public function block_scripts_declaration($context, array $blocks = array())
    {
        echo " 
<script type=\"text/javascript\"> 
 function onFbInit() {
       if (typeof(FB) !=='undefined' && FB !== null )
       FB.Event.subscribe('auth.statusChange', function(response) {
           
           if (response.session || response.authResponse){
       
       InialiserRechGroupe();             
       FB.Event.subscribe('auth.logout', function(response2) {
              
                     \$(\"#progress\").css( \"visibility\", \"visible\" );
                    window.location.href = \"";
        // line 16
        echo $this->env->getExtension('routing')->getPath("_security_logout");
        echo "\"; 
            }); 
            }
            });
     FB.getLoginStatus();
    }
    
var GroupeChoisit;
function InialiserRechGroupe(){
      //Recuperation de la liste des groupes à partir de facebook
FB.api(\"/me?fields=groups.fields(name,id,icon,email,privacy,description)\"+
        \"&&access_token=\"+\$.cookie('accessToken'),function(reponse){ 
      if (!reponse || reponse.error) {
       console.log(\"Message d'erreur \"+reponse.error.message);}
   else{
       var tableaugroupes = reponse.groups.data ;
        //On normalise les données pour que l'autocompleteur les reconnaisse car il a besoin de label et de value
var listGroupes=\$.map(tableaugroupes, function(groupe) {
                return {
                label         : groupe.name,//Nom du groupe
                value         : groupe.id,  //Id du groupe
                icone         : groupe.icon,
                email         : groupe.email,
                privacy       : groupe.privacy,
                description   : groupe.description  };});
                                   
     initAutoComlete(listGroupes); }
});
 
  
 
}
    
   function initAutoComlete(listGroupes){
    var actionEnrg=false;
        \$(\"#rechgroup\").autocomplete({
      minLength: 1,
      source   : listGroupes ,
      focus    : function(event,ui){
      \$(\"#rechgroup\").val( ui.item .label);
        return false; 
      },
      select   : function (event, ui){
      \$(\"#progress\").css( \"visibility\", \"visible\" );
      var GroupeChoisit=ui.item;
      
      \$(\"#dialog\").load(\"";
        // line 62
        echo $this->env->getExtension('routing')->getPath("f_bgroupe_getFormGroup");
        echo "\",function(){
                  \$(\"#fb_groupebundle_groupe_id\").val( GroupeChoisit.value);
                  \$(\"#fb_groupebundle_groupe_nom\").val( GroupeChoisit.label);
                  \$(\"#fb_groupebundle_groupe_email\").val( GroupeChoisit.email);
                  \$(\"#fb_groupebundle_groupe_type\").val( GroupeChoisit.privacy);
                  \$(\"#fb_groupebundle_groupe_description\").val( GroupeChoisit.description);
                  \$(\".boutton\").button();
                  \$(\"#progress\").css( \"visibility\", \"hidden\" );
      \$(this).dialog({
      height   : 500,
      width    : 550,
      title:   \" Enregistrement de groupe\",
      modal:    true,
      close:function(){
      },
      show:    {
               effect: \"clip\",
               duration: 400   },
      hide:    {
               effect:\"clip\",
               duration: 600  },
      buttons: {
               \" Enregistrer \": function() {
               \$( \"form\" ).submit();
               actionEnrg=true;
               \$( this ).dialog( \"close\" );
               \$(\"#progress\").css( \"visibility\", \"visible\" );
               },
               \" Annuler \": function() {
               \$( this ).dialog( \"close\" );
               \$(\"#progress\").css( \"visibility\", \"hidden\" );
                 } } });    });
      return false;
               }})
      .data(\"ui-autocomplete\")._renderItem = function( ul, item ) {
      return \$(\"<li>\")
      .append(\"<a><div><img src='\"+item.icone+\"' style=' height: 35px;width: 35px; top: 16px ;float: left; right 10px'/>\"+
              \"<div style=' padding-left:56px;  position: relative; '> \"+ item.label +\" </div> \"+
              \"<div style=' padding-left:56px;  position: relative;  '> Id  groupe : \"+ item.value +\" </div></div></a>\")
      .appendTo(ul); };       };
        
  
 </script>
";
    }

    // line 107
    public function block_autresMenus($context, array $blocks = array())
    {
        // line 108
        echo " 
<!--Menu Groupe-->
<a href=\"";
        // line 110
        echo $this->env->getExtension('routing')->getPath("_security_check");
        echo "\" title=\"Gestion des groupes\" >
<span id=\"groupes\" class=\"menuitem\" > Groupes </span></a> 
 
";
    }

    // line 115
    public function block_connect($context, array $blocks = array())
    {
        // line 116
        echo "
";
        // line 117
        $context["utilisateur"] = $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "utilisateur"), "method");
        // line 118
        echo "
<!-- Données utilisateur après sa connection -->
<!-- Nom de l'utilisateur qui est un lien vers  sa profile facebook -->
<a href=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["utilisateur"]) ? $context["utilisateur"] : $this->getContext($context, "utilisateur")), "link"), "html", null, true);
        echo "\"><span id=\"conn\" class=\"menuitem\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["utilisateur"]) ? $context["utilisateur"] : $this->getContext($context, "utilisateur")), "name"), "html", null, true);
        echo "</span></a>

<!--Photo de profile facebook-->
<img id=\"avatar\" src=\"https://graph.facebook.com/";
        // line 124
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["utilisateur"]) ? $context["utilisateur"] : $this->getContext($context, "utilisateur")), "id"), "html", null, true);
        echo "/picture\" alt=\"photo de profile\"/>  
";
    }

    // line 126
    public function block_content($context, array $blocks = array())
    {
        // line 127
        echo "<!--Contenu-->
<p>Vous êtes bien connecté alors à present choisissez un groupe parmi 
les groupes dont vous êtes membre et que vous voulez importer les 
données, en saisissant un nom de groupe </p> 

<span class=\"labele\"> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
 Rechercher un groupe &nbsp;&nbsp;&nbsp;</span>   <input id=\"rechgroup\" class=\"text_input\" type=\"text\"  value=\" Saisissez le nom d'un groupe\" onfocus=\"this.value=''; \" /> 
 <center></center>
                               
<div id=\"contenudonnes\" style=\"margin-top: 15px;\">
 ";
        // line 137
        $this->displayBlock('flash', $context, $blocks);
        // line 148
        echo "    <ul >
        ";
        // line 149
        $context["i"] = 0;
        // line 150
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["groupes"]) ? $context["groupes"] : $this->getContext($context, "groupes")));
        foreach ($context['_seq'] as $context["_key"] => $context["groupe"]) {
            // line 151
            echo "            
            <li> <div class=\"liengp cl1\"  ><a  href=\"https://www.facebook.com/";
            // line 152
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["groupe"]) ? $context["groupe"] : $this->getContext($context, "groupe")), "id"), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["groupe"]) ? $context["groupe"] : $this->getContext($context, "groupe")), "nom"), "html", null, true);
            echo "</a>  </div>
                 <div class=\"actions cl2\" ><a id=\"importerMembres\" href=\"#1";
            // line 153
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\" onclick=\"importerMembres(";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["groupe"]) ? $context["groupe"] : $this->getContext($context, "groupe")), "id"), "html", null, true);
            echo ",'";
            echo twig_escape_filter($this->env, strtr($this->getAttribute((isset($context["groupe"]) ? $context["groupe"] : $this->getContext($context, "groupe")), "nom"), array("'" => "'")), "html", null, true);
            echo "');\"> Importer les membres</a></div>
                 <div class=\"actions cl1\" ><a id=\"importerPosts\" href=\"#2";
            // line 154
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\" onclick=\"importerPosts( ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["groupe"]) ? $context["groupe"] : $this->getContext($context, "groupe")), "id"), "html", null, true);
            echo " , '";
            echo twig_escape_filter($this->env, strtr($this->getAttribute((isset($context["groupe"]) ? $context["groupe"] : $this->getContext($context, "groupe")), "nom"), array("'" => "'")), "html", null, true);
            echo "');\" > Importer les postes</a> </div>
                 <div class=\"actions cl2\" ><a id=\"suprimerGp\" href=\"#3";
            // line 155
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo "\" onclick=\"supprimerGp(";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["groupe"]) ? $context["groupe"] : $this->getContext($context, "groupe")), "id"), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")), "html", null, true);
            echo ");\" > Supprimer le groupe</a> </div> 
            </li>
            ";
            // line 157
            $context["i"] = ((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) + 1);
            // line 158
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['groupe'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 159
        echo "    </ul>
 
         
</div> 
 <br>
 
<div hidden id=\"dialog\"></div>
 <audio id=\"son\" preload=\"auto\" > <source src=\"";
        // line 166
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/sons/successful.mp3"), "html", null, true);
        echo "\" type=\"audio/wav\"></audio>
 
<div id=\"dialogMembres\">
<br> Vous allez recuperer les membres du groupe :&nbsp;&nbsp; <b> <span id=\"nomGroupe\" />  
</b>&nbsp;vers votre base de données. Ce groupe contient <b><span id=\"nombreMembre\" /> membres </b>.
Le nombre d'administrateur vous le saurez une fois les membres seront tous importés
<br><span class=\"labele\">Limit</span> <input id=\"limit\" type=\"number\" value=\"40\" class=\"text_input ch_import\" /> 
<br>
 <div id=\"progressbar\" style=\"visibility: hidden;height: 24px;margin-top: 5px;\"><center><div class=\"progress-label\">Initialisation...</div> </center></div</div>                              
</div>
<div id=\"message_progress\"  ></div>

<div id=\"message_final\"  ></div>
 </div>
 
 <div id=\"dialogPosts\"> 
 
 </div>

 



";
    }

    // line 137
    public function block_flash($context, array $blocks = array())
    {
        echo "                         
";
        // line 138
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => "note"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 139
            echo "    <center><div id=\"flash\" class=\"labele\" style=\"background-color: azure\">
        ";
            // line 140
            echo twig_escape_filter($this->env, (isset($context["flashMessage"]) ? $context["flashMessage"] : $this->getContext($context, "flashMessage")), "html", null, true);
            echo "
    </div></center> 
        
        
        
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 146
        echo "        
";
    }

    // line 190
    public function block_scripts2($context, array $blocks = array())
    {
        echo " 
 
<script type=\"text/javascript\">
    
var      Vues;
var      champ1;
var      champ2;
var      champ3;
/*const*/IMPORT_TOUT=1;
/*const*/IMPORT_DEPUIS=2; //date de mise à jour
/*const*/IMPORT_JUSQUA=3; //date de mise à jour
/*const*/IMPORT_DEP_JUSQ=4;
/*const*/IMPORT_DEP_JUSQ_DATE_CREAT=5;
/*const*/IMPORT_DEP_DATE_CREAT=6;
/*const*/IMPORT_JUSQ_DATE_CREAT=7; 

/*const*/PROGRESS_MEMBRES=10;
/*const*/PROGRESS_POSTS=20;

var fluxouvert=false;

\$(function(){
    
     setTimeout(function (){
        var options={};
    \$(\"#flash\" ).hide( \"pulsate\", options, 1000);
    },2000);
    \$(\".progress-label\" ).css(\"left\",\"42%\");
 
 
 //=============================================
 //DIALOGUE DES GESTION D'IMPORTATION DES MEMBRES
 //============================================
    progressbarInit=false;
    \$('#dialogMembres').dialog(
            { 
      autoOpen: false,
      height: 380,
      width : 550,
      title:\" Importation des membres d'un groupe\",
      modal: true,
      show: {
        effect: \"clip\",
        duration: 400
      },
      hide:{
          effect:\"clip\",
          duration: 600
           
      },
      buttons: [
        {text:\"Démarer l'importation\",
         id  :\"ok\",
         click: function (){
         
          progressbar = \$( \"#progressbar\" ),
          progressLabel = \$( \".progress-label\" );
         if(!importFini){
             progressbar.css( \"visibility\", \"visible\" );
             if(!progressbarInit){
              progressbar.progressbar({
              value: false,
              max:100,
              change: function() {
              progressLabel.text( progressbar.progressbar( \"value\" ) + \"%\" );
               },
              complete: function() {
             progressLabel.text( \"Accomplit !\" ).css(\"left\",\"42%\");;
              }
          });
          progressbarInit=true;
             }
         \$(\"ok\").attr(\"disabled\", true);
         var limit=\$('#limit').val();
         var  route= \"";
        // line 264
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("import_membres", array("id_groupe" => "id_groupe", "nbrmembre" => "nbrmembre", "limit" => "limit")), "html", null, true);
        // line 266
        echo "\";
         var URL=route.replace('id_groupe',id_groupe_courant)
                       .replace('nbrmembre',nombreMembreGp)
                       .replace('limit',limit);
         
       \$.ajax( {
                   type: \"POST\",
                    url: URL
                }
                    ).done(function(data) {
                     importFini=true;
                     WorkerWSockProgress.postMessage(\"arret\");
                     document.getElementById(\"son\").play();
                     progressbar.progressbar( \"value\",100);
                     \$(\"#message_progress\").html('<img id=\"success\" src=\"";
        // line 280
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/images/succes2.png"), "html", null, true);
        echo "\"/>  '+
                                        ' <p style=\"line-height:52px;margin-left:53px\"> Importation de données fini avec succès </p>');
                     \$(\"#message_final\").html(\"<span class='labele'>\"+data.nbrMembre+\"</span> nouveux membres enregistés\"
                                              +((data.nbrAdmin>0)? \" dont \"+
                                              \"<span class='labele'>\"+data.nbrAdmin+\"</span> administrateurs \":\"\"));
                     var b=data.nbrProgress-data.nbrMembre;
                     if(b>0)\$(\"#message_final\").append(\"<br><span class='labele'>\"+b+\"</span> membres existaient déjà\");
                     \$(\"#ok\").find('.ui-button-text').html(\"  OK  \");
        
                            });
        
         var msg=new Object();
         msg.code=PROGRESS_MEMBRES;
         msg.donnee=new Object();
         msg.donnee.id_groupe=id_groupe_courant;
         message=JSON.stringify(msg); 
         WorkerWSockProgress.postMessage(message);
         
         //cas sans websocket utilisant lew worker et ke polling
        //URL=\"";
        // line 299
        echo $this->env->getExtension('routing')->getPath("membresProgress", array("id_gp" => "id_groupe"));
        echo "\"; 
       // URL=URL.replace(\"id_groupe\",id_groupe_courant);
       // WorkerWSockProgressMb.postMessage(URL);
                           
        }else {
             \$( this ).dialog( \"close\" );
          }
         }
        },    
        { text: \" Annuler \",
          click: function(){ 
          \$( this ).dialog( \"close\" );
          \$(\"#progress\").css( \"visibility\", \"hidden\" );
          \$(\"#message_progress\").html(\"\");
          importFini=true;
          progressbarInit=false;
        }
        }
      ]
      ,open: function( event, ui ) {
          importFini=false;
          \$(\"#progress\").css( \"visibility\", \"hidden\" );
        if (typeof(WorkerWSockProgress) ==='undefined'|| WorkerWSockProgress === null )
           WorkerWSockProgress = new Worker(\"";
        // line 322
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/js/threadRecuperation.js"), "html", null, true);
        echo "\");
          
        if(!fluxouvert){
           WorkerWSockProgress.postMessage(\"demarrer\");
           fluxouvert=true;
           }
           
           WorkerWSockProgress.onmessage = function (event) {
               
           var data=JSON.parse(event.data);
           var progress=data.nbrProgress;
                if(progress>0){
                if(!importFini){
                var val=Math.round((progress/nombreMembreGp)*100);
                if(val>=99)progressbar.progressbar(\"value\",99);
                else progressbar.progressbar(\"value\",val);
                
                var a=data.nbrProgress-data.nbrMembre;
                var message1=\"<span class='labele'>\"+data.nbrMembre+\"</span> sur <span class='labele'>\"+
                              nombreMembreGp+\"</span> membres enregistrés!\";
                var message;
                message=(a>0)?message1+
                             \"<br><span class='labele'>\"+a+\"</span> membres exitaient déjà!\"
                             :message1;
                \$(\"#message_progress\").html(message);
                progressLabel.css(\"left\",\"48%\");}
                
                }
                console.log(\"Message reçu et traité\");
         };
      },
      close:function(event,ui){
           \$(\"#suivi\").text(\"\");
           \$(\"#ok\").find('.ui-button-text').html(\"Démarer l'importation\");
           importFini=true;
           \$(\"#message_progress\").html(\"\");
           \$(\"#message_final\").html(\"\");
           progressbar.progressbar(\"value\",false);
           progressbar.css( \"visibility\", \"hidden\" );
          
          progressLabel.text(\"Initialisation...\");
      }
    });
 
 
 //=============================================
 //=============================================
 //DIALOGUE DES GESTION D'IMPORTATION DES POSTES
 //=============================================
 //=============================================
 progressbar2Init=false;

    \$(\"#dialogPosts\").dialog({
      autoOpen:false,
      height: 500,
      width : 630,
      title:\" Importation des posts du groupe\",
      modal: true,
      open: function( event, ui ) {
           importFini=false;
           encore=false;
          \$(\"#nomGroupe\").text(nomGroupe).addClass(\"labele\");
          \$(\"#progress\").css( \"visibility\", \"hidden\" ); 
          id_post_encour=\"\";
           if (typeof(WorkerWSockProgress) ==='undefined'|| WorkerWSockProgress === null )
           WorkerWSockProgress = new Worker(\"";
        // line 387
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/js/threadRecuperation.js"), "html", null, true);
        echo "\");
        scontenuDia=\$(\"#contDia\");
        messageFinale=\$(\"#message_final2\").detach();
        if(!fluxouvert){
           WorkerWSockProgress.postMessage(\"demarrer\");
           fluxouvert=true;
           }
           
           WorkerWSockProgress.onmessage = function (event) {
               
           if(500===event.data){
               fluxouvert=false;}
           else {
               
           var data=JSON.parse(event.data);
           nbrTotPost=data.nbrTotPost;
           
           var progress=data.nbrProgress;
                if(progress>0){ var message1;
                if(!importFini){
         // {idGroupe,nbrTotPost,idPost,nbrToJaime,nbrJaimeImport,nbrTotComment,
         // nbrComImport,nbrPostImport,nbrProgress}
                 progressbarJaimes.css(\"visibility\",\"visible\");
                 progressbarComment.css(\"visibility\",\"visible\");
                 
                 
                if(MODE_IMPORT===1){
                  message1=\"<span class='labele'>\"+data.nbrPostImport+\"</span> posts recupérés et enregistrés! \";
                  progressLabel2.text( \"En progression ...\" ).css(\"left\",\"42%\");
                
                } else{
                var val=Math.round((progress/nbrTotPost)*100);
                if(val>=99)progressbar2.progressbar(\"value\",99);
                else       progressbar2.progressbar(\"value\",val);
                
                
                  message1=\"<span class='labele'>\"+data.nbrPostImport+\"</span> sur <span class='labele'>\"+
                              nbrTotPost+\"</span> posts recupérés et enregistrés! \";
             
                progressLabel2.css(\"left\",\"48%\");
                }
                var a=progress-data.nbrPostImport;
                var message=(a>0)? message1+
                                   \"<span class='labele'> \"+a+\"</span> posts sur cette requete existaient déjà!\"
                                   :message1;
                \$(\"#message_progress2\").html(message);
                
                if(data.nbrToJaime>0){
                   var valjm=Math.round((data.nbrJaimeImport/data.nbrToJaime)*100);
                   progressbarJaimes.progressbar(\"value\",valjm); 
                   
                  \$(\"#message_progressJaimes\").html(\"<span class='labele'>\"+data.nbrJaimeImport+
                                               \"</span> sur <span class='labele'>\"+data.nbrToJaime+
                                               \"</span> jaimes recupérés et enrgistrés\");    
                 }else
                  if(data.nbrToJaime==0){
                     progressbarJaimes.progressbar(\"value\",0);
                     progressLabelJaimes.text(\" En attente ...\");
                     \$(\"#message_progressJaimes\").text(\"En attente de recupération ..\").css(\"left\",\"37%\");
                 } 
                 else if(data.nbrToJaime==-1){
                     
                     progressbarJaimes.progressbar(\"value\",0);
                     progressLabelJaimes.text(\" O jaimes pour le post\");
                     \$(\"#message_progressJaimes\").text(\"Pas de jaimes pour le post ..\").css(\"left\",\"37%\");
                 } 
                 
                
                 if(data.nbrTotComment>0){
                   var valcom=Math.round((data.nbrComImport/data.nbrTotComment)*100);
                   var valjm=Math.round((data.nbrJaimeImport/data.nbrToJaime)*100);
                   progressbarComment.progressbar(\"value\",valcom);
                   
                   \$(\"#message_progressComment\").html(\"<span class='labele'>\"+data.nbrComImport+
                                               \"</span> sur <span class='labele'>\"+data.nbrTotComment+
                                               \"</span> commentaires recupérés et enrgistrés\");
                 } else
                     if(data.nbrTotComment==0){
                     progressbarComment.progressbar(\"value\",0);
                     progressLabelComment.text(\" En attente ...\").css(\"left\",\"37%\");
                     \$(\"#message_progressComment\").text(\"En attente des reupération ..\");
                 }else if(data.nbrTotComment==-1){
                    
                     progressbarComment.progressbar(\"value\",0);
                     progressLabelComment.text(\" 0 comment pour le post ...\").css(\"left\",\"37%\");;
                     \$(\"#message_progressComment\").text(\"Pas de commentaire pour le post ..\")
                     
                 }
                 
                     
                }
                
                
           }
       }
           console.log(\"Message reçu et traité\");
         };
      },
      close:function(){
         \$(\"#progress\").css( \"visibility\", \"hideen\" );
          \$(\"#suivi\").text(\"\");
           \$(\"#ok2\").find('.ui-button-text').html(\"Démarer l'importation\");
           importFini=true;
           \$(\"#message_progress2\").html(\"\");
           \$(\"#message_final2\").html(\"\");
           progressbar2.progressbar(\"value\",false);
           progressbar2.css( \"visibility\", \"hidden\" );
          
          progressLabel2.text(\"Initialisation...\");
      },
      show: {
        effect: \"clip\",
        duration: 400
      },
      hide:{
          effect:\"clip\",
          duration: 600    
      },
      buttons:[
        { text:\"Démarer l'importation\",
          id  :\"ok2\",
         click: function (){ 
          //progressbar2 = \$( \"#progressbar2\" ),
         // progressLabel2 = \$( \".progress-label2\" );
  
         if(!importFini){
              progressbar2.css( \"visibility\", \"visible\" );
        if(!progressbar2Init){
              progressbar2.progressbar({
              value: false,
              max:100,
              change: function() {
              progressLabel2.text( progressbar2.progressbar( \"value\" ) + \"%\" );
               },
              complete: function() {
              progressLabel2.text( \"Accomplit !\" ).css(\"left\",\"42%\");
              }
          }); 
          progressbarJaimes = \$( \"#progressbarJaimes\" );
          progressLabelJaimes = \$( \".progress-labelJaimes\" );
          progressbarJaimes.progressbar({
              value: false,
              max:100,
              change: function() {
              progressLabelJaimes.text( progressbarJaimes.progressbar( \"value\" ) + \"%\" );
               },
              complete: function() {
              progressLabelJaimes.text( \"Accomplit !\" ).css(\"left\",\"42%\");
              }
          });
       ;
          progressbarComment = \$( \"#progressbarComment\" );
          progressLabelComment = \$( \".progress-labelComment\" );
          progressbarComment.progressbar({
              value: false,
              max:100,
              change: function() {
              progressLabelComment.text( progressbarComment.progressbar( \"value\" ) + \"%\" );
               },
              complete: function() {
              progressLabelComment.text( \"Accomplit !\" ).css(\"left\",\"42%\");
              }
          });
          progressbar2Init=true;
      }
          
         \$(\"ok2\").attr(\"disabled\", true);
             
         if(MODE_IMPORT===IMPORT_TOUT){
 
           route1=\"";
        // line 557
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("importTout", array("id_groupe" => "id_groupe", "MODE_IMPORT" => "MODE_IMPORT", "limit" => "25")), "html", null, true);
        // line 559
        echo "\";
                                        
          var limit=\$(\"#limitPposts\").val();
          
         var URL=route1.replace('id_groupe',id_groupe_courant)
                       .replace('MODE_IMPORT',IMPORT_TOUT)
                       .replace('25',limit);
         \$.ajax({
                   type: \"POST\",
                    url: URL
                }).done(function(data){ 
                // {idGroupe,nbrTotPost,idPost,nbrToJaime,nbrJaimeImport,nbrTotComment,nbrComImport,nbrPostImport,nbrProgress}
                     importFini=true;
                     WorkerWSockProgress.postMessage(\"arret\");
                     document.getElementById(\"son\").play();
                     progressbar2.progressbar( \"value\",100);
                     \$(\"#message_progress2\").html('<img id=\"success\" src=\"";
        // line 575
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/images/succes2.png"), "html", null, true);
        echo "\"/>  '+
                                        ' <p style=\"line-height:52px;margin-left:53px\"> Importation de données fini avec succès </p>');
                     \$(\"#message_final2\").html(\"<span class='labele'>\"+data.nbrPostImport+\"</span> nouveux posts enregistés avec la liste des jaimes et des commentaires\");
                     var b=data.nbrProgress-data.nbrPostImport;
                     if(b>0)\$(\"#message_final2\").append(\"<br><span class='labele'>\"+b+\"</span> posts sur la dernière requete existaient déjà\");
                     \$(\"#ok2\").find('.ui-button-text').html(\"  OK  \");   
                            });

         }else
         if(MODE_IMPORT>=2&&MODE_IMPORT<=7){
         
         //Les valeurs fournis sont à remplacer avec les vrais valeurs
         route2=\"";
        // line 587
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("importPost", array("id_groupe" => "id_groupe", "MODE_IMPORT" => "MODE_IMPORT", "date_depuis" => "date_depuis", "date_jusqua" => "date_jusqua", "limit" => "25")), "html", null, true);
        // line 591
        echo "\";
                                    
         var date_depuis;
         var date_jusqua;
         if(\$(\"#timedep\").val()===\"\")\$(\"#timedep\").val(\"00:00\");
         if(\$(\"#timejus\").val()===\"\")\$(\"#timejus\").val(\"00:00\");
         if(\$(\"#datedep\").val()===\"\")date_depuis=\"null\";
         else date_depuis=\$(\"#datedep\").val()+\"T\"+\$(\"#timedep\").val()+\"+00:00\";
         if(\$(\"#datejus\").val()===\"\")date_jusqua=\"null\";
         else date_jusqua=\$(\"#datejus\").val()+\"T\"+\$(\"#timejus\").val()+\"+00:00\";
         var limit=\$(\"#limitPposts\").val();
         
         var URL2=route2.replace('id_groupe',id_groupe_courant)
                       .replace('MODE_IMPORT',MODE_IMPORT)
                       .replace('date_depuis',date_depuis)
                       .replace('date_jusqua',date_jusqua)
                       .replace('25',limit);
         
         \$.ajax({
                   type: \"POST\",
                    url: URL2,
                    error: function(x, e) {
                  if (x.status == 500) {
                      progressbar2.css( \"visibility\", \"hidden\" );
                  
                   alert('Votre demande est mal formulé');
                  }}
                }).done(function(data){ 
                // {idGroupe,nbrTotPost,idPost,nbrToJaime,nbrJaimeImport,nbrTotComment,nbrComImport,nbrPostImport,nbrProgress}
                     importFini=true;
                     WorkerWSockProgress.postMessage(\"arret\");
                     document.getElementById(\"son\").play();
                     progressbar2.progressbar( \"value\",100);
                     progressbarJaimes.css(\"visibility\",\"hidden\");
                     progressbarComment.css(\"visibility\",\"hidden\");
                     donnesPost=\$(\"#donnespost\").detach();
                     scontenuDia.append(messageFinale); 
                     encore=true; 
                     \$(\"#message_progress2\").html('<img id=\"success\" src=\"";
        // line 629
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/images/succes2.png"), "html", null, true);
        echo "\"/>  '+
                                        ' <p style=\"line-height:52px;margin-left:53px\"> Importation de données fini avec succès </p>');
                     \$(\"#message_final2\").html(\"<span class='labele'>\"+data.nbrPostImport+\"</span> nouveux posts enregistés avec la liste des jaimes et des commentaires\");
                     var b=data.nbrProgress-data.nbrPostImport;
                     if(b>0)\$(\"#message_final2\").append(\"<br><span class='labele'>\"+b+\"</span> posts sur la dernière requete existaient déjà\");
                     \$(\"#ok2\").find('.ui-button-text').html(\"  OK  \");  
                     date_jusqua=date_depuis=\"\";
                            });
         }
        
        //SUIVI DE LA PROGRESSION
         var msg=new Object();
         msg.code=PROGRESS_POSTS;
         msg.donnee=new Object();
         msg.donnee.id_groupe=id_groupe_courant;
         message=JSON.stringify(msg); 
         WorkerWSockProgress.postMessage(message);
       if(encore){
        messageFinale=messageFinale.detach();
         scontenuDia.append(donnesPost);}
        //Ancien méthode
        //var URL3=\"";
        // line 650
        echo $this->env->getExtension('routing')->getPath("postsProgress", array("id_gp" => "id_groupe"));
        echo "\"; 
        //URL3=URL3.replace(\"id_groupe\",id_groupe_courant);
        //ThreadProgressPost.postMessage(URL3);
                           
        }else 
        {
             \$( this ).dialog( \"close\" );
          }
         }
        },    
        { text: \" Annuler \",
          click: function(){ 
          \$( this ).dialog( \"close\" );
          \$(\"#progress\").css( \"visibility\", \"hidden\" );
          \$(\"#message_progress\").html(\"\");
          importFini=true;
          progressbar2Init=false;
        }
        }
      ] 
    });

         
});

function importerMembres(id_groupe,nomGroupe){
           \$(\"#progress\").css( \"visibility\", \"visible\" );
           id_groupe_courant=id_groupe;
           importFini=false;
         
           if (typeof(FB) !=='undefined' && FB !== null ) {  
           FB.api(id_groupe+'?fields=members.fields(id)&&access_token='+\$.cookie('accessToken'), 
           function(reponse){
               if (!reponse || reponse.error) {
            console.log(\"Message d'erreur \"+response.error.message);
                }else{
               nombreMembreGp=reponse.members.data.length;
               
               \$('#nombreMembre').text(nombreMembreGp);
               \$('#nomGroupe').text(nomGroupe);
               \$('#dialogMembres').dialog('open');
               \$('#dialogMembres').css( \"visibility\", \"visible\" );
               
                } 
           });}   
       
      }//FIN IMPORT MEMBRES
      //    
 //importer les postes
function importerPosts(id_groupe,nomGroupe){
     id_groupe_courant=id_groupe;
      
      actionActive=false;
     \$(\"#nomGroupe\").text(nomGroupe).addClass(\"labele\");
     \$(\"#progress\").css( \"visibility\", \"visible\" );     
     
     \$(\"#dialogPosts\").load(\"";
        // line 706
        echo $this->env->getExtension('routing')->getPath("vues_importpost");
        echo "\", function(){
    
        \$(this).children(\"span#nomGroupe\").text(nomGroupe);
        champ1=\$(this).find(\"div#champ1\").detach();
        champ2=\$(this).find(\"div#champ2\").detach();
        champ3=\$(this).find(\"div#champ3\").detach();
        \$(\"#dialogPosts\").dialog(\"open\");
        \$(this).find( \"option\" ).hover(function (){
           \$(this).addClass(\"ui-state-hover\"); 
        });
       \$(this).find(\"select\").change( function (){
           importFini=false;
           
           \$(\"#ok2\").find('.ui-button-text').html(\"Demarrer l'importation\"); 
          progressbar2 = \$( \"#progressbar2\" );
          progressLabel2 = \$( \".progress-label2\" );
          if(!progressbar2Init){
          progressbar2.progressbar({
              value: false,
              max:100,
              change: function() {
              progressLabel2.text( progressbar2.progressbar( \"value\" ) + \"%\" );
               },
              complete: function() {
              progressLabel2.text( \"Accomplit !\" ).css(\"left\",\"42%\");
              }
          });
          progressbarJaimes = \$( \"#progressbarJaimes\" );
          progressLabelJaimes = \$( \".progress-labelJaimes\" );
          progressbarJaimes.progressbar({
              value: false,
              max:100,
              change: function() {
              progressLabelJaimes.text( progressbarJaimes.progressbar( \"value\" ) + \"%\" );
               },
              complete: function() {
              progressLabelJaimes.text( \"Accomplit !\" ).css(\"left\",\"42%\");
              }
          });
       ;
          progressbarComment = \$( \"#progressbarComment\" );
          progressLabelComment = \$( \".progress-labelComment\" );
          progressbarComment.progressbar({
              value: false,
              max:100,
              change: function() {
              progressLabelComment.text( progressbarComment.progressbar( \"value\" ) + \"%\" );
               },
              complete: function() {
              progressLabelComment.text( \"Accomplit !\" ).css(\"left\",\"42%\");
              }
          });
          progressbar2Init=true;
          }
          progressbar2.progressbar(\"value\",false);
          progressbarJaimes.progressbar(\"value\",false);
          progressbarComment.progressbar(\"value\",false);
            \$(\"#message_progress2\").html(\"\");
            \$(\"#message_final2\").html(\"\");
            
            progressbar2.css( \"visibility\", \"hidden\" );
            progressLabel2.text(\"Initialisation...\");
        
           \$(\"select option:selected\").each(function() {
               MODE_IMPORT=parseInt(\$( this ).val());
               
        switch(MODE_IMPORT){
          case 0 : \$(\"#action\").html(\"\");break;

          case IMPORT_TOUT   : \$(\"#action\").html(champ3.html());break;

          case IMPORT_DEPUIS : \$(\"#action\").html(function (){
                               return champ1.html()+ \"<br>\"+champ3.html();
                               }); break;

          case IMPORT_JUSQUA : \$(\"#action\").html(function (){
                                return champ2.html()+ \"<br>\"+champ3.html();
                                 }); break;

          case IMPORT_DEP_JUSQ : \$(\"#action\").html(function (){
                                   return champ1.html()+ \"<br>\"+champ2.html();
                                 }); break;

          case IMPORT_DEP_JUSQ_DATE_CREAT : \$(\"#action\").html(function (){
                                             return champ1.html()+ \"<br>\"+champ2.html();
                                             }); break;

          case IMPORT_DEP_DATE_CREAT : \$(\"#action\").html(function (){
                                       return champ1.html()+ \"<br>\"+champ3.html();
                                        }); break;
          case IMPORT_JUSQ_DATE_CREAT : \$(\"#action\").html(function (){
                                        return champ2.html()+ \"<br>\"+champ3.html();
                                        }); break;
           }
           
         });
       });
        
    } );  
      }


function supprimerGp(id_groupe,item){
   \$(\"#progress\").css( \"visibility\", \"visible\" );
   var route=\"";
        // line 810
        echo $this->env->getExtension('routing')->getPath("f_bgroupe_supprimerGroup", array("idgp" => "a_remplacer"));
        echo "\";
   var url= route.replace('a_remplacer',id_groupe);
   \$.post(url, function( data ) {
         if(data.statu===1){
             \$(\"#progress\").css( \"visibility\", \"hidden\" );
             \$(\"#contenudonnes li:eq(\"+item+\")\").fadeOut();
         }
          }); }
</script>  
    

";
    }

    public function getTemplateName()
    {
        return "FBgroupeBundle:FbGroupeViews:InitGroup.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  982 => 810,  875 => 706,  816 => 650,  792 => 629,  752 => 591,  750 => 587,  735 => 575,  717 => 559,  715 => 557,  542 => 387,  474 => 322,  448 => 299,  426 => 280,  410 => 266,  408 => 264,  330 => 190,  325 => 146,  313 => 140,  310 => 139,  306 => 138,  301 => 137,  273 => 166,  264 => 159,  258 => 158,  256 => 157,  247 => 155,  239 => 154,  231 => 153,  225 => 152,  222 => 151,  217 => 150,  215 => 149,  212 => 148,  210 => 137,  198 => 127,  195 => 126,  189 => 124,  181 => 121,  176 => 118,  174 => 117,  171 => 116,  168 => 115,  160 => 110,  156 => 108,  153 => 107,  105 => 62,  56 => 16,  40 => 4,  34 => 2,);
    }
}
