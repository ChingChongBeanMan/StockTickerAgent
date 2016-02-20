<script type="text/javascript" src="/scripts/dropdown.js" ></script>

<font color="1394BF"><h1 style="margin:auto; text-align:center;">{PlayerName}</h1></font>
</br>

<select class="styled-select" id="playerdropdown">
    <option>Select A Player</option>
    {playerdropdown}
        <option value ="{playername}">{playername}</option>;
    {/playerdropdown}
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
						<td>Transaction</td>
						<td>Stock</td>
						<td>Quantity</td>
                                                
					</tr>
                                        {ProfileSummary}
					<tr>
                                            <td>{time}</td>
                                            <td>{trans}</td>
                                            <td>{stock}</td>
                                            <td>{qty}</td>
					</tr>
                                        {/ProfileSummary}
				</table>
			</div>		
		</div>
		</br>
		<div class ="col-xl-12 col-md-12">
			<font color="white"><h2 class="sub-header text-center">Holding Items</h2></font>
			<div class="CSSTableGenerator">
				<table>
					<tr>
						<td>Stock</td>
						<td>Quantity</td>
					</tr>
					{HoldingSummary}
					<tr>
						<td>{stocksum}</td>
						<td>{qtysum}</td>
					</tr>
					{/HoldingSummary}
				</table>
			</div>
		</div>
	</div>
</div>