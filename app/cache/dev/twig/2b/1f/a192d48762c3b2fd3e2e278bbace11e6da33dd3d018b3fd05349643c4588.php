<?php

/* FBgroupeBundle:Accueil:index.html.twig */
class __TwigTemplate_2b1fa192d48762c3b2fd3e2e278bbace11e6da33dd3d018b3fd05349643c4588 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("FBgroupeBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'cheker_InitFB' => array($this, 'block_cheker_InitFB'),
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
    function goLogIn(){
        window.location.href = \"";
        // line 6
        echo $this->env->getExtension('routing')->getPath("_security_check");
        echo "\";
    } 
    function onFbInit() {
       
        if (typeof(FB) != 'undefined' && FB != null ) {              
            FB.Event.subscribe('auth.statusChange', function(response) {
                if (response.session || response.authResponse) {
               
                   \$(\"#progress\").css( \"visibility\", \"visible\" );
                setTimeout(goLogIn, 500);
                } else {
                    
                alert(\"ggggggggggggggg\");
                    window.location.href = \"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("_security_logout");
        echo "\";
                }
            });    
            
            FB.Event.subscribe('auth.logout', function(response) {
              
                     \$(\"#progress\").css( \"visibility\", \"visible\" );
                    window.location.href = \"";
        // line 26
        echo $this->env->getExtension('routing')->getPath("_security_logout");
        echo "\";
                
            });
        }
    }
    
</script>
";
    }

    // line 34
    public function block_connect($context, array $blocks = array())
    {
        // line 35
        echo "
";
    }

    // line 37
    public function block_content($context, array $blocks = array())
    {
        // line 38
        echo "<p>Bonjour!  Cette application facebook vous permet de recuperer les données d'un groupe facebook</p>

Dans cette application vous allez pouvoir importer pour un groupe facebook: les données d'indentification, les membres avec leurs rôles, les postes publiés, les commentaires et les personnes qui ont aimé chaque poste. 
<br><strong>Veuillez vous connectez avec facebook et donner les permissions à l'application, pour pouvoir commencer </strong><br>

<br>

L'application se base sur votre session facebook, et enregistre les données sur les cookies</center>
";
    }

    public function getTemplateName()
    {
        return "FBgroupeBundle:Accueil:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 38,  90 => 37,  85 => 35,  82 => 34,  70 => 26,  60 => 19,  44 => 6,  40 => 4,  37 => 3,  31 => 2,);
    }
}
