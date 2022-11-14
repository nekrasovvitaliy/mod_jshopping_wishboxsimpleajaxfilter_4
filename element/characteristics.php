<?php
	// 
	use Joomla\CMS\HTML\HTMLHelper;
	use Joomla\CMS\Language\Text;

	// 
	// 
	if (!file_exists(JPATH_SITE.'/components/com_jshopping/bootstrap.php')){
        \JSError::raiseError(500,"Please install component \"joomshopping\"");
    } 

    require_once (JPATH_SITE.'/components/com_jshopping/bootstrap.php');
    
   
	
	
	/**
	 *
	 */
	class JFormFieldCharacteristics extends JFormField
	{
		/**
		 *
		 */
		public $type = 'characteristics';
		
		/**
		 *
		 */
		protected function getInput()
		{
			// 
			// 
			$jshopConfig = JSFactory::getConfig(); 
			$db = JFactory::getDBO(); 
			$ordering = "ordering";//"G.ordering, F.ordering";
			$query = "SELECT F.id, F.`name_".$jshopConfig->frontend_lang ."` as name, F.allcats, F.type, F.cats, F.ordering, F.`group`, G.`name_".$jshopConfig->frontend_lang ."` as groupname FROM `#__jshopping_products_extra_fields` as F left join `#__jshopping_products_extra_field_groups` as G on G.id=F.group order by ".$ordering;
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			$list = array();
			foreach($rows as $k=>$v){
				$list[$v->id] = $v;
				if ($v->allcats){
					$list[$v->id]->cats = array();
				}else{
					$list[$v->id]->cats = unserialize($v->cats);
				}
			}
			unset($rows);
			$tmp = new stdClass();
			$tmp->id = "0";
			$tmp->name = Text::_('JALL');
			$char_1 = array($tmp);
			$char_select = array_merge($char_1, $list);
			$ctrl  =  $this->name ;
			$ctrl .= '[]'; 
			$value = empty($this->value) ? '0' : $this->value;
			// 
			// 
			return HTMLHelper::_(
									'select.genericlist',
									$char_select,
									$ctrl,
									'class="inputbox" id = "characteristic" multiple="multiple"',
									'id',
									'name',
									$value
								);
		}
	}