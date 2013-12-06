<?php

/* FBgroupeBundle::layout.html.twig */
class __TwigTemplate_29ffdaac2363f291c96814a5f131fbd846d0a6c471a1f272f0a13fda276ea08b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'scripts_declaration' => array($this, 'block_scripts_declaration'),
            'cheker_InitFB' => array($this, 'block_cheker_InitFB'),
            'autresMenus' => array($this, 'block_autresMenus'),
            'connect' => array($this, 'block_connect'),
            'content' => array($this, 'block_content'),
            'scripts2' => array($this, 'block_scripts2'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html xmlns:fb=\"http://www.facebook.com/2008/fbml\">
 <head>
<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />
<title>App Groupe :: ";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 10
        echo "<script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/js/jquery-1.9.1.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/js/jquery-ui-1.10.3.custom.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/js/jquery.cookie.js"), "html", null, true);
        echo "\"></script>

";
        // line 14
        $this->displayBlock('scripts_declaration', $context, $blocks);
        // line 17
        echo " </head>
 <body  >
    ";
        // line 19
        $this->displayBlock('cheker_InitFB', $context, $blocks);
        // line 22
        echo "         
    ";
        // line 23
        echo $this->env->getExtension('facebook')->renderInitialize(array("xfbml" => true, "fbAsyncInit" => "onFbInit();"));
        echo "

    <div id=\"container\">
<header>
<a href=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("f_bgroupe_accueil");
        echo "\">
<img id=\"baniere\" src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/images/FBgroup.png"), "html", null, true);
        echo "\"/></a> 
<!--Le Menu-->
<div id=\"menu\">
<div class=\"internal\">
 <span id=\"trsh1\"> </span>   
 
 <!--Menu Accueil-->
 <a href=\"";
        // line 35
        echo $this->env->getExtension('routing')->getPath("f_bgroupe_accueil");
        echo "\" title=\"Retour à l'accueil\" >
 <span id=\"acc\" class=\"menuitem\" > Accueil </span> </a> <span id=\"trsh2\"> </span>
 
 <!--Place d'autres comme menu Groupes-->
 ";
        // line 39
        $this->displayBlock('autresMenus', $context, $blocks);
        // line 40
        echo " 
 <!--Bouton de connexion facebook-->
 <div id=\"conn\" class=\"menu\"> ";
        // line 42
        echo $this->env->getExtension('facebook')->renderLoginButton(array("autologoutlink" => true, "label" => "Se connecter", "width" => 130, "size" => "xlarge"));
        // line 43
        echo " </div>
 
<!--Elements à afficher après connextion-->
";
        // line 46
        $this->displayBlock('connect', $context, $blocks);
        // line 47
        echo "</div>
</div><!--Fin du menu-->

</header>
<!--les entêtes -->
<div id=\"contenu\">  
<div id=\"intercontenu\"> 
    
<div id=\"content\">
    <div  id=\"progress\" style=\" border: black double medium; visibility: hidden;\">  
<img id=\"progress-img\"   src=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/images/Progression.gif"), "html", null, true);
        echo "\"/> 
En progression...
</div>
";
        // line 60
        $this->displayBlock('content', $context, $blocks);
        // line 62
        echo "

</div>
    </div>
        </div>
</div>

";
        // line 69
        $this->displayBlock('scripts2', $context, $blocks);
        // line 72
        echo "</body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/css/acceuil.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
<link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/FBgroupe/css/Theme/jquery-ui-1.10.3.custom.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
";
    }

    // line 14
    public function block_scripts_declaration($context, array $blocks = array())
    {
        echo " 

";
    }

    // line 19
    public function block_cheker_InitFB($context, array $blocks = array())
    {
        // line 20
        echo "     
    ";
    }

    // line 39
    public function block_autresMenus($context, array $blocks = array())
    {
    }

    // line 46
    public function block_connect($context, array $blocks = array())
    {
        echo " ";
    }

    // line 60
    public function block_content($context, array $blocks = array())
    {
        echo " 
";
    }

    // line 69
    public function block_scripts2($context, array $blocks = array())
    {
        echo " 
         
";
    }

    public function getTemplateName()
    {
        return "FBgroupeBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 69,  190 => 60,  184 => 46,  179 => 39,  174 => 20,  171 => 19,  163 => 14,  157 => 8,  152 => 7,  149 => 6,  144 => 5,  138 => 72,  136 => 69,  127 => 62,  125 => 60,  119 => 57,  107 => 47,  105 => 46,  100 => 43,  98 => 42,  94 => 40,  92 => 39,  75 => 28,  71 => 27,  64 => 23,  61 => 22,  59 => 19,  55 => 17,  53 => 14,  48 => 12,  39 => 10,  33 => 5,  27 => 1,  93 => 38,  90 => 37,  85 => 35,  82 => 34,  70 => 26,  60 => 19,  44 => 11,  40 => 4,  37 => 6,  31 => 2,);
    }
}
