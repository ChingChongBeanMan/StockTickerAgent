<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">					
	<div class="jumbotron text-center col-md-12" style="background-image: url(assets/slide.jpg); background-size: 100%;">
		<font color="white"><h1>Stock Ticker</h1></font>
		<ul class="list-inline">
				{menudata}
					<li>
					<button type="button" class="btn btn-primary btn-lg raised">
					<a href={link}><font color="white">{name}</font></a></button>
					</li>
				{/menudata}
			{login-menu}
		</ul>
	</div>
</div>
