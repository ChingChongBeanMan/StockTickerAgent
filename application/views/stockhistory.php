<script type="text/javascript" src="/scripts/dropdown.js" ></script>
<font color="1394BF"><h1 style="margin:auto; text-align:center;">Current Stock: {intro}</h1></font>
</br>

<select class="styled-select" id="historydropdown">
    <option>Select A Stock</option>
    {dropdown}
</select>
</br>

<div id="content">
	<div class="jumbotron text-center col-md-12 bb">
		<div class ="col-xl-12 col-md-12">
			<font color="white"><h2 class="sub-header text-center">Recent Transactions</h2></font>
			<div class="CSSTableGenerator">
				<table>
					<tr>
						<td>Time</td>
						<td>Player</td>
						<td>Transaction</td>
						<td>Quantity</td>
					</tr>
					<tr>
						{stock_transactions}
					</tr>
				</table>
			</div>		
		</div>
		</br>
		<div class ="col-xl-12 col-md-12">
			<font color="white"><h2 class="sub-header text-center">Recent Movement</h2></font>
			<div class="CSSTableGenerator">
				<table>
					<tr>
						<td>Time</td>
						<td>Action</td>
						<td>Amount</td>
					</tr>
					<tr>
						{movement_history}
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>