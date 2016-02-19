<p>Order summary</p>
<table class="table">
    <tr><th span="2">Recent Transaction<th></tr>

    <tr>
        <th>Time</th>
        <th>Transaction</th>
        <th>Stock</th>
        <th>Quantity</th>
    </tr>
    {ProfileList}
    <tr>
        <td>{time}</td>
        <td>{trans}</td>
        <td>{stock}</td>
        <td>{qty}</td>
    </tr>
    {/ProfileList}
</table>
<br/>
<br/>
<table class="table">
    <tr><th span="2">Holding Items<th></tr>

    <tr>
        <th>Stock</th>
        <th>Quantity</th>
    </tr>
    {HoldingSummary}
    <tr>
        <td>{stocksum}</td>
        <td>{qtysum}</td>
    </tr>
    {/HoldingSummary}
</table>
