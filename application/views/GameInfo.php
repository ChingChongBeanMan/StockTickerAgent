<div>
    <div class="text-center col-md-12">
        <h3 style="color:white">{temptitle}</h3>
        <table class="CSSTableGenerator table table-hover">
            <tr>
                <td>Round</td>
                <td>State</td>
                <td>Desc</td>
                <td>Duration</td>
                <td>Upcomming</td>
                <td>Alarm</td>
                <td>Now</td>
                <td>Countdown</td>
            </tr>
            {information}
            <tr>
                <td>{round}</td>
                <td>{state}</td>
                <td>{desc}</td>
                <td>{duration}</td>
                <td>{upcoming}</td>
                <td>{alarm}</td>
                <td>{now}</td>
                <td>{countdown}</td>
            </tr>
            {/information}
        </table>
    </div>
    
    
    <div class="text-center col-md-12 ">
                <h3 style="color:white">{temp2title}</h3>
    <table class="CSSTableGenerator table table-hover">
            <tr>
                <td>code</td>
                <td>name</td>
                <td>category</td>
                <td>value</td>
            </tr>
            {stockInfo}
            <tr>
                <td>{code}</td>
                <td>{name}</td>
                <td>{category}</td>
                <td>{value}</td>
            </tr>
            {/stockInfo}
        </table>
    </div>
    
</div>
