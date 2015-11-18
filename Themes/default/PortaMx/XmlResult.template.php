<?php
/**
* \file XmlPmx.template.php
* XML Respose template.
*
* \author PortaMx - Portal Management Extension
* \author Copyright 2008-2015 by PortaMx corp. - http://portamx.com
* \version 1.54
* \date 18.11.2015
*/

function template_main()
{
	global $context;

	echo '<', '?xml version="1.0" encoding="', $context['character_set'], '"?', '><pmx><![CDATA['. trim($context['xmlpmx']) .']]></pmx>';
}
?>