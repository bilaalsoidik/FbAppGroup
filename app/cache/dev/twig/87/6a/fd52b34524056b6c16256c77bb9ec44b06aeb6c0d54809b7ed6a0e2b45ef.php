<?php

/* FBgroupeBundle:FbGroupeViews:VuesImportPost.html.twig */
class __TwigTemplate_876afd52b34524056b6c16256c77bb9ec44b06aeb6c0d54809b7ed6a0e2b45ef extends Twig_Template
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
        // line 2
        echo " Vous allez recuperer les posts publiés sur le groupe :&nbsp;&nbsp; 
<span class=\"labele\" id=\"nomGroupe\"> </span>.

<br><br> 
<span class=\"labele\"> Mode de recuperation &nbsp;&nbsp;</span>
<select id=\"modesimport\" class=\"c_select\">
   <option> ----------------------------------------------------- </option>
 <option value=1>Tout importer</option>
 <option value=2>Depuis date mise à jour </option>
 <option value=3>Jusqu'à date mise à jour </option>
 <option value=4>Entre deux dates mise à jour </option>
 <option value=5>Entre deux dates de publication </option>
 <option value=6>Depuis date publication </option>
 <option value=7>Jusqu'à date publication </option>
</select>   

<br>
<div id=\"action\">
<div id=\"champ1\">
<label for=\"datedep\" class=\"labele labelImport\"> Depuis le </label>
<input id=\"datedep\" type=\"date\" name=\"datedep\" class=\"text_input ch_import\"> 
<input id=\"timedep\" type=\"time\" name=\"timedep\" class=\"text_input ch_import\"></div>
<div id=\"champ2\"><label for=\"datejus\" class=\"labele labelImport\"> Jusqu'au </label>
<input id=\"datejus\" type=\"date\" name=\"datejus\" class=\"text_input ch_import\"> 
<input id=\"timejus\" type=\"time\" name=\"timejus\" class=\"text_input ch_import\"></div>
<div id=\"champ3\"><label for=\"limit\" class=\"labele labelImport\"> Limite </label>
<input id=\"limitPposts\" type=\"number\" name=\"limit\" class=\"text_input ch_import\"></div>
</div>

<div id=\"progressbar2\" style=\"visibility: hidden; height: 24px;margin-top: 5px;\"><center><div class=\"progress-label2\">Initialisation...</div> </center></div></div>                              

<div id=\"message_progress2\"  > </div>
<div id=\"contDia\" style=\"margin-top: -5px;\"><div id=\"donnespost\">
<div id=\"progressbarJaimes\" style=\"visibility: hidden;height: 24px;margin-top: -5px;\"><center><div class=\"progress-labelJaimes\">En attente...</div> </center></div</div>                              
</div>
<div id=\"message_progressJaimes\"  ></div>
<div id=\"progressbarComment\" style=\"visibility: hidden;height: 24px;margin-top: -5px;\"><center><div class=\"progress-labelComment\">En attente...</div> </center></div</div>                              
</div>
<div id=\"message_progressComment\"  ></div>
 </div>
 </div>
<div id=\"message_final2\"  ></div>

";
    }

    public function getTemplateName()
    {
        return "FBgroupeBundle:FbGroupeViews:VuesImportPost.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 2,);
    }
}
