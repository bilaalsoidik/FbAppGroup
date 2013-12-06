<?php

/* FOSFacebookBundle::loginButton.html.twig */
class __TwigTemplate_11a0cac2d51bd135bbf980735946396d9b6b6006361e01ee33212bc0cf9bad47 extends Twig_Template
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
        echo "<div class=\"fb-login-button\" data-show-faces=\"";
        echo twig_escape_filter($this->env, (isset($context["showFaces"]) ? $context["showFaces"] : $this->getContext($context, "showFaces")), "html", null, true);
        echo "\" data-size=\"";
        echo twig_escape_filter($this->env, (isset($context["size"]) ? $context["size"] : $this->getContext($context, "size")), "html", null, true);
        echo "\" data-scope=\"";
        echo twig_escape_filter($this->env, (isset($context["scope"]) ? $context["scope"] : $this->getContext($context, "scope")), "html", null, true);
        echo "\" data-autologoutlink=\"";
        echo twig_escape_filter($this->env, (isset($context["autologoutlink"]) ? $context["autologoutlink"] : $this->getContext($context, "autologoutlink")), "html", null, true);
        echo "\" data-width=\"";
        echo twig_escape_filter($this->env, (isset($context["width"]) ? $context["width"] : $this->getContext($context, "width")), "html", null, true);
        echo "\" data-max-rows=\"";
        echo twig_escape_filter($this->env, (isset($context["maxRows"]) ? $context["maxRows"] : $this->getContext($context, "maxRows")), "html", null, true);
        echo "\"  data-onlogin=\"";
        echo twig_escape_filter($this->env, (isset($context["onlogin"]) ? $context["onlogin"] : $this->getContext($context, "onlogin")), "html", null, true);
        echo "\">
  ";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), "html", null, true);
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "FOSFacebookBundle::loginButton.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 2,  63 => 23,  46 => 12,  35 => 8,  30 => 5,  24 => 3,  22 => 2,  19 => 1,  197 => 69,  190 => 60,  184 => 46,  179 => 39,  174 => 20,  171 => 19,  163 => 14,  157 => 8,  152 => 7,  149 => 6,  144 => 5,  138 => 72,  136 => 69,  127 => 62,  125 => 60,  119 => 57,  107 => 47,  105 => 46,  100 => 43,  98 => 42,  94 => 40,  92 => 39,  75 => 28,  71 => 27,  64 => 23,  61 => 22,  59 => 19,  55 => 17,  53 => 14,  48 => 12,  39 => 10,  33 => 7,  27 => 1,  93 => 38,  90 => 37,  85 => 35,  82 => 34,  70 => 26,  60 => 19,  44 => 11,  40 => 4,  37 => 6,  31 => 2,);
    }
}
