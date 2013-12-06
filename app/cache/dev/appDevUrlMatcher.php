<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        // f_bgroupe_accueil
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'f_bgroupe_accueil');
            }

            return array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::indexAction',  '_route' => 'f_bgroupe_accueil',);
        }

        if (0 === strpos($pathinfo, '/Init_Groupes')) {
            // _security_check
            if ($pathinfo === '/Init_Groupes') {
                return array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::login_reussiAction',  '_route' => '_security_check',);
            }

            // f_bgroupe_getFormGroup
            if ($pathinfo === '/Init_Groupes/formGroup') {
                return array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::getFormGroupAction',  '_route' => 'f_bgroupe_getFormGroup',);
            }

            // f_bgroupe_ajouterGroup
            if ($pathinfo === '/Init_Groupes/ajouterGroup') {
                return array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::ajouterGroupAction',  '_route' => 'f_bgroupe_ajouterGroup',);
            }

            // f_bgroupe_supprimerGroup
            if (0 === strpos($pathinfo, '/Init_Groupes/suppGrp') && preg_match('#^/Init_Groupes/suppGrp/(?P<idgp>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'f_bgroupe_supprimerGroup')), array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::supprimerGroupAction',  '_format' => 'json',));
            }

            // FB_importMb
            if ($pathinfo === '/Init_Groupes/importMembre') {
                return array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::supprimerGroupAction',  '_format' => 'json',  '_route' => 'FB_importMb',);
            }

        }

        // _security_logout
        if ($pathinfo === '/logout') {
            return array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::deconnecteAction',  '_route' => '_security_logout',);
        }

        // f_bgroupe_getObjet
        if (0 === strpos($pathinfo, '/donnes') && preg_match('#^/donnes/(?P<id>[^/]+)&(?P<entite>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'f_bgroupe_getObjet')), array (  '_controller' => 'FB\\groupeBundle\\Controller\\AccueilController::getObjetAction',  '_format' => 'json',));
        }

        if (0 === strpos($pathinfo, '/import')) {
            // import_membres
            if (0 === strpos($pathinfo, '/importmembres') && preg_match('#^/importmembres/(?P<id_groupe>[^/]+)&(?P<nbrmembre>[^/]+)&(?:(?P<limit>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'import_membres')), array (  'limit' => 40,  '_controller' => 'FB\\groupeBundle\\Controller\\ImportDataController::importMembresAction',));
            }

            if (0 === strpos($pathinfo, '/importposts')) {
                // importPost
                if (preg_match('#^/importposts/(?P<id_groupe>[^/]+)&(?P<MODE_IMPORT>[^/]+)&(?P<limit>[^/]+)&(?P<date_depuis>[^/]+)&(?:(?P<date_jusqua>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'importPost')), array (  'date_depuis' => NULL,  'date_jusqua' => NULL,  '_controller' => 'FB\\groupeBundle\\Controller\\ImportDataController::importPostsAction',));
                }

                // importTout
                if (preg_match('#^/importposts/(?P<id_groupe>[^/]+)&(?P<MODE_IMPORT>[^/]+)&(?P<limit>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'importTout')), array (  'MODE_IMPORT' => 1,  'date_depuis' => NULL,  'date_jusqua' => NULL,  '_controller' => 'FB\\groupeBundle\\Controller\\ImportDataController::importPostsAction',));
                }

                // postsProgress
                if (0 === strpos($pathinfo, '/importposts/progress') && preg_match('#^/importposts/progress/(?P<id_gp>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'postsProgress')), array (  '_controller' => 'FB\\groupeBundle\\Controller\\ImportDataController::progressPostsAction',));
                }

            }

            // membresProgress
            if (0 === strpos($pathinfo, '/importmembres/progress') && preg_match('#^/importmembres/progress/(?P<id_gp>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'membresProgress')), array (  '_controller' => 'FB\\groupeBundle\\Controller\\ImportDataController::progressMembresAction',));
            }

            // vues_importpost
            if ($pathinfo === '/importposts/vues') {
                return array (  '_controller' => 'FB\\groupeBundle\\Controller\\ImportDataController::sendVuesImportPostAction',  '_route' => 'vues_importpost',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
