<?php
    class qa_shortcode_admin {

		function allow_template($template)
		{
			return ($template!='admin');
		}

		function option_default($option) {
			
			switch($option) {

			default:
				return null;
			}

		}

		function admin_form(&$qa_content)
		{

		//	Process form input
			$ok = null;

		
			if (qa_clicked('shortcode_plugin_save')) {

				qa_opt('shortcode_plugin_enable',(bool)qa_post_text('shortcode_plugin_enable'));
				qa_opt('shortcode_plugin_number',(int)qa_post_text('shortcode_plugin_number'));

				$idx = 0;
				while($idx <= (int)qa_post_text('shortcode_plugin_number')) {
					qa_opt('shortcode_plugin_'.$idx.'_search',qa_post_text('shortcode_plugin_'.$idx.'_search'));
					qa_opt('shortcode_plugin_'.$idx.'_replace',qa_post_text('shortcode_plugin_'.$idx.'_replace'));
					$idx++;
				}
				
				$ok = qa_lang('admin/options_saved');
			}
			else if (qa_clicked('shortcode_plugin_reset')) {
				foreach($_POST as $i => $v) {
					$def = $this->option_default($i);
					if($def !== null) qa_opt($i,$def);
				}
					
				$idx = 0;
				while($idx <= (int)qa_post_text('shortcode_plugin_number')) {
					qa_opt('shortcode_plugin_'.$idx.'_search','');
					qa_opt('shortcode_plugin_'.$idx.'_replace','');
					$idx++;
				}

				$ok = qa_lang('admin/options_reset');
			}

		// Create the form for display

			$fields = array();


			$fields[] = array(
				'label' => 'Enable Shortcode sites',
				'tags' => 'NAME="shortcode_plugin_enable"',
				'value' => qa_opt('shortcode_plugin_enable'),
				'type' => 'checkbox',
			);
				
			$fields[] = array(
				'type' => 'blank',
			);

			$sections = '<div id="qa-shortcode-plugin-sections">';

			$idx = 0;
			while(qa_opt('shortcode_plugin_'.$idx.'_url')) {
				$sections .='
<table id="qa-shortcode-plugin-section-table-'.$idx.'" width="100%">
	<tr>
		<td>
			<b>Shortcode #'.($idx+1).' search:</b><br/>
			<input class="qa-form-tall-text" type="text" value="'.qa_opt('shortcode_plugin_'.$idx.'_search').'" id="shortcode_plugin_'.$idx.'_search" name="shortcode_plugin_'.$idx.'_search"><br/><br/>
			<b>Shortcode #'.($idx+1).' replace (relative to url):</b><br/>
			<input class="qa-form-tall-text" type="text" value="'.qa_opt('shortcode_plugin_'.$idx.'_replace').'" id="shortcode_plugin_'.$idx.'_replace" name="shortcode_plugin_'.$idx.'_replace"><br/><br/>
		</td>
	</tr>
</table>
<hr/>';

				$idx++;
			}
			$sections .= '</div>';

			$fields[] = array(
				'type' => 'static',
				'value' => $sections
			);


			$fields[] = array(
				'type' => 'static',
				'value' =>'
<script>
	var next_shortcode_entry = '.$idx.'; 
	function addShortcode(){
		jQuery("#qa-shortcode-plugin-sections").append(\'<table id="qa-shortcode-plugin-section-table-\'+next_shortcode_entry+\'" width="100%"><tr><td><b>Shortcode #\'+(next_shortcode_entry+1)+\' search:</b><br/><input class="qa-form-tall-text" type="text" value="" id="shortcode_plugin_\'+next_shortcode_entry+\'_search" name="shortcode_plugin_\'+next_shortcode_entry+\'_search"><br/><br/><b>Shortcode #\'+(next_shortcode_entry+1)+\' replace:</b><br/><input class="qa-form-tall-text" type="text" value="" id="shortcode_plugin_\'+next_shortcode_entry+\'_replace" name="shortcode_plugin_\'+next_shortcode_entry+\'_replace"><br/><br/></td></tr></table><hr/>\');
		
		next_shortcode_entry++;
		jQuery("input[name=shortcode_plugin_number]").val(next_shortcode_entry);
	}
</script>
<input type="button" value="add" onclick="addShortcode()">'
			);

			return array(           
				'ok' => ($ok && !isset($error)) ? $ok : null,
					
				'fields' => $fields,
				
				'hidden' => array(
					'shortcode_plugin_number' => $idx
				),
				 
				'buttons' => array(
					array(
					'label' => qa_lang_html('main/save_button'),
					'tags' => 'NAME="shortcode_plugin_save"',
					),
					array(
					'label' => qa_lang_html('admin/reset_options_button'),
					'tags' => 'NAME="shortcode_plugin_reset"',
					),
				),
			);
		}
    }