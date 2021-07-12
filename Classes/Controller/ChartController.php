<?php
declare(strict_types=1);

namespace Ps14\Chart\Controller;


/***
 *
 * This file is part of the "Ps14 Chart" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Christian Pschorr <pschorr.christian@gmail.com>
 *
 ***/
/**
 * ChartController
 */
class ChartController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * chartRepository
     * 
     * @var \Ps14\Chart\Domain\Repository\ChartRepository
     */
    protected $chartRepository = null;

    /**
     * @param \Ps14\Chart\Domain\Repository\ChartRepository $chartRepository
     */
    public function injectChartRepository(\Ps14\Chart\Domain\Repository\ChartRepository $chartRepository)
    {
        $this->chartRepository = $chartRepository;
    }

    /**
     * action show
     * 
     * @param \Ps14\Chart\Domain\Model\Chart $chart
     * @return void
     */
    public function showAction(\Ps14\Chart\Domain\Model\Chart $chart)
    {
        $this->view->assign('chart', $chart);
    }
}
