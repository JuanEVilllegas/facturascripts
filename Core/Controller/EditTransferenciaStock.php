<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2017-2019 Carlos Garcia Gomez <carlos@facturascripts.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace FacturaScripts\Core\Controller;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Lib\ExtendedController\EditController;

/**
 * Controller to edit a transfer of stock
 *
 * @author Cristo M. Estévez Hernández  <cristom.estevez@gmail.com>
 * @author Carlos García Gómez          <carlos@facturascripts.com>
 */
class EditTransferenciaStock extends EditController
{

    /**
     * 
     * @return string
     */
    public function getModelClassName()
    {
        return 'TransferenciaStock';
    }

    /**
     * Returns basic page attributes
     *
     * @return array
     */
    public function getPageData()
    {
        $pagedata = parent::getPageData();
        $pagedata['title'] = 'stock-transfer';
        $pagedata['menu'] = 'warehouse';
        $pagedata['icon'] = 'fas fa-exchange-alt';
        $pagedata['showonmenu'] = false;

        return $pagedata;
    }

    /**
     * Load views
     */
    protected function createViews()
    {
        parent::createViews();
        $this->setTabsPosition('bottom');

        $this->addEditListView('EditLineaTransferenciaStock', 'LineaTransferenciaStock', 'lines');
    }

    /**
     * Load view data procedure
     *
     * @param string $viewName
     * @param object $view
     */
    protected function loadData($viewName, $view)
    {
        switch ($viewName) {
            case 'EditTransferenciaStock':
                parent::loadData($viewName, $view);
                if (empty($this->views[$this->active]->model->nick)) {
                    $this->views[$this->active]->model->nick = $this->user->nick;
                }
                break;

            case 'EditLineaTransferenciaStock':
                $idtransferencia = $this->getViewModelValue('EditTransferenciaStock', 'idtrans');
                $where = [new DataBaseWhere('idtrans', $idtransferencia)];
                $view->loadData('', $where, [], 0, 0);
                break;
        }
    }
}
