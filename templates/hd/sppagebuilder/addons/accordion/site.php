<?php
/**
 * Flex @package SP Page Builder
 * Template Name - Flex
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2020 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted access');

class SppagebuilderAddonAccordion extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$style = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : 'panel-flex';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
		
		$output   = '';
		$output  = '<div class="sppb-addon sppb-addon-accordion ' . $class . '">';

		if($title) {
			$output .= '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>';
		}

		$output .= '<div class="sppb-addon-content">';
		$output	.= '<div class="sppb-panel-group">';

		foreach ($this->addon->settings->sp_accordion_item as $key => $item) {
			
			// Pixeden icons
			$peicon_name = (isset($item->peicon_name) && $item->peicon_name) ? $item->peicon_name : '';
			// FontAwesome icons
			$fa_icon = (isset($item->icon) && $item->icon) ? $item->icon : '';
			
			$output  .= '<div class="sppb-panel sppb-'. $style .'">';
			$output  .= '<div class="sppb-panel-heading'. (($key == 0) ? ' active' : '') .'">';
			$output  .= '<span class="sppb-panel-title">';

			if ($peicon_name) {
				$output .= '<i class="pe ' . $peicon_name . '"></i>';
			} else {
				if($fa_icon != '') {
				   $output .= '<i class="fa ' . $fa_icon . '"></i>';
				}
			}

			$output  .= $item->title;
			$output  .= '</span>';
			$output  .= '<span class="sppb-toggle-direction">' . (($style != 'panel-flex' && $style != 'panel-default' && $style != 'panel-primary') ? '<i class="fa fa-angle-right"></i>' : '') . '</span>';
			$output  .= '</div>';
			$output  .= '<div class="sppb-panel-collapse"' . (($key != 0) ? ' style="display: none;"' : '') . '>';
			$output  .= '<div class="sppb-panel-body">';
			$output  .= $item->content;
			$output  .= '</div>';
			$output  .= '</div>';
			$output  .= '</div>';
		}

		$output  .= '</div>';
		$output  .= '</div>';
		$output  .= '</div>';

		return $output;
	}

	public function js() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$openitem = (isset($this->addon->settings->openitem) && $this->addon->settings->openitem) ? $this->addon->settings->openitem : '';
		if ($openitem) {
			$js ="jQuery(document).ready(function($){'use strict';
				$( '".$addon_id."' + ' .sppb-addon-accordion .sppb-panel-heading').removeClass('active');
				$( '".$addon_id."' + ' .sppb-addon-accordion .sppb-panel-collapse')." . $openitem . "();
			});";
			return $js;
		}
		return ;
	}

	public static function getTemplate()
	{
		$output = '<div class="sppb-addon sppb-addon-accordion {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title">{{ data.title }}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">
				<div class="sppb-panel-group">
					<# _.each(data.sp_accordion_item, function(accordion_item, key){ #>
						<# var activeClass = ((key == 0 || data.openitem == "show") &&  data.openitem != "hide") ? "active" : ""; #>
						<div class="sppb-panel sppb-{{ data.style }}">
							<div class="sppb-panel-heading {{ activeClass }}">
								<span class="sppb-panel-title">
								
								<# if(accordion_item.peicon_name){ #>
									<i class="pe {{ accordion_item.peicon_name }}"></i>
								<# } else { #>
									<# if(accordion_item.icon != ""){ #>
										<i class="fa {{ accordion_item.icon }}"></i>
									<# } #>
								<# } #>

									{{ accordion_item.title }}
								</span>
								<span class="sppb-toggle-direction"></span>
							</div>
							<# var panelStyle = ((key != 0 || data.openitem == "hide") && data.openitem != "show") ? "display: none;" : ""; #>
							<div class="sppb-panel-collapse" style="{{ panelStyle }}">
								<div class="sppb-panel-body">
									<#
									var htmlContent = "";
									_.each(accordion_item.content, function(content){
										htmlContent += content;
									});
									#>
									{{{ htmlContent }}}
								</div>
							</div>
						</div>
					<# }); #>
				</div>
			</div>
		</div>';
		return $output;
	}

}
