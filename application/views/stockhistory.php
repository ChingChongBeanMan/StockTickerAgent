<script type="text/javascript" src="/scripts/dropdown.js" ></script>
<h1 style="margin:auto; text-align:center;">{intro}</h1>
</br>
<select id="historydropdown">
    <option>Select A Stock</option>
    {dropdown}
</select>
</br>
<table class="table">
    <tr><th colspan="4" style="text-align:center;"><h3>Recent Transactions</h3><th></tr>
    <tr>
        <th>Time</th>
        <th>Player</th>
        <th>Transaction</th>
        <th>Quantity</th>
    </tr>
   {stock_transactions}
</table>
<br/>


<table class="table">
    <tr><th colspan="3" style="text-align:center;"><h3>Recent Movement<h3><th></tr>
    <tr>
        <th>Time</th>
        <th>Action</th>
        <th>Amount</th>
    </tr>
   {movement_history}
</table>
<br/>