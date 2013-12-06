<?php

/* FBgroupeBundle:Accueil:indexLoged.html.twig */
class __TwigTemplate_dedfc186fc2d30920ee4e53a69ba565a997ce6eafec5af8d3951ec3eb3526eed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("FBgroupeBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'cheker_InitFB' => array($this, 'block_cheker_InitFB'),
            'autresMenus' => array($this, 'block_autresMenus'),
            'connect' => array($this, 'block_connect'),
            'content' => array($this, 'block_content'),
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
        echo "Accueil";
    }

    // line 3
    public function block_cheker_InitFB($context, array $blocks = array())
    {
        // line 4
        echo "<script>
    
    function onFbInit() {
       
       if (typeof(FB) !=='undefined' && FB !== null )
       FB.Event.subscribe('auth.statusChange', function(response) {
                 if (response.session || response.authResponse){
       FB.Event.subscribe('auth.logout', function(response2) {
              
                     \$(\"#progress\").css( \"visibility\", \"visible\" );
                    window.location.href = \"";
        // line 14
        echo $this->env->getExtension('routing')->getPath("_security_logout");
        echo "\"; 
            }); 
            }
            });
    }
    
</script>
";
    }

    // line 22
    public function block_autresMenus($context, array $blocks = array())
    {
        // line 23
        echo " 
<!--Menu Groupe-->
<a href=\"";
        // line 25
        echo $this->env->getExtension('routing')->getPath("_security_check");
        echo "\" title=\"Gestion des groupes\" >
<span id=\"groupes\" class=\"menuitem\" > Groupes </span></a> 
 
";
    }

    // line 30
    public function block_connect($context, array $blocks = array())
    {
        // line 31
        echo "
";
        // line 32
        $context["utilisateur"] = $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "utilisateur"), "method");
        // line 33
        echo "
<!-- Données utilisateur après sa connection -->
<!-- Nom de l'utilisateur qui est un lien vers  sa profile facebook -->
<a href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["utilisateur"]) ? $context["utilisateur"] : $this->getContext($context, "utilisateur")), "link"), "html", null, true);
        echo "\"><span id=\"conn\" class=\"menuitem\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["utilisateur"]) ? $context["utilisateur"] : $this->getContext($context, "utilisateur")), "name"), "html", null, true);
        echo "</span></a>

<!--Photo de profile facebook-->
<img id=\"avatar\" src=\"https://graph.facebook.com/";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["utilisateur"]) ? $context["utilisateur"] : $this->getContext($context, "utilisateur")), "id"), "html", null, true);
        echo "/picture\" alt=\"photo de profile\"/>  
";
    }

    // line 42
    public function block_content($context, array $blocks = array())
    {
        // line 43
        echo "<p><strong>Bonjour et Bienvenue !!! </strong> <br>
Cette application facebook vous permet de recuperer les données d'un groupe facebook</p>
Vous allez pouvoir importer pour un groupe facebook: les données d'indentification, les membres avec leurs rôles, les postes publiés, les commentaires et les personnes qui ont aimé chaque poste. <br>
Vous vous êtes bien connecter
<br>

";
    }

    public function getTemplateName()
    {
        return "FBgroupeBundle:Accueil:indexLoged.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 43,  107 => 42,  101 => 39,  93 => 36,  88 => 33,  86 => 32,  83 => 31,  80 => 30,  72 => 25,  68 => 23,  65 => 22,  53 => 14,  41 => 4,  38 => 3,  32 => 2,);
    }
}
