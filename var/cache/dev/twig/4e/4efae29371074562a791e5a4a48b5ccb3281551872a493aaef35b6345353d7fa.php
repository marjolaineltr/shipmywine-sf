<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* registration/register-choice.html.twig */
class __TwigTemplate_5fbf584d529ba1a7489a265eabc59f771ef7e8c4f23981c6a099cbb4728ae39a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register-choice.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register-choice.html.twig"));

        // line 1
        echo "<h1 class=\"text-center mt-3 mb-3\">Inscription</h1>

<div class=\"mb-3 text-center\">
    <p>Tout d'abord, nous devons savoir quel type de personne vous êtes :</p>
</div>
<div class=\"row row-cols-1 row-cols-md-3 d-flex justify-content-center\">
    <div class=\"col-8 col-md-3 mb-4\">
        <div class=\"card h-100 border-1\">
            <div class=\"card-body text-center\">
                <a href=\"#\"><i class=\"fas fa-wine-glass picto fa-5x mb-4\"></i></a>
                <h5>
                    <a class=\"title-picto\" href=\"#\">Vendeur</a>
                </h5>
            </div>
        </div>
    </div>
    <div class=\"col-8 col-md-3 mb-4\">
        <div class=\"card h-100 border-1\">
            <div class=\"card-body text-center\">
                <a href=\"#\"><i class=\"fas fa-user-circle picto fa-5x mb-4\"></i></a>
                <h5>
                    <a class=\"title-picto\" href=\"#\">Acheteur</a>
                </h5>
            </div>
        </div>
    </div>

</div>

</div>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "registration/register-choice.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h1 class=\"text-center mt-3 mb-3\">Inscription</h1>

<div class=\"mb-3 text-center\">
    <p>Tout d'abord, nous devons savoir quel type de personne vous êtes :</p>
</div>
<div class=\"row row-cols-1 row-cols-md-3 d-flex justify-content-center\">
    <div class=\"col-8 col-md-3 mb-4\">
        <div class=\"card h-100 border-1\">
            <div class=\"card-body text-center\">
                <a href=\"#\"><i class=\"fas fa-wine-glass picto fa-5x mb-4\"></i></a>
                <h5>
                    <a class=\"title-picto\" href=\"#\">Vendeur</a>
                </h5>
            </div>
        </div>
    </div>
    <div class=\"col-8 col-md-3 mb-4\">
        <div class=\"card h-100 border-1\">
            <div class=\"card-body text-center\">
                <a href=\"#\"><i class=\"fas fa-user-circle picto fa-5x mb-4\"></i></a>
                <h5>
                    <a class=\"title-picto\" href=\"#\">Acheteur</a>
                </h5>
            </div>
        </div>
    </div>

</div>

</div>", "registration/register-choice.html.twig", "/Users/marjolaine/Sites/ship-my-wine-sf/templates/registration/register-choice.html.twig");
    }
}
