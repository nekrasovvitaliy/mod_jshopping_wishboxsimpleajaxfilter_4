<?php
	// 
	use Joomla\CMS\HTML\HTMLHelper;
	use Joomla\CMS\Language\Text;
	
	// 
	// 
	if (!file_exists(JPATH_SITE.'/components/com_jshopping/bootstrap.php'))
	{
		// 
		// 
		\JSError::raiseError(500,"Please install component \"joomshopping\"");
    } 
	// 
	// 
    require_once (JPATH_SITE.'/components/com_jshopping/bootstrap.php');
	
	
	/**
	 *
	 */
	class JFormFieldAttributes extends JFormField
	{
		/**
		 *
		 */
		public $type = 'attributes';
		
		
		/**
		 *
		 */
		protected function getInput()
		{
			$jshopConfig = \JSFactory::getConfig(); 
			$db = JFactory::getDBO(); 
			$query = "SELECT attr_id, `name_".$jshopConfig->frontend_lang ."` as name FROM `#__jshopping_attr` ORDER BY attr_ordering";
			$db->setQuery($query);
			$listAttribut = $db->loadObjectList();
			$tmp = new stdClass();  
			$tmp->attr_id = "0";
			$tmp->name = Text::_('JALL');
			$attr_1  = array($tmp);
			$attribut_select =array_merge($attr_1 , $listAttribut);    

			$ctrl  =  $this->name ;
			$ctrl .= '[]'; 
			$value = empty($this->value) ? '0' : $this->value;    
			return HTMLHelper::_('select.genericlist', $attribut_select,$ctrl,'class="inputbox" id = "attribut_ordering" multiple="multiple"','attr_id','name', $value );
		}
	}