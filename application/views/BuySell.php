<div class="row">
     <div class="col-md-12">
         <table class="CSSTableGenerator table">
             <h3>{message}</h3>
            <thead>
            <td>Name</td>
            <td>Code</td>
            <td>Value</td>
            </thead>
            {listStock}
            <tr>
                <td>{name}</td>
                <td>{code}</td>
                <td>{value}</td>
                <td><a href="/StockManager/buyStocks/{code}/10/{username}">Buy 10</a></td>
                <td><a href="/StockManager/buyStocks/{code}/50/{username}">Buy 50</a></td>
                <td><a href="/StockManager/buyStocks/{code}/50/{username}">Buy 100</a></td>
                <td><a href="/StockManager/sellStocks/{code}/10/{username}">Sell 10</a></td>
                <td><a href="/StockManager/sellStocks/{code}/50/{username}">Sell 50</a></td>
                <td><a href="/StockManager/sellStocks/{code}/100/{username}">Sell 100</a></td>
            </tr>
            {/listStock}
        </table>
    </div>
</div>
