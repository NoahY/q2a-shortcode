<?php

	class qa_html_theme_layer extends qa_html_theme_base {

		var $shortcodes = array();

	// init
	
		function doctype() {
			if (qa_opt('shortcode_plugin_enable')) {
				 
				$idx = 0;
				while($idx <= (int)qa_opt('shortcode_plugin_number')) {
					$this->shortcodes[] = array(
						's' => qa_opt('shortcode_plugin_'.$idx.'_search'), 
						'r' => qa_opt('shortcode_plugin_'.$idx.'_replace')
					);
					$idx++;
				}
			}
			qa_html_theme_base::doctype();
		}

	// theme replacement functions

		function q_view_content($q_view)
		{
			if (qa_opt('shortcode_plugin_enable') && isset($q_view['content'])){
				$q_view['content'] = $this->shortcode_replace($q_view['content']);
			}
			qa_html_theme_base::q_view_content($q_view);
		}
		function a_item_content($a_item)
		{
			if (qa_opt('shortcode_plugin_enable') && isset($a_item['content'])) {
				$a_item['content'] = $this->shortcode_replace($a_item['content']);
			}
			qa_html_theme_base::a_item_content($a_item);
		}
		function c_item_content($c_item)
		{
			if (qa_opt('shortcode_plugin_enable') && isset($c_item['content'])) {
				$c_item['content'] = $this->shortcode_replace($c_item['content']);
			}
			qa_html_theme_base::c_item_content($c_item);
		}

		function shortcode_replace($text) {
			
			// remove tags
			
			preg_match_all('/<[^>]+>/', $text, $tags);
			$idx = 0;
			while(preg_match('/<[^>]*[^>0-9][^>]*>/',$text) > 0)
				$text = preg_replace('/<[^>]*[^>0-9][^>]*>/', '<'.($idx++).'>', $text,1);

			// replace shortcode

			foreach($this->shortcodes as $sc) {
				
				$text = str_replace($sc['s'],$sc['r'],$text);
				
			}
			
			// restore tags
			
			foreach($tags[0] as $idx => $tag) {
				$text = str_replace('<'.$idx.'>',$tag,$text);
			}
				
			return $text;
		}
		

	}

