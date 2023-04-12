<?php

function inline_icon($filename){
	return file_get_contents(get_template_directory() . '/images/' . $filename);
}