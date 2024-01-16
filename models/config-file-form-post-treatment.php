<!--
                       Model
					   
	File : root/models/config-file-reading-short
	"short" : only table with values. No list ol.
	Author : Marc Harnist
	Date : 2020-07-01
	
	Thema
	Display config file constants to edit them
	
-->
<style>
	h3 { margin-top: 20px;}
	.table_constants td { border: 1px dotted white; padding:10px;}
	.table_constants th {
		border: 1px dotted #22609E;
		padding:10px;
		background-color:white;
		color: #22609E!important;
		text-align: center;
	}
</style>

<h3>Print_r Posts</h3>

<pre><?=print_r($_POST)?></pre>

<h3>Var_dump Posts</h3>

<pre><?=var_dump($_POST)?></pre>
