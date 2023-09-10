<?php
use DhlAssistant\Wrappers;

class AdminOrdersController extends AdminOrdersControllerCore
{
	
	public function __construct()
	{
		require_once dirname(__FILE__).'/../../../modules/dhlassistant/Core.php';
		parent::__construct();

	    if(Wrappers\ConfigWrapper::Get('IsModuleConfigured') && Wrappers\SourceWrapper::HasUserUsingRight())
        {
            $this->fields_list['module'] = array //'module' - jedno z domyślnie istniejących pól tabeli `orders`, nie używane w oryginalnym kontrolerze
            (
            		'title' => 'DHL',
            		'callback' => 'renderDhlInfo',
            		'width' => 500, //?
            		'orderby' => false,
            		'search' => false,
					'align' => 'text-center',
            		'remove_onclick' => true,
            );
        }
	}


    public function renderDhlInfo($mSth, $aParams)
    {
		//TODO? check carrier_id ?
		//TODO? check not state == sended ?
    	$order_id = (int)$aParams['id_order'];
    	
    	$smarty_params = array
		(
			'dhlassistant_shipment' => null,
			'dhlassistant_sended' => false,
// 			'dhlassistant_label_link' => false,
			'dhlassistant_edit_link' => $this->context->link->getAdminLink('AdminModules').'&configure=dhlassistant&page=Edit&id='.$order_id,
		);
		if (Wrappers\SourceWrapper::HasSourceShipment($order_id))
		{
			/* @var $shipment DataModels\Shipment */
			$shipment = Wrappers\SourceWrapper::GetShipmentForSource($order_id);
			$smarty_params['dhlassistant_sended'] = $shipment->IsSended();
			if ($smarty_params['dhlassistant_sended'])
			{
				$smarty_params['dhlassistant_shipment'] = $shipment;
				//$smarty_params['dhlassistant_label_link'] = Wrappers\ConfigWrapper::Get('BaseUrl').Wrappers\ConfigWrapper::Get('LabelsPath').$shipment->GetLabelFileName();
			}
		}
		else
		{
			$order = new \Order((int)$order_id);
			$address = new \Address((int)$order->id_address_delivery);
			$country = new \Country((int)$address->id_country);
			if (!in_array($country->iso_code, Wrappers\ConfigWrapper::Get('AvailableCountryCodes')))
				return '--';
		}
        $this->context->smarty->assign($smarty_params);
        return $this->context->smarty->fetch(\DhlAssistant\Core::$BASEDIR.'LocalTemplates/AdminOrdersControllerDhlInfo.tpl');
    }
}
?>