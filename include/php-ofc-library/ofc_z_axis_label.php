<?php

/**
 * z_axis_label see z_axis_labels
 */
class z_axis_label
{
	function z_axis_label( $z, $text)
	{
		$this->z = $z;
		$this->set_text( $text );
	}
	
	function set_text( $text )
	{
		$this->text = $text;
	}
	
	function set_colour( $colour )
	{
		$this->colour = $colour;
	}
	
	function set_size( $size )
	{
		$this->size = $size;
	}
	
	function set_rotate( $rotate )
	{
		$this->rotate = $rotate;
	}
	
	function set_vertical()
	{
		$this->rotate = "vertical";
	}
}