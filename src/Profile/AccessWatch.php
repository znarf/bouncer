<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Profile;

class AccessWatch extends Standard
{

    protected $analyzer;

    protected $logger;

    public function __construct($params)
    {
        $this->analyzer = new \Bouncer\Analyzer\AccessWatch($params);
        $this->logger = new \Bouncer\Logger\AccessWatchHttpLogger($params);
    }

    public function load($bouncer)
    {
        // Load Access Watch analyzer
        $bouncer->registerAnalyzer('identity', array($this->analyzer, 'identityAnalyzer'));

        // Load Default analyzers
        parent::loadAnalyzers($bouncer);

        // If no cache available, try to set up APC
        parent::initCache($bouncer);

        // If no logger available, try to setup Access Watch Logger
        $logger = $bouncer->getLogger();
        if (empty($logger)) {
          $bouncer->setOptions(array('logger' => $this->logger));
        }
    }

}
