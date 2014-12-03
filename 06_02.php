<?php

	class Rectangle
	{
		private $x_coord;
		private $y_coord;
		private $width;
		private $height;

		public function __construct($x_coord, $y_coord, $width, $height){
			$this->x_coord = $x_coord;
			$this->y_coord = $y_coord;
			$this->width   = $width;
			$this->height  = $height;
		}
		
		public function getArea()
		{
			return $this->width * $this->height;
		}
			
		public function translate($x, $y)
		{
			$this->x_coord += $x;
			$this->y_coord += $y;
		}
	}
	
	/* �����̍��W��(10, 15)�ŕ�100, ����120��Rectangle���쐬 */
	$my_rect = new Rectangle(10, 15, 100, 120);

	echo $my_rect->getArea();  /* 120000 */

