<?php

namespace Bolt\Extension\Bolt\Piwik;

use Bolt;

class Extension extends \Bolt\BaseExtension
{
    /**
     * Extensions PHP name
     *
     * @var string
     */
    const NAME = "Piwik";

    public function getName()
    {
        return Extension::NAME;
    }

    public function initialize()
    {
        if ($this->app['config']->getWhichEnd() == 'frontend') {
	    $this->addSnippet('endofhead', 'embedjs');

        }
    }

    /**
     * Returns a string with the javascript to embed
     *
     * @return String
     */
    public function embedjs()
    {
	$PIWIKURL = $this->config['piwikurl'];

	$piwik = "<script type=\"text/javascript\">
	    var _paq = _paq || [];
	    (function(){ var u=((\"https:\" == document.location.protocol) ? \"https://" . $PIWIKURL . "/\" : \"http://" . $PIWIKURL . "/\");
	    _paq.push(['setSiteId', {$IDSITE}]);
	    _paq.push(['setTrackerUrl', u+'piwik.php']);
	    _paq.push(['trackPageView']);
	    _paq.push(['enableLinkTracking']);
	    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript'; g.defer=true; g.async=true; g.src=u+'piwik.js';
	    s.parentNode.insertBefore(g,s); })();
		</script>";
	return $piwik;
    }

}
