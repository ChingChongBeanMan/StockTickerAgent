<div class="row">
     <div class="col-md-12">
         <table class="table">
             <h3>{message}</h3>
            <thead>
            <td>Name</td>
            <td></td>
            <td></td>
            </thead>
            {listStock}
            <tr>
                <td>{name}</td>
                <td>{code}</td>
                <td>{value}</td>
                <td><a href="/StockManager/buyStocks/{code}/50/Colin">Buy 50</a></td>
                <td><a href="/StockManager/buyStocks/{code}/50/Colin">Buy 100</a></td>
                <td><a href="/StockManager/sellStocks/{code}/50/Colin">Sell 50</a></td>
                <td><a href="/StockManager/sellStocks/{code}/100/Colin">Sell 100</a></td>
            </tr>
            {/listStock}
        </table>
    </div>
</div>
