<?php

/* FOSFacebookBundle::initialize.html.twig */
class __TwigTemplate_7ff93832a27899de9301be65af2438b41be7c728e34fdc410805ad1869d112c5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"fb-root\"></div>
";
        // line 2
        if ((!(isset($context["async"]) ? $context["async"] : $this->getContext($context, "async")))) {
            // line 3
            echo "<script type=\"text/javascript\" src=\"http://connect.facebook.net/";
            echo twig_escape_filter($this->env, (isset($context["culture"]) ? $context["culture"] : $this->getContext($context, "culture")), "html", null, true);
            echo "/all.js\"></script>
";
        }
        // line 5
        echo "<script type=\"text/javascript\">
";
        // line 7
        if ((isset($context["async"]) ? $context["async"] : $this->getContext($context, "async"))) {
            // line 8
            echo "window.fbAsyncInit = function() {
";
        }
        // line 10
        echo "  FB.init(";
        echo twig_jsonencode_filter(array("appId" => (isset($context["appId"]) ? $context["appId"] : $this->getContext($context, "appId")), "xfbml" => (isset($context["xfbml"]) ? $context["xfbml"] : $this->getContext($context, "xfbml")), "oauth" => (isset($context["oauth"]) ? $context["oauth"] : $this->getContext($context, "oauth")), "status" => (isset($context["status"]) ? $context["status"] : $this->getContext($context, "status")), "cookie" => (isset($context["cookie"]) ? $context["cookie"] : $this->getContext($context, "cookie")), "logging" => (isset($context["logging"]) ? $context["logging"] : $this->getContext($context, "logging"))));
        echo ");
";
        // line 11
        if ((isset($context["async"]) ? $context["async"] : $this->getContext($context, "async"))) {
            // line 12
            echo "  ";
            echo (isset($context["fbAsyncInit"]) ? $context["fbAsyncInit"] : $this->getContext($context, "fbAsyncInit"));
            echo "
};

(function() {
  var e = document.createElement('script');
  e.src = document.location.protocol + ";
            // line 17
            echo twig_jsonencode_filter(sprintf("//connect.facebook.net/%s/all.js", (isset($context["culture"]) ? $context["culture"] : $this->getContext($context, "culture"))));
            echo ";
  e.async = true;
  document.getElementById('fb-root').appendChild(e);
}());
";
        }
        // line 23
        echo "</script>
";
    }

    public function getTemplateName()
    {
        return "FOSFacebookBundle::initialize.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 23,  46 => 12,  35 => 8,  30 => 5,  24 => 3,  22 => 2,  19 => 1,  197 => 69,  190 => 60,  184 => 46,  179 => 39,  174 => 20,  171 => 19,  163 => 14,  157 => 8,  152 => 7,  149 => 6,  144 => 5,  138 => 72,  136 => 69,  127 => 62,  125 => 60,  119 => 57,  107 => 47,  105 => 46,  100 => 43,  98 => 42,  94 => 40,  92 => 39,  75 => 28,  71 => 27,  64 => 23,  61 => 22,  59 => 19,  55 => 17,  53 => 14,  48 => 12,  39 => 10,  33 => 7,  27 => 1,  93 => 38,  90 => 37,  85 => 35,  82 => 34,  70 => 26,  60 => 19,  44 => 11,  40 => 4,  37 => 6,  31 => 2,);
    }
}
